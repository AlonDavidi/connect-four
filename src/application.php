#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use App\Command\PlayCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

$application = new Application();

$application->addCommands([new PlayCommand]);

$input = new ArrayInput([]);

// You can use NullOutput() if you don't need the output
$output = new ConsoleOutput();
(new PlayCommand)->run($input,$output);