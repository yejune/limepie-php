<?php
namespace limepie\request;
use limepie\request;

class cookie extends request
{

    public static function set($key, $value, $expire=0)
    {

        $cdomain = defined('CDOMAIN')?CDOMAIN:FALSE;
        setcookie($key,$value,$expire,'/',$cdomain);
        return parent::$data['cookie'][$key] = $value;

    }

}
