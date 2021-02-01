<?php

// Create commands to be run by terminal

$commands = [
    'database:init'	=> 'Handler\Fixtures\DataFixtures@init',
    'who:am:i'	=> 'Handler\Manager\CommandManager@whoami',
];