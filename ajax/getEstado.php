<?php
require_once '../config/conexion.php';

class EstadoModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Conexion())->getConexion();
    }

    public function getEstadoData()
    {
        $query = "SELECT * FROM Estado";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}


$estadoModel = new EstadoModel();
$estados = $estadoModel->getEstadoData();

header('Content-Type: application/json');
echo json_encode($estados);