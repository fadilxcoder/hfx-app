<?php

namespace Library;

use \Library\View as View;
use Handler\AppHelper;
use Handler\DependencyInjection;
use Josantonius\Session\Session;


class Controller
{
    public function __construct()
    {
        $this->view = new View;
        $this->model = new Model;
        Session::setPrefix('app_');
        Session::init();
        $this->container()['DI_debugger'];
    }

    public function getIps()
    {
        return AppHelper::ipAddr();
    }

    public function generateRandomAlphaNumericString(Int $value)
    {
        return AppHelper::generateRandomAlphaNumericString($value);
    }

    public function stringNormalizer(String $str, String $delimiter)
    {
        return AppHelper::stringNormalizer($str, $delimiter);
    }

    public function redirectTo(String $url)
    {
        return AppHelper::redirectTo($url);
    }

    public function container()
    {
        return DependencyInjection::init();
    }
}
