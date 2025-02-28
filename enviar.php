<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $asunto = htmlspecialchars($_POST["subject"]);
    $mensaje = htmlspecialchars($_POST["message"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Correo electrónico inválido'); window.history.back();</script>";
        exit;
    }

    $destinatario = "impactoverderesponsable@gmail.com";
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo electrónico: $email\n";
    $contenido .= "Asunto: $asunto\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($destinatario, "Contacto - Impacto Verde Responsable", $contenido, $headers)) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='index.html';</script>"; // Redirige a index.html
    } else {
        echo "<script>alert('Hubo un error al enviar el mensaje. Intenta nuevamente.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Acceso no permitido'); window.location.href='index.html';</script>";
}
?>