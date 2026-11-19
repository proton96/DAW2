<?php
// ejercicio 3: seleccionar frutas con casillas de verificacion y mostrarlas

// lista de frutas que se pueden elegir
const FRUTAS = [
    'manzana' => 'Manzana',
    'platano' => 'Plátano',
    'naranja' => 'Naranja',
    'fresa' => 'Fresa',
    'kiwi' => 'Kiwi',
    'pina' => 'Piña',
    'uva' => 'Uva',
    'sandia' => 'Sandía'
];

// funcion para pillar las frutas que ha marcado el usuario
function leerFrutasElegidas(): array
{
    if (!isset($_POST['frutas']) || !is_array($_POST['frutas'])) {
        return [];
    }

    $elegidas = [];

    // recorro las frutas que han llegado y compruebo que esten en la lista
    foreach ($_POST['frutas'] as $clave) {
        if (is_string($clave) && array_key_exists($clave, FRUTAS)) {
            $elegidas[] = $clave;
        }
    }

    return $elegidas;
}

// pinta los checkboxes de las frutas
function imprimirCheckboxes(array $elegidas): void
{
    foreach (FRUTAS as $clave => $nombre) {
        $marcada = in_array($clave, $elegidas, true) ? ' checked' : '';

        echo "<label class='opcion'>";
        echo "<input type='checkbox' name='frutas[]' value='$clave'$marcada>";
        echo $nombre;
        echo "</label>";
    }
}

// pinta la lista con las frutas que ha elegido
function imprimirResultado(array $elegidas): void
{
    if (count($elegidas) === 0) {
        echo "<p class='aviso'>No has seleccionado ninguna fruta.</p>";
        return;
    }

    echo "<div class='exito'>";
    echo "<h2>Tus frutas favoritas (" . count($elegidas) . ")</h2>";
    echo "<ul class='lista-frutas'>";

    foreach ($elegidas as $clave) {
        echo "<li>" . FRUTAS[$clave] . "</li>";
    }

    echo "</ul>";
    echo "</div>";
}

// pillo las frutas marcadas y miro si han enviado el formulario
$frutasElegidas = leerFrutasElegidas();
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Frutas favoritas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>¿Cuáles son tus frutas favoritas?</h1>

    <form class="tarjeta" action="act3.php" method="post">
        <fieldset>
            <legend>Marca todas las que quieras</legend>
            <div class="opciones">
                <?php imprimirCheckboxes($frutasElegidas); ?>
            </div>
        </fieldset>

        <button type="submit">Enviar selección</button>
    </form>

    <?php
    if ($hayEnvio) {
        imprimirResultado($frutasElegidas);
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
