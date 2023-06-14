-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-01-2023 a las 17:12:20
-- Versión del servidor: 10.5.16-MariaDB-cll-lve
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u205223607_arrow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `afianzadoras`
--

CREATE TABLE `afianzadoras` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `afianzadoras`
--

INSERT INTO `afianzadoras` (`id`, `nombre`, `rfc`, `razon_social`, `domicilio`, `telefono`, `id_empresa`, `created_at`, `updated_at`) VALUES
(1, 'GNP', 'GNP9211244P0', 'GRUPO NACIONAL PROVINCIAL SAB', 'Ciudad de México', '52279000', 1, '2021-12-13 03:20:15', '2022-08-29 03:28:46'),
(3, 'BBVA', 'BBVA5000', 'BBVA Bancomer S.A.', 'Ciudad de México', '5568492537', 1, '2022-07-30 06:22:36', '2022-08-29 03:29:46'),
(4, 'Banco azteca', 'BAZT8000', 'Banco Azteca, S.A.', 'Estado de México', '5568492507', 1, '2022-07-31 04:29:32', '2022-08-29 03:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avances`
--

CREATE TABLE `avances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inicio` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `id_concepto` bigint(20) UNSIGNED DEFAULT NULL,
  `localizacion` int(11) NOT NULL DEFAULT 0,
  `altura` int(11) NOT NULL DEFAULT 0,
  `anchoM` int(11) NOT NULL DEFAULT 0,
  `anchoP` int(11) NOT NULL DEFAULT 0,
  `volumenT` int(11) NOT NULL DEFAULT 0,
  `pieza` int(11) NOT NULL DEFAULT 0,
  `espesor` int(11) NOT NULL DEFAULT 0,
  `area` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `avances`
--

INSERT INTO `avances` (`id`, `inicio`, `fin`, `id_concepto`, `localizacion`, `altura`, `anchoM`, `anchoP`, `volumenT`, `pieza`, `espesor`, `area`, `created_at`, `updated_at`) VALUES
(1, '2020-11-18', '2020-12-28', 3, 1, 0, 0, 1, 0, 0, 0, 0, '2021-12-13 03:29:55', '2022-08-29 05:48:02'),
(2, NULL, NULL, 4, 1, 0, 0, 0, 0, 0, 0, 1, '2021-12-17 05:18:53', '2022-08-05 04:37:27'),
(3, NULL, NULL, 6, 1, 0, 0, 1, 0, 0, 0, 0, '2021-12-17 05:20:15', '2022-01-11 22:31:56'),
(5, '2023-01-13', '2023-01-15', 11, 1, 1, 0, 1, 0, 0, 0, 1, '2022-08-09 05:15:20', '2023-01-14 07:38:43'),
(6, NULL, NULL, 15, 0, 0, 0, 0, 0, 0, 0, 0, '2022-08-29 09:14:21', '2022-08-29 09:14:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_cargo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `nombre_cargo`, `descripcion`, `id_empresa`, `created_at`, `updated_at`) VALUES
(1, 'Ingeniero de obras', 'planificación, el diseño y la supervisión de la construcción y el mantenimiento de las estructuras de construcción.', 1, '2021-12-13 03:22:04', '2022-08-28 11:46:10'),
(2, 'Ingeniero Eléctrico', 'Se encarga de los sistemas de generación, transmisión y distribución de la electricidad.', 1, '2022-07-31 10:02:58', '2022-08-28 11:47:31'),
(3, 'Director de obras publicas', 'Planear, administrar, organizar, dirigir, supervisar y evaluar obras y acciones que permitan el desarrollo en infraestructura y equipamiento urbano y rural en el municipio.', 1, '2022-08-26 08:27:24', '2022-08-26 08:27:24'),
(6, 'Cargo de prueba', 'Prueba', 1, '2022-12-31 04:21:09', '2022-12-31 04:21:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tenant` bigint(20) UNSIGNED DEFAULT NULL,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `telefono`, `email`, `id_tenant`, `id_empresa`, `created_at`, `updated_at`) VALUES
(1, 'H. Ayutamiento Constitucional de Tepotzotlán', '5512345678', 'ayuntamientotepotz@gmail.com', 1, 1, '2021-12-13 03:20:28', '2022-08-26 07:20:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conceptos`
--

CREATE TABLE `conceptos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concepto` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_unidad` bigint(20) UNSIGNED DEFAULT NULL,
  `cantidad` double(12,3) DEFAULT NULL,
  `punitario` double(12,3) DEFAULT NULL,
  `precio_letra` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `importe` double(10,2) DEFAULT NULL,
  `porcentaje` double(6,2) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `avance` int(11) DEFAULT NULL,
  `id_codigo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `conceptos`
--

INSERT INTO `conceptos` (`id`, `codigo`, `concepto`, `id_unidad`, `cantidad`, `punitario`, `precio_letra`, `importe`, `porcentaje`, `estatus`, `avance`, `id_codigo`, `id_contrato`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Excavación para tubería', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, '2021-12-13 03:26:51', '2022-08-24 00:39:30'),
(2, 'A01', 'Red de Agua Potable', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, '2021-12-13 03:27:12', '2022-08-29 05:19:13'),
(3, 'MTEP-001', 'Trazo y nivelación manual y/o con equipo topográfico para lineas de agua potable y drenaje. Incluye: suministros de materiales, mano de obra, equipo y herramienta (P.U.O.T.)', 9, 363.490, 10.320, '(* DIEZ  PESOS 32/100  M.N. *)', 3751.22, 0.27, 0, NULL, 2, 1, '2021-12-13 03:29:55', '2022-08-29 05:56:28'),
(4, 'MTEP-002', 'Excavación de cepa a maquina en material tipo II, hasta 1.00m de profundidad. Incluye: Mano de obra, equipo y herramienta(P.U.O.T.).', 7, 1521.680, 58.800, '(* CINCUENTA  Y  OCHO  PESOS 80/100  M.N. *)', 8918.78, 64.00, 0, NULL, 2, 1, '2021-12-17 05:18:53', '2022-08-29 05:53:41'),
(5, 'A02', 'Escavar', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2021-12-17 05:19:37', '2022-08-29 05:59:12'),
(6, 'MPT-3', 'Ejemplo', 1, 12.000, 1999.900, 'Cine pesos', 1020.00, 5.00, 1, NULL, 5, 1, '2021-12-17 05:20:15', '2022-08-26 05:26:57'),
(7, 'Aplanar', 'aplanar la calle', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 1, 1, '2022-08-02 05:08:37', '2022-08-29 08:06:54'),
(11, 'MTEP-003', 'Afine, nivelación y compactación del fondo de la excavación con bailarina. Incluye: materiales, mano de obra, equipo y herramienta (P.U.O.T.).', 8, 200.380, 18.330, '(* DIECIOCHO  PESOS 33/100  M.N. *)', 3672.97, 27.00, 0, NULL, 2, 1, '2022-08-09 05:15:20', '2022-08-29 05:58:23'),
(13, 'P', 'Obra de prueba', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 3, '2022-08-29 08:28:50', '2022-08-29 08:28:50'),
(14, 'P-01', 'Concepto de prueba modificado', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 13, 3, '2022-08-29 08:30:33', '2022-08-29 09:06:24'),
(15, 'PBA-001', 'Subconcepto de prueba modificado', 1, 40.000, 200.000, '(* DOCIENTOS  PESOS  M.N. *)', 8000.00, 5.00, 0, NULL, 14, 3, '2022-08-29 09:14:21', '2022-08-29 11:37:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contrato` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_obra` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_alta` date NOT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `plazo_dias` int(11) NOT NULL,
  `importe` double(20,2) NOT NULL,
  `amortizacion` double(20,2) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `id_cliente` bigint(20) UNSIGNED DEFAULT NULL,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_responsable` bigint(20) UNSIGNED DEFAULT NULL,
  `id_asistente` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `contrato`, `nombre_obra`, `descripcion`, `fecha_alta`, `ubicacion`, `fecha_inicio`, `fecha_termino`, `plazo_dias`, `importe`, `amortizacion`, `estatus`, `id_cliente`, `id_empresa`, `id_responsable`, `id_asistente`, `created_at`, `updated_at`) VALUES
(1, 'MTE/DOP/IR/FEFOM/006/2020', 'Calle lomas', 'Introducción de red de agua potable y construcción de pavimentación en calle gardenias oriente, Col. Ricardo Flores Magón, Tepotzotlán, Estado de México.', '2020-11-15', 'Col. Ricardo Flores Magón, Tepotzotlán, Estado de México.', '2020-11-18', '2020-12-28', 12, 1385987.99, 1607745.99, 0, 1, 1, 3, 4, '2021-12-13 03:23:25', '2023-01-04 18:28:27'),
(3, 'Prueba', 'Pavimentacion de la calle', 'Se va pavimentar la calle de la escuela', '2022-08-29', 'Estado de México', '2022-08-30', '2022-09-30', 10, 560000.00, 600000.00, 0, 1, 1, 27, 4, '2022-08-29 06:39:11', '2022-08-29 08:09:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos`
--

CREATE TABLE `datos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hombro_derecho1` double(12,2) DEFAULT NULL,
  `hombro_derecho2` double(12,2) DEFAULT NULL,
  `hombro_izquierdo1` double(12,2) DEFAULT NULL,
  `hombro_izquierdo2` double(12,2) DEFAULT NULL,
  `ancho1` double(12,2) DEFAULT NULL,
  `ancho2` double(12,2) DEFAULT NULL,
  `anchot` double(12,2) DEFAULT NULL,
  `altura` double(12,2) DEFAULT NULL,
  `pieza` int(11) DEFAULT NULL,
  `espesor` double(12,2) DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_concepto` bigint(20) UNSIGNED DEFAULT NULL,
  `id_avance` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `datos`
--

INSERT INTO `datos` (`id`, `hombro_derecho1`, `hombro_derecho2`, `hombro_izquierdo1`, `hombro_izquierdo2`, `ancho1`, `ancho2`, `anchot`, `altura`, `pieza`, `espesor`, `photo, `id_concepto`, `id_avance`, `created_at`, `updated_at`) VALUES
(1, 4.70, 20.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2021-12-13 03:30:43', '2022-08-29 05:29:48'),
(2, 10.00, 20.00, NULL, NULL, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, 6, 3, '2022-01-11 22:32:36', '2022-01-11 22:32:54'),
(3, NULL, NULL, 40.00, 60.00, NULL, NULL, 50.00, NULL, NULL, NULL, NULL, 6, 3, '2022-01-11 22:33:20', '2022-01-11 22:33:20'),
(8, 20.00, 40.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:30:21', '2022-08-29 05:30:21'),
(9, 40.00, 60.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:34:48', '2022-08-29 05:34:48'),
(10, 60.00, 80.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:39:17', '2022-08-29 05:39:17'),
(11, 80.00, 100.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:39:28', '2022-08-29 05:39:28'),
(12, 100.00, 120.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:39:37', '2022-08-29 05:39:37'),
(13, NULL, NULL, 0.00, 20.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:40:54', '2022-08-29 05:40:54'),
(14, NULL, NULL, 20.00, 40.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:43:23', '2022-08-29 05:43:23'),
(15, NULL, NULL, 40.00, 60.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:43:45', '2022-08-29 05:43:45'),
(16, NULL, NULL, 60.00, 80.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:43:55', '2022-08-29 05:43:55'),
(17, NULL, NULL, 80.00, 100.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:44:06', '2022-08-29 05:44:06'),
(18, NULL, NULL, 100.00, 120.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:44:27', '2022-08-29 05:44:27'),
(19, NULL, NULL, 120.00, 140.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:44:37', '2022-08-29 05:44:37'),
(20, NULL, NULL, 140.00, 160.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:44:46', '2022-08-29 05:44:46'),
(21, NULL, NULL, 160.00, 180.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:44:59', '2022-08-29 05:44:59'),
(22, NULL, NULL, 180.00, 200.00, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:45:18', '2022-08-29 05:45:18'),
(23, 120.00, 140.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:45:41', '2022-08-29 05:45:41'),
(24, 140.00, 160.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:45:51', '2022-08-29 05:45:51'),
(25, 160.00, 180.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:46:03', '2022-08-29 05:46:03'),
(26, 180.00, 200.00, NULL, NULL, NULL, NULL, 1.00, NULL, NULL, NULL, NULL, 3, 1, '2022-08-29 05:46:09', '2022-08-29 05:46:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_paterno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido_materno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_empleado` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_casa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_cel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `id_cliente` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `tipo_empleado`, `num_casa`, `num_cel`, `estatus`, `id_empresa`, `id_cliente`, `created_at`, `updated_at`) VALUES
(1, 'Antonio', 'Fajardo', 'Jimenez', 'cl', '5512345678', '5512345678', 0, NULL, 1, '2021-12-13 03:21:23', '2022-07-31 06:14:36'),
(2, 'Rodrigo', 'Sanchez', 'Martinez', 'em', '5738645874', '5527143986', 0, 1, NULL, '2022-07-31 03:32:43', '2022-08-29 05:11:43'),
(5, 'Prueba', 'Test', 'Test', 'em', '573864345', '5527147168', 0, 1, NULL, '2022-08-29 12:05:51', '2022-08-29 12:21:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_cargos`
--

CREATE TABLE `empleado_cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_cargo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_empleado` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empleado_cargos`
--

INSERT INTO `empleado_cargos` (`id`, `id_cargo`, `id_empleado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-12-13 03:22:42', '2022-08-04 03:54:23'),
(9, 3, 2, '2022-08-04 04:00:12', '2022-08-29 11:14:00'),
(11, 2, 5, '2022-08-29 12:22:39', '2022-08-29 12:22:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ccem` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_tenant` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `nombre`, `ubicacion`, `rfc`, `imms`, `ccem`, `created_at`, `updated_at`, `id_tenant`) VALUES
(1, 'CRAVIL CONSTRUCCIONES', 'La Paz, Estado de México', 'CC0110909976', 'C3914742234', 'SOR/08042017/0314/S', NULL, '2022-08-26 12:01:57', 1),
(5, 'Empresa F', 'Empresa Fernando', 'GAJF980923TA5', 'GAJF980923', 'GAJF980923TA5', '2022-06-03 17:57:34', '2022-06-03 17:57:34', 23),
(6, 'Obras Marvel', 'Nezahualcóyotl, Estado de México', 'aaa999999333', '98713546687', '59874631', '2022-06-04 18:13:49', '2022-06-04 18:13:49', 25),
(7, 'Constructora DC', 'dasddddddddddddddddddddddddasdasd', 'hhhhhhhhhhhh', 'fdsaaaaaaaa', 'fadssssssssssssss', '2022-07-28 13:07:38', '2022-07-28 13:07:38', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fianzas`
--

CREATE TABLE `fianzas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `monto` double(20,2) NOT NULL,
  `fecha` date NOT NULL,
  `num_fianza` int(11) NOT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `id_afianzadora` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `fianzas`
--

INSERT INTO `fianzas` (`id`, `monto`, `fecha`, `num_fianza`, `id_contrato`, `id_afianzadora`, `created_at`, `updated_at`) VALUES
(1, 122344.00, '2021-12-24', 1332424, 1, 1, '2021-12-13 03:23:43', '2021-12-13 03:23:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `firmantes`
--

CREATE TABLE `firmantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_empleado_cargo` bigint(20) UNSIGNED DEFAULT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `firmantes`
--

INSERT INTO `firmantes` (`id`, `id_empleado_cargo`, `id_contrato`, `created_at`, `updated_at`) VALUES
(6, 1, 1, '2022-08-04 04:24:16', '2022-08-04 04:47:36'),
(8, 9, 1, '2022-08-04 04:47:44', '2022-08-24 03:52:04'),
(10, 11, 1, '2023-01-04 18:23:41', '2023-01-04 18:24:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_contratos`
--

CREATE TABLE `imagenes_contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_contrato` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `imagenes_contratos`
--

INSERT INTO `imagenes_contratos` (`id`, `imagen`, `descripcion`, `id_contrato`, `created_at`, `updated_at`) VALUES
(1, '166011741936625.PNG', 'Logo 1', 1, '2022-07-28 13:15:42', '2022-08-10 12:43:39'),
(2, '166011743369241.PNG', 'Logo 2', 1, '2022-08-05 07:43:18', '2022-08-10 12:43:53'),
(3, '166173953335683.PNG', 'Logo de CRAVIL', 3, '2022-08-29 07:18:53', '2022-08-29 07:18:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_avances`
--

CREATE TABLE `img_avances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_avance` bigint(20) UNSIGNED DEFAULT NULL,
  `ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `countrycode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regioncode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `regionname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cityname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postalcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `img_avances`
--

INSERT INTO `img_avances` (`id`, `id_avance`, `ip`, `country`, `countrycode`, `regioncode`, `regionname`, `cityname`, `zipcode`, `postalcode`, `latitude`, `longitude`, `imagen`, `descripcion`, `created_at`, `updated_at`) VALUES
(7, 2, 'https://127.0.0.1', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', NULL, NULL, '19.436', '-99.1446', '165991682662351.jpg', 'Avance vencido', '2021-12-22 05:33:16', '2022-08-08 05:00:26'),
(8, 2, 'https://201.141.216.191', 'United States', 'US', 'NJ', 'New Jersey', 'Clifton', NULL, NULL, '40.8364', '-74.1403', '164015202032476.png', 'Avance nuevo', '2021-12-22 05:47:00', '2021-12-22 05:47:00'),
(9, 1, 'https://127.0.0.1', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', NULL, NULL, '19.436', '-99.1446', '166173289475093.jpg', 'Avance 1', '2021-12-28 05:13:30', '2022-08-29 05:28:28'),
(18, 1, 'https://127.0.0.1', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', NULL, NULL, '19.436', '-99.1446', '164143657292240.png', 'Avance 2', '2022-01-06 02:36:12', '2022-08-29 05:28:36'),
(19, 2, '201.141.216.127', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Azcapotzalco', '02070', NULL, '19.4718', '-99.184', '164143659132500.png', 'Obra 2', '2022-01-06 02:36:31', '2022-01-06 02:36:31'),
(20, 3, '189.234.176.8', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', '57400', NULL, '19.4277', '-99.043', '164194054237517.jpg', 'Avance de obra 1', '2022-01-11 22:35:42', '2022-01-11 22:35:42'),
(22, 3, '189.234.176.8', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', '57400', NULL, '19.4277', '-99.043', '164194177237390.png', 'Prueba de avance', '2022-01-11 22:56:13', '2022-01-11 22:56:13'),
(24, 1, 'https://127.0.0.1', 'Mexico', 'MX', 'CMX', 'Mexico City', 'Mexico City', NULL, NULL, '19.436', '-99.1446', '166129183590643.jpg', 'Avance 3', '2022-08-24 02:57:15', '2022-08-29 05:28:45'),
(29, 1, '2806:106e:23:d740:c1fb:33e6:c2e4:23a9', 'Mexico', 'MX', 'MEX', 'México', 'Ciudad Nezahualcoyotl', '57740', NULL, '19.3923', '-99.0251', '167285724635387.MTS', 'prueba', '2023-01-04 18:34:06', '2023-01-04 18:34:06'),
(30, 1, '2806:106e:23:d740:c1fb:33e6:c2e4:23a9', 'Mexico', 'MX', 'MEX', 'México', 'Ciudad Nezahualcoyotl', '57740', NULL, '19.3923', '-99.0251', '167285732523666.JPG', 'p2', '2023-01-04 18:35:25', '2023-01-04 18:35:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `img_conceptos`
--

CREATE TABLE `img_conceptos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imagen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_concepto` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `img_conceptos`
--

INSERT INTO `img_conceptos` (`id`, `imagen`, `descripcion`, `id_concepto`, `created_at`, `updated_at`) VALUES
(1, '166011768998684.png', 'Croquis', 1, '2021-12-13 03:26:51', '2022-08-10 12:48:09'),
(3, '166112125689549.jpg', 'Plano 1', 3, '2022-08-05 04:32:53', '2022-08-22 03:34:16'),
(5, '166112127273666.jpg', 'Plano 2', 3, '2022-08-22 03:34:32', '2022-08-22 03:34:32'),
(6, '166112128760787.jpg', 'Plano 3', 3, '2022-08-22 03:34:47', '2022-08-22 03:34:47'),
(7, '166174373043695.png', 'Croquis', 13, '2022-08-29 08:28:50', '2022-08-29 08:28:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_10_27_232322_create_tabler_users', 1),
(5, '2021_10_28_004201_create_permission_tables', 1),
(6, '2021_10_28_185745_create_empresa_table', 1),
(7, '2021_11_05_204401_create_cargo_table', 1),
(8, '2021_11_06_202537_create_cliente_table', 1),
(9, '2021_11_06_224723_create_afianzadora_table', 1),
(10, '2021_11_07_011730_create_empleado_table', 1),
(11, '2021_11_10_003559_create_unidad_table', 1),
(12, '2021_11_10_184308_create_contrato_table', 1),
(13, '2021_11_11_175114_create_imagenes_contratos_table', 1),
(14, '2021_11_12_023549_create_fianza_table', 1),
(15, '2021_11_19_001614_create_conceptos_table', 1),
(16, '2021_11_19_005035_create_img_conceptos_table', 1),
(17, '2021_11_22_200627_create_avance_table', 1),
(18, '2021_11_23_191942_create_empleados_cargos_table', 1),
(19, '2021_11_24_033240_create_dato_table', 1),
(20, '2021_11_26_041222_add_email_verification_to_tenant', 1),
(21, '2021_11_27_200523_create_firmante_table', 1),
(22, '2021_12_03_191310_create_imgavance_table', 1),
(23, '2021_12_04_045704_add_table_imgavances', 1),
(24, '2021_12_04_184358_add_user_estatus', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 9),
(1, 'App\\Models\\User', 10),
(1, 'App\\Models\\User', 11),
(1, 'App\\Models\\User', 12),
(1, 'App\\Models\\User', 13),
(1, 'App\\Models\\User', 14),
(1, 'App\\Models\\User', 15),
(1, 'App\\Models\\User', 16),
(1, 'App\\Models\\User', 17),
(1, 'App\\Models\\User', 18),
(1, 'App\\Models\\User', 19),
(1, 'App\\Models\\User', 20),
(1, 'App\\Models\\User', 21),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\User', 23),
(1, 'App\\Models\\User', 24),
(1, 'App\\Models\\User', 25),
(1, 'App\\Models\\User', 33),
(2, 'App\\Models\\User', 26),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 32),
(4, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ver-rol', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(2, 'crear-rol', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(3, 'editar-rol', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(4, 'borrar-rol', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(5, 'ver-empresa', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(6, 'crear-empresa', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(7, 'editar-empresa', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(8, 'borrar-empresa', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(9, 'ver-afianzadora', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(10, 'crear-afianzadora', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(11, 'editar-afianzadora', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(12, 'borrar-afianzadora', 'web', '2021-12-11 22:01:10', '2021-12-11 22:01:10'),
(13, 'ver-cargo', 'web', NULL, NULL),
(14, 'crear-cargo', 'web', NULL, NULL),
(15, 'editar-cargo', 'web', NULL, NULL),
(16, 'borrar-cargo', 'web', NULL, NULL),
(17, 'ver-empleado', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(18, 'crear-empleado', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(19, 'editar-empleado', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(20, 'borrar-empleado', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(21, 'ver-contrato', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(22, 'crear-contrato', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(23, 'editar-contrato', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(24, 'borrar-contrato', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(25, 'ver-firmante', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(26, 'crear-firmante', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(27, 'editar-firmante', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(28, 'borrar-firmante', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(29, 'ver-cliente', 'web', '2022-06-04 00:10:50', '2022-06-04 00:10:50'),
(30, 'crear-cliente', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(31, 'editar-cliente', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(32, 'borrar-cliente', 'web', '2022-06-04 00:10:51', '2022-06-04 00:10:51'),
(33, 'ver-unidad', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(34, 'crear-unidad', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(35, 'editar-unidad', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(36, 'borrar-unidad', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(37, 'ver-concepto', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(38, 'crear-concepto', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(39, 'editar-concepto', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(40, 'borrar-concepto', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(41, 'ver-usuario', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(42, 'crear-usuario', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(43, 'editar-usuario', 'web', '2022-06-04 00:10:52', '2022-06-04 00:10:52'),
(44, 'borrar-usuario', 'web', '2022-06-04 00:10:53', '2022-06-04 00:10:53'),
(45, 'ver-operativo', 'web', '2022-06-04 00:10:53', '2022-06-04 00:10:53'),
(46, 'crear-operativo', 'web', '2022-06-04 00:10:53', '2022-06-04 00:10:53'),
(47, 'editar-operativo', 'web', '2022-06-04 00:10:53', '2022-06-04 00:10:53'),
(48, 'borrar-operativo', 'web', '2022-06-04 00:10:53', '2022-06-04 00:10:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tenant` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `id_tenant`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Tenant', NULL, 'web', '2021-12-11 22:00:48', '2021-12-11 22:00:48'),
(2, 'Responsable de empresa', NULL, 'web', '2021-12-12 01:43:49', '2021-12-12 01:43:49'),
(3, 'Responsable de obra', NULL, 'web', '2021-12-12 01:46:23', '2021-12-12 01:46:23'),
(4, 'Asistente de obra', NULL, 'web', '2021-12-12 23:17:34', '2021-12-12 23:17:34'),
(9, 'Socio', '1', 'web', '2022-07-28 08:14:14', '2022-07-28 08:17:19'),
(10, 'bot', '7', 'web', '2022-07-28 13:05:29', '2022-07-28 13:05:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 9),
(1, 10),
(2, 1),
(2, 9),
(2, 10),
(3, 1),
(3, 9),
(3, 10),
(4, 1),
(4, 9),
(4, 10),
(5, 1),
(5, 9),
(6, 1),
(6, 9),
(7, 1),
(7, 9),
(8, 1),
(8, 9),
(9, 1),
(9, 2),
(9, 10),
(10, 1),
(10, 2),
(10, 10),
(11, 1),
(11, 2),
(11, 10),
(12, 1),
(12, 2),
(12, 10),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2),
(21, 1),
(21, 2),
(21, 4),
(22, 1),
(22, 2),
(23, 1),
(23, 2),
(24, 1),
(24, 2),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(27, 2),
(28, 1),
(28, 2),
(29, 1),
(29, 2),
(30, 1),
(30, 2),
(31, 1),
(31, 2),
(32, 1),
(32, 2),
(33, 1),
(33, 2),
(33, 3),
(34, 1),
(34, 2),
(34, 3),
(35, 1),
(35, 2),
(35, 3),
(36, 1),
(36, 2),
(36, 3),
(37, 1),
(37, 2),
(37, 3),
(37, 4),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(45, 2),
(46, 1),
(46, 2),
(47, 1),
(47, 2),
(48, 1),
(48, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad`
--

CREATE TABLE `unidad` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0,
  `id_empresa` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `unidad`
--

INSERT INTO `unidad` (`id`, `nombre`, `descripcion`, `estatus`, `id_empresa`, `created_at`, `updated_at`) VALUES
(1, 'mts', 'El metro es la unidad de longitud en el sistema internacional de medidas.', 0, 1, '2021-12-13 03:21:51', '2022-08-28 11:49:38'),
(2, 'hec', 'Hectáreas', 0, 3, '2022-07-30 01:19:35', '2022-07-30 01:19:35'),
(3, 'cm', 'Medida de longitud, de símbolo cm, que es igual a la centésima parte de un metro.', 0, 1, '2022-07-31 08:06:20', '2022-08-28 11:48:04'),
(5, 'pies', 'asdasdasd', 0, 4, '2022-07-31 09:50:25', '2022-08-24 03:47:24'),
(7, 'M3', 'Unidad M3', 0, 1, '2022-08-29 05:49:43', '2022-08-29 05:49:43'),
(8, 'M2', 'Unidad M2', 0, 1, '2022-08-29 05:55:51', '2022-08-29 05:55:51'),
(9, 'ML', 'Unidad ML', 0, 1, '2022-08-29 05:56:03', '2022-08-29 05:56:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_tenant` bigint(20) UNSIGNED DEFAULT NULL,
  `empresa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `id_tenant`, `empresa`, `remember_token`, `created_at`, `updated_at`, `confirmed`, `confirmation_code`, `estatus`) VALUES
(1, 'Bryan Solis', 'bryan@gmail.com', NULL, '$2y$10$npDBtXXZb4K4vEEsU41W6e2skkBWGZJIfPAxi8E5zVLgLFwqa8uCG', 'tenant.png', NULL, NULL, NULL, '2021-12-11 22:00:48', '2022-07-30 03:14:11', 1, NULL, 0),
(3, 'Mario López', 'mario@gmail.com', NULL, '$2y$10$2jyCr2JR3ouA8B1wccxaGOor9jEQBJaEvW7Vrc8YfAswnBgb9wsSq', '163936554591317.jpg', 1, '1', NULL, '2021-12-13 03:19:05', '2022-08-29 01:24:32', 1, NULL, 0),
(4, 'Rocio Miranda Cervantes', 'romc@gmail.com', NULL, '$2y$10$4TGhAVNnCJyEVAXuOOG5B.bq34RusvjKayWdtcrstz/HV.6YwAYJC', '163936559347906.jpg', 1, '1', NULL, '2021-12-13 03:19:53', '2022-08-26 07:50:59', 1, NULL, 0),
(6, 'oscar', 'oscarcastilla97@gmail.com', NULL, '$2y$10$HoT1yp7CtebVUaO.Kvoqeeeold8d1p4D9yFbDcs0VOBuPYWAYU24O', 'tenant.png', NULL, NULL, NULL, '2021-12-14 02:07:32', '2021-12-14 02:07:32', 1, NULL, 0),
(7, 'Antonio', 'antonio@gmail.com', NULL, '$2y$10$rRl4yKWIW8sLOIM/W83ONuQ8RLtEvXmMEklgXkFNF2aYnJ9A9SNDS', 'tenant.png', NULL, NULL, NULL, '2021-12-14 19:20:00', '2021-12-14 19:20:00', 1, '', 0),
(21, 'Jose Solis', 'bryan_10m@live.com.mx', NULL, '$2y$10$q7aIwasaHfjgJR8bjDUWOuwS9QiXffCQ5i9qny4djiYlnUSrPBOO6', 'tenant.png', NULL, NULL, NULL, '2021-12-24 05:45:49', '2021-12-24 05:46:04', 1, NULL, 0),
(23, 'Fernando', 'nearzero01@gmail.com', NULL, '$2y$10$cvbntQfJ/h1.clV0NWP/zeFJ1mX6KtKflfQx3mt3WoRFzSiR6mMsG', '165428009013247.jpg', NULL, NULL, NULL, '2022-05-26 02:18:53', '2022-06-03 18:14:50', 1, '', 0),
(24, 'Jose Leyva', 'rdelrosario@gepyxis.mx', NULL, '$2y$10$dZrUqFg5/zOxfcd8xBBhsO0jtNV4Fcy1VD8ADJvEy/VznGeLLMAh.', 'tenant.png', NULL, NULL, NULL, '2022-05-26 02:19:07', '2022-05-26 02:20:44', 1, NULL, 0),
(25, 'Jose', 'ricdelrosario88@gmail.com', NULL, '$2y$10$MnFGIm1BtL.XZIx5FfdFO.9LMnioFi4wwbHlfkh1SJ5HzJEMdFzL2', 'tenant.png', NULL, NULL, NULL, '2022-06-04 16:18:57', '2022-06-04 17:56:08', 1, NULL, 0),
(26, 'Ulises Efrain Sanchez Martinez', 'ulises@gmail.com', NULL, '$2y$10$8EdCAcGC2KwzWFiO21/GkOMfLf5mlOoNYrEV86yJPbnc.aSM2537a', '165947799363715.jpg', 1, '1', NULL, '2022-07-20 04:09:34', '2022-08-30 02:33:02', 1, NULL, 0),
(27, 'Adrián Molina Medina', 'adrian@gmail.com', NULL, '$2y$10$bzdRUzn/nE062k5jzrTh3Oz0O9iauNWHlIP5GE5KIOr4BLHCExZGm', '166172000750252.jpg', 1, '1', NULL, '2022-07-26 09:36:42', '2022-08-29 01:53:27', 1, NULL, 0),
(32, 'Jaime Israel Sanchez Martinez', 'jaimesm@gmail.com', NULL, '$2y$10$FEoHLpMuU0a4vbH8LD.MJu3miF3FnuFDLqko6D9YYTpQFF.umahNi', '166171927445879.png', 1, '1', NULL, '2022-08-29 01:41:15', '2022-08-30 02:47:44', 1, NULL, 0),
(33, 'Ana Gabriela Corona Denova', 'agcd040396@hotmail.com', NULL, '$2y$10$NaABVeTacLK/UukN7yILhOT9hTGNR65pUKeQl2wlvzBR0AA26mA4e', 'tenant.png', NULL, NULL, NULL, '2022-12-31 03:24:03', '2022-12-31 03:24:03', 0, 'vbPP8TspEWHBYRb9yba4nSPZz', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `afianzadoras`
--
ALTER TABLE `afianzadoras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `afianzadoras_id_empresa_foreign` (`id_empresa`);

--
-- Indices de la tabla `avances`
--
ALTER TABLE `avances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `avances_id_concepto_foreign` (`id_concepto`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cargos_id_empresa_foreign` (`id_empresa`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_email_unique` (`email`),
  ADD KEY `clientes_id_tenant_foreign` (`id_tenant`),
  ADD KEY `clientes_id_empresa_foreign` (`id_empresa`);

--
-- Indices de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conceptos_id_unidad_foreign` (`id_unidad`),
  ADD KEY `conceptos_id_codigo_foreign` (`id_codigo`),
  ADD KEY `conceptos_id_contrato_foreign` (`id_contrato`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contratos_id_cliente_foreign` (`id_cliente`),
  ADD KEY `contratos_id_empresa_foreign` (`id_empresa`),
  ADD KEY `contratos_id_responsable_foreign` (`id_responsable`),
  ADD KEY `contratos_id_asistente_foreign` (`id_asistente`);

--
-- Indices de la tabla `datos`
--
ALTER TABLE `datos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `datos_id_concepto_foreign` (`id_concepto`),
  ADD KEY `datos_id_avance_foreign` (`id_avance`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleados_id_empresa_foreign` (`id_empresa`),
  ADD KEY `empleados_id_cliente_foreign` (`id_cliente`);

--
-- Indices de la tabla `empleado_cargos`
--
ALTER TABLE `empleado_cargos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_cargos_id_cargo_foreign` (`id_cargo`),
  ADD KEY `empleado_cargos_id_empleado_foreign` (`id_empleado`);

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresas_id_tenant_foreign` (`id_tenant`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fianzas`
--
ALTER TABLE `fianzas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fianzas_id_contrato_foreign` (`id_contrato`),
  ADD KEY `fianzas_id_afianzadora_foreign` (`id_afianzadora`);

--
-- Indices de la tabla `firmantes`
--
ALTER TABLE `firmantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `firmantes_id_empleado_cargo_foreign` (`id_empleado_cargo`),
  ADD KEY `firmantes_id_contrato_foreign` (`id_contrato`);

--
-- Indices de la tabla `imagenes_contratos`
--
ALTER TABLE `imagenes_contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `imagenes_contratos_id_contrato_foreign` (`id_contrato`);

--
-- Indices de la tabla `img_avances`
--
ALTER TABLE `img_avances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `img_avances_id_avance_foreign` (`id_avance`);

--
-- Indices de la tabla `img_conceptos`
--
ALTER TABLE `img_conceptos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `img_conceptos_id_concepto_foreign` (`id_concepto`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`),
  ADD KEY `roles_id_tenant_foreign` (`id_tenant`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `unidad`
--
ALTER TABLE `unidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unidad_id_empresa_foreign` (`id_empresa`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_tenant_foreign` (`id_tenant`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `afianzadoras`
--
ALTER TABLE `afianzadoras`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `avances`
--
ALTER TABLE `avances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `conceptos`
--
ALTER TABLE `conceptos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `datos`
--
ALTER TABLE `datos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleado_cargos`
--
ALTER TABLE `empleado_cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fianzas`
--
ALTER TABLE `fianzas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `firmantes`
--
ALTER TABLE `firmantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `imagenes_contratos`
--
ALTER TABLE `imagenes_contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `img_avances`
--
ALTER TABLE `img_avances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `img_conceptos`
--
ALTER TABLE `img_conceptos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `unidad`
--
ALTER TABLE `unidad`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `afianzadoras`
--
ALTER TABLE `afianzadoras`
  ADD CONSTRAINT `afianzadoras_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `avances`
--
ALTER TABLE `avances`
  ADD CONSTRAINT `avances_id_concepto_foreign` FOREIGN KEY (`id_concepto`) REFERENCES `conceptos` (`id`);

--
-- Filtros para la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD CONSTRAINT `cargos_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `clientes_id_tenant_foreign` FOREIGN KEY (`id_tenant`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `conceptos`
--
ALTER TABLE `conceptos`
  ADD CONSTRAINT `conceptos_id_codigo_foreign` FOREIGN KEY (`id_codigo`) REFERENCES `conceptos` (`id`),
  ADD CONSTRAINT `conceptos_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `conceptos_id_unidad_foreign` FOREIGN KEY (`id_unidad`) REFERENCES `unidad` (`id`);

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_id_asistente_foreign` FOREIGN KEY (`id_asistente`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `contratos_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `contratos_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `contratos_id_responsable_foreign` FOREIGN KEY (`id_responsable`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `datos`
--
ALTER TABLE `datos`
  ADD CONSTRAINT `datos_id_avance_foreign` FOREIGN KEY (`id_avance`) REFERENCES `avances` (`id`),
  ADD CONSTRAINT `datos_id_concepto_foreign` FOREIGN KEY (`id_concepto`) REFERENCES `conceptos` (`id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `empleados_id_empresa_foreign` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `empleado_cargos`
--
ALTER TABLE `empleado_cargos`
  ADD CONSTRAINT `empleado_cargos_id_cargo_foreign` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `empleado_cargos_id_empleado_foreign` FOREIGN KEY (`id_empleado`) REFERENCES `empleados` (`id`);

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_id_tenant_foreign` FOREIGN KEY (`id_tenant`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `fianzas`
--
ALTER TABLE `fianzas`
  ADD CONSTRAINT `fianzas_id_afianzadora_foreign` FOREIGN KEY (`id_afianzadora`) REFERENCES `afianzadoras` (`id`),
  ADD CONSTRAINT `fianzas_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`);

--
-- Filtros para la tabla `firmantes`
--
ALTER TABLE `firmantes`
  ADD CONSTRAINT `firmantes_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`),
  ADD CONSTRAINT `firmantes_id_empleado_cargo_foreign` FOREIGN KEY (`id_empleado_cargo`) REFERENCES `empleado_cargos` (`id`);

--
-- Filtros para la tabla `imagenes_contratos`
--
ALTER TABLE `imagenes_contratos`
  ADD CONSTRAINT `imagenes_contratos_id_contrato_foreign` FOREIGN KEY (`id_contrato`) REFERENCES `contratos` (`id`);

--
-- Filtros para la tabla `img_avances`
--
ALTER TABLE `img_avances`
  ADD CONSTRAINT `img_avances_id_avance_foreign` FOREIGN KEY (`id_avance`) REFERENCES `avances` (`id`);

--
-- Filtros para la tabla `img_conceptos`
--
ALTER TABLE `img_conceptos`
  ADD CONSTRAINT `img_conceptos_id_concepto_foreign` FOREIGN KEY (`id_concepto`) REFERENCES `conceptos` (`id`);

--
-- Filtros para la tabla `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
