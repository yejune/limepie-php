<?php
namespace limepie;

class request
{

    public static $data;
    public static $pathinfo;
    public static $segments;

    public static function initialize(\Closure $callback=NULL)
    {

        self::addData('get',     isset($_GET)     ? $_GET     : []);
        self::addData('post',    isset($_POST)    ? $_POST    : []);
        self::addData('request', isset($_REQUEST) ? $_REQUEST : []);
        self::addData('cookie',  isset($_COOKIE)  ? $_COOKIE  : []);
        self::addData('session', isset($_SESSION) ? $_SESSION : []);
        self::addData('server',  isset($_SERVER)  ? $_SERVER  : []);

        if($callback)
        {
            return $callback();
        }

    }

    // '', false는 true, 나머지 false
    public static function isEmpty($val)
    {

        if(
            //TRUE === is_bool($val)
            TRUE === $val
            || TRUE === is_array($val) && 0 < count($val)
            || TRUE === is_object($val)
            || FALSE === empty($val)
            || TRUE === is_null($val)
            || TRUE === is_numeric($val)
            || TRUE === is_string($val) && 0 < strlen($val)
        )
        {
            return FALSE;
        }
        return TRUE;
    }

    public static function addData($dataName, $data)
    {

        self::$data[$dataName] = $data;

    }

    public static function getData($dataName, $key)
    {

        return TRUE === isset(self::$data[$dataName][$key]) ? self::$data[$dataName][$key] : NULL;

    }

    public static function dataAll()
    {

        return self::$data;

    }

    public static function postAll()
    {

        return self::$data['post'];

    }

    public static function getAll()
    {

        return self::$data['get'];

    }

    public static function requestAll()
    {

        return self::$data['request'];

    }

    public static function cookieAll()
    {

        return self::$data['cookie'];

    }

    public static function sessionAll()
    {

        return self::$data['session'];

    }

    public static function serverAll()
    {

        return self::$data['server'];

    }

    public static function segmentAll()
    {

        return self::$data['segment'];

    }

    public static function parameterAll()
    {

        return self::$data['parameter'];

    }

    public static function isPost()
    {

        return strtolower(request\sanitize::server('REQUEST_METHOD', 'string')) == 'post';

    }

    public static function isGet()
    {

        return strtolower(request\sanitize::server('REQUEST_METHOD', 'string')) == 'get';

    }

    public static function hasFiles()
    {



    }

    public static function isAjax()
    {

        return strtolower(request\sanitize::server('HTTP_X_REQUESTED_WITH', 'string')) == 'xmlhttprequest';

    }

    public static function currentUrl()
    {

        return (strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http')
            .'://'
            .getenv('HTTP_HOST')
            .(($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : '')
            .parse_url(getenv('REQUEST_URI'), PHP_URL_PATH)
            .(getenv('QUERY_STRING') ? '?'.getenv('QUERY_STRING') : '')
            ;

    }

    public static function getPathinfo()
    {

        if(!self::$pathinfo)
        {
            if (TRUE === isset($_SERVER["PATH_INFO"]))
            {
                self::$pathinfo  = trim($_SERVER["PATH_INFO"], "/");
            }
            else
            {
                self::$pathinfo  = "";
            }
        }
        return self::$pathinfo;

    }

    public static function getSegments()
    {

        if(!self::$segments)
        {
            self::$segments = explode("/", self::getPathinfo());
        }
        return self::$segments;

    }

    public static function currentDomain()
    {

        return (strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http')
            .'://'
            .getenv('HTTP_HOST')
            .(($p = getenv('SERVER_PORT')) != 80 AND $p != 443 ? ":$p" : '')
            ;

    }

}
