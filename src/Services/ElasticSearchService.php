<?php

namespace App\Services;

use Elasticsearch\ClientBuilder;

class ElasticSearchService
{
    private static function initializeClient()
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

    public static function getEsxUsers($name, $addr, $email)
    {       
        $query = self::initializeClient()->search([
            'size' => 100,
            'index' => 'faker',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            // [
                            //     'match' => [
                            //         'email' => 'nicholaus.schultz@kuhic.com'
                            //     ]
                            // ],
                            [
                                'prefix' => [
                                    'name' => strtolower($name)
                                ]
                            ],
                            [
                                'prefix' => [
                                    'address' => strtolower($addr)
                                ]
                            ],
                            [
                                'prefix' => [
                                    'email' => strtolower($email)
                                ]
                            ],
                        ]
                    ]
                ]
            ]
        ]);

        if ($query['hits']['total']['value'] > 0):
            $result = $query['hits']['hits'];
            
            foreach ($result as $_r) :
                $data = $_r['_source'];
                $resp[] = [
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'email' => $data['email'],
                ];
            endforeach;

            return $resp;
        endif;

        return null;
    }
}
