-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2019 at 05:07 AM
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
-- Database: `karm`
--

-- --------------------------------------------------------

--
-- Table structure for table `additions`
--

CREATE TABLE `additions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `meal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `sort`, `is_active`, `created_at`, `updated_at`) VALUES
(13, 'بيتزا', '/images/uploads/155690756761abaafcd367a1b2053d1bb59a45e68bimage.png', 0, 1, '2019-05-03 18:19:27', '2019-05-03 18:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `category_promocodes`
--

CREATE TABLE `category_promocodes` (
  `id` int(11) NOT NULL,
  `promo_code_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'الرياض', '2019-04-29 12:48:09', '2019-05-03 18:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `calories` double NOT NULL,
  `contents` text,
  `category_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `price`, `calories`, `contents`, `category_id`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(8, 'alaa', 55, 55, 'شسي', 13, 1, NULL, '2019-05-03 18:22:46', '2019-05-03 18:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `meal_images`
--

CREATE TABLE `meal_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meal_images`
--

INSERT INTO `meal_images` (`id`, `image`, `meal_id`) VALUES
(40, '/images/uploads/1556907766cf5f0a2b335e74fa0ae4fb5cdcf4e298image.png', 8);

-- --------------------------------------------------------

--
-- Table structure for table `meal_promocodes`
--

CREATE TABLE `meal_promocodes` (
  `id` int(11) NOT NULL,
  `promo_code_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `meal_sizes`
--

CREATE TABLE `meal_sizes` (
  `id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `meal_sizes`
--

INSERT INTO `meal_sizes` (`id`, `meal_id`, `size`, `price`, `created_at`, `updated_at`) VALUES
(1, 8, 'حجم صغير', 55, '2019-05-03 18:23:17', '2019-05-03 18:23:17');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notification` text NOT NULL,
  `user_type` enum('Casher','Driver','User','Order') NOT NULL,
  `type` enum('New_Order','Order_Accepted','Order_Cancelled','Order_Finished','Cashir_Accept_Order','Driver_Ongoing','Driver_Ongoing') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `the_user_id` int(11) NOT NULL,
  `status` enum('Under_Preparing','Ongoing','Cancelled') NOT NULL,
  `casher_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `receving_type_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `the_user_id`, `status`, `casher_id`, `driver_id`, `receving_type_id`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15, 'Under_Preparing', 39, NULL, 2, 500, '2019-05-04 14:50:21', '2019-05-04 15:00:26', NULL),
(3, 15, 'Ongoing', 39, 28, 2, 33, '2019-05-04 14:50:21', '2019-05-04 15:00:44', NULL),
(4, 14, 'Cancelled', 39, 28, 2, 33, '2019-05-04 14:50:21', '2019-05-04 16:36:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `meal_id`, `quantity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 1, '2019-05-04 15:01:16', '2019-05-04 15:01:16', NULL),
(3, 4, 8, 2, '2019-05-04 15:01:16', '2019-05-04 15:33:07', NULL),
(4, 3, 8, 3, '2019-05-04 15:01:16', '2019-05-04 15:33:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `type` enum('Expiration','Number') NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `trips_limit` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_general` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promocodes`
--

INSERT INTO `promocodes` (`id`, `value`, `code`, `type`, `expiration_date`, `trips_limit`, `description`, `is_active`, `is_general`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 55, 'asd123', 'Number', NULL, 5, 'asd', 1, 0, '2019-05-02 18:33:10', '2019-05-04 15:42:56', NULL),
(6, 44, '444', 'Number', NULL, 44, 'kkk', 1, 0, '2019-05-03 13:24:15', '2019-05-04 15:42:59', NULL),
(7, 55, 'jjjىىىىىى', 'Expiration', '2002-02-20', NULL, 'سس', 1, 0, '2019-05-03 18:24:20', '2019-05-04 15:43:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocodes_orders`
--

CREATE TABLE `promocodes_orders` (
  `id` int(11) NOT NULL,
  `promo_code_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `receiving_types`
--

CREATE TABLE `receiving_types` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receiving_types`
--

INSERT INTO `receiving_types` (`id`, `type`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'محلي', 1, '2019-05-03 18:22:01', '2019-05-03 18:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
(28, 'Hossam2', 1, '2019-05-03 19:05:33', '2019-05-03 19:05:33');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `instgram` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `emergency_call` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `facebook`, `twitter`, `instgram`, `location`, `phone`, `emergency_call`) VALUES
(1, 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instgram.com/', 'https://goo.gl/maps/XcUCWUL1Wpa9ZDbB6', '+92145688', 1911);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `meal_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sms_messages`
--

CREATE TABLE `sms_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `user_type` enum('User') NOT NULL,
  `type` enum('Activation_Account') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `the_users`
--

CREATE TABLE `the_users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `the_users`
--

INSERT INTO `the_users` (`id`, `username`, `email`, `phone`, `is_active`, `token`, `is_blocked`, `deleted_at`, `created_at`, `updated_at`) VALUES
(14, 'مستخدم 1', NULL, '01013696675', 0, 'PgNWk6jFEZZ0aL6Dk+05PAhv0no=', 0, NULL, '2019-05-01 13:43:44', '2019-05-02 22:52:54'),
(15, 'Alaa ragab', NULL, '010136966753', 1, '7VSKW646oI3sRuWE0WgKkXZ8oRg=', 0, NULL, '2019-05-01 16:30:53', '2019-05-01 16:31:02'),
(18, 'Alaa ragjab', NULL, '010143696675', 1, 'aiUj826LExcZWnk+EJIp2i3A+0=', 1, '2019-05-02 20:53:02', '2019-05-02 22:52:24', '2019-05-02 22:53:02'),
(20, 'xde', NULL, '010136960675', 0, '8VL92uR6JnAsAzJNi828japflRs=', 0, '2019-05-03 16:20:07', '2019-05-03 18:19:52', '2019-05-03 18:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'karm@karm.com', '$2y$10$WmeLbczKuYFnEtCnOgm.ie3phaI4kG.lxAvjrC9bG2LViWv8TUxfW', 'fNN4IHdyE0wZaOrlgVtuXjgRIPHR3WDuXKUfT9AAmqKvLpACHB8zuj3Sskhc', '2017-10-24 09:30:04', '2019-04-12 19:15:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `id` int(11) NOT NULL,
  `the_user_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `description` text,
  `street` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`id`, `the_user_id`, `region_id`, `latitude`, `longitude`, `description`, `street`, `created_at`, `updated_at`) VALUES
(4, 15, 28, 12.5445, 13.45554, 'شش', 'طه حسين', '2019-05-04 14:28:53', '2019-05-04 14:28:53'),
(5, 14, 28, 30.0444196, 31.23571160000006, 'ggg', 'طه حسين2', '2019-05-05 02:58:48', '2019-05-05 02:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_devices`
--

CREATE TABLE `user_devices` (
  `id` int(11) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` enum('Driver','Cashair') NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workers`
--

INSERT INTO `workers` (`id`, `username`, `display_name`, `email`, `phone`, `image`, `type`, `password`, `token`, `is_blocked`, `deleted_at`, `created_at`, `updated_at`) VALUES
(28, 'xde', 'مستخدم 1', NULL, '01013696675', '/images/uploads/155698837649a711e54939f0bcba4917df0446f009image.png', 'Driver', 'MTIzNDU2Nzg5', 'SRnvDqk5m9hDk9XXC1fSYvHLS2U=', 1, NULL, '2019-05-01 13:57:33', '2019-05-04 16:46:16'),
(29, 'cto', 'مستخدم 1', NULL, '010136966753', '/images/uploads/1556724180beb1ee29324f6a7bb2d533f1cc3f5decimage.png', 'Cashair', 'MTIz', 'bMfo1VNUaZ4q5OtmlD0CRnHuueM=', 0, '2019-05-02 09:51:05', '2019-05-01 15:23:00', '2019-05-02 11:51:05'),
(31, 'asd', 'asd', NULL, '0101369667453', '/images/uploads/1556837608bb18aadd6208cee9665b6c11f17662d9image.png', 'Driver', 'MTIz', 'Dhfa7FZ5ymjMlOvlsLRCLu+y+c=', 1, '2019-05-02 20:53:47', '2019-05-02 22:53:28', '2019-05-02 22:53:47'),
(33, 'karm@karm.com', 'م444ستخدم 1', NULL, '0101444436966475', '/images/uploads/155683764439286ad56da410d25ca8f8cf803b5eafimage.png', 'Cashair', 'MTIz', 'ENJtpyZbjEYda4IicWVlKhEXXjI=', 0, '2019-05-02 20:54:24', '2019-05-02 22:54:04', '2019-05-02 22:54:24'),
(37, 'ببب', 'مستخدم 12555', NULL, '0101365966753', '/images/uploads/1556907643bcfcace6b8e0f192b019dcfbed54cfafimage.png', 'Driver', 'MTIzNDU2Nw==', 'otiEnljUmOcCE40wQOlxEVr1b4=', 1, '2019-05-03 16:21:01', '2019-05-03 18:20:43', '2019-05-03 18:21:01'),
(39, 'كاشير 1', 'كاشير1', NULL, '010125422', '/images/uploads/1556907690c9bd97046c1db658bf23984df421c94fimage.png', 'Cashair', 'MTIzNDU2Nw==', 'ZgdDDqmwTbzDwQV+3RYJnhGm7Uo=', 0, NULL, '2019-05-03 18:21:30', '2019-05-03 18:21:36'),
(40, 'cc', 'bb', NULL, '5655', '/images/uploads/1556910687050cd3f4ff83a0da96a0384f20742237image.png', 'Cashair', 'MTIzNDU2Nw==', 'eJNQef0KpGgTOvPCGj1miln5VM=', 0, NULL, '2019-05-03 19:11:27', '2019-05-03 19:11:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additions`
--
ALTER TABLE `additions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category_promocodes`
--
ALTER TABLE `category_promocodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `promo_code_id` (`promo_code_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `meal_images`
--
ALTER TABLE `meal_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `meal_promocodes`
--
ALTER TABLE `meal_promocodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_id` (`promo_code_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `meal_sizes`
--
ALTER TABLE `meal_sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`the_user_id`),
  ADD KEY `casher_id` (`casher_id`),
  ADD KEY `driver_id` (`driver_id`),
  ADD KEY `receving_type_id` (`receving_type_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocodes_orders`
--
ALTER TABLE `promocodes_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promo_code_id` (`promo_code_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `receiving_types`
--
ALTER TABLE `receiving_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `sms_messages`
--
ALTER TABLE `sms_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `the_users`
--
ALTER TABLE `the_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`the_user_id`),
  ADD KEY `region_id` (`region_id`);

--
-- Indexes for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additions`
--
ALTER TABLE `additions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `category_promocodes`
--
ALTER TABLE `category_promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `meal_images`
--
ALTER TABLE `meal_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `meal_promocodes`
--
ALTER TABLE `meal_promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meal_sizes`
--
ALTER TABLE `meal_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `promocodes_orders`
--
ALTER TABLE `promocodes_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiving_types`
--
ALTER TABLE `receiving_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sms_messages`
--
ALTER TABLE `sms_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `the_users`
--
ALTER TABLE `the_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_devices`
--
ALTER TABLE `user_devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additions`
--
ALTER TABLE `additions`
  ADD CONSTRAINT `additions_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_promocodes`
--
ALTER TABLE `category_promocodes`
  ADD CONSTRAINT `category_promocodes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_promocodes_ibfk_2` FOREIGN KEY (`promo_code_id`) REFERENCES `promocodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meals`
--
ALTER TABLE `meals`
  ADD CONSTRAINT `meals_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal_images`
--
ALTER TABLE `meal_images`
  ADD CONSTRAINT `meal_images_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal_promocodes`
--
ALTER TABLE `meal_promocodes`
  ADD CONSTRAINT `meal_promocodes_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meal_promocodes_ibfk_2` FOREIGN KEY (`promo_code_id`) REFERENCES `promocodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meal_sizes`
--
ALTER TABLE `meal_sizes`
  ADD CONSTRAINT `meal_sizes_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`casher_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `workers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`the_user_id`) REFERENCES `the_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`receving_type_id`) REFERENCES `receiving_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promocodes_orders`
--
ALTER TABLE `promocodes_orders`
  ADD CONSTRAINT `promocodes_orders_ibfk_1` FOREIGN KEY (`promo_code_id`) REFERENCES `promocodes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocodes_orders_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promocodes_orders_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_ibfk_1` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_addresses_ibfk_2` FOREIGN KEY (`the_user_id`) REFERENCES `the_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_devices`
--
ALTER TABLE `user_devices`
  ADD CONSTRAINT `user_devices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `the_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
