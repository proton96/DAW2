<?php
// aqui tengo las funciones para pintar el html del test

// cabecera con el titulo y los datos del examen
function imprimirCabecera(array $preguntas): void
{
    $totalPreguntas = count($preguntas);
    $totalOpciones = contarOpciones($preguntas);
    $minutos = calcularMinutos($totalPreguntas);

    echo "<header class='hero'>";
    echo "<p class='kicker'>Test de especialidad</p>";
    echo "<h1>El gran test del café</h1>";
    echo "<p class='hero-texto'>Demuestra cuánto sabes de variedades, métodos de "
        . "extracción y cultura cafetera.</p>";
    echo "<ul class='datos'>";
    echo "<li class='chip'>" . $totalPreguntas . " preguntas</li>";
    echo "<li class='chip'>" . $totalOpciones . " opciones en total</li>";
    echo "<li class='chip'>~" . $minutos . " min</li>";
    echo "</ul>";
    echo "</header>";
}

// formulario con todas las preguntas
function imprimirFormulario(array $preguntas, array $respuestas): void
{
    echo "<form class='test-form' action='index.php' method='post'>";
    echo "<p class='nota-formulario'>Elige una respuesta en cada pregunta. "
        . "Al terminar verás tu nota y los fallos.</p>";

    // voy pintando cada pregunta
    foreach ($preguntas as $indice => $pregunta) {
        imprimirPregunta($indice, $pregunta, $respuestas);
    }

    echo "<div class='pie-formulario'>";
    echo "<span class='contador'>" . count($preguntas) . " preguntas</span>";
    echo "<button class='boton' type='submit'>Corregir mi test</button>";
    echo "</div>";
    echo "</form>";
}

// pinta una pregunta con sus respuestas
function imprimirPregunta(int $indice, array $pregunta, array $respuestas): void
{
    $numero = $indice + 1;

    echo "<fieldset class='pregunta'>";
    echo "<legend class='cabecera-pregunta'>";
    echo "<span class='numero-pregunta'>" . str_pad($numero, 2, '0', STR_PAD_LEFT) . "</span>";
    echo "<span class='enunciado'>" . $pregunta['enunciado'] . "</span>";
    echo "</legend>";

    echo "<div class='opciones'>";

    // saco cada opcion de la pregunta
    foreach ($pregunta['opciones'] as $indiceOpcion => $texto) {
        $marcada = isset($respuestas[$indice]) && $respuestas[$indice] === $indiceOpcion;
        imprimirOpcion($indice, $indiceOpcion, $texto, $marcada);
    }

    echo "</div>";
    echo "</fieldset>";
}

// pinta un radio button con su letra y su texto
function imprimirOpcion(int $indicePregunta, int $indiceOpcion, string $texto, bool $marcada): void
{
    $extra = $marcada ? ' checked' : '';

    echo "<label class='opcion'>";
    echo "<input type='radio' name='respuestas[" . $indicePregunta . "]' "
        . "value='" . $indiceOpcion . "'$extra>";
    echo "<span class='letra'>" . letraOpcion($indiceOpcion) . "</span>";
    echo "<span class='texto-opcion'>" . $texto . "</span>";
    echo "</label>";
}

// caja con la nota que ha sacado y el resumen
function imprimirResultado(array $correccion): void
{
    $clase = $correccion['aprobado'] ? 'aprobado' : 'suspendido';
    $titulo = $correccion['aprobado'] ? 'Aprobado' : 'Suspendido';

    echo "<section class='panel-nota'>";
    echo "<div class='anillo' style='--porcentaje: " . $correccion['porcentaje'] . "%'>";
    echo "<div class='anillo-interior'>";
    echo "<span class='nota'>" . formatearNota($correccion['nota']) . "</span>";
    echo "<span class='sobre'>sobre 10</span>";
    echo "</div>";
    echo "</div>";

    echo "<div class='resultado-texto'>";
    echo "<span class='etiqueta $clase'>$titulo</span>";
    echo "<h2>Tu nota: " . formatearNota($correccion['nota']) . " / 10</h2>";
    echo "<p class='valoracion'>" . mensajeValoracion($correccion['nota']) . "</p>";
    echo "<ul class='resumen'>";
    echo "<li><strong>" . $correccion['acertadas'] . "</strong> aciertos</li>";
    echo "<li><strong>" . $correccion['falladas'] . "</strong> fallos</li>";
    echo "<li><strong>" . $correccion['porcentaje'] . "%</strong> de acierto</li>";
    echo "</ul>";
    echo "</div>";
    echo "</section>";
}

// lista de preguntas que ha fallado con la que era correcta
function imprimirRevision(array $correccion): void
{
    echo "<section class='revision'>";

    // si no tiene fallos le felicito
    if (count($correccion['fallos']) === 0) {
        echo "<div class='perfecto'>";
        echo "<h2>¡Pleno al quince!</h2>";
        echo "<p>No has fallado ninguna de las " . $correccion['total']
            . " preguntas. Eres un auténtico barista.</p>";
        echo "</div>";
        echo "</section>";
        return;
    }

    echo "<h2 class='titulo-revision'>Preguntas a repasar ("
        . count($correccion['fallos']) . ")</h2>";
    echo "<p class='subtitulo-revision'>Estas son las respuestas correctas que te has perdido.</p>";

    echo "<ol class='lista-fallos'>";

    // pinto cada pregunta fallada
    foreach ($correccion['fallos'] as $fallo) {
        imprimirFallo($fallo);
    }

    echo "</ol>";
    echo "</section>";
}

// detalle de una pregunta fallada
function imprimirFallo(array $fallo): void
{
    echo "<li class='fallo'>";
    echo "<span class='numero-fallo'>" . str_pad($fallo['numero'], 2, '0', STR_PAD_LEFT) . "</span>";
    echo "<div class='fallo-contenido'>";
    echo "<p class='fallo-enunciado'>" . $fallo['enunciado'] . "</p>";
    echo "<p class='respuesta-correcta'>Respuesta correcta: <strong>"
        . $fallo['correcta'] . "</strong></p>";

    if ($fallo['dada'] === null) {
        echo "<p class='respuesta-dada sin-contestar'>No contestaste a esta pregunta.</p>";
    } else {
        echo "<p class='respuesta-dada'>Tu respuesta: " . $fallo['dada'] . "</p>";
    }

    echo "</div>";
    echo "</li>";
}

// boton para volver a hacer el examen
function imprimirBotonRepetir(): void
{
    echo "<div class='acciones'>";
    echo "<a class='boton boton-secundario' href='index.php'>Repetir el test</a>";
    echo "</div>";
}

// muestra un mensaje de aviso
function imprimirAviso(string $mensaje): void
{
    echo "<div class='aviso' role='alert'>" . $mensaje . "</div>";
}
