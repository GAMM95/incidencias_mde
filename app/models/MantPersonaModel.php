<?php
// Importamos las credenciales y la clase de conexión
require_once 'config/conexion.php';

class MantPersonaModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }


public function listarPersona()
    {
        try {
            $conn = $this->conexion->getConexion();

            if ($conn != null) {
                $sql = "select CodPersona, DNI,NombrePersona, Celular, Email from persona";

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

    public function insertarPersona($DNI, $Nombre, $Celular , $Email)
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "INSERT INTO Persona (DNI, NombrePersona, Celular, Email)
                VALUES (?, ?, ?, ?)";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $DNI,
                    $Nombre,
                    $Celular,
                    $Email]
                    
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

    public function obtenerPersonaPorId($CodPersona) {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = " SELECT * FROM PERSONA  WHERE CodPersona = ?";

                // Preparar la sentencia
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta
                $stmt->execute([$CodPersona]);

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

    public function actualizarPersona($CodPersona, $DNI, $Nombre, $Celular , $Email)
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "update  Persona set DNI = $DNI, NombrePersona = $Nombre , Celular = $Celular, Email = $Email
            where CodPersona = $CodPersona";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $DNI,
                    $Nombre,
                    $Celular,
                    $Email]
                    
            );

            if ($success) {
                echo "Error al actualizar la incidencia.";
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
}

