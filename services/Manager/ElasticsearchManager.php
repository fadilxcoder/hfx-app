<?php

namespace Handler\Manager;

use Elasticsearch\ClientBuilder;

class ElasticsearchManager
{
    public static function init()
    {
        $hosts = [
            [
                'host' => $_ENV['ES_HOST'],
                'port' => $_ENV['ES_PORT'],
                'scheme' => $_ENV['ES_SCHEME'],
                'user' => $_ENV['ES_USER'],
                'pass' => $_ENV['ES_PASS'],
            ],
        ];
        
        $client = ClientBuilder::create()->setHosts($hosts)->build();

        return $client;
    }
}
