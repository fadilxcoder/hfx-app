<?php

use Handler\Manager\SecurityManager;
use \Library\Controller;
use Handler\Manager\ElasticsearchManager;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        SecurityManager::verify();
        $this->container = $this->container();
        $this->homeModel = $this->container['DI_homeModel'];
        $this->container['DI_debugger'];
    }

    public function dashboard()
    {
        $result = $this->homeModel->getAll();
        shuffle($result);
        $this->view->render('dashboard.html', [
            'users' => $result,
        ]);
    }

    public function searchEngine()
    {
        $request = $this->container['DI_request'];
        $resp = null;
        
        if ($request->request->has('search')) :
            $client = ElasticsearchManager::init();
            $query = $client->search([
                'size' => 100,
                'index' => 'faker_data',
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                // ['match' => [
                                //     'email' => 'nicholaus.schultz@kuhic.com'
                                // ]],
                                ['prefix' => [
                                    'name' => (null !== $request->request->get('name')) ? $request->request->get('name') : ''
                                ]],
                                ['prefix' => [
                                    'address' => (null !== $request->request->get('addr')) ? $request->request->get('addr') : ''
                                ]],
                                ['prefix' => [
                                    'email' => (null !== $request->request->get('email')) ? $request->request->get('email') : ''
                                ]],
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
            endif;
        endif;

        $this->view->render('elasticsearch.html', [
            'results' => $resp,
        ]);
    }
}