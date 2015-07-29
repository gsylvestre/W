#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/../vendor/autoload.php';

use W\Console\InstallCommand;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new InstallCommand());
$application->run();