<?php
session_start();

// Paso 1: Validación de datos del formulario
if (!isset($_SESSION['datos_del_formulario']) || !isset($_POST)) {
    echo "Fallo en la red";
    header("refresh:2;url=registro.php");
    exit;
}

$datos = $_SESSION['datos_del_formulario'];
$username = filter_var(htmlspecialchars(strtolower($datos["username"])), FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($datos["password"]);
$palabrasClave = $_POST["keysWordsUser"];

// Paso 2: Seguridad de contraseñas
if (!validarPassword($password)) {
    echo "La contraseña no cumple con los requisitos de seguridad.";
    header("refresh:2;url=registro.php");
    exit;
}

// Paso 3: Lectura del archivo JSON existente
$usuarios = obtenerUsuarios();

// Paso 4: Comprobación de existencia del usuario
if (existeUsuario($usuarios, $username)) {
    echo "Error, el usuario ingresado ya existe en la base de datos. Vuelve a intentarlo.";
    header("refresh:2;url=registro.php");
    exit;
}

// Paso 5: Registro del nuevo usuario
registrarUsuario($usuarios, $username, $password, $palabrasClave);

// Paso 6: Mensajes de salida y redirección
mostrarMensajeRegistroExitoso($palabrasClave);

// Funciones auxiliares

function validarPassword($password) {
    return strlen($password) >= 8 && password_has_sufficient_complexity($password);
}

function password_has_sufficient_complexity($password) {
    return preg_match('/[A-Za-z]/', $password) && preg_match('/\d/', $password) && preg_match('/[^A-Za-z\d]/', $password);
}

function obtenerUsuarios() {
    $usuarios = [];

    $rutaArchivo = __DIR__ . '/../JSON/usuarios.json';

    if (file_exists($rutaArchivo) && is_readable($rutaArchivo)) {
        $file_contents = file_get_contents($rutaArchivo);
        if ($file_contents !== false) {
            $usuarios = json_decode($file_contents, true);
        }
    }

    return $usuarios;
}

function existeUsuario($usuarios, $username) {
    return isset($usuarios[$username]);
}

function registrarUsuario(&$usuarios, $username, $password, $palabrasClave) {
    $hashContrasena = password_hash($password, PASSWORD_BCRYPT);
    $hashPalabrasClave = password_hash($palabrasClave, PASSWORD_BCRYPT);

    $rutaArchivo = __DIR__ . '/../JSON/usuarios.json';

    $usuarios[$username] = ["contrasena" => $hashContrasena, "KeysWords" => $hashPalabrasClave];

    file_put_contents($rutaArchivo, json_encode($usuarios));
}

function mostrarMensajeRegistroExitoso($palabrasClave) {
    echo "<h2>Registro exitoso. Copia y guarda las siguiente cadena de texto. Son tus nuevas palabras claves</h2>";
    echo "<h1>$palabrasClave</h1>";
    echo "<!-- Botón que llama a la función JavaScript para copiar al portapapeles -->
    <button onclick=\"copiarAlPortapapeles('$palabrasClave')\">Copiar al Portapapeles</button>";
    echo "<a href='login_index.php'>Iniciar Sesión</a>";
}
?>
<script>
    function copiarAlPortapapeles(texto) {
        var elementoTemporal = document.createElement("textarea");
        elementoTemporal.value = texto;
        document.body.appendChild(elementoTemporal);
        elementoTemporal.select();
        document.execCommand("copy");
        document.body.removeChild(elementoTemporal);
        alert("Texto copiado al portapapeles: " + texto);
    }
</script>
