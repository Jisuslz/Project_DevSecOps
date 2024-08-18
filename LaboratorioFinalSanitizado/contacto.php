<?php
// Verifica si se recibieron datos del formulario
if (isset($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['mensaje'])) {
    
    // Lista blanca de etiquetas HTML seguras
    $allowedTags = ['p', 'br', 'strong', 'em', 'a', 'h1','h2'];

    // Función de sanitización personalizada para utilizar con filter_input
    function sanitizeWithAllowedTags($input) {
        global $allowedTags;
        return strip_tags($input, '<' . implode('><', $allowedTags) . '>');
    }

    // Recibe los datos del formulario y los sanitiza
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_CALLBACK, ['options' => 'sanitizeWithAllowedTags']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_CALLBACK, ['options' => 'sanitizeWithAllowedTags']);

    // Conexión a la base de datos
    include "config.php";

    try {
        // Conexión a la base de datos
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje) VALUES (:nombre, :email, :telefono, :mensaje)";
        $statement = $conn->prepare($sql);
        
        // Bind parameters
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':telefono', $telefono);
        $statement->bindParam(':mensaje', $mensaje);

        // Ejecuta la consulta
        $statement->execute();

        // Redirige al usuario a una página de confirmación
        header('Location: contacto.html');
        exit();
    } catch(PDOException $e) {
        // Registra el error en un registro interno y muestra un mensaje genérico al usuario
        error_log("Error al insertar el mensaje: " . $e->getMessage());
        echo "Ocurrió un error al enviar el mensaje. Por favor, inténtalo más tarde.";
    }

    // Cierra la conexión a la base de datos
    $conn = null;

    // Limpia las variables de memoria
    unset($nombre);
    unset($email);
    unset($telefono);
    unset($mensaje);
} else {
    // Si no se recibieron todos los datos del formulario, muestra un mensaje de error
    echo "No se han recibido todos los datos del formulario.";
}
?>
