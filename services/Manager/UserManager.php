<?php

namespace Handler\Manager;

class UserManager
{
    public function encryptUserPassword(String $password) 
    {
        $encryptPassword = hash('sha512', $password);
        
        return $encryptPassword;
    }

    public function selectUserByUsernameAndPassword(Array $user)
    {
        if ($user && null !== $user && count($user) === 1) {
            return $user[0];
        }

        return null;
    }
}
