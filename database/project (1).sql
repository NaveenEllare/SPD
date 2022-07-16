-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2021 at 04:04 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `client_id` int(15) NOT NULL,
  `product_id` int(15) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `categories` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories`, `status`) VALUES
(1, 'Homeopathic', 1),
(2, 'Allopathic', 1),
(3, 'cosmatics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `comment` text NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `o_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `address` varchar(11) NOT NULL,
  `total` float NOT NULL,
  `order_status` varchar(20) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`o_id`, `client_id`, `address`, `total`, `order_status`, `added_on`) VALUES
(1, 4, 'jgcfhgdjgcg', 9251.65, 'Success', '2021-10-20 18:43:10'),
(2, 4, 'jgcfhgdjgcg', 6201.75, 'Cancelled', '2021-10-20 19:31:48');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `od_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`od_id`, `client_id`, `order_id`, `prod_id`, `prod_name`, `qty`, `price`) VALUES
(1, 4, 1, 1116, 'Moov Ointment', 2, 2450),
(2, 4, 1, 1114, 'CROCIN 650', 3, 1450.55),
(3, 4, 2, 1111, 'Beer Shampoo', 5, 1240.35);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_desc` varchar(2000) NOT NULL,
  `batch_id` varchar(11) NOT NULL,
  `m_date` date NOT NULL,
  `e_date` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `batch_id`, `m_date`, `e_date`, `status`) VALUES
(1111, 3, 'Beer Shampoo', 1400.2, 1240.35, 45, '969158718_beer.png', 'Groom your hair with Park Avenue Beer Shampoo (180 ml ).', 'C#544425', '2020-01-01', '2024-01-13', 1),
(1114, 2, 'CROCIN 650', 2550, 1450.55, 97, '805372976_crocin.png', 'Muscle ache (like generalized body pain, back pain, neck pain etc.)', 'C#544445', '2020-01-01', '2025-10-23', 1),
(1116, 1, 'Moov Ointment', 2725, 2450, 23, '462896267_moov.png', 'A 100% Ayurvedic preparation for quick pain relief (25 g).', 'A#544465', '2020-01-01', '2024-01-01', 1),
(1117, 2, 'Tincher-M Ointment', 1200, 1050, 50, '619923801_tincher.png', 'Treatment of Bacterial skin infections', 'A#54959', '2020-01-01', '2025-01-01', 1),
(1118, 3, 'NIVEA Men Face Wash', 1250, 950, 50, '651699651_nivea-men-all-in-1-face-wash-50-ml-59_2_display_1563359848_b3b8c092.png', 'All in 1 Charcoal & Refresh Skin with 10x Vitamin C Effect, for All Skin Types, 50 g', 'C#524425', '2020-01-01', '2027-06-01', 1),
(1119, 2, 'Cipla Nicotex', 840, 730, 50, '171858705_nicotex.png', 'Sugar Free Mint Plus Gums 2mg | Helps to Quit Smoking', 'A#544694', '2020-01-01', '2025-01-01', 1),
(1120, 1, 'HIMALAYA Yashtimadhu', 1290, 1200, 50, '842359392_Yashtimadhu.png', 'HIMALAYA Yashtimadhu  (60)\r\nDigestive Health', 'A#544699', '2020-01-01', '2024-01-01', 1),
(1121, 2, 'Pandol 40mg Tablet', 1200, 1020, 50, '822116455_Pandol.png', 'Reduces the amount of acid produced in your stomach', 'A#544450', '2020-01-01', '2026-01-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `address` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `mobile`, `address`, `added_on`) VALUES
(4, 'Naveen', '1234', 'naveenyoparkala@gmail.com', '2147483647', 'jgcfhgdjgcg', '2021-10-20 11:27:13'),
(9, 'varun', 'hi', 'hi@gmail.com', '8998888999', 'udupi', '2021-10-20 12:16:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`o_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`od_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `o_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1122;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
