<?php
require_once '../config/conexion.php';

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Conexion())->getConexion();
    }

    public function getCategoryData()
    {
        $query = "SELECT * FROM CATEGORIA";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $resultado = $stmt->fetchAll();
        return $resultado;
    }
}

$categoryModel = new CategoryModel();
$categories = $categoryModel->getCategoryData();

header('Content-Type: application/json');
echo json_encode($categories);