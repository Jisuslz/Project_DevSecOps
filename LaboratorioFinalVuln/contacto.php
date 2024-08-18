<?php
// Verifica si se recibieron datos del formulario
if (isset($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['mensaje'])) {
    // Recibe los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Conexión a la base de datos
    // Configuración de la base de datos
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'umanizales';

    try {
        // Conexión a la base de datos
        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
        
        // Prepara la consulta SQL para insertar los datos en la tabla
        $sql = "INSERT INTO mensajes_contacto (nombre, email, telefono, mensaje) VALUES ('$nombre', '$email', '$telefono', '$mensaje')";
        
        // Ejecuta la consulta
        $conn->exec($sql);

        // Redirige al usuario a una página de confirmación
        header('Location: contacto.html');
        exit();
    } catch(PDOException $e) {
        // Muestra un mensaje genérico al usuario
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
