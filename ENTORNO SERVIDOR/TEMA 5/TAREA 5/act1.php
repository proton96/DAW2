<?php
/* Programar  una  función  PHP  que  pida  un  nombre  completo  y  sus  calificaciones
(sobresaliente, notable, aprobado, etc) de matemáticas, lengua, historia y dibujo en
forma de array asociativo. El resultado debe ser un código HTML que muestre este
boletín de notas.*/


function generarBoletin(array $alumnos): void
{
    foreach ($alumnos as $nombre => $calificaciones) {
        echo "<h2>$nombre</h2>";
        echo "<ul>";

        foreach ($calificaciones as $asignatura => $calificacion) {
            echo "<li>$asignatura: $calificacion</li>";
        }

        echo "</ul>";
    }
}

$alumnos = [
    'Juan Pérez' => [
        'Matemáticas' => 'Sobresaliente',
        'Lengua' => 'Notable',
        'Historia' => 'Aprobado',
        'Dibujo' => 'Notable'
    ],

    'María López' => [
        'Matemáticas' => 'Notable',
        'Lengua' => 'Sobresaliente',
        'Historia' => 'Notable',
        'Dibujo' => 'Aprobado'
    ],

    'Carlos García' => [
        'Matemáticas' => 'Aprobado',
        'Lengua' => 'Aprobado',
        'Historia' => 'Notable',
        'Dibujo' => 'Sobresaliente'
    ],

    'Ana Martínez' => [
        'Matemáticas' => 'Sobresaliente',
        'Lengua' => 'Notable',
        'Historia' => 'Sobresaliente',
        'Dibujo' => 'Notable'
    ]
];
?>






?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 1</title>
</head>

<body>
    <h1>Boletín de Notas</h1>
    <?php
    generarBoletin($alumnos);
    ?>

</body>

</html>