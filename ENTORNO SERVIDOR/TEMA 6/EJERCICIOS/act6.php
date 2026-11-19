<?php
// ejercicio 6: formulario de registro con subida de cv en pdf de maximo 2 mb con nombre de dni

const CARPETA_CVS = 'curriculums';
const MAX_BYTES_CV = 2 * 1024 * 1024;
const LETRAS_DNI = 'TRWAGMYFPDXBNJZSQVHLCKE';

// compruebo si el dni tiene 8 numeros y su letra correcta
function dniValido(string $dni): bool
{
    if (!preg_match('/^[0-9]{8}[A-Za-z]$/', $dni)) {
        return false;
    }

    $numero = (int) substr($dni, 0, 8);
    $letra = strtoupper(substr($dni, 8, 1));

    return LETRAS_DNI[$numero % 23] === $letra;
}

// recojo y compruebo los datos personales
function validarDatos(): array
{
    $datos = [
        'nombre' => isset($_POST['nombre']) ? trim($_POST['nombre']) : '',
        'apellidos' => isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '',
        'dni' => isset($_POST['dni']) ? strtoupper(trim($_POST['dni'])) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'telefono' => isset($_POST['telefono']) ? trim($_POST['telefono']) : '',
        'puesto' => isset($_POST['puesto']) ? trim($_POST['puesto']) : ''
    ];

    $errores = [];

    if ($datos['nombre'] === '') {
        $errores[] = 'El nombre es obligatorio.';
    }

    if ($datos['apellidos'] === '') {
        $errores[] = 'Los apellidos son obligatorios.';
    }

    if (!dniValido($datos['dni'])) {
        $errores[] = 'El DNI no es válido (8 dígitos y una letra correcta).';
    }

    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El correo electrónico no es válido.';
    }

    if (!preg_match('/^[0-9]{9}$/', $datos['telefono'])) {
        $errores[] = 'El teléfono debe tener 9 dígitos.';
    }

    if ($datos['puesto'] === '') {
        $errores[] = 'Debes indicar el puesto al que optas.';
    }

    return ['datos' => $datos, 'errores' => $errores];
}

// compruebo el cv y lo guardo con el dni como nombre
function procesarCurriculum(string $dni): ?string
{
    if (!isset($_FILES['cv'])) {
        return 'No se ha recibido el currículum.';
    }

    $archivo = $_FILES['cv'];

    if ($archivo['error'] === UPLOAD_ERR_NO_FILE) {
        return 'Debes adjuntar tu currículum en PDF.';
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return 'Se ha producido un error al subir el currículum (código ' . $archivo['error'] . ').';
    }

    if (!is_uploaded_file($archivo['tmp_name'])) {
        return 'El currículum no se ha subido por HTTP.';
    }

    if ($archivo['size'] > MAX_BYTES_CV) {
        return 'El currículum no puede superar los 2 MB.';
    }

    if (strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION)) !== 'pdf') {
        return 'El currículum debe estar en formato PDF.';
    }

    if (!esPdf($archivo['tmp_name'])) {
        return 'El archivo adjunto no es un PDF válido.';
    }

    $destino = __DIR__ . '/' . CARPETA_CVS . '/' . $dni . '.pdf';

    // si no existe la carpeta curriculums la creo
    if (!is_dir(__DIR__ . '/' . CARPETA_CVS) && !mkdir(__DIR__ . '/' . CARPETA_CVS, 0777, true)) {
        return 'No se ha podido crear la carpeta de currículums.';
    }

    if (!move_uploaded_file($archivo['tmp_name'], $destino)) {
        return 'No se ha podido guardar el currículum en el servidor.';
    }

    return null;
}

// compruebo si el archivo empieza por %PDF- para asegurar que es un pdf de verdad
function esPdf(string $rutaTemporal): bool
{
    $manejador = fopen($rutaTemporal, 'rb');

    if ($manejador === false) {
        return false;
    }

    $firma = fread($manejador, 5);
    fclose($manejador);

    return $firma === '%PDF-';
}

// muestra la lista de errores si algo falla
function imprimirErrores(array $errores): void
{
    echo "<div class='error'><strong>No se ha podido completar el registro:</strong><ul>";

    foreach ($errores as $error) {
        echo "<li>" . $error . "</li>";
    }

    echo "</ul></div>";
}

// muestra el mensaje de que todo ha ido bien
function imprimirRegistro(array $datos): void
{
    echo "<div class='exito'>";
    echo "<h2>¡Registro completado!</h2>";
    echo "<p>Hola <strong>" . $datos['nombre'] . ' ' . $datos['apellidos'] . "</strong>, "
        . "hemos recibido tu candidatura para el puesto de <strong>" . $datos['puesto'] . "</strong>.</p>";
    echo "<ul>";
    echo "<li>DNI: " . $datos['dni'] . "</li>";
    echo "<li>Correo: " . $datos['email'] . "</li>";
    echo "<li>Teléfono: " . $datos['telefono'] . "</li>";
    echo "<li>Currículum guardado como <strong>" . CARPETA_CVS . '/' . $datos['dni'] . ".pdf</strong></li>";
    echo "</ul>";
    echo "</div>";
}

$hayEnvio = $_SERVER['REQUEST_METHOD'] === 'POST';
$datos = ['nombre' => '', 'apellidos' => '', 'dni' => '', 'email' => '', 'telefono' => '', 'puesto' => ''];
$errores = [];
$registrado = false;

if ($hayEnvio) {
    $validacion = validarDatos();
    $datos = $validacion['datos'];
    $errores = $validacion['errores'];

    // si los datos estan bien, intento guardar el cv
    if (count($errores) === 0) {
        $errorCv = procesarCurriculum($datos['dni']);

        if ($errorCv !== null) {
            $errores[] = $errorCv;
        } else {
            $registrado = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Registro en empresa de empleo</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Registro en Talentia Empleo</h1>

    <?php
    if ($registrado) {
        imprimirRegistro($datos);
        echo "<div class='acciones'><a href='act6.php'>Enviar otra candidatura</a></div>";
    } else {
        if (count($errores) > 0) {
            imprimirErrores($errores);
        }
        ?>
        <form class="tarjeta" action="act6.php" method="post" enctype="multipart/form-data">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required
                    value="<?php echo $datos['nombre']; ?>">
            </div>

            <div class="campo">
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" required
                    value="<?php echo $datos['apellidos']; ?>">
            </div>

            <div class="campo">
                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" maxlength="9" placeholder="12345678Z" required
                    value="<?php echo $datos['dni']; ?>">
            </div>

            <div class="campo">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" required
                    value="<?php echo $datos['email']; ?>">
            </div>

            <div class="campo">
                <label for="telefono">Teléfono</label>
                <input type="tel" id="telefono" name="telefono" maxlength="9" required
                    value="<?php echo $datos['telefono']; ?>">
            </div>

            <div class="campo">
                <label for="puesto">Puesto al que optas</label>
                <input type="text" id="puesto" name="puesto" required
                    value="<?php echo $datos['puesto']; ?>">
            </div>

            <div class="campo">
                <label for="cv">Currículum (PDF, máximo 2 MB)</label>
                <input type="file" id="cv" name="cv" accept="application/pdf,.pdf" required>
            </div>

            <button type="submit">Enviar candidatura</button>
        </form>
        <?php
    }
    ?>

    <a class="volver" href="index.html">Volver al índice de ejercicios</a>
</body>

</html>
