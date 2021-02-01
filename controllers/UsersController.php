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
        $this->algolia = $this->container['DI_algolia'];
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

    public function algoliaSearch()
    {
        $alg_index = 'alg_users';
        $request = $this->container['DI_request'];

        # Populating ALGOLIA
        # $index = $this->algolia->initIdx('alg_users');
        # $result = $this->homeModel->getAll();
        # $this->algolia->insert($alg_index, $result); die;
        
        $result = $this->algolia->searchFor($alg_index, '');
        $resp = $result['hits'];
        $search = null;

        if ($request->request->has('search')) :
            $search = (null !== $request->request->get('name')) ? $request->request->get('name') : '';
            $result = $this->algolia->searchFor($alg_index, $search);
            $resp = $result['hits'];
        endif;

        $this->view->render('algolia.html', [
            'results' => $resp,
            'search' => $search,
        ]);
    }

    public function debugger()
    {
        $result = $this->homeModel->getAll();
        dd($result);
        $this->view->render('dashboard.html', [
            'users' => $result,
        ]);
        
    }
}