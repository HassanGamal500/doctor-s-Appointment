-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 01:00 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointment_doctor`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrations`
--

CREATE TABLE `administrations` (
  `id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) NOT NULL,
  `type_id` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `administrations`
--

INSERT INTO `administrations` (`id`, `name`, `email`, `phone`, `password`, `remember_token`, `firebase_token`, `type`, `type_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '01010101010', '$2y$10$ma47cwrqn1IFhHDgrqxvWeQrVMZMSmGr2jLuWSPN.i4al12UD7A/m', NULL, 'dCt4yX8Mf_TiaVU_NvJeDQ:APA91bH82T0Av-haiyH2Wxbuqz5lsn7KXYx7qQhgkLObr7GwbcqIKgWoXigJIVP9KnK283HyQjg7D_DleqyTvytvU4isroKM-BA8C_xSENfZcbi2u_MDchWBAqNf26aiZrBcOCM3WVas', 1, NULL, '2020-07-02 00:19:08', NULL),
(2, 'Abdo Moahmed', 'abdo@yahoo.com', '01255889966', '$2y$10$zlCZSebvR3h9yBpZv7/Y5OxPpf1gr2EUspJblilR9Vz7/ZafgdKpu', NULL, '', 2, 3, '2020-07-03 10:05:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `appointment_read` tinyint(1) NOT NULL DEFAULT 0,
  `notify_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `appointment_date`, `appointment_time`, `patient_id`, `doctor_id`, `status_id`, `appointment_read`, `notify_read`, `created_at`, `updated_at`) VALUES
(4, '2020-07-06', '11:04:00', 1, 2, 2, 1, 1, '2020-07-02 21:04:13', '2020-07-02 23:02:34'),
(5, '2020-07-07', '17:00:00', 1, 1, 2, 1, 1, '2020-07-03 01:52:47', '2020-07-03 10:57:19'),
(6, '2020-07-07', '17:52:00', 1, 1, 3, 1, 1, '2020-07-03 01:53:34', '2020-07-03 02:32:33'),
(7, '2020-07-11', '07:54:00', 1, 2, 2, 1, 1, '2020-07-03 01:54:20', '2020-07-03 02:35:45'),
(8, '2020-07-17', '05:55:00', 1, 2, 3, 1, 1, '2020-07-03 01:55:13', '2020-07-03 02:41:20'),
(9, '2020-07-07', '10:57:00', 1, 1, 1, 1, 1, '2020-07-03 02:52:32', NULL),
(10, '2020-07-10', '17:00:00', 1, 3, 2, 0, 1, '2020-07-03 10:34:58', '2020-07-03 10:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'Alexandria', '2020-07-01 21:33:25', NULL),
(2, 'cairo', '2020-07-01 21:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `doctor_first_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_last_name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_phone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctor_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization_id` int(11) NOT NULL,
  `doctor_start` time NOT NULL,
  `doctor_end` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `doctor_first_name`, `doctor_last_name`, `doctor_phone`, `doctor_email`, `specialization_id`, `doctor_start`, `doctor_end`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed', 'Gamal', '01066365287', 'mohamed@yahoo.com', 2, '12:00:00', '18:00:00', '2020-07-02 13:50:40', NULL),
(2, 'Hazwe', 'Omar', '01225588996', 'hazem50@yahoo.com', 2, '08:00:00', '14:00:00', '2020-07-02 13:51:34', NULL),
(3, 'Abdo', 'Moahmed', '01255889966', 'abdo@yahoo.com', 2, '12:00:00', '18:00:00', '2020-07-03 10:05:06', NULL);

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `pain_id` int(11) NOT NULL,
  `order_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `order_read` tinyint(1) NOT NULL DEFAULT 0,
  `notify_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `patient_id`, `pain_id`, `order_comment`, `status_id`, `order_read`, `notify_read`, `created_at`, `updated_at`) VALUES
(1, 1, 9, NULL, 4, 1, 1, '2020-07-01 23:03:09', NULL),
(2, 1, 4, NULL, 1, 1, 1, '2020-07-03 01:46:27', NULL),
(3, 1, 4, NULL, 1, 1, 1, '2020-07-03 01:46:55', NULL),
(4, 1, 4, NULL, 1, 1, 1, '2020-07-03 01:49:30', NULL),
(5, 1, 4, NULL, 1, 1, 1, '2020-07-03 01:50:21', NULL),
(6, 1, 3, NULL, 4, 1, 1, '2020-07-03 01:51:16', NULL),
(7, 1, 1, NULL, 1, 1, 1, '2020-07-03 02:17:11', NULL),
(8, 1, 1, NULL, 4, 1, 1, '2020-07-03 02:29:42', NULL),
(9, 1, 1, NULL, 4, 1, 1, '2020-07-03 02:30:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pains`
--

CREATE TABLE `pains` (
  `pain_id` int(11) NOT NULL,
  `pain_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pains`
--

INSERT INTO `pains` (`pain_id`, `pain_name`, `created_at`, `updated_at`) VALUES
(1, 'Constipation', '2020-07-01 23:00:17', NULL),
(2, 'Nausea', '2020-07-01 23:00:17', NULL),
(3, 'Dizziness', '2020-07-01 23:00:17', NULL),
(4, 'Sedation', '2020-07-01 23:00:17', NULL),
(5, 'Itching', '2020-07-01 23:00:17', NULL),
(6, 'Addiction', '2020-07-01 23:00:17', NULL),
(7, 'Vomiting', '2020-07-01 23:00:17', NULL),
(8, 'Abdominal pain', '2020-07-01 23:00:17', NULL),
(9, 'Headache', '2020-07-01 23:00:17', NULL),
(10, 'Dry mouth', '2020-07-01 23:00:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialize_id` int(11) NOT NULL,
  `specialize_title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialize_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specialize_id`, `specialize_title`, `specialize_description`, `created_at`, `updated_at`) VALUES
(2, 'Podiatrist', 'Podiatrists are specialists in the feet and the lower limbs', '2020-07-02 13:13:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`, `created_at`, `updated_at`) VALUES
(1, 'pending', '2020-07-02 14:49:32', NULL),
(2, 'accepted', '2020-07-02 14:49:32', NULL),
(3, 'rejected', '2020-07-02 14:49:32', NULL),
(4, 'finished', '2020-07-02 15:39:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_history`
--

CREATE TABLE `status_history` (
  `status_history_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status_history`
--

INSERT INTO `status_history` (`status_history_id`, `appointment_id`, `status_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, '2020-07-02 23:02:34', NULL),
(2, 6, 1, '2020-07-03 01:53:34', NULL),
(3, 7, 1, '2020-07-03 01:54:21', NULL),
(4, 8, 1, '2020-07-03 01:55:13', NULL),
(5, 5, 3, '2020-07-03 02:31:41', NULL),
(6, 6, 3, '2020-07-03 02:32:33', NULL),
(7, 7, 2, '2020-07-03 02:34:28', NULL),
(8, 7, 2, '2020-07-03 02:35:45', NULL),
(9, 8, 2, '2020-07-03 02:39:32', NULL),
(10, 8, 2, '2020-07-03 02:39:53', NULL),
(11, 5, 1, '2020-07-03 00:40:59', NULL),
(12, 8, 2, '2020-07-03 02:41:17', NULL),
(13, 8, 3, '2020-07-03 02:41:20', NULL),
(14, 9, 1, '2020-07-03 02:52:32', NULL),
(15, 10, 1, '2020-07-03 10:34:58', NULL),
(16, 10, 2, '2020-07-03 10:47:22', NULL),
(17, 5, 2, '2020-07-03 10:57:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_of_date` date DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `occupation` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `first_name`, `last_name`, `phone`, `birth_of_date`, `gender`, `country_id`, `occupation`, `password`, `remember_token`, `firebase_token`, `created_at`, `updated_at`) VALUES
(1, 'HassanGamal', 'hassan.alex26@yahoo.com', NULL, 'Hassan', 'Gamal', '01272252219', '1996-10-31', 'male', 1, 'Back End Web Developer', '$2y$10$WkcwbbYJS82NGsDm7wOveueiHBiPeVPkAfeWlB9Op4XgKVvgID/gm', 'J0Rxuse2h59SPUMZL3ILhpymw51kr80RMU3A6KNhV5vl3D0ApEEhmpoaTTRD', 'cK7GvAXHqgFVi2CiGNaS76:APA91bElvcL6IkW9h3o-enkMVxHo1kpPbEtFNRwfctj9zlSufNEl7syNGVYma2pORt5n02yQOgbgJ30knsExG01s3nVCg-sVE_-J1kSW45baz_YvOAkxfntFfGDkmET6-OIKa6JfkXXQ', '2020-07-01 09:36:26', '2020-07-01 09:36:26'),
(4, 'OmarGamal', 'omar@yahoo.com', NULL, 'Omar', 'Gamal', '01066365287', '1998-10-25', 'male', 1, 'Front End Web Developer', '$2y$10$joP2qhBoPB3vGC3tnkCvnO6H60wCPqeoqtnfWZDFhmKH0uS67mrYG', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrations`
--
ALTER TABLE `administrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `specialization_id` (`specialization_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `pain_id` (`pain_id`);

--
-- Indexes for table `pains`
--
ALTER TABLE `pains`
  ADD PRIMARY KEY (`pain_id`),
  ADD KEY `pain_id` (`pain_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialize_id`),
  ADD KEY `specialize_id` (`specialize_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `status_history`
--
ALTER TABLE `status_history`
  ADD PRIMARY KEY (`status_history_id`),
  ADD KEY `status_history_id` (`status_history_id`),
  ADD KEY `appointment_id` (`appointment_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `id` (`id`),
  ADD KEY `country_id` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrations`
--
ALTER TABLE `administrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pains`
--
ALTER TABLE `pains`
  MODIFY `pain_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialize_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `status_history`
--
ALTER TABLE `status_history`
  MODIFY `status_history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specialization_id`) REFERENCES `specialization` (`specialize_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`pain_id`) REFERENCES `pains` (`pain_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `status_history`
--
ALTER TABLE `status_history`
  ADD CONSTRAINT `status_history_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `status_history_ibfk_2` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
