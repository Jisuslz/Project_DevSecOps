<?php
    // Iniciar sesión
    session_start();

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
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=umanizales", $dbuser, $dbpassword);

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
                <td><?php echo $row["codigo"]; ?></td>
                <td><?php echo $row["nombre"]; ?></td>
                <td><?php echo $row["asignatura"]; ?></td>
                <td><?php echo $row["grupo"]; ?></td>
                <td><?php echo $row["dia_semana"]; ?></td>
                <td><?php echo $row["hora_inicio"]; ?></td>
                <td><?php echo $row["hora_fin"]; ?></td>
                <td><?php echo $row["salon"]; ?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        <?php

        if(isset($_GET["codigo"])){
            $codigo = $_GET["codigo"];
            echo "Búsqueda por código de asignatura: $codigo";

            // Ejecutar consulta sin preparar (vulnerable a inyección SQL)
            $consultaSQL = "SELECT * FROM docentes WHERE codigo = '$codigo'";
            $consultaSQL = $conn->query($consultaSQL);
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
            while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
            <tr>
                <td><?php echo $row["codigo"]; ?></td>
                <td><?php echo $row["nombre"]; ?></td>
                <td><?php echo $row["asignatura"]; ?></td>
                <td><?php echo $row["grupo"]; ?></td>
                <td><?php echo $row["dia_semana"]; ?></td>
                <td><?php echo $row["hora_inicio"]; ?></td>
                <td><?php echo $row["hora_fin"]; ?></td>
                <td><?php echo $row["salon"]; ?></td>
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


