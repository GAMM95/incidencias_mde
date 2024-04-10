<?php
// Importamos las credenciales y la clase de conexión
require_once 'config/conexion.php';
class InicioModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
}
?>