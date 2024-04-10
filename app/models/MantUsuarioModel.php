<?php
// Importamos las credenciales y la clase de conexión
require_once 'config/conexion.php';

class MantUsuarioModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }


public function listarUsuario()
    {
        try {
            $conn = $this->conexion->getConexion();

            if ($conn != null) {
                $sql = "select CodUsuario, NombreUsuario, Password,e.CodEstado,e.NombreEstado,p.CodPersona, p.NombrePersona,r.CodRol,r.DescripcionRol from 
                Usuario u,PERSONA p, ROL r, ESTADO e
                where u.CodPersona = p.CodPersona and u.CodEstado = e.CodEstado and u.CodRol = r.CodRol";

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

    public function insertarUsuario($NombreUsuario, $Password, $CodEstado, $CodPersona, $CodRol)
    {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            // Preparar la consulta SQL para la inserción sin incluir el campo id
            $sql = "INSERT INTO Usuario (NombreUsuario,Password,CodEstado,CodPersona,CodRol)
                VALUES (?,?,?,?,?)";

            // Preparar la sentencia
            $stmt = $conn->prepare($sql);

            // Ejecutar la inserción sin proporcionar el valor para el campo id
            $success = $stmt->execute(
                [
                    $NombreUsuario, 
                    $Password, 
                    $CodEstado, 
                    $CodPersona, 
                    $CodRol]
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

    public function obtenerUsuarioPorId($CodUsuario) {
        $conn = $this->conexion->getConexion();

        if ($conn != null) {
            try {
                // Preparar la consulta SQL para obtener los registros de incidencias
                $sql = " SELECT * FROM Usuario  WHERE CodUsuario = ?";

                // Preparar la sentencia
                $stmt = $conn->prepare($sql);

                // Ejecutar la consulta
                $stmt->execute([$CodUsuario]);

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
}

