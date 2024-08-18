<?php
    // Iniciar sesión
    session_start();


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
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=umanizales", $dbuser, $dbpassword);

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
            <td><?php echo $row["asignatura"]; ?></td>
            <td><?php echo $row["grupo"]; ?></td>
            <td><?php echo $row["hora_inicio"]; ?></td>
            <td><?php echo $row["hora_fin"]; ?></td>
            <td><?php echo $row["salon"]; ?></td>
            <td><?php echo $row["dia_semana"]; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <?php

    if(isset($_GET["dia"])){
        $dia = $_GET["dia"];
        echo "Búsqueda por día: $dia";

        // Ejecutar consulta sin preparar (vulnerable a inyección SQL)
        $consultaSQL = "SELECT * FROM horarios WHERE dia_semana = '$dia'";
        $consultaSQL = $conn->query($consultaSQL);
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
        while ($row = $consultaSQL->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row["asignatura"]; ?></td>
            <td><?php echo $row["grupo"]; ?></td>
            <td><?php echo $row["hora_inicio"]; ?></td>
            <td><?php echo $row["hora_fin"]; ?></td>
            <td><?php echo $row["salon"]; ?></td>
            <td><?php echo $row["dia_semana"]; ?></td>
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
