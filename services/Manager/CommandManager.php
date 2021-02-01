<?php

namespace Handler\Manager;

class CommandManager
{
    public function whoami()
    {
        echo " - " . get_current_user() . "\n" . " - " . php_uname() . "\n";
        return;
    }
}
