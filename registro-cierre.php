<?php

$action = $_GET['action'] ?? '';
$state = $_GET['state'] ?? '';

require_once 'app/controllers/cierreController.php';
$cierreController = new cierreController();


switch ($action) {
    case 'registrar':
        $cierreController->registrarCierre();
        break;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="public/assets/logo.ico" />
    <script src="https://cdn.tailwindcss.com"></script>

  <!-- Importación de estilos -->
  <link rel="stylesheet" href="./public/styles/appMenu.css">
  <title>Sistema de Incidencias - Registro de Cierre</title>
</head>


<body class="bg-gray-100 flex items-center justify-center min-h-screen">


<div class="flex shadow-lg p-8 rounded-lg w-full sm:h-screen">
    <?php
    // Incluir la barra lateral desde un archivo externo
    include("app/Views/partials/siderBar.php");
    ?>
    <?php
    // Incluir la barra lateral desde un archivo externo
    include("app/views/Registrar/registroCierre.php");
    ?>
</div>
</body>

</html>