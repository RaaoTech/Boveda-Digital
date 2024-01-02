<?php
session_start();

$username = $_SESSION['usuario_id'];

$Array_a_borrar = $_POST['input']; // La clave que deseas borrar


// Especifica la ruta y el nombre del archivo JSON
$archivo_json = __DIR__ . '/../JSON/'.$username.'.json';

// Paso 1: Lee el archivo JSON y decódificalo en un array PHP
$datos = file_get_contents($archivo_json);
$arrayJSON = json_decode($datos, true);


// Paso 2: Realiza la operación de eliminación
if (isset($arrayJSON[$Array_a_borrar])) {
    unset($arrayJSON[$Array_a_borrar]);
    echo "borrado";
}

// Paso 3: Codifica el array PHP actualizado nuevamente en formato JSON
$jsonActualizado = json_encode($arrayJSON);

// Paso 4: Escribe el JSON actualizado de vuelta al archivo
file_put_contents($archivo_json, $jsonActualizado);

$datos = file_get_contents($archivo_json);
$arrayJSON = json_decode($datos, true);


echo "Elemento borrado con éxito.";

 // Redirige al usuario a otro archivo PHP
 header("Location: boveda_menu.php");
 exit; // Asegúrate de detener la ejecución del script después de la redirección

?>