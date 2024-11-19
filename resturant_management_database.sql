-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 04, 2024 at 11:31 AM
-- Server version: 10.11.9-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u454256401_betarestaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` double(8,2) DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `service_charge` double(8,2) DEFAULT NULL,
  `grand_total` double(8,2) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `menu_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bills`
--

INSERT INTO `bills` (`id`, `total_amount`, `tax`, `discount`, `service_charge`, `grand_total`, `status`, `menu_id`, `order_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 440.00, 13.00, 5.00, 10.00, 519.20, 1, NULL, 1, 1, NULL, '2024-09-20 18:47:12', '2024-09-20 18:47:12'),
(2, 760.00, 13.00, 5.00, 10.00, 896.80, 1, NULL, 2, 1, NULL, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(3, 320.00, 0.00, 20.00, 0.00, 256.00, 1, NULL, 3, 1, NULL, '2024-09-21 04:01:56', '2024-09-21 04:01:56'),
(4, 320.00, 0.00, 0.00, 0.00, 320.00, 1, NULL, 4, 1, NULL, '2024-09-21 04:05:11', '2024-09-21 04:05:11'),
(5, 720.00, 13.00, 5.00, 10.00, 849.60, 1, NULL, 5, 1, NULL, '2024-09-21 04:07:56', '2024-09-21 04:07:56'),
(6, 120.00, 0.00, 0.00, 0.00, 120.00, 1, NULL, 6, 1, NULL, '2024-09-21 04:08:55', '2024-09-21 04:08:55'),
(7, 120.00, 0.00, 0.00, 0.00, 120.00, 1, NULL, 7, 1, NULL, '2024-09-21 04:09:37', '2024-09-21 04:09:37'),
(8, 520.00, 0.00, 0.00, 0.00, 520.00, 1, NULL, 8, 1, NULL, '2024-09-21 07:25:19', '2024-09-21 07:25:19'),
(9, 2000.00, 0.00, 0.00, 0.00, 2000.00, 1, NULL, 9, 1, NULL, '2024-09-21 07:26:17', '2024-09-21 07:26:17'),
(10, 2520.00, 0.00, 0.00, 0.00, 2520.00, 1, NULL, 10, 1, NULL, '2024-09-23 08:56:15', '2024-09-23 08:56:15'),
(11, 2200.00, 0.00, 0.00, 0.00, 2200.00, 1, NULL, 11, 1, NULL, '2024-09-23 13:58:18', '2024-09-23 13:58:18'),
(12, 2270.00, 13.00, 5.00, 10.00, 2678.60, 1, NULL, 12, 1, NULL, '2024-09-24 02:52:45', '2024-09-24 02:52:45'),
(13, 2290.00, 13.00, 20.00, 0.00, 2129.70, 1, NULL, 13, 1, NULL, '2024-09-24 03:05:31', '2024-09-24 03:05:31'),
(14, 2410.00, 13.00, 20.00, 10.00, 2482.30, 1, NULL, 15, 1, NULL, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(15, 2000.00, 13.00, 12.00, 10.00, 2220.00, 1, NULL, 16, 1, NULL, '2024-09-24 18:14:32', '2024-09-24 18:14:32'),
(16, 2000.00, 13.00, 12.00, 10.00, 2220.00, 1, NULL, 16, 1, NULL, '2024-09-24 18:14:35', '2024-09-24 18:14:35'),
(17, 380.00, 0.00, 0.00, 0.00, 380.00, 1, NULL, 20, 1, NULL, '2024-09-25 15:11:28', '2024-09-25 15:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `bill_order_items`
--

CREATE TABLE `bill_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bill_order_items`
--

INSERT INTO `bill_order_items` (`id`, `bill_id`, `order_id`, `menu_id`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 120.00, '2024-09-20 18:47:12', '2024-09-20 18:47:12'),
(2, 1, 1, 1, 200.00, '2024-09-20 18:47:12', '2024-09-20 18:47:12'),
(3, 1, 1, 2, 120.00, '2024-09-20 18:47:12', '2024-09-20 18:47:12'),
(4, 2, 2, 2, 120.00, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(5, 2, 2, 1, 200.00, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(6, 2, 2, 2, 120.00, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(7, 2, 2, 1, 200.00, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(8, 2, 2, 2, 120.00, '2024-09-20 19:11:28', '2024-09-20 19:11:28'),
(9, 3, 3, 1, 200.00, '2024-09-21 04:01:56', '2024-09-21 04:01:56'),
(10, 3, 3, 2, 120.00, '2024-09-21 04:01:56', '2024-09-21 04:01:56'),
(11, 4, 4, 1, 200.00, '2024-09-21 04:05:11', '2024-09-21 04:05:11'),
(12, 4, 4, 2, 120.00, '2024-09-21 04:05:11', '2024-09-21 04:05:11'),
(13, 5, 5, 1, 200.00, '2024-09-21 04:07:56', '2024-09-21 04:07:56'),
(14, 5, 5, 2, 120.00, '2024-09-21 04:07:56', '2024-09-21 04:07:56'),
(15, 5, 5, 1, 200.00, '2024-09-21 04:07:56', '2024-09-21 04:07:56'),
(16, 5, 5, 1, 200.00, '2024-09-21 04:07:56', '2024-09-21 04:07:56'),
(17, 6, 6, 2, 120.00, '2024-09-21 04:08:55', '2024-09-21 04:08:55'),
(18, 7, 7, 2, 120.00, '2024-09-21 04:09:37', '2024-09-21 04:09:37'),
(19, 8, 8, 1, 200.00, '2024-09-21 07:25:19', '2024-09-21 07:25:19'),
(20, 8, 8, 2, 120.00, '2024-09-21 07:25:19', '2024-09-21 07:25:19'),
(21, 8, 8, 1, 200.00, '2024-09-21 07:25:19', '2024-09-21 07:25:19'),
(22, 9, 9, 3, 2000.00, '2024-09-21 07:26:17', '2024-09-21 07:26:17'),
(23, 10, 10, 1, 200.00, '2024-09-23 08:56:15', '2024-09-23 08:56:15'),
(24, 10, 10, 2, 120.00, '2024-09-23 08:56:15', '2024-09-23 08:56:15'),
(25, 10, 10, 3, 2000.00, '2024-09-23 08:56:15', '2024-09-23 08:56:15'),
(26, 10, 10, 1, 200.00, '2024-09-23 08:56:15', '2024-09-23 08:56:15'),
(27, 11, 11, 1, 200.00, '2024-09-23 13:58:18', '2024-09-23 13:58:18'),
(28, 11, 11, 3, 2000.00, '2024-09-23 13:58:18', '2024-09-23 13:58:18'),
(29, 12, 12, 2, 120.00, '2024-09-24 02:52:45', '2024-09-24 02:52:45'),
(30, 12, 12, 3, 2000.00, '2024-09-24 02:52:45', '2024-09-24 02:52:45'),
(31, 12, 12, 4, 150.00, '2024-09-24 02:52:45', '2024-09-24 02:52:45'),
(32, 13, 13, 5, 20.00, '2024-09-24 03:05:31', '2024-09-24 03:05:31'),
(33, 13, 13, 2, 120.00, '2024-09-24 03:05:31', '2024-09-24 03:05:31'),
(34, 13, 13, 3, 2000.00, '2024-09-24 03:05:31', '2024-09-24 03:05:31'),
(35, 13, 13, 4, 150.00, '2024-09-24 03:05:31', '2024-09-24 03:05:31'),
(36, 14, 15, 2, 120.00, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(37, 14, 15, 4, 150.00, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(38, 14, 15, 3, 2000.00, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(39, 14, 15, 5, 20.00, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(40, 14, 15, 2, 120.00, '2024-09-24 18:10:44', '2024-09-24 18:10:44'),
(41, 15, 16, 3, 2000.00, '2024-09-24 18:14:32', '2024-09-24 18:14:32'),
(42, 16, 16, 3, 2000.00, '2024-09-24 18:14:35', '2024-09-24 18:14:35'),
(43, 17, 20, 5, 20.00, '2024-09-25 15:11:28', '2024-09-25 15:11:28'),
(44, 17, 20, 6, 40.00, '2024-09-25 15:11:28', '2024-09-25 15:11:28'),
(45, 17, 20, 1, 200.00, '2024-09-25 15:11:28', '2024-09-25 15:11:28'),
(46, 17, 20, 2, 120.00, '2024-09-25 15:11:28', '2024-09-25 15:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Coffee', 1, '2024-09-20 18:42:13', '2024-09-20 18:42:13'),
(2, 'snacks', 1, '2024-09-20 18:44:21', '2024-09-20 18:44:21'),
(5, 'Lunch', 1, '2024-09-21 07:10:37', '2024-09-23 09:31:46'),
(6, 'Tea Bag', 1, '2024-09-24 03:02:40', '2024-09-25 04:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_desc` text NOT NULL,
  `event_price` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `quantity`, `unit`, `created_at`, `updated_at`) VALUES
(7, 'Momo masala', 4.00, 'kg', '2024-09-24 18:05:58', '2024-09-24 18:05:58'),
(8, 'Milk', 10.00, 'Liter', '2024-09-25 15:12:59', '2024-09-25 15:12:59');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `name`, `images`, `description`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Capichino', '1727082507.png', 'coffe', 200, 1, '2024-09-20 18:44:26', '2024-09-23 09:08:27'),
(2, 'peanut sadeko', '1727082693.jpg', 'dskjajs', 120, 2, '2024-09-20 18:44:57', '2024-09-23 09:11:33'),
(3, 'Burger', '1727083872.webp', 'Rich Chocolate Burger', 2000, 5, '2024-09-21 07:12:05', '2024-09-23 09:31:12'),
(4, 'Chowmin', '1727083972-gettyimages-938742222-612x612.jpg', 'Non-veg chowmin', 150, 5, '2024-09-23 09:32:52', '2024-09-23 09:32:52'),
(5, 'Ginger Tea', NULL, 'nice tea i,prove power', 20, 6, '2024-09-24 03:03:33', '2024-09-24 03:03:33'),
(6, 'Masala Tea', NULL, 'Best Tea in Town', 40, 6, '2024-09-24 18:12:12', '2024-09-24 18:12:12'),
(7, 'khalifa food store', '1727710536-mia', 'big banana', 6000, 5, '2024-09-30 15:35:36', '2024-09-30 15:35:36');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2024_05_24_163538_add_image_to_users_table', 1),
(4, '2024_05_25_024205_create_categories_table', 1),
(5, '2024_05_25_133335_create_menu_items_table', 1),
(6, '2024_05_26_133755_create_events_table', 1),
(7, '2024_05_27_023313_add_position_to_users_table', 1),
(8, '2024_08_04_152538_create_tabledatas_table', 1),
(9, '2024_08_05_021044_create_reservations_table', 1),
(10, '2024_08_05_134412_create_orderfoods_table', 1),
(11, '2024_09_14_164551_create_orders_table', 1),
(12, '2024_09_14_164608_create_order_items_table', 1),
(13, '2024_09_17_050206_create_bills_table', 1),
(14, '2024_09_18_091303_create_bill_order_items_table', 1),
(15, '2024_09_20_053405_create_ingredients_table', 1),
(16, '2024_09_20_055805_create_stocks_table', 1),
(17, '2024_09_22_035753_create_suppliers_table', 2),
(18, '2024_09_22_055653_create_purchases_table', 2),
(19, '2024_09_22_070826_create_purchase_details_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orderfoods`
--

CREATE TABLE `orderfoods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_item_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(255) NOT NULL DEFAULT '1',
  `price` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `table_id`, `created_at`, `updated_at`) VALUES
(1, 2, '2024-09-20 18:46:09', '2024-09-20 18:46:09'),
(2, 1, '2024-09-20 19:10:20', '2024-09-20 19:10:20'),
(3, 2, '2024-09-21 03:58:50', '2024-09-21 03:58:50'),
(4, 3, '2024-09-21 04:04:48', '2024-09-21 04:04:48'),
(5, 2, '2024-09-21 04:07:01', '2024-09-21 04:07:01'),
(6, 1, '2024-09-21 04:08:46', '2024-09-21 04:08:46'),
(7, 3, '2024-09-21 04:09:08', '2024-09-21 04:09:08'),
(8, 4, '2024-09-21 06:50:53', '2024-09-21 06:50:53'),
(9, 3, '2024-09-21 07:16:25', '2024-09-21 07:16:25'),
(10, 3, '2024-09-23 08:55:51', '2024-09-23 08:55:51'),
(11, 2, '2024-09-23 13:58:04', '2024-09-23 13:58:04'),
(12, 2, '2024-09-24 02:52:26', '2024-09-24 02:52:26'),
(13, 1, '2024-09-24 03:04:24', '2024-09-24 03:04:24'),
(15, 3, '2024-09-24 18:09:54', '2024-09-24 18:09:54'),
(16, 5, '2024-09-24 18:13:24', '2024-09-24 18:13:24'),
(20, 4, '2024-09-25 15:10:31', '2024-09-25 15:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `menu_id`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 1, '2024-09-20 18:46:40', '2024-09-20 18:47:12'),
(4, 1, 1, 1, '2024-09-20 18:46:41', '2024-09-20 18:47:12'),
(5, 1, 2, 1, '2024-09-20 18:46:41', '2024-09-20 18:47:12'),
(8, 2, 2, 1, '2024-09-20 19:10:45', '2024-09-20 19:11:28'),
(9, 2, 1, 1, '2024-09-20 19:10:45', '2024-09-20 19:11:28'),
(10, 2, 2, 1, '2024-09-20 19:10:45', '2024-09-20 19:11:28'),
(11, 2, 1, 1, '2024-09-20 19:10:45', '2024-09-20 19:11:28'),
(12, 2, 2, 1, '2024-09-20 19:10:45', '2024-09-20 19:11:28'),
(13, 3, 1, 1, '2024-09-21 03:58:50', '2024-09-21 04:01:56'),
(14, 3, 2, 1, '2024-09-21 03:58:50', '2024-09-21 04:01:56'),
(15, 4, 1, 1, '2024-09-21 04:04:48', '2024-09-21 04:05:11'),
(16, 4, 2, 1, '2024-09-21 04:04:48', '2024-09-21 04:05:11'),
(20, 5, 1, 1, '2024-09-21 04:07:28', '2024-09-21 04:07:56'),
(21, 5, 2, 1, '2024-09-21 04:07:28', '2024-09-21 04:07:56'),
(22, 5, 1, 1, '2024-09-21 04:07:28', '2024-09-21 04:07:56'),
(23, 5, 1, 1, '2024-09-21 04:07:28', '2024-09-21 04:07:56'),
(24, 6, 2, 1, '2024-09-21 04:08:46', '2024-09-21 04:08:55'),
(25, 7, 2, 1, '2024-09-21 04:09:08', '2024-09-21 04:09:37'),
(28, 8, 1, 1, '2024-09-21 06:51:13', '2024-09-21 07:25:19'),
(29, 8, 2, 1, '2024-09-21 06:51:13', '2024-09-21 07:25:19'),
(30, 8, 1, 1, '2024-09-21 06:51:13', '2024-09-21 07:25:19'),
(31, 9, 3, 1, '2024-09-21 07:16:25', '2024-09-21 07:26:17'),
(32, 10, 1, 1, '2024-09-23 08:55:51', '2024-09-23 08:56:15'),
(33, 10, 2, 1, '2024-09-23 08:55:51', '2024-09-23 08:56:15'),
(34, 10, 3, 1, '2024-09-23 08:55:51', '2024-09-23 08:56:15'),
(35, 10, 1, 1, '2024-09-23 08:55:51', '2024-09-23 08:56:15'),
(36, 11, 1, 1, '2024-09-23 13:58:04', '2024-09-23 13:58:18'),
(37, 11, 3, 1, '2024-09-23 13:58:04', '2024-09-23 13:58:18'),
(38, 12, 2, 1, '2024-09-24 02:52:26', '2024-09-24 02:52:45'),
(39, 12, 3, 1, '2024-09-24 02:52:26', '2024-09-24 02:52:45'),
(40, 12, 4, 1, '2024-09-24 02:52:26', '2024-09-24 02:52:45'),
(44, 13, 5, 1, '2024-09-24 03:04:55', '2024-09-24 03:05:31'),
(45, 13, 2, 1, '2024-09-24 03:04:55', '2024-09-24 03:05:31'),
(46, 13, 3, 1, '2024-09-24 03:04:55', '2024-09-24 03:05:31'),
(47, 13, 4, 1, '2024-09-24 03:04:55', '2024-09-24 03:05:31'),
(62, 15, 2, 1, '2024-09-24 18:10:09', '2024-09-24 18:10:44'),
(63, 15, 4, 1, '2024-09-24 18:10:09', '2024-09-24 18:10:44'),
(64, 15, 3, 1, '2024-09-24 18:10:09', '2024-09-24 18:10:44'),
(65, 15, 5, 1, '2024-09-24 18:10:09', '2024-09-24 18:10:44'),
(66, 15, 2, 1, '2024-09-24 18:10:09', '2024-09-24 18:10:44'),
(67, 16, 3, 1, '2024-09-24 18:13:24', '2024-09-24 18:14:35'),
(78, 20, 5, 1, '2024-09-25 15:10:31', '2024-09-25 15:11:28'),
(79, 20, 6, 1, '2024-09-25 15:10:31', '2024-09-25 15:11:28'),
(80, 20, 1, 1, '2024-09-25 15:10:31', '2024-09-25 15:11:28'),
(81, 20, 2, 1, '2024-09-25 15:10:31', '2024-09-25 15:11:28');

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

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_date` date NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `table_id` bigint(20) UNSIGNED NOT NULL,
  `reservation_date` varchar(255) NOT NULL,
  `reservation_time` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` double(8,2) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabledatas`
--

CREATE TABLE `tabledatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_number` varchar(255) NOT NULL,
  `seat_capicity` varchar(255) NOT NULL,
  `status` enum('Available','Occupied','Reserved') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tabledatas`
--

INSERT INTO `tabledatas` (`id`, `table_number`, `seat_capicity`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '4', 'Available', '2024-09-20 18:39:37', '2024-10-04 07:34:49'),
(2, '12op', '6', 'Available', '2024-09-20 18:45:43', '2024-09-24 02:52:45'),
(3, 'Table no.1', '5', 'Available', '2024-09-21 04:03:36', '2024-10-04 07:35:00'),
(4, 'Table no.2', '5', 'Available', '2024-09-21 04:03:49', '2024-09-25 15:11:28'),
(5, '6', '4', 'Available', '2024-09-24 18:12:54', '2024-09-25 02:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `position` enum('employee','users') DEFAULT 'users',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `images`, `email`, `email_verified_at`, `phone`, `address`, `is_verified`, `is_admin`, `position`, `password`, `remember_token`, `created_at`, `updated_at`, `designation`) VALUES
(1, 'Prashant Mahatto', '1727277468-1727201867-prashant.webp', 'prakash@gmail.com', '2024-09-18 23:53:42', '9706818794', 'Lalitpur Balkumari', 1, 1, 'employee', '$2y$12$vFzX7WRztXLGmvUSm/wvYOYIRD/xkgI8FqlbmZPCwKxPELHKOmADa', NULL, NULL, '2024-09-25 15:17:48', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bills_order_id_foreign` (`order_id`),
  ADD KEY `bills_menu_id_foreign` (`menu_id`),
  ADD KEY `bills_created_by_foreign` (`created_by`),
  ADD KEY `bills_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `bill_order_items`
--
ALTER TABLE `bill_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bill_order_items_bill_id_foreign` (`bill_id`),
  ADD KEY `bill_order_items_order_id_foreign` (`order_id`),
  ADD KEY `bill_order_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderfoods`
--
ALTER TABLE `orderfoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderfoods_user_id_foreign` (`user_id`),
  ADD KEY `orderfoods_menu_item_id_foreign` (`menu_item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_table_id_foreign` (`table_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_details_ingredient_id_foreign` (`ingredient_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_user_id_foreign` (`user_id`),
  ADD KEY `reservations_table_id_foreign` (`table_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_ingredient_id_foreign` (`ingredient_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tabledatas`
--
ALTER TABLE `tabledatas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_designation_unique` (`designation`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `bill_order_items`
--
ALTER TABLE `bill_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orderfoods`
--
ALTER TABLE `orderfoods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tabledatas`
--
ALTER TABLE `tabledatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bill_order_items`
--
ALTER TABLE `bill_order_items`
  ADD CONSTRAINT `bill_order_items_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bill_order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `orderfoods`
--
ALTER TABLE `orderfoods`
  ADD CONSTRAINT `orderfoods_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orderfoods_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tabledatas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu_items` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_details_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_table_id_foreign` FOREIGN KEY (`table_id`) REFERENCES `tabledatas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
