<?php
    // Iniciar sesión
    session_start();

    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    if (!isset($_SESSION['usuario'])) {
        header("Location: acceso.php");
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Historial de Notas</title>
</head>
<body>
    <h1>Historial de Notas</h1>
    <form action="calificaciones.php" method="GET">
        Código de Estudiante:
        <input type="text" name="codigo_estudiante">
        <input type="submit" value="Buscar">
    </form>
    <?php
        // Incluir archivo de configuración con credenciales
        include "config.php";

        try {
            // Establecer conexión a la base de datos
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            if(isset($_GET["codigo_estudiante"])){
                // Obtener y sanitizar el código de estudiante
                $codigo_estudiante = filter_input(INPUT_GET, 'codigo_estudiante', FILTER_SANITIZE_STRING);

                // Preparar y ejecutar consulta segura
                $consultaSQL = "SELECT * FROM notas WHERE estudiante_codigo = :codigo_estudiante";
                $stmt = $conn->prepare($consultaSQL);
                $stmt->bindParam(':codigo_estudiante', $codigo_estudiante);
                $stmt->execute();
    ?>
    <h2>Historial de Notas</h2>
    <table border="1">
        <tr>
            <th>Asignatura</th>
            <th>Corte 1</th>
            <th>Corte 2</th>
            <th>Corte 3</th>
        </tr>
        <?php
        // Mostrar los resultados de la consulta en forma de tabla
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo htmlspecialchars($row["asignatura"]); ?></td>
            <td><?php echo htmlspecialchars($row["corte1"]); ?></td>
            <td><?php echo htmlspecialchars($row["corte2"]); ?></td>
            <td><?php echo htmlspecialchars($row["corte3"]); ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
            }
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    ?>
    <!-- Botón para regresar a main.php -->
    <form action="main.php">
        <input type="submit" value="Volver a Main">
    </form>
</body>
</html>






