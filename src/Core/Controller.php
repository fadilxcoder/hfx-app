<?php

namespace App\Core;

use \Twig\Environment;
use App\Core\Twig as TwigEnv;
use Josantonius\Session\Session;
use App\Controller\AuthController;
use App\Services\SecurityService;

class Controller
{
    private $twig, $twigEnv;

    public function __construct(
        Environment $twig, 
        TwigEnv $twigEnv
    ) {
        $this->twig = $twig;
        $this->twigEnv = $twigEnv;
        Session::setPrefix($_ENV['SESSION_PRFX']);
        Session::init();

        if (get_called_class() !== AuthController::class) {
            (SecurityService::accessibility() === false) ? $this->redirectTo('') : null;
        }
    }

    public function render(string $view, array $parameters = [])
    {
        $parameters['app'] = [
            'uri' => $this->twigEnv->appUri(),
            'name' => $this->twigEnv->appName(),
            'session' => Session::get(),
        ];

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        echo $this->twig->render($view, $parameters);
    }

    public function redirectTo(String $url)
    {
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Location: ' . $this->twigEnv->appUri() . $url);
        return;
    }
}