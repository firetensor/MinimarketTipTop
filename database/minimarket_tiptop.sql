-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-09-2024 a las 08:04:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_vehiculo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_17_003058_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(3, 'App\\Models\\User', 4),
(6, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estadopermiso` bit(1) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `estadopermiso`, `descripcion`, `nombre`) VALUES
(1, 'usuario.index', 'web', '2024-03-17 19:20:57', '2024-03-17 19:20:57', b'1', 'Lista y navega todos los usuarios del sistema', 'USUARIO'),
(2, 'usuario.show', 'web', '2024-03-17 19:20:57', '2024-04-06 07:19:07', b'1', 'Ver cualquier dato de un usuario', 'Visualización de detalles de usuario'),
(3, 'usuario.create', 'web', '2024-03-17 22:00:57', '2024-03-17 22:00:57', b'1', 'Crear registro de usuario', 'Creación de usuarios'),
(4, 'usuario.edit', 'web', '2024-03-17 22:00:57', '2024-04-06 07:19:28', b'1', 'Editar cualquier dato de un usuario', 'Edición de usuarios'),
(5, 'usuario.destroy', 'web', '2024-04-04 07:48:51', '2024-04-04 07:48:51', b'1', 'Eliminar cualquier usuario', 'Eliminación de usuarios'),
(6, 'role.index', 'web', '2024-04-04 08:45:11', '2024-04-04 08:45:11', b'1', 'Lista y navega todos los roles del sistema', 'ROLES'),
(7, 'role.show', 'web', '2024-04-05 00:48:07', '2024-04-06 05:58:31', b'1', 'Ver cualquier dato de un rol', 'Ver Detalles de roles'),
(8, 'role.create', 'web', '2024-04-05 23:00:57', '2024-04-06 07:42:24', b'1', 'Crear registro de rol', 'Creación de roles'),
(9, 'role.edit', 'web', '2024-04-06 08:20:38', '2024-04-06 08:20:38', b'1', 'Editar algún dato de un rol', 'Edición de roles'),
(10, 'role.destroy', 'web', '2024-04-06 08:21:26', '2024-04-06 08:21:26', b'1', 'Elimina un registro de rol', 'Eliminación de roles'),
(11, 'permiso.index', 'web', '2024-04-06 20:50:15', '2024-04-06 20:50:15', b'1', 'Lista y navega todos los permisos del sistema', 'PERMISOS'),
(12, 'permiso.show', 'web', '2024-04-06 20:51:11', '2024-04-06 20:51:11', b'1', 'Ver cualquier dato de un permiso', 'Visualización de detalles de permiso'),
(13, 'permiso.create', 'web', '2024-04-06 20:52:28', '2024-04-06 20:52:28', b'1', 'Crear registro de permiso', 'Creación de permisos'),
(14, 'permiso.edit', 'web', '2024-04-06 20:53:45', '2024-04-06 20:53:45', b'1', 'Editar algún dato de un permiso', 'Edición de permisos'),
(15, 'permiso.destroy', 'web', '2024-04-06 20:58:28', '2024-04-06 20:58:28', b'1', 'Eliminar algun registro de permiso', 'Eliminación de permisos'),
(16, 'cliente.index', 'web', '2024-09-21 00:14:58', '2024-09-21 00:14:58', b'1', 'Lista y navega todos los clientes del sistema', 'CLIENTES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estadorol` bit(1) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `estadorol`, `descripcion`) VALUES
(1, 'ADMIN', 'web', '2023-11-02 02:23:21', '2024-04-06 04:37:22', b'1', 'administra todo'),
(2, 'BLOGGER', 'web', '2024-03-15 23:55:57', '2024-04-05 23:16:33', b'1', 'Sin descripcion'),
(3, 'ROLES', 'web', '2024-03-17 17:20:57', '2024-04-06 04:45:28', b'1', 'Todo el acceso a los roles'),
(4, 'PERMISO', 'web', '2024-03-17 17:20:57', '2024-03-17 17:20:57', b'1', 'Todos los permisos'),
(5, 'PERSONAL TECNICO', 'web', '2024-03-17 17:20:57', '2024-03-17 17:20:57', b'1', 'Roles unicamente para personal técnico'),
(6, 'PERSONAL TECNICO 2', 'web', '2024-04-03 23:52:07', '2024-04-03 23:52:07', b'1', 'Sin descripcion'),
(7, 'ASISTENTE ADMINISTRATIVO', 'web', '2024-04-04 01:13:32', '2024-04-04 01:13:32', b'1', 'Sin descripcion'),
(8, 'GERENTE', 'web', '2024-04-05 01:25:40', '2024-04-05 01:25:40', b'1', 'administra el sistema'),
(9, 'GERENTE 2', 'web', '2024-04-05 01:28:27', '2024-04-05 01:28:27', b'1', 'suplanta al gerente'),
(10, 'SUPERVISOR', 'web', '2024-04-06 01:00:01', '2024-04-06 01:00:01', b'1', 'supervisa'),
(11, 'ROL PRUEBA', 'web', '2024-09-21 00:10:03', '2024-09-21 00:10:03', b'1', 'tiene acceso a roles de prueba');

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
(1, 6),
(1, 8),
(1, 10),
(1, 11),
(2, 1),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(3, 1),
(3, 8),
(3, 10),
(3, 11),
(4, 1),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(5, 1),
(5, 8),
(5, 10),
(5, 11),
(6, 1),
(6, 3),
(6, 8),
(6, 10),
(6, 11),
(7, 1),
(7, 3),
(7, 10),
(7, 11),
(8, 1),
(8, 3),
(8, 8),
(8, 10),
(8, 11),
(9, 1),
(9, 3),
(9, 8),
(9, 11),
(10, 1),
(10, 3),
(10, 8),
(10, 11),
(11, 1),
(11, 4),
(11, 8),
(11, 11),
(12, 1),
(12, 4),
(12, 11),
(13, 1),
(13, 4),
(13, 8),
(13, 11),
(14, 1),
(14, 4),
(14, 8),
(14, 11),
(15, 1),
(15, 4),
(15, 8),
(15, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estadousuario` tinyint(4) NOT NULL DEFAULT 0,
  `avatar` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `estadousuario`, `avatar`) VALUES
(1, 'Elias Merlo', 'merloalviteselias@gmail.com', NULL, '$2y$10$QIRp4TJ1IyW4WHxUZnCd3eOmNqpldLkUUepaedJP/lMcNpIQTQCsa', 'R6cPM9vPqOv3Ga8h8AzgzNCiVxL1gxzFSVh4FHcXLL3tX0F8Mqtz3OolzdKj', '2023-11-02 02:23:21', '2024-04-03 22:02:46', 1, ''),
(2, 'Cielo Menor Saavedra', 'cmenorsaavedra@gmail.com', NULL, '$2y$10$dhmXJkshrLc/fyo.99zst.Tsi8WWDA3XsY5BM16MBpYowMva8dtp2', '2jqgHiarD1txvERMLjXgVLcExXfN3vmdakdElU2IPBkKmCvOu7DNwMI2Wi0c', '2024-04-01 23:07:44', '2024-04-01 23:07:44', 1, NULL),
(3, 'Maria Saavedra Chalan', 'maria@gmail.com', NULL, '$2y$10$ABQomQ0BTGNDqv96p78YKupnd7HHEf421iwGiaxEOxyfzuNmbtuFa', 'qxtZXnDr2S', '2024-04-02 06:19:48', '2024-04-02 06:19:48', 1, NULL),
(4, 'Carlos Puemape', 'carlos@gmail.com', NULL, '$2y$10$dpwR75v8GipiCmzFA73iMuGG2cfPRPO0zZQjg5AioZULIpTuMPRm6', 'ZVLbb7rpCgaWJSo6V9NfbG0mTcXJEHkvRgwYwCPiwEbyBQhSli7atsvzxOga', '2024-04-02 06:45:51', '2024-04-03 23:22:11', 1, NULL),
(5, 'Carla Sanchez', 'carla@gmail.com', NULL, '$2y$10$8ZSq.GwYld3nprqw5fNnquVp8IVSBIYMiP.PtQmuUW5PfTNZm9lyG', '6h1ylhmzfD', '2024-04-03 20:52:26', '2024-04-03 23:20:57', 1, NULL),
(6, 'Martha Sanchez', 'martha@gmail.com', NULL, '$2y$10$D5qYBBWIjaR4lzJ14J77yuSwhu9REYllYvxuFGejzqXI7q4Qiw24a', 'vOz6CN8fRW', '2024-09-20 23:41:20', '2024-09-20 23:41:20', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

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
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indices de la tabla `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

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
