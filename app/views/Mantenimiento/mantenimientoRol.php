<!doctype html>
<html lang="es">
<?php 
include "";
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="public/assets/logo.ico">

    <!-- Importación de librería jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Agrega las hojas de estilo de Tailwind CSS -->
    <link href="http//cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

    <!-- Contenido principal -->
    <main class="bg-[#eeeff1] flex-1 p-4 overflow-y-auto">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4 ">Mantenimiento de Rol</h1>

        <form id="formRol"  method="POST" class="border bg-white shadow-md p-6 w-full text-sm rounded-md">
            <!-- PRIMERA FILA Campo para mostrar el número de incidencia -->
            

            <div class="flex items-center mb-4">
                <label for="CodRol" class="block font-bold mb-1 mr-1 text-lime-500">CodRol:</label>
                <input type="text" id="CodRol" name="CodRol"
                    class="w-20 border border-gray-200 bg-gray-100 rounded-md p-2 text-sm" readonly disabled>
                <!-- El atributo 'readonly' evita que el usuario edite este campo -->
            </div>
            <!-- SEGUNDA fila: Categoria, Prioridad, Fecha -->      

            <div class="flex flex-wrap -mx-2">              
                <div class="w-full sm:w-1/4 px-2 mb-2">
                    <label for="DescripcionRol" class="block mb-1 font-bold text-sm">Descripcion Rol:</label>
                    <input type="text" id="DescripcionRol" name="DescripcionRol"
                        class="border p-2 w-full text-sm">
                </div>
            </div>
            
            <script>
                document.getElementById('CodRol').value = '<?php echo $PersonaRegistrada? $PersonaRegistrada['CodRol']: ''; ?>';
                document.getElementById('DescripcionRol').value = '<?php echo $PersonaRegistrada? $PersonaRegistrada['DescripcionRol']: ''; ?>';
            </script>

            <!-- Botónes -->
            <div class="flex justify-center space-x-4">
                <button type="submit" name="guardar" class="bg-[#87cd51] text-white font-bold hover:bg-[#8ce83c] py-2 px-4 rounded">
                    Guardar
                </button>
                <button type="button" id="editar-persona" class="bg-blue-500 text-white font-bold hover:bg-blue-600 py-2 px-4 rounded">
                    Editar
                </button>
                <button type="button" id="imprimirDatos" class="bg-yellow-500 text-white font-bold hover:bg-yellow-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Imprimir
                </button>
                <button type="button" id="limpiarCampos" class="bg-red-500 text-white font-bold hover:bg-red-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Limpiar
                </button>
                <button type="button" id="eliminarRegistro" class="bg-gray-500 text-white font-bold hover:bg-gray-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Eliminar
                </button>
            </div>
        </form>  

        <?php 
        if(isset($_POST['guardar']))
        $rol = $_POST['DescripcionRol'];

        $insertar = "insert into Rol(DescripcionRol) values ('$rol')";
        $ejecutar = sqlsrv_query($)
        ?>


            <div class="relative max-h-[300px] overflow-x-hidden shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="sticky
                        top-2 text-xs text-gray-70 uppercase bg-lime-300">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Descripcion Rol
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            require_once './app/models/MantRolModel.php';
                            $mantRolModel = new MantRolModel();
                            $roles = $mantRolModel->listarRol();
                            foreach ($roles as $rol) {
                                echo "<tr class='bg-white hover:bg-green-100 hover:scale-[101%] transition-all hover:cursor-pointer border-b '>";
                                echo "<th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap ' data-rol='" . htmlspecialchars($rol['DescripcionRol']) . "'>";
                                echo $rol['DescripcionRol'];
                                echo "</th>";
                                echo "<th scope='row' style='visibility: hidden' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap ' data-codrol='" . htmlspecialchars($rol['CodRol']) . "'>";
                                echo $rol['CodRol'];
                                echo "</th>";
                             
                                echo "</tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </div>
    </main>

</body>
<script>
$(document).ready(function () {
    $('tr').click(function () {
        var cod = $(this).find('th[data-codrol]').data('codrol'); // Corrected line
        var rol = $(this).find('th[data-rol]').data('rol');
     
        $('#CodRol').val(cod);
        $('#DescripcionRol').val(rol);
        $(this).addClass('bg-blue-200 font-semibold');
        $('tr').not(this).removeClass('bg-blue-200 font-semibold');
    });
});
////////////////////////////////////
    function limpiarCampos() {
        // Obtener el formulario por su ID
        const form = document.getElementById('formRol');
        // Limpiar los campos del formulario
        form.reset();
    }
   const btnLimpiar = document.getElementById('limpiarCampos');
    btnLimpiar.addEventListener('click', limpiarCampos);

    
   
    </script>
</html>

