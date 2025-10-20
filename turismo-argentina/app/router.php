<?php
session_start();

require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/DestinoController.php';
require_once __DIR__ . '/controllers/RegionController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/AdminController.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

$homeController = new HomeController();
$destinoController = new DestinoController();
$regionController = new RegionController();
$authController = new AuthController();
$adminController = new AdminController();

switch ($params[0]) {
    case 'home':
        $homeController->showHome();
        break;
    
    case 'destinos':
        if (isset($params[1])) {
            $id_region = $params[1];
            $destinoController->showDestinosByRegion($id_region);
        } else {
            $destinoController->showAllDestinos();
        }
        break;

    case 'destino':
        if (isset($params[1])) {
            $id_destino = $params[1];
            $destinoController->showDestinoDetail($id_destino);
        } else {
            $destinoController->showAllDestinos();
        }
        break;
    case 'regiones':
        $regionController->showAllRegiones();
        break;
    case 'register':
        $authController->showRegisterForm();
        break;
    case 'create-user':
        $authController->registerUser();
        break;
    case 'login':
        $authController->showLogin();
        break;
    case 'verify':
        $authController->login();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'admin':
        $adminController->showAdminPanel();
        break;
    case 'add-destino':
        $adminController->addDestino();
        break;
    case 'delete-destino':
        $id_destino = $params[1];
        $adminController->deleteDestino($id_destino);
        break;
    case 'edit-destino':
        $id_destino = $params[1];
        $adminController->showEditDestinoForm($id_destino);
        break;
    case 'update-destino':
        $adminController->updateDestino();
        break;
    case 'add-region':
        $adminController->addRegion();
        break;
    case 'delete-region':
        $id_region = $params[1];
        $adminController->deleteRegion($id_region);
        break;
    case 'edit-region':
        $id_region = $params[1];
        $adminController->showEditRegionForm($id_region);
        break;
    case 'update-region':
        $adminController->updateRegion();
        break;
    default:
        echo "404 Page Not Found";
        break;
}