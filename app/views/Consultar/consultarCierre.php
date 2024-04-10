<!DOCTYPE html>
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

<body>

<!-- Contenido principal -->
<main class="bg-[#eeeff1] flex-1 p-4 overflow-y-auto">
    <!-- Header -->
    <h1 class="text-xl font-bold mb-4">Consultar Cierre</h1>
    <?php
    global $consultaCierre;
    ?>

    <!-- Formulario -->
    <div class="mb-8 mt-8">
        
        <form id="formIncidencia" action="consultar-incidencia.php?action=consultar" method="POST">
            <div class="flex flex-wrap -mx-2">
                <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-2">
                    <label for="numero_incidencia" class="block mb-1 font-bold text-sm">Nro de Cierre:</label>
                    <input type="text" id="numero_incidencia" name="numero_incidencia" class="w-full border-gray-300 rounded-md p-2 text-sm">
                </div>
                <div class="w-full md:w-1/3 px-2 mb-2">
                    <label for="area" class="block mb-1 font-bold text-sm">Área:</label>
                    <select id="area" name="area"
                            class="border p-2 w-full text-sm">
                    </select>
                </div>
                <div class="w-full sm:w-1/2 md:w-1/3 px-2 mb-2">
                    <label for="fecha" class="block mb-1 font-bold text-sm">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="w-full border-gray-300 rounded-md p-2 text-sm">
                </div>
            </div>

            <!-- Botones del formulario -->
            <div class="flex justify-center space-x-4 mt-4">
                <button type="submit" class="bg-blue-500 text-white font-bold hover:bg-[#4c8cf5] py-2 px-4 rounded">
                    Buscar
                </button>
                <button type="reset" class="bg-green-400 text-white font-bold hover:bg-gray-400 py-2 px-4 rounded">
                    Limpiar
                </button>
            </div>
        </form>
                <!-- RESULTADOS -->
    <div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-lime-300">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        N° Cierre
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Código Patrimonial
                    </th>
                    <th scope="col" class="px-8 py-3">
                        Categoría
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Prioridad
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Recepcion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Asunto
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Area
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php
                require_once './app/models/CierreModel.php'; // Asegúrate de tener el modelo correcto para la recepción
                $cierreModel = new CierreModel();

                try {
                    $cierres = $cierreModel->consultarcierre(); // Método para obtener datos de recepción desde la base de datos
                    foreach ($cierres as $cierre) 
                    {
                        echo "<tr class='bg-white hover:bg-green-100 hover:scale-[101%] transition-all hover:cursor-pointer border-b '>";
                        echo "<td class='px-6 py-4'>" . $cierre['REC_codigo'] . "</td>";
                        echo "<td id='incCodigo' class=' hidden px-6 py-4'>" . $cierre['INC_codigo'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $cierre['codigo_patrimonial'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $cierre['CAT_nombre'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $cierre['prioridad'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $cierre['REC_fecha'] . "</td>";
                        echo "<td class='px-6 py-4'>" . $cierre['INC_asunto'] . "</td>";//verificar
                        echo "<td class='px-6 py-4'>" . $cierre['ARE_nombre'] . "</td>";//verificar
                        echo "</tr>";
                    }
                } catch (Exception $e) {
                    // Manejo de la excepción, puedes mostrar un mensaje de error o realizar alguna acción específica
                    echo "Error al obtener las recepciones: " . $e->getMessage();
                }
                ?>



                </tbody>
                
            </table>
        </div>

    </div>

        
    

</main>

</body>


</html>

<script>
$(document).ready(function () {
        console.log("FETCHING")
        $.ajax({
            url: 'ajax/getAreaData.php',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                var select = $('#area');
                select.empty();
                $.each(data, function (index, value) {
                    select.append('<option value="' + value.ARE_codigo + '">' + value.ARE_nombre + '</option>');
                });
                document.getElementById('area').value = '<?php echo $consultaCierre? $consultaCierre['ARE_codigo']: ''; ?>';
            },
            error: function (error) {
                console.error(error);
            }
        });
    });
    </script>