<?php

$ciudades = [
    "Granada" => 150000,
    "Madrid" => 3000000,
    "Barcelona" => 2879200,
    "Malaga" => 240000,
    "Sevilla"   => 500000,
    "Valencia"  => 1584600,
    "Tarragona" => 485210,

];


    //Ordenar alfabéticamente por nombre de ciudad
    $ordenAlfabetico = $ciudades;
    ksort($ordenAlfabetico);


    //Ordenar por poblacion de menor a mayor
    $ordenPoblacion = $ciudades;
    asort($ordenPoblacion);

    //Obtener las ciudades con menor y mayor poblacion.

    $mayorPoblacion = max($ciudades);
    $ciudadMayorPoblacion = array_search($mayorPoblacion, $ciudades);


    $menorPoblacion = min($ciudades);
    $ciudadMenorPoblacion = array_search($menorPoblacion, $ciudades);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ciudades y población</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 400px;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #b7cb92;
            padding: 5px 8px;
            text-align: left;
        }

        th {
            background-color: #9bbb59;
            color: white;
        }

        tbody tr:nth-child(odd) {
            background-color: #e6eed8;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        td:first-child {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Ciudad(nombre_posición)</th>
                <th>Población<br>(contenido)</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($ciudades as $ciudad => $poblacion): ?>
                <tr>
                    <td><?= htmlspecialchars($ciudad, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= $poblacion ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>