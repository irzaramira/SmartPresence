-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2021 at 03:19 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartpresence`
--

-- --------------------------------------------------------

--
-- Table structure for table `absens`
--

CREATE TABLE `absens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` time NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pertemuan_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timedesc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dosen_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `timedesc`, `location`, `image`, `dosen_id`, `created_at`, `updated_at`) VALUES
(1, 'Pemrograman Web A', 'Senin, 08.00-09.40', 'FIKLAB 301', 'empty', 2, NULL, NULL),
(2, 'Pemrograman Web B', 'Senin, 08.00-09.40', 'FIKLAB 302', 'empty', 3, NULL, NULL),
(3, 'Pemrograman Berorientasi Objek A', 'Selasa, 10.00-11.40', 'FIKLAB 301', 'empty', 2, NULL, NULL),
(4, 'Pemrograman Berorientasi Objek B', 'Selasa, 10.00-11.40', 'FIKLAB 302', 'empty', 3, NULL, NULL),
(5, 'Pengolahan Citra Digital A', 'Rabu, 13.00-14.40', 'FIKLAB 301', 'empty', 2, NULL, NULL),
(6, 'Pengolahan Citra Digital B', 'Rabu, 13.00-14.40', 'FIKLAB 302', 'empty', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_12_11_083257_create_classes_table', 1),
(5, '2020_12_11_083323_create_pertemuans_table', 1),
(6, '2020_12_11_083324_create_absens_table', 1),
(7, '2020_12_12_151623_create_userclasses_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pertemuans`
--

CREATE TABLE `pertemuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `classes_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertemuans`
--

INSERT INTO `pertemuans` (`id`, `classes_id`, `name`, `date_start`, `date_end`, `created_at`, `updated_at`) VALUES
(1, 1, 'Pertemuan 1 - Pengenalan HTML', '2020-09-14 10:00:00', '2020-09-14 11:40:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userclasses`
--

CREATE TABLE `userclasses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `classes_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userclasses`
--

INSERT INTO `userclasses` (`id`, `user_id`, `classes_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 2, 5, NULL, NULL),
(4, 3, 2, NULL, NULL),
(5, 3, 4, NULL, NULL),
(6, 3, 6, NULL, NULL),
(7, 4, 1, NULL, NULL),
(8, 4, 4, NULL, NULL),
(9, 4, 5, NULL, NULL),
(10, 5, 2, NULL, NULL),
(11, 5, 3, NULL, NULL),
(12, 5, 6, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `username`, `password`, `image`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@upnvj.ac.id', NULL, 'admin', '$2y$10$evuWUeIJJVJbnQbuAIqrAutiya0IwDfd2NA6kL.JSLRJGq9ZkgUry', 'empty', 'admin', NULL, '2021-01-21 07:17:32', '2021-01-21 07:17:32'),
(2, 'dosen1', 'dosen1@upnvj.ac.id', NULL, '0000000001', '$2y$10$MPAPZoEzcEDdcLCg5mqwGOr1WYmzzCKepZmkUzGJdzjryRUZRBiwi', 'empty', 'dosen', NULL, '2021-01-21 07:17:32', '2021-01-21 07:17:32'),
(3, 'dosen2', 'dosen2@upnvj.ac.id', NULL, '0000000002', '$2y$10$3G/TYK.QzQTPS6anrcUtYuiCGi3cl30kW51NaE0TbyJ1TIYfxYO4.', 'empty', 'dosen', NULL, '2021-01-21 07:17:32', '2021-01-21 07:17:32'),
(4, 'mahasiswa1', 'mahasiswa1@upnvj.ac.id', NULL, '1810511001', '$2y$10$u2ecAUvG.OkKIt9r.GU0Se6LeaoFq2nsImH5kErvlJZluIFyHox7i', 'empty', 'mahasiswa', NULL, '2021-01-21 07:17:32', '2021-01-21 07:17:32'),
(5, 'mahasiswa2', 'mahasiswa2@upnvj.ac.id', NULL, '1810511002', '$2y$10$MPftEpH4BZEn1IK.CzjXk.13Ju24ALzsvaGQD8kUkAYuZwMVdaC1O', 'empty', 'mahasiswa', NULL, '2021-01-21 07:17:32', '2021-01-21 07:17:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absens`
--
ALTER TABLE `absens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absens_user_id_foreign` (`user_id`),
  ADD KEY `absens_pertemuan_id_foreign` (`pertemuan_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classes_dosen_id_foreign` (`dosen_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pertemuans`
--
ALTER TABLE `pertemuans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pertemuans_classes_id_foreign` (`classes_id`);

--
-- Indexes for table `userclasses`
--
ALTER TABLE `userclasses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userclasses_user_id_foreign` (`user_id`),
  ADD KEY `userclasses_classes_id_foreign` (`classes_id`);

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
-- AUTO_INCREMENT for table `absens`
--
ALTER TABLE `absens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pertemuans`
--
ALTER TABLE `pertemuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userclasses`
--
ALTER TABLE `userclasses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absens`
--
ALTER TABLE `absens`
  ADD CONSTRAINT `absens_pertemuan_id_foreign` FOREIGN KEY (`pertemuan_id`) REFERENCES `pertemuans` (`id`),
  ADD CONSTRAINT `absens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_dosen_id_foreign` FOREIGN KEY (`dosen_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pertemuans`
--
ALTER TABLE `pertemuans`
  ADD CONSTRAINT `pertemuans_classes_id_foreign` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `userclasses`
--
ALTER TABLE `userclasses`
  ADD CONSTRAINT `userclasses_classes_id_foreign` FOREIGN KEY (`classes_id`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `userclasses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
