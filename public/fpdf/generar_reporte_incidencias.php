<?php
// Importar el modelo IncidenciaModel.php
require 'app/models/IncidenciaModel.php';

// Crear una instancia del modelo IncidenciaModel
$incidenciaModel = new IncidenciaModel();

// Obtener los registros de incidencias desde el modelo
$registrosIncidencias = $incidenciaModel->obtenerRegistrosIncidencias(); // Esta función debería existir en tu modelo

// Verificar si se obtuvieron los registros correctamente
if ($registrosIncidencias !== null && !empty($registrosIncidencias)) {
    // Aquí puedes utilizar los datos obtenidos ($registrosIncidencias) para generar tu PDF con FPDF
    // Por ejemplo, recorrer los registros y construir una tabla en el PDF
    // Llamar cierreController métodos de FPDF para construir el PDF
    // ...

    // Una vez generado el PDF, podrías descargarlo o mostrarlo en el navegador
} else {
    // Manejar el caso en el que no se encontraron registros de incidencias
    echo "No se encontraron registros de incidencias.";
}
?>
