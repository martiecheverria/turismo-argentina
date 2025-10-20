<?php
require_once 'models/DestinoModel.php';
require_once 'models/RegionModel.php'; 
require_once 'views/DestinoView.php';

class DestinoController {

    private $destinoModel;
    private $regionModel;
    private $view;

    public function __construct() {
        $this->destinoModel = new DestinoModel();
        $this->regionModel = new RegionModel();
        $this->view = new DestinoView();
    }
    
    public function showAllDestinos() {

        $destinos = $this->destinoModel->getAllDestinosConRegion();
        $regiones = $this->regionModel->getAllRegiones();
        $this->view->showAllDestinos($destinos, $regiones);
    }
    
    public function showDestinosByRegion($id_region) {

        $destinos = $this->destinoModel->getDestinosByRegion($id_region);
        $regiones = $this->regionModel->getAllRegiones(); 
        $this->view->showDestinos($destinos, $regiones, "Destinos de la Región");
    }

    
    public function showDestinoDetail($id_destino) {
        $destino = $this->destinoModel->getDestinoById($id_destino);

        if ($destino) {
            $this->view->showDestinoDetail($destino);
        } else {
            header("Location: " . BASE_URL . "home");
        }
    }
}