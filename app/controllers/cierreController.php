<?php
require 'app/models/CierreModel.php'; // Asegúrate de importar el modelo de Cierre
require 'app/models/IncidenciaModel.php'; // Asegúrate de importar el modelo de Incidencia

class cierreController
{
    private $cierreModel; // Instancia del modelo de Cierre
    private $incidenciaModel; // Instancia del modelo de Incidencia

    public function __construct()
    {
        $this->incidenciaModel = new IncidenciaModel(); // Inicializa el modelo de Incidencia
        $this->cierreModel = new CierreModel(); // Inicializa el modelo de Cierre
    }

    public function registrarCierre()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $NumRecepcion = $_POST['REC_codigo'];
            $FechaCierre = $_POST['fecha_cierre'];
            $CodUsuario = $_POST['usuario'];
            $Operatividad = $_POST['operatividad'];
            //$NumRecepcion = $_POST['incidencia'];
            $AsuntoCierre = $_POST['asunto'];
            $Hora = $_POST['hora'];
            $Documento = $_POST['documento'];
            $Diagostico = $_POST['diagnostico'];
            $Solucion = $_POST['solucion'];
            $Recomendaciones= $_POST['recomendaciones'];

            // Llamar al método del modelo para insertar el cierre en la base de datos
            $insertSuccess = $this->cierreModel->insertarCierre($FechaCierre, $CodUsuario,$Operatividad, $NumRecepcion, $AsuntoCierre, $Hora, $Documento, $Diagostico, $Solucion, $Recomendaciones);

            if ($insertSuccess) {

                $cierreSuccess = $this->incidenciaModel->cerrarRecepcion($NumRecepcion);
                header('Location: registro-cierre.php');
            } else {
                // Mostrar un mensaje de error
                echo "Error al registrar el cierre.";
            }
        } else {
            // Manejar el caso en el que no se recibe un POST (puede ser una redirección o una respuesta de error)
            echo "Error: Método no permitido.";
        }
    }
}


?>