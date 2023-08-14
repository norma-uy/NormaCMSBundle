<?php

setlocale(\LC_ALL, 'en_US.UTF-8');
date_default_timezone_set('UTC');

$file = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($file)) {
    throw new RuntimeException('Install dependencies using Composer to run the test suite.');
}
$autoload = require $file;
