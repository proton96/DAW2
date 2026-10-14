<?php
/*Crear una función que reciba un array asociativo con las posiciones: nombre, 
apellidos, nota1, nota2, nota3. La función devolverá un código HTML (a vuestra 
discreción) con el boletín oficial de las notas de dicho alumno, mostrando la nota 
final (calculada como la media de las 3 notas).*/

$alumno = [
    'nombre' => 'Juan',
    'apellidos' => 'Pérez García',
    'nota1' => 8,
    'nota2' => 7,
    'nota3' => 9
];

function generarBoletin(array $alumno): string
{
    $nombreCompleto = $alumno['nombre'] . ' ' . $alumno['apellidos'];

    $notaFinal = (
        $alumno['nota1'] + $alumno['nota2'] + $alumno['nota3']
    ) / 3;

    $html = "<h2>$nombreCompleto</h2>";

    $html .= "<table border='1'>";

    $html .= "<tr>";
    $html .= "<th>Evaluación</th>";
    $html .= "<th>Calificación</th>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td>Nota 1</td>";
    $html .= "<td>" . $alumno['nota1'] . "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td>Nota 2</td>";
    $html .= "<td>" . $alumno['nota2'] . "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<td>Nota 3</td>";
    $html .= "<td>" . $alumno['nota3'] . "</td>";
    $html .= "</tr>";

    $html .= "<tr>";
    $html .= "<th>Nota final</th>";
    $html .= "<td>$notaFinal</td>";
    $html .= "</tr>";

    $html .= "</table>";

    return $html;
}



?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 4</title>
</head>

<body>
    <h1>Boletín oficial de notas</h1>

    <?php
    echo generarBoletin($alumno);
    ?>

</body>

</html>