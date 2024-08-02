-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 10:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `result_sleepderivery_systemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_20_184519_create_students_table', 2),
(7, '2024_07_20_201825_create_student_applications_table', 3),
(9, '2024_07_21_093643_create_rsleeps_table', 4),
(10, '2024_07_21_110427_create_rsleeps', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(8, 'App\\Models\\Student', 1, 'auth_token', '59f2f04983112410e56c2acee284bc40d04b767f1b2d177f9a1ef7631424c186', '[\"*\"]', NULL, NULL, '2024-07-20 16:05:22', '2024-07-20 16:05:22'),
(9, 'App\\Models\\Student', 1, 'auth_token', '0084f1019de0be78612464262427e1a074bf4f84c5d3fc9f833e24efd690bfe2', '[\"*\"]', NULL, NULL, '2024-07-20 16:14:49', '2024-07-20 16:14:49'),
(31, 'App\\Models\\Student', 3, 'auth_token', '2945350169853975fed7d67340b43564ebf8f252419831ac46c44bd0a72eb037', '[\"*\"]', NULL, NULL, '2024-07-21 20:48:09', '2024-07-21 20:48:09'),
(32, 'App\\Models\\Student', 3, 'auth_token', 'e8593af67abc73baeacbab64273c9ea9555804e4802d76d13b9c7d3121d77b30', '[\"*\"]', NULL, NULL, '2024-07-21 20:58:44', '2024-07-21 20:58:44'),
(33, 'App\\Models\\Student', 3, 'auth_token', 'f5093f1e966c0dbb4ced1850be54332d532f1517c1048a590a2bfae664a0735a', '[\"*\"]', NULL, NULL, '2024-07-21 21:04:56', '2024-07-21 21:04:56'),
(39, 'App\\Models\\Student', 3, 'auth_token', 'b7fc67c11dae78203fdf52504c99f177c9665843762ae95178cebcc18ba897be', '[\"*\"]', '2024-07-21 21:19:55', NULL, '2024-07-21 21:19:21', '2024-07-21 21:19:55'),
(40, 'App\\Models\\Student', 3, 'auth_token', 'dea025adad31d4bc50297fead8b1b052aa1784dc9ac12fbb5caa49ede985bee7', '[\"*\"]', '2024-07-21 21:24:03', NULL, '2024-07-21 21:24:00', '2024-07-21 21:24:03'),
(41, 'App\\Models\\Student', 3, 'auth_token', 'a4e3e74a0ee7559e01a99a61bf10638531a5faa750c39e3b9922dd35cebaea33', '[\"*\"]', '2024-07-21 21:26:58', NULL, '2024-07-21 21:25:45', '2024-07-21 21:26:58'),
(42, 'App\\Models\\Student', 3, 'auth_token', 'b379c976f63807a4b9811269255373b679f2fc1d10670672dfed8f466855d5cb', '[\"*\"]', '2024-07-21 21:32:46', NULL, '2024-07-21 21:31:29', '2024-07-21 21:32:46'),
(43, 'App\\Models\\Student', 3, 'auth_token', '62a7b545978ddd705209f489226352bee623c5407f544ea634001d7966f2b2dd', '[\"*\"]', '2024-07-21 21:37:46', NULL, '2024-07-21 21:36:24', '2024-07-21 21:37:46'),
(45, 'App\\Models\\Student', 3, 'auth_token', 'b7e52334540641a3e2b994ce97775e4a51998470f0e3bc8743ef7fbdebf857e4', '[\"*\"]', '2024-07-21 21:41:40', NULL, '2024-07-21 21:41:38', '2024-07-21 21:41:40'),
(50, 'App\\Models\\Student', 1, 'auth_token', '7cab6dcffa95707645cdef0dd002eba8499476f55088b3441deeb63f33b585ab', '[\"*\"]', '2024-07-24 15:21:00', NULL, '2024-07-24 15:20:58', '2024-07-24 15:21:00'),
(51, 'App\\Models\\Student', 1, 'auth_token', '76fec8d04434efcb724504e202977641ff2a24e7b8bc4e9e27d0e30ff445dbbb', '[\"*\"]', '2024-07-24 15:24:47', NULL, '2024-07-24 15:24:42', '2024-07-24 15:24:47'),
(52, 'App\\Models\\Student', 1, 'auth_token', '06bf86e8be25ec8a41ccf58ebc6a82c6f9b3ca454bea2d23b7cd721854311fb4', '[\"*\"]', '2024-07-24 15:25:35', NULL, '2024-07-24 15:25:34', '2024-07-24 15:25:35'),
(53, 'App\\Models\\Student', 1, 'auth_token', '6728c62fd8b331a8c7b2f6e56740d285818af357b283109604ebcf2d48d49c82', '[\"*\"]', '2024-07-24 16:02:09', NULL, '2024-07-24 16:02:07', '2024-07-24 16:02:09'),
(54, 'App\\Models\\Student', 1, 'auth_token', '8c70c02a30ad89df34adc2eff3156b55ddf1124b1fdb3110670bf7a3732c9177', '[\"*\"]', '2024-07-24 16:03:15', NULL, '2024-07-24 16:03:14', '2024-07-24 16:03:15'),
(56, 'App\\Models\\Student', 1, 'auth_token', '42adc81e9dccdf45194526f272f4228ccc3d8a68707e5d357de0abf2e2bdac10', '[\"*\"]', '2024-07-24 16:11:45', NULL, '2024-07-24 16:11:43', '2024-07-24 16:11:45'),
(57, 'App\\Models\\Student', 1, 'auth_token', '1d6288b5a515612bbc3a307be287894e0ca21ff369d8d24093af333550ebd1ea', '[\"*\"]', '2024-07-24 16:12:55', NULL, '2024-07-24 16:12:54', '2024-07-24 16:12:55'),
(58, 'App\\Models\\Student', 1, 'auth_token', 'a8d4d6821c32643f7458b28e74989930d97c93b69730833bd47b44a21b9241ea', '[\"*\"]', '2024-07-24 16:13:19', NULL, '2024-07-24 16:13:18', '2024-07-24 16:13:19'),
(59, 'App\\Models\\Student', 1, 'auth_token', 'b979bbefff5783b40fa787b310ec57817b4566b773cd40e4c7877960c551506d', '[\"*\"]', '2024-07-24 16:30:58', NULL, '2024-07-24 16:30:53', '2024-07-24 16:30:58'),
(60, 'App\\Models\\Student', 1, 'auth_token', '4e98645d8d84048a5b4fe6bc6c52d35098fe9fb0d117fbd78ef1f2c8923e3039', '[\"*\"]', '2024-07-24 16:36:41', NULL, '2024-07-24 16:36:35', '2024-07-24 16:36:41'),
(61, 'App\\Models\\Student', 1, 'auth_token', '52bc777dcf985033c9e218f5a5a2ebe438d0b667dd80eacd0e472ac7ad11a569', '[\"*\"]', '2024-07-24 16:44:29', NULL, '2024-07-24 16:44:24', '2024-07-24 16:44:29'),
(62, 'App\\Models\\Student', 1, 'auth_token', '3576f77710cb6d02c463a582c12b009e03ca4bfc2064f8c00f7058de6e751724', '[\"*\"]', '2024-07-24 16:44:34', NULL, '2024-07-24 16:44:27', '2024-07-24 16:44:34'),
(63, 'App\\Models\\Student', 1, 'auth_token', 'be8b119eddd85148197bed152811f137e240e66cc354cfaa42a2bc8ea41c1edb', '[\"*\"]', '2024-07-24 16:47:26', NULL, '2024-07-24 16:46:38', '2024-07-24 16:47:26'),
(65, 'App\\Models\\Student', 2, 'auth_token', '53020d2911fd8c1907892b4def781600800224f8c45bd402323fd079fcc91871', '[\"*\"]', '2024-07-24 16:49:37', NULL, '2024-07-24 16:48:57', '2024-07-24 16:49:37'),
(67, 'App\\Models\\Student', 1, 'auth_token', '0d634e3c8a60cccf0556aaf99c9409104c39a4b89a59d035739074aef8ce5864', '[\"*\"]', '2024-07-24 16:53:32', NULL, '2024-07-24 16:53:26', '2024-07-24 16:53:32'),
(69, 'App\\Models\\Student', 1, 'auth_token', '9c5b3379b78f9dfdf3a621da5e604fa8a74adf0efccfbecc197849310e5a308b', '[\"*\"]', '2024-07-24 16:58:47', NULL, '2024-07-24 16:58:42', '2024-07-24 16:58:47'),
(70, 'App\\Models\\Student', 1, 'auth_token', '7d1a00e61e74332e5ae118ed87103cdb717b690d0a47c21b2c72f8b2a1d31641', '[\"*\"]', '2024-07-24 17:03:54', NULL, '2024-07-24 17:03:48', '2024-07-24 17:03:54'),
(71, 'App\\Models\\Student', 1, 'auth_token', '33496eca18b0f5e075142ba5f1caf93b967869b3efc646c5c01fd9985c7ab6cb', '[\"*\"]', '2024-07-24 17:07:28', NULL, '2024-07-24 17:07:24', '2024-07-24 17:07:28'),
(72, 'App\\Models\\Student', 1, 'auth_token', '41049319db26683a87f3def370deab610011672b036c6dcfebf7cb5c6ca1aaf0', '[\"*\"]', '2024-07-24 17:10:17', NULL, '2024-07-24 17:10:12', '2024-07-24 17:10:17'),
(73, 'App\\Models\\Student', 1, 'auth_token', 'f12d685b7d08f645807a7691b78406b01f036c628698565605136c3c66012d4e', '[\"*\"]', '2024-07-24 17:13:14', NULL, '2024-07-24 17:13:07', '2024-07-24 17:13:14'),
(74, 'App\\Models\\Student', 1, 'auth_token', '4b9839f98bc537c56c0238e22e5e9ba255d7e65d4021b1baf85a0f0c3d4ecec2', '[\"*\"]', '2024-07-24 17:14:04', NULL, '2024-07-24 17:13:58', '2024-07-24 17:14:04'),
(75, 'App\\Models\\Student', 1, 'auth_token', '5ddf4b2c9020c1b1aa007ac013f8fd97e2ac097ec222b87755b46483a575a8e3', '[\"*\"]', '2024-07-24 17:17:26', NULL, '2024-07-24 17:17:18', '2024-07-24 17:17:26'),
(76, 'App\\Models\\Student', 1, 'auth_token', 'bbb5fd9257a801f26175f7af67e7937bf81d84f32c09bbe1ec5b9989205dffb8', '[\"*\"]', '2024-07-24 17:18:23', NULL, '2024-07-24 17:18:17', '2024-07-24 17:18:23'),
(77, 'App\\Models\\Student', 1, 'auth_token', 'ddecaa588efa4d9d4de4de978d0ccf30c74d29a4e0c4d62b6a8a3c9544390a0f', '[\"*\"]', '2024-07-24 17:21:59', NULL, '2024-07-24 17:21:54', '2024-07-24 17:21:59'),
(78, 'App\\Models\\Student', 1, 'auth_token', '5d4a169f4ca503c1dedb42dc0d04bcd96e351105747ea9e8558ed1f8d9cd4085', '[\"*\"]', '2024-07-24 17:23:48', NULL, '2024-07-24 17:23:44', '2024-07-24 17:23:48'),
(79, 'App\\Models\\Student', 1, 'auth_token', '4998205e02e2b5286f85ae02d58e0dd188999a15f3fa126acae33e69748b76f6', '[\"*\"]', '2024-07-24 17:24:17', NULL, '2024-07-24 17:24:13', '2024-07-24 17:24:17'),
(80, 'App\\Models\\Student', 1, 'auth_token', '568410c8a84d04a1c7ad72a8d14b92dfd8d116edf86a7be6fbb7ae5c6104dd30', '[\"*\"]', '2024-07-24 17:26:22', NULL, '2024-07-24 17:26:17', '2024-07-24 17:26:22'),
(81, 'App\\Models\\Student', 1, 'auth_token', 'fde7a4fedd531f77e67c3e1f9a3e9d77c9b83c283e73f683548f5f9b86ed0c98', '[\"*\"]', '2024-07-24 17:27:53', NULL, '2024-07-24 17:27:49', '2024-07-24 17:27:53'),
(82, 'App\\Models\\Student', 1, 'auth_token', 'e1ae930b71e21dc6c11a7c2eee1656a47c6253b6bb9056c7432b5bf14b9d92c5', '[\"*\"]', '2024-07-24 17:32:38', NULL, '2024-07-24 17:32:32', '2024-07-24 17:32:38'),
(83, 'App\\Models\\Student', 1, 'auth_token', 'd5f3e58ec95281bccf4ab37ef4c96f4ddf9bf88ff2535abbc005b68b54419e0a', '[\"*\"]', '2024-07-24 17:35:17', NULL, '2024-07-24 17:35:12', '2024-07-24 17:35:17'),
(85, 'App\\Models\\Student', 2, 'auth_token', '82a674458f53fa720f08840635264c4db6b34aebf930238dfd34d2c40e20abd1', '[\"*\"]', '2024-07-24 17:38:30', NULL, '2024-07-24 17:38:25', '2024-07-24 17:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `rsleeps`
--

CREATE TABLE `rsleeps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `index_number` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rsleeps`
--

INSERT INTO `rsleeps` (`id`, `name`, `file`, `index_number`, `year`, `status`, `created_at`, `updated_at`) VALUES
(1, 'New student', 'uploads/GcKig3pshKabvKkucMRViAIaM1s2yM3lyw3gbkm6.pdf', '0051-0072-2018', '2018', 'sent', '2024-07-21 08:08:49', '2024-07-21 08:19:11'),
(4, 'Student v4', 'uploads/Aojlb89llaFmCmqKljwpM0jAyRqpYwo0IKNBqfmT.pdf', '2012-1012-2014', '2022', NULL, '2024-07-21 08:56:54', '2024-07-21 08:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'New student', 'student123@gmail.com', '$2y$12$Wb0fkDswRMt7EIwMG36vBe4hJUJzAKEFQch4ThhNAICXJeEn8Q1Gu', '2024-07-20 16:05:02', '2024-07-20 16:05:02'),
(2, 'Latifah Ray sasy nani atawahi', 'studentv4123@gmail.com', '$2y$12$gspdewp4qUbsbH/P4PN6SepPYQVzFhweRFmHPCXps5ZYmXiEp4IoK', '2024-07-21 10:55:06', '2024-07-21 10:55:06'),
(3, 'hello user', 'hello123@gmail.com', '$2y$12$.DgrHeiG3PEBkPg1n5h2pueVwVC8UktZHaTA0YyR.7Bm8KwEZ5neO', '2024-07-21 20:48:02', '2024-07-21 20:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `student_applications`
--

CREATE TABLE `student_applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `index_number` varchar(255) NOT NULL,
  `year` date NOT NULL,
  `clearance_form` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_applications`
--

INSERT INTO `student_applications` (`id`, `name`, `index_number`, `year`, `clearance_form`, `created_at`, `updated_at`) VALUES
(1, 'Mvc test', '0051-0072-2012', '2024-07-21', 'clearance_forms/S1SLPWh3rLwmBVdRQ20MSC4Ewvm1TnwLgliFJi6B.pdf', '2024-07-20 18:12:04', '2024-07-20 18:12:04'),
(2, 'New student', '0222-0122-2010', '2024-07-21', 'clearance_forms/ph3Rqu2qF4mQnShi7IScbTpMC4tpa8CgtxxHne1j.pdf', '2024-07-20 18:15:52', '2024-07-20 18:15:52'),
(3, 'juma juma said', '0011-0033-2012', '2024-07-15', 'uploads/clearance_forms/EDjwjWpxko3ROxeyNTBDvVs6yWBIaNx0znHx4TeZ.pdf', '2024-07-20 18:25:46', '2024-07-20 18:25:46'),
(4, 'uer test', '0023-9977-2001', '2024-07-15', 'uploads/clearance_forms/wEJrFHyFvsMwlklx909H1s2TWFpWO1hmmTvtfhMm.pdf', '2024-07-20 18:29:50', '2024-07-20 18:29:50'),
(5, 'testvsbs', '0551-0012-2023', '2024-07-21', 'uploads/clearance_forms/gHHj2gVUmpLrK1qNjWUAmL45xPTkguz85T4Zj6py.pdf', '2024-07-20 20:27:31', '2024-07-20 20:27:31'),
(10, 'succes user', '0012-1223-2016', '2024-07-21', 'uploads/r98SQtBVSzwkg74WvHJ6jeCcvIZFytYuLBsMkmcM.pdf', '2024-07-21 10:35:36', '2024-07-21 10:35:36'),
(11, 'Hello hello', '2021-2033-3433', '2024-07-15', 'uploads/KeXwNF2RW1Opc3b2iHjlQtL6hjHdb4MJylc9hvWt.pdf', '2024-07-21 21:40:38', '2024-07-21 21:40:38'),
(12, 'yutrr', '8868-6333-2010', '2024-07-22', 'uploads/s6MKs1FaETSkkEZ1vOXjSxfpxUZTSMs3fFDrA3uB.pdf', '2024-07-21 21:51:51', '2024-07-21 21:51:51'),
(13, 'jgffgf', '8655-5556-6655', '2024-07-22', 'uploads/VgFBiWBM0A1DWAKXtkOyZOHXJWhVlougas4bVmFG.pdf', '2024-07-21 21:53:26', '2024-07-21 21:53:26'),
(14, 'test', '0044-4444-4545', '2024-07-16', 'uploads/QGAMlD8Hp86GbFMSr9KvgnsBgYHuGoIeSIy88qyS.pdf', '2024-07-24 16:10:58', '2024-07-24 16:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin123@gmail.com', NULL, '$2y$12$hGa0B8J0XWfQk3vQbVQyHe41639RW1/y2M.aRQcAd6IRRoJzkYQzq', NULL, '2024-07-19 18:06:51', '2024-07-19 20:02:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rsleeps`
--
ALTER TABLE `rsleeps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- Indexes for table `student_applications`
--
ALTER TABLE `student_applications`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `rsleeps`
--
ALTER TABLE `rsleeps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `student_applications`
--
ALTER TABLE `student_applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
