<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoge los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // **AQUÍ ES DONDE PONES LA DIRECCIÓN DE CORREO DESTINO**
    $recipient = "info@engrossedgames.com"; // <-- ¡Cambia esto por tu dirección de correo!

    // Asunto del correo
    $subject = "Nuevo mensaje de contacto de: $name";

    // Contenido del correo
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Encabezados del correo
    $email_headers = "From: $name <$email>";

    // Envía el correo
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Éxito: Redirige al usuario a una página de agradecimiento o muestra un mensaje
        header("Location: /thank_you.html?success=true");
        exit;
    } else {
        // Error: Redirige o muestra un mensaje de error
        header("Location: /thank_you.html?success=false");
        exit;
    }
} else {
    // Si alguien intenta acceder directamente a este script sin enviar el formulario
    http_response_code(403);
    echo "Hubo un problema con tu envío, por favor inténtalo de nuevo.";
}
?>