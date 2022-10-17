<?php

namespace App\Controller;

use App\Core\Controller;
use App\Repository\UsersRepository;
use Josantonius\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use App\Services\UserService;

class AuthController extends Controller
{
    private const VIEW = 'auth/';

    public function login(Request $request, UserService $userService, UsersRepository $usersRepository, Session  $session)
    {
        $response = [];
        if (null !== $session->get("id_user")) {
            $this->goToDashboard();
        }
        
        if ($request->isMethod('POST') && null !== $request->request->get('login')) {
            $email = $request->request->get('adm_email');
            $passwd = $request->request->get('password');
            $encPasswrd = $userService->encryptUserPassword($passwd);
            $validUser = $usersRepository->getUserByCredentials($email, $encPasswrd);
            
            if ($validUser) {
                
                // Session::setPrefix($_ENV['SESSION_PRFX']);
                $session->set("id_user", $validUser->id_user);
                $session->set("name_user", $validUser->name);
                $session->set("uname_user", $validUser->username);
                $usersRepository->updateUserLastLogin($validUser);
                $this->goToDashboard();
            }

            $response = [
                'err' => 'Invalid Credentials',
            ];
        }

        return $this->render(self::VIEW . 'login.html.twig', $response);
    }

    public function logout()
    {
        Session::destroy(Session::getPrefix(), true);
        $this->redirectTo('login');
    }

    public function goToDashboard()
    {
        return $this->redirectTo('dashboard');
    }

}
