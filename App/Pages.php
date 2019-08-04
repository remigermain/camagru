<?php

namespace App;

class Pages 
{
    public static function page_Json($url)
    {
        $json = json_encode(array("redirect" => "1", "url" => "http://127.0.0.1:8008/Public/index.php?" . $url));
        print($json);
    }

    public static function page_Header($url)
    {
        header('Location:/Public/index.php?p=' . $url);
    }

}

?>