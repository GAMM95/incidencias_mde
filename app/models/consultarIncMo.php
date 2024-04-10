<?php
// Importar el archivo de conexión y cualquier otra lógica necesaria
require_once 'config/conexion.php';
class consultarIncidenciaModel
{
    private $conexion;
    public function __construct()
    {
        $this->conexion = new Conexion();
    }
    public function listarIncidencias()
    {
        try {
            $conn = $this->conexion->getConexion();
            if ($conn != null) {
                $sql = "SELECT NumIncidencia, CodPatrimonial, DescripcionCategoria, FechaIncidencia, Asunto, a.NombreArea, Descripcion, NumDocumento, Hora
        FROM INCIDENCIA i
        INNER JOIN Categoria ON i.CodCategoria = Categoria.CodCategoria
        inner join area a on a.CodArea = i.CodArea";

                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                throw new Exception("Error de conexión a la base de datos.");
            }
        } catch (PDOException $e) {
            throw new Exception("Error al obtener las recepciones: " . $e->getMessage());
        }
    }

    public function consultarIncidencia($FechaIncidencia,$NumIncidencia,$area) {
        $conn = $this->conexion->getConexion();
        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = "SELECT i.NumIncidencia, i.CodPatrimonial, c.DescripcionCategoria, i.FechaIncidencia, i.Asunto, a.NombreArea, i.Descripcion, i.NumDocumento, i.Hora
                FROM INCIDENCIA i
                INNER JOIN Categoria c ON i.CodCategoria = c.CodCategoria
                INNER JOIN Area a ON a.CodArea = i.CodArea
                WHERE (i.FechaIncidencia = $FechaIncidencia) OR
                (i.NumIncidencia = $NumIncidencia) Or
                (a.NombreArea = $area)";
    
                // Preparar la sentencia
                $stmt = $conn->prepare($sql);
                // Vincula los valores a los parámetros de la consulta
                $stmt->bindValue(':FechaIncidencia', $FechaIncidencia, PDO::PARAM_STR);
                $stmt->bindValue(':NumIncidencia', $NumIncidencia, PDO::PARAM_INT);
                $stmt->bindValue(':area', $area, PDO::PARAM_INT);
    
                // Ejecutar la consulta
                $stmt->execute();
    
                // Obtener los resultados como un array asociativo
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                // Devolver los registros obtenidos
                return $result;
            } catch (PDOException $e) {
                // Manejar cualquier excepción o error que pueda surgir al ejecutar la consulta
                echo "Error al obtener los registros de incidencias: " . $e->getMessage();
                return null;
            }
        } else {
            echo "Error de conexión cierre Controller la base de datos.";
            return null;
        }
    }
}