-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2024 at 05:12 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umanizales`
--

-- --------------------------------------------------------

--
-- Table structure for table `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `asignatura` varchar(255) NOT NULL,
  `grupo` int(11) NOT NULL,
  `dia_semana` varchar(10) NOT NULL,
  `hora_inicio` varchar(50) NOT NULL,
  `hora_fin` varchar(50) NOT NULL,
  `salon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `docentes`
--

INSERT INTO `docentes` (`id`, `codigo`, `nombre`, `asignatura`, `grupo`, `dia_semana`, `hora_inicio`, `hora_fin`, `salon`) VALUES
(1, 'IS040702', 'Juan Pérez', 'Criptografía Aplicada', 2, 'lunes', '18:30', '21:10', 'Aula D 405'),
(2, 'IA030705', 'María García', 'Ética', 2, 'martes', '18:30', '19:20', 'Aula D 203'),
(3, 'IS040704', 'Pedro López', 'Gestión de Riesgos de la Información', 2, 'miércoles', '20:20', '22:00', 'Aula B 105'),
(4, 'IS040705', 'Ana Martínez', 'Profundización I', 2, 'lunes', '18:30', '21:10', 'Aula C 105'),
(5, 'IS040701', 'Carlos Rodríguez', 'Seguridad en Desarrollo de Software', 2, 'martes', '19:20', '22:00', 'Aula D 403'),
(6, 'IS040703', 'Laura Gómez', 'Seguridad en Infraestructura II', 2, 'miércoles', '19:20', '22:00', 'Aula A 201'),
(7, 'IS040702', 'Juan Pérez', 'Criptografía Aplicada', 1, 'lunes', '9:30', '12:10', 'Aula A 505'),
(8, 'IA030705', 'María García', 'Ética', 1, 'martes', '8:30', '9:20', 'Aula D 303'),
(9, 'IS040704', 'Pedro López', 'Gestión de Riesgos de la Información', 1, 'miércoles', '14:20', '17:00', 'Aula B 405'),
(10, 'IS040705', 'Ana Martínez', 'Profundización I', 1, 'lunes', '6:30', '10:10', 'Aula B 105'),
(11, 'IS040701', 'Carlos Rodríguez', 'Seguridad en Desarrollo de Software', 1, 'martes', '8:20', '12:00', 'Aula D 203'),
(12, 'IS040703', 'Laura Gómez', 'Seguridad en Infraestructura II', 1, 'miércoles', '11:20', '15:00', 'Aula B 501');

-- --------------------------------------------------------

--
-- Table structure for table `estudiantes`
--

CREATE TABLE `estudiantes` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estudiantes`
--

INSERT INTO `estudiantes` (`codigo`, `nombre`) VALUES
('2022001', 'Juan Pérez'),
('2022002', 'María García'),
('2022003', 'Pedro López');

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `asignatura` varchar(255) NOT NULL,
  `grupo` int(11) NOT NULL,
  `dia_semana` varchar(10) NOT NULL,
  `hora_inicio` varchar(50) NOT NULL,
  `hora_fin` varchar(50) NOT NULL,
  `salon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `codigo`, `asignatura`, `grupo`, `dia_semana`, `hora_inicio`, `hora_fin`, `salon`) VALUES
(1, 'IS040702', 'Criptografía Aplicada', 2, 'lunes', '18:30', '21:10', 'Aula D 405'),
(2, 'IA030705', 'Ética', 2, 'martes', '18:30', '19:20', 'Aula D 203'),
(3, 'IS040704', 'Gestión de Riesgos de la Información', 2, 'miércoles', '20:20', '22:00', 'Aula B 105'),
(4, 'IS040705', 'Profundización I', 2, 'lunes', '18:30', '21:10', 'Aula C 105'),
(5, 'IS040701', 'Seguridad en Desarrollo de Software', 2, 'martes', '19:20', '22:00', 'Aula D 403'),
(6, 'IS040703', 'Seguridad en Infraestructura II', 2, 'miércoles', '19:20', '22:00', 'Aula A 201'),
(7, 'IS040702', 'Criptografía Aplicada', 1, 'lunes', '9:30', '12:10', 'Aula A 505'),
(8, 'IA030705', 'Ética', 1, 'martes', '8:30', '9:20', 'Aula D 303'),
(9, 'IS040704', 'Gestión de Riesgos de la Información', 1, 'miércoles', '14:20', '17:00', 'Aula B 405'),
(10, 'IS040705', 'Profundización I', 1, 'lunes', '6:30', '10:10', 'Aula B 105'),
(11, 'IS040701', 'Seguridad en Desarrollo de Software', 1, 'martes', '8:20', '12:00', 'Aula D 203'),
(12, 'IS040703', 'Seguridad en Infraestructura II', 1, 'miércoles', '1:20', '15:00', 'Aula B 501');

-- --------------------------------------------------------

--
-- Table structure for table `mensajes_contacto`
--

CREATE TABLE `mensajes_contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mensajes_contacto`
--

INSERT INTO `mensajes_contacto` (`id`, `nombre`, `email`, `telefono`, `mensaje`, `fecha_envio`) VALUES
(3, 'Orlando López', 'um@umanizales.edu.co', '6061234567', 'Asunto: Solicitud de Soporte Técnico\r\n\r\nEstimado Equipo de Soporte,\r\n\r\nEspero que este mensaje le encuentre bien. Me pongo en contacto con ustedes para solicitar asistencia técnica con respecto a [breve descripción del problema o consulta].\r\n\r\nDetalles del problema:\r\n- Descripción del problema o consulta en detalle.\r\n- Cualquier paso que haya tomado para intentar resolver el problema.\r\n- Mensajes de error (si corresponde).\r\n\r\nAgradecería mucho su ayuda para resolver este problema lo antes posible. Quedo a la espera de su pronta respuesta.\r\n\r\nAtentamente,\r\n', '2024-03-04 18:23:16');

-- --------------------------------------------------------

--
-- Table structure for table `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `estudiante_codigo` varchar(10) NOT NULL,
  `asignatura` varchar(255) NOT NULL,
  `corte1` float DEFAULT NULL,
  `corte2` float DEFAULT NULL,
  `corte3` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notas`
--

INSERT INTO `notas` (`id`, `estudiante_codigo`, `asignatura`, `corte1`, `corte2`, `corte3`) VALUES
(1, '2022001', 'Criptografía Aplicada', 4.5, 3.8, 4.2),
(2, '2022001', 'Ética', 3.9, 4.1, 3.7),
(3, '2022001', 'Gestión de Riesgos de la Información', 4, 3.5, 4.3),
(4, '2022001', 'Profundización I', 4.2, 3.7, 4.5),
(5, '2022001', 'Seguridad en Desarrollo de Software', 3.8, 4, 4.2),
(6, '2022001', 'Seguridad en Infraestructura II', 4.1, 3.9, 4.4),
(7, '2022002', 'Criptografía Aplicada', 4.3, 4, 4.1),
(8, '2022002', 'Ética', 4.2, 4.3, 4),
(9, '2022002', 'Gestión de Riesgos de la Información', 3.9, 4.2, 3.8),
(10, '2022002', 'Profundización I', 4, 3.9, 4.1),
(11, '2022002', 'Seguridad en Desarrollo de Software', 3.7, 3.8, 3.9),
(12, '2022002', 'Seguridad en Infraestructura II', 3.8, 3.7, 4),
(13, '2022003', 'Criptografía Aplicada', 4.1, 4.2, 3.9),
(14, '2022003', 'Ética', 4, 4.1, 4),
(15, '2022003', 'Gestión de Riesgos de la Información', 3.8, 3.9, 3.7),
(16, '2022003', 'Profundización I', 3.9, 4, 3.8),
(17, '2022003', 'Seguridad en Desarrollo de Software', 3.6, 3.7, 3.5),
(18, '2022003', 'Seguridad en Infraestructura II', 3.7, 3.6, 3.9);

-- --------------------------------------------------------

--
-- Table structure for table `user_cursos`
--

CREATE TABLE `user_cursos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` char(1) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `semestre` int(11) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `acepto_terminos` tinyint(1) NOT NULL,
  `comentarios` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `archivo_adjunto` varchar(255) DEFAULT NULL,
  `pagina_web` varchar(255) DEFAULT NULL,
  `valor_rango` int(11) DEFAULT NULL,
  `color_favorito` varchar(20) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cursos`
--

INSERT INTO `user_cursos` (`id`, `nombre`, `email`, `fecha_nacimiento`, `genero`, `carrera`, `semestre`, `password`, `acepto_terminos`, `comentarios`, `telefono`, `archivo_adjunto`, `pagina_web`, `valor_rango`, `color_favorito`, `fecha_registro`) VALUES
(1, 'ji', 'ji@autonoma.edu.co', NULL, 'f', 'ingenieria', NULL, '123', 1, NULL, NULL, NULL, NULL, 50, '#000000', '2024-04-27 15:26:44');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `documento` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `intentos_fallidos` int(11) DEFAULT 0,
  `tiempo_bloqueo` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `documento`, `usuario`, `contraseña`, `salt`, `intentos_fallidos`, `tiempo_bloqueo`) VALUES
(28, 'ji', '1202', 'ji', '82b1560875cff51e767211111588879721d89871b11e78d02beb74dc313c224e', '949437798662d1366654654.75289011', 2, NULL),
(31, 'z', 'z', 'z', 'z', '', 0, NULL),
(32, 'j', 'j', 'j', 'j', '', 0, NULL),
(36, 'd', 'd', 'd', '7971090842d7343008ca10d58a0f823744647240dcf90fe5e42f42079b972b1a', '502085346663e3f40c2b464.91610491', 2, NULL),
(37, 'd', 'd', '1Q2w3e4r5t&#39;; DROP TABLE usuario;--', 'aca517f3c9d1adf46cee609ebdcb8021838fd379e831bf7dd737f32510bb0554', '606994220663e3f880e8965.38722762', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_codigo` (`estudiante_codigo`);

--
-- Indexes for table `user_cursos`
--
ALTER TABLE `user_cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mensajes_contacto`
--
ALTER TABLE `mensajes_contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_cursos`
--
ALTER TABLE `user_cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`estudiante_codigo`) REFERENCES `estudiantes` (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
