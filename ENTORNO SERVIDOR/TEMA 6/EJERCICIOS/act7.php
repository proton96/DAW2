<?php
// ejercicio 7: subir archivos a la carpeta del usuario dentro de "usuarios"

const CARPETA_USUARIOS = 'usuarios';
const MAX_BYTES_DOCUMENTO = 8 * 1024 * 1024;

// quito caracteres raros del nombre de usuario
function limpiarUsuario(string $usuario): string
{
    $limpio = preg_replace('/[^A-Za-z0-9_.-]/', '', $usuario);

    // evito que dejen el nombre vacio o pongan puntos raros
    if ($limpio === '' || $limpio === '.' || $limpio === '..') {
        return '';
    }

    return $limpio;
}

// limpio el nombre del archivo para no tener problemas al guardarlo
function limpiarNombreArchivo(string $nombre): string
{
    return preg_replace('/[^A-Za-z0-9._-]/', '_', basename($nombre));
}

// funcion para guardar el archivo en la carpeta del usuario
function subirDocumento(string $usuario): array
{
    if (!isset($_FILES['documento'])) {
        return ['ok' => false, 'mensaje' => 'No se ha recibido ningún archivo.', 'archivo' => ''];
    }

    $archivo = $_FILES['documento'];

    if ($archivo['error'] === UPLOAD_ERR_NO_FILE) {
        return ['ok' => false, 'mensaje' => 'Debes seleccionar un archivo para subir.', 'archivo' => ''];
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'mensaje' => 'Error al subir el archivo (código ' . $archivo['error'] . ').', 'archivo' => ''];
    }

    if (!is_uploaded_file($archivo['tmp_name'])) {
        return ['ok' => false, 'mensaje' => 'El archivo no se ha subido por HTTP.', 'archivo' => ''];
    }

    if ($archivo['size'] > MAX_BYTES_DOCUMENTO) {
        return ['ok' => false, 'mensaje' => 'El archivo supera los 8 MB permitidos.', 'archivo' => ''];
    }

    $nombreArchivo = limpiarNombreArchivo($archivo['name']);
    $carpetaUsuario = __DIR__ . '/' . CARPETA_USUARIOS . '/' . $usuario;

    // si el usuario no tiene carpeta todavia la creo
    if (!is_dir($carpetaUsuario) && !mkdir($carpetaUsuario, 0777, true)) {
        return ['ok' => false, 'mensaje' => 'No se ha podido crear la carpeta del usuario.', 'archivo' => ''];
    }

    $destino = $carpetaUsuario . '/' . $nombreArchivo;

    if (!move_uploaded_file($archivo['tmp_name'], $destino)) {
        return ['ok' => false, 'mensaje' => 'No se ha podido guardar el archivo en el servidor.', 'archivo' => ''];
    }

    return ['ok' => true, 'mensaje' => '', 'archivo' => $archivo['name']];
}

// saca la lista de archivos que ya tiene este usuario
function listarDocumentos(string $usuario): array
{
    $carpetaUsuario = __DIR__ . '/' . CARPETA_USUARIOS . '/' . $usuario;

    if (!is_dir($carpetaUsuario)) {
        return [];
    }

    $documentos = [];

    foreach (scandir($carpetaUsuario) as $entrada) {
        if ($entrada === '.' || $entrada === '..') {
            continue;
        }

        $rutaCompleta = $carpetaUsuario . '/' . $entrada;

        if (is_file($rutaCompleta)) {
            $documentos[$entrada] = filesize($rutaCompleta);
        }
    }

    return $documentos;
}

// pasa los bytes a KB o MB
function formatearTamano(int $bytes): string
{
    if ($bytes >= 1024 * 1024) {
        return round($bytes / (1024 * 1024), 2) . ' MB';
    }

    return round($bytes / 1024, 1) . ' KB';
}

$error = '';
$avisoSubida = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioRecibido = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $usuario = limpiarUsuario($usuarioRecibido);

    if ($usuario === '') {
        $error = 'El nombre de usuario no es válido. Usa letras, números, guiones o puntos.';
    } else {
        $resultado = subirDocumento($usuario);

        if ($resultado['ok']) {
            // redirijo a la misma pagina para que al recargar no se vuelva a mandar el archivo
            $parametros = http_build_query([
                'usuario' => $usuario,
                'archivo' => $resultado['archivo']
            ]);
            header('Location: act7.php?' . $parametros);
            exit;
        }

        $error = $resultado['mensaje'];
    }
}

$usuarioConsulta = isset($_GET['usuario']) ? limpiarUsuario($_GET['usuario']) : '';

if (isset($_GET['archivo']) && $usuarioConsulta !== '') {
    $archivoSubido = htmlspecialchars($_GET['archivo'], ENT_QUOTES, 'UTF-8');
    $avisoSubida = 'El archivo ' . $archivoSubido . ', del usuario '
        . $usuarioConsulta . ', ha sido subido correctamente.';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 - Subida de documentos por usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Mi carpeta de documentos</h1>

    <?php if ($avisoSubida !== ''): ?>
        <p class="exito"><?php echo $avisoSubida; ?></p>
    <?php endif; ?>

    <?php if ($error !== ''): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form class="tarjeta" action="act7.php" method="post" enctype="multipart/form-data">
        <div class="campo">
            <label for="usuario">Nombre de usuario</label>
            <input type="text" id="usuario" name="usuario" required maxlength="30"
                value="<?php echo $usuarioConsulta; ?>">
            <p class="ayuda">Se creará una carpeta con tu nombre dentro de "usuarios".</p>
        </div>

        <div class="campo">
            <label for="documento">Documento</label>
            <input type="file" id="documento" name="documento" required>
            <p class="ayuda">Cualquier tipo de archivo, hasta 8 MB.</p>
        </div>

        <button type="submit">Subir documento</button>
    </form>

    <?php
    if ($usuarioConsulta !== '') {
        $documentos = listarDocumentos($usuarioConsulta);

        echo "<div class='tarjeta ancha'>";
        echo "<h2>Documentos de " . $usuarioConsulta . " ("
            . count($documentos) . ")</h2>";

        if (count($documentos) === 0) {
            echo "<p class='aviso'>Este usuario todavía no tiene documentos.</p>";
        } else {
            echo "<ul class='documentos'>";

            foreach ($documentos as $nombre => $tamano) {
                echo "<li><strong>" . $nombre . "</strong> · "
                    . formatearTamano($tamano) . "</li>";
            }

            echo "</ul>";
        }

        echo "</div>";
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
