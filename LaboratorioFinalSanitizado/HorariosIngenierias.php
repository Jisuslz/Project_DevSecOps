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
    <title>Búsqueda de horarios por día</title>
</head>
<body>
    <h1>Búsqueda de horarios por día</h1>
    <form action="HorariosIngenierias.php" method="GET">
        Día a buscar:
        <select name="dia">
            <option value="lunes">Lunes</option>
            <option value="martes">Martes</option>
            <option value="miércoles">Miércoles</option>
            <option value="jueves">Jueves</option>
            <option value="viernes">Viernes</option>
            <option value="sábado">Sábado</option>
            <option value="domingo">Domingo</option>
        </select>
        <input type="submit" value="Buscar">
    </form>

    <?php
        // Incluir archivo de configuración con credenciales
        include "config.php";

        try {
            // Establecer conexión a la base de datos
            $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consultar y mostrar todas las filas de la tabla horarios antes de la consulta
            $consultaInicial = $conn->query("SELECT * FROM horarios");
    ?>
            <h2>Tabla de horarios</h2>
            <table border="1">
                <tr>
                    <th>Asignatura</th>
                    <th>Grupo</th>
                    <th>Hora de Inicio</th>
                    <th>Hora de Fin</th>
                    <th>Salón</th>
                    <th>Día Semana</th>
                </tr>
    <?php
            while ($row = $consultaInicial->fetch(PDO::FETCH_ASSOC)){
    ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["asignatura"]); ?></td>
                    <td><?php echo htmlspecialchars($row["grupo"]); ?></td>
                    <td><?php echo htmlspecialchars($row["hora_inicio"]); ?></td>
                    <td><?php echo htmlspecialchars($row["hora_fin"]); ?></td>
                    <td><?php echo htmlspecialchars($row["salon"]); ?></td>
                    <td><?php echo htmlspecialchars($row["dia_semana"]); ?></td>
                </tr>
    <?php
            }
    ?>
            </table>
    <?php
            if(isset($_GET["dia"])){
                // Obtener y sanitizar el día a buscar
                $dia = filter_input(INPUT_GET, 'dia', FILTER_SANITIZE_STRING);
                echo "Búsqueda por día: $dia";

                // Preparar y ejecutar consulta segura
                $consultaSQL = "SELECT * FROM horarios WHERE dia_semana = :dia";
                $stmt = $conn->prepare($consultaSQL);
                $stmt->bindParam(':dia', $dia);
                $stmt->execute();
    ?>
                <h2>Resultados de la búsqueda</h2>
                <table border="1">
                    <tr>
                        <th>Asignatura</th>
                        <th>Grupo</th>
                        <th>Hora de Inicio</th>
                        <th>Hora de Fin</th>
                        <th>Salón</th>
                        <th>Día Semana</th>
                    </tr>
    <?php
                // Mostrar los resultados de la consulta en forma de tabla
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["asignatura"]); ?></td>
                        <td><?php echo htmlspecialchars($row["grupo"]); ?></td>
                        <td><?php echo htmlspecialchars($row["hora_inicio"]); ?></td>
                        <td><?php echo htmlspecialchars($row["hora_fin"]); ?></td>
                        <td><?php echo htmlspecialchars($row["salon"]); ?></td>
                        <td><?php echo htmlspecialchars($row["dia_semana"]); ?></td>
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

