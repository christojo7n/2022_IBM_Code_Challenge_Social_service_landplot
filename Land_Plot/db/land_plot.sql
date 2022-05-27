-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2022 at 12:48 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `land_plot`
--

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `username`, `password`) VALUES
(1, 'genesis', '93c768d0152f72bc8d5e782c0b585acc35fb0442'),
(5, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `username`, `password`, `name`, `email`) VALUES
(1, 'cloud9', 'c67adbca4bd9f7e583f05f4c7edbcb733c7c9233', 'Cloud Strife', 'cloud@shinra.com'),
(2, 'seph32', '75bf2b008d91258f56fc0d3a938ca64b8a631533', 'Sephiroth', 'seph@shinra.com'),
(3, 'zack_ff7', '52d849001964af394040dc48b673f748e55e1af7', 'Zack Fair', 'zack@shinra.com'),
(4, 'denz', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'denzil', 'denzil123@123.com'),
(5, 'melroy', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'melroy', 'melroydenny@gmail.com'),
(6, 'christo', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'christo', 'chrsto@gmail.com'),
(7, 'paul', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'paul', 'paulkjoy.6862@gmail.com'),
(24, 'das', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'christo ', 'chris@gmail.com'),
(25, 'qwe', '123', 'jav', 'jav@gmail.com'),
(26, 'zxc', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'asd', 'zxc@gmail.com'),
(27, 'test', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'test', 'test@gmail.com'),
(28, 'chr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'chri', 'chri@gmail.com');

--
-- Triggers `member`
--
DELIMITER $$
CREATE TRIGGER `remove_member` AFTER DELETE ON `member` FOR EACH ROW DELETE FROM pending_book_requests WHERE member = OLD.username
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `plot_updated`
--

CREATE TABLE `plot_updated` (
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `req_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `plotno` int(11) NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plot_updated`
--

INSERT INTO `plot_updated` (`timestamp`, `req_id`, `fname`, `plotno`, `username`) VALUES
('2022-05-27 06:57:54', 2, 'paj', 98796, ''),
('2022-05-27 06:48:40', 3, 'mel', 12345678, ''),
('2022-05-27 07:12:37', 4, 'Paul', 3544, 'denz'),
('2022-05-27 10:06:38', 5, 'Paul', 57687, 'denz'),
('2022-05-27 10:08:58', 6, 'Paul', 9876, 'denz');

-- --------------------------------------------------------

--
-- Table structure for table `plot_upd_req`
--

CREATE TABLE `plot_upd_req` (
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `adhno` int(11) NOT NULL,
  `phno` int(11) NOT NULL,
  `plotno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `plot_updated`
--
ALTER TABLE `plot_updated`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `plot_upd_req`
--
ALTER TABLE `plot_upd_req`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `plot_upd_req`
--
ALTER TABLE `plot_upd_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
