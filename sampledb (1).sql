-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 10:35 AM
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
-- Database: `sampledb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login` (IN `p_username` TEXT, IN `p_password` TEXT)   BEGIN
	declare ret int;
    declare stat int;
    if exists(select * from tbl_users where username = p_username and password = p_password) THEN
    	set stat = (select status from tbl_users where username = p_username and password = p_password);
        if stat = 1 THEN
        	set ret = 1;
        	select *,ret from tbl_users where username = p_username and password = p_password;
        ELSE
        	set ret = 2;
            select ret;
        end if;
    ELSE 
    	set ret = 0;
        	select ret;
    end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_saveUser` (IN `p_fullname` TEXT, IN `p_username` TEXT, IN `p_password` TEXT, IN `p_role` INT, IN `p_profilepic` TEXT)   BEGIN
DECLARE cout int;
if exists(select * from tbl_users where username = p_username) THEN
		set cout = 1;
 		select cout;
ELSE
   insert into tbl_users(fullname,username,password,role,dateInserted,profilepic,status) values(p_fullname,p_username,p_password,p_role,now(),p_profilepic,1);
set cout = 0;
select cout;
end if;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_updateUser` (IN `p_userid` INT, IN `p_fullname` TEXT, IN `p_password` TEXT, IN `p_role` INT)   BEGIN

IF p_password = '' THEN
	UPDATE tbl_users set fullname = p_fullname, role = p_role where userid = p_userid;
else 
    UPDATE tbl_users set fullname = p_fullname, role = p_role, password = p_password where userid = p_userid;
end if;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userid` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fullname` text NOT NULL,
  `role` int(11) NOT NULL,
  `profilepic` text NOT NULL,
  `dateInserted` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userid`, `username`, `password`, `fullname`, `role`, `profilepic`, `dateInserted`, `status`) VALUES
(49, 'berto', '098f6bcd4621d373cade4e832627b4f6', 'Berto', 1, 'berto-1x1.jpg', '2023-04-01 17:39:21', 1),
(59, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'asdf', 1, 'breakie-deal-1-1.jpg', '2023-04-01 17:47:03', 1),
(60, 'test2', '098f6bcd4621d373cade4e832627b4f6', 'test', 1, '24-hours-support.png', '2023-04-22 15:58:19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
