<?php
    session_start();

    if(isset($_POST)){
        $datos_del_formulario = $_POST;
        $_SESSION['datos_del_formulario'] = $datos_del_formulario;

    
    }

    $words = [
        "manzana", "amarillo", "cascada", "tecnología", "sol", "guitarra", "montaña", "familia",
        "fútbol", "astronomía", "oceano", "aventura", "espejo", "universo", "sinfonía", "cáscara",
        "elefante", "volar", "imaginación", "risa", "caballo", "sueño", "rápido", "esmeralda",
        "oculto", "fantasía", "invierno", "equilibrio", "inocente", "luz", "diamante", "canción",
        "jardín", "mariposa", "notas", "selva", "teatro", "café", "velero", "alegría", "viaje",
        "inspiración", "espejismo", "corazón", "radio", "sombra", "fuego", "orquídea", "tren",
        "pintura", "silueta", "nebulosa", "paz", "catedral", "alquimia", "frágil", "brillante",
        "laberinto", "sinfonía", "pluma", "efímero", "ventana", "deseo", "esencia", "serenidad",
        "fragancia", "cristal", "serpiente", "azul", "aventura", "reloj", "épico", "amanecer",
        "coraje", "luminoso", "orilla", "encanto", "crepúsculo", "travesía", "arcoiris", "péndulo"
    ];

    $keysWords = [];
    $WordsMax = count($words)/2;

    for ($i = 0; $i < $WordsMax; $i++) {
        $indice = random_int(0, $WordsMax);
        $keysWords[] = $words[$indice];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro</title>
        <style>
            body, html {
                height: 100%;
                margin: 0;
                background-color: #f0f8ff; /* Tono claro de azul */
            }

            table {
                margin: auto; /* Centrar la tabla */
                border-collapse: collapse;
            }

            .titulo {
                text-align: center;
                color: #3498db; /* Azul */
                font-size: 24px;
                margin-top: 20px;
            }

            .tablaBotones {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            .boton {
                background-color: #3498db; /* Azul */
                color: #fff; /* Blanco */
                border: none;
                padding: 15px;
                margin: 5px;
                cursor: pointer;
                font-size: small;
                width: 100px; /* Ancho fijo para cada botón */
                height: 50px; /* Altura fija para cada botón */
            }

            .boton:hover {
                background-color: #2980b9; /* Azul más oscuro al pasar el ratón */
            }

            #registrar {
                background-color: #2ecc71; /* Verde */
            }

            #registrar:hover {
                background-color: #27ae60; /* Verde más oscuro al pasar el ratón */
            }
        </style>
    </head>
    <body>
        <table>
            <h1 class="titulo">Palabras Clave</h1>
            <tr class="tablaBotones">
                <?php $indice_palabras = 0; ?>
                <?php $KeysNewswords = [] ?>

                <?php foreach ($keysWords as $Word) : ?>
                    <?php $indice_palabras =  $indice_palabras + 1; ?>
                    <?php $KeysNewswords[] .= $Word . strval($indice_palabras); ?>

                    <td>
                        <button class="boton" value="<?= $Word . strval($indice_palabras) ?>" name='<?= $Word.strval($indice_palabras) ?>' id="<?= $Word . strval($indice_palabras) ?>" onclick="newWord('<?= $Word.strval($indice_palabras) ?>')"> <?= $Word ?> </button>
                    </td>

                    <?php if ($indice_palabras % 8 === 0): ?>
                        </tr>
                        <tr class="tablaBotones">
                    <?php endif; ?>

                <?php endforeach; ?>
            </tr>
            <tr>
                <td colspan="8">
                    <form action="procesar_Register.php" method="post" id="Formulario_Key_User">
                        <input type="text" hidden id="keysWordsUser" name="keysWordsUser" value="">
                        <input type="text" hidden id="keysWords" name="keysWords" value="">
                    </form>
                    <button class="boton" value="registrar" name="registrar" id="registrar" onclick="registrar()"> Registrar </button>
                </td>
            </tr>
        </table>

        <script>
            let variable_Palabras = document.getElementById("keysWordsUser");
            let keysWordsPrivate = [];

            // Genera código JavaScript que asigna el array PHP a una variable JavaScript
            let keysWords = <?php echo json_encode($KeysNewswords); ?>;

            document.getElementById("keysWords").value = keysWords.join(','); //Convertir el array a una cadena

            function newWord(newPalabra) {
                if(!keysWordsPrivate.includes(newPalabra)){
                    keysWordsPrivate.push(newPalabra);
                    // Cambiar el color de fondo del botón clicado
                    document.getElementById(newPalabra).style.backgroundColor = "#e74c3c"; // Rojo
                }
                variable_Palabras.value = keysWordsPrivate.join(','); // Convertir el array a una cadena
            }

            function registrar() {
                if(keysWordsPrivate.length >= 2){
                    // Enviar datos al servidor
                    // Por ejemplo, puedes usar AJAX o simplemente enviar el formulario
                    document.getElementById("Formulario_Key_User").submit();
                    alert("Palabras seleccionadas: " + variable_Palabras.value);
                } else {
                    // Puedes agregar un mensaje de error si no se han seleccionado suficientes palabras
                    alert("Selecciona al menos 2 palabras.");
                }
            }
        </script>
    </body>
</html>