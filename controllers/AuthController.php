<?php

use \Library\Controller as Controller;
use \Models\Home as Home;
use Tracy\Debugger as Debugger;
use Faker\Factory as Factory;
use Symfony\Component\HttpFoundation\Request;
use Handler\AppHelper;
use Handler\Manager\UserManager;
use Josantonius\Session\Session;

class AuthController extends Controller {

    private $faker;
    private $homeModel;
    private $request;
    private $usrMgr;

    public function __construct()
    {
        parent::__construct();
        $this->model->call('Home');
        $this->homeModel = new Home();
        Debugger::enable(Debugger::DEVELOPMENT);
        $this->faker = Factory::create();
        $this->request = Request::createFromGlobals();
        $this->usrMgr = new UserManager();
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

        # $this->request->request === $_POST
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
