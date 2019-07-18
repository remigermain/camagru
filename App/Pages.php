<?php

namespace App;

class Pages 
{
    public static function page_Json($url)
    {
        print(json_encode(array("redirect" => "1", "url" => "http://127.0.0.1:8008/Public/index.php?" . $url)));
    }

}

?>