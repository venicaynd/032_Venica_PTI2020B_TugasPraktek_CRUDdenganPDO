-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2022 at 08:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_data`
--

CREATE TABLE `student_data` (
  `id` int(10) NOT NULL,
  `u_card` varchar(12) NOT NULL,
  `u_f_name` text NOT NULL,
  `u_l_name` text NOT NULL,
  `u_father` text NOT NULL,
  `u_aadhar` varchar(12) NOT NULL,
  `u_birthday` text NOT NULL,
  `u_gender` varchar(6) NOT NULL,
  `u_email` text NOT NULL,
  `u_phone` varchar(12) NOT NULL,
  `u_state` varchar(12) NOT NULL,
  `u_dist` text NOT NULL,
  `u_village` text NOT NULL,
  `u_police` text NOT NULL,
  `u_pincode` text NOT NULL,
  `file` longblob NOT NULL,
  `u_mother` varchar(30) NOT NULL,
  `u_family` text NOT NULL,
  `staff_id` varchar(12) NOT NULL,
  `image` varchar(150) NOT NULL,
  `uploaded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_data`
--

INSERT INTO `student_data` (`id`, `u_card`, `u_f_name`, `u_l_name`, `u_father`, `u_aadhar`, `u_birthday`, `u_gender`, `u_email`, `u_phone`, `u_state`, `u_dist`, `u_village`, `u_police`, `u_pincode`, `file`, `u_mother`, `u_family`, `staff_id`, `image`, `uploaded`) VALUES
(128, '20050974000', 'Venica Nur Laila', 'Taviv', 'Nur Kamid', '987654321098', '2002-03-09', 'Female', 'venicanlt@gmail.com', '081234567890', 'Indonesia', 'Surabaya', 'Ketintang', '61112', '010/001', '', 'Supeni', '4', '000000001232', 'venica2.jpg', '2022-04-24 16:15:09'),
(131, '20050974032', 'Venica Yulia Nur', 'Dheanty', 'Nur Kamid', '123456789012', '2002-02-07', 'Female', 'venica.20032@mhs.unesa.ac.id', '082132398659', 'Indonesia', 'Gresik', 'Karangturi', '61118', '001/002', '', 'Supeni', '4', '000000001234', 'ICA.jpg', '2022-04-25 11:49:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(94, 'venica', '$2y$10$LDsqKRXe9aK2piyJ9eye0.irk1jngUKb0.sP9UAl43gnwfYcVOx6q', '2022-04-24 14:34:31'),
(96, 'ica', '$2y$10$FtsoYVtb3QIZPu5pF390weH4eJc8zY7BSX3dZhrzEPtDFCb/LUoJy', '2022-04-25 13:36:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_data`
--
ALTER TABLE `student_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_data`
--
ALTER TABLE `student_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
