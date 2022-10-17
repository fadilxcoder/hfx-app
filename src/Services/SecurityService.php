<?php

namespace App\Services;

use Josantonius\Session\Session;

class SecurityService
{
    public static function accessibility()
    {
        $session = new Session();
        if (null === $session->get('id_user')) {
            return false;
        }
        
        return true;
    }
}
