<!doctype html>
<html lang="es">

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
        <h1 class="text-2xl font-bold mb-4 ">Mantenimiento de Categoría</h1>

        <form id="formcategoria" action="mantenimiento-categoria.php?action=registrar" method="POST" class="border bg-white shadow-md p-6 w-full text-sm rounded-md">
            <!-- PRIMERA FILA Campo para mostrar el número de incidencia -->
            <div class="flex items-center mb-4">
                <label for="CodCategoria" class="block font-bold mb-1 mr-1 text-lime-500">CodCategoria:</label>
                <input type="text" id="CodCategoria" name="CodCategoria"
                    class="w-20 border border-gray-200 bg-gray-100 rounded-md p-2 text-sm" readonly disabled>
                <!-- El atributo 'readonly' evita que el usuario edite este campo -->
            </div>
            <!-- SEGUNDA fila: Categoria, Prioridad, Fecha -->      

            <!-- TERCERA fila: Área, Código Patrimonial -->
            <div class="flex flex-wrap -mx-2">
                
                <div class="w-full sm:w-1/4 px-2 mb-2">
                    <label for="DescripcionCategoria" class="block mb-1 font-bold text-sm">Descripcion Categoría:</label>
                    <input type="text" id="DescripcionCategoria" name="DescripcionCategoria"
                        class="border p-2 w-full text-sm">
                </div>
            </div>
            
            <script>
                document.getElementById('CodCategoria').value = '<?php echo $CategoriaRegistrada? $CategoriaRegistrada['CodCategoria']: ''; ?>';
                document.getElementById('DescripcionCategoria').value = '<?php echo $CategoriaRegistrada? $CategoriaRegistrada['DescripcionCategoria']: ''; ?>';

            </script>

            <!-- SEXTA fila: Descripción -->
        

            <!-- Botónes -->
            <div class="flex justify-center space-x-4">
                <button type="submit" id="guardar-categoria" class="bg-[#87cd51] text-white font-bold hover:bg-[#8ce83c] py-2 px-4 rounded">
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
                            Descripcion Categoría
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            require_once './app/models/MantCategoriaModel.php';
                            $mantCategoriaModel = new MantCategoriaModel();
                            $categorias = $mantCategoriaModel->listarCategoria();
                            foreach ($categorias as $categoria) {
                                echo "<tr class='bg-white hover:bg-green-100 hover:scale-[101%] transition-all hover:cursor-pointer border-b '>";
                                echo "<th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap 'data-categoria='" . htmlspecialchars($categoria['DescripcionCategoria']) . "'>";
                                echo $categoria['DescripcionCategoria'];
                                echo "</th>";
                                echo "<th scope='row' style='visibility: hidden' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap 'data-codcategoria='" . htmlspecialchars($categoria['CodCategoria']) . "'>";
                                echo $categoria['CodCategoria'];
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
        var cod = $(this).find('th[data-codcategoria]').data('codcategoria'); // Corrected line
        var cat = $(this).find('th[data-categoria]').data('categoria');
     
        
        $('#CodCategoria').val(cod);
        $('#DescripcionCategoria').val(cat);
        $(this).addClass('bg-blue-200 font-semibold');
        $('tr').not(this).removeClass('bg-blue-200 font-semibold');
    });
});
////////////////////

    function limpiarCampos() {
        // Obtener el formulario por su ID
        const form = document.getElementById('formcategoria');
        // Limpiar los campos del formulario
        form.reset();
    }
   const btnLimpiar = document.getElementById('limpiarCampos');
    btnLimpiar.addEventListener('click', limpiarCampos);

    function nuevoRegistro() {
        const form = document.getElementById('formcategoria');

        // Restablecer el formulario
        form.reset();
    }
    // Asignar el evento 'click' al botón 'Nuevo Registro'
    const btnNuevo = document.getElementById('nuevoRegistro');
    btnNuevo.addEventListener('click', nuevoRegistro);

    //GUARDAR DATOS
    $(document).ready(function() {
        $("#guardar-categoria").on("click", function() {
            // Obtener los datos del formulario
            var formData = $("form").serialize(); // Obtener los datos del formulario
                
            $.ajax({
                url: "mantenimiento-categoria.php", // Reemplaza "tu_archivo_de_backend.php" con tu ruta de backend
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