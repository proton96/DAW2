<?php
// ejercicio 2: elegir tabla en un desplegable y color con botones de radio

const FILAS_TABLA = 10;
const TABLAS_DISPONIBLES = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// lista de colores disponibles con su codigo
const COLORES = [
    'rojo' => '#b91c1c',
    'azul' => '#1d4ed8',
    'verde' => '#15803d',
    'naranja' => '#c2410c'
];

// funcion para sacar la tabla que ha elegido
function leerTabla(): ?int
{
    if (!isset($_POST['tabla']) || !is_numeric($_POST['tabla'])) {
        return null;
    }

    $tabla = (int) $_POST['tabla'];

    return in_array($tabla, TABLAS_DISPONIBLES, true) ? $tabla : null;
}

// funcion para pillar el color elegido
function leerColor(): ?string
{
    if (!isset($_POST['color']) || !is_string($_POST['color'])) {
        return null;
    }

    // compruebo que el color este en la lista de permitidos
    return array_key_exists($_POST['color'], COLORES) ? $_POST['color'] : null;
}

// pinta una fila con el color que nos piden
function imprimirFila(int $tabla, int $multiplicador, string $codigoColor): void
{
    $resultado = $tabla * $multiplicador;

    echo "<tr style='color: $codigoColor'>";
    echo "<td>$tabla &times; $multiplicador</td>";
    echo "<td class='igual'>=</td>";
    echo "<td class='resultado'>$resultado</td>";
    echo "</tr>";
}

// pinta toda la tabla con el color elegido
function imprimirTabla(int $tabla, string $codigoColor): void
{
    echo "<table class='tabla'>";
    echo "<caption style='background: $codigoColor'>Tabla del $tabla</caption>";
    echo "<tbody>";

    for ($multiplicador = 1; $multiplicador <= FILAS_TABLA; $multiplicador++) {
        imprimirFila($tabla, $multiplicador, $codigoColor);
    }

    echo "</tbody>";
    echo "</table>";
}

// opciones para el desplegable
function imprimirOpcionesTabla(?int $tablaElegida): void
{
    foreach (TABLAS_DISPONIBLES as $numero) {
        $seleccionada = $numero === $tablaElegida ? ' selected' : '';
        echo "<option value='$numero'$seleccionada>Tabla del $numero</option>";
    }
}

// botones de radio para los colores
function imprimirOpcionesColor(?string $colorElegido): void
{
    foreach (COLORES as $nombre => $codigo) {
        $marcado = $nombre === $colorElegido ? ' checked' : '';
        echo "<label class='opcion' style='border-color: $codigo; color: $codigo'>";
        echo "<input type='radio' name='color' value='$nombre'$marcado required>";
        echo ucfirst($nombre);
        echo "</label>";
    }
}

// pillo la tabla y el color y veo si se ha enviado el formulario
$tablaElegida = leerTabla();
$colorElegido = leerColor();
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
$hayError = $hayEnvio && ($tablaElegida === null || $colorElegido === null);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Tabla de multiplicar con color</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Tabla de multiplicar a tu gusto</h1>

    <form class="tarjeta" action="act2.php" method="post">
        <fieldset>
            <legend>¿Qué tabla quieres ver?</legend>
            <select name="tabla" required>
                <option value="">Selecciona una tabla…</option>
                <?php imprimirOpcionesTabla($tablaElegida); ?>
            </select>
        </fieldset>

        <fieldset>
            <legend>¿En qué color?</legend>
            <div class="opciones">
                <?php imprimirOpcionesColor($colorElegido); ?>
            </div>
        </fieldset>

        <button type="submit">Mostrar tabla</button>
    </form>

    <?php
    if ($hayError) {
        echo "<p class='error'>Debes elegir una tabla y un color de la lista.</p>";
    }

    if ($tablaElegida !== null && $colorElegido !== null) {
        imprimirTabla($tablaElegida, COLORES[$colorElegido]);
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
