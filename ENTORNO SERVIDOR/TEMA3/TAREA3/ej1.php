<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas de multiplicar</title>

    <style>
        table {
            border-collapse: collapse;
            margin: 20px;
            display: inline-table;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: lightgray;
        }
    </style>
</head>
<body>

    <h1>Tablas de multiplicar</h1>

    <?php
    for ($tabla = 1; $tabla <= 10; $tabla++) {
        echo "<table>";
        echo "<tr><th colspan='2'>Tabla del $tabla</th></tr>";
        echo "<tr><th>Operación</th><th>Resultado</th></tr>";

        for ($numero = 1; $numero <= 10; $numero++) {
            $resultado = $tabla * $numero;

            echo "<tr>";
            echo "<td>$tabla x $numero</td>";
            echo "<td>$resultado</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>

</body>
</html>