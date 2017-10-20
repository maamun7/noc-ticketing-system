-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2015 at 08:18 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ticketing_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `complain_response`
--

CREATE TABLE IF NOT EXISTS `complain_response` (
`id` int(11) NOT NULL,
  `complain_id` varchar(11) NOT NULL,
  `response_by_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `response_at` datetime NOT NULL,
  `edited_at` datetime NOT NULL,
  `client_notifications` tinyint(1) NOT NULL,
  `noc_notifications` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_complain`
--

CREATE TABLE IF NOT EXISTS `customer_complain` (
`id` int(11) NOT NULL,
  `ticket_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complain_details` text NOT NULL,
  `attached_file` varchar(100) NOT NULL,
  `attached_path` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `ticket_number` int(11) NOT NULL,
  `estimate_time` int(11) NOT NULL,
  `estimate_time_by_id` int(11) NOT NULL,
  `given_estimate_time_at` datetime NOT NULL,
  `done_at` datetime NOT NULL,
  `noc_notifications` int(5) NOT NULL,
  `client_notifications` int(5) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`permission_id` int(11) NOT NULL,
  `permission` varchar(100) NOT NULL,
  `permission_alias` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `edited_on` datetime NOT NULL,
  `group_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission`, `permission_alias`, `description`, `created_on`, `edited_on`, `group_id`, `status`) VALUES
(1, 'Manage Home', 'manage_home', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 1, 0),
(2, 'Add User', 'add_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(3, 'Edit User', 'edit_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(4, 'Manager User', 'manager_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(5, 'Delete User', 'delete_user', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 2, 0),
(6, 'Manage Role', 'manage_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(7, 'Add Role', 'add_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(8, 'Edit Role', 'edit_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(9, 'Delete Role', 'delete_role', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 3, 0),
(10, 'Manage Permission', 'manage_permission', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 4, 0),
(11, 'Add Permission', 'add_permission', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 4, 0),
(20, 'Edit Current Rate', 'edit_current_rate', '', '2014-09-22 00:00:00', '0000-00-00 00:00:00', 6, 0),
(22, 'Edit Profile', 'edit_profile', '', '2014-03-11 00:00:00', '0000-00-00 00:00:00', 2, 0),
(23, 'Change Password', 'change_password', '', '2014-03-11 00:00:00', '0000-00-00 00:00:00', 2, 0),
(24, 'Response', 'complain_response', 'complain_response', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 1),
(26, 'Manage Complain', 'manage_complain', 'manage_complain', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 1),
(27, 'Manage Ticket', 'manage_ticket', 'Manage Ticket', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 1),
(28, 'New Ticket', 'new_ticket', 'New Ticket', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 9, 1),
(30, 'Can give estimate time', 'given_estimate_time', 'Given Estimate Time', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, 1),
(31, 'Manage Complain History', 'manage_qhistory', 'Manage Complain History', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 8, 1),
(32, 'Can Complain Response', 'complain_response', 'Can Complain Response', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 8, 1),
(34, 'Manage ticket', 'manage_ticket', 'Manage ticket', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 9, 1),
(35, 'Opne New Ticket', 'new_ticket', 'Opne New Ticket', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 9, 1),
(36, 'Manage ticket template', 'manage_ticket_template', 'Manage ticket template', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 10, 1),
(37, 'Can add new ticket template', 'add_ticket_template', 'Can add new ticket template', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 10, 1),
(38, 'Can eidt ticket template', 'edit_ticket_template', 'Can eidt ticket template', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 10, 1),
(39, 'Can delete ticket template', 'delete_ticket_template', 'Can delete ticket template', '2015-04-09 00:00:00', '0000-00-00 00:00:00', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission_groups`
--

CREATE TABLE IF NOT EXISTS `permission_groups` (
`group_id` int(11) NOT NULL,
  `group` varchar(100) NOT NULL,
  `group_alias` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `permission_groups`
--

INSERT INTO `permission_groups` (`group_id`, `group`, `group_alias`, `status`) VALUES
(1, 'Home', 'home', 1),
(2, 'User', 'user', 1),
(3, 'Role', 'role', 1),
(4, 'Permission', 'permission', 1),
(7, 'Report', 'report', 1),
(8, 'Complain', 'complain', 0),
(9, 'Ticket', 'ticket', 1),
(10, 'Ticket Template', 'ticket_template', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `status`) VALUES
(1, 'Administrator', 1),
(3, 'Top Management', 1),
(4, 'NOC Department', 1),
(5, 'Cellex Merketting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_permission_relation`
--

CREATE TABLE IF NOT EXISTS `role_permission_relation` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `role_permission_relation`
--

INSERT INTO `role_permission_relation` (`id`, `role_id`, `permission`) VALUES
(1, 1, ',add_user,edit_user,manager_user,delete_user,manage_role,add_role,edit_role,delete_role,manage_permission,add_permission,manager_supplier,add_supplier,edit_supplier,delete_supplier,export_csv_file,import_csv_file,manager_destination,add_destination,edit_destination,delete_destination,'),
(2, 3, ',manage_home,edit_profile,change_password,manager_supplier,add_supplier,edit_supplier,delete_supplier,export_csv_file,import_csv_file,manager_current_rate,edit_current_rate,complain_response,manage_complain,'),
(3, 4, ',manage_home,complain_response,manage_complain,given_estimate_time,manage_ticket,new_ticket,'),
(4, 5, ',manage_home,manage_complain,manage_qhistory,manage_ticket,new_ticket,manage_ticket,new_ticket,');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_type`
--

CREATE TABLE IF NOT EXISTS `ticket_type` (
`id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `edited_by` int(11) NOT NULL,
  `edited_at` datetime NOT NULL,
  `ordering` int(4) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ticket_type`
--

INSERT INTO `ticket_type` (`id`, `details`, `created_by`, `created_at`, `edited_by`, `edited_at`, `ordering`, `status`) VALUES
(1, 'IP Change', 1, '2015-04-05 16:02:30', 0, '0000-00-00 00:00:00', 1, 1),
(2, 'Rate Change', 1, '2015-04-05 16:02:46', 0, '0000-00-00 00:00:00', 2, 1),
(3, 'Port Issue', 1, '2015-04-06 13:07:40', 0, '0000-00-00 00:00:00', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `designition` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `designition`, `address`, `image`, `image_path`, `status`) VALUES
(1, 'Mamun', 'Ahmed', 'Software Engineer', 'Dhaka', '', '', 1),
(2, 'Faisal', 'Karim', 'System Engineer', 'Dhaka', '', '', 1),
(3, 'Sajid', 'Ahmed', 'System Engineer', 'Dhaka', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `can_login` tinyint(1) NOT NULL,
  `security_code` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `username`, `password`, `user_type`, `is_active`, `can_login`, `security_code`) VALUES
(1, 'admin@admin.com', '8dd57884e6505457c34f313c1154237f', 2, 1, 1, ''),
(2, 'faisal@cellexltd.com', '8dd57884e6505457c34f313c1154237f', 2, 1, 1, ''),
(3, 'sajid@cellexltd.com', '8dd57884e6505457c34f313c1154237f', 2, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_relation`
--

CREATE TABLE IF NOT EXISTS `user_role_relation` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_role_relation`
--

INSERT INTO `user_role_relation` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complain_response`
--
ALTER TABLE `complain_response`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_complain`
--
ALTER TABLE `customer_complain`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `permission_groups`
--
ALTER TABLE `permission_groups`
 ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `role_permission_relation`
--
ALTER TABLE `role_permission_relation`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_type`
--
ALTER TABLE `ticket_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role_relation`
--
ALTER TABLE `user_role_relation`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complain_response`
--
ALTER TABLE `complain_response`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_complain`
--
ALTER TABLE `customer_complain`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `permission_groups`
--
ALTER TABLE `permission_groups`
MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_permission_relation`
--
ALTER TABLE `role_permission_relation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ticket_type`
--
ALTER TABLE `ticket_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_role_relation`
--
ALTER TABLE `user_role_relation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
