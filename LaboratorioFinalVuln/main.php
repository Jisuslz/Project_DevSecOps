<?php
session_start();

// No se realiza ninguna verificación de autenticación del usuario aquí

// No se realiza ninguna verificación del formulario de salida

// No es necesario sanitizar el nombre de usuario aquí
$usuario = $_SESSION['usuario'];

// Configuración de la base de datos
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'umanizales';

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    // No es configurar el modo de error de excepción aquí

    // Consulta para obtener el nombre y el documento del usuario - Totalmente vulnerable a inyección SQL
    $consulta = "SELECT nombre, documento FROM usuario WHERE usuario = '$usuario'";
    $statement = $conn->query($consulta); // No es necesario preparar la consulta debido a que no hay parámetros externos

    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $nombre = $row['nombre'] ?? 'No especificado';
    $documento = $row['documento'] ?? 'No especificado';

    // Consulta para obtener los mensajes de contacto - Vulnerable a inyección SQL
    $consultaMensajes = "SELECT * FROM mensajes_contacto";
    $statementMensajes = $conn->query($consultaMensajes); // No es necesario preparar la consulta debido a que no hay parámetros externos
    $mensajes = $statementMensajes->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // No se manejan los errores de conexión aquí
    echo "Error de conexión: " . $e->getMessage();
}

// No se cierra la conexión con la base de datos aquí
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
</body>
</html>
