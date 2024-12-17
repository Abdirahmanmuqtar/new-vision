-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 09:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `best`
--

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `location` varchar(255) NOT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `teeth` varchar(50) DEFAULT NULL,
  `LastVisit` date DEFAULT NULL,
  `PreviousProcedures` text DEFAULT NULL,
  `costPaid` decimal(10,2) NOT NULL DEFAULT 0.00,
  `status` varchar(50) DEFAULT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `age`, `location`, `Phone`, `teeth`, `LastVisit`, `PreviousProcedures`, `costPaid`, `status`, `picture`) VALUES
(12, 'Mohamed Hussein Hassan- BASHIIR', 22, 'zcxcx', NULL, NULL, NULL, NULL, 0.00, NULL, 'C:\\fakepath\\dc2ec5a571974417a5551420a4fb0587.webp'),
(13, 'Ibrahim Siid Barakow', 22, 'sook', NULL, NULL, NULL, NULL, 0.00, NULL, 'images/photo.jpg'),
(14, 'sundus cali', 15, 'galkacyo', NULL, NULL, NULL, NULL, 0.00, NULL, 'images/gettyimages-1437816897-612x612.jpg'),
(16, 'cabdiraxman muqtar', 21, '0', '616549237', NULL, NULL, NULL, 0.00, NULL, 'images/photo.jpg'),
(17, 'muniiro', 12, 'jamu', '615003310', NULL, NULL, NULL, 0.00, NULL, 'images/gettyimages-1437816897-612x612.jpg'),
(19, 'Ibrahim Siid Barakow', 21, '0', '617008588', NULL, NULL, NULL, 0.00, NULL, 'images/gettyimages-1437816897-612x612.jpg'),
(20, 'Cabdi Muncim Xassan Geele', 22, 'dfsdf', '615003310', NULL, NULL, NULL, 0.00, NULL, 'images/dc2ec5a571974417a5551420a4fb0587.webp'),
(21, 'Cabdi Muncim Xassan Geele', 33, 'mog', '617008577', NULL, NULL, NULL, 0.00, NULL, 'images/dc2ec5a571974417a5551420a4fb0587.webp'),
(22, 'Ali Ahmed Mohamed- SAYID CALI', 2, '0', '617008577', 'Up', '2024-11-06', 'yoooo', 0.00, 'Pending', 'images/photo-1494790108377-be9c29b29330.jpeg'),
(23, 'Ali Ahmed Mohamed- SAYID CALI', 55, 'mog', '617008577', NULL, NULL, NULL, 0.00, NULL, 'images/gettyimages-1437816897-612x612.jpg'),
(24, 'Cabdiraxmaan Muqtar Nor', 22, 'Mogadishu ', '616549235', NULL, NULL, NULL, 0.00, NULL, 'images/dc2ec5a571974417a5551420a4fb0587.webp'),
(25, 'AWEYS BARAAWIINI', 26, 'BOONDHEER', '617008577', NULL, NULL, NULL, 0.00, NULL, 'images/oMNPpACzTtO5OVERUZwh3Q.webp'),
(26, 'cabdiraxman aynte', 22, '0', '617008577', 'Up', '2024-11-15', 'yoooo', 0.00, 'Completed', 'images/dc2ec5a571974417a5551420a4fb0587.webp'),
(27, 'Ali Ahmed Mohamed- SAYID CALI', 55, 'mogadishu ', '617008583', NULL, NULL, NULL, 0.00, NULL, 'images/img20240507_18244971.jpg'),
(28, 'Ali Ahmed Mohamed- SAYID CALI', 33, 'somalia', '617008583', NULL, NULL, NULL, 0.00, NULL, 'images/gettyimages-1437816897-612x612.jpg'),
(29, 'Ibrahim Siid Barakow', 55, 'somalia', '617008577', NULL, NULL, NULL, 0.00, NULL, 'images/photo.jpg'),
(30, 'Cabdi Muncim Xassan Geele', 22, 'som', '617008583', NULL, NULL, NULL, 0.00, NULL, 'images/oMNPpACzTtO5OVERUZwh3Q.webp'),
(31, 'Ali Ahmed Mohamed- SAYID CALI', 21, '0', '617008577', 'Up', '2024-11-14', 'yoooo', 0.00, 'Pending', 'images/photo.jpg'),
(32, 'Cabdi Muncim Xassan Geele', 22, '0', '617008577', 'Both', '2024-11-04', 'ghgh', 0.00, 'Completed', 'images/photo.jpg'),
(33, 'Caasho cuud calo', 14, '0', '617008588', 'Down', '2024-11-12', 'ghgh', 0.00, 'Completed', 'images/oMNPpACzTtO5OVERUZwh3Q.webp'),
(35, 'yoo', 23, '0', '6534534534', 'Up', '2024-11-19', 'trtrrtretgtg', 0.00, 'Pending', 'fgg'),
(36, 'Cairaxmaan Muqtar Nor', 23, '0', '615503399', 'Both', '2024-11-18', 'hat way please code', 0.00, 'Completed', 'images/Messenger_creation_7128497132725674833.jpeg'),
(37, 'xaliima xuseen seymey', 12, '0', '7773643474', 'Down', '2024-11-03', 'waa sidaa bro', 0.00, 'Pending', 'images/gettyimages-1437816897-612x612.jpg'),
(38, 'Ibrahim Siid Barakow', 32, 'yooo', '617008585', 'Both', '2024-11-06', 'maqan', 0.00, 'Completed', 'images/Messenger_creation_7128497132725674833.jpeg'),
(39, 'abdirahman aynte abdi', 21, 'mogadishu ', '6149090999', 'Up', '2024-11-06', 'joogo', 0.00, 'Completed', 'images/dc2ec5a571974417a5551420a4fb0587.webp'),
(40, 'najmo  muqtar nor', 19, 'somalia ', '61767788', 'Up', '2024-11-10', 'waxaan jecleystey ina iska xiro', 100.00, 'Completed', 'images/photo-1494790108377-be9c29b29330.jpeg'),
(41, 'Ali Ahmed Mohamed- SAYID CALI', 66, 'mogadishu ', '617008583', 'Up', '2024-11-10', 'yoooo', 777.00, 'Completed', 'images/oMNPpACzTtO5OVERUZwh3Q.webp');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$xPeRdAl6cVlcMaOj1vwrx.9ObjsVQGhtUSFTC2UDXeZF58t5H4GVK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
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
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
