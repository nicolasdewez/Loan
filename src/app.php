#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';
set_time_limit(0);

define('__PATH_DATA__', realpath(__DIR__.'/../data'));
define('__PATH_CONFIGURATION__', __PATH_DATA__.'/configuration');

use App\Command\PaymentsCommand;
use Ndewez\ApplicationConsoleBundle\Application\Application;

$application = new Application(__DIR__.'/App/config/services.xml');
$application->addContainerCommand(new PaymentsCommand());
$application->run();
