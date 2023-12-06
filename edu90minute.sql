-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 06:54 PM
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
  `topicId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`, `described`, `fileUpload`, `price`, `inputs`, `outputs`, `interact`, `relate`, `tags`, `created_at`, `state`, `topicId`) VALUES
(1, 'HTML', 'Ngôn ngữ xây dựng trang web', './uploads/images/90468b6353a04463410c3466396dd2b2.jpg', 0, 'Không', '', 14943, 3.58399, 'html frontend ', '2023-10-10 03:06:38', 1, 1),
(2, 'CSS', 'Ngôn ngữ tạo kiểu cho trang web', './uploads/images/7fd6c909d30bf371c1de4a3a56f89dea.webp', 0, 'Không', '', 4917, 4.9375, 'css frontend ', '2023-10-10 03:06:38', 1, 1),
(3, 'JavaScript', 'Ngôn ngữ lập trình trang web', './uploads/images/7f3729579680a3ba3940b1b2744f44e1.webp', 0, '- Thành thạo HTML|CSS|JAVASCRIPT\r\n- OOP', '- Xây dựng được 1 website chuẩn PHP theo mô hình MVC', 742, 5.21875, 'javascript frontend ', '2023-10-10 03:06:38', 1, 1),
(4, 'SQL', 'Ngôn ngữ truy cập cơ sở dữ liệu', './uploads/images/59342e6382ef64520fd3fb8704d98b2e.png', 0, 'Khong', '', 1746, 50.25, 'backend sql ', '2023-10-10 03:06:38', 1, 1),
(5, 'Java', 'Một ngôn ngữ lập trình', './uploads/images/10f2ba3848e1dc7e3e43d96e1c83fcc2.webp', 0, 'Khong', '', 997, 5.375, 'backend java ', '2023-10-10 03:06:38', 1, 1),
(6, 'PHP', 'Ngôn ngữ lập trình máy chủ Web', './uploads/images/04e64e175fbbfeb627ed41c662aae712.jpg', 0, 'Khong', '', 5744, 5.4375, 'backend php ', '2023-11-09 13:51:56', 1, 1),
(94, 'Python', 'Học Lập trình python', './uploads/images/7ef772ed4c7bc1cc166e3c987f46226d.webp', 0, 'ABC', 'abc', 8725, 95, 'backend ', '2023-10-18 07:59:20', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `exercises`
--

CREATE TABLE `exercises` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `described` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` smallint(6) NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `fileUpload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relate` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exercises`
--

INSERT INTO `exercises` (`id`, `name`, `described`, `level`, `courseId`, `fileUpload`, `relate`, `created_at`) VALUES
(2, 'Giới thiệu khóa học', 'CSS', 1, 1, './uploads/files/exercises/7e1d1073985b37a518ad3ae68f99848e.pdf', 8, '2023-11-18 12:37:45'),
(10, 'Heading', '', 1, 1, './uploads/files/exercises/db6f14f0ca63b406e1e7a0d8c226ca4f.pdf', 11, '2023-11-18 12:37:45'),
(14, 'Forms', '', 1, 1, '', 11, '2023-11-18 12:37:45'),
(15, 'Giới thiệu bài tập', '', 1, 6, '', 15, '2023-11-18 12:37:45'),
(16, 'Validate', '', 1, 6, '', 16, '2023-11-18 12:37:45'),
(17, 'Authentications', '', 3, 6, '', 17, '2023-11-18 12:37:45'),
(18, 'Authorizations', '', 1, 6, '', 18, '2023-11-18 12:37:45'),
(32, 'Giới thiệu bài tập', '', 1, 2, './uploads/files/exercises/a576632a5773b303997ba8a79dfcf37d.pdf', 19, '2023-11-28 17:02:08'),
(33, 'Giới thiệu bài tập', '', 1, 3, './uploads/files/exercises/01fff53cc008c0d452c91f897a9496a8.pdf', 33, '2023-11-28 17:07:39'),
(34, 'Giới thiệu bài tập', '', 1, 5, './uploads/files/exercises/c22392e4f2fc37c42bca4aab64112b23.pdf', 34, '2023-11-28 17:08:06'),
(35, 'Giới thiệu bài tập', '', 1, 4, './uploads/files/exercises/0745a7f156aacdd1f50749897c78a92c.pdf', 35, '2023-11-28 17:08:26'),
(36, 'Giới thiệu bài tập', '', 1, 94, './uploads/files/exercises/1a4a8870af5187eb3a51a58d1177c87d.pdf', 36, '2023-11-28 17:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `described` text COLLATE utf8_unicode_ci NOT NULL,
  `fileUpload` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `courseId` int(10) UNSIGNED NOT NULL,
  `relate` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `name`, `described`, `fileUpload`, `courseId`, `relate`, `created_at`) VALUES
(8, 'Giới thiệu khóa học', '', './uploads/files/lessons/ae4ab039c73194726c3f6b7517abfcd6.pdf', 1, 8.125, '2023-11-18 16:08:28'),
(9, 'Cấu trúc file HTML', '', './uploads/files/lessons/021dbdb55595e7bd6fcd5296488fa8d2.pdf', 1, 8.25, '2023-11-18 18:29:11'),
(10, 'Các thẻ HTML thông dụng', '', './uploads/files/lessons/33962ccbc979f0108ad5f9c553eab299.pdf', 1, 9.1875, '2023-11-18 18:29:43'),
(11, 'Comments trong HTML', '', './uploads/files/lessons/7ea07ba09e6be2b5e3db5583625553b9.pdf', 1, 8.375, '2023-11-18 18:34:26'),
(12, 'Attribute trong HTML', '', './uploads/files/lessons/249a239efc545aaf71a37ce095781717.pdf', 1, 11, '2023-11-18 18:53:39'),
(13, 'Cách quản lý thư mục dự án', '', './uploads/files/lessons/67f5ce7a67e911af98511d8b21e0c1e0.pdf', 1, 13, '2023-11-18 18:54:34'),
(14, 'Sử dụng CSS trong HTML', '', './uploads/files/lessons/4ddf3b7b9132bd23e82b59760db9708b.pdf', 2, 14, '2023-11-19 14:16:37'),
(15, 'ID và Class', '', './uploads/files/lessons/44d8217e02db6250b6148cbd1e26c877.pdf', 2, 15, '2023-11-19 14:17:52'),
(16, 'CSS selectors cơ bản', '', './uploads/files/lessons/fe031cf99c5daa92e676b3de85d02202.pdf', 2, 16, '2023-11-19 14:18:26'),
(17, 'Độ ưu tiên trong CSS', '', './uploads/files/lessons/0ca4c6193e5c3376c7f35f3074722722.pdf', 2, 17, '2023-11-19 14:18:55'),
(18, 'Biến trong CSS', '', './uploads/files/lessons/7daa9cd069bd4570da5161db0df71615.pdf', 2, 18, '2023-11-19 14:19:39'),
(19, 'Các đơn vị trong CSS', '', './uploads/files/lessons/fff302fb3fdc1b85bb4307f3b9056f67.pdf', 2, 19, '2023-11-20 12:43:45'),
(20, 'Một số hàm trong CSS', '', './uploads/files/lessons/149ae54337c55ba5a4a00cca51b00c1c.pdf', 2, 20, '2023-11-20 12:44:08'),
(21, 'Pseudo elements trong CSS', '', './uploads/files/lessons/269374db197e861c1a0fff2774377bbc.pdf', 2, 21, '2023-11-20 12:44:44'),
(22, 'Padding CSS', '', './uploads/files/lessons/1d5b567804edca33f2ff037f0e8d3efa.pdf', 2, 22.5, '2023-11-20 12:45:36'),
(23, 'Border CSS', '', './uploads/files/lessons/0156ea583ba8fae78cd1911d21c7e904.pdf', 2, 23, '2023-11-20 12:45:58'),
(26, 'Giới thiệu khóa học', '', './uploads/files/lessons/2e3769fee2ff4e6674fc12b297c3b172.pdf', 6, 24, '2023-11-28 07:27:32'),
(27, 'Hàm và các thao tác với file', '', './uploads/files/lessons/a085cb2b450025bfb5a9e9a224f9be21.pdf', 6, 27, '2023-11-28 07:29:10'),
(28, 'PHP cơ bản', '', './uploads/files/lessons/6a8b2f48c40ea4de7a7c4fc6fe51324b.pdf', 6, 28, '2023-11-28 07:29:36'),
(29, 'OOP', '', './uploads/files/lessons/c440f4503086824613805d076de459c2.pdf', 6, 29, '2023-11-28 07:30:25'),
(30, 'Form PHP', '', './uploads/files/lessons/d8ddbd975508ea0cb4286ea4c1f9469d.pdf', 6, 30, '2023-11-28 07:31:01'),
(31, 'Cookie và Session', '', './uploads/files/lessons/0fef11a611de4fac90344b4b1c0acdf7.pdf', 6, 31, '2023-11-28 07:32:13'),
(32, 'Connect Database', '', './uploads/files/lessons/bc7ae03d6a8cba0bad2fa1b35aacd857.pdf', 6, 32, '2023-11-28 07:32:47'),
(33, 'Giới thiệu khóa học', '', './uploads/files/lessons/fe061c3829128554a6be77149c6496a0.pdf', 94, 33.5, '2023-11-28 13:58:53'),
(34, 'Giới thiệu khóa học', '', './uploads/files/lessons/6982dd3ef0028cad660ee5dfc94a8c7d.pdf', 3, 34, '2023-11-28 17:05:39'),
(35, 'Giới thiệu khóa học', '', './uploads/files/lessons/f5e73076b1ce4fe7da54f484fa03bcef.pdf', 5, 35, '2023-11-28 17:06:04'),
(36, 'Giới thiệu khóa học', '', './uploads/files/lessons/3d0f99bbb162f3d8b223c4ab684b98c5.pdf', 4, 36, '2023-11-28 17:06:30');

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
(5, 'lesson-access'),
(6, 'user-create'),
(7, 'user-update'),
(8, 'user-delete'),
(9, 'lesson-create'),
(10, 'lesson-update'),
(11, 'lesson-delete'),
(12, 'exercise-create'),
(13, 'exercise-update'),
(14, 'exercise-delete'),
(15, 'course-create'),
(16, 'course-update'),
(17, 'course-delete'),
(18, 'role-create'),
(19, 'role-update'),
(20, 'role-delete');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) NOT NULL,
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
(3, 2),
(15, 2),
(17, 2),
(16, 2),
(4, 2),
(12, 2),
(14, 2),
(13, 2),
(5, 2),
(9, 2),
(11, 2),
(10, 2),
(2, 5),
(18, 5),
(20, 5),
(19, 5),
(1, 5),
(6, 5),
(8, 5),
(7, 5),
(3, 1),
(15, 1),
(17, 1),
(16, 1),
(4, 1),
(12, 1),
(14, 1),
(13, 1),
(5, 1),
(9, 1),
(11, 1),
(10, 1),
(2, 1),
(18, 1),
(20, 1),
(19, 1),
(1, 1),
(6, 1),
(8, 1),
(7, 1);

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
(1, 'Front End', 1, NULL, NULL),
(3, 'Back End', 1, NULL, NULL),
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
  `role` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `email_verified_at`, `password_change_at`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Nguyễn Xuân Quý', 'admin', '123456', 'quyhoa321@gmail.com', '2023-11-07 07:40:54', NULL, 1, NULL, NULL),
(3, 'Quản trị nội dung', 'qtnd', '123456', 'adb2k2@gmail.com', '2023-11-06 15:24:39', NULL, 2, NULL, NULL),
(4, 'Hoàng Văn Quỳnh', 'khach', '123456', 'quynhdzai102@gmail.com', '2023-11-06 15:31:28', NULL, 3, NULL, NULL),
(11, 'Nguyen Thanh Quang', 'thanhquangdeptrai', '12345678', 'quangteo18062002@gmail.com', '2023-11-22 00:58:25', NULL, 5, NULL, NULL),
(12, 'Nguyễn Tiến Ngọc', '705105001', '123456', 'us01@gmail.com', '2023-11-28 07:13:16', NULL, 3, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_topics` (`topicId`);

--
-- Indexes for table `exercises`
--
ALTER TABLE `exercises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_exercises` (`courseId`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_courses` (`courseId`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk-role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `exercises`
--
ALTER TABLE `exercises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_topics` FOREIGN KEY (`topicId`) REFERENCES `topics` (`id`);

--
-- Constraints for table `exercises`
--
ALTER TABLE `exercises`
  ADD CONSTRAINT `fk_exercises` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`);

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `fk_courses` FOREIGN KEY (`courseId`) REFERENCES `courses` (`id`);

--
-- Constraints for table `role_has_permission`
--
ALTER TABLE `role_has_permission`
  ADD CONSTRAINT `fk_permission` FOREIGN KEY (`permissionId`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `pk_role` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk-role` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
