<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/MantRolModel.php';

class MantRolController
{
    private $mantRolModel;

    public function __construct()
    {
        // Crear una instancia del modelo IncidenciaModel
        $this->mantRolModel = new MantRolModel();
    }

    public function registrarRol()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $DescripcionRol = $_POST['DescripcionRol'];


            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantRolModel->insertarRol($DescripcionRol);

            if ($insertSuccessId) {

                header('Location: mantenimiento-rol.php?CodRol='.$insertSuccessId);
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