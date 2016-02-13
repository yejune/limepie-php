<?php

namespace limepie\error;

class controller extends \limepie\controller
{

    /**
     * @param  [string] $errorMessage [error message]
     * @param  [string] $errorCode    [error code]
     * @param  [array]  $errorData    [error data]
     * @return view
     */
    public function __construct($errorMessage, $errorCode, $errorData)
    {
        header(getenv("SERVER_PROTOCOL")." 404 Not Found", TRUE, 404);
        header("Status: 404 Not Found");
        putenv("REDIRECT_STATUS=404");
        $msg = '';
        foreach ($errorData as $k => $v) {
            $msg .= $k.' => '.$v.PHP_EOL;
        }
        echo '<style>body {background:#eee;color:black}</style>';
        echo '<pre>';
        echo '<h1>'.$errorData[$errorCode].' '.$errorMessage.'</h1>';
        echo $msg;
        echo '</pre>';
        die();
    }

}