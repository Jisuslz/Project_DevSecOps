<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['usuario'])) {
    header("Location: main.php");
    exit;
}

// Conectar a la base de datos
include "config.php";

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar datos del formulario
        $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
        $contraseña = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_STRING);

        // Verificar si el usuario está bloqueado
        $query = "SELECT * FROM usuario WHERE usuario = :usuario";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($user['intentos_fallidos'] >= 3) {
                // Comprobar si ha pasado el tiempo de bloqueo
                $current_time = time();
                $lockout_time = strtotime($user['tiempo_bloqueo']);
                if ($current_time < $lockout_time) {
                    $error_message = "Ocurrió un error durante el proceso. Por favor, inténtalo más tarde.";
                } else {
                    // Reiniciar los intentos fallidos
                    $query = "UPDATE usuario SET intentos_fallidos = 0, tiempo_bloqueo = NULL WHERE usuario = :usuario";
                    $stmt = $conn->prepare($query);
                    $stmt->bindParam(':usuario', $usuario);
                    $stmt->execute();
                }
            }

            if (!isset($error_message)) {
                // Consultar la base de datos para verificar las credenciales del usuario
                $query = "SELECT * FROM usuario WHERE usuario = :usuario";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    // Verificar la contraseña con el valor de sal
                    $stored_password = $user['contraseña'];
                    $stored_salt = $user['salt'];
                    $hashed_password = hash('sha256', $contraseña . $stored_salt);

                    if ($hashed_password === $stored_password) {
                        $_SESSION['usuario'] = $usuario;
                        header("Location: main.php");
                        exit;
                    } else {
                        // Incrementar el contador de intentos fallidos
                        $query = "UPDATE usuario SET intentos_fallidos = intentos_fallidos + 1 WHERE usuario = :usuario";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':usuario', $usuario);
                        $stmt->execute();

                        if ($user['intentos_fallidos'] + 1 >= 3) {
                            // Bloquear la cuenta por 30 minutos
                            $lockout_time = date('Y-m-d H:i:s', strtotime('+30 minutes'));
                            $query = "UPDATE usuario SET tiempo_bloqueo = :tiempo_bloqueo WHERE usuario = :usuario";
                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(':tiempo_bloqueo', $lockout_time);
                            $stmt->bindParam(':usuario', $usuario);
                            $stmt->execute();
                        }

                        $error_message = "Credenciales incorrectas";
                    }
                } else {
                    $error_message = "Credenciales incorrectas";
                }
            }
        } else {
            $error_message = "Credenciales incorrectas";
        }
    }
} catch(PDOException $e) {
    // Registra el error en un registro interno y muestra un mensaje genérico al usuario
    error_log("Error de conexión: " . $e->getMessage());
    $error_message = "Ocurrió un error durante el proceso. Por favor, inténtalo más tarde.";
}

// Cierra la conexión a la base de datos
$conn = null;

// Limpia las variables de memoria
unset($usuario);
unset($contraseña);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            width: 400px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <?php if(isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Iniciar Sesión</h1>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required><br>
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required><br>
            <input type="submit" value="Login">
            <a href="registro.php" class="link-button">Registrarse</a>
            <a href="contacto.html" class="link-button">Contacto</a>
        </form>

    </div>
</body>
</html>


