-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2022 at 04:12 AM
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
-- Database: `bfp`
--

-- --------------------------------------------------------

--
-- Table structure for table `anno`
--

CREATE TABLE `anno` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anno`
--

INSERT INTO `anno` (`id`, `image`, `title`, `detail`, `date`) VALUES
(5, 'AGFX2605.jpg', 'aaaadsde', 'aaaaaaa', '2022-11-05 19:55:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `em_code` char(12) NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `gender` varchar(150) NOT NULL,
  `contact` char(12) NOT NULL,
  `date_birth` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(255) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `em_code`, `department`, `role`, `gender`, `contact`, `date_birth`, `address`, `username`, `email`, `password`, `image`) VALUES
(1, 'Anjie Mauhay', '1234', 'Sales and Marketing', 'ADMIN', 'MALE', '0764221', '2021-02-04', 'Sampaguita', 'anjie03', 'anjie@gmail.com', '12345', 'AGFX2605.jpg'),
(2, 'Gelo Mauhay', '1223', 'Administration', 'EMPLOYEE', 'MALE', '099287167352', '2022-09-14', 'ashhjahj', 'asadad', 'adad@gmail.com', '1234', 'DZXB1952.jpg'),
(3, 'Joshua Lorez', '9875', 'Network Engineering', 'ADMIN', 'MALE', '096514434267', '2022-09-21', 'Calamias', 'josh0121', 'josh@gmail.com', '12345', 'IKIK6541.jpg'),
(34, 'gelo mauhay', '1212', '2', 'ADMIN', 'MALE', '089776766565', '2022-09-15', 'hgh', 'gg', 'ggg@gamil.com', '1111', 'AGFX2605.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `contact` varchar(12) NOT NULL,
  `birth` date NOT NULL DEFAULT current_timestamp(),
  `address` varchar(250) NOT NULL,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `status`, `gender`, `contact`, `birth`, `address`, `username`, `email`, `password`, `image`) VALUES
(2, 'anjie', 'Active', 'MALE', '077777777777', '2022-09-08', '7777', 'anjiemau03', 'ajajja@gmail.com', '12345', 'profile_vrt_raw_bytes_1587515400_10885.png'),
(4, '1111111111', 'Active', 'MALE', '111111111111', '2022-10-06', 'aaa', 'aaaa', 'aaaa@g.nj', 'aaa', 'profile_vrt_raw_bytes_1587515400_10885.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anno`
--
ALTER TABLE `anno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anno`
--
ALTER TABLE `anno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
