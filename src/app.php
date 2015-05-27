#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

define('__PATH_DATA__', __DIR__.'/../data');
define('__PATH_VIEWS__', realpath(__DIR__.'/App/views'));

use App\Command\CapacityCommand;
use App\Command\PaymentsCommand;
use Ndewez\ApplicationConsoleBundle\Application\Application;

$application = new Application(__DIR__.'/App/config/services.xml');
$application->addContainerCommand(new PaymentsCommand());
$application->addContainerCommand(new CapacityCommand());
$application->run();
