<?php
require_once dirname(__DIR__) . '/models/RegionModel.php';
require_once dirname(__DIR__) . '/views/RegionView.php';

class RegionController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new RegionModel();
        $this->view = new RegionView();
    }

    /**
     * Muestra todas las regiones en una página.
     */
    public function showAllRegiones() {
        // 1. Pido las regiones al modelo
        $regiones = $this->model->getAllRegiones();
        
        // 2. Se las paso a la vista para que las muestre
        $this->view->showAll($regiones);
    }
}