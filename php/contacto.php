<?php
// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../phpmailer/phpmailer/src/Exception.php';
require '../phpmailer/phpmailer/src/PHPMailer.php';
require '../phpmailer/phpmailer/src/SMTP.php';
 

// Validar que sea una petición POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit;
}

// Obtener datos del formulario
$nombre = sanitize($_POST['nombre'] ?? '');
$email = sanitize($_POST['email'] ?? '');
$mensaje = sanitize($_POST['mensaje'] ?? '');

// Validar campos requeridos
if (empty($nombre) || empty($email)  || empty($mensaje)) {
    http_response_code(400);
    echo json_encode(['error' => 'Todos los campos son requeridos']);
    exit;
}

// Validar formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Email inválido']);
    exit;
}

// Configurar email




/* Mostrar errores PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */








// Inicio
$mail = new PHPMailer(true);

try {
    // Configuracion SMTP
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                         // Mostrar salida (Desactivar en producción)
    $mail->isSMTP();                                               // Activar envio SMTP
    $mail->Host  = 'mail.lycsystem.com';                     // Servidor SMTP
    $mail->SMTPAuth  = true;                                       // Identificacion SMTP
    $mail->Username  = 'notificaciones@lycsystem.com';                  // Usuario SMTP
    $mail->Password  = 'LYC$qwertyui8';	          // Contraseña SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port  = 26;                                            // Puerto SMTP
    $mail->setFrom('notificaciones@lycsystem.com', 'Notificaciones LYC');                // Remitente del correo

    // Destinatarios
    $mail->addAddress('contacto@lycsystem.com', $nombre);  // Email y nombre del destinatario

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Notificacion de contacto desde el sitio web';
    $mail->Body  = 'Te han contactado desde el sitio web. Aquí están los detalles:<br><br>' .
                   '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '<br>' .
                   '<strong>Email:</strong> ' . htmlspecialchars($email) . '<br>' .
                   '<strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($mensaje));
    $mail->send();
    echo 'El mensaje se ha enviado';



} catch (Exception $e) {
    echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
}






/// mail para cliente

$mail2 = new PHPMailer(true);

try {
    // Configuracion SMTP
    //$mail2->SMTPDebug = SMTP::DEBUG_SERVER;                         // Mostrar salida (Desactivar en producción)
    $mail2->isSMTP();                                               // Activar envio SMTP
    $mail2->Host  = 'mail.lycsystem.com';                     // Servidor SMTP
    $mail2->SMTPAuth  = true;                                       // Identificacion SMTP
    $mail2->Username  = 'notificaciones@lycsystem.com';                  // Usuario SMTP
    $mail2->Password  = 'LYC$qwertyui8';	          // Contraseña SMTP
    $mail2->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail2->Port  = 26;                                            // Puerto SMTP
    $mail2->setFrom('notificaciones@lycsystem.com', 'Notificaciones LYC');                // Remitente del correo

    // Destinatarios
    $mail2->addAddress($email, $nombre);  // Email y nombre del destinatario

    // Contenido del correo
    $mail2->isHTML(true);
    $mail2->Subject = 'Notificacion de contacto desde el sitio web';
    $mail2->Body  = 'Tu mensaje ha sido recibido. En breve nos comunicaremos con usted.<br><br>' .
                     'Aquí están los detalles que nos proporcionaste:<br><br>' .
                     '<strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '<br>' .
                     '<strong>Email:</strong> ' . htmlspecialchars($email) . '<br>' .
                     '<strong>Mensaje:</strong><br>' . nl2br(htmlspecialchars($mensaje)) . '<br><br>' .
                     'Gracias por contactarnos,<br>El equipo de LYC System';
    $mail2->send();
    echo 'El mensaje se ha enviado';


header("Location: ../index.html?success=1");
} catch (Exception $c) {
    echo "El mensaje no se ha enviado. Mailer Error: {$mail2->ErrorInfo}";
}
























// Función para sanitizar datos
function sanitize($data) {
    return trim(stripslashes(htmlspecialchars($data)));
}
?>