<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/MantUsuarioModel.php';

class MantUsuarioController
{
    private $mantUsuarioModel;

    public function __construct()
    {
        // Crear una instancia del modelo IncidenciaModel
        $this->mantUsuarioModel = new MantUsuarioModel();
    }


    public function registrarUsuario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $NombreUsuario = $_POST['NombreUsuario'];
            $Password = $_POST['Password'];
            $CodEstado = $_POST['CodEstado'];
            $CodPersona = $_POST['CodPersona'];
            $CodRol = $_POST['CodRol'];

            
            // Llamar al método del modelo para insertar la incidencia en la base de datos
            $insertSuccessId = $this->mantUsuarioModel->insertarUsuario($NombreUsuario, $Password, $CodEstado, $CodPersona, $CodRol);

            if ($insertSuccessId) {

                header('Location: mantenimiento-usuario.php?CodUsuario='.$insertSuccessId);
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