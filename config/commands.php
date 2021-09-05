<?php

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Core\Container;
use App\Commands\{UserCommand, GnuCommand, PdfGeneratorCommand};

Dotenv::createImmutable(__DIR__ . '/../')->load();
$container = Container::init();
$app = new Silly\Application();

$app->useContainer($container, $injectWithTypeHint = true);

## Commands here ##

$app->command('database:users value', UserCommand::class);
$app->command('who:am:i', GnuCommand::class);
$app->command('generate:pdf', PdfGeneratorCommand::class);

## EOF Commands ##

$app->run();