<?php

namespace Handler\Manager;

use Josantonius\Session\Session;
use Handler\AppHelper;

class SecurityManager
{
    public static function verify()
    {
        if (null === Session::get("id_user")) {       
            AppHelper::redirectTo('login');
        }
    }
}
