<?php
// Importamos las credenciales y la clase de conexión
require_once 'config/conexion.php';

class CierreModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function insertarCierre(
        $FechaCierre,
        $CodUsuario,
        $Operatividad,
        $NumRecepcion, 
        $AsuntoCierre,
        $Hora,
        $Documento,
        $Diagostico,
        $Solucion,
        $Recomendaciones,
        
        )
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "INSERT INTO cierre (
                    FechaCierre, 
                    CodUsuario,
                    Operatividad,
                    NumRecepcion,
                    AsuntoCierre,
                    Hora, 
                    Documento, 
                    Diagostico, 
                    Solucion, 
                    Recomendaciones
                    ) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $success = $stmt->execute(
                    [
                        $FechaCierre,
                        $CodUsuario,
                        $Operatividad,
                        $NumRecepcion,
                        $AsuntoCierre,
                        $Hora,
                        $Documento,
                        $Diagostico,
                        $Solucion,
                        $Recomendaciones                  
                    ]
                );

                if ($success) {
                    return true; // Éxito en la inserción
                } else {
                    // Ocurrió un error al ejecutar la consulta
                    $errorInfo = $stmt->errorInfo();
                    echo "Error al insertar el cierre: " . $errorInfo[2]; // Mensaje de error específico de la base de datos
                    return false;
                }
            } else {
                // Error en la preparación de la consulta
                $errorInfo = $conn->errorInfo();
                echo "Error de preparación de la consulta: " . $errorInfo[2];
                return false;
            }
        } else {
            echo "Error de conexión a la base de datos.";
            return false;
        }
    }

    public function consultarcierre() {
        $conn = $this->conexion->getConexion();
    
        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = "SELECT I.INC_codigo, I.INC_codigoPatrimonial AS codigo_patrimonial, I.INC_estado, 
                P.PRI_nombre AS prioridad, I.INC_fecha, INC_asunto, a.ARE_nombre, c.CAT_nombre
          FROM INCIDENCIA I
                    INNER JOIN Prioridad P ON I.PRI_codigo = P.PRI_codigo
                    inner join CATEGORIA c on I.CAT_codigo = c.CAT_codigo
          inner join area a on I.ARE_codigo = a.ARE_codigo
          ORDER BY I.INC_codigo";
    
                // Preparar la sentencia
                $stmt = $conn->prepare($sql);
    
                // Ejecutar la consulta
                $stmt->execute();
    
                // Obtener los resultados como un array asociativo
                $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
                // Devolver los registros obtenidos
                return $registros;
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
?>