<?php

namespace Models;

use \Library\Database as DB;
use Handler\Manager\UserManager;

class Home
{

    public function getAll() 
    {
        $data = DB::getInstance()->select('users', "*" );
        return $data;
    }

    

    public function selectUser(String $uname, String $encryptPassword)
    {
        $user = DB::getInstance()->select('users', '*', [
                'username'  => $uname,
                'password'  => $encryptPassword,
                "LIMIT"     => [0, 1]
            ]
        );

        return $user;
    }

}
