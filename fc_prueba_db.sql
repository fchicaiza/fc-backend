-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2024 a las 15:13:33
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
-- Base de datos: `fc_prueba_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chains`
--

CREATE TABLE `chains` (
  `id` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chains`
--

INSERT INTO `chains` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
('75a4f5d7-39c9-4181-8911-951f6d50b7db', 'Mayorista', '022', '2024-01-26 16:51:04', '2024-01-26 16:51:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chanels`
--

CREATE TABLE `chanels` (
  `id` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `chanels`
--

INSERT INTO `chanels` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
('be632610-572d-4c20-922e-8bd303b239d0', 'Canal Tradicional', '2', '2024-01-26 16:48:48', '2024-01-26 16:48:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cities`
--

CREATE TABLE `cities` (
  `id` char(36) NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `province_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cities`
--

INSERT INTO `cities` (`id`, `code`, `name`, `province_id`, `created_at`, `updated_at`) VALUES
('e5012585-0138-44a2-8a46-bee1daf9663f', '06', 'Quito', 'dbb98602-30bf-41f7-8f9a-205c3217d91b', '2024-01-26 16:46:40', '2024-01-26 16:46:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establishments`
--

CREATE TABLE `establishments` (
  `id` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `block_address` varchar(191) DEFAULT NULL,
  `main_street_address` varchar(191) NOT NULL,
  `address_number` varchar(191) NOT NULL,
  `cross_address` varchar(191) NOT NULL,
  `reference_address` varchar(191) NOT NULL,
  `administrator` varchar(191) NOT NULL,
  `contact_phones` varchar(191) NOT NULL,
  `contact_email` varchar(191) NOT NULL,
  `location` varchar(191) NOT NULL,
  `province_id` char(36) NOT NULL,
  `city_id` char(36) NOT NULL,
  `zone_id` char(36) NOT NULL,
  `channel_id` char(36) NOT NULL,
  `subchannel_id` char(36) NOT NULL,
  `chain_id` char(36) NOT NULL,
  `in_route` tinyint(1) NOT NULL,
  `client_project_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `establishments`
--

INSERT INTO `establishments` (`id`, `name`, `block_address`, `main_street_address`, `address_number`, `cross_address`, `reference_address`, `administrator`, `contact_phones`, `contact_email`, `location`, `province_id`, `city_id`, `zone_id`, `channel_id`, `subchannel_id`, `chain_id`, `in_route`, `client_project_id`, `created_at`, `updated_at`) VALUES
('88629c47-f1be-435d-ba88-633bb4ae2bae', 'Local de prueba 2', 'S/N', 'Av. Eloy ALfaro', '127', 'Amazonas', 'Frente a hotel Jw Marriot', 'Admin Test 2', '2863876', 'meg711@favorita.com', '-0.179241,-78.478265', 'dbb98602-30bf-41f7-8f9a-205c3217d91b', 'e5012585-0138-44a2-8a46-bee1daf9663f', 'e41803b0-bb37-4b10-a807-6f93df4ad3fb', 'be632610-572d-4c20-922e-8bd303b239d0', '52311f7a-ff04-46e9-bd62-362a09b2cc78', '75a4f5d7-39c9-4181-8911-951f6d50b7db', 1, '568cf8ce-a2d6-411b-85bf-d9678c2a8c4b', '2024-01-26 18:49:17', '2024-01-26 18:49:17'),
('93641809-2aa6-4738-989e-93658d49a0f5', 'Local de prueba', 'S/N', 'Av. 6 de Diciembre', 'S/N', 'Julio Moreno', 'Junto al Estadio Olímpico', 'Admin Test', '2863876', 'meg711@favorita.com', '-0.179241,-78.478265', 'dbb98602-30bf-41f7-8f9a-205c3217d91b', 'e5012585-0138-44a2-8a46-bee1daf9663f', 'e41803b0-bb37-4b10-a807-6f93df4ad3fb', 'be632610-572d-4c20-922e-8bd303b239d0', '52311f7a-ff04-46e9-bd62-362a09b2cc78', '75a4f5d7-39c9-4181-8911-951f6d50b7db', 1, '568cf8ce-a2d6-411b-85bf-d9678c2a8c4b', '2024-01-26 18:37:02', '2024-01-26 18:37:02');

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
-- Estructura de tabla para la tabla `identities`
--

CREATE TABLE `identities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iss` varchar(191) NOT NULL,
  `sub` varchar(191) NOT NULL,
  `aud` varchar(191) NOT NULL,
  `typ` varchar(191) NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `surname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `avatar` varchar(191) NOT NULL,
  `iat` int(11) NOT NULL,
  `exp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `identities`
--

INSERT INTO `identities` (`id`, `iss`, `sub`, `aud`, `typ`, `uuid`, `name`, `surname`, `email`, `avatar`, `iat`, `exp`, `created_at`, `updated_at`) VALUES
(1, 'http://test.gosice.com', 'Authentication', 'http://186.70.111.82', 'json', '9679a824-e1fc-4c06-9bc6-cc5f93802f94', 'Fernando', 'Chicaiza', 'fchicaiza.g1990@gmail.com', 'http://test.gosice.com/resources/images/avatar.png', 1706269480, 1706273080, '2024-01-26 16:44:40', '2024-01-26 16:44:40');

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
(175, '2014_10_12_000000_create_users_table', 1),
(176, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(177, '2019_08_19_000000_create_failed_jobs_table', 1),
(178, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(179, '2024_01_24_153917_create_identities_table', 1),
(180, '2024_01_25_125907_create_provinces_table', 1),
(181, '2024_01_25_125918_create_cities_table', 1),
(182, '2024_01_25_125933_create_zones_table', 1),
(183, '2024_01_25_231045_create_chains_table', 1),
(184, '2024_01_26_111034_create_chanels_table', 1),
(185, '2024_01_26_111055_create_subchanels_table', 1),
(186, '2024_01_26_202733_create_establishments_table', 1);

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
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE `provinces` (
  `id` char(36) NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
('dbb98602-30bf-41f7-8f9a-205c3217d91b', '17', 'Pichincha', '2024-01-26 16:44:51', '2024-01-26 16:44:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subchanels`
--

CREATE TABLE `subchanels` (
  `id` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `code` varchar(191) NOT NULL,
  `chanel_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `subchanels`
--

INSERT INTO `subchanels` (`id`, `name`, `code`, `chanel_id`, `created_at`, `updated_at`) VALUES
('52311f7a-ff04-46e9-bd62-362a09b2cc78', 'Mayoristas', '01', 'be632610-572d-4c20-922e-8bd303b239d0', '2024-01-26 16:50:51', '2024-01-26 16:50:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(191) NOT NULL,
  `surname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `surname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '9679a824-e1fc-4c06-9bc6-cc5f93802f94', 'Fernando', 'Chicaiza', 'fchicaiza.g1990@gmail.com', NULL, '$2y$12$W1X5nYdeNR92srcRo.1ovuNmrYCCNga1yBERoiGRDzroURedrD58q', NULL, '2024-01-26 16:44:40', '2024-01-26 16:44:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zones`
--

CREATE TABLE `zones` (
  `id` char(36) NOT NULL,
  `code` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `city_id` char(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `zones`
--

INSERT INTO `zones` (`id`, `code`, `name`, `city_id`, `created_at`, `updated_at`) VALUES
('e41803b0-bb37-4b10-a807-6f93df4ad3fb', '4', 'NORTE', 'e5012585-0138-44a2-8a46-bee1daf9663f', '2024-01-26 16:47:01', '2024-01-26 16:47:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chains`
--
ALTER TABLE `chains`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chanels`
--
ALTER TABLE `chanels`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_province_id_foreign` (`province_id`);

--
-- Indices de la tabla `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `establishments_province_id_foreign` (`province_id`),
  ADD KEY `establishments_city_id_foreign` (`city_id`),
  ADD KEY `establishments_zone_id_foreign` (`zone_id`),
  ADD KEY `establishments_channel_id_foreign` (`channel_id`),
  ADD KEY `establishments_subchannel_id_foreign` (`subchannel_id`),
  ADD KEY `establishments_chain_id_foreign` (`chain_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `identities`
--
ALTER TABLE `identities`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subchanels`
--
ALTER TABLE `subchanels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subchanels_chanel_id_foreign` (`chanel_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zones_city_id_foreign` (`city_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `identities`
--
ALTER TABLE `identities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `establishments`
--
ALTER TABLE `establishments`
  ADD CONSTRAINT `establishments_chain_id_foreign` FOREIGN KEY (`chain_id`) REFERENCES `chains` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `establishments_channel_id_foreign` FOREIGN KEY (`channel_id`) REFERENCES `chanels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `establishments_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `establishments_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `establishments_subchannel_id_foreign` FOREIGN KEY (`subchannel_id`) REFERENCES `subchanels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `establishments_zone_id_foreign` FOREIGN KEY (`zone_id`) REFERENCES `zones` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `subchanels`
--
ALTER TABLE `subchanels`
  ADD CONSTRAINT `subchanels_chanel_id_foreign` FOREIGN KEY (`chanel_id`) REFERENCES `chanels` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `zones`
--
ALTER TABLE `zones`
  ADD CONSTRAINT `zones_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
