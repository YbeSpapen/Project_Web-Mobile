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
    $userController = $container->get('UserController');

    $router = new AltoRouter();

    $router->setBasePath('/api/');

    $router->map('GET', 'location',
        function () use ($locationController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $locationController->handleGetLocations();
        }
    );

    $router->map('POST', 'location/add',
        function () use ($locationController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            header("Content-Type: application/json");
            $_POST = json_decode(file_get_contents('php://input'), true);

            $locationController->handleAddLocation($_POST["name"]);
        }
    );

    //id = id of location
    $router->map('GET', 'status/location/[i:id]',
        function ($locationId) use ($statusController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $statusController->handlegetStatusesByLocationId($locationId);
        }
    );

    $router->map('GET', 'status/percentage',
        function () use ($statusController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $statusController->handledGetPercentage();
        }
    );

    //id = id of location
    $router->map('GET', 'issue/location/[i:id]',
        function ($locationId) use ($issueController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $issueController->handlegetIssuesByLocationId($locationId);
        }
    );

    //id = id of issue
    $router->map('GET', 'issue/[i:id]',
        function ($id) use ($issueController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $issueController->handleGetIssueById($id);
        }
    );

    //id = id of technician
    $router->map('GET', 'issue/technician/[i:id]',
        function ($technicianId) use ($issueController) {
            header("Access-Control-Allow-Origin: http://192.168.46.137:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $issueController->handleGetIssueByTechnicianId($technicianId);
        }
    );

    $router->map('POST', 'status/add',
        function () use ($statusController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $_POST = json_decode(file_get_contents('php://input'), true);
            $statusController->handleAddStatus($_POST["location_id"], $_POST["status"], $_POST["date"]);
        }
    );

    $router->map('POST', 'issue/add',
        function () use ($issueController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $_POST = json_decode(file_get_contents('php://input'), true);

            $issueController->handleAddIssue($_POST["location_id"], $_POST["problem"], $_POST["date"], $_POST["handled"]);
        }
    );

    $router->map('POST', 'issue/assignTechnician',
        function () use ($issueController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $_POST = json_decode(file_get_contents('php://input'), true);
            $issueController->handleAssignIssue($_POST["issue_id"], $_POST["technician_id"]);
        }
    );

    $router->map('GET', 'technicians',
        function () use ($userController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $userController->handleGetTechnicians();
        }
    );

    $router->map('POST', 'technician/add',
        function () use ($userController) {
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Content-Type: application/json");
            $_POST = json_decode(file_get_contents('php://input'), true);

            $userController->handleAddTechnician($_POST["email"], $_POST["name"], "ROLE_TECHNICIAN", $_POST["password"]);
        }
    );

    $match = $router->match();


    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']) && $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'] == 'GET') {
            #header("Access-Control-Allow-Origin: http://localhost:3000");
            header("Access-Control-Allow-Origin: http://192.168.33.11:3000");
            header("Access-Control-Allow-Methods: GET, POST");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
        }
        exit;
    }

    if ($match && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    } else {
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }

} catch (Exception $e) {
    echo $e->getMessage();
}