<?php
class RegionModel {
    private $db;

    public function __construct() {
        require_once 'config.php';
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            $this->deploy();
    }

    public function getAllRegiones() {
        $query = $this->db->prepare("SELECT * FROM regiones");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public function insertRegion($nombre, $imagen_url) {
        $query = $this->db->prepare('INSERT INTO regiones (nombre, imagen_url) VALUES (?, ?)');
        $query->execute([$nombre, $imagen_url]);
        return $this->db->lastInsertId();
    }

    public function updateRegion($id_region, $nombre, $imagen_url) {
        $query = $this->db->prepare('UPDATE regiones SET nombre = ?, imagen_url = ? WHERE id_region = ?');
        $query->execute([$nombre, $imagen_url, $id_region]);
    }

    public function deleteRegion($id_region) {
        $query = $this->db->prepare('DELETE FROM regiones WHERE id_region = ?');
        $query->execute([$id_region]);
    }

 
    public function getRegionById($id_region) {
        $query = $this->db->prepare('SELECT * FROM regiones WHERE id_region = ?');
        $query->execute([$id_region]);
        return $query->fetch(PDO::FETCH_OBJ);
    }



}
