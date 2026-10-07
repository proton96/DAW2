<?php
$numeros = [3, 8, 7, -6];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tabla de números</title>
</head>

<body>

    <table border="1">
        <tr>
            <th>Número</th>
            <th>Cuadrado</th>
            <th>Cubo</th>
        </tr>

        <?php
        foreach ($numeros as $numero) {
            $cuadrado = $numero * $numero;
            $cubo = $numero * $numero * $numero;

            echo "<tr>";
            echo "<td>$numero</td>";
            echo "<td>$cuadrado</td>";
            echo "<td>$cubo</td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>