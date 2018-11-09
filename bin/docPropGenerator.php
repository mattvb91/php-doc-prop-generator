<?php

include __DIR__ . '/../vendor/autoload.php';

$command = new \Commando\Command();
$command->option('dbHost')->required();
$command->option('dbName')->required();
$command->option('dbUser')->required();
$command->option('dbPass')->required();

$dbHost = $command['dbHost'];
$dbName = $command['dbName'];
$dbUser = $command['dbUser'];
$dbPass = $command['dbPass'];

try
{
    $generator = new \mattvb91\DocPropGenerator\Generator($dbHost, $dbName, $dbUser, $dbPass);
    $generator->generate();

    echo 'Generated successfully' . PHP_EOL;
} catch (\Exception $exception)
{
    echo $exception->getMessage() . PHP_EOL;
}