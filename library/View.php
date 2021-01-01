<?php

namespace Library;

use \League\Plates\Engine;
use Handler\DependencyInjection;
use Handler\Manager\ViewManager;

class View extends ViewManager
{
    public function render($view, $vars = [])
    {
        $templates = new Engine('../views');
        $templates->loadExtension(new ViewManager());
        $vars = $vars + ['container' => DependencyInjection::init()];
        echo $templates->render($view, $vars);
        exit;
    }
}
