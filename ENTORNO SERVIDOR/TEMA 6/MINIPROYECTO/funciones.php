<?php
// aqui tengo las funciones para comprobar las respuestas y calcular la nota

// nota minima para aprobar
const NOTA_APROBADO = 5;
// calculo de tiempo aproximado
const PREGUNTAS_POR_MINUTO = 3;

// saco la letra que le toca a cada opcion (0 es A, 1 es B, 2 es C...)
function letraOpcion(int $indice): string
{
    return chr(65 + $indice);
}

// recojo lo que ha marcado el usuario en el formulario
function leerRespuestas(array $preguntas): array
{
    $respuestas = [];

    // si no han mandado nada devuelvo el array vacio
    if (!isset($_POST['respuestas']) || !is_array($_POST['respuestas'])) {
        return $respuestas;
    }

    $enviadas = $_POST['respuestas'];

    // voy mirando pregunta por pregunta
    foreach ($preguntas as $indice => $pregunta) {
        // si no la ha respondido o no es un numero paso a la siguiente
        if (!isset($enviadas[$indice]) || !is_numeric($enviadas[$indice])) {
            continue;
        }

        $opcion = (int) $enviadas[$indice];
        $totalOpciones = count($pregunta['opciones']);

        // miro que no hayan metido un numero raro fuera de las opciones que hay
        if ($opcion < 0 || $opcion >= $totalOpciones) {
            continue;
        }

        // guardo la respuesta del usuario
        $respuestas[$indice] = $opcion;
    }

    return $respuestas;
}

// compruebo si ha respondido a todas las preguntas del test
function estanTodasContestadas(array $preguntas, array $respuestas): bool
{
    return count($respuestas) === count($preguntas);
}

// aqui corrijo el test comparando lo que ha marcado con la respuesta buena
function corregirTest(array $preguntas, array $respuestas): array
{
    $acertadas = 0;
    $sinContestar = 0;
    $fallos = [];

    // voy pasando por cada pregunta del test
    foreach ($preguntas as $indice => $pregunta) {
        $numero = $indice + 1;
        $respondida = isset($respuestas[$indice]) ? $respuestas[$indice] : null;

        if ($respondida === $pregunta['correcta']) {
            $acertadas++;
            continue;
        }

        if ($respondida === null) {
            $sinContestar++;
        }

        $fallos[] = [
            'numero' => $numero,
            'enunciado' => $pregunta['enunciado'],
            'correcta' => textoOpcion($pregunta['correcta'], $pregunta['opciones']),
            'dada' => $respondida !== null ? textoOpcion($respondida, $pregunta['opciones']) : null
        ];
    }

    $total = count($preguntas);

    return [
        'acertadas' => $acertadas,
        'falladas' => $total - $acertadas,
        'sin_contestar' => $sinContestar,
        'total' => $total,
        'nota' => calcularNota($acertadas, $total),
        'porcentaje' => calcularPorcentaje($acertadas, $total),
        'aprobado' => calcularNota($acertadas, $total) >= NOTA_APROBADO,
        'fallos' => $fallos
    ];
}

// junta la letra y el texto de la opcion (por ejemplo: "B. Robusta")
function textoOpcion(int $indiceOpcion, array $opciones): string
{
    return letraOpcion($indiceOpcion) . '. ' . $opciones[$indiceOpcion];
}

// saca la nota sobre 10 con dos decimales
function calcularNota(int $acertadas, int $total): float
{
    if ($total === 0) {
        return 0.0;
    }

    return round($acertadas * 10 / $total, 2);
}

// saca el porcentaje de aciertos
function calcularPorcentaje(int $acertadas, int $total): int
{
    if ($total === 0) {
        return 0;
    }

    return (int) round($acertadas * 100 / $total);
}

// pone una coma en lugar de un punto para la nota
function formatearNota(float $nota): string
{
    return number_format($nota, 1, ',', '');
}

// cuenta cuantas respuestas hay en total sumando las de todas las preguntas
function contarOpciones(array $preguntas): int
{
    $total = 0;

    foreach ($preguntas as $pregunta) {
        $total += count($pregunta['opciones']);
    }

    return $total;
}

// calcula los minutos aproximados que se tarda en hacer el test
function calcularMinutos(int $totalPreguntas): int
{
    return max(1, (int) ceil($totalPreguntas / PREGUNTAS_POR_MINUTO));
}

// mensaje que le mostramos segun la nota que ha sacado
function mensajeValoracion(float $nota): string
{
    if ($nota >= 9) {
        return '¡Nivel barista! Dominas el café de arriba abajo.';
    }

    if ($nota >= 7) {
        return 'Muy buen resultado: se nota que te gusta el buen café.';
    }

    if ($nota >= NOTA_APROBADO) {
        return 'Aprobado justito. Un repaso a los métodos de extracción te vendrá bien.';
    }

    return 'Toca seguir practicando: vuelve a la barra y repite el test.';
}
