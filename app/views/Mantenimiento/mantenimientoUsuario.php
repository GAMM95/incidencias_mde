<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/public/assets/logo.ico">

    <!-- Importación de librería jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" 
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https:////cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Agrega las hojas de estilo de Tailwind CSS -->
    <link href="http//cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Agrega la fuente Poppins desde Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">
    <!-- Implementación de funcionalidades para la vista cliente -->
    <script src="/app/Views/Func/password-toggle.js"></script>
    <!-- Implementación de iconos-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Incluye Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <title class="text-center text-3xl font-poppins">Sistema de Incidencias</title>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Contenido principal -->
    <main class="bg-[#eeeff1] flex-1 p-4 overflow-y-auto">
    <?php
    global $UsuarioRegistrado;
    ?>
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4 ">Mantenimiento de Usuario</h1>

        <form id="formUsuario" action="mantenimiento-usuario.php?action=registrar" method="POST" class="border bg-white shadow-md p-6 w-full text-sm rounded-md">
        <!-- PRIMERA FILA Campo para mostrar el número de incidencia -->
            <div class="flex items-center mb-4">
                <label for="CodUsuario" class="block font-bold mb-1 mr-1 text-lime-500">CodUsuario:</label>
                <input type="text" id="CodUsuario" name="CodUsuario"
                    class="w-20 border border-gray-200 bg-gray-100 rounded-md p-2 text-sm" readonly disabled>
                <!-- El atributo 'readonly' evita que el usuario edite este campo -->
            </div>
            <!-- SEGUNDA fila: Categoria, Prioridad, Fecha -->
            <div class="flex flex-wrap -mx-2">
                <div class="w-full sm:w-1/4 md:w-1/3 px-2 mb-2">
                    <label for="NombreUsuario" class="block mb-1 font-bold text-sm">Usuario:</label>
                    <input type="text" id="NombreUsuario" name="NombreUsuario" class="border p-2 w-full text-sm">
                </div>
                <div class="w-full md:w-1/3 px-2 mb-3">
                    <label for="Password" class="block mb-1 font-bold text-sm">Contraseña:</label>
                    <input type="text" id="Password" name="Password" class="border p-2 w-full text-sm">
                </div>
                <div class="w-full sm:w-1/4 md:w-1/4 px-2 mb-2">
                    <label for="CodEstado" class="block mb-1 font-bold text-sm">Estado:</label>
                    <select id="CodEstado" name="CodEstado" class="border p-2 w-full text-sm">
                    </select>
                </div>
            </div>
            
            <script>
                document.getElementById('CodUsuario').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodUsuario']: ''; ?>';
                document.getElementById('NombreUsuario').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['NombreUsuario']: $NombreUsuario; ?>';
                document.getElementById('Password').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['Password']: $Password; ?>';
                document.getElementById('CodEstado').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodEstado']: $CodEstado; ?>';
            </script>

            <!-- TERCERA fila: Área, Código Patrimonial -->
            <div class="flex flex-wrap -mx-2">
                <div class="w-full sm:w-1/2 px-2 mb-2">
                    <label for="CodPersona" class="block mb-1 font-bold text-sm">Persona:</label>
                    <select id="CodPersona" name="CodPersona"
                            class="border p-2 w-full text-sm">
                    </select>
                </div>
                <div class="w-full sm:w-1/2 px-2 mb-2">
                    <label for="CodRol" class="block mb-1 font-bold text-sm">Rol:</label>
                    <select id="CodRol" name="CodRol"
                            class="border p-2 w-full text-sm">
                        <?php 
                        
                        ?>
                    </select>
                </div>
            </div>

            <script>

                document.getElementById('CodPersona').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodPersona']: $CodPersona; ?>';
                document.getElementById('CodRol').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodRol']: $CodRol; ?>';
            </script>

            <!-- Botónes -->
            <div class="flex justify-center space-x-4">
                <button type="submit" id="guardar-usuario" class="bg-[#87cd51] text-white font-bold hover:bg-[#8ce83c] py-2 px-4 rounded">
                    Guardar
                </button>
                <button type="button" class="bg-blue-500 text-white font-bold hover:bg-blue-600 py-2 px-4 rounded">
                    Editar
                </button>
                <button type="button" id="imprimirDatos" class="bg-yellow-500 text-white font-bold hover:bg-yellow-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Imprimir
                </button>
                <button type="button" id="limpiarCampos" class="bg-red-500 text-white font-bold hover:bg-red-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Limpiar
                </button>
                <button type="button" id="nuevoRegistro" class="bg-gray-500 text-white font-bold hover:bg-gray-600 py-2 px-4 rounded w-full md:w-auto mt-2 md:mt-0">
                    Nuevo
                </button>
            </div>


        </form>

        <div class="relative max-h-[300px] overflow-x-hidden shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="sticky
                        top-2 text-xs text-gray-70 uppercase bg-lime-300">
                    <tr> 
                        <th scope="col" class="px-6 py-3">
                            °
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Usuario
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Contraseña
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Persona
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Rol
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            require_once './app/models/MantUsuarioModel.php';
                            $mantUsuarioModel = new MantUsuarioModel();
                            $usuarios = $mantUsuarioModel->listarUsuario();
                            foreach ($usuarios as $usuario) {
                                echo "<tr class='bg-white hover:bg-green-100 hover:scale-[101%] transition-all hover:cursor-pointer border-b '>";
                                echo "<th scope='col' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap ' data-codusuario='" . htmlspecialchars($usuario['CodUsuario']) . "' >";
                                echo $usuario['CodUsuario'];
                                echo "</th>";
                                echo "<th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap' data-nom='" . htmlspecialchars($usuario['NombreUsuario']) . "'>";
                                echo $usuario['NombreUsuario'];
                                echo "</th>";
                                echo "<td class='px-6 py-4' data-pass='" . htmlspecialchars($usuario['Password']) . "'>";
                                echo $usuario['Password'];
                                echo "</td>";
                                echo "<td class='px-6 py-4' data-est='" . htmlspecialchars($usuario['NombreEstado']) . "'>";
                                echo $usuario['NombreEstado'];
                                echo "</td>";
                                echo "<td class='px-6 py-4' data-per='" . htmlspecialchars($usuario['NombrePersona']) . "'>";
                                echo $usuario['NombrePersona'];
                                echo "</td>";
                                echo "<td  class='px-6 py-4' data-rol='" . htmlspecialchars($usuario['DescripcionRol']) . "'>";
                                echo $usuario['DescripcionRol'];
                                echo "</td>";

                                echo "<td  style='visibility: hidden'  data-codest='" . htmlspecialchars($usuario['CodEstado']) . "'>";
                                echo $usuario['CodEstado'];
                                echo "</td>";
                                echo "<td style='visibility: hidden'  data-codper='" . htmlspecialchars($usuario['CodPersona']) . "'>";
                                echo $usuario['CodPersona'];
                                echo "</td>";
                                echo "<td style='visibility: hidden'  data-codrol='" . htmlspecialchars($usuario['CodRol']) . "'>";
                                echo $usuario['CodRol'];
                                echo "</td>";
                             
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
        var codusu = $(this).find('th[data-codusuario]').data('codusuario');
        var usuario = $(this).find('th[data-nom]').data('nom');
        var pass = $(this).find('td[data-pass]').data('pass'); // Corrected line
        var est = $(this).find('td[data-codest]').data('codest'); // Corrected line
        var per = $(this).find('td[data-codper]').data('codper'); // Corrected line
        var rol = $(this).find('td[data-codrol]').data('codrol'); // Corrected line
        
        $('#CodUsuario').val(codusu);
        $('#NombreUsuario').val(usuario);
        $('#Password').val(pass);
        $('#CodEstado').val(est);
        $('#CodPersona').val(per);
        $('#CodRol').val(rol);
        $(this).addClass('bg-blue-200 font-semibold');
        $('tr').not(this).removeClass('bg-blue-200 font-semibold');
    });
});

////////////////////////
    $(document).ready(function () {
        console.log("FETCHING")
        $.ajax({
            url: 'ajax/getEstado.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var select = $('#CodEstado');
                select.empty();
                $.each(data, function (index, value) {
                    select.append('<option value="' + value.CodEstado + '">' + value.NombreEstado + '</option>');
                });
                document.getElementById('CodEstado').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodEstado']: ''; ?>';

            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $(document).ready(function () {
        console.log("FETCHING")
        $.ajax({
            url: 'ajax/getPersona.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var select = $('#CodPersona');
                select.empty();
                $.each(data, function (index, value) {
                    select.append('<option value="' + value.CodPersona + '">' + value.NombrePersona + '</option>');
                });
                document.getElementById('CodPersona').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodPersona']: ''; ?>';

            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    $(document).ready(function () {
        console.log("FETCHING")
        $.ajax({
            url: 'ajax/getRol.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var select = $('#CodRol');
                select.empty();
                $.each(data, function (index, value) {
                    select.append('<option value="' + value.CodRol + '">' + value.DescripcionRol + '</option>');
                });
                document.getElementById('CodRol').value = '<?php echo $UsuarioRegistrado? $UsuarioRegistrado['CodRol']: ''; ?>';

            },
            error: function (error) {
                console.error(error);
            }
        });
    });





    function limpiarCampos() {
        // Obtener el formulario por su ID
        const form = document.getElementById('formUsuario');
        // Limpiar los campos del formulario
        form.reset();
    }
   const btnLimpiar = document.getElementById('limpiarCampos');
    btnLimpiar.addEventListener('click', limpiarCampos);

    function nuevoRegistro() {
        const form = document.getElementById('formUsuario');

        // Restablecer el formulario
        form.reset();
    }
    // Asignar el evento 'click' al botón 'Nuevo Registro'
    const btnNuevo = document.getElementById('nuevoRegistro');
    btnNuevo.addEventListener('click', nuevoRegistro);

    //GUARDAR DATOS
    $(document).ready(function() {
        $("#guardar-usuarios").on("click", function() {
            // Obtener los datos del formulario
            var formData = $("form").serialize(); // Obtener los datos del formulario

            $.ajax({
                url: "mantenimiento-usuario.php", // Reemplaza "tu_archivo_de_backend.php" con tu ruta de backend
                type: "POST",
                data: formData,
                success: function(response) {
                    // Manejar la respuesta del servidor si es necesario
                    alert("Datos guardados exitosamente");
                    // Puedes limpiar el formulario si lo deseas
                    $("form")[0].reset();
                },
                error: function(xhr, status, error) {
                    // Manejar los errores si la solicitud falla
                    console.error(error);
                    alert("Error al guardar los datos. Por favor, inténtalo de nuevo.");
                }
            });
        });
    });
    </script>

</html>
