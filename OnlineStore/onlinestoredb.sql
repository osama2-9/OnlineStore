-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 09:16 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinestoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `cname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `cname`) VALUES
(1, 'Phone'),
(2, 'Nike'),
(3, 'Gameing Box'),
(4, 'Laptop');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `Storename` varchar(20) NOT NULL,
  `TotalRating` int(11) NOT NULL,
  `NumberOfRating` int(11) NOT NULL,
  `StoreRating` int(11) NOT NULL,
  `Img` blob NOT NULL,
  `Store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `storename` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `addressi` varchar(25) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `storename`, `phone`, `addressi`, `category_id`, `img`) VALUES
(17, 'iphone14', 111, 'USA', 1, 'img/iphone.jpeg'),
(18, 'HPpav-15', 121, 'UEA', 4, 'img/laptop.jpg'),
(19, 'Shose', 970, 'gaza', 2, 'img/nikeS.jpg'),
(20, 'iphone 13', 121, 'UEA', 1, 'img/i13.jpeg'),
(21, 'MacBook m2', 111, 'USA', 4, 'img/images.jpeg'),
(22, 'Gigabyte AORUS', 111, 'USA', 3, 'img/gameingBox.jpeg'),
(23, 'GameingBox Lenovo', 121, 'USA', 3, 'img/gamingpcjpg.jpg'),
(24, 'iphone7 Plus', 111, 'USA', 1, 'img/iphone7.jpeg'),
(29, 'Msi Vector', 111, 'USA', 4, 'img/msi.jpeg'),
(31, 'T-shirt', 970, 'gaza', 2, 'img/tshirt.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `mail` varchar(50) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`mail`, `pass`) VALUES
('osama@gmail', 'osama67'),
('admin@gmail', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Store_id` (`Store_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`),
  ADD KEY `store_ibfk_1` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`Store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `store`
--
ALTER TABLE `store`
  ADD CONSTRAINT `store_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
