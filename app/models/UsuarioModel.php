<?php
//Lo relaciona con el archivo de conexion de la bd
require_once 'config/conexion.php';
//Esta clase maneja la autenticacion y los roles
class UsuarioModel
{
    private $db; //Almacena la conexion cierreController la bd
    protected $usuario;
    protected $password;

    //Método constructor: Estable la conexion cierreController la bd
    public function __construct()
    {
        $this->db = (new Conexion())->getConexion();
    }

    //Método para iniciar sesión
    public function iniciarSesion($username, $password)
    {
        $this->usuario = $username;
        $this->password = $password;
        $query = "EXEC SP_Usuario_login :username, :password"; //Procedimiento almacenado para la autenticacion
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $this->usuario);
        $stmt->bindParam(':password', $this->password);
        $stmt->execute();

        $resultado = $stmt->fetch(); // Obtiene el resultado de la autenticación

        $logData = "SP Result: " . $resultado;
        file_put_contents('logs/log.txt', $logData . PHP_EOL, FILE_APPEND);

        if ($resultado) {
            // Inicio de sesión exitoso, almacenamos la informacion del usuario
            session_start();


            $_SESSION['nombreDePersona'] = $resultado['NombrePersona'];
            $informacionUsuario = $this->obtenerInformacionUsuario($username, $password);
            $codigo = $informacionUsuario['codigo'];
            $usuario = $informacionUsuario['usuario'];
            $_SESSION['codigoUsuario'] = $codigo;
            $_SESSION['usuario'] = $usuario;

            $logStart = "------- START LOGIN LOGS ---------";
            file_put_contents('logs/log.txt', $logStart . PHP_EOL, FILE_APPEND);
            $sessionLogData = "Session Contents: " . print_r($_SESSION, true);
            file_put_contents('logs/log.txt', $sessionLogData . PHP_EOL, FILE_APPEND);
            $userLogData = "Código de Usuario: " . $codigo . ", Nombre de Persona: " . $resultado['NombrePersona'];
            file_put_contents('logs/log.txt', $userLogData . PHP_EOL, FILE_APPEND);

            return true;
        }
        return false;

    }

    private function obtenerInformacionUsuario($username, $password)
    {
        $consulta = "SELECT CodUsuario as codigo, NombreUsuario as usuario FROM USUARIO u WHERE NombreUsuario = :username AND Password = :password";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $fila = $stmt->fetch();

        if ($fila) {
            $logData = "INFORMACION USUARIO Result: " . $fila;
            file_put_contents('logs/log.txt', $logData . PHP_EOL, FILE_APPEND);
            return $fila;
        } else {
            return null;
        }

    }

    public function obtenerRol($username)
    {
        $consulta="SELECT  DescripcionRol as rol
        FROM USUARIO u
        INNER JOIN ROL r ON r.CodRol = u.CodRol 
        WHERE NombreUsuario = :username";
        $stmt = $this->db->prepare($consulta);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $fila = $stmt->fetch();

        if ($fila) {
            return $fila['rol']; // Devuelve el rol del usuario
        } else {
            return null; // El usuario no existe o no tiene un rol asignado
        }
    }
    public function redireccionSegunRol($username)
    {
        $rol = $this->obtenerRol($username);
        if($rol ==='Administrador'){
            //Redirige al panel de administrador
            header('Location: pagina-inicio.php');
        }elseif ($rol === 'Trabajador'){
            header('Location:pagina-inicio.php');
        }else{
            //No se redirige
        }
    }
}
