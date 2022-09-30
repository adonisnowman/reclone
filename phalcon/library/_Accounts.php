<?php


class _Accounts
{

    public static $app_id;
    public static $arrContextOptions = [];
    function __construct()
    {
        self::$arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
    }

    public static function AllowIps(){
        
        $Accounts = Accounts::find(" offshelf != 1 ");
        $AllowIps = Tools::fix_array_Key($Accounts->toArray(),"AllowIps");
        $AllowIps = join(",",$AllowIps);

        
        return explode(",",$AllowIps);
    }
    
    
}
