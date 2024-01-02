<?php
// Inicia la sesión para acceder a las variables de sesión
session_start();

// Obtiene el nombre de usuario y las credenciales de la sesión actual
$username = $_SESSION['usuario_id'];





$ContrasenaBoveda =  $_SESSION['credencialesCorrectas']['contrasenaBoveda'];
$PalabrasClaves =explode(",",$_SESSION['credencialesCorrectas']['keysWords']); 



// Especifica la ruta y el nombre del archivo JSON asociado al usuario
$archivo_json = __DIR__ . '/../JSON/'. $username.'.json';

// Lee el contenido del archivo JSON (si existe)
if (file_exists($archivo_json)) {
    $passwords = json_decode(file_get_contents($archivo_json), true);
} else {
    // Si no existe el archivo, se inicializa como un array vacío
    $passwords = [];
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bóveda</title>
    <style>
       /* Estilos CSS para la interfaz de la Bóveda */

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

header {
    background-color: #333;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

#cerrar-boveda, #nueva-password {
    background-color: #777;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#cerrar-boveda:hover, #nueva-password:hover {
    background-color: #555;
}

#titulo-boveda {
    font-size: 24px;
    font-weight: bold;
}

#contenido {
    margin: 20px;
    flex: 1;
}

.contrasena, #usuario, #uso {
    display: grid;
    width: 90%;
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 10px;
    text-align: center;
    background-color: #f5f5f5;
}

#nueva-password {
    width: 90%;
    background-color: #777;
    color: #fff;
    font-weight: bold;
}

footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
}

.boton-borrar {
    background-color: #ff3b30;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
}

.boton-borrar:hover {
    background-color: #ff453a;
}

.contrasenaP {
    margin: 0;
}

.input_boton_cerrar {
    width: 0;
    height: 0;
}

/* Media queries para hacer la página responsive */

@media only screen and (max-width: 600px) {
    /* Estilos para pantallas con un ancho máximo de 600px */
    header {
        flex-direction: column;
        align-items: flex-start;
    }

    #cerrar-boveda, #nueva-password {
        width: 100%;
        margin-top: 10px;
    }

    .contrasena, #usuario, #uso, #nueva-password {
        width: 100%;
    }
    
   
}
    </style>
</head>
<body>
    <!-- Encabezado de la Bóveda -->
    <header>
        <!-- Título de la Bóveda -->
        <div id="titulo-boveda">BÓVEDA</div>
           
        <!-- Formulario para cerrar la sesión del usuario -->
        <form action="\boveda_digital\index.html" method="post">
            <button id="cerrar-boveda">Cerrar Bóveda</button>
        </form>
        </header>
    
    <!-- Contenido principal de la Bóveda -->
    <div id="contenido">
    <div id="datosUsuario" class ="contrasena">

        <p class="contrasenaP">Uso: Boveda Digital</p>
        <br>
        <p class="contrasenaP">Usuario: <?= $username?></p>
        <br>
        <p class="contrasenaP">Contrasena: <?= $ContrasenaBoveda?></p>
        <br>
        <p class="contrasenaP" id="keys" >Palabras Claves: 
            <?php  echo implode(", ",$PalabrasClaves); ?>
        </p>
        <br>
    </div>
        <!-- Itera sobre las contraseñas almacenadas y las muestra -->
        <?php foreach($passwords as $indice => $password): ?>

            <div id="<?= $indice ?>" class ="contrasena">

                <p class="contrasenaP">Uso: <?= $password['uso']?></p>
                <br>
                <p class="contrasenaP">Usuario: <?= $password['usuario']?></p>
                <br>
                <p class="contrasenaP" >Contraseña: <?= $password['contrasena']?></p>
                <br>
                <!-- Formulario para borrar la contraseña -->
                <form action="boton_cerrar.php" method="post">
                    <!-- Se envía el índice de la contraseña como valor oculto -->
                    <input type="hidden" class="input_boton_cerrar" name="input" value="<?= $indice ?>">
                    <button class="boton-borrar" >Borrar</button>
                </form>
            </div>
        <?php endforeach ?>

        <!-- Formulario para generar una nueva contraseña aleatoria -->
        <form action="contrasena_aleatoria.php" method="post">
            <button id="nueva-password" type="submit">Nueva o Editar Contrasena</button>
        </form>       
    </div>

    <!-- Pie de página de la Bóveda -->
    <footer>
        Contacto
    </footer>
</body>
</html>

