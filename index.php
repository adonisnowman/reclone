<?php

use \Phalcon\Config\Adapter\Ini as PhConfig;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Cache\Adapter\Redis;
use Phalcon\Storage\SerializerFactory;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager;
use Phalcon\Cache;
use Phalcon\Cache\AdapterFactory;


ini_set('display_errors', '1');
error_reporting(E_ALL);


$dirname = explode("/", dirname(__FILE__));
if(strpos(dirname(__FILE__),"xampp") != false ){
	$dirname = explode("\\", dirname(__FILE__));	
}

$dirname = array_pop($dirname);

$ConfigFile = "config.ini";
$dir = "/{$dirname}/";

if (!defined('ROOT_PATH') ) 
{
	define('ROOT_PATH', (strtoupper(substr(php_uname(), 0, 6)) == 'DARWIN')?"/var/www". $dir:"/www/web" . $dir);
}

if (!defined('CONFIGFILE_PATH')) {
	define("CONFIGFILE_PATH", ROOT_PATH . 'phalcon/config/' );
}
require_once ROOT_PATH . '/phalcon/extend/Extendphalcon.php'; // controller view 基本extand

$ConfigFile = CONFIGFILE_PATH.$ConfigFile;
if(!is_file($ConfigFile)) {
	echo $ConfigFile ." FAILD";
	$images = glob(CONFIGFILE_PATH.'*.{ini}', GLOB_BRACE);
	var_dump($images);	
	exit;
}


// Create the new object
$config = new PhConfig($ConfigFile);

$loader = new Loader();

$loader->registerDirs(
	[
		ROOT_PATH . $config->application->controllersDir,
		ROOT_PATH . $config->application->pluginsDir,
		ROOT_PATH . $config->application->modelsDir,
		ROOT_PATH . $config->application->libraryDir,
	]
);

    

$loader->register();

$container = new FactoryDefault();


$container->set(
	'view',
	function () {
		$view = new View();
		$view->setViewsDir(
			'./phalcon/views/'
		);
		$view->registerEngines(
			[
				'.phtml' => Volt::class,
			]
		);
		return $view;
	}
);

$application = new Application($container);

try {
	$response = $application->handle(
		"/index/index".str_replace($dir ,"",$_SERVER["REQUEST_URI"]),
	);
	
	$response->send();
} catch (\Exception $e) {
	echo $e->getMessage();
}
