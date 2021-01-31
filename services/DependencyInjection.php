<?php

namespace Handler;

use Pimple\Container;
use Tracy\Debugger as Debugger;
use Faker\Factory as Factory;
use Symfony\Component\HttpFoundation\Request;
use Handler\AppHelper;
use \Library\Model;
use \Models\Home;
use Josantonius\Session\Session;
use Handler\Manager\AlgoliaManager;
use DebugBar\StandardDebugBar;

class DependencyInjection
{
    public static function init()
    {
        $container = new Container();

        $container['DI_debugger'] = function () {
            return Debugger::enable(Debugger::DEVELOPMENT);
        };

        $container['DI_factory'] = function () {
            return Factory::create();
        };

        $container['DI_request'] = function () {
            return Request::createFromGlobals();
        };

        $container['DI_appHelper'] = function ($ctn) {
            return new AppHelper($ctn);
        };

        $container['DI_homeModel'] = function () {
            $model = new Model();
            $model->call('Home');
            return new Home;
        };

        $container['DI_sessions'] = function () {
            $sessions = [
                'id_user' => Session::get("id_user"),
                'name_user' => Session::get("name_user"),
                'uname_user' => Session::get("uname_user"),
            ];

            return $sessions;
        };

        $container['DI_algolia'] = function () {
            return new AlgoliaManager;
        };

        $container['DI_standardDebugBar'] = function () {
            return new StandardDebugBar;
        };

        return $container;
    }
}