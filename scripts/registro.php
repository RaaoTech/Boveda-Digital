<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Configuración del documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Estilos CSS mejorados para mejorar la presentación -->
    <style>
        /* Estilos generales del cuerpo de la página */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Color de fondo */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Estilos para el contenedor del formulario de registro */
        .registration-container {
            background-color: #ffffff; /* Color de fondo del contenedor */
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        /* Estilos para el título del formulario */
        .registration-container h2 {
            margin-bottom: 20px;
            color: #007BFF; /* Color del título */
        }

        /* Estilos para los grupos de formularios */
        .form-group {
            margin-bottom: 20px;
        }

        /* Estilos para las etiquetas de los formularios */
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #495057; /* Color del texto de la etiqueta */
        }

        /* Estilos para los campos de texto del formulario */
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da; /* Color del borde del campo de texto */
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Estilos para el botón del formulario */
        .form-group button {
            background-color: #007BFF; /* Color de fondo del botón */
            color: #fff; /* Color del texto del botón */
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        /* Estilos para el enlace de inicio de sesión */
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6c757d; /* Color del texto del enlace de inicio de sesión */
        }

        /* Estilos para el enlace de inicio de sesión */
        .login-link a {
            color: #007BFF; /* Color del enlace de inicio de sesión */
            text-decoration: none;
        }

        /* Estilo para los botones */
        button {
            background-color: #007BFF; /* Color de fondo del botón */
            color: #fff; /* Color del texto del botón */
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            margin: 3%;
            font-size: 16px;
        }

        /* Estilos adicionales para pantallas pequeñas */
        @media (max-width: 768px) {
            .registration-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal del formulario de registro -->
    <div class="registration-container">
        <!-- Título del formulario -->
        <h2>Registro</h2>
        <!-- Formulario de registro -->
        <form action="keys_words.php" method="POST">
            <!-- Grupo de formulario para el nombre de usuario -->
            <div class="form-group">
                <label for="username">Correo Electronico:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <!-- Grupo de formulario para la contraseña -->
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>
            <!-- Botón de envío del formulario -->
            <button type="submit">Registrarse</button>
        </form>
        <!-- Enlace de inicio de sesión -->
        <div class="login-link">
            <p>¿Ya tienes una cuenta? <a href="login_index.php">Iniciar Sesión</a></p>
        </div>
    </div>
</body>
</html>
