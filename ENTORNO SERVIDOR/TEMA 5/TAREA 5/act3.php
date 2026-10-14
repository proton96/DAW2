<?php

/*Hacer lo mismo que el ejercicio anterior, pero en caso lo que reciben son nombres 
de clases CSS definidas previamente (con los estilos que queráis). El objetivo es 
aplicar a cada fila de la tabla uno de los estilos que se pasan como parámetro.  */



function generarTablaColores(array $clases): void
{
    echo "<table border='1' style='width: 100%; text-align: center;'>";

    foreach ($clases as $clase) {
        echo "<tr class='$clase' style='height: 50px;'>";
        echo "<td>$clase</td>";
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
    <title>Actividad 3</title>
    <!-- CSS: -->
    <style>
        .rojo {
            background-color: #FF5733;
            color: white;
        }

        .verde {
            background-color: #335422;
            color: white;
        }

        .azul {
            background-color: #4287f5;
            color: white;
        }

        table {
            border-collapse: collapse;
        }

        td {
            padding: 10px;
        }
    </style>
</head>
<body>

    <h1>Tabla de Colores</h1>

    <?php
    // Definimos un array con nombres de clases CSS
    $clasesCSS = ['rojo', 'verde', 'azul'];

    // Llamamos a la función para generar la tabla con las clases CSS
    generarTablaColores($clasesCSS);
    ?>
</body>
</html>


