<?php
$alumnos = [
    "Ana" => 4,
    "Luis" => 5,
    "Marta" => 6,
    "Carlos" => 7,
    "Lucía" => 8,
    "Pablo" => 9,
    "Elena" => 10
];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Notas de alumnos</title>

    <style>
        table {
            border-collapse: collapse;
            width: 400px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #2f5d50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #e8f0ec;
        }
    </style>
</head>

<body>

    <h1>Notas de los alumnos</h1>

    <table>
        <tr>
            <th>Alumno</th>
            <th>Nota</th>
            <th>Calificación</th>
        </tr>

        <?php
        foreach ($alumnos as $nombre => $nota) {

            if ($nota >= 0 && $nota <= 4) {
                $calificacion = "Suspenso";
            } elseif ($nota == 5) {
                $calificacion = "Aprobado";
            } elseif ($nota == 6) {
                $calificacion = "Bien";
            } elseif ($nota == 7 || $nota == 8) {
                $calificacion = "Notable";
            } elseif ($nota == 9) {
                $calificacion = "Sobresaliente";
            } elseif ($nota == 10) {
                $calificacion = "Matrícula de honor";
            } else {
                $calificacion = "Nota no válida";
            }

            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>$nota</td>";
            echo "<td>$calificacion</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>