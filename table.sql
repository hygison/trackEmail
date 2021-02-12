-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2021 at 06:34 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `myDatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `email_marketing`
--

CREATE TABLE `email_marketing` (
  `id` int(255) NOT NULL,
  `senderName` varchar(255) DEFAULT NULL,
  `senderEmail` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` longtext,
  `email` varchar(50) DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `trackCode` varchar(255) DEFAULT NULL,
  `sentDate` datetime DEFAULT NULL,
  `openDate` datetime DEFAULT NULL,
  `isOpen` varchar(20) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email_marketing`
--

INSERT INTO `email_marketing` (`id`, `senderName`, `senderEmail`, `subject`, `message`, `email`, `fileName`, `trackCode`, `sentDate`, `openDate`, `isOpen`) VALUES
(19, 'Sender Name Default Value', 'info@example.com', 'Subject 1', '<h1 style=\"padding:100px 100px; background:red; color:#fff\">EMAIL TEMPLATE 1</h1>\r\n<p>\r\n    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod eos repellendus sequi culpa eligendi magnam porro unde. Iure rerum temporibus assumenda dolor ab. Eaque sapiente velit qui aperiam sint corrupti, fuga veritatis iure perferendis rerum maiores neque consequatur quidem optio.\r\n</p>', 'test@gmail.com', 'email-1.html', '5e64ffbad6aa477e439ffbe89686ec9e', '2021-02-13 03:22:29', NULL, 'no'),
(20, 'Sender Name Default Value', 'info@example.com', 'Testing Email', '<h1 style=\"padding:100px 100px; background:blue; color:#fff\">EMAIL TEMPLATE 2</h1>\n<p>\n    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi consequuntur unde illum tempore incidunt atque autem reiciendis cupiditate quam facere?\n</p>', 'user@gmail.com', 'email-2.html', '8f81804b0212381669bdcac36fefca9d', '2021-02-13 03:32:00', '2021-02-15 03:32:29', 'yes'),
(21, 'Sender Name Default Value', 'info@example.com', 'Testing Email', '<h1 style=\"padding:100px 100px; background:blue; color:#fff\">EMAIL TEMPLATE 2</h1>\n<p>\n    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi consequuntur unde illum tempore incidunt atque autem reiciendis cupiditate quam facere?\n</p>', 'user@gmail.com', 'email-2.html', 'fd0cb94d739552edabfa59f59a42c45b', '2021-02-13 03:32:07', NULL, 'no'),
(22, 'Sender Name Default Value', 'info@example.com', 'Testing Email', '<h1 style=\"padding:100px 100px; background:blue; color:#fff\">EMAIL TEMPLATE 2</h1>\n<p>\n    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi consequuntur unde illum tempore incidunt atque autem reiciendis cupiditate quam facere?\n</p>', 'user@gmail.com', 'email-2.html', 'f1056ed8474b127cdfb44603c1824fa3', '2021-02-13 03:32:12', NULL, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email_marketing`
--
ALTER TABLE `email_marketing`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email_marketing`
--
ALTER TABLE `email_marketing`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
