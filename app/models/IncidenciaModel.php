<?php
// Importamos las credenciales y la clase de conexión
require_once 'config/conexion.php';

class IncidenciaModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function obtenerIncidenciaPorId($INC_codigo) {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = "SELECT * FROM Incidencia i INNER JOIN Categoria c ON i.CAT_codigo = c.CAT_codigo WHERE INC_codigo = ?";

                // Preparar la sentencia
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta
                $stmt->execute([$INC_codigo]);

                // Obtener los resultados como un array asociativo
                $registros = $stmt->fetch(PDO::FETCH_ASSOC);

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

    public function insertarIncidencia($FechaIncidencia, $Asunto, $CodPatrimonial , $Documento, $CodEstado,$NumDocumento, $Descripcion, $CodCategoria, $CodArea, $CodUsuario,$Hora)
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "INSERT INTO Incidencia (FechaIncidencia, Asunto, CodPatrimonial, Documento, CodEstado, NumDocumento, Descripcion, CodCategoria, CodArea, CodUsuario,Hora)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $FechaIncidencia,
                    $Asunto,
                    $CodPatrimonial,
                    $Documento,
                    1,
                    $NumDocumento,
                    $Descripcion,
                    $CodCategoria,
                    $CodArea,
                    1,
                    $Hora]
                    
            );

            if ($success) {
                echo "Error al insertar la incidencia.";
                $lastId = $conn->lastInsertId();

                return $lastId;
            } else {
                return false;
            }
        } else {
            echo "Error de conexión cierreController la base de datos.";
            return false;
        }
    }

    //write cierreController function that gets an incidencia with his id and updates his INC_estado to 4
    public function recepcionarIncidencia($NumIncidencia) {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "UPDATE Incidencia SET CodEstado = 2 WHERE NumIncidencia = ?";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $NumIncidencia
                ]
            );

            if ($success) {
                echo "Error al actualizar la incidencia.";
                return $success;
            } else {
                return false;
            }
        } else {
            echo "Error de conexión cierreController la base de datos.";
            return false;
        }
    }

    public function cerrarRecepcion($NumRecepcion) {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "UPDATE Recepcion SET CodEstado = 2 WHERE NumRecepcion = ?";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $NumRecepcion
                ]
            );

            if ($success) {
                echo "Error al actualizar la incidencia.";
                return $success;
            } else {
                return false;
            }
        } else {
            echo "Error de conexión cierreController la base de datos.";
            return false;
        }
    }

    public function obtenerIncidenciasSinRecepcionar() {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = "SELECT * FROM Incidencia i INNER JOIN Categoria c ON i.CodCategoria = c.CodCategoria WHERE CodEstado = 1";

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

    public function obtenerTodasLasIncidencias()
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener todos los registros de incidencias
                $sql = "SELECT * FROM Incidencia i INNER JOIN Categoria c ON i.CAT_codigo = c.CAT_codigo";

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
            echo "Error de conexión a la base de datos.";
            return null;
        }
    }

    public function consultarincidencia() {
        $conn = $this->conexion->getConexion();
    
        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = "SELECT NumIncidencia, CodPatrimonial, DescripcionCategoria, FechaIncidencia, Asunto, a.NombreArea, Descripcion, NumDocumento, Hora
                FROM INCIDENCIA i
                INNER JOIN Categoria ON i.CodCategoria = Categoria.CodCategoria
                inner join area a on a.CodArea = i.CodArea
                WHERE 1 = 1";
    
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