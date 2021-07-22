-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2020 at 01:24 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reports_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `title`, `body`, `image`, `created_at`) VALUES
(1, 1, 'First title from website ', 'Lorem ipsum dolor sit amet consectetur adipiscing elit eleifend cursus congue proi', '', '2020-12-08 17:19:04'),
(2, 1, 'Second title', 'Lorem ipsum dolor sit amet consectetur, adipiscing elit dis sem fusce, phasellus posuere vestibulum consequat. Fermentum sociis class vestibulum pretium eget in eleifend quisque tellus, mollis congue facilisi sollicitudin pharetra mauris aliquam nisi, accumsan leo lobortis dapibus gravida magnis taciti mattis. Donec maecenas torquent primis metus vehicula habitant class montes ante nec iaculis malesuada, cubilia purus potenti ut elementum integer habitasse natoque nascetur justo curabitur, sapien mus hac turpis platea semper tempor viverra fusce mauris auctor. Vehicula pulvinar viverra curae nisl habitant justo vivamus nulla odio, augue.', '', '2020-12-08 17:21:29'),
(3, 2, 'Title by Saad ', 'Lorem ipsum dolor sit amet consectetur adipiscing elit vitae molestie porttitor purus, nascetur volutpat phasellus posuere etiam vestibulum porta habitasse suscipit conubia, nisl non sagittis in commodo mattis nibh metus facilisis congue. Et luctus ut sem orci mauris ornare montes maecenas egestas iaculis felis tristique, auctor nulla laoreet per quam molestie faucibus inceptos dignissim pellentesque torquent. Volutpat fusce facilisis penatibus sodales ultrices dapibus hendrerit lobortis donec lacinia, tempus porttitor est quis sem proin sed consequat ligula, luctus dui viverra at non porta vel class bibendum. Vulputate quisque per augue morbi nostra arcu in massa nullam class auctor volutpat, netus sollicitudin urna magnis id diam cras ligula ante tempor rhoncus. Molestie montes ultrices habitant blandit eu parturient conubia, interdum commodo ac sodales feugiat integer nostra cubilia, turpis libero malesuada augue nascetur vitae. Mauris accumsan augue blandit auctor hac platea laoreet aliquet pretium, rhoncus commodo ad quam elementum massa interdum lectus diam tristique, nascetur rutrum faucibus sapien condimentum proin vitae facilisis. Suspendisse vitae curae ultrices pellentesque penatibus hendrerit in, per netus mus dis justo pulvinar sodales ut, volutpat sem ante torquent rutrum porttitor.', '', '2020-12-09 09:50:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'ali@ali.com', 'Ali', '$2y$10$nB4IGdY9P8SML26.3B3PoOt7QP9gAEj4dJpXqhO4Z0BH6suGSK5/e', '2020-12-08 17:17:39'),
(2, 'saad@saad.com', 'Saad', '$2y$10$iE6qP5LVOkd7bT1/D9cyEOB.6jdnk69VCG/x.KE6LG1e28FH2RC5m', '2020-12-08 17:17:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
