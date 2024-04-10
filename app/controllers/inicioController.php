<?php
// Importar el modelo InicioModel.php
require 'app/models/InicioModel.php';

class InicioController
{
    private $inicioModel;

    public function __construct()
    {
        // Crear una instancia del modelo InicioModel
        $this->inicioModel = new InicioModel();
    }
}
?>