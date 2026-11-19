<?php
// ejercicio 1: pide un numero y saca su tabla de multiplicar

const FILAS_TABLA = 10;

// funcion para pillar el numero que ha escrito el usuario
function leerNumero(): ?int
{
    // si no han mandado el campo devuelvo null
    if (!isset($_POST['numero'])) {
        return null;
    }

    $valor = trim($_POST['numero']);

    // si esta vacio o no es un numero devuelvo null
    if ($valor === '' || !is_numeric($valor)) {
        return null;
    }

    return (int) $valor;
}

// funcion para pintar una fila de la tabla
function imprimirFila(int $numero, int $multiplicador): void
{
    $resultado = $numero * $multiplicador;

    echo "<tr>";
    echo "<td>$numero &times; $multiplicador</td>";
    echo "<td class='igual'>=</td>";
    echo "<td class='resultado'>$resultado</td>";
    echo "</tr>";
}

// funcion para pintar la tabla entera del 1 al 10
function imprimirTabla(int $numero): void
{
    echo "<table class='tabla'>";
    echo "<caption>Tabla del $numero</caption>";
    echo "<tbody>";

    for ($multiplicador = 1; $multiplicador <= FILAS_TABLA; $multiplicador++) {
        imprimirFila($numero, $multiplicador);
    }

    echo "</tbody>";
    echo "</table>";
}

// leo el numero y miro si se ha enviado el formulario
$numero = leerNumero();
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Tabla de multiplicar</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Tabla de multiplicar</h1>

    <form class="tarjeta" action="act1.php" method="post">
        <div class="campo">
            <label for="numero">Introduce un número entero</label>
            <input type="number" id="numero" name="numero" step="1" required
                value="<?php echo $numero !== null ? $numero : ''; ?>">
        </div>
        <button type="submit">Ver tabla</button>
    </form>

    <?php
    if ($hayEnvio && $numero === null) {
        echo "<p class='error'>El valor introducido no es un número válido. Inténtalo de nuevo.</p>";
    }

    if ($numero !== null) {
        imprimirTabla($numero);
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
