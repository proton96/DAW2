<?php
/* Crear  una  función  PHP  que  reciba  3  códigos  de  colores.  La  función  generará  el 
código de  una  tabla  con 3 filas.  Cada fila  tendrá de fondo dicho  color.  Hazlo  con 
estilos en línea. */




function generarTablaColores(array $colores): void
{
    echo "<table border='1' style='width: 100%; text-align: center;'>";

    foreach ($colores as $color) {
        echo "<tr style='background-color: $color; height: 50px;'>";
        echo "<td>$color</td>";
        echo "</tr>";
    }

    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
</head>
<body>
    <h1>Tabla de Colores</h1>
    <?php
    $colores = ['#FF5733', '#335422', '#4287f5'];
    generarTablaColores($colores);
    ?>
</body>
</html>