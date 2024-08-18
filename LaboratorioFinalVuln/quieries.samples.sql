--Consulta para la tabla horarios estudiantes


SELECT *
FROM horarios
WHERE dia_semana = 'lunes';

--Todos los horarios de las asignaturas que se imparten los lunes:

SELECT asignatura, grupo, hora_inicio, hora_fin, salon
FROM horarios
WHERE dia_semana = 'lunes';

--Todos los horarios de las asignaturas que se imparten los martes:
SELECT asignatura, grupo, hora_inicio, hora_fin, salon
FROM horarios
WHERE dia_semana = 'martes';


--Todos los horarios de las asignaturas que se imparten los martes y los miércoles:
SELECT asignatura, grupo, hora_inicio, hora_fin, salon
FROM horarios
WHERE dia_semana IN ('martes', 'miércoles');

-- Todos los horarios de las asignaturas que se imparten los lunes con alias de columnas:

SELECT asignatura AS materia, grupo AS num_grupo, hora_inicio AS inicio, hora_fin AS fin, salon AS aula
FROM horarios
WHERE dia_semana = 'lunes';


-- Consulta de todos los horarios de las asignaturas que se imparten los lunes con alias
SELECT asignatura AS materia, grupo AS num_grupo, hora_inicio AS inicio, hora_fin AS fin, salon AS aula
FROM horarios
WHERE dia_semana = 'lunes';

-- Consulta de todos los horarios de las asignaturas que se imparten los martes con alias
SELECT asignatura AS materia, grupo AS num_grupo, hora_inicio AS inicio, hora_fin AS fin, salon AS aula
FROM horarios
WHERE dia_semana = 'martes';

-- Combinar los resultados de las consultas anteriores con UNION
SELECT asignatura AS materia, grupo AS num_grupo, hora_inicio AS inicio, hora_fin AS fin, salon AS aula
FROM horarios
WHERE dia_semana = 'lunes'
UNION
SELECT asignatura AS materia, grupo AS num_grupo, hora_inicio AS inicio, hora_fin AS fin, salon AS aula
FROM horarios
WHERE dia_semana = 'martes';



-- consultas para la tabla notas

-- 1. Filtrar por el nombre de la asignatura los lunes:
SELECT *
FROM notas
WHERE asignatura = 'Criptografía Aplicada';

-- 2. Filtrar por el nombre de la asignatura con alias de columnas los lunes:
SELECT asignatura AS materia, corte1 AS corte_uno, corte2 AS corte_dos, corte3 AS corte_tres
FROM notas
WHERE asignatura = 'Criptografía Aplicada';

-- 3. Filtrar por el nombre de la asignatura los martes:
SELECT *
FROM notas
WHERE asignatura = 'Ética';

-- 4. Filtrar por el nombre de la asignatura con alias de columnas los martes:
SELECT asignatura AS materia, corte1 AS corte_uno, corte2 AS corte_dos, corte3 AS corte_tres
FROM notas
WHERE asignatura = 'Ética';

-- 5. Filtrar por el nombre del estudiante los martes y los miércoles:
SELECT *
FROM notas
WHERE estudiante_codigo IN (
    SELECT codigo
    FROM estudiantes
    WHERE nombre = 'María García'
);

-- 6. Filtrar por el nombre del estudiante con alias de columnas los martes y los miércoles:
SELECT asignatura AS materia, corte1 AS corte_uno, corte2 AS corte_dos, corte3 AS corte_tres
FROM notas
WHERE estudiante_codigo IN (
    SELECT codigo
    FROM estudiantes
    WHERE nombre = 'María García'
);


