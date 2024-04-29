<!doctype html>
<html lang="es">

<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/public/assets/logo.ico">

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
  <!-- Incluye Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
  <title class="text-center text-3xl font-poppins">Sistema de Incidencias</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <!-- Sidebar -->
  <aside class="bg-white text-gray-800 w-60 flex flex-col shadow-md overflow-y-auto">
    <!-- Logo o Imagen (escudo) -->
    <div class="flex items-center justify-center h-20 ">
      <img src="public/assets/image.png" alt="Escudo" class="h-28 w-28 absolute top-16 left-24">
    </div>

    <!-- Etiquetas con submenús -->
    <nav class="flex-1 mt-20">
      <a href="pagina-inicio.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Inicio</a>
      <!-- Etiqueta con submenú: Consultar -->
      <div x-data="{ open: false }">
        <div x-data="{ open: false }">
          <button @click="open = !open" class="block py-2 px-4 hover:bg-[#d5fab4]  flex justify-between w-full">
            Registrar
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path x-show="!open" fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 1.414L4 12l2.707 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
              <path x-show="open" fill-rule="evenodd" clip-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414-1.414L16 8l-2.707-2.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4z" />
            </svg>
          </button>
          <div x-show="open" class="pl-4">
            <a href="registro-incidencia.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Incidencia</a>
            <a href="registro-recepcion.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Recepción</a>
            <a href="registro-cierre.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Cierre</a>
          </div>
        </div>

      </div>
      <div x-data="{ open: false }">
        <button @click="open = !open" class="block py-2 px-4 hover:bg-[#d5fab4]  flex justify-between w-full">
          Consultar
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path x-show="!open" fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 1.414L4 12l2.707 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
            <path x-show="open" fill-rule="evenodd" clip-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414-1.414L16 8l-2.707-2.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4z" />
          </svg>
        </button>
        <div x-show="open" class="pl-4">
          <a href="consultar-incidencia.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Incidencia</a>
          <a href="consultar-recepcion.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Recepción</a>
          <a href="consultar-cierre.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Cierre</a>
        </div>
      </div>
      <!-- Etiqueta: Mantenimiento -->
      <div x-data="{ open: false }">
        <button @click="open = !open" class="block py-2 px-4 hover:bg-[#d5fab4]  flex justify-between w-full">
          Mantenimiento
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path x-show="!open" fill-rule="evenodd" clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 1.414L4 12l2.707 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" />
            <path x-show="open" fill-rule="evenodd" clip-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414-1.414L16 8l-2.707-2.293a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4z" />
          </svg>
        </button>
        <div x-show="open" class="pl-4">
          <a href="mantenimiento-persona.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Persona</a>
          <a href="mantenimiento-usuario.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Usuario</a>
          <a href="mantenimiento-area.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Área</a>
          <a href="mantenimiento-rol.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Rol</a>
          <a href="mantenimiento-categoria.php" class="block py-2 px-4 hover:bg-[#d5fab4] ">Categoria</a>
        </div>
      </div>
    </nav>
    <!-- Usuario -->
    <div class="py-4 px-4 border-t border-gray-300">
      <img src="public/assets/usuario.png" alt="Imagen de usuario" class="h-10 w-10 rounded-full mx-auto">
      <p class="text-center text-sm font-semibold"><?php echo $_SESSION['nombreDePersona']; ?></p>
    </div>



    <!-- Botón Cerrar Sesión -->
    <div class="py-4 px-4 border-t border-gray-300">
      <button class="w-full text-white bg-[#87cd51] hover:bg-[#b1f774] font-bold py-2 px-4 rounded ">

        <a href="logout.php">Cerrar Sesión </a>
      </button>
    </div>
  </aside>


</body>

</html>