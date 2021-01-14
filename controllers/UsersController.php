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
        $resp = ElasticsearchManager::getFakeUsers('', '', '');
        $search = [
            'name' => '',
            'address' => '',
            'email' => '',
        ];
        
        if ($request->request->has('search')) :
            $search = [
                'name' => (null !== $request->request->get('name')) ? $request->request->get('name') : '',
                'address' => (null !== $request->request->get('addr')) ? $request->request->get('addr') : '',
                'email' => (null !== $request->request->get('email')) ? $request->request->get('email') : '',
            ];
            $resp = ElasticsearchManager::getFakeUsers($search['name'], $search['address'], $search['email']);
        endif;

        $this->view->render('elasticsearch.html', [
            'results' => $resp,
            'search' => $search,
        ]);
    }
}