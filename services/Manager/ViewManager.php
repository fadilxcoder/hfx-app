<?php

namespace Handler\Manager;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;
use Handler\DependencyInjection;

class ViewManager implements ExtensionInterface
{
    public function register(Engine $engine)
    {
        $engine->registerFunction('uppercase', [$this, 'uppercaseString']);
        $engine->registerFunction('session', [$this, 'getSession']);
    }

    public function getSession(String $key)
    {
        $cntnr = DependencyInjection::init();
        return $cntnr['DI_sessions'][$key];
    }

    public function uppercaseString($var)
    {
        return strtoupper($var);
    }
}