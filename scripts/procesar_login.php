<?php
session_start();

if (isset($_POST['username'], $_POST['password'], $_POST['PalabrasClave'])) {
    // Obtén los datos del formulario
    $username = filter_var(strtolower($_POST["username"]), FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $palabras = $_POST["PalabrasClave"];
    $_SESSION['credencialesCorrectas'] = array( 'keysWords' => $palabras, 'contrasenaBoveda' => $password );

    

    // Lee el archivo JSON existente (si lo hay)
    $usuarios = obtenerUsuarios();

    // Verifica si el usuario ya existe
    if (existeUsuario($usuarios, $username)) {
        $contrasena_original = $usuarios[$username]["contrasena"];
        $palabrasOriginales = $usuarios[$username]["KeysWords"];

       

        if (verificarCredenciales($password, $contrasena_original) && verificarCredenciales($palabras, $palabrasOriginales)) {
            // Almacenar solo el ID de usuario en la sesión
            $_SESSION['usuario_id'] = $username;
           
            
            header("Location: boveda_menu.php");
            exit();
        } else {
            mostrarError("Tus credenciales no coinciden");
        }
    } else {
        echo "Tu usuario no ha sido encontrado, vuelve a intentarlo";
        echo "<br> <a href='login_index.php'>Iniciar sesión</a>";
        exit();
    }
} else {
    mostrarError("Fallo en la red");
}

// Funciones auxiliares

function obtenerUsuarios() {
    $usuarios = [];
    $archivo = __DIR__ . '/../JSON/usuarios.json';

    if (file_exists($archivo) && is_readable($archivo)) {
        $file_contents = file_get_contents($archivo);

        if ($file_contents !== false) {
            $usuarios = json_decode($file_contents, true);
        } else {
            mostrarError("No se logró obtener el archivo $archivo. Vuelve a intentarlo o crea el archivo.");
        }
    } else {
        mostrarError("No se logró conectar a la base de datos JSON o no existe");
    }

    return $usuarios;
}

function existeUsuario($usuarios, $username) {
    return isset($usuarios[$username]);
}

function verificarCredenciales($input, $hash) {
    return password_verify($input, $hash);
}

function mostrarError($mensaje) {
    echo $mensaje . "<br> <a href='login_index.php'>Iniciar sesión</a>";
    echo "<br> Si has olvidado tus credenciales, puedes restablecerlas <a href='reestablecer_correo.php'>aquí</a>.";
    exit();
}
?>
