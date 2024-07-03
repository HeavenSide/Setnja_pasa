-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 03, 2024 at 11:57 AM
-- Server version: 8.0.37-0ubuntu0.20.04.3
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `42`
--

-- --------------------------------------------------------

--
-- Table structure for table `dog_walking_appt`
--

CREATE TABLE `dog_walking_appt` (
  `walk_id` int NOT NULL,
  `walker` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `owner_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `dog_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `breed` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `age` int NOT NULL,
  `additional_info` varchar(255) NOT NULL,
  `booking_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `end_time` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `walker_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `user_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `walk_rating` int DEFAULT '0',
  `replied` tinyint(1) NOT NULL DEFAULT '0',
  `opened` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dog_walking_appt`
--

INSERT INTO `dog_walking_appt` (`walk_id`, `walker`, `owner_name`, `dog_name`, `breed`, `age`, `additional_info`, `booking_date`, `start_time`, `end_time`, `accepted`, `done`, `walker_view`, `user_view`, `path`, `duration`, `walk_rating`, `replied`, `opened`) VALUES
(14, 'analise', 'alimijich', 'gdgsdf', 'fhfhdg', 2, 'ghzjntrztzujzkh', '2024-07-08', '00:23', '02:23', 1, 0, NULL, NULL, NULL, NULL, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id_file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id_file`, `name`, `description`, `date_time`) VALUES
('', '20240418200205-8294.jpg', 'asdfghjkloiu', '2024-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `login_failure`
--

CREATE TABLE `login_failure` (
  `failure_id` int NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login_failure`
--

INSERT INTO `login_failure` (`failure_id`, `username`, `password`, `date_time`) VALUES
(1, 'four2', '$2y$10$V899B56c284fKB8GCbVUUebnZT69Am3H6xOKqLHEzpD3PZd8JaRTi', '2024-06-22 11:32:20'),
(2, 'analise', '$2y$10$qDxbxo1KtdWN3mF7Uz34Zumviu7dWBpTmvACIyvNO1cczCo9nw/Rm', '2024-06-22 12:06:11'),
(3, 'analise', '$2y$10$fof/DsaIWu.zzElW2R0b0OH1/yfEn.VjpBHdwEHFzfENdzVbAWf4u', '2024-06-27 11:22:47'),
(4, 'analise', '$2y$10$mgY.FYiQ/3zovvjtwTwNGOYjKyAePWx7jzJGIUiyyz3MI.kcKSAj6', '2024-06-27 11:34:01'),
(5, 'noia', '$2y$10$mdYbtvyX8Qsv6Pw7D79UD.41mkvGJSY58fLX/aOfX94AOxqwF3kpC', '2024-06-27 13:47:40'),
(6, 'noiamnot', '$2y$10$w19F7ITDxZdpYEv5MQPtKeNZdWJbBvV6c.7I.uitHfhTAzFE.COXq', '2024-06-27 13:48:29'),
(7, 'noiamnot', '$2y$10$R/V4rp1nb32h0U4.6eu91uq59ZkjqcpDW1a1DT7dRCrjdIddikpwS', '2024-06-27 13:50:50'),
(8, 'noiamnot', '$2y$10$kpMmBa2RpjCXPB2kJ1e8hevL2oxo.XC2mVp9IAUSjNL9drCCNatKe', '2024-06-27 13:53:21'),
(9, 'noiamnot', '$2y$10$6OytFpwmO2y/nf58FSRAQeTYUvGAh6p7EQzrXamNPmSZCKJlejcd2', '2024-06-27 16:04:17'),
(10, 'noiamnot', '$2y$10$GiRto0muXlTCFmIY0OROGOzHBL145X9VQdeCUGPlh9ZRb4tuFS.96', '2024-06-27 16:04:23'),
(11, 'alimijich', '$2y$10$045Rm0v1SC5az0XGc6oXWO/e2pUiSjJuIXb7Z0TdLfBPQA4yoqM2q', '2024-06-27 16:59:23'),
(12, 'alimijich', '$2y$10$7MsrOKO.sTpE732W9oA9eu1.UIu/Vj1INco.mNmWJeJumr/XGbLWW', '2024-06-27 18:02:44'),
(13, 'alimijich', '$2y$10$nxux08Ha9hsEUZGRYCyUVO861UbFW4DaanJcJv/2bZKT0IJPhYsB6', '2024-06-27 18:03:00'),
(14, 'alimijich', '$2y$10$85V8jo23Bo9MMiNzMJaByu1gRa5JuH01FI6XCP3yBeN/7OT9c1maK', '2024-06-27 18:08:43'),
(15, 'kuram', '$2y$10$ZY0jJMJCuHtRza5bHkZPSOdXad8c/XGhXCwRqiXGRUXYiU1qY78qG', '2024-06-28 22:51:07'),
(16, 'kurama', '$2y$10$xAbin73wRLUWEe5SvBsQrO1kzV3LSNcIsk4f7n78o72iv2sKqYrl2', '2024-06-28 22:51:43'),
(17, 'anamarija', '$2y$10$DmO0BRJRT/RGYbuFMklgZOdM5BZfgyLKfEscgNTWFCDbVeM3/UAlW', '2024-06-28 23:04:57'),
(18, 'tamara.baclija4@gmail.com', '$2y$10$76bUbcXpgzqQwYywD/97/.WS80zyjOK5.hA.YBXdFxoAuTNra9M1W', '2024-06-28 23:08:12'),
(19, 'kurama', '$2y$10$FKpKYmdPTGp0bASF6Aig6ekvRUNyLnrg7x8ydOGWqMEl5/g4tFTLa', '2024-06-28 23:14:52'),
(20, 'BaclijaTamic', '$2y$10$Y4Vz4v3M/irfPO8/zxsUPeck6Fe4loG7hxz6y1E89uMLrMuSmLfzG', '2024-06-28 23:16:52'),
(21, 'yandere', '$2y$10$KKu/npTVwtyF7QmBd1UD9.7PJfclMjtvYZAMIsyG/ujgmXoVYVlQy', '2024-06-28 23:31:48'),
(22, 'anamarija', '$2y$10$WAH5zHfrdFogR9IQyMWPl.E4z726J7DThSrBP6TqLWW7AQLo8W2oK', '2024-06-28 23:37:36'),
(23, 'pls', '$2y$10$nPB3Pg6v9PzNwer5oVjjiO4dnduovx7AAiyWv.IWvYzDiMDOO.VcW', '2024-06-28 23:47:03'),
(24, 'anamarija', '$2y$10$W47FgcLEJNYCqJ0ZMXqvwOPmtd8kJgGkZd/HrGc73GsyHZDnMB/ua', '2024-06-29 07:28:36'),
(25, 'four2', '$2y$10$52i2LDf1AfLC7s.W0x1i8.Yy8Tm3PF5R0Wd.qY5Px4.0H80un2GSS', '2024-06-29 07:28:46'),
(26, 'kurama', '$2y$10$MXvsnURGnKPs1Hiqx0Lhie4neFmS9cpQVZQUNylU2jvYrYQpSYe3W', '2024-06-29 07:28:57'),
(27, 'analise', '$2y$10$NW...gGavNP51t6N7x5sX.vgZpmzUTe2v4HIw7/7PvhtH1tloi3L6', '2024-06-29 10:55:33'),
(28, 'alisondilaurentispl', '$2y$10$62X40evPL7SObjZmTLAsP.ouofXU5W/LYF5IytNBpX9iAeewwgmd2', '2024-06-29 12:11:34'),
(29, 'alisondilaurentispl', '$2y$10$g3PG0zxHnsQTW0z9IyjZTuEIKE2xRREBlYYhdd9Ou1lSYpfJqMwKy', '2024-06-29 12:12:01'),
(30, 'samantajozic', '$2y$10$VAcY2ril629szG2b5st6HO8BuM.J9LwX0T1St14pzgpgkpJhS.gFa', '2024-06-29 16:25:13'),
(31, 'anamarija', '$2y$10$cAy5NK/.5uaaNe6ksQiX3ud8bk9lfj3vfaQtjw3.Vlm8st2iNuXUi', '2024-07-01 09:14:52'),
(32, 'kurama', '$2y$10$48XAB4NA9JC2G1X/kd1uueLt/O9Gqs2mUsEYO9e242ooNkIRFqvBu', '2024-07-01 09:29:22'),
(33, 'michaelch', '$2y$10$M/SsDwKPwkuy1Zo/Pu.MVuD8jgcNbUkvHZgFrGeJkSu/uZuiIPZaW', '2024-07-01 09:29:51'),
(34, 'anamarija', '$2y$10$vwmKDpiaE8VPw89jEfy3Nuje854zLjxMbxlZOq1G1O5Aax6XqVmoy', '2024-07-01 09:30:04'),
(35, 'analise', '$2y$10$cuRwfhzgyN7n0MyDGd.tv.b8kTHSX997Jxscsf.Egg0w2JAmZJTzK', '2024-07-01 10:00:30'),
(36, 'analise', '$2y$10$R.FiNHNEworNJiGNn29E4O97rDvnARJm7FnK2kV602qnWvdvyiacq', '2024-07-01 10:00:30'),
(37, 'analise', '$2y$10$Q1iw92b7DL0hAxtdZf5b6eKnQHeFn7jpjBMClZEAkbh6dkEfW1JeO', '2024-07-01 13:57:26'),
(38, 'alimijich', '$2y$10$oSCfWQ3MoA/xBssV5sU4Rum3.cK39WwQMjTiFi3lvC1m.5WjKNakm', '2024-07-01 15:46:12'),
(39, 'analise', '$2y$10$5TLHOgef28oNgpiBPNfMK.AX.gK3Yi/.zb0YfVv3Ht69CuSf5C7xe', '2024-07-01 16:55:11'),
(40, 'analise', '$2y$10$ufBwcadNJ2VBlgoaYNl0Au/yzW3busL5aNzEbU/tIeHQGKMzOfYay', '2024-07-01 16:58:15'),
(41, 'analise', '$2y$10$LiPqvpvno.oiqFIKEw/WZ.eGSbx80IeNiWuceoxxkotoIeJYzhhga', '2024-07-01 18:13:51'),
(42, 'analise', '$2y$10$4MmJjdN21iEO9/D2F6ZM9u0LrBxfMxFTbH1IKVl1/BOj4N6bO4LvK', '2024-07-01 18:59:23'),
(43, 'analise', '$2y$10$/gfKmz.bK2YgwJaPSbl/r.bzLBbeh/bBvvrOFJaXN0/c3LRXtfXXG', '2024-07-01 19:02:06'),
(44, 'analise', '$2y$10$I626CJ28m2QiSH0hRidPHur8fakYOXN44ZOLUohE1D/V/3TDuE4a.', '2024-07-02 09:15:50'),
(45, 'analise', '$2y$10$RdCOrXkyEMZ2NyOJV5I53e6DwJb2RJyehn9BtZV9FRKfxXWsG7On6', '2024-07-02 09:16:12'),
(46, 'analise', '$2y$10$OsVymulwVRrF662Gv1.D8OHcZjkidfBfRMjEXYllQ5XrEM7GrCLbC', '2024-07-02 09:19:58'),
(47, 'analise', '$2y$10$LNi66p0/PTskxZbTt4ls9.GC08braYGtzWGWn27YEkzExKyJyfscy', '2024-07-02 09:35:23'),
(48, 'analise', '$2y$10$xO1hZo7e1B2KDBAVu9K9xOqub89xnFhzTMOPcS5Aiojgh.jvtxOe.', '2024-07-02 09:49:44'),
(49, 'samantajozic', '$2y$10$NHgCrvEXQmWdTYvU9n8yVeeXbfDbFBvF8Y0hmZ3dYGnyB8tnBXn5a', '2024-07-02 15:34:33'),
(50, 'samantajozic', '$2y$10$cVaHOfGqRGY14MUlicU5zeRAaZjZnaZexajuvZ7SCl8qgvNmn1wFC', '2024-07-03 08:48:40'),
(51, 'alimijich', '$2y$10$olvEvjOSockfT4ENW0yLy.XdoTrZ5GV7V2EYt95nBgJNbjf9ht42e', '2024-07-03 08:48:53'),
(52, 'alimijich', '$2y$10$mtt6UxU2RfCDThLCSEmNTeqW7LsLMfSQY.F2PyZ0F5dKi4ERBxRc6', '2024-07-03 08:49:34'),
(53, 'alimijich', '$2y$10$1gPwo3gwY.sF.jw6jux.COFt/4234meSOSjDtgQOHegMg/YIyGPLm', '2024-07-03 08:49:43'),
(54, 'yo mamas ass', '$2y$10$lU/tP76E6xZv9BDMJ2B7CuQu4t2tinT06S9ZIlbfB1d.hi3BTd1YW', '2024-07-03 09:02:16'),
(55, 'bozicjovan292', '$2y$10$JdFnXZWF7N0HtiVd0KNaEeQUY6YQZ57FTodNtX64nUjQtl50JywSa', '2024-07-03 09:04:37'),
(56, 'bozicjovan292', '$2y$10$qacoaG5uH9JImGNbUlvrMeSic0IOzlG2.x7vBgyFMsdZ8upb1d282', '2024-07-03 09:06:54'),
(57, 'alimijich', '$2y$10$z2BJLY5tUDadPRZ2wyo0cuwwtA5DXImj4Q/IjmsLnt4u8Q5eVmgCC', '2024-07-03 09:17:03'),
(58, 'userpasword', '$2y$10$WI10b/xEfVLj1NLDQQGm4uo20FCdptyM8GaedtxxjVpmwG38E6Kei', '2024-07-03 10:04:35'),
(59, 'userpasword', '$2y$10$orwhCv5r.74w0W7.HkSkduLmBgsn6BJTXaqY6ESYa5rVbLgpobOR2', '2024-07-03 10:04:45'),
(60, 'userpasword', '$2y$10$c7OOtptKeJT21pCInLfyg..OUyw7sx6LDru/HUxpKJSXTc6RNtMs2', '2024-07-03 10:05:50'),
(61, 'alimijich', '$2y$10$b/jb2M0q.iXMgp5mDvK4tOtG1zQ.XISLVwlhCwHxd1VxffUUUZFFK', '2024-07-03 10:06:41'),
(62, 'alimijich', '$2y$10$WE762CVzROPLfFDpwOUaReOkIci0JgTc3bylnwC9.mRiRgVcwXOFy', '2024-07-03 10:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`email`) VALUES
('tamara.baclija4@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `task2_login_failure`
--

CREATE TABLE `task2_login_failure` (
  `id_login_failure` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task2_login_failure`
--

INSERT INTO `task2_login_failure` (`id_login_failure`, `username`, `password`, `date_time`) VALUES
(1, 'ivanovich', '$2y$10$cwteqKuJlIqdqkTqwhIsf.q/tlahm1PMRg84x/4St1x9gzrkF1HUa', '2024-04-04 17:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `task2_users`
--

CREATE TABLE `task2_users` (
  `id_user` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task2_users`
--

INSERT INTO `task2_users` (`id_user`, `username`, `password`, `name`) VALUES
(1, 'MayRin', '$2y$10$Kl5WfYraWYIpodJKv8.U4eS2AUgNXBb4YHOIDIO1UhwzVExZTwLzm', 'May'),
(2, 'MayRin', '$2y$10$MSCa7vmfui7aeJN67aRSV.skgC11NbJDzMXZsr3qpmGR.b6xWwop2', 'May'),
(3, 'Smith', '$2y$10$ScoJsIqrqRQ5gn8zNE4EMeaBJNLXlZj5SF.wjZTg2a/9WtDnIt/bO', 'Jonathan');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` int NOT NULL,
  `address` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `activation_code` int NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `admin_approved` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `reset_password`, `fname`, `lname`, `phone_number`, `address`, `city`, `country`, `activation_code`, `active`, `admin_approved`) VALUES
(3, 'anamarijajozic93', '$2y$10$9rhjIUyMMsLSGpiug5us9Og.6Mzk.0NZ3J1o5P0wojPQ6N/81cBoe', NULL, 'dgsf', 'gdfgdfg', 14121314, 'ghfghfdgfdg', 'dfhggfdfhdfhghgf', 'ghgfhdfghgfhgfh', 12345, 1, 0),
(23, 'alimijich', '$2y$10$I.9m.V56P1Yeapaz9PHX5eZS4lF1pExe3bdqQAEqBmZAZA/mw/Spa', NULL, 'samant', 'samkfnk', 123456780, 'Dracula\'s Castle 666', 'fgdfgrgf', 'Serbian', 26906, 1, 1),
(31, 'tamara.baclija6', '$2y$10$GGzQJ4gQdNeS7tCiC5ipNOJaoCkT9rRywttma42v2veozub8MZsUu', NULL, 'Tamara', 'Baclija', 123, 'Promajska 28', 'Stari Zednik 24224', 'Serbia', 50778, 0, 0),
(39, 'bozicjovan292', '$2y$10$zMM9OOGgjgb2diz3Tnj0geR9ZkZAMb5OLBcLNlLqiryrBRkhNY8ba', NULL, 'nyah', 'nrayyyhh', 613036979, 'Braće Radić 150/7\r\nBraće Radić 150/7', 'Subotica', 'Serbia', 63536, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `firstname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lastname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `registration_expires` datetime NOT NULL,
  `active` smallint NOT NULL DEFAULT '0',
  `new_password` varchar(32) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `code_password` char(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `new_password_expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `firstname`, `lastname`, `password`, `email`, `code`, `registration_expires`, `active`, `new_password`, `code_password`, `new_password_expires`) VALUES
(2, 'vts', 'vts', 'vts', '', 'vts@gmail.com', '', '2018-12-06 13:52:22', 1, '', '', '0000-00-00 00:00:00'),
(3, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(4, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(5, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(6, 'vts2', 'vts', '', '', 'vts@vtsss.com', '', '2018-12-25 20:22:43', 1, '', '', '0000-00-00 00:00:00'),
(7, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-25 20:23:37', 1, '', '', '0000-00-00 00:00:00'),
(8, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-25 20:24:55', 1, '', '', '0000-00-00 00:00:00'),
(9, 'vts1', 'vts1fn', 'vts1ln', '', 'vts1@vts.com', '', '2019-01-01 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(10, 'vts2', 'vts2fn', 'vts2ln', '', 'vts2@vts.com', '', '2019-01-01 00:00:00', 1, '', '', '0000-00-00 00:00:00'),
(12, 'vts1', 'vts1fn', 'vts1ln', '', 'vts1@vts.com', '', '2019-01-01 10:00:00', 1, '', '', '0000-00-00 00:00:00'),
(13, 'vts2', 'vts2fn', 'vts2ln', '', 'vts2@vts.com', '', '2019-01-02 11:00:00', 1, '', '', '0000-00-00 00:00:00'),
(15, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:46:16', 1, '', '', '0000-00-00 00:00:00'),
(16, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:49', 1, '', '', '0000-00-00 00:00:00'),
(17, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:52', 1, '', '', '0000-00-00 00:00:00'),
(18, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:52', 1, '', '', '0000-00-00 00:00:00'),
(19, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:53', 1, '', '', '0000-00-00 00:00:00'),
(20, 'vts2', 'vts', 'vtsss', '', 'vts@vtsss.com', '', '2018-12-26 12:47:53', 1, '', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `walker`
--

CREATE TABLE `walker` (
  `walker_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reset_password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `lname` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` int NOT NULL,
  `address` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `about` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `appointments` int DEFAULT NULL,
  `activation_change` int DEFAULT NULL,
  `accept` tinyint(1) DEFAULT '0',
  `rating_enable` int DEFAULT NULL,
  `rating` double DEFAULT NULL,
  `ppl_rated` int DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `activation_code` int NOT NULL,
  `approved` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walker`
--

INSERT INTO `walker` (`walker_id`, `email`, `password`, `reset_password`, `fname`, `lname`, `phone_number`, `address`, `city`, `country`, `photo`, `about`, `appointments`, `activation_change`, `accept`, `rating_enable`, `rating`, `ppl_rated`, `active`, `activation_code`, `approved`) VALUES
(1, 'analise', '$2y$10$6abglzeTbK9W4KR.SRwfbOY803YBJIIO9JeXk.tjF/8bcQTjx4iZO', NULL, 'analajzer', 'liser', 123654, ' Neverland', 'BG', 'Serbia', 'imgs/walkers/analise.jpg', 'A dog walker like no other', NULL, NULL, 1, 12340, 83, 19, 1, 12340, 1),
(29, 'michaelch', '$2y$10$lUi2xScOSsg4uK2EV6snn.dYHDeEuxN9mqJBGgaSq/kI0XvkmxJBm', NULL, 'pls', 'Radi', 123456, 'Koralovo 16', 'New Orleans', 'USA', 'imgs/walkers/walker3.jpg', 'Hi! I am Michael, call me Mich!', 1, NULL, 1, 12345, 55, 11, 1, 12345, 1),
(30, 'kurama', '$2y$10$P9JYSfwbiNakAki9p5PHuOpKbx6weilOvCfr6q5vQ2X3YZIkNzXdS', NULL, 'Kurama', 'Senseiiiii', 825369, 'Japan\'s Most Wanted', 'Not telling', 'Japan', 'imgs/walkers/walker4.jpg', 'A very good and flexible dogwalker!', NULL, NULL, 0, 14567, 54, 11, 1, 14567, 1),
(31, 'petegrew', '$2y$10$SMKX1IKxO.Ag1jXhFszu3.46dEMOUbuPLXsIYc2r7VSF9oOIC6jwK', NULL, 'Peter', 'Petegrew', 789456, 'Hole in your wall', 'Valley Medow', 'England', 'imgs/walkers/walker5.jpg', 'Peter Petegrew\'s description of a dog walker', NULL, NULL, 1, 54458, 1, 1, 1, 54458, 1),
(32, 'yandere', '$2y$10$iN9NxZX8jUqvtEqZNxCLC.HwNRMwBEnMM0m02V5RAjCUUxZc/R1wa', NULL, 'Iwa', 'Aldente', 78952066, 'Aldente\'s wine cellar', 'Rome', 'Italy', 'imgs/walkers/walker6.jpg', NULL, NULL, NULL, NULL, 75368, NULL, NULL, 0, 75368, 0),
(33, 'noiamnot', '$2y$10$vSZ0jMH6NDauZrVIoPUeQODvOCQPnRwOMlKzJnqX.QPZ.tzyBFcqu', NULL, 'Noi', 'Amnoti', 54692123, 'Field of Mice12', 'Witche\'s Stomac', 'Acidio', 'imgs/walkers/walker7.jpg', 'In a field of mice, I will guide your dogs hom', NULL, NULL, 0, 85234, 57, 12, 1, 85234, 1),
(2442, 'SamikaJ', '$2y$10$GaPzrtZxadW8h2PTqFtINOUev.LkydqjRZbJFUGTUziF0Pm0RwyCG', NULL, 'Samanta', 'Jozic', 4562147, 'Middle of Knowhere', 'Midgar', 'North', 'imgs/02.png', NULL, NULL, NULL, NULL, 95126, NULL, NULL, 0, 95126, 0),
(4224, 'BaclijaTamic', '$2y$10$sRlTTOipXnFvHpr4hDvDqOhLhGYGjblqG2xbiW854Frv1ODwLu1lu', NULL, 'Baclija', 'Tamara', 123456789, 'An address Of Her', 'Hercity', 'Serbia', 'imgs/01.png', NULL, NULL, NULL, NULL, 45678, NULL, NULL, 0, 45678, 0),
(4248, 'jozicsamika', '$2y$10$nGr3VJqxbMLgGo9sYYthYORHbRWDd81qV0UnHBrerzKB0VUkwzP.W', NULL, 'Vlad', 'Dracula', 1515341, 'Dracula\'s Castle 66', 'Transylvania', 'Serbia', 'imgs/walkers/jozicsamika.jpg', '', NULL, NULL, 0, 84926, NULL, NULL, 1, 84926, 1);

-- --------------------------------------------------------

--
-- Table structure for table `walks`
--

CREATE TABLE `walks` (
  `id` int NOT NULL,
  `walker_view` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_view` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `path` text COLLATE utf8mb4_general_ci,
  `duration` time NOT NULL,
  `rating` int NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `walker` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `walk_id` int DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walks`
--

INSERT INTO `walks` (`id`, `walker_view`, `user_view`, `path`, `duration`, `rating`, `date`, `walker`, `walk_id`, `email`) VALUES
(2, 'The dog was very active and happy', 'My dog is now in a good mood', 'Around the city', '02:05:00', 5, '12-11-2024', 'analise', 6, 'tamara.baclija6'),
(3, 'The walk was very pleasant. The dog is well behaved', 'My dog was very happy and calm after the walk', 'Around the lake', '04:10:00', 5, '12/7/2027', 'analise', 11, 'alimijich'),
(4, 'The dog was well behaved and didn\'t even bark', 'My dog was well behaved after the little walk he\'s had', 'around the block', '01:00:00', 5, '12-11-2024', 'analise', 10, 'anamarijajozic93'),
(5, 'The dog tried biting the leash at some point', 'My dog came back with a squirell', 'around the lake', '02:00:00', 5, '2024-07-09', 'analise', 13, 'tamara.baclija6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog_walking_appt`
--
ALTER TABLE `dog_walking_appt`
  ADD PRIMARY KEY (`walk_id`),
  ADD KEY `walker_email_fk` (`walker`),
  ADD KEY `user_email_fk` (`owner_name`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `login_failure`
--
ALTER TABLE `login_failure`
  ADD PRIMARY KEY (`failure_id`);

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `task2_login_failure`
--
ALTER TABLE `task2_login_failure`
  ADD PRIMARY KEY (`id_login_failure`);

--
-- Indexes for table `task2_users`
--
ALTER TABLE `task2_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `walker`
--
ALTER TABLE `walker`
  ADD PRIMARY KEY (`walker_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `walks`
--
ALTER TABLE `walks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `walker_email_walks_fk` (`walker`),
  ADD KEY `user_email_walks_fk` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog_walking_appt`
--
ALTER TABLE `dog_walking_appt`
  MODIFY `walk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_failure`
--
ALTER TABLE `login_failure`
  MODIFY `failure_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `task2_login_failure`
--
ALTER TABLE `task2_login_failure`
  MODIFY `id_login_failure` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task2_users`
--
ALTER TABLE `task2_users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `walker`
--
ALTER TABLE `walker`
  MODIFY `walker_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4249;

--
-- AUTO_INCREMENT for table `walks`
--
ALTER TABLE `walks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dog_walking_appt`
--
ALTER TABLE `dog_walking_appt`
  ADD CONSTRAINT `user_email_fk` FOREIGN KEY (`owner_name`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `walker_email_fk` FOREIGN KEY (`walker`) REFERENCES `walker` (`email`);

--
-- Constraints for table `walks`
--
ALTER TABLE `walks`
  ADD CONSTRAINT `user_email_walks_fk` FOREIGN KEY (`email`) REFERENCES `user` (`email`),
  ADD CONSTRAINT `walker_email_walks_fk` FOREIGN KEY (`walker`) REFERENCES `walker` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
