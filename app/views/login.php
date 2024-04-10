<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="public/assets/logo.ico">

  <!-- Importación de librería jQuery -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script src="https:////cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <!-- Agrega las hojas de estilo de Tailwind CSS -->
  <link href="http
  //cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Agrega la fuente Poppins desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
  <!-- Implementación de funcionalidades para la vista cliente -->
  <script src="app/Views/Func/password-toggle.js"></script>
  <!-- Implementación de iconos-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title class="text-center text-3xl font-poppins">Sistema de Incidencias - Login</title>
</head>

<body>
  <!-- Contenedor principal de la página de inicio de sesión -->
  <div class="flex justify-center items-center h-screen">
    <div class="container-login bg-gray-200 p-5 rounded-3xl shadow-lg flex w-full max-w-screen-lg mr-2 ml-2">
      <!-- Panel de logo MDE -->
      <div class="w-1/2 relative hidden md:block">
      
        <img src="public/assets/image.png" alt="imagen de mde" class="img_logo_login mx-auto max-w-xs m-6 p-6">
        <div class="headerDiv text-center">
          <h3 class="text-2xl font-bold p-2 text-gray-900 pb-10 font-poppins">Municipalidad de la Esperanza</h3>
        </div>
      </div>

      <!-- Panel del formulario -->
      <div class="formDiv w-full md:w-1/2 p-4 justify-center items-center mx-auto">
        <!-- Encabezado y logo -->
        <div class="headerDiv text-center">
          <h3 class="text-2xl font-bold p-2 text-gray-900 pb-10 font-poppins">Sistema de Gestion de Incidencias</h3>
        </div>

        <!-- Formulario de inicio de sesión -->
        <form action="index.php?action=login" method="POST" class="form w-full max-w-sm mx-auto">
          <!-- Campos de entrada para usuario y contraseña -->
          <div class="inputDiv mb-4">
            <label for="username" class="block text-lg text-gray-600 font-lig mb-2">Usuario</label>
            <div class="input bg-white flex items-center border rounded-2xl p-2">
              <i class='bx bxs-user icon-input icon text-gray-400 text-lg mr-2'></i>
              <input type='text' id='username' placeholder='Ingrese su usuario' name='username' required autofocus class="w-full outline-none text-lg font-poppins">
            </div>
          </div>
          <div class="inputDiv mb-4">
            <label for="password" class="block text-lg text-gray-600 font-regular mb-2">Contraseña</label>
            <div class="input bg-white flex items-center border rounded-2xl p-2">
              <i class="bx bxs-lock icon-input icon text-gray-400 text-lg mr-2"></i>
              <input type="password" id="password" placeholder="Ingrese su contraseña" name="password" required class="w-full outline-none text-lg font-poppins">
              <!-- Icono para mostrar/ocultar contraseña -->
              <div id="togglePassword" class="show-hide-link icon cursor-pointer">
                <i class="bx bx-show icon text-gray-400 text-lg"></i>
              </div>
            </div>
          </div>


          <!-- Botón de inicio de sesión -->
          <button type='submit' class='btn btn-form w-full py-2 bg-[#87cd51] text-white rounded-lg hover:bg-[#BDF094]' name='btnIniciarSesion' content='Iniciar Sesi&oacute;n'>
            <span class="text-xl">Iniciar Sesi&oacute;n</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>