<?php
require_once 'app/models/consultarIncMo.php';

class consultaIncidenciaController 
{
    private $consultarIncidenciaModel;
    public function __construct()
    {
        $this->consultarIncidenciaModel = new consultarIncidenciaModel();
    }
    /**
     * Realiza la consulta de incidencias al pulsar el botón Buscar.
     */
    public function consultarIncidencias($FechaIncidencia, $NumIncidencia, $area)
    {
            // Verifica si la solicitud es POST (es decir, se envió el formulario)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Obtén el valor de la variable 'FechaIncidencia' del formulario
                $FechaIncidencia = $_POST['FechaIncidencia'] ?? '';
                // Obtén el valor de la variable 'NumIncidencia' del formulario
                $NumIncidencia = $_POST['NumIncidencia'] ?? '';
                // Obtén el valor de la variable 'area' del formulario
                $area = $_POST['area'] ?? '';

                // Llama al método obtenerIncidencia del modelo con el número de incidencia
                $incidenciasConsulta = $this->consultarIncidenciaModel->consultarIncidencia($FechaIncidencia, $NumIncidencia, $area);

                // Devuelve el resultado de la consulta
                return $incidenciasConsulta;
            }
    }
}