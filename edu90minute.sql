-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2023 at 02:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu90minute`
--

-- --------------------------------------------------------

--
-- Table structure for table `code_confirm`
--

CREATE TABLE `code_confirm` (
  `username` varchar(255) NOT NULL,
  `code` varchar(6) NOT NULL,
  `md5` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `described` varchar(255) NOT NULL,
  `fileUpload` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `inputs` text NOT NULL,
  `outputs` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `state` smallint(6) NOT NULL DEFAULT 0,
  `topicId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `described`, `fileUpload`, `price`, `inputs`, `outputs`, `created_at`, `state`, `topicId`) VALUES
(1, 'HTML\r\n', 'Ngôn ngữ xây dựng trang web', '0', 0, '', '', '2023-10-10 03:06:38', 0, 1),
(2, 'CSS', 'Ngôn ngữ tạo kiểu cho trang web', '0', 0, '', '', '2023-10-10 03:06:38', 0, 1),
(3, 'JavaScript cơ bản', 'Ngôn ngữ lập trình trang web', './uploads/images/courses1698105336.jpg', 650000, '- Thành thạo HTML|CSS|JAVASCRIPT\r\n- OOP', '- Xây dựng được 1 website chuẩn PHP theo mô hình MVC', '2023-10-10 03:06:38', 1, 2),
(4, 'SQL', 'Ngôn ngữ truy cập cơ sở dữ liệu', '0', 0, '', '', '2023-10-10 03:06:38', 0, 4),
(5, 'Java', 'Một ngôn ngữ lập trình', '0', 0, '', '', '2023-10-10 03:06:38', 0, 3),
(6, 'PHP', 'Ngôn ngữ lập trình máy chủ Web', '0', 0, '', '', NULL, 0, 3),
(13, 'NodeJS', 'Học hay lắm', '0', 0, '', '', '2023-10-11 01:34:46', 0, 3),
(14, 'C# cơ bản', 'C# cơ bản cho người mới học lập trình', '0', 0, '', '', '2023-10-11 01:36:54', 0, 3),
(94, 'python', 'Học Lập trình python', './uploads/images/file_1697615960.png', 0, 'ABC', 'abc', '2023-10-18 07:59:20', 0, 1),
(122, 'HTML/CSS', 'aa', './uploads/images/courses1698290685.jpg', 0, 'a', 'a', '2023-10-26 03:24:31', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `described` text NOT NULL,
  `level` smallint(6) NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `described`, `level`, `courseId`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Session 2', 'làm quen với heading', 1, 2, '<h1><span style=\"background-color:#f1c40f\">Xử l&yacute; Session</span></h1>\r\n\r\n<form action=\"./?ctl=courses\" enctype=\"multipart/form-data\" method=\"post\" name=\"register\">\r\n<table cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\r\n	<tbody>\r\n		<tr>\r\n			<td>name</td>\r\n			<td><input name=\"name\" type=\"text\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>age</td>\r\n			<td><input name=\"age\" type=\"text\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>username</td>\r\n			<td><input required=\"required\" type=\"text\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>password</td>\r\n			<td><input required=\"required\" type=\"password\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td>academic year</td>\r\n			<td><input name=\"academicYear\" type=\"radio\" value=\"69\" />69&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<input checked=\"checked\" name=\"academicYear\" type=\"radio\" value=\"70\" />70&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input name=\"academicYear\" type=\"radio\" value=\"71\" />71&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><input name=\"Submit\" type=\"submit\" value=\"Submit\" /></p>\r\n</form>\r\n\r\n<p>&nbsp;</p>\r\n', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'user-access\r\n'),
(2, 'role-access'),
(3, 'course-access'),
(4, 'exercise-access'),
(5, 'lesson-access');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Quản trị viên'),
(2, 'Quản trị nội dung'),
(3, 'Khách hàng'),
(5, 'Quản trị hệ thống');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permission`
--

CREATE TABLE `role_has_permission` (
  `permissionId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_has_permission`
--

INSERT INTO `role_has_permission` (`permissionId`, `roleId`) VALUES
(4, 2),
(3, 2),
(5, 2),
(1, 5),
(2, 5),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HTML/CSS', 1, NULL, NULL),
(2, 'JavaScript', 1, NULL, NULL),
(3, 'BackEnd', 1, NULL, NULL),
(4, 'Data Analytics', 1, NULL, NULL),
(5, 'Web Building', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password_change_at` timestamp NULL DEFAULT NULL,
  `role` smallint(6) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `email_verified_at`, `password_change_at`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Quản trị viên', 'admin', '123456', 'quyhoa321@gmail.com', '2023-11-07 07:40:54', NULL, 1, NULL, NULL),
(3, 'Quản trị nội dung', 'qtnd', '123456', 'adb2k2@gmail.com', '2023-11-06 15:24:39', NULL, 2, NULL, NULL),
(4, 'Hoàng Văn Quỳnh', 'khach', '123456', 'quynhdzai102@gmail.com', '2023-11-06 15:31:28', NULL, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topic_id` (`topicId`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exercises` (`courseId`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permission`
--
ALTER TABLE `role_has_permission`
  ADD KEY `fk_permission` (`permissionId`),
  ADD KEY `pk_role` (`roleId`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_topic_id` FOREIGN KEY (`topicId`) REFERENCES `topics` (`id`);

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `fk_exercises` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`);

--
-- Constraints for table `role_has_permission`
--
ALTER TABLE `role_has_permission`
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `pk_role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
