-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2018 at 12:53 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `widget_corp`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `menu_name` varchar(30) DEFAULT NULL,
  `position` int(3) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `menu_name`, `position`, `visible`, `content`) VALUES
(2, 1, 'Our Mission', 2, 1, 'I can. I will. I must. Great!!!!!'),
(3, 2, 'Widget 20000', 1, 0, 'The Widget 20000 is a product'),
(4, 1, ' i must value my belief!', 1, 1, 'Did it!'),
(5, 1, 'ok', 1, 1, 'YESS'),
(6, 3, 'Finally!', 1, 1, 'Thanks!');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `menu_name`, `position`, `visible`) VALUES
(1, 'About Widget Corp', 1, 0),
(2, 'Products', 2, 1),
(3, 'Services', 3, 1),
(4, 'Chicken Chicken', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `hashed_password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `hashed_password`) VALUES
(1, 'a', '0cc175b9c0f1b6a831c399e269772661'),
(2, 'a', '123213213213213131321'),
(3, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(4, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(5, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(6, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(7, 'adnan3', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(8, 'adnan3', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(9, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(10, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(11, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(12, 'adnan', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(13, 'adnan343', '28cfb479fbfa87b18bb75903413bd4cf0556f6b8'),
(14, 'aa', 'e0c9035898dd52fc65c41454cec9c4d2611bfb37'),
(15, 'ad', '4aeb195cd69ed93520b9b4129636264e0cdc0153'),
(16, 'as', 'df211ccdd94a63e0bcb9e6ae427a249484a49d60'),
(17, 'sasa', '7bf1ab1b8f7331ab5dc410e01f959d958bfd210e'),
(18, 'sasaa', '0f3f9e35cd5fa9795f1c02f6979c7ef6834360bd'),
(19, 'sasaaa', '42f73bab35fbbed576f3d47ab529de272536187d');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
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
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
