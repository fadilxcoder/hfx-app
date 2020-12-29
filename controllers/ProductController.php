<?php

use Handler\Manager\SecurityManager;
use \Library\Controller;
use Josantonius\Session\Session;

class ProductController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        SecurityManager::verify();
    }

    public function dashboard()
    {
        $this->view->render('dashboard.html', []);
    }
}