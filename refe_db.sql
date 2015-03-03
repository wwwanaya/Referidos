-- phpMyAdmin SQL Dump
-- version 4.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2015 at 01:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `refe_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `refe_user`
--

CREATE TABLE IF NOT EXISTS `refe_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(30) NOT NULL,
  `user_pass` varchar(30) NOT NULL,
  `user_rol` varchar(30) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_active` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `refe_user`
--

INSERT INTO `refe_user` (`user_id`, `user_username`, `user_pass`, `user_rol`, `user_name`, `user_active`) VALUES
(2, 'afid', '12345', 'Agente', 'Onofre Rivas', 'Y'),
(3, 'manuel', '123', 'Supervisor', 'Manuel Sibrian', 'Y'),
(4, 'ricardo', '123456', 'Agente', 'Ricardo Delgado', 'Y'),
(5, 'vmartinez', 'Teamobb01', 'Supervisor', 'Vanessa Martinez', 'Y'),
(6, 'jsandoval', 'bancoazul', 'Agente', 'Josue Sandoval', 'Y'),
(8, 'kevin', '123', 'Agente', 'Kevin Anaya', 'Y'),
(9, 'daemon', '123456', 'Agente', 'linux fedora', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ref`
--

CREATE TABLE IF NOT EXISTS `tbl_ref` (
  `ref_id` int(11) NOT NULL,
  `ref_own` varchar(30) NOT NULL,
  `ref_nom` varchar(100) NOT NULL,
  `ref_ape` varchar(100) NOT NULL,
  `ref_tel1` varchar(15) NOT NULL,
  `ref_tel2` varchar(15) NOT NULL,
  `ref_tel3` varchar(15) NOT NULL,
  `ref_who` varchar(200) NOT NULL,
  `ref_status` varchar(100) NOT NULL,
  `ref_obs` varchar(250) NOT NULL,
  `ref_fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ref`
--

INSERT INTO `tbl_ref` (`ref_id`, `ref_own`, `ref_nom`, `ref_ape`, `ref_tel1`, `ref_tel2`, `ref_tel3`, `ref_who`, `ref_status`, `ref_obs`, `ref_fecha`) VALUES
(30, 'vmartinez', 'SILVIA ', 'IGLESIAS', '44977270920  ', '', '44922600753', '', 'Estado 1', 'ES MAMA DEL POSIBLE CLIENTE GERARDO ALEXANDER RIVAS IGLESIA ', '2015-02-04 21:14:48'),
(31, 'jsandoval', 'CARLA MARIANA', 'CARDONA CAMAYO', '', '', '44922205217', '', 'Estado 1', 'NUMERO DE CASA DEL POSIBLE CLIENTE COMUNICARSE CON LA HERMANA PARA OFRECER PRODUCTO YA QUE ESTA BASTANTE INTERESADA ', '2015-02-05 15:29:52'),
(32, 'jsandoval', 'CARMEN HELENA ', 'ESCOBAR', '', '', '44922073458', 'ANA JULIA ESCOBAR BORJA', 'Aprobado', 'ANA JULIA ESCOBAR BORJA ES HERMANA DE ESTE POSIBLE CLIENTE LLAMAR A LA CASA NUEVAMENTE ', '2015-02-05 23:55:18'),
(34, 'manuel', 'Prueba de', 'Nuevo Referido', '158493248', '156486876', '268486246', 'HP Compaq', 'Pendiente de llamar', 'Probando que todo funcione bien.', '2015-02-10 18:24:15'),
(42, 'kevin', 'Bolado', 'Celeste', '89456123', '75656532', '79562323', '', 'Desembolsado', '', '2015-02-18 22:41:01'),
(47, 'jsandoval', 'ricardo', 'fernandez', '34234234', '', '', '', 'Rechazado', 'fdsdfsdf', '2015-02-19 15:38:22'),
(48, 'vmartinez', 'osdfsd', 'sdadfsdf', '12345678', '23423423', '3423423', 'nose ', 'Desembolsado', 'sdasd', '2015-02-19 15:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `sta_id` int(11) NOT NULL,
  `sta_titulo` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`sta_id`, `sta_titulo`) VALUES
(1, 'Pendiente de llamar'),
(2, 'En proceso'),
(3, 'Rechazado'),
(4, 'Aprobado'),
(5, 'Desembolsado'),
(6, 'No le interesa'),
(7, 'Desistido');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refe_user`
--
ALTER TABLE `refe_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_ref`
--
ALTER TABLE `tbl_ref`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `tbl_status`
--
ALTER TABLE `tbl_status`
  ADD PRIMARY KEY (`sta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refe_user`
--
ALTER TABLE `refe_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tbl_ref`
--
ALTER TABLE `tbl_ref`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_status`
--
ALTER TABLE `tbl_status`
  MODIFY `sta_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
