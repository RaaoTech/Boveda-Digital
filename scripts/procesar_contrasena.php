<?php
    session_start();

    $username = $_SESSION['usuario_id'];

    

    // Especifica la ruta y el nombre del archivo JSON
    $archivo_json = __DIR__ . '/../JSON/'.$username.'.json';

    // Leer el contenido del archivo JSON (si existe)
    if (file_exists($archivo_json)) {
        $passwords = json_decode(file_get_contents($archivo_json), true);
    }else{
        //crear el nuevo array general
        $passwords=[];
        // Guarda el array general en un archivo JSON
        file_put_contents($archivo_json, json_encode($passwords));

        $passwords = json_decode(file_get_contents($archivo_json), true);
    }

    echo "<pre>";
    print_r($passwords);
    echo "</pre>";

    // Verifica si se ha enviado información
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($passwords)) {
        // Obtén los datos del formulario (ejemplo)
        $usuario = $_POST["usuario"];
        $contrasena = $_POST["contrasena"];
        $uso = $_POST["uso"];

        $s = false;

        if(isset($password[$uso])){

            $s = true;
            
            if($desicion == "S" || $desicion == "Si"){

                

            }else{
                // Redirige al usuario a otro archivo PHP
                header("Location: boveda_menu.php");
                exit; // Asegúrate de detener la ejecución del script después de la redirección

            }
        }

        // Crea un nuevo subarray con los datos
        $nuevaPassword = [
            "usuario" => $usuario,
            "contrasena" => $contrasena,
            "uso" => $uso
        ];
        // Agrega el subarray al array general
        $passwords[$uso] = $nuevaPassword;

        

        // Guarda el array general en un archivo JSON
        file_put_contents($archivo_json, json_encode($passwords));

        // Redirige al usuario a otro archivo PHP
        header("Location: boveda_menu.php");
        exit; // Asegúrate de detener la ejecución del script después de la redirección
    }
?>
<script> 
    if(<?= $s ?>){

        prompt("Tu USO es igual a uno existente, si dices que SI, se cambiaran los datos del uso anterior, estas seguro en tu desicion (S/N)?");

    }
</script>

