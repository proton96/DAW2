<?php

    $alumnos = [
    "Antonio" => [
        "Matemáticas" => 5,
        "Lengua" => 8.3,
        "Ciencias Naturales" => 9,
        "Geografía" => 7
    ],
    "Ana" => [
        "Matemáticas" => 8,
        "Lengua" => 7,
        "Ciencias Naturales" => 4.5,
        "Geografía" => 9
    ],
    "Benito" => [
        "Matemáticas" => 9,
        "Lengua" => 6.75,
        "Ciencias Naturales" => 9,
        "Geografía" => 3.1
    ],
    "Lucía" => [
        "Matemáticas" => 7,
        "Lengua" => 8,
        "Ciencias Naturales" => 6,
        "Geografía" => 9
    ],
    "Pedro" => [
        "Matemáticas" => 6,
        "Lengua" => 5.5,
        "Ciencias Naturales" => 7,
        "Geografía" => 8
    ]
];

    // Simular el nombre introducido por el profesor
    $alumnoBuscado = "Ana";

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de alumnos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 650px;
            border-collapse: collapse;
            font-size: 14px;
        }

        th,
        td {
            padding: 6px 8px;
            border: 1px solid #eeeeee;
            text-align: center;
        }

        thead th {
            background-color: #8064a2;
            color: #222222;
        }

        thead th:first-child {
            text-align: left;
        }

        tbody th {
            background-color: #8064a2;
            color: white;
            text-align: left;
        }

        tbody tr:nth-child(odd) td {
            background-color: #d9d9d9;
        }

        tbody tr:nth-child(even) td {
            background-color: white;
        }
    </style>
</head>

<body>
    <h1>Notas del grupo</h1>

    <table>
        <thead>
            <tr>
                <th scope="col">Alumno</th>
                <th scope="col">Matemáticas</th>
                <th scope="col">Lengua</th>
                <th scope="col">Ciencias<br>Naturales</th>
                <th scope="col">Geografía</th>
                <th scope="col">Media</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($alumnos as $nombre => $notas): ?>
                <?php
                $media = array_sum($notas) / count($notas);
                ?>

                <tr>
                    <th scope="row">
                        <?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?>
                    </th>

                    <?php foreach ($notas as $nota): ?>
                        <td>
                            <?= str_replace('.', ',', (string) $nota) ?>
                        </td>
                    <?php endforeach; ?>

                    <td>
                        <?= number_format($media, 3, ',', '') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>