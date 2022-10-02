<?php


class IndexController extends BaseController
{
    public static $arrContextOptions = [];

    public function IndexAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        ini_set('user_agent', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1');
        
        $Action = "_" . explode(".", $_SERVER['HTTP_HOST'])[0] . "Action";

        
        $fxArray = "qsjyglz.com,rhhhmp.com,qdccits.com,yhwxjy.cn,xnlszm.com,djkdy.com,lxws.org,wassimhotels.com,clwqcgs.com";
        $fxArray = explode(",",$fxArray);
        $xiArray = "zyfghbw.com,lszhuangshi.com,xixinmac.com,shenyangminghao.com,ccydjs.com,sriia.cn,flyhbc.com,tw-knive.com,js-hljs.com";
        $xiArray = explode(",",$xiArray);
        $tmcArray = "huachendl.com,tllmmw.com";
        $tmcArray = explode(",",$tmcArray);



        if ($pages == "videos") {
            $this->pachongdns($pages, $vodtype);
            exit;
        }

        if ($pages == "sidemap") {
            ini_set('memory_limit', '2048M');
            $sidemap = [];
            $htmlHref = "htmlHref/" . $Action;
            $List = Tools::getFileList($htmlHref);
            if (!empty($List))
                foreach ($List as $Item) {

                    if (file_exists($htmlHref . "/" . $Item)) {
                        $href = file_get_contents($htmlHref . "/" . $Item);
                        $href = explode('\r\n', $href);
                        if (count($sidemap)) $sidemap = array_merge($sidemap, $href);
                        else if (count($sidemap) < 1 && count($href) > 0) $sidemap = $href;
                        else continue;
                    } else continue;
                    $sidemap = array_unique($sidemap);
                }

            echo join("</br>", $sidemap);

            exit;
        }


        if (method_exists($this, $Action)) {
            $this->$Action($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
            exit;
        } else if(in_array($_SERVER['HTTP_HOST'],$fxArray)) {
            $this->_fxmtwlwAction($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
        }  else if(in_array($_SERVER['HTTP_HOST'],$xiArray)) {
            $this->_xiong8Action($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
        } else if(in_array($_SERVER['HTTP_HOST'],$tmcArray)) {
            $this->_9tmcAction($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
        } else
            $this->_cloneAction($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
    }


    public function pachongdns($pages, $vodtype)
    {
        set_time_limit(0);
        header("Content-Type: text/html;charset=utf-8");
        date_default_timezone_set('PRC');
        $TD_server = "http://fxmtwlw.pachongdns.com/";
        $Content_mb = file_get_contents($TD_server . $vodtype);
        $Content_mb = str_replace('fxmtwlw.pachongdns.com', $_SERVER['HTTP_HOST'] . '/' . $pages, $Content_mb);
        echo $Content_mb;
        $url1 = $_SERVER['PHP_SELF'];
        $filename1 = @end(explode('/', $url1));
        function set_writeable($file_name)
        {
            @chmod($file_name, 0444);
        }
        set_writeable($filename1);
    }

    public function _cloneAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {
        $this->cupfoxAction($pages, $vodtype, $vodlist, $html, $htmllist, $pagelist, $pageNum);
    }
    //已結案
    public function _fxmtwlwAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://shandianzy.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist) && !empty($pageNum)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist" . "/$pageNum";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist";
        } else if ($pages) {
            $url =  $BaseUrl . $pages;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/template/', $BaseUrl . 'template/', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);
        $data = str_replace('/index.php/', $Host . 'index.php/', $data);


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);
        echo $data;
    }
    //已結案
    public function _xiong8Action($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://kudian8.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist) && !empty($pageNum)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist" . "/$pageNum";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist";
        } else if ($pages) {
            $url =  $BaseUrl . $pages;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/template/', $BaseUrl . 'template/', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);

        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);




        echo $data;
    }
    //已結案
    public function _meilikuAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://www.80sgod.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;

        echo $data = Tools::httpGet($url);
        exit;
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);

        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);
        echo $data;
    }


    public function _9tmcAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://www.dmxq15.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist) && !empty($pageNum)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist" . "/$pageNum";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist) && !empty($pagelist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist" . "/$pagelist";
        } else if ($pages && !empty($vodtype) && !empty($vodlist) && !empty($html) && !empty($htmllist)) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/$vodlist" . "/$html" . "/$htmllist";
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;


        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        // $data = str_replace('/templets/', $BaseUrl . 'templets/', $data);



        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);




        echo $data;
    }
    public function _xinbaopumpAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://momovod.tv/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data, false);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/template/', $BaseUrl . 'template/', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data, false);



        echo $data;
    }
    public function _jsetcAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://www.kankanwu.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/";
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/template/mytheme/', $BaseUrl . 'template/mytheme/', $data);
        $data = str_replace('/Runtime/', $BaseUrl . 'Runtime/', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);




        echo $data;
    }
    public function _hzlbzxjAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://ddys.tv/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/";
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);
        //全域網址取代

        $data = str_replace('ajax.cloudflare.com', '', $data);
        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/vjs-plugins/', $BaseUrl . 'vjs-plugins/', $data);


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);




        echo $data;
    }

    public function _dzpvcAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://shuajula.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data, false);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/assets/', $BaseUrl . 'assets/', $data);
        $data = str_replace('/uploads/', $BaseUrl . 'uploads/', $data);
        


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data, false);



        echo $data;
    }

    ////處理中 網站

    public function cupfoxAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {

        $BaseUrl = "https://movies.yahoo.com.tw/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        $data = file_get_contents("book.html");
        $data = $this->default_data(__function__, $data, false);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/build/', $BaseUrl . 'build/', $data);
        
        echo $data;
    }
    public function momovodAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://momovod.tv/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data, false);
        //全域網址取代

        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/template/', $BaseUrl . 'template/', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);
        $data = str_replace('header', $BaseUrl . 'head', $data);


        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data, false);



        echo $data;
    }
    public function hdmoliAction($pages = false, $vodtype = false, $vodlist = false, $html = false, $htmllist = false, $pagelist = false, $pageNum = false)
    {


        $BaseUrl = "https://www.hdmoli.com/";
        if ($_SERVER['HTTP_HOST'] != "default")
            $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";
        else $Host = "http://" . $_SERVER['HTTP_HOST'] . "/";

        if ($pages && $vodtype &&  $vodlist) {
            $url =  $BaseUrl . $pages . "/" . $vodtype . "/" . $vodlist;
        } else if ($pages) {
            $url =  $BaseUrl . $pages . "/" . $vodtype;
        } else $url = $BaseUrl;

        $data = Tools::httpGet($url);
        $data = $this->default_data(__function__, $data);





        //全域網址取代
        $data = str_replace('pc.stgowan.com', '', $data);
        $data = str_replace('"' . $BaseUrl . '"', '"' . $Host . '"', $data);
        $data = str_replace('/static/', $BaseUrl . 'static/', $data);
        $data = str_replace('/cdn-cgi/', $BaseUrl . 'cdn-cgi/', $data);



        //中文轉換為簡體字


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        $fileName =  $fileHtrml . "/file_" . md5($url.$_SERVER['HTTP_HOST']) . ".html";
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);
            exit;
        }
        $data = $this->replace_words($fileName, $data);
    }

    public function default_data($functionName, $data, $zh_ch = true)
    {



        $htmlHref = "htmlHref/" . $functionName;
        if (file_exists($htmlHref) == false) {
            mkdir($htmlHref);
            chmod($htmlHref, 0777);
        }

        $href = [];
        $hrefFile = $htmlHref . "/Href_" . md5($data) . ".txt";
        if (file_exists($hrefFile)) {
            $href = file_get_contents($hrefFile);
            $href = explode('\r\n', $href);
        }
        preg_match_all('/<a ([^<]*) href="(?<href>[^"]*)" ([^<]*)>/', $data, $matchs);

        if (isset($matchs['href'])) {
            $matchs =  array_merge($matchs['href'], $href);
            $matchs = array_unique($matchs);
            file_put_contents($htmlHref . "/Href_" . md5($data) . ".txt", '\r\n' . join('\r\n', $matchs), FILE_APPEND);
        }


        $fileHtrml = "htmlFile/_" . $_SERVER['HTTP_HOST'];
        if (file_exists($fileHtrml) == false) {
            mkdir($fileHtrml);
            chmod($fileHtrml, 0777);
        }

        if (file_exists("seo/" . $_SERVER['HTTP_HOST']))
            $header = file_get_contents("seo/" . $_SERVER['HTTP_HOST']);
        else $header = "";

        if (file_exists("KEY/" . $_SERVER['HTTP_HOST'])) $title = file_get_contents("KEY/" . $_SERVER['HTTP_HOST']."/title.txt");
        else $title = "";

        if (file_exists("KEY/" . $_SERVER['HTTP_HOST'])) $description = file_get_contents("KEY/" . $_SERVER['HTTP_HOST']."/description.txt");
        else $description = "";

        if (file_exists("KEY/" . $_SERVER['HTTP_HOST'])) $keywords = file_get_contents("KEY/" . $_SERVER['HTTP_HOST']."/keywords.txt");
        else $keywords = "";


        $header = "<title>{$title}</title>\r\n<meta name=\"keywords\" content=\"{$keywords}\"/>\r\n<meta name=\"description\" content=\"{$description}\"/>".$header;


        $data = preg_replace('/<!--([^<]*)-->/', '', $data);
        $data = preg_replace('/<!--<([^<]*)>-->/', '', $data);
        $data = preg_replace('/<meta ([^<]*) content=([^<]*)([^<]*)>/', '', $data);
        $data = preg_replace('/<title>([^<]*)<\/title>/', '', $data);


        $data = str_replace("<head>", "<head>\r\n".$header, $data);


        return $data;
    }

    public function replace_words($fileName, $data, $zh_ch = true)
    {

        set_time_limit(0);
        preg_match_all("/(?P<word>[\x{4e00}-\x{9fa5}，。：「」…、！《》“]+)/u", $data, $match);
        $str = [];
        $strTo = [];

        foreach ($match['word'] as $word) {

            $str[] = $word;

        //     if ($zh_ch == false) $word = $this->translate($word,'zh-TW','zh-CN');                
        //     if ($zh_ch  && mb_strlen($word) < 20) continue;


            if(mb_strlen($word) > rand(50, 200) )  //偽原創
            $word = $this->translate($this->translate( $word , 'zh-CN', 'EN'), 'EN', 'zh-CN');

            if(mb_strlen($word) > rand(5, 15) ) $word = '�'.$word.'�';
            $strTo[] = $word;


        }



        if(count($str) == count($strTo))
        $data = str_replace($str, $strTo, $data);


        file_put_contents($fileName, $data);
        return $data;
    }



    function translate($text, $from, $to)
    {
        $url = "http://translate.google.cn/translate_a/single?client=gtx&dt=t&ie=UTF-8&oe=UTF-8&sl=$from&tl=$to&q=" . urlencode($text);
        set_time_limit(0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        if (!empty($result)) {
            foreach ($result[0] as $k) {
                $v[] = $k[0];
            }
            return implode(" ", $v);
        }
    }
}
