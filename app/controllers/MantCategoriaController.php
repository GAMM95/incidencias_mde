<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/MantCategoriaModel.php';

class MantCategoriaController
{
    private $mantCategoriaModel;

    public function __construct()
    {
        // Crear una instancia del modelo IncidenciaModel
        $this->mantCategoriaModel = new MantCategoriaModel();
       
    }


    public function registrarCategoria()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $DescripcionCategoria = $_POST['DescripcionCategoria'];

            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantCategoriaModel->insertarCategoria($DescripcionCategoria);

            if ($insertSuccessId) {

                header('Location: mantenimiento-categoria.php?CodCategoria='.$insertSuccessId);
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