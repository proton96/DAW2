<?php
// ejercicio 5: subida de dos imagenes y mostrarlas ordenadas de menor a mayor tamano

const CARPETA_SUBIDAS = 'subidas/act5';
const MAX_BYTES = 4 * 1024 * 1024;

// funcion para comprobar y guardar cada imagen
function procesarImagen(string $campo, int $numeroImagen): array
{
    if (!isset($_FILES[$campo])) {
        return ['ok' => false, 'mensaje' => "No se ha recibido la imagen $numeroImagen.", 'imagen' => null];
    }

    $archivo = $_FILES[$campo];

    if ($archivo['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => false, 'mensaje' => "No has seleccionado la imagen $numeroImagen.", 'imagen' => null];
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'mensaje' => "Error al subir la imagen $numeroImagen (código {$archivo['error']}).", 'imagen' => null];
    }

    if (!is_uploaded_file($archivo['tmp_name'])) {
        return ['ok' => false, 'mensaje' => "El archivo $numeroImagen no se ha subido por HTTP.", 'imagen' => null];
    }

    if ($archivo['size'] > MAX_BYTES) {
        return ['ok' => false, 'mensaje' => "La imagen $numeroImagen supera los 4 MB permitidos.", 'imagen' => null];
    }

    // compruebo si de verdad es una imagen y saco sus medidas
    $medidas = @getimagesize($archivo['tmp_name']);

    if ($medidas === false) {
        return ['ok' => false, 'mensaje' => "El archivo $numeroImagen no es una imagen válida.", 'imagen' => null];
    }

    $destino = guardarArchivo($archivo, $numeroImagen);

    if ($destino === null) {
        return ['ok' => false, 'mensaje' => "No se ha podido guardar la imagen $numeroImagen.", 'imagen' => null];
    }

    return [
        'ok' => true,
        'mensaje' => '',
        'imagen' => [
            'nombre' => $archivo['name'],
            'ruta' => $destino,
            'tamano' => $archivo['size'],
            'ancho' => $medidas[0],
            'alto' => $medidas[1],
            'tipo' => $medidas['mime']
        ]
    ];
}

// guarda el archivo en la carpeta de subidas
function guardarArchivo(array $archivo, int $numeroImagen): ?string
{
    $carpetaAbsoluta = __DIR__ . '/' . CARPETA_SUBIDAS;

    // si la carpeta no existe la creo
    if (!is_dir($carpetaAbsoluta) && !mkdir($carpetaAbsoluta, 0777, true)) {
        return null;
    }

    $nombreLimpio = preg_replace('/[^A-Za-z0-9._-]/', '_', basename($archivo['name']));
    $nombreFinal = time() . '_' . $numeroImagen . '_' . $nombreLimpio;

    if (!move_uploaded_file($archivo['tmp_name'], $carpetaAbsoluta . '/' . $nombreFinal)) {
        return null;
    }

    return CARPETA_SUBIDAS . '/' . $nombreFinal;
}

// ordena las imagenes comparando su peso de menor a mayor
function ordenarPorTamano(array $imagenes): array
{
    usort($imagenes, function (array $a, array $b): int {
        return $a['tamano'] <=> $b['tamano'];
    });

    return $imagenes;
}

// funcion para mostrar el tamano en KB o MB
function formatearTamano(int $bytes): string
{
    if ($bytes >= 1024 * 1024) {
        return round($bytes / (1024 * 1024), 2) . ' MB';
    }

    return round($bytes / 1024, 1) . ' KB';
}

// muestra la foto con sus datos en pantalla
function imprimirImagen(array $imagen, int $posicion): void
{
    echo "<figure>";
    echo "<img src='" . $imagen['ruta'] . "' alt='Imagen subida " . $imagen['nombre'] . "'>";
    echo "<figcaption>";
    echo "<strong>#" . $posicion . " · " . $imagen['nombre'] . "</strong><br>";
    echo "Peso: <span class='medida'>" . formatearTamano($imagen['tamano']) . "</span>";
    echo " · Dimensiones: " . $imagen['ancho'] . " × " . $imagen['alto'] . " px<br>";
    echo "Tipo: " . $imagen['tipo'];
    echo "</figcaption>";
    echo "</figure>";
}

// miro si han enviado el formulario y proceso las dos fotos
$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
$errores = [];
$imagenes = [];

if ($hayEnvio) {
    foreach (['imagen1', 'imagen2'] as $numero => $campo) {
        $resultado = procesarImagen($campo, $numero + 1);

        if ($resultado['ok']) {
            $imagenes[] = $resultado['imagen'];
        } else {
            $errores[] = $resultado['mensaje'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Dos imágenes ordenadas por tamaño</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Sube dos imágenes</h1>

    <form class="tarjeta" action="act5.php" method="post" enctype="multipart/form-data">
        <div class="campo">
            <label for="imagen1">Primera imagen</label>
            <input type="file" id="imagen1" name="imagen1" accept="image/*" required>
        </div>

        <div class="campo">
            <label for="imagen2">Segunda imagen</label>
            <input type="file" id="imagen2" name="imagen2" accept="image/*" required>
        </div>

        <p class="ayuda">Máximo 4 MB por imagen. Solo se aceptan archivos de imagen.</p>
        <button type="submit">Enviar imágenes</button>
    </form>

    <?php
    if (count($errores) > 0) {
        echo "<div class='error'><strong>Revisa lo siguiente:</strong><ul>";

        foreach ($errores as $mensaje) {
            echo "<li>" . $mensaje . "</li>";
        }

        echo "</ul></div>";
    }

    if (count($imagenes) > 0) {
        $imagenes = ordenarPorTamano($imagenes);

        echo "<h2 class='seccion-titulo'>Imágenes ordenadas de menor a mayor tamaño</h2>";
        echo "<div class='galeria'>";

        foreach ($imagenes as $posicion => $imagen) {
            imprimirImagen($imagen, $posicion + 1);
        }

        echo "</div>";
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
