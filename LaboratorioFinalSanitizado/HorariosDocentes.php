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
    <title>Búsqueda de horarios por código de asignatura</title>
</head>
<body>
    <h1>Búsqueda de horarios</h1>
    <form action="HorariosDocentes.php" method="GET">
        Código de asignatura:
        <input type="text" name="codigo">
        <input type="submit" value="Buscar">
    </form>
    <?php
        // Incluir archivo de configuración con credenciales
        include "config.php";

        try {
            // Establecer conexión a la base de datos
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consultar y mostrar todas las filas de la tabla docentes antes de la consulta
            $consultaInicial = $conn->query("SELECT * FROM docentes");
    ?>
            <h2>Tabla de docentes</h2>
            <table border="1">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Asignatura</th>
                    <th>Grupo</th>
                    <th>Día Semana</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Salón</th>
                </tr>
    <?php
            while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
    ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["codigo"]); ?></td>
                    <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                    <td><?php echo htmlspecialchars($row["asignatura"]); ?></td>
                    <td><?php echo htmlspecialchars($row["grupo"]); ?></td>
                    <td><?php echo htmlspecialchars($row["dia_semana"]); ?></td>
                    <td><?php echo htmlspecialchars($row["hora_inicio"]); ?></td>
                    <td><?php echo htmlspecialchars($row["hora_fin"]); ?></td>
                    <td><?php echo htmlspecialchars($row["salon"]); ?></td>
                </tr>
    <?php
            }
    ?>
            </table>
    <?php
            if(isset($_GET["codigo"])){
                // Obtener y sanitizar el código de asignatura
                $codigo = filter_input(INPUT_GET, 'codigo', FILTER_SANITIZE_STRING);
                echo "Búsqueda por código de asignatura: $codigo";

                // Preparar y ejecutar consulta segura
                $consultaSQL = "SELECT * FROM docentes WHERE codigo = :codigo";
                $stmt = $conn->prepare($consultaSQL);
                $stmt->bindParam(':codigo', $codigo);
                $stmt->execute();
    ?>
                <h2>Resultados de la búsqueda</h2>
                <table border="1">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Asignatura</th>
                        <th>Grupo</th>
                        <th>Día Semana</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Salón</th>
                    </tr>
    <?php
                // Mostrar los resultados de la consulta en forma de tabla
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["codigo"]); ?></td>
                        <td><?php echo htmlspecialchars($row["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($row["asignatura"]); ?></td>
                        <td><?php echo htmlspecialchars($row["grupo"]); ?></td>
                        <td><?php echo htmlspecialchars($row["dia_semana"]); ?></td>
                        <td><?php echo htmlspecialchars($row["hora_inicio"]); ?></td>
                        <td><?php echo htmlspecialchars($row["hora_fin"]); ?></td>
                        <td><?php echo htmlspecialchars($row["salon"]); ?></td>
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


