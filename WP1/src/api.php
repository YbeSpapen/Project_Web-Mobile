<?php
require_once "vendor/autoload.php";

use \controller\LocatieController;
use \controller\LocatieRepositoryPDO;

$user = 'root';
$password = 'user';
$database = 'WebAndMobile';
$hostname = '127.0.0.1';
$pdo = null;

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password); //;charset=utf8mb4
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $locatieRepositoryPPDO = new LocatieRepositoryPDO($pdo);
    $locatieController = new LocatieController($locatieRepositoryPPDO);

    $router = new AltoRouter();

    $router->setBasePath('/api/');

    $router->map('GET','locatie',
        function() use ($locatieController) {
            header("Content-Type: application/json");
            $locatieController->handleGetLocaties();
        }
    );

    $match = $router->match();

    if( $match && is_callable( $match['target'] ) ){
        call_user_func_array( $match['target'], $match['params'] );
    } else {
        header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }

} catch (Exception $e) {
    echo $e->getMessage();
}