<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/MantPersonaModel.php';

class MantPersonaController
{
    private $mantPersonaModel;

    public function __construct()
    {
        // Crear una instancia del modelo IncidenciaModel
        $this->mantPersonaModel = new MantPersonaModel();
    }


    public function registrarPersona()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $DNI = $_POST['dni'];
            $Nombre = $_POST['nombre'];
            $Celular = $_POST['celular'];
            $Email = $_POST['email'];
            

            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantPersonaModel->insertarPersona($DNI, $Nombre, $Celular, $Email);

            if ($insertSuccessId) {

                header('Location: mantenimiento-persona.php?CodPersona='.$insertSuccessId);
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

    public function actualizarPersona()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $CodPersona = $_POST['CodPersona'];
            $DNI = $_POST['dni'];
            $Nombre = $_POST['nombre'];
            $Celular = $_POST['celular'];
            $Email = $_POST['email'];
            
            
            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantPersonaModel->actualizarPersona($CodPersona,$DNI, $Nombre, $Celular, $Email);

            if ($insertSuccessId) {

                header('Location: mantenimiento-persona.php?CodPersona='.$CodPersona);
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