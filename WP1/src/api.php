<?php
require_once "vendor/autoload.php";
require_once "phpDiConfig.php";

try {
    $containerBuilder = new DI\ContainerBuilder();
    $containerBuilder->useAutowiring(false);
    $containerBuilder->addDefinitions('phpDiConfig.php');
    $container = $containerBuilder->build();

    $locationController = $container->get('LocationController');
    $statusController = $container->get('StatusController');
    $issueController = $container->get('IssueController');

    $router = new AltoRouter();

    $router->setBasePath('/api/');

    $router->map('GET', 'location',
        function () use ($locationController) {
            header("Content-Type: application/json");
            $locationController->handleGetLocations();
        }
    );

    //id = id of location
    $router->map('GET', 'status/location/[i:id]',
        function ($locationId) use ($statusController) {
            header("Content-Type: application/json");
            $statusController->handlegetStatusesByLocationId($locationId);
        }
    );

    //id = id of location
    $router->map('GET', 'issue/location/[i:id]',
        function ($locationId) use ($issueController) {
            header("Content-Type: application/json");
            $issueController->handlegetIssuesByLocationId($locationId);
        }
    );

    //id = id of issue
    $router->map('GET', 'issue/[i:id]',
        function ($id) use ($issueController) {
            header("Content-Type: application/json");
            $issueController->handleGetIssueById($id);
        }
    );

    //id = id of technician
    $router->map('GET', 'issue/technician/[i:id]',
        function ($technicianId) use ($issueController) {
            header("Content-Type: application/json");
            $issueController->handleGetIssueByTechnicianId($technicianId);
        }
    );

    $router->map('POST', 'status/add',
        function () use ($statusController) {
            header("Content-Type: application/json");
            $statusController->handleAddStatus($_POST["location_id"], $_POST["status"], $_POST["date"]);
        }
    );

    $router->map('POST', 'issue/add',
        function () use ($issueController) {
            header("Content-Type: application/json");
            $issueController->handleAddIssue($_POST["location_id"], $_POST["problem"], $_POST["date"], $_POST["handled"]);
        }
    );

    $router->map('POST', 'issue/assignTechnician',
        function () use ($issueController) {
            header("Content-Type: application/json");
            $issueController->handleAssignIssue($_POST["issue_id"], $_POST["technician_id"]);
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