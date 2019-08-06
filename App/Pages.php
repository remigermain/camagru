<?php

namespace App;

class Pages 
{
    public static function page_Json($url)
    {
        $val = array("redirect" => "1", "url" => "http://127.0.0.1:8008/Public/index.php?p=" . $url);
        print(json_encode($val));
    }

    public static function page_Header($url)
    {
        header('Location:/Public/index.php?p=' . $url);
    }

}

?>