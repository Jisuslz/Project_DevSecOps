<?php
session_start();

// Función para cerrar la sesión
function logout() {
    session_unset();
    session_destroy();
    header("Location: acceso.php");
    exit;
}

// Verificar si hay actividad reciente del usuario
if (isset($_SESSION['ultima_actividad']) && (time() - $_SESSION['ultima_actividad'] > 900)) { // 900 segundos = 15 minutos
    logout();
}

// Actualizar la última actividad del usuario
$_SESSION['ultima_actividad'] = time();

// Redirigir al usuario a la página de inicio de sesión si no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: acceso.php");
    exit;
}

// Si se ha enviado el formulario de salida, cerrar la sesión
if (isset($_POST['logout'])) {
    logout();
}

$usuario = htmlspecialchars($_SESSION['usuario']); // Sanitizar el nombre de usuario

// Obtener la dirección IP del usuario
$ip_usuario = $_SERVER['REMOTE_ADDR'];

// Obtener la hora exacta de inicio de sesión
$hora_inicio_sesion = date('Y-m-d H:i:s');

// Obtener el agente de usuario del cliente
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Conectar con la base de datos
include "config.php";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener el nombre y el documento del usuario
    $consulta = "SELECT nombre, documento FROM usuario WHERE usuario = :usuario";
    $statement = $conn->prepare($consulta);
    $statement->bindParam(':usuario', $usuario);
    $statement->execute();

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $nombre = $row['nombre'] ?? 'No especificado';
    $documento = $row['documento'] ?? 'No especificado';

    // Consulta para obtener los mensajes de contacto
    $consultaMensajes = "SELECT * FROM mensajes_contacto";
    $statementMensajes = $conn->prepare($consultaMensajes);
    $statementMensajes->execute();
    $mensajes = $statementMensajes->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

// Cerrar la conexión con la base de datos
$conn = null;

// Establecer la directiva HttpOnly y SameSite para la cookie de sesión
$cookieParams = session_get_cookie_params();
session_set_cookie_params([
    'lifetime' => $cookieParams['lifetime'],
    'path' => $cookieParams['path'],
    'domain' => $cookieParams['domain'],
    'secure' => true, // Usar solo con HTTPS
    'httponly' => true,
    'samesite' => 'Strict' // Alternativamente, 'Lax' o 'None' según tus necesidades
]);

// Regenerar el ID de sesión para prevenir ataques de session fixation
session_regenerate_id(true);
//echo "ID de sesión regenerado: " . session_id(); // Mostrar el nuevo ID de sesión
// Esta implementación asume que estás utilizando HTTPS en tu sitio web para proteger adecuadamente la cookie de sesión.
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <style>
        body {
            background-image: url('Anexos/fondoUM.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh; /* Altura del viewport */
            margin: 0; /* Elimina el margen predeterminado */
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: rgba(5, 5, 5, 0.8);
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
        }
        .container {
            max-width: 600px;
            margin: 50px auto 0 50px; /* Margen superior, margen derecho, margen inferior, margen izquierdo */
            padding: 20px;
            /* background-color: #fff; */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative; /* Agregado para posicionar los botones */
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin-bottom: 10px;
        }
        .mensaje {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            /* float: center; No es una propiedad válida */
            clear: both; /* Evita que los elementos floten a su alrededor */
            max-width: 70%; /* Limita el ancho del contenedor de mensajes */
        }
        .buttons-container {
            position: absolute;
            top: 20px; /* Ajusta la posición vertical */
            left: 20px; /* Ajusta la posición horizontal */
        }
        .buttons-container form {
            display: inline-block;
        }
    </style>
</head>
<body>       
    <div class="buttons-container">
        <!-- Formulario para redirigir a horariosestudiante.php -->
        <form action="HorariosIngenierias.php" method="GET" style="display: inline;">
            <input type="submit" value="Mi horario">
        </form>
            
        <!-- Formulario para redirigir a horariosdocentes.php -->
        <form action="HorariosDocentes.php" method="GET" style="display: inline;">
            <input type="submit" value="Horarios Docentes">
        </form>

        <!-- Formulario para redirigir a horariosdocentes.php -->
        <form action="calificaciones.php" method="GET" style="display: inline;">
            <input type="submit" value="Historial de notas">
        </form>

         <!-- Formulario para redirigir a matricula.php -->
         <form action="http://localhost/Laboratorios/Laboratorio8/registros/matricula.html" method="GET" style="display: inline;">
            <input type="submit" value="Cursos">
        </form>
    </div>
    <div class="mensaje">
        <form method="post">
            <h1>Bienvenido, <?php echo $usuario; ?>!</h1>
            <p>Dirección IP: <?php echo $ip_usuario; ?></p>
            <p>Hora de inicio de sesión: <?php echo $hora_inicio_sesion; ?></p>
            
            
            <p>Has iniciado sesión correctamente.</p>
            <div class="details">
                <p>Nombre: <?php echo $nombre; ?></p>
                <p>Documento: <?php echo $documento; ?></p>
            <input type="submit" name="logout" value="Salir">
        </form>
    </div>
    <!-- Mostrar mensajes -->
    <div class="mensajes">
        <h2>Mensajes de Contacto</h2>
        <?php foreach ($mensajes as $mensaje): ?>
            <div class="mensaje">
                <p><strong>Nombre:</strong> <?php echo $mensaje['nombre']; ?></p>
                <p><strong>Email:</strong> <?php echo $mensaje['email']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $mensaje['telefono']; ?></p>
                <p><strong>Mensaje:</strong> <?php echo $mensaje['mensaje']; ?></p>
                <p><strong>Fecha de envío:</strong> <?php echo $mensaje['fecha_envio']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        // Función para recargar la sesión cada 5 segundos (5000 milisegundos)
        setInterval(function() {
            // Realizar una solicitud AJAX para recargar la sesión
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'main.php', true);
            xhr.send();
        }, 5000); // 5 segundos en milisegundos
    </script>
</body>
</html>
