<?php

namespace App\Commands;

use Symfony\Component\Console\Output\OutputInterface;

class GnuCommand
{
    public function __invoke(OutputInterface $output)
    {
        $output->writeln(" - " . get_current_user() . "\n" . " - " . php_uname() . "\n");

        return;
    }


}
