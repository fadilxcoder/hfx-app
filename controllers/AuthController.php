<?php

use \Library\Controller as Controller;
use Josantonius\Session\Session;
use Handler\Manager\UserManager;

class AuthController extends Controller 
{

    private $faker;
    private $homeModel;
    private $request;
    private $usrMgr;

    public function __construct()
    {
        parent::__construct();
        $this->container = $this->container();
        $this->container['DI_debugger'];
        $this->faker        = $this->container['DI_factory'];
        $this->homeModel    = $this->container['DI_homeModel'];
        $this->request      = $this->container['DI_request'];
        $this->usrMgr       = new UserManager();
    }

    public function index()
    {
        if (null !== Session::get("id_user")) {
            $this->dashboard();
        } else {
            $this->login();
        }
    }

    public function login()
    {
        if (null !== Session::get("id_user")) {
            $this->dashboard();
        }

        # $this->request->request IS EQUAL TO $_POST
        if ($this->request->isMethod('POST') && null !== $this->request->request->get('login')) {
            $email = $this->request->request->get('adm_email');
            $passwd = $this->request->request->get('password');
            $encPasswrd = $this->usrMgr->encryptUserPassword($passwd);

            $users = $this->homeModel->selectUser($email, $encPasswrd);
            $validUser = $this->usrMgr->selectUserByUsernameAndPassword($users);

            if (null !== $validUser) {
                Session::set("id_user", $validUser['id_user']);
                Session::set("name_user", $validUser['name']);
                Session::set("uname_user", $validUser['username']);
                $this->redirectTo('dashboard');
            }

            $this->view->render('login.html', [
                'err' => 'Invalid Credentials',
            ]);

            return;
        }
        
        $this->view->render('login.html', []);
    }
    public function dashboard()
    {
        $this->redirectTo('dashboard');
    }

    public function logout()
    {
        Session::destroy(Session::getPrefix(), true);
        $this->redirectTo('login');
    }

    public function __404()
    {
        $this->view->render('error/index');
    }
}
