<?php

require_once "vendor/autoload.php";

use controller\LocationController;
use controller\StatusController;
use controller\IssueController;
use controller\UserController;
use model\LocationRepositoryPDO;
use model\StatusRepositoryPDO;
use model\IssueRepositoryPDO;
use model\UserRepositoryPDO;

$user = 'root';
$password = 'root';
$database = 'WebAndMobile';
$hostname = '127.0.0.1';

return [
    'LocationController' => DI\object(LocationController::class)->constructor(DI\object(LocationRepositoryPDO::class)
        ->constructor(DI\object(PDO::class)
            ->constructor("mysql:host=$hostname;dbname=$database", $user, $password, null))),
    'StatusController' => DI\object(StatusController::class)->constructor(DI\object(StatusRepositoryPDO::class)
        ->constructor(DI\object(PDO::class)
            ->constructor("mysql:host=$hostname;dbname=$database", $user, $password, null))),
    'IssueController' => DI\object(IssueController::class)->constructor(DI\object(IssueRepositoryPDO::class)
        ->constructor(DI\object(PDO::class)
            ->constructor("mysql:host=$hostname;dbname=$database", $user, $password, null))),
    'UserController' => DI\object(UserController::class)->constructor(DI\object(UserRepositoryPDO::class)
        ->constructor(DI\object(PDO::class)
            ->constructor("mysql:host=$hostname;dbname=$database", $user, $password, null)))
];