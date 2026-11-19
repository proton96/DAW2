<?php
// aqui cargo los archivos con las preguntas, las funciones y las plantillas html
require_once 'preguntas.php';
require_once 'funciones.php';
require_once 'plantillas.php';

// recojo lo que haya enviado el usuario por el formulario
$respuestas = leerRespuestas($preguntas);
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';

// si ha enviado el formulario, corrijo el examen
$correccion = $hayEnvio ? corregirTest($preguntas, $respuestas) : null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Miniproyecto - El gran test del café</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <div class="contenedor">
        <?php
        // pinto la cabecera arriba del todo
        imprimirCabecera($preguntas);

        // si han enviado el formulario muestro la nota y los fallos
        if ($correccion !== null) {
            // si se ha dejado preguntas en blanco le pongo un aviso arriba
            if ($correccion['sin_contestar'] > 0) {
                imprimirAviso("Atención: has dejado " . $correccion['sin_contestar'] . " pregunta(s) sin contestar.");
            }

            // pinto la nota y el resultado
            imprimirResultado($correccion);

            // pinto las preguntas que ha fallado con la respuesta correcta
            imprimirRevision($correccion);

            // pongo el boton para volver a hacer el test
            imprimirBotonRepetir();
        } else {
            // si no se ha enviado nada, muestro el formulario con las preguntas
            imprimirFormulario($preguntas, $respuestas);
        }
        ?>

        <!-- enlace para volver a los ejercicios del tema 6 -->
        <div class="volver-caja">
            <a class="volver" href="../EJERCICIOS/index.html">&larr; Volver al índice de ejercicios</a>
        </div>
    </div>
</body>

</html>
