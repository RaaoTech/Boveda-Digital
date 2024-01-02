<?php
session_start();
echo "Procesando su envío";

$correo_de_la_boveda_digital = 'r440gz@gmail.com';
$contrasena_correo_boveda_digital = 'dvbs cfnr zzqo gzwj';

$usuario = $_SESSION['credenciales'][0];
$password = $_SESSION['credenciales'][1];
$palabras = $_SESSION['credenciales'][2];

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

// Configuración del servidor SMTP de Gmail
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = $correo_de_la_boveda_digital; // Tu dirección de correo electrónico de Gmail
$mail->Password = $contrasena_correo_boveda_digital; // Tu contraseña de Gmail
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
$mail->Port       = 587;                                    // TCP port to connect to
$mail->CharSet = 'UTF-8';



// Configuración adicional para producción
// Desactiva la depuración SMTP

// Configuración del remitente y destinatario
$mail->setFrom($correo_de_la_boveda_digital, 'Boveda Digital');
$mail->addAddress($usuario, 'Nombre Destinatario');

// Contenido del correo
$mail->isHTML(true);
$mail->Subject = 'Restablecer Credenciales';
$mail->Body =  '<p>Hola,</p>
                <p>Da click al siguiente boton para reestablecer tus credenciales.</p>
                <a href="http://localhost/boveda_digital/NuevasCreedenciales.php">
                    <button style="background-color: #4CAF50; color: white; padding: 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 5px;">Ir a la Página</button>
                </a>';

try {
    // Enviar el correo electrónico
    if ($mail->send()) {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Renovar Credenciales</title>
        </head>
        <body>
            <h1>Dirigete a tu correo</h1>
        
            <a href="https://mail.google.com/mail">gmail.com</a>
            
        </body>
        </html>';
    } else {
        throw new Exception('Error al enviar el correo: ' . $mail->ErrorInfo);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
