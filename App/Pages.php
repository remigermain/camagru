<?php

namespace App;

class Pages 
{
    public static function page_Json($url)
    {
        $val = array("redirect" => "1", "url" => App::path() . "Public/index.php?p=" . $url);
        print(json_encode($val));
    }

    public static function page_Header($url)
    {
        header('Location:/Public/index.php?p=' . $url);
    }

}

?>