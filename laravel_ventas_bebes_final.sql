-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 01, 2025 at 09:16 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ventas_bebes_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` decimal(8,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `codigo`, `nombre`, `precio`, `stock`, `created_at`, `updated_at`) VALUES
(9, 'R-0000001', 'Poleras', '50.00', 0, NULL, NULL),
(10, 'R-0000002', 'Poleras', '50.00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `id` bigint UNSIGNED NOT NULL,
  `icono` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `catalogos`
--

CREATE TABLE `catalogos` (
  `id` bigint UNSIGNED NOT NULL,
  `articulo_id` bigint UNSIGNED NOT NULL,
  `tipo_id` bigint UNSIGNED NOT NULL,
  `especificacion_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogos`
--

INSERT INTO `catalogos` (`id`, `articulo_id`, `tipo_id`, `especificacion_id`, `created_at`, `updated_at`) VALUES
(8, 9, 1, 11, '2025-10-01 23:46:26', '2025-10-01 23:46:26'),
(9, 9, 2, 1, '2025-10-01 23:46:26', '2025-10-01 23:46:26'),
(10, 9, 2, 3, '2025-10-01 23:46:26', '2025-10-01 23:46:26'),
(11, 9, 2, 8, '2025-10-01 23:46:26', '2025-10-01 23:46:26'),
(12, 10, 1, 15, '2025-10-02 01:06:40', '2025-10-02 01:06:40'),
(13, 10, 2, 1, '2025-10-02 01:06:41', '2025-10-02 01:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('detallado','no detallado') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no detallado',
  `categoria_id` bigint UNSIGNED DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`, `tipo`, `categoria_id`, `imagen`, `created_at`, `updated_at`) VALUES
(7, 'Ropa de Bebé', 'Ropa de bebe comoda y suave', 'detallado', NULL, 'archivos/categorias/1759344665_1body.png', '2025-10-01 22:51:06', '2025-10-01 22:51:06'),
(8, 'Ropa de niño', 'Ropa para niño de todas las edades', 'detallado', NULL, 'archivos/categorias/1759344723_1chaqueta.png', '2025-10-01 22:52:03', '2025-10-01 22:52:03'),
(9, 'Poleras de niña', 'poleras de niña', 'detallado', 7, 'archivos/categorias/1759346312_poleras-articulo-1.png', '2025-10-01 23:18:33', '2025-10-01 23:18:33'),
(10, 'poleeras de niño', 'polera de niño', 'detallado', 7, 'archivos/categorias/1759346357_poleras-articulo-2.png', '2025-10-01 23:19:17', '2025-10-01 23:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `detalles`
--

CREATE TABLE `detalles` (
  `id` bigint UNSIGNED NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `especificaciones`
--

CREATE TABLE `especificaciones` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `especificaciones`
--

INSERT INTO `especificaciones` (`id`, `descripcion`, `tipo_id`, `created_at`, `updated_at`) VALUES
(1, 'Talla 1', 2, NULL, NULL),
(2, 'Talla 2', 2, NULL, NULL),
(3, 'Talla 3', 2, NULL, NULL),
(4, 'Talla 4', 2, NULL, NULL),
(7, '0 - 3 Meses', 2, NULL, NULL),
(8, '3 - 6 Meses', 2, NULL, NULL),
(9, '0 - 3 Meses', 2, NULL, NULL),
(10, '3 - 6 Meses', 2, NULL, NULL),
(11, 'Red', 1, NULL, NULL),
(12, 'Blue', 1, NULL, NULL),
(13, 'Yellow', 1, NULL, NULL),
(14, 'Orange', 1, NULL, NULL),
(15, 'White', 1, NULL, NULL),
(16, '#1028da', 1, '2025-10-01 22:23:54', '2025-10-01 22:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '0001_01_01_000000_create_users_table', 1),
(28, '0001_01_01_000001_create_cache_table', 1),
(29, '0001_01_01_000002_create_jobs_table', 1),
(30, '2025_09_07_043443_create_sucursales_table', 1),
(31, '2025_09_07_043502_create_categorias_table', 1),
(32, '2025_09_07_043532_create_sucursales_categorias_table', 1),
(33, '2025_09_07_043630_create_productos_table', 1),
(34, '2025_09_07_043800_create_articulos_table', 1),
(35, '2025_09_07_043956_create_sucursales_articulos_table', 1),
(36, '2025_09_12_151803_create_tipos_table', 1),
(37, '2025_09_12_152149_create_detalles_table', 1),
(38, '2025_09_12_152444_create_caracteristicas_table', 1),
(39, '2025_09_12_152639_create_productos_tipos_table', 1),
(40, '2025_09_12_152841_create_especificaciones_table', 1),
(41, '2025_09_12_152959_create_catalogos_table', 1),
(42, '2025_09_12_153117_create_posiciones_table', 1),
(43, '2025_09_15_011247_create_sliders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posiciones`
--

CREATE TABLE `posiciones` (
  `id` bigint UNSIGNED NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `articulo_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posiciones`
--

INSERT INTO `posiciones` (`id`, `imagen`, `articulo_id`, `created_at`, `updated_at`) VALUES
(7, 'archivos/articulos/1759347984_chompa-articulo-1.png', 9, '2025-10-01 23:46:24', '2025-10-01 23:46:24'),
(8, 'archivos/articulos/1759347984_chompa-articulo-1-2.png', 9, '2025-10-01 23:46:25', '2025-10-01 23:46:25'),
(9, 'archivos/articulos/1759347985_chompa-articulo-1-3.png', 9, '2025-10-01 23:46:25', '2025-10-01 23:46:25'),
(10, 'archivos/articulos/1759347985_chompa-articulo-1-4.png', 9, '2025-10-01 23:46:25', '2025-10-01 23:46:25'),
(11, 'archivos/articulos/1759347986_chompa-articulo-1-5.png', 9, '2025-10-01 23:46:26', '2025-10-01 23:46:26'),
(12, 'archivos/articulos/1759352799_ariticulo-posicion-1.png', 10, '2025-10-02 01:06:39', '2025-10-02 01:06:39'),
(13, 'archivos/articulos/1759352799_ariticulo-posicion-2.png', 10, '2025-10-02 01:06:39', '2025-10-02 01:06:39'),
(14, 'archivos/articulos/1759352800_ariticulo-posicion-3.png', 10, '2025-10-02 01:06:40', '2025-10-02 01:06:40'),
(15, 'archivos/articulos/1759352800_ariticulo-posicion-4.png', 10, '2025-10-02 01:06:40', '2025-10-02 01:06:40'),
(16, 'archivos/articulos/1759352800_ariticulo-posicion-5.png', 10, '2025-10-02 01:06:40', '2025-10-02 01:06:40');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` bigint UNSIGNED NOT NULL,
  `codigo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen_principal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `descripcion`, `imagen_principal`, `precio`, `created_at`, `updated_at`) VALUES
(5, 'A-01', 'Poleras', 'Poleras comodas para bebe', 'archivos/productos/1759345190_poleras bebe.png', '50.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productos_tipos`
--

CREATE TABLE `productos_tipos` (
  `id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `tipo_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos_tipos`
--

INSERT INTO `productos_tipos` (`id`, `producto_id`, `tipo_id`, `created_at`, `updated_at`) VALUES
(5, 5, 1, '2025-10-01 22:59:50', '2025-10-01 22:59:50'),
(6, 5, 2, '2025-10-01 22:59:50', '2025-10-01 22:59:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SMFvi6OowBDt7Tcj2ORvMIUEVO4uX7dxSeIUINDJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 OPR/122.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieE9RSE54OGpoTzMwV3BMR3NVYWFTNlJqaTJUTVhuUVhITjBSR1hCMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0b3MvdmVyLzUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1759353292);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('principal','secundario','icono') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` enum('izquierda','centro','derecha') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'activo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sucursales`
--

CREATE TABLE `sucursales` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `direccion`, `created_at`, `updated_at`) VALUES
(1, 'Tienda Principal', 'Calle Loa', '2025-09-15 05:41:14', '2025-09-15 05:41:14'),
(2, 'Segunda Tienda', 'calle 51', '2025-09-15 06:45:18', '2025-09-15 06:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `sucursales_articulos`
--

CREATE TABLE `sucursales_articulos` (
  `id` bigint UNSIGNED NOT NULL,
  `precio` decimal(8,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `descuento` decimal(8,2) NOT NULL DEFAULT '0.00',
  `descuento_habilitado` tinyint NOT NULL DEFAULT '0',
  `descuento_porcentaje` tinyint NOT NULL DEFAULT '0',
  `estado` enum('vigente','no vigente') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vigente',
  `sucursales_categorias_id` bigint UNSIGNED NOT NULL,
  `producto_id` bigint UNSIGNED NOT NULL,
  `articulo_id` bigint UNSIGNED DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sucursales_articulos`
--

INSERT INTO `sucursales_articulos` (`id`, `precio`, `stock`, `descuento`, `descuento_habilitado`, `descuento_porcentaje`, `estado`, `sucursales_categorias_id`, `producto_id`, `articulo_id`, `fecha_vencimiento`, `created_at`, `updated_at`) VALUES
(9, '0.00', 0, '0.00', 0, 0, 'vigente', 8, 5, NULL, NULL, '2025-10-01 22:59:50', '2025-10-01 22:59:50'),
(11, '50.00', 0, '0.00', 0, 0, 'vigente', 8, 5, 9, NULL, '2025-10-01 23:46:24', '2025-10-01 23:46:24'),
(12, '50.00', 0, '0.00', 0, 0, 'vigente', 8, 5, 10, NULL, '2025-10-02 01:06:39', '2025-10-02 01:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `sucursales_categorias`
--

CREATE TABLE `sucursales_categorias` (
  `id` bigint UNSIGNED NOT NULL,
  `sucursal_id` bigint UNSIGNED NOT NULL,
  `categoria_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sucursales_categorias`
--

INSERT INTO `sucursales_categorias` (`id`, `sucursal_id`, `categoria_id`, `created_at`, `updated_at`) VALUES
(8, 1, 7, '2025-10-01 22:51:06', '2025-10-01 22:51:06'),
(9, 1, 8, '2025-10-01 22:52:03', '2025-10-01 22:52:03'),
(10, 1, 9, '2025-10-01 23:18:33', '2025-10-01 23:18:33'),
(11, 1, 10, '2025-10-01 23:19:17', '2025-10-01 23:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE `tipos` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Colores', NULL, NULL),
(2, 'Tallas', NULL, NULL),
(3, 'Capacidades', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `articulos_codigo_unique` (`codigo`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caracteristicas_producto_id_foreign` (`producto_id`);

--
-- Indexes for table `catalogos`
--
ALTER TABLE `catalogos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalogos_articulo_id_foreign` (`articulo_id`),
  ADD KEY `catalogos_tipo_id_foreign` (`tipo_id`),
  ADD KEY `catalogos_especificacion_id_foreign` (`especificacion_id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorias_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detalles_producto_id_foreign` (`producto_id`);

--
-- Indexes for table `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `especificaciones_tipo_id_foreign` (`tipo_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `posiciones`
--
ALTER TABLE `posiciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posiciones_articulo_id_foreign` (`articulo_id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `productos_codigo_unique` (`codigo`);

--
-- Indexes for table `productos_tipos`
--
ALTER TABLE `productos_tipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productos_tipos_producto_id_foreign` (`producto_id`),
  ADD KEY `productos_tipos_tipo_id_foreign` (`tipo_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sucursales_articulos`
--
ALTER TABLE `sucursales_articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursales_articulos_sucursales_categorias_id_foreign` (`sucursales_categorias_id`),
  ADD KEY `sucursales_articulos_producto_id_foreign` (`producto_id`),
  ADD KEY `sucursales_articulos_articulo_id_foreign` (`articulo_id`);

--
-- Indexes for table `sucursales_categorias`
--
ALTER TABLE `sucursales_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sucursales_categorias_sucursal_id_foreign` (`sucursal_id`),
  ADD KEY `sucursales_categorias_categoria_id_foreign` (`categoria_id`);

--
-- Indexes for table `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `catalogos`
--
ALTER TABLE `catalogos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `especificaciones`
--
ALTER TABLE `especificaciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `posiciones`
--
ALTER TABLE `posiciones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productos_tipos`
--
ALTER TABLE `productos_tipos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sucursales_articulos`
--
ALTER TABLE `sucursales_articulos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sucursales_categorias`
--
ALTER TABLE `sucursales_categorias`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD CONSTRAINT `caracteristicas_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `catalogos`
--
ALTER TABLE `catalogos`
  ADD CONSTRAINT `catalogos_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalogos_especificacion_id_foreign` FOREIGN KEY (`especificacion_id`) REFERENCES `especificaciones` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `catalogos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categorias`
--
ALTER TABLE `categorias`
  ADD CONSTRAINT `categorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Constraints for table `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `detalles_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `especificaciones`
--
ALTER TABLE `especificaciones`
  ADD CONSTRAINT `especificaciones_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posiciones`
--
ALTER TABLE `posiciones`
  ADD CONSTRAINT `posiciones_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `productos_tipos`
--
ALTER TABLE `productos_tipos`
  ADD CONSTRAINT `productos_tipos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_tipos_tipo_id_foreign` FOREIGN KEY (`tipo_id`) REFERENCES `tipos` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sucursales_articulos`
--
ALTER TABLE `sucursales_articulos`
  ADD CONSTRAINT `sucursales_articulos_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sucursales_articulos_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sucursales_articulos_sucursales_categorias_id_foreign` FOREIGN KEY (`sucursales_categorias_id`) REFERENCES `sucursales_categorias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sucursales_categorias`
--
ALTER TABLE `sucursales_categorias`
  ADD CONSTRAINT `sucursales_categorias_categoria_id_foreign` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sucursales_categorias_sucursal_id_foreign` FOREIGN KEY (`sucursal_id`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
