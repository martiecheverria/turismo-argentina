<?php
require_once 'models/DestinoModel.php';
require_once 'models/RegionModel.php';
require_once 'views/AdminView.php';
require_once 'helpers/AuthHelper.php';

class AdminController {
    private $destinoModel;
    private $regionModel;
    private $view;

    public function __construct() {
        
        $this->destinoModel = new DestinoModel();
        $this->regionModel = new RegionModel();
        $this->view = new AdminView();
    }

    public function showAdminPanel() {
        AuthHelper::verify();
        $destinos = $this->destinoModel->getAllDestinosConRegion();
        $regiones = $this->regionModel->getAllRegiones();
        $this->view->showAdminPanel($destinos, $regiones);
    }

    public function addDestino() {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $imagen_url = $_POST['imagen_url'];
        $id_region = $_POST['id_region'];
        if (empty($nombre) || empty($descripcion) || empty($id_region)) {
            header("Location: " . BASE_URL . "admin");
            return;
        }
        $this->destinoModel->insertDestino($nombre, $descripcion, $imagen_url, $id_region);
        header("Location: " . BASE_URL . "admin");
    }

    public function deleteDestino($id_destino) {
        AuthHelper::verify();
        $this->destinoModel->deleteDestino($id_destino);
        header("Location: " . BASE_URL . "admin");
    }

    public function showEditDestinoForm($id_destino) {
        AuthHelper::verify();
        $destino = $this->destinoModel->getDestinoById($id_destino);
        $regiones = $this->regionModel->getAllRegiones();
        if ($destino) {
            $this->view->showEditDestinoForm($destino, $regiones);
        } else {
            echo "Error: Destino no encontrado.";
        }
    }

    public function updateDestino() {
        AuthHelper::verify();
        $id_destino = $_POST['id_destino'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $imagen_url = $_POST['imagen_url'];
        $id_region = $_POST['id_region'];
        if (empty($nombre) || empty($descripcion) || empty($id_region)) {
            echo "Error: Faltan datos obligatorios.";
            return;
        }
        $this->destinoModel->updateDestino($id_destino, $nombre, $descripcion, $imagen_url, $id_region);
        header("Location: " . BASE_URL . "admin");
    }

    public function addRegion() {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $imagen_url = $_POST['imagen_url'];
        if (empty($nombre)) {
            $this->view->showError("El nombre de la región es obligatorio.");
            return;
        }
        $this->regionModel->insertRegion($nombre, $imagen_url);
        header("Location: " . BASE_URL . "admin");
    }

    public function updateRegion() {
        AuthHelper::verify();
        $id_region = $_POST['id_region'];
        $nombre = $_POST['nombre'];
        $imagen_url = $_POST['imagen_url'];
        if (empty($nombre)) {
            $this->view->showError("El nombre no puede estar vacío.");
            return;
        }
        $this->regionModel->updateRegion($id_region, $nombre, $imagen_url);
        header("Location: " . BASE_URL . "admin");
    }

    public function deleteRegion($id_region) {
        AuthHelper::verify();
        try {
            $this->regionModel->deleteRegion($id_region);
            header("Location: " . BASE_URL . "admin");
        } catch (PDOException $e) {
        
            $this->view->showError("No se puede eliminar una región que tiene destinos asociados.");
        }
    }


    public function showEditRegionForm($id_region) {
        AuthHelper::verify();
        $region = $this->regionModel->getRegionById($id_region);
        if ($region) {
            $this->view->showEditRegionForm($region);
        } else {
            $this->view->showError("Región no encontrada.");
        }
    }

}