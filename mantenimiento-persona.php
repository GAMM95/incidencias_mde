<?php
$action = $_GET['action'] ?? '';
$state = $_GET['state'] ?? '';
$CodPersona = $_GET['CodPersona'] ?? '';

require_once 'app/controllers/MantPersonaController.php';
$mantPersonaController = new MantPersonaController();
$mantPersonaModel = new MantPersonaModel();

if ($CodPersona != '') {
  global $PersonaRegistrada;
  $PersonaRegistrada = $mantPersonaModel->obtenerPersonaPorId($CodPersona);

} else {
  $PersonaRegistrada = null;
}


switch ($action) {
    case 'registrar':
        $mantPersonaController->registrarPersona();
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

  <title>Sistema de Incidencias - Mantenimiento Persona</title>
</head>


<body class="bg-gray-100 flex items-center justify-center min-h-screen">


<div class="flex shadow-lg p-8 rounded-lg w-full sm:h-screen">
    <?php
    // Incluir la barra lateral desde un archivo externo
    include("app/Views/partials/siderBar.php");
    ?>
    <?php
    // Incluir la barra lateral desde un archivo externo
    include("app/views/Mantenimiento/mantenimientoPersona.php");
    ?>
</div>
</body>

</html>