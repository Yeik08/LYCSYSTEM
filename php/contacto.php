<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $servicio = htmlspecialchars($_POST['servicio']);
    $message = htmlspecialchars($_POST['message']);
    
    // Validar datos básicos
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Configurar el correo
        $to = "contacto@lycsystem.com";
        $subject = "Nuevo mensaje de contacto desde el sitio web";
        $body = "Nombre: $name\nEmail: $email\nMensaje:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\n";
        
        // Enviar el correo
        if (mail($to, $subject, $body, $headers)) {
            echo "Mensaje enviado exitosamente.";
        } else {
            echo "Error al enviar el mensaje.";
        }
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
} else {
    echo "Método no permitido.";
}
?>