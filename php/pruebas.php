 <?php
 $to = "contacto@lycsystem.com";
        $subject = "Nuevo mensaje de contacto desde el sitio web";
        $body = "Nombre:";
        $headers = "From: ";
        
        // Enviar el correo
        if (mail($to, $subject, $body, $headers)) {
            echo "Mensaje enviado exitosamente.";
        } else {
            echo "Error al enviar el mensaje.";
        }
        

?>