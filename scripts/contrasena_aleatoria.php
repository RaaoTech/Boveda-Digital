<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bóveda - Ingreso</title>
    <style>
        /* Paleta de colores */
        :root {
            --color-primario: #777;
            --color-primario-hover: #555;
            --color-fondo: #333;
            --color-borde: #ccc;
            --color-texto: #333;
            --color-boton-texto: #fff;
            --color-aclaratoria: #555;
        }

        /* Estilos generales */
        body {
            background-color: var(--color-fondo);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        /* Estilos para el formulario */
        .formulario {
            background-color: #fff;
            padding: 20px;
            margin: 25px;
            border-radius: 5px;
            text-align: center;
            width: 90%;
            max-width: 400px; /* Ancho máximo del formulario */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra ligera */
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: var(--color-texto);
        }

        .campo-input {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid var(--color-borde);
            border-radius: 3px;
            box-sizing: border-box;
        }

        .boton-ingresar,
        .boton-generar,
        .boton_displayPassword {
            background-color: var(--color-primario);
            color: var(--color-boton-texto);
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .boton-generar:hover,
        .boton_displayPassword:hover {
            background-color: var(--color-primario-hover); /* Cambia el color al pasar el mouse */
        }

        .password_container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .aclaratoria {
            font-size: small;
            margin: 10px 0;
            color: var(--color-aclaratoria);
        }
    </style>
</head>
<body>
    <div class="formulario">
        <div class="titulo">Nueva contraseña</div>
        <div class="aclaratoria">Si se desea cambiar algún dato, puede ingresar el mismo "USO" y cambiar los datos restantes.</div>

        <!-- Formulario para ingresar datos -->
        <form action="procesar_contrasena.php" method="post">
            <input type="text" name="usuario" class="campo-input" placeholder="Usuario" required>

            <section class="password_container">
                <input type="password" name="contrasena" id="contrasenass" class="campo-input" placeholder="Contraseña" required autocomplete="current-password">
                <input type="button" onclick="togglePasswordVisibility()" class="boton_displayPassword" value="Mostrar">
            </section>
            

            <input type="text" name="uso" class="campo-input" placeholder="Uso" required>

            <div class="aclaratoria">CUIDADO con colocar el mismo USO que uno existente, porque se cambiarán los datos del USO anterior.</div>

            <!-- Botón para ingresar -->
            <button type="submit" class="boton-ingresar">Ingresar</button>
        </form>

        <!-- Botón para generar contraseñas aleatorias -->
        <button type="button" class="boton-generar" onclick="generarContrasena( valorSeleccionado)">Generar Contraseña Aleatoria</button>

        <form id="password_aleatorio">

            <input type="radio" name="cantidad" value="12"> 12 caracteres
            <input type="radio" name="cantidad" value="24"> 24 caracteres

        </form>
    </div>

    <script>

        let contrasena = document.getElementById("contrasenass");  //input donde se guarda la contrasena
        
        let formulario = document.getElementById("password_aleatorio"); // dormulario donde se guardan los inputs de tipo radio con la cantidad de carecteres

        let valorSeleccionado = 24; // cantidad de carecteres permitidos



        // Agregar un evento de cambio al formulario
        formulario.addEventListener("change", function(evento) {
            // Verificar si el evento provino de un radio
            if (evento.target.type === "radio") { 

                // Obtener el valor del radio seleccionado y pasalo de string a entero
                valorSeleccionado = parseInt(evento.target.value);

            }
            
        });
        
        // Función para ocultar/convertir en tipo text el input password
        function togglePasswordVisibility(){

            if(contrasena.type == "password"){
                contrasena.type = "text";
            }else{
                contrasena.type = "password";
            }

            console.log(contrasena.type);
        }

         // Función para generar contraseñas aleatorias
        function generarContrasena(max) {

            //variable donde se guaradara la contrasena
            let contrasenaAleatoria = '';

            //caracteres aceptados y que pueden ser parte de la contrasena aleatoria
            let mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            let minusculas = 'abcdefghijklmnopqrstuvwxyz';
            let especiales = '*+@_-.,;:[¨´|°}]*{[=)(/&%$#"!@¡¿?]';
            let numero = '123456789';

            //Se itera la cuarta parte del maximo de caracteres permitidos
            for (let i = 1; i <= Math.floor(max / 4); i++) {

            let mayusc = Math.floor(Math.random() * mayusculas.length );
            let minusc = Math.floor(Math.random() * minusculas.length );
            let espec = Math.floor(Math.random() * especiales.length );
            let number= Math.floor(Math.random() * numero.length );

    
              contrasenaAleatoria += mayusculas.charAt(mayusc);
              contrasenaAleatoria += minusculas.charAt(minusc);
              contrasenaAleatoria += especiales.charAt(espec);
              contrasenaAleatoria += numero.charAt(number);
            }

            // Asigna la contraseña generada al campo de contraseña
            document.getElementsByName("contrasena")[0].value = contrasenaAleatoria;

            console.log(contrasenaAleatoria);
        }
    </script>
</body>
</html>

