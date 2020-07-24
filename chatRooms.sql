-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2020 at 09:23 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatRooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `roomId` int(11) NOT NULL,
  `body` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `sentAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `username`, `roomId`, `body`, `sentAt`) VALUES
(1, 'Mohamed Ali', 1, 'Hello Every One', '2020-04-14 15:48:11'),
(2, 'Rewan Ali', 1, 'Hello Mohamed', '2020-04-14 15:48:11'),
(3, 'Mohamed Ali', 1, 'How Are You Rewan', '2020-04-14 16:15:34'),
(4, 'Rewan Ali', 1, 'I am Fine Mohamed Thanks', '2020-04-14 16:15:34'),
(5, 'Mohamed Ali', 1, 'Okay', '2020-04-14 16:26:45'),
(6, 'Rewan Ali', 1, 'All Right Man!', '2020-04-14 18:06:23'),
(7, 'Mohamed Ali', 1, 'It''s Working Now :)', '2020-04-14 18:56:13'),
(8, 'Rewan Ali', 1, 'Yah Good Job Man :)', '2020-04-14 18:58:38'),
(9, 'Rewan Ali', 1, 'ðŸ‘', '2020-04-14 19:03:44'),
(10, 'Mohamed Ali', 1, 'Every Thing Now Works WellðŸ˜‚ðŸ˜ƒðŸ˜„ðŸ˜†ðŸ¤£', '2020-04-14 19:08:00'),
(11, 'Mohamed Ali', 1, 'ðŸ¥°', '2020-04-14 19:33:22'),
(12, '', 1, 'Mohamed Ali Left The Group', '2020-04-14 19:47:42'),
(13, 'Mohamed Ali', 1, 'I Came Back Now ðŸ˜‚ðŸ˜‚ðŸ˜‚ðŸ˜‚', '2020-04-14 20:05:27'),
(14, 'Mohamed Ali', 1, 'App Now Is Ready For Any One To Use (Selecting Room Or Send Messages Or Leaving) Every Thing Is Okay', '2020-04-14 20:06:11'),
(15, 'Mohamed Ali', 1, 'ØªÙ…Ø§Ù… Ø¨Ø§Ù„Ø¹Ø±Ø¨ÙŠ ðŸ˜‚ðŸ˜‚', '2020-04-14 20:09:06'),
(16, 'Mohamed Ali', 1, 'Hello Man :)', '2020-04-14 20:26:17'),
(17, '', 1, 'Rewan Ali Left The Group', '2020-04-14 20:29:09'),
(18, 'Rewan Ali', 1, 'I am Back :)', '2020-04-14 20:30:39'),
(19, '', 1, 'Rewan Ali Left The Group', '2020-04-14 20:37:48'),
(20, '', 1, 'Mohamed Ali Left The Group', '2020-04-14 20:42:53'),
(21, 'Rewan Ali', 1, 'Hello Mohamed ðŸ¥°', '2020-04-14 21:16:44'),
(22, 'Mohamed Ali', 1, 'Hello Rewan ðŸ¥°', '2020-04-14 21:16:54'),
(23, '', 1, 'Rewan Ali Left The Group', '2020-04-14 21:18:52'),
(24, '', 1, 'Mohamed Ali Left The Group', '2020-04-14 21:18:56'),
(25, 'Ahmed Tawfik', 2, 'I am Ahmed Tawfik Hello ', '2020-04-14 21:19:43'),
(26, 'Mohamed Ali', 2, 'Hello Ahmed ', '2020-04-14 21:20:08'),
(27, 'Mohamed Ali', 2, 'Ø§Ù†Øª Ø¯Ø­ÙŠØ­ ÙŠØ§ÙƒØ¨ÙŠØ±', '2020-04-14 21:20:15'),
(28, 'Ahmed Tawfik', 2, 'Ø§Ù†Ø§ ØŸ!', '2020-04-14 21:20:22'),
(29, 'Mohamed Ali', 2, 'Ø§Ù‡Ø§Ø§ Ø§Ù†Øª Ø¯Ø­ÙŠØ­', '2020-04-14 21:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `members` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(6) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `members`, `type`) VALUES
(1, 'test', '', 'due'),
(2, 'myClass', 'Ahmed Tawfik,Mohamed Ali', 'group');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomId_2` (`roomId`),
  ADD KEY `roomId_3` (`roomId`),
  ADD KEY `roomId_4` (`roomId`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
