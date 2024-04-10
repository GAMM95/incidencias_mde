<?php
require_once 'app/models/UsuarioModel.php';
class LoginController{
    public function mostrarFormularioLogin(){
        require_once 'app/views/login.php';
    }
    public function iniciarSesion($username,$password){

            $usuarioModel=new UsuarioModel();

            if ($usuarioModel->iniciarSesion($username, $password)) {
                $usuarioModel->redireccionSegunRol($username);
            } else {
                // Si el inicio de sesión falla, vuelve cierreController mostrar el formulario de inicio de sesión con un mensaje de error
                $error = "Credenciales incorrectas. Por favor, intenta de nuevo.";
                include('app/views/login.php');
            }
    }
}