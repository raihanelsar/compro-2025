-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2025 at 06:26 AM
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
-- Database: `db_porto_3_2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `content`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(2, 'Gunung Bromo', '<p>Gunung Bromo atau dalam bahasa Tengger dieja \"Brama\", juga disebut Kaldera Tengger, adalah sebuah gunung berapi aktif di Jawa Timur, Indonesia.</p>', '1755056982-bromo2.jpg', 1, '2025-08-13 03:49:42', '2025-08-13 04:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` longtext NOT NULL,
  `writer` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `image` varchar(100) NOT NULL,
  `tags` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `id_category`, `title`, `content`, `writer`, `is_active`, `image`, `tags`, `created_at`, `updated_at`) VALUES
(1, 1, 'Akagami', '<p>1 Keping</p>', 'Admin', 1, '1755156490-akagami.jpeg', '[{\"value\":\"Akagami\"},{\"value\":\"1Keping\"}]', '2025-08-14 07:28:10', '2025-08-15 01:44:36'),
(2, 1, 'God Valley', '<p>6 Emperor</p>', 'Admin', 0, '1755222551-godValley.jpeg', '[{\"value\":\"God\"},{\"value\":\"Valley\"}]', '2025-08-15 01:49:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(35) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `created_at`, `updated_at`) VALUES
(1, 'IT', 'blog', '2025-08-15 02:13:00', '2025-08-15 02:13:00'),
(2, 'Bisnis', 'blog', '2025-08-15 02:13:04', '2025-08-15 02:13:04'),
(3, 'App', 'portofolio', '2025-08-15 02:14:51', NULL),
(4, 'Card', 'portofolio', '2025-08-15 02:14:51', NULL),
(5, 'Web', 'portofolio', '2025-08-15 02:15:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(7, '', '1755065349-download.jpeg', 1, '2025-08-13 06:08:57', '2025-08-13 06:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `portofolios`
--

CREATE TABLE `portofolios` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `project_date` date NOT NULL,
  `project_url` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portofolios`
--

INSERT INTO `portofolios` (`id`, `id_category`, `title`, `content`, `client_name`, `project_date`, `project_url`, `image`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 5, 'Langit', '<p><br></p>', 'Sky', '2025-08-15', 'https://www.google.com/url?sa=i&url=https%3A%2F%2F', '1755226967-download.jpeg', 1, '2025-08-15 03:02:47', '2025-08-15 03:46:44'),
(2, 4, 'Bromo', '', 'Gun Ung', '2025-08-15', 'https://www.google.com/url?sa=i&url=https%3A%2F%2F', '1755228251-bromo2.jpg', 1, '2025-08-15 03:24:11', '2025-08-15 03:46:39'),
(3, 3, 'God Valley', '<p>6 Emperor</p>', 'Valley', '2025-08-15', 'https://www.google.com/url?sa=i&url=https%3A%2F%2F', '1755229379-godValley.jpeg', 1, '2025-08-15 03:42:59', '2025-08-15 03:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `ig` varchar(100) NOT NULL,
  `linkedin` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `phone`, `address`, `logo`, `twitter`, `fb`, `ig`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'udin@gmail.com', '086521312434', 'jakarta', '1754966464-burgerking.png', 'https://x.com/', 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://id.linkedin.com/', '2025-08-11 07:54:36', '2025-08-12 02:41:04');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(16, 'midnight', 'midnight', '1754984010-d197f3d63e273b6f5c105412b799eae6.jpeg', '2025-08-12 07:33:30', NULL),
(20, 'sky', 'langit', '1755050066-wallpapersden.com_minimal-hd-landscape_1920x1080.jpg', '2025-08-13 01:54:26', NULL),
(22, 'sunset', 'samsat', '1755050127-1920x1080-aesthetic-glrfk0ntspz3tvxg.jpg', '2025-08-13 01:55:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345678', '2025-08-08 07:11:50', '2025-08-09 07:08:14'),
(2, 'Elsar', 'elsar@gmail.com', '123456789', '2025-08-11 03:02:28', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portofolios`
--
ALTER TABLE `portofolios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `portofolios`
--
ALTER TABLE `portofolios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
