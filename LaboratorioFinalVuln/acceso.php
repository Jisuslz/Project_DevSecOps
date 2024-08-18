<?php
session_start(); // Iniciar sesión

// Configuración de la base de datos
$dbhost = 'localhost';
$dbuser = 'root';
$dbpassword = '';
$dbname = 'umanizales';

try {
    // Crear conexión a la base de datos
    $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    // Procesar el formulario cuando se envía
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar datos del formulario
        $usuario = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];

        // Consultar la base de datos para verificar las credenciales del usuario
        $query = "SELECT * FROM usuario WHERE usuario = '$usuario'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Verificar la contraseña
            if ($user['contraseña'] === $contraseña) {
                $_SESSION['usuario'] = $usuario;
                header("Location: main.php");
                exit;
            } else {
                $error_message = "Contraseña del usuario incorrecta";
            }
        } else {
            $error_message = "Usuario incorrecto";
        }
    }
} catch(Exception $e) {
    // Registra el error en un registro interno y muestra un mensaje genérico al usuario
    error_log("Error de conexión: " . $e->getMessage());
    $error_message = "Ocurrió un error durante el proceso. Por favor, inténtalo más tarde.";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);

// No limpiar las variables de memoria, dejando potencialmente datos sensibles en el espacio de memoria
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


