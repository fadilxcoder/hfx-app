<?php

use Handler\Manager\SecurityManager;
use \Library\Controller;

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        SecurityManager::verify();
        $this->container = $this->container();
        $this->homeModel = $this->container['DI_homeModel'];
    }

    public function dashboard()
    {
        $result = $this->homeModel->getAll();
        shuffle($result);
        $this->view->render('dashboard.html', [
            'users' => $result,
        ]);
    }
}