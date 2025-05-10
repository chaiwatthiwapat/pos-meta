-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 05:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posl12`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_28_152628_create_product_table', 1),
(5, '2025_03_12_151537_create_toppings_table', 1),
(6, '2025_03_12_151849_create_sizes_table', 1),
(7, '2025_03_12_152035_create_types_table', 1),
(8, '2025_03_16_063933_add_image_to_users_table', 2),
(9, '2025_03_18_142310_create_orders_table', 3),
(10, '2025_03_18_142543_create_orders_topping_table', 4),
(11, '2025_03_19_152228_create_table_orders_topping', 5),
(12, '2025_03_20_154038_add_role_to_users_table', 6),
(13, '2025_03_22_194141_add_sale_name_to_orders_table', 7),
(14, '2025_03_22_195416_create_orders_detail_table', 8),
(15, '2025_03_22_195733_create_orders_table', 8),
(16, '2025_03_23_125835_add_get_money_and_change_money_to_orders_table', 9),
(17, '2025_03_26_143826_add_orders_detail_id_to_orders_detail_and_orders_topping_tables', 10),
(18, '2025_03_27_134126_add_orders_id_to_orders_topping', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orders_id` bigint(20) UNSIGNED NOT NULL,
  `sale_name` varchar(255) NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `get_money` decimal(10,2) DEFAULT NULL,
  `change_money` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orders_id`, `sale_name`, `total_amount`, `get_money`, `change_money`, `created_at`, `updated_at`) VALUES
(1, 2025032700001, 'admin', 70.00, 100.00, 30.00, '2025-03-27 06:43:29', NULL),
(2, 2025032700002, 'admin', 90.00, 100.00, 10.00, '2025-03-27 06:43:48', NULL),
(4, 2025032700004, 'admin', 130.00, 130.00, 0.00, '2025-03-27 06:44:08', NULL),
(5, 2025032800005, 'admin', 40.00, 100.00, 60.00, '2025-03-28 07:01:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orders_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `orders_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `size_name` varchar(255) DEFAULT NULL,
  `size_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `type_name` varchar(255) DEFAULT NULL,
  `type_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `amount` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `orders_detail_id`, `orders_id`, `product_name`, `product_price`, `size_name`, `size_price`, `type_name`, `type_price`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2025032700001000, 2025032700001, 'น้ำดอกไม้', 15.00, '', 0.00, '', 0.00, 1, 20.00, '2025-03-27 06:43:29', NULL),
(2, 2025032700001001, 2025032700001, 'สตอเบอรี่ส้ม', 30.00, '', 0.00, 'เย็น', 5.00, 1, 50.00, '2025-03-27 06:43:29', NULL),
(3, 2025032700002000, 2025032700002, 'สตอเบอรี่ส้ม', 30.00, 'x', 5.00, '', 0.00, 2, 90.00, '2025-03-27 06:43:48', NULL),
(5, 2025032700004000, 2025032700004, 'ชาเขียวปั่น', 30.00, '', 0.00, '', 0.00, 1, 50.00, '2025-03-27 06:44:08', NULL),
(6, 2025032700004001, 2025032700004, 'ส้มปั่น', 10.00, 'x', 5.00, 'ปั่น', 10.00, 2, 80.00, '2025-03-27 06:44:08', NULL),
(7, 2025032800005000, 2025032800005, 'น้ำดอกไม้', 15.00, '', 0.00, '', 0.00, 1, 15.00, '2025-03-28 07:01:48', NULL),
(8, 2025032800005001, 2025032800005, 'ชามะนาว', 20.00, '', 0.00, 'เย็น', 5.00, 1, 25.00, '2025-03-28 07:01:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_topping`
--

CREATE TABLE `orders_topping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orders_id` bigint(20) UNSIGNED DEFAULT NULL,
  `orders_detail_id` bigint(20) UNSIGNED DEFAULT NULL,
  `topping_name` varchar(255) NOT NULL,
  `topping_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders_topping`
--

INSERT INTO `orders_topping` (`id`, `orders_id`, `orders_detail_id`, `topping_name`, `topping_price`, `created_at`, `updated_at`) VALUES
(1, 2025032700001, 2025032700001000, 'เยลลี่ลิ้นจี่', 5.00, '2025-03-27 06:43:29', NULL),
(2, 2025032700001, 2025032700001001, 'ครีมชีส', 15.00, '2025-03-27 06:43:29', NULL),
(3, 2025032700002, 2025032700002000, 'วุ้นมะพร้าว', 10.00, '2025-03-27 06:43:48', NULL),
(4, 2025032700004, 2025032700004000, 'เยลลี่ลิ้นจี่', 5.00, '2025-03-27 06:44:08', NULL),
(5, 2025032700004, 2025032700004000, 'วุ้นมะพร้าว', 10.00, '2025-03-27 06:44:08', NULL),
(6, 2025032700004, 2025032700004000, 'ไข่มุก', 5.00, '2025-03-27 06:44:08', NULL),
(7, 2025032700004, 2025032700004001, 'วุ้นมะพร้าว', 10.00, '2025-03-27 06:44:08', NULL),
(8, 2025032700004, 2025032700004001, 'เยลลี่ลิ้นจี่', 5.00, '2025-03-27 06:44:08', NULL);

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
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'ชานม', 10.00, 'product67d2decb67cf11741872843.jpg', '2025-03-13 06:34:03', NULL),
(2, 'น้าผลไม้', 20.00, 'product67d2df000f3151741872896.webp', '2025-03-13 06:34:56', NULL),
(3, 'สตอเบอรี่', 18.00, 'product67d2df12ed0661741872914.jpg', '2025-03-13 06:35:14', NULL),
(4, 'สตอเบอรี่ครีม', 25.00, 'product67d2df2318f4c1741872931.jpg', '2025-03-13 06:35:31', NULL),
(5, 'น้ำดอกไม้', 15.00, 'product67d2df347852b1741872948.jpg', '2025-03-13 06:35:48', NULL),
(6, 'สตอเบอรี่ส้ม', 30.00, 'product67d2df475d5101741872967.jpg', '2025-03-13 06:36:07', '2025-03-14 06:40:33'),
(7, 'ชาเขียวปั่น', 30.00, 'product67d2df5a376441741872986.webp', '2025-03-13 06:36:26', NULL),
(8, 'มัทฉะปั่น', 25.00, 'product67d2df6fb4a2b1741873007.webp', '2025-03-13 06:36:47', '2025-03-14 07:05:21'),
(17, 'ชานมสตอ', 25.00, 'product67dd7d135719d1742568723.jpg', '2025-03-21 07:52:03', NULL),
(18, 'ผลไม้ปั่น2', 30.00, 'product67dd7d30381a01742568752.jpg', '2025-03-21 07:52:32', NULL),
(19, 'ปั่น1', 15.00, 'product67dd7d58555dd1742568792.jpg', '2025-03-21 07:53:12', NULL),
(20, 'ชามะนาว', 20.00, 'product67dd7d652f88f1742568805.webp', '2025-03-21 07:53:25', NULL),
(21, 'ส้มปั่น', 10.00, 'product67dd7d78cace21742568824.webp', '2025-03-21 07:53:44', '2025-03-23 05:31:54'),
(22, 'myproduct', 140.00, 'prodcut67e556ccbaeb51743083212.webp', '2025-03-27 06:45:03', '2025-03-27 06:46:52');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mKK1hbhDNOD2kTdqbvNM3xtx9keQC74PJC6a0JUy', 1, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 16_6 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.6 Mobile/15E148 Safari/604.1', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6ImpzRnNDZTQwN2hSQ0tXZmMxODkxNEhsNGU1Tk9rSEZKa09IQmZnUHQiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo1OiJzaXplcyI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6MTI7czo0OiJuYW1lIjtzOjE6InMiO3M6NToicHJpY2UiO3M6NDoiNS4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0xNyAxNzo1MDo1OCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToxO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6MTg7czo0OiJuYW1lIjtzOjE6IngiO3M6NToicHJpY2UiO3M6NDoiNS4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNCAxODoyNzo1OSI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9czo1OiJ0eXBlcyI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Mzp7aTowO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6NTtzOjQ6Im5hbWUiO3M6MTI6IuC5gOC4ouC5h+C4mSI7czo1OiJwcmljZSI7czo0OiI1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE2IDA4OjMxOjQ2IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE3IDE3OjUwOjMxIjt9aToxO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6NjtzOjQ6Im5hbWUiO3M6MTI6IuC4m+C4seC5iOC4mSI7czo1OiJwcmljZSI7czo1OiIxMC4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0xNiAwODozNTo1MSI7czoxMDoidXBkYXRlZF9hdCI7czoxOToiMjAyNS0wMy0xNyAxNzo1MDoxOSI7fWk6MjtPOjg6InN0ZENsYXNzIjo1OntzOjI6ImlkIjtpOjc7czo0OiJuYW1lIjtzOjEyOiLguKPguYnguK3guJkiO3M6NToicHJpY2UiO3M6NToiMTAuMDAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTc6NTA6NDUiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fXM6ODoidG9wcGluZ3MiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjQ6e2k6MDtPOjg6InN0ZENsYXNzIjo1OntzOjI6ImlkIjtpOjQ7czo0OiJuYW1lIjtzOjIxOiLguITguKPguLXguKHguIrguLXguKoiO3M6NToicHJpY2UiO3M6NToiMTUuMDAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTYgMDg6MTY6MTEiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTc6NDk6NDgiO31pOjE7Tzo4OiJzdGRDbGFzcyI6NTp7czoyOiJpZCI7aToxMDtzOjQ6Im5hbWUiO3M6Mzk6IuC5gOC4ouC4peC4peC4teC5iOC4peC4tOC5ieC4meC4iOC4teC5iCI7czo1OiJwcmljZSI7czo0OiI1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE3IDE3OjI3OjM2IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTE3IDE3OjQ5OjM3Ijt9aToyO086ODoic3RkQ2xhc3MiOjU6e3M6MjoiaWQiO2k6MTE7czo0OiJuYW1lIjtzOjMzOiLguKfguLjguYnguJnguKHguLDguJ7guKPguYnguLLguKciO3M6NToicHJpY2UiO3M6NToiMTAuMDAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTc6Mjc6NDYiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMTcgMTc6NDk6NTgiO31pOjM7Tzo4OiJzdGRDbGFzcyI6NTp7czoyOiJpZCI7aToxMjtzOjQ6Im5hbWUiO3M6MTg6IuC5hOC4guC5iOC4oeC4uOC4gSI7czo1OiJwcmljZSI7czo0OiI1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTIyIDE0OjI5OjQ2IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31zOjExOiJvcmRlcnNCaWxscyI7TjtzOjE3OiJvcmRlcnNEZXRhaWxCaWxscyI7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjEzOntzOjI6ImlkIjtpOjE7czoxNjoib3JkZXJzX2RldGFpbF9pZCI7aToyMDI1MDMyNzAwMDAxMDAwO3M6OToib3JkZXJzX2lkIjtpOjIwMjUwMzI3MDAwMDE7czoxMjoicHJvZHVjdF9uYW1lIjtzOjI3OiLguJnguYnguLPguJTguK3guIHguYTguKHguYkiO3M6MTM6InByb2R1Y3RfcHJpY2UiO3M6NToiMTUuMDAiO3M6OToic2l6ZV9uYW1lIjtzOjA6IiI7czoxMDoic2l6ZV9wcmljZSI7czo0OiIwLjAwIjtzOjk6InR5cGVfbmFtZSI7czowOiIiO3M6MTA6InR5cGVfcHJpY2UiO3M6NDoiMC4wMCI7czo4OiJxdWFudGl0eSI7aToxO3M6NjoiYW1vdW50IjtzOjU6IjIwLjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTI3IDEzOjQzOjI5IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO31pOjE7Tzo4OiJzdGRDbGFzcyI6MTM6e3M6MjoiaWQiO2k6MjtzOjE2OiJvcmRlcnNfZGV0YWlsX2lkIjtpOjIwMjUwMzI3MDAwMDEwMDE7czo5OiJvcmRlcnNfaWQiO2k6MjAyNTAzMjcwMDAwMTtzOjEyOiJwcm9kdWN0X25hbWUiO3M6MzY6IuC4quC4leC4reC5gOC4muC4reC4o+C4teC5iOC4quC5ieC4oSI7czoxMzoicHJvZHVjdF9wcmljZSI7czo1OiIzMC4wMCI7czo5OiJzaXplX25hbWUiO3M6MDoiIjtzOjEwOiJzaXplX3ByaWNlIjtzOjQ6IjAuMDAiO3M6OToidHlwZV9uYW1lIjtzOjEyOiLguYDguKLguYfguJkiO3M6MTA6InR5cGVfcHJpY2UiO3M6NDoiNS4wMCI7czo4OiJxdWFudGl0eSI7aToxO3M6NjoiYW1vdW50IjtzOjU6IjUwLjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTI3IDEzOjQzOjI5IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31zOjE1OiJ0b3BwaW5nc0dyb3VwZWQiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjU6e2k6MjAyNTAzMjcwMDAwMTAwMDtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcQ29sbGVjdGlvbiI6Mjp7czo4OiIAKgBpdGVtcyI7YToxOntpOjA7Tzo4OiJzdGRDbGFzcyI6Nzp7czoyOiJpZCI7aToxO3M6OToib3JkZXJzX2lkIjtpOjIwMjUwMzI3MDAwMDE7czoxNjoib3JkZXJzX2RldGFpbF9pZCI7aToyMDI1MDMyNzAwMDAxMDAwO3M6MTI6InRvcHBpbmdfbmFtZSI7czozOToi4LmA4Lii4Lil4Lil4Li14LmI4Lil4Li04LmJ4LiZ4LiI4Li14LmIIjtzOjEzOiJ0b3BwaW5nX3ByaWNlIjtzOjQ6IjUuMDAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjUtMDMtMjcgMTM6NDM6MjkiO3M6MTA6InVwZGF0ZWRfYXQiO047fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fWk6MjAyNTAzMjcwMDAwMTAwMTtPOjI5OiJJbGx1bWluYXRlXFN1cHBvcnRcQ29sbGVjdGlvbiI6Mjp7czo4OiIAKgBpdGVtcyI7YToxOntpOjA7Tzo4OiJzdGRDbGFzcyI6Nzp7czoyOiJpZCI7aToyO3M6OToib3JkZXJzX2lkIjtpOjIwMjUwMzI3MDAwMDE7czoxNjoib3JkZXJzX2RldGFpbF9pZCI7aToyMDI1MDMyNzAwMDAxMDAxO3M6MTI6InRvcHBpbmdfbmFtZSI7czoyMToi4LiE4Lij4Li14Lih4LiK4Li14LiqIjtzOjEzOiJ0b3BwaW5nX3ByaWNlIjtzOjU6IjE1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTI3IDEzOjQzOjI5IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31pOjIwMjUwMzI3MDAwMDIwMDA7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6MTp7aTowO086ODoic3RkQ2xhc3MiOjc6e3M6MjoiaWQiO2k6MztzOjk6Im9yZGVyc19pZCI7aToyMDI1MDMyNzAwMDAyO3M6MTY6Im9yZGVyc19kZXRhaWxfaWQiO2k6MjAyNTAzMjcwMDAwMjAwMDtzOjEyOiJ0b3BwaW5nX25hbWUiO3M6MzM6IuC4p+C4uOC5ieC4meC4oeC4sOC4nuC4o+C5ieC4suC4pyI7czoxMzoidG9wcGluZ19wcmljZSI7czo1OiIxMC4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNyAxMzo0Mzo0OCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9fXM6Mjg6IgAqAGVzY2FwZVdoZW5DYXN0aW5nVG9TdHJpbmciO2I6MDt9aToyMDI1MDMyNzAwMDA0MDAwO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjM6e2k6MDtPOjg6InN0ZENsYXNzIjo3OntzOjI6ImlkIjtpOjQ7czo5OiJvcmRlcnNfaWQiO2k6MjAyNTAzMjcwMDAwNDtzOjE2OiJvcmRlcnNfZGV0YWlsX2lkIjtpOjIwMjUwMzI3MDAwMDQwMDA7czoxMjoidG9wcGluZ19uYW1lIjtzOjM5OiLguYDguKLguKXguKXguLXguYjguKXguLTguYnguJnguIjguLXguYgiO3M6MTM6InRvcHBpbmdfcHJpY2UiO3M6NDoiNS4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNyAxMzo0NDowOCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToxO086ODoic3RkQ2xhc3MiOjc6e3M6MjoiaWQiO2k6NTtzOjk6Im9yZGVyc19pZCI7aToyMDI1MDMyNzAwMDA0O3M6MTY6Im9yZGVyc19kZXRhaWxfaWQiO2k6MjAyNTAzMjcwMDAwNDAwMDtzOjEyOiJ0b3BwaW5nX25hbWUiO3M6MzM6IuC4p+C4uOC5ieC4meC4oeC4sOC4nuC4o+C5ieC4suC4pyI7czoxMzoidG9wcGluZ19wcmljZSI7czo1OiIxMC4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNyAxMzo0NDowOCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToyO086ODoic3RkQ2xhc3MiOjc6e3M6MjoiaWQiO2k6NjtzOjk6Im9yZGVyc19pZCI7aToyMDI1MDMyNzAwMDA0O3M6MTY6Im9yZGVyc19kZXRhaWxfaWQiO2k6MjAyNTAzMjcwMDAwNDAwMDtzOjEyOiJ0b3BwaW5nX25hbWUiO3M6MTg6IuC5hOC4guC5iOC4oeC4uOC4gSI7czoxMzoidG9wcGluZ19wcmljZSI7czo0OiI1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTI3IDEzOjQ0OjA4IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31pOjIwMjUwMzI3MDAwMDQwMDE7TzoyOToiSWxsdW1pbmF0ZVxTdXBwb3J0XENvbGxlY3Rpb24iOjI6e3M6ODoiACoAaXRlbXMiO2E6Mjp7aTowO086ODoic3RkQ2xhc3MiOjc6e3M6MjoiaWQiO2k6NztzOjk6Im9yZGVyc19pZCI7aToyMDI1MDMyNzAwMDA0O3M6MTY6Im9yZGVyc19kZXRhaWxfaWQiO2k6MjAyNTAzMjcwMDAwNDAwMTtzOjEyOiJ0b3BwaW5nX25hbWUiO3M6MzM6IuC4p+C4uOC5ieC4meC4oeC4sOC4nuC4o+C5ieC4suC4pyI7czoxMzoidG9wcGluZ19wcmljZSI7czo1OiIxMC4wMCI7czoxMDoiY3JlYXRlZF9hdCI7czoxOToiMjAyNS0wMy0yNyAxMzo0NDowOCI7czoxMDoidXBkYXRlZF9hdCI7Tjt9aToxO086ODoic3RkQ2xhc3MiOjc6e3M6MjoiaWQiO2k6ODtzOjk6Im9yZGVyc19pZCI7aToyMDI1MDMyNzAwMDA0O3M6MTY6Im9yZGVyc19kZXRhaWxfaWQiO2k6MjAyNTAzMjcwMDAwNDAwMTtzOjEyOiJ0b3BwaW5nX25hbWUiO3M6Mzk6IuC5gOC4ouC4peC4peC4teC5iOC4peC4tOC5ieC4meC4iOC4teC5iCI7czoxMzoidG9wcGluZ19wcmljZSI7czo0OiI1LjAwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDI1LTAzLTI3IDEzOjQ0OjA4IjtzOjEwOiJ1cGRhdGVkX2F0IjtOO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO319', 1743174779);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(12, 's', 5.00, '2025-03-17 10:50:58', NULL),
(18, 'x', 5.00, '2025-03-24 11:27:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE `toppings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(4, 'ครีมชีส', 15.00, '2025-03-16 01:16:11', '2025-03-17 10:49:48'),
(10, 'เยลลี่ลิ้นจี่', 5.00, '2025-03-17 10:27:36', '2025-03-17 10:49:37'),
(11, 'วุ้นมะพร้าว', 10.00, '2025-03-17 10:27:46', '2025-03-17 10:49:58'),
(12, 'ไข่มุก', 5.00, '2025-03-22 07:29:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(5, 'เย็น', 5.00, '2025-03-16 01:31:46', '2025-03-17 10:50:31'),
(6, 'ปั่น', 10.00, '2025-03-16 01:35:51', '2025-03-17 10:50:19'),
(7, 'ร้อน', 10.00, '2025-03-17 10:50:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'user67dc386ceb7dc1742485612.jpg', 'admin', NULL, '$2y$12$JD1DHwmrFEnhfW0miD.KaelpLKuraRIqsVs5tOW9Ye196QKA2h/vW', NULL, '2025-03-20 08:46:53', NULL),
(2, 'staff', NULL, 'user67dc393d9fbac1742485821.png', 'staff', NULL, '$2y$12$t9ln594LrHO6XTAAEJHajuiUt7bt1qqjaB2OvsixFYox6RonDrcbK', NULL, '2025-03-20 08:50:21', NULL),
(4, 'user', NULL, 'user67dc48685f7841742489704.webp', 'staff', NULL, '$2y$12$x8WyxuWk0hzs7SVjT6za9.8SmI1m2hl9/Y9Ksud3RzEby9PL8Tx/q', NULL, '2025-03-20 09:55:04', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_id` (`orders_id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_topping`
--
ALTER TABLE `orders_topping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
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
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_topping`
--
ALTER TABLE `orders_topping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
