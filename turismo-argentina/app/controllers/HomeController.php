<?php
require_once dirname(__DIR__) . '/models/DestinoModel.php';
require_once dirname(__DIR__) . '/views/DestinoView.php';

class HomeController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new DestinoModel();
        $this->view = new DestinoView();
    }

    public function showHome() {
        $destinos = $this->model->getAllDestinosConRegion();
        $this->view->showHome($destinos);
    }
}