<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/MantAreaModel.php';

class MantAreaController
{
    private $mantAreaModel;

    public function __construct()
    {
        // Crear una instancia del modelo IncidenciaModel
        $this->mantAreaModel = new MantAreaModel();
    }


    public function registrarArea()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $NombreArea = $_POST['NomArea'];


            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantAreaModel->insertarArea($NombreArea);

            if ($insertSuccessId) {

                header('Location: mantenimiento-area.php?CodArea='.$insertSuccessId);
                // Mostrar los datos de las incidencias
            }else {
                    // Mostrar un mensaje de error
                    echo "Error al registrar la incidencia.";
                }
            }else {
            // Manejar el caso en el que no se recibe un POST (puede ser una redirección o una respuesta de error)
            echo "Error: Método no permitido.";
        }
    }

}