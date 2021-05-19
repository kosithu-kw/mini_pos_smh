-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 12:55 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_pos_smh`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyinghistories`
--

CREATE TABLE `buyinghistories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_price` double NOT NULL,
  `sale_price` double NOT NULL,
  `sale_price_1` double NOT NULL,
  `sale_price_2` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buying_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buyinghistories`
--

INSERT INTO `buyinghistories` (`id`, `created_at`, `updated_at`, `item_name`, `buying_price`, `sale_price`, `sale_price_1`, `sale_price_2`, `quantity`, `user_id`, `product_id`, `buying_date`) VALUES
(1, '2019-07-28 06:00:24', '2019-07-28 06:00:24', 'Yum Yum', 100, 200, 0, 0, 60, 1, 1, '2019-07-28'),
(2, '2019-07-28 06:01:47', '2019-07-28 06:01:47', 'Yum Yum', 100, 200, 0, 0, 1, 1, 1, NULL),
(3, '2019-07-29 00:16:34', '2019-07-29 00:16:34', 'Sprite', 300, 500, 0, 0, 20, 1, 2, '2019-07-29'),
(4, '2019-07-29 00:16:46', '2019-07-29 00:16:46', 'Coac Cola', 300, 500, 0, 0, 40, 1, 3, '2019-07-29'),
(5, '2019-08-24 00:17:18', '2019-08-24 00:17:18', 'Coac Cola', 300, 500, 0, 0, 100, 1, 3, NULL),
(6, '2019-11-26 20:00:10', '2019-11-26 20:00:10', 'life water', 150, 300, 0, 0, 2000, 1, 4, '2019-11-27'),
(7, '2021-05-14 07:34:15', '2021-05-14 07:34:15', 'ဘိလပ္ေျမ (SCG)', 5000, 7500, 0, 0, 100, 1, 5, '2021-05-14'),
(8, '2021-05-16 04:50:15', '2021-05-16 04:50:15', 'ဘိလပ္ေျမ (SCG)', 5000, 7500, 0, 0, 50, 1, 5, '2021-05-16'),
(9, '2021-05-18 10:06:42', '2021-05-18 10:06:42', 'ဘိလပ္ေျမ (SCG)', 5000, 7500, 7000, 6000, 10, 1, 5, NULL),
(10, '2021-05-18 10:18:21', '2021-05-18 10:18:21', 'test', 4000, 6000, 4500, 5000, 20, 1, 8, '2021-05-18'),
(11, '2021-05-19 09:29:51', '2021-05-19 09:29:51', 'Test', 1000, 1500, 1200, 1300, 100, 6, 9, '2021-05-19');

-- --------------------------------------------------------

--
-- Table structure for table `credits`
--

CREATE TABLE `credits` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credits`
--

INSERT INTO `credits` (`id`, `created_at`, `updated_at`, `customer_id`, `sale_id`, `amount`) VALUES
(1, '2021-05-19 06:11:19', '2021-05-19 06:11:19', 4, 28, 13000),
(2, '2021-05-19 07:12:49', '2021-05-19 07:12:49', 0, 30, 7500),
(3, '2021-05-19 07:13:57', '2021-05-19 07:13:57', 4, 31, 6000),
(4, '2021-05-19 07:19:43', '2021-05-19 07:19:43', 4, 32, 6500),
(5, '2021-05-19 07:52:08', '2021-05-19 07:52:08', 3, 33, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `created_at`, `updated_at`, `name`, `phone`, `address`) VALUES
(0, '2021-05-19 05:45:37', '2021-05-19 05:46:21', 'Customer', '0000000000', 'Normal'),
(3, '2021-05-19 04:49:55', '2021-05-19 05:08:37', 'U Aung', '3938373733', 'သထုံ၊ မင္းလမ္း၊ လမ္းမႀကီး'),
(4, '2021-05-19 04:50:46', '2021-05-19 04:50:46', 'U Maung', '09383737376', 'Thaton, Bin Hlaing'),
(6, '2021-05-19 09:41:06', '2021-05-19 09:41:06', 'Tt', '09970588085', 'Tt');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_07_19_122538_create_permission_tables', 1),
(8, '2019_06_04_161821_create_products_table', 2),
(9, '2019_06_05_122056_create_buyinghistories_table', 2),
(14, '2019_06_07_235531_create_userlogins_table', 4),
(17, '2019_06_06_080633_create_sales_table', 5),
(19, '2019_06_06_080725_create_saleitems_table', 6),
(21, '2021_05_19_103344_create_customers_table', 7),
(22, '2021_05_19_122927_create_credits_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 6),
(3, 'App\\User', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `buying_price` double NOT NULL,
  `sale_price` double NOT NULL,
  `sale_price_1` double NOT NULL,
  `sale_price_2` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `item_name`, `buying_price`, `sale_price`, `sale_price_1`, `sale_price_2`, `quantity`, `barcode`) VALUES
(5, '2021-05-14 07:34:15', '2021-05-19 09:41:57', 'ဘိလပ္ေျမ (SCG)', 5000, 7500, 6500, 6000, 150, '6780625'),
(7, '2021-05-18 10:17:04', '2021-05-19 07:51:54', 'Hollo Pipe 1', 3000, 5000, 3500, 4000, 95, '7463376'),
(8, '2021-05-18 10:18:21', '2021-05-19 05:10:15', 'ေၾကြျပား', 4000, 6000, 4500, 5000, 20, '4425901'),
(9, '2021-05-19 09:29:51', '2021-05-19 09:30:21', 'Test', 1000, 1500, 1200, 1300, 99, '9780433');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, NULL),
(2, 'Manager', 'web', NULL, NULL),
(3, 'Cashier', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `saleitems`
--

CREATE TABLE `saleitems` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `item_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `buying_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `saleitems`
--

INSERT INTO `saleitems` (`id`, `created_at`, `updated_at`, `user_id`, `product_id`, `sale_id`, `item_name`, `sale_price`, `quantity`, `amount`, `buying_price`) VALUES
(1, '2019-07-28 06:04:06', '2019-07-28 06:04:06', 1, 1, 1, 'Yum Yum', 200, 1, 200, 100),
(2, '2019-07-28 22:49:26', '2019-07-28 22:49:26', 1, 1, 2, 'Yum Yum', 200, 2, 400, 100),
(3, '2019-07-29 00:17:09', '2019-07-29 00:17:09', 1, 1, 3, 'Yum Yum', 200, 1, 200, 100),
(4, '2019-07-29 00:17:09', '2019-07-29 00:17:09', 1, 2, 3, 'Sprite', 500, 1, 500, 300),
(5, '2019-07-29 00:17:09', '2019-07-29 00:17:09', 1, 3, 3, 'Coac Cola', 500, 1, 500, 300),
(6, '2019-07-29 00:48:31', '2019-07-29 00:48:31', 1, 3, 4, 'Coac Cola', 500, 1, 500, 300),
(7, '2019-07-29 00:48:31', '2019-07-29 00:48:31', 1, 1, 4, 'Yum Yum', 200, 1, 200, 100),
(8, '2019-07-29 01:19:25', '2019-07-29 01:19:25', 1, 1, 5, 'Yum Yum', 200, 3, 600, 100),
(9, '2019-07-29 01:48:30', '2019-07-29 01:48:30', 1, 1, 6, 'Yum Yum', 200, 1, 200, 100),
(10, '2019-07-29 01:51:16', '2019-07-29 01:51:16', 1, 3, 7, 'Coac Cola', 500, 1, 500, 300),
(11, '2019-07-29 01:54:24', '2019-07-29 01:54:24', 1, 1, 8, 'Yum Yum', 200, 1, 200, 100),
(12, '2019-07-29 02:11:42', '2019-07-29 02:11:42', 1, 3, 9, 'Coac Cola', 500, 1, 500, 300),
(13, '2019-07-29 02:12:05', '2019-07-29 02:12:05', 1, 2, 10, 'Sprite', 500, 1, 500, 300),
(14, '2019-07-29 02:16:19', '2019-07-29 02:16:19', 1, 2, 11, 'Sprite', 500, 1, 500, 300),
(15, '2019-07-29 02:41:25', '2019-07-29 02:41:25', 1, 1, 12, 'Yum Yum', 200, 1, 200, 100),
(16, '2019-07-29 02:56:54', '2019-07-29 02:56:54', 1, 1, 13, 'Yum Yum', 200, 1, 200, 100),
(17, '2019-07-29 02:57:05', '2019-07-29 02:57:05', 1, 1, 14, 'Yum Yum', 200, 1, 200, 100),
(18, '2019-07-29 02:59:29', '2019-07-29 02:59:29', 1, 2, 15, 'Sprite', 500, 1, 500, 300),
(19, '2019-07-30 04:43:01', '2019-07-30 04:43:01', 1, 1, 16, 'Yum Yum', 200, 1, 200, 100),
(20, '2019-08-01 02:31:12', '2019-08-01 02:31:12', 1, 1, 17, 'Yum Yum', 200, 1, 200, 100),
(21, '2019-08-24 00:16:37', '2019-08-24 00:16:37', 1, 3, 18, 'Coac Cola', 500, 2, 1000, 300),
(22, '2019-11-26 20:01:55', '2019-11-26 20:01:55', 1, 4, 19, 'life water', 300, 2, 600, 150),
(23, '2020-05-13 22:46:50', '2020-05-13 22:46:50', 1, 4, 20, 'life water', 300, 1, 300, 150),
(24, '2020-05-13 22:46:50', '2020-05-13 22:46:50', 1, 2, 20, 'Sprite', 500, 1, 500, 300),
(25, '2021-05-14 07:35:44', '2021-05-14 07:35:44', 1, 5, 21, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 7500, 5000),
(26, '2021-05-16 04:47:59', '2021-05-16 04:47:59', 1, 5, 22, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 7500, 5000),
(27, '2021-05-18 12:53:54', '2021-05-18 12:53:54', 1, 5, 23, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6000, 5000),
(28, '2021-05-18 13:06:39', '2021-05-18 13:06:39', 1, 5, 24, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6000, 5000),
(29, '2021-05-18 13:18:43', '2021-05-18 13:18:43', 1, 5, 25, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6500, 5000),
(30, '2021-05-19 05:56:15', '2021-05-19 05:56:15', 7, 5, 26, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6000, 5000),
(31, '2021-05-19 06:07:55', '2021-05-19 06:07:55', 7, 5, 27, 'ဘိလပ္ေျမ (SCG)', 7500, 5, 30000, 5000),
(32, '2021-05-19 06:11:19', '2021-05-19 06:11:19', 7, 5, 28, 'ဘိလပ္ေျမ (SCG)', 7500, 2, 13000, 5000),
(33, '2021-05-19 06:30:42', '2021-05-19 06:30:42', 7, 5, 29, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 7500, 5000),
(34, '2021-05-19 07:12:49', '2021-05-19 07:12:49', 7, 5, 30, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 7500, 5000),
(35, '2021-05-19 07:13:57', '2021-05-19 07:13:57', 7, 5, 31, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6000, 5000),
(36, '2021-05-19 07:19:43', '2021-05-19 07:19:43', 7, 5, 32, 'ဘိလပ္ေျမ (SCG)', 7500, 1, 6500, 5000),
(37, '2021-05-19 07:52:08', '2021-05-19 07:52:08', 7, 7, 33, 'Hollo Pipe 1', 5000, 5, 20000, 3000),
(38, '2021-05-19 09:30:47', '2021-05-19 09:30:47', 6, 9, 34, 'Test', 1500, 1, 1300, 1000),
(39, '2021-05-19 09:42:29', '2021-05-19 09:42:29', 7, 5, 35, 'ဘိလပ္ေျမ (SCG)', 7500, 3, 18000, 5000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `totalAmount` double NOT NULL,
  `totalQty` int(11) NOT NULL,
  `sale_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_cash` double DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `created_at`, `updated_at`, `user_id`, `totalAmount`, `totalQty`, `sale_type`, `paid_cash`, `customer_id`) VALUES
(1, '2019-07-28 06:04:06', '2019-07-28 06:04:06', 1, 200, 1, '', NULL, 0),
(2, '2019-07-28 22:49:26', '2019-07-28 22:49:26', 1, 400, 2, '', 500, 0),
(3, '2019-07-29 00:17:09', '2019-07-29 00:17:09', 1, 1200, 3, '', 2000, 0),
(4, '2019-07-29 00:48:31', '2019-07-29 00:48:31', 1, 700, 2, '', 1000, 0),
(5, '2019-07-29 01:19:25', '2019-07-29 01:19:25', 1, 600, 3, '', 1000, 0),
(6, '2019-07-29 01:48:30', '2019-07-29 01:48:30', 1, 200, 1, '', 0, 0),
(7, '2019-07-29 01:51:16', '2019-07-29 01:51:16', 1, 500, 1, '', 0, 0),
(8, '2019-07-29 01:54:24', '2019-07-29 01:54:24', 1, 200, 1, '', 0, 0),
(9, '2019-07-29 02:11:42', '2019-07-29 02:11:42', 1, 500, 1, '', 500, 0),
(10, '2019-07-29 02:12:05', '2019-07-29 02:12:05', 1, 500, 1, '', 1000, 0),
(11, '2019-07-29 02:16:19', '2019-07-29 02:16:19', 1, 500, 1, '', 1000, 0),
(12, '2019-07-29 02:41:25', '2019-07-29 02:41:25', 1, 200, 1, '', 500, 0),
(13, '2019-07-29 02:56:54', '2019-07-29 02:56:54', 1, 200, 1, '', 1000, 0),
(14, '2019-07-29 02:57:05', '2019-07-29 02:57:05', 1, 200, 1, '', 1000, 0),
(15, '2019-07-29 02:59:29', '2019-07-29 02:59:29', 1, 500, 1, '', 1000, 0),
(16, '2019-07-30 04:43:01', '2019-07-30 04:43:01', 1, 200, 1, '', 500, 0),
(17, '2019-08-01 02:31:12', '2019-08-01 02:31:12', 1, 200, 1, '', 200, 0),
(18, '2019-08-24 00:16:37', '2019-08-24 00:16:37', 1, 1000, 2, '', 0, 0),
(19, '2019-11-26 20:01:55', '2019-11-26 20:01:55', 1, 600, 2, '', 1000, 0),
(20, '2020-05-13 22:46:50', '2020-05-13 22:46:50', 1, 800, 2, '', 1000, 0),
(21, '2021-05-14 07:35:44', '2021-05-14 07:35:44', 1, 7500, 1, '', 10000, 0),
(22, '2021-05-16 04:47:59', '2021-05-16 04:47:59', 1, 7500, 1, '', 10000, 0),
(23, '2021-05-18 12:53:54', '2021-05-18 12:53:54', 1, 6000, 1, '', 6000, 0),
(24, '2021-05-18 13:06:39', '2021-05-18 13:06:39', 1, 6000, 1, 'level_2', 10000, 0),
(25, '2021-05-18 13:18:43', '2021-05-18 13:18:43', 1, 6500, 1, 'level_1', 6500, 0),
(26, '2021-05-19 05:56:15', '2021-05-19 05:56:15', 7, 6000, 1, 'level_2', 6000, 4),
(27, '2021-05-19 06:07:55', '2021-05-19 06:07:55', 7, 30000, 5, 'level_2', 0, 4),
(28, '2021-05-19 06:11:19', '2021-05-19 06:11:19', 7, 13000, 2, 'level_1', 0, 4),
(29, '2021-05-19 06:30:42', '2021-05-19 06:30:42', 7, 7500, 1, 'normal', 10000, 0),
(30, '2021-05-19 07:12:49', '2021-05-19 07:12:49', 7, 7500, 1, 'normal', 0, 0),
(31, '2021-05-19 07:13:57', '2021-05-19 07:13:57', 7, 6000, 1, 'level_2', 0, 4),
(32, '2021-05-19 07:19:43', '2021-05-19 07:19:43', 7, 6500, 1, 'level_1', 0, 4),
(33, '2021-05-19 07:52:08', '2021-05-19 07:52:08', 7, 20000, 5, 'level_2', 0, 3),
(34, '2021-05-19 09:30:47', '2021-05-19 09:30:47', 6, 1300, 1, 'level_2', 1500, 0),
(35, '2021-05-19 09:42:29', '2021-05-19 09:42:29', 7, 18000, 3, 'level_2', 20000, 6);

-- --------------------------------------------------------

--
-- Table structure for table `userlogins`
--

CREATE TABLE `userlogins` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `user_state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userlogins`
--

INSERT INTO `userlogins` (`id`, `created_at`, `updated_at`, `user_id`, `user_state`) VALUES
(1, '2019-07-28 05:59:51', '2019-07-28 05:59:51', 1, 'login'),
(2, '2019-07-28 22:23:15', '2019-07-28 22:23:15', 1, 'login'),
(3, '2019-07-29 00:27:54', '2019-07-29 00:27:54', 1, 'login'),
(4, '2019-07-29 00:38:27', '2019-07-29 00:38:27', 1, 'login'),
(5, '2019-07-29 01:11:04', '2019-07-29 01:11:04', 1, 'login'),
(6, '2019-07-29 01:50:48', '2019-07-29 01:50:48', 1, 'login'),
(7, '2019-07-29 02:19:28', '2019-07-29 02:19:28', 1, 'logout'),
(8, '2019-07-29 02:20:21', '2019-07-29 02:20:21', 1, 'logout'),
(9, '2019-07-29 02:23:16', '2019-07-29 02:23:16', 1, 'logout'),
(10, '2019-07-29 02:26:29', '2019-07-29 02:26:29', 1, 'login'),
(11, '2019-07-29 02:38:04', '2019-07-29 02:38:04', 1, 'login'),
(12, '2019-07-29 02:57:41', '2019-07-29 02:57:41', 1, 'logout'),
(13, '2019-07-29 02:59:05', '2019-07-29 02:59:05', 1, 'login'),
(14, '2019-07-29 03:01:23', '2019-07-29 03:01:23', 1, 'login'),
(15, '2019-07-29 06:31:51', '2019-07-29 06:31:51', 1, 'login'),
(16, '2019-07-30 04:39:42', '2019-07-30 04:39:42', 1, 'login'),
(17, '2019-08-01 02:30:38', '2019-08-01 02:30:38', 1, 'login'),
(18, '2019-08-03 23:23:47', '2019-08-03 23:23:47', 1, 'login'),
(19, '2019-08-23 23:09:31', '2019-08-23 23:09:31', 1, 'login'),
(20, '2019-11-22 01:16:16', '2019-11-22 01:16:16', 1, 'login'),
(21, '2019-11-22 01:17:09', '2019-11-22 01:17:09', 1, 'login'),
(22, '2019-11-26 19:58:34', '2019-11-26 19:58:34', 1, 'login'),
(23, '2019-11-26 20:00:56', '2019-11-26 20:00:56', 1, 'login'),
(24, '2020-03-10 18:00:10', '2020-03-10 18:00:10', 1, 'login'),
(25, '2020-04-25 08:09:07', '2020-04-25 08:09:07', 1, 'login'),
(26, '2020-05-13 22:45:43', '2020-05-13 22:45:43', 1, 'login'),
(27, '2020-05-15 20:26:05', '2020-05-15 20:26:05', 1, 'login'),
(28, '2020-05-17 20:13:38', '2020-05-17 20:13:38', 1, 'login'),
(29, '2020-06-05 20:12:38', '2020-06-05 20:12:38', 1, 'login'),
(30, '2020-08-31 12:07:07', '2020-08-31 12:07:07', 1, 'login'),
(31, '2021-04-21 09:48:53', '2021-04-21 09:48:53', 1, 'login'),
(32, '2021-05-14 07:13:15', '2021-05-14 07:13:15', 1, 'login'),
(33, '2021-05-14 07:33:10', '2021-05-14 07:33:10', 1, 'login'),
(34, '2021-05-14 07:42:20', '2021-05-14 07:42:20', 1, 'logout'),
(35, '2021-05-14 07:42:28', '2021-05-14 07:42:28', 7, 'login'),
(36, '2021-05-14 07:42:34', '2021-05-14 07:42:34', 7, 'logout'),
(37, '2021-05-14 07:42:40', '2021-05-14 07:42:40', 1, 'login'),
(38, '2021-05-15 14:18:37', '2021-05-15 14:18:37', 7, 'login'),
(39, '2021-05-15 14:19:16', '2021-05-15 14:19:16', 7, 'logout'),
(40, '2021-05-16 04:45:07', '2021-05-16 04:45:07', 1, 'login'),
(41, '2021-05-18 09:54:57', '2021-05-18 09:54:57', 1, 'login'),
(42, '2021-05-18 13:23:45', '2021-05-18 13:23:45', 1, 'login'),
(43, '2021-05-19 03:41:15', '2021-05-19 03:41:15', 1, 'login'),
(44, '2021-05-19 03:49:15', '2021-05-19 03:49:15', 1, 'logout'),
(45, '2021-05-19 03:49:30', '2021-05-19 03:49:30', 7, 'login'),
(46, '2021-05-19 09:28:19', '2021-05-19 09:28:19', 7, 'logout'),
(47, '2021-05-19 09:28:46', '2021-05-19 09:28:46', 6, 'login'),
(48, '2021-05-19 09:33:15', '2021-05-19 09:33:15', 6, 'logout'),
(49, '2021-05-19 09:38:05', '2021-05-19 09:38:05', 1, 'login'),
(50, '2021-05-19 09:38:29', '2021-05-19 09:38:29', 1, 'logout'),
(51, '2021-05-19 09:40:03', '2021-05-19 09:40:03', 7, 'login'),
(52, '2021-05-19 09:49:21', '2021-05-19 09:49:21', 1, 'login');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `full_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'POS Admin', 'khinewin123@gmail.com', '$2y$10$kTOI1OQ6sW6tUgfpAtpjP.beJPEY3QRIv2ey84lzu8x3u1X7fbQtO', 'KNxQH4sw1SnGO0srEZNQMhwo6PPWP4vRde9e9Yr6HEnydG10rS3vEjsV2dGb', '2019-06-03 23:56:46', '2019-06-03 23:56:46'),
(6, 'manager', 'SMH Manager', 'manager@smh.com', '$2y$10$9xHkxKETyyCOzeymAvBtVObQefXL.qw5J62rQC451.6f2BOGGz0VS', 'odCSNHxCq16G6F88ACMGERz3ahdhpqckycYh6RSC9Mfrv7q6iZhWjm7pK0oK', '2021-05-14 07:41:43', '2021-05-14 07:41:43'),
(7, 'cashier', 'SMH Cashier', 'cashier@smh.com', '$2y$10$km.47KRYDXaUYlKdm8O75ui45t4KqnTBOGoZur9PL7ww6ZYfpRlQm', 'uqnp7575NbAhoDkcDCmx2wXchnVagY1S6UgIduxOEBtUGx1URZDxjmWrUZ1p', '2021-05-14 07:42:07', '2021-05-14 07:42:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buyinghistories`
--
ALTER TABLE `buyinghistories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `saleitems`
--
ALTER TABLE `saleitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogins`
--
ALTER TABLE `userlogins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buyinghistories`
--
ALTER TABLE `buyinghistories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saleitems`
--
ALTER TABLE `saleitems`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `userlogins`
--
ALTER TABLE `userlogins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
