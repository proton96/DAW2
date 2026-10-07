<?php
$meses = [
    "Enero", "Febrero", "Marzo", "Abril",
    "Mayo", "Junio", "Julio", "Agosto",
    "Septiembre", "Octubre", "Noviembre", "Diciembre"
];

$diasMes = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

$diasSemana = ["Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"];

// 1 de enero es lunes
$diaSemana = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario anual</title>

    <style>
        body {
            font-family: Arial;
            text-align: center;
        }

        table {
            display: inline-table;
            margin: 15px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 7px;
            text-align: center;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .fin-semana {
            background-color: #eeeeee;
        }
    </style>
</head>
<body>

    <h1>Calendario anual</h1>

    <?php
    for ($mes = 0; $mes < 12; $mes++) {
        echo "<table>";

        // Nombre del mes
        echo "<tr><th colspan='7'>" . $meses[$mes] . "</th></tr>";

        // Días de la semana
        echo "<tr>";

        for ($i = 0; $i < 7; $i++) {
            echo "<th>" . $diasSemana[$i] . "</th>";
        }

        echo "</tr>";
        echo "<tr>";

        // Celdas vacías antes del día 1
        for ($i = 0; $i < $diaSemana; $i++) {
            echo "<td></td>";
        }

        // Días del mes
        for ($dia = 1; $dia <= $diasMes[$mes]; $dia++) {

            if ($diaSemana == 5 || $diaSemana == 6) {
                echo "<td class='fin-semana'>$dia</td>";
            } else {
                echo "<td>$dia</td>";
            }

            $diaSemana++;

            // Al terminar domingo, se crea una nueva fila
            if ($diaSemana == 7) {
                echo "</tr><tr>";
                $diaSemana = 0;
            }
        }

        // Celdas vacías para completar la última semana
        if ($diaSemana != 0) {
            while ($diaSemana < 7) {
                echo "<td></td>";
                $diaSemana++;
            }
        }

        echo "</tr>";
        echo "</table>";
    }
    ?>

</body>
</html>