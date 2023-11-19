-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 08:33 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `described` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileUpload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `inputs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `outputs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `interact` int(11) NOT NULL DEFAULT 0,
  `relate` float NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `state` smallint(6) NOT NULL DEFAULT 0,
  `topicId` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `described`, `fileUpload`, `price`, `inputs`, `outputs`, `interact`, `relate`, `tags`, `created_at`, `state`, `topicId`) VALUES
(1, 'HTML', 'Ngôn ngữ xây dựng trang web', './uploads/images/90468b6353a04463410c3466396dd2b2.jpg', 0, 'Không', '', 0, 1, 'html css javascript frontend ', '2023-10-10 03:06:38', 0, 'HTML/CSS'),
(2, 'CSS', 'Ngôn ngữ tạo kiểu cho trang web', './uploads/images/7fd6c909d30bf371c1de4a3a56f89dea.webp', 0, 'Không', '', 0, 2, 'html css javascript frontend ', '2023-10-10 03:06:38', 0, 'HTML/CSS'),
(3, 'JavaScript cơ bản', 'Ngôn ngữ lập trình trang web', './uploads/images/7f3729579680a3ba3940b1b2744f44e1.webp', 650000, '- Thành thạo HTML|CSS|JAVASCRIPT\r\n- OOP', '- Xây dựng được 1 website chuẩn PHP theo mô hình MVC', 0, 3, 'javascript frontend ', '2023-10-10 03:06:38', 1, 'JavaScript'),
(4, 'SQL', 'Ngôn ngữ truy cập cơ sở dữ liệu', './uploads/images/59342e6382ef64520fd3fb8704d98b2e.png', 0, 'Khong', '', 0, 4, 'backend sql ', '2023-10-10 03:06:38', 0, 'Data Analytics'),
(5, 'Java', 'Một ngôn ngữ lập trình', './uploads/images/10f2ba3848e1dc7e3e43d96e1c83fcc2.webp', 0, 'Khong', '', 0, 5, 'backend java ', '2023-10-10 03:06:38', 0, 'HTML/CSS'),
(6, 'PHP', 'Ngôn ngữ lập trình máy chủ Web', './uploads/images/04e64e175fbbfeb627ed41c662aae712.jpg', 0, 'Khong', '', 0, 6, 'backend php ', '2023-11-09 13:51:56', 0, 'BackEnd'),
(13, 'NodeJS', 'Học NodeJS cơ bản cho người mới bắt đầu', './uploads/images/99e211f68ab9d884fc321f7801854c59.png', 0, 'Khong', '', 0, 3.5, 'frontend backend ', '2023-10-11 01:34:46', 0, 'Web Building'),
(14, 'C# cơ bản', 'C# cơ bản cho người mới học lập trình', './uploads/images/0318e96e80430270c99950a118b281a3.webp', 0, 'Khong', '', 0, 53.5, 'backend ', '2023-10-11 01:36:54', 0, 'BackEnd'),
(94, 'python', 'Học Lập trình python', './uploads/images/7ef772ed4c7bc1cc166e3c987f46226d.webp', 0, 'ABC', 'abc', 0, 94, 'html frontend ', '2023-10-18 07:59:20', 0, 'HTML/CSS'),
(123, 'HTML nâng cao', 'HTML nâng cao', './uploads/images/54659ca51b492c7c42dff0efcbd8cd32.jpg', 450000, 'Nắm chắc kiến thức HTML cơ bản', 'null', 0, 1.5, 'html frontend ', '2023-11-12 05:45:57', 0, 'HTML/CSS'),
(134, 'HTML5', 'HTML5.1', './uploads/images/a71a7cc39bb0d69ea7c293beac6ed591.jpg', 200000, 'HTML5', '', 0, 1.375, 'html frontend ', '2023-11-17 16:15:50', 0, 'HTML/CSS');

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `described` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` smallint(6) NOT NULL,
  `courseId` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fileUpload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relate` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `described`, `level`, `courseId`, `fileUpload`, `relate`, `created_at`) VALUES
(2, 'Giới thiệu khóa học', 'CSS', 1, 'HTML', './uploads/files/exercises/7e1d1073985b37a518ad3ae68f99848e.pdf', 8, '2023-11-18 12:37:45'),
(10, 'Heading', '', 1, 'HTML', './uploads/files/exercises/db6f14f0ca63b406e1e7a0d8c226ca4f.pdf', 11, '2023-11-18 12:37:45'),
(14, 'Forms', '', 1, 'HTML', '', 11, '2023-11-18 12:37:45'),
(15, 'Giới thiệu bài tập', '', 1, 'PHP', '', 15, '2023-11-18 12:37:45'),
(16, 'Validate', '', 1, 'PHP', '', 16, '2023-11-18 12:37:45'),
(17, 'Authentications', '', 3, 'PHP', '', 17, '2023-11-18 12:37:45'),
(18, 'Authorizations', '', 1, 'PHP', '', 18, '2023-11-18 12:37:45'),
(19, 'Array - String', '', 1, 'C# cơ bản', './uploads/files/exercises/f774d8a06cc7aea5957922ebbe9ab1b1.pdf', 20, '2023-11-18 12:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `described` text COLLATE utf8_unicode_ci NOT NULL,
  `fileUpload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courseId` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `relate` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `described`, `fileUpload`, `courseId`, `relate`, `created_at`) VALUES
(8, 'Giới thiệu khóa học', '', './uploads/files/lessons/af24808f146e72eff5a953bb25bfe94e.mp4', 'HTML', 8, '2023-11-18 16:08:28'),
(9, 'Cấu trúc file HTML', '', './uploads/files/lessons/021dbdb55595e7bd6fcd5296488fa8d2.pdf', 'HTML', 8.25, '2023-11-18 18:29:11'),
(10, 'Các thẻ HTML thông dụng', '', './uploads/files/lessons/33962ccbc979f0108ad5f9c553eab299.pdf', 'HTML', 9.1875, '2023-11-18 18:29:43'),
(11, 'Comments trong HTML', '', './uploads/files/lessons/7ea07ba09e6be2b5e3db5583625553b9.pdf', 'HTML', 8.375, '2023-11-18 18:34:26'),
(12, 'Attribute trong HTML', '', './uploads/files/lessons/249a239efc545aaf71a37ce095781717.pdf', 'HTML', 11, '2023-11-18 18:53:39'),
(13, 'Cách quản lý thư mục dự án', '', './uploads/files/lessons/67f5ce7a67e911af98511d8b21e0c1e0.pdf', 'HTML', 13, '2023-11-18 18:54:34');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
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
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'html'),
(2, 'css'),
(3, 'javascript'),
(4, 'frontend'),
(5, 'backend'),
(6, 'sql'),
(7, 'php'),
(8, 'java');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
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
-- Constraints for table `role_has_permission`
--
ALTER TABLE `role_has_permission`
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `pk_role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
