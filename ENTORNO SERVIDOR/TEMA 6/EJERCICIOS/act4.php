<?php
// ejercicio 4: examen tipo test de 10 preguntas con correccion y nota final

// array con las 10 preguntas, las opciones y la correcta
const PREGUNTAS = [
    [
        'enunciado' => '¿Qué significa la sigla HTML?',
        'opciones' => [
            'HyperText Markup Language',
            'High Transfer Markup Language',
            'HyperText Management Layer',
            'Home Tool Markup Language'
        ],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿Qué etiqueta se utiliza para crear un enlace en HTML?',
        'opciones' => ['<link>', '<a>', '<href>', '<url>'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿En qué lenguaje se ejecuta el código del lado del servidor en este módulo?',
        'opciones' => ['JavaScript', 'Python', 'PHP', 'Java'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Qué superglobal recoge los datos enviados por el método POST?',
        'opciones' => ['$_GET', '$_POST', '$_SESSION', '$_FILES'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Cuál de estos tipos de datos NO existe en PHP?',
        'opciones' => ['integer', 'boolean', 'string', 'char'],
        'correcta' => 3
    ],
    [
        'enunciado' => '¿Qué función cuenta los elementos de un array en PHP?',
        'opciones' => ['sizeof_array()', 'count()', 'length()', 'total()'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Qué atributo de la etiqueta <form> indica el método de envío?',
        'opciones' => ['action', 'target', 'method', 'enctype'],
        'correcta' => 2
    ],
    [
        'enunciado' => '¿Cuál es el puerto por defecto del protocolo HTTP?',
        'opciones' => ['21', '80', '443', '8080'],
        'correcta' => 1
    ],
    [
        'enunciado' => '¿Qué estructura permite repetir un bloque un número conocido de veces?',
        'opciones' => ['for', 'if', 'switch', 'const'],
        'correcta' => 0
    ],
    [
        'enunciado' => '¿Qué etiqueta agrupa los campos relacionados de un formulario?',
        'opciones' => ['<div>', '<group>', '<fieldset>', '<section>'],
        'correcta' => 2
    ]
];

const NOTA_APROBADO = 5;

// funcion para recoger las respuestas que ha marcado el alumno
function leerRespuestas(): array
{
    if (!isset($_POST['respuestas']) || !is_array($_POST['respuestas'])) {
        return [];
    }

    $respuestas = [];

    // guardo cada respuesta que sea un numero
    foreach ($_POST['respuestas'] as $indicePregunta => $indiceOpcion) {
        if (is_string($indiceOpcion) && is_numeric($indiceOpcion)) {
            $respuestas[(int) $indicePregunta] = (int) $indiceOpcion;
        }
    }

    return $respuestas;
}

// funcion para corregir el examen
function corregirTest(array $respuestas): array
{
    $acertadas = 0;
    $fallos = [];

    // voy pasando por cada pregunta
    foreach (PREGUNTAS as $indice => $pregunta) {
        $respondida = isset($respuestas[$indice]) ? $respuestas[$indice] : null;

        // si ha acertado
        if ($respondida === $pregunta['correcta']) {
            $acertadas++;
            continue;
        }

        // si ha fallado lo guardo en la lista de fallos
        $fallos[] = [
            'enunciado' => $pregunta['enunciado'],
            'correcta' => $pregunta['opciones'][$pregunta['correcta']],
            'dada' => $respondida !== null ? $pregunta['opciones'][$respondida] : null
        ];
    }

    $total = count(PREGUNTAS);

    return [
        'acertadas' => $acertadas,
        'total' => $total,
        'nota' => round($acertadas * 10 / $total, 2),
        'fallos' => $fallos
    ];
}

// pinta una pregunta con sus opciones en radio
function imprimirPregunta(int $indice, array $pregunta, array $respuestas): void
{
    $numero = $indice + 1;

    echo "<article class='pregunta'>";
    echo "<h2><span class='indice'>$numero</span>" . $pregunta['enunciado'] . "</h2>";
    echo "<div class='opciones-columna'>";

    foreach ($pregunta['opciones'] as $indiceOpcion => $texto) {
        $marcada = isset($respuestas[$indice]) && $respuestas[$indice] === $indiceOpcion
            ? ' checked'
            : '';

        echo "<label class='opcion-linea'>";
        echo "<input type='radio' name='respuestas[$indice]' value='$indiceOpcion'$marcada required>";
        echo $texto;
        echo "</label>";
    }

    echo "</div>";
    echo "</article>";
}

// muestra la nota final y si ha aprobado o no
function imprimirNota(array $correccion): void
{
    $aprobado = $correccion['nota'] >= NOTA_APROBADO;

    echo "<section class='nota-panel'>";
    echo "<div class='nota-valor'>" . $correccion['nota'] . "<small>/ 10</small></div>";
    echo "<div class='nota-detalle'>";
    echo "<span class='etiqueta " . ($aprobado ? 'aprobado' : 'suspendido') . "'>"
        . ($aprobado ? 'Aprobado' : 'Suspendido') . "</span>";
    echo "<p>" . $correccion['acertadas'] . " de " . $correccion['total']
        . " respuestas correctas.</p>";
    echo "</div>";
    echo "</section>";
}

// muestra las preguntas que se han fallado y cual era la buena
function imprimirFallos(array $fallos): void
{
    if (count($fallos) === 0) {
        echo "<p class='exito'>¡Enhorabuena! No has fallado ninguna pregunta.</p>";
        return;
    }

    echo "<h2 class='seccion-titulo'>Preguntas falladas (" . count($fallos) . ")</h2>";
    echo "<ul class='fallos'>";

    foreach ($fallos as $fallo) {
        echo "<li class='fallo'>";
        echo "<strong>" . $fallo['enunciado'] . "</strong>";
        echo "<p class='respuesta-correcta'>Respuesta correcta: " . $fallo['correcta'] . "</p>";

        if ($fallo['dada'] === null) {
            echo "<p class='sin-contestar'>No contestaste a esta pregunta.</p>";
        } else {
            echo "<p class='respuesta-dada'>Tu respuesta: " . $fallo['dada'] . "</p>";
        }

        echo "</li>";
    }

    echo "</ul>";
}

// recojo respuestas y si han enviado el formulario corrijo el examen
$respuestas = leerRespuestas();
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
$sinRespuestas = $hayEnvio && count($respuestas) === 0;
$correccion = (!$sinRespuestas && $hayEnvio) ? corregirTest($respuestas) : null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Examen tipo test</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Examen tipo test: fundamentos web</h1>

    <?php
    if ($sinRespuestas) {
        echo "<p class='error'>No has enviado ninguna respuesta.</p>";
    }

    if ($correccion !== null) {
        imprimirNota($correccion);
        imprimirFallos($correccion['fallos']);
        echo "<div class='acciones'><a href='act4.php'>Repetir el test</a></div>";
    } else {
        echo "<form action='act4.php' method='post' class='preguntas'>";

        foreach (PREGUNTAS as $indice => $pregunta) {
            imprimirPregunta($indice, $pregunta, $respuestas);
        }

        echo "<button type='submit'>Corregir el test</button>";
        echo "</form>";
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
