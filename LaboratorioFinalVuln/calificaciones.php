<?php
    // Iniciar sesión
    session_start();

    
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
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=umanizales", $dbuser, $dbpassword);

        if(isset($_GET["codigo_estudiante"])){
            $codigo_estudiante = $_GET["codigo_estudiante"];

            // Ejecutar consulta sin preparar (vulnerable a inyección SQL)
            $consultaSQL = "SELECT * FROM notas WHERE estudiante_codigo = '$codigo_estudiante'";
            $consultaSQL = $conn->query($consultaSQL);
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
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["asignatura"]; ?></td>
            <td><?php echo $row["corte1"]; ?></td>
            <td><?php echo $row["corte2"]; ?></td>
            <td><?php echo $row["corte3"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php
    }
    ?>
    <!-- Botón para regresar a main.php -->
    <form action="main.php">
        <input type="submit" value="Volver a Main">
    </form>
</body>
</html>




