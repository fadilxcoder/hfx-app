<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use \DI\ContainerBuilder as ContainerBuilder;
use App\Core\Database as Database;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Symfony\Component\HttpFoundation\Request;
class Container
{
    public static function init()
    {
        $containerBuilder = new ContainerBuilder();
        $twig_repo = __DIR__ . '/../../' . $_ENV['TWIG_REPO'];
        
        $containerBuilder->addDefinitions(
            [
                'database.name' => $_ENV['DB_NAME'],
                'database.host' => $_ENV['DB_HOST'], 
                'database.user' => $_ENV['DB_USERNAME'],
                'database.password' => $_ENV['DB_PASSWORD'],
                Database::class => \DI\autowire()->constructor(
                    \DI\get('database.name'),
                    \DI\get('database.host'),
                    \DI\get('database.user'),
                    \DI\get('database.password')
                ),
                Environment::class => \DI\autowire()->constructor(
                    new FilesystemLoader($twig_repo),
                    [
                        'debug' => true
                    ]
                ),
                Logger::class => \DI\autowire()->constructor($_ENV['LOGS_ID']),
            ]
        );

        $container = $containerBuilder->build();
        $container->set(Request::class, Request::createFromGlobals());

        $logger = $container->get(Logger::class);
        $logger->pushHandler(new StreamHandler(__DIR__ . '/../../' . $_ENV['LOGS_PATH'], Logger::DEBUG));
        $logger->pushHandler(new FirePHPHandler());

        return $container;
    }
}
