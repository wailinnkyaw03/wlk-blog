-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Mar 23, 2023 at 05:02 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wlk-blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `friend_id` int(11) DEFAULT NULL,
  `friend_status` char(20) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `friend_status`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 'confirm', '2023-03-22 14:32:59', '2023-03-22 20:30:58'),
(2, 1, 2, 'confirm', '2023-03-23 14:26:34', '2023-03-22 21:17:25'),
(3, 1, 4, 'confirm', '2023-03-23 14:25:37', '2023-03-23 08:44:28'),
(4, 1, 5, 'pending', '2023-03-23 14:25:09', '2023-03-23 08:57:40'),
(6, 1, 8, 'pending', '2023-03-23 04:47:06', '2023-03-23 11:17:06'),
(7, 5, 4, 'confirm', '2023-03-23 08:32:18', '2023-03-23 11:24:15');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_status` char(20) COLLATE utf8mb4_unicode_ci DEFAULT 'public',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `post_img`, `description`, `post_status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Post One of Wai Linn Kyaw', 'blog641c0f64a783b1.jpg', '<p style=\"text-align: center; \"><b><u>Welcome to Green Land!</u></b></p><p>We are having fun in relaxing place.</p>', 'Public', 1, NULL, '2023-03-23 08:35:48', '2023-03-23 15:05:48'),
(3, 'POST Three', 'blog641c16a0a5c8bback641973225c3d411.jpg', '<p>WELCOME TO BEACH</p><p>I am yours and you are mine!!!!</p><p><a href=\"https://wlktech.github.io/\" target=\"_blank\">WLK-TECH</a><br></p>', 'Public', 7, NULL, '2023-03-23 09:06:40', '2023-03-23 15:36:40'),
(4, 'Post Four', 'blog641c17a37672fback641972c6a36e7225-2259285_wallpaper-planet-orange-pink-nebula-4k-2160-x.jpg', '<p style=\"text-align: center; \"><b><u>Hello Welcome to space!!!</u></b></p><p>We are having fun in space.</p>', 'Public', 2, NULL, '2023-03-23 09:10:59', '2023-03-23 15:40:59'),
(6, 'How to be a developer?', NULL, '<p style=\"text-align: center; \"><b><u>How to learn to be a developer</u></b></p><p>Learn HTML, CSS, JavaScript, JQuery, Bootstrap for Frontend</p><p>Learn PHP for Backend.&nbsp;</p><p>That\'s is entry developer.</p>', 'Friend', 1, NULL, '2023-03-23 09:45:34', '2023-03-23 16:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `roleName`, `value`) VALUES
(1, 'Admin', 1),
(2, 'User', 2),
(3, 'Super Admin', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '1.png',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` char(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `background` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'back-theme.jpg',
  `status` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Approve',
  `role_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `profile`, `phone`, `address`, `gender`, `position`, `background`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Wai Linn Kyaw', 'wailinnkyaw03@gmail.com', '$2y$10$54E0Pr0oa5NGTjgyCcH/lO1PLAQ4eQCQ3aMwRsD.NYyquEd34rJD.', 'user6417d7f493dd6Profile Picture.jpg', '09421023714', 'Yangon', 'Male', 'Web Developer (Founder of SOCIAL WORLD)', 'back-theme.jpg', 'Approve', 3, '2023-03-23 08:56:17', '2023-03-17 10:30:49'),
(2, 'Wai Linn Khant', 'wailinnkhant@gmail.com', '$2y$10$m8ssq5SWqCEU1ZoNVNpRVuZnETPu0ki05usb8PzeP1EAuI2TqVKsi', '1.png', '09123456789', 'Yangon', 'Male', 'Marketing Assistant', 'back-theme.jpg', 'Approve', 1, '2023-03-22 03:20:12', '2023-03-17 10:34:37'),
(4, 'Aung Aung', 'aung@gmail.com', '$2y$10$X.P8pN45hKf9xHovg2o0hOyMxXUUIC.ygZTGFx7t5iAW.boPBASfe', 'user6417d78493cf8p2.jpeg', '09123456789', 'Yangon', 'Male', 'Developer', 'back641971e322b201.jpg', 'Approve', 2, '2023-03-22 03:10:30', '2023-03-17 21:54:47'),
(5, 'Su Su', 'su@gmail.com', '$2y$10$safRsQ/QPMic65AnabhTHuNwhOCEqk7hM7LQY9.jCjrV4ImI.S9p6', '1.png', '09123456', 'Mandalay', 'Female', 'Student', 'back-theme.jpg', 'Approve', 2, '2023-03-21 19:44:19', '2023-03-20 09:17:24'),
(7, 'Eain Dra', 'eaindra@gmail.com', '$2y$10$lquY/8LZHSfBSn.JplChHu15HETedPfmObaQlyTolwSDxBgbG.Sqy', 'user6419729ed8b0ep1.jpg', '09421023714', 'Yangon', 'Female', 'Lawyer', 'back641973225c3d411.jpg', 'Approve', 1, '2023-03-22 03:12:42', '2023-03-21 15:31:26'),
(8, 'Aye Aye', 'aye@gmail.com', '$2y$10$U1Kt97jbt.dSTF.GXzEACeWwet3jBZJfw9tlqb8pb9LDpWOb.8Iy6', '1.png', '09123456', 'Mandalay', 'Female', 'Student', 'back-theme.jpg', 'Approve', 2, '2023-03-23 08:33:33', '2023-03-22 10:30:55'),
(9, 'Win Win', 'win@gmail.com', '$2y$10$4idqpIW/b0jqM62OkJZDIOGlwjA1OD4vhPfVfVwczBynwxjUvK2wG', '1.png', '09123456', 'Mandalay', 'Female', 'Student', 'back-theme.jpg', 'Approve', 2, '2023-03-23 08:33:37', '2023-03-22 10:34:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `friend_id` (`friend_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`friend_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
