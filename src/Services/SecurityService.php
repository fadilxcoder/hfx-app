<?php

namespace App\Services;

use Josantonius\Session\Session;

class SecurityService
{
    public static function accessibility()
    {
        if (null === Session::get('id_user')) {
            return false;
        }
        
        return true;
    }
}
