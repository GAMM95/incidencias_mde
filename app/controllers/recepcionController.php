<?php
require 'app/models/RecepcionModel.php';
require 'app/models/IncidenciaModel.php';

class RecepcionController
{
    private $recepcionModel;
    private $incidenciaModel;

    public function __construct()
    {
        $this->recepcionModel = new RecepcionModel();
        $this->incidenciaModel = new IncidenciaModel();
    }

    public function registrarRecepcion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $NumIncidencia = $_POST['INC_codigo'];
            $FechaRecepcion = $_POST['fecha_recepcion'];
            $CodUsuario = $_POST['usuario'];
            $Hora = $_POST['hora'];
            $CodPrioridad = $_POST['prioridad'];
            $CodImpacto = $_POST['impacto'];


            // Llamar al método del modelo para insertar la recepcion en la base de datos
            $insertSuccess = $this->recepcionModel->insertarRecepcion($CodUsuario, $CodImpacto, $CodPrioridad, $Hora, $FechaRecepcion, $NumIncidencia, 1);

            if ($insertSuccess) {

                $recepcionarSuccess = $this->incidenciaModel->recepcionarIncidencia($NumIncidencia);
                header('Location: registro-recepcion.php');
            } else {
                // Mostrar un mensaje de error
                echo "Error al registrar la recepcion.";
            }
        } else {
            // Manejar el caso en el que no se recibe un POST (puede ser una redirección o una respuesta de error)
            echo "Error: Método no permitido.";
        }
    }

}

?>