<?php
require_once "vendor/autoload.php";

use controller\LocationController;
use model\LocationRepositoryPDO;

$user = 'root';
$password = 'user';
$database = 'WebAndMobile';
$hostname = '127.0.0.1';
$pdo = null;

try {
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $locationRepositoryPDO = new LocationRepositoryPDO($pdo);
    $locationController = new LocationController($locationRepositoryPDO);

    $router = new AltoRouter();

    $router->setBasePath('/api/');

    $router->map('GET','location',
        function() use ($locationController) {
            header("Content-Type: application/json");
            $locationController->handleGetLocations();
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