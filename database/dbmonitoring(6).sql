-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2020 at 04:13 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbmonitoring`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_weekendrpts`(IN `SessionId` VARCHAR(225), IN `TermNumber` VARCHAR(225))
BEGIN

SET SessionId = REPLACE(SessionId, ' ',"");
SET TermNumber = REPLACE(TermNumber, ' ',"");

select
HOMESKNOCK,
HOMESPREACH,
PCONTACTED,
RECEIVEDGOSPEL,	
GOPENFOLLOW,
SISBAPTISM + BROBAPTISM AS BAPTISM,
NEWHOMESMTG,
TOTALHOMESMTG,	
TOTALPERSONHMTG,	
PVISITEDNOTHMEET,	
NSMALLGMTG,
SMALLGMTGHELD,	
LOCALATTSMLMTG,	
LOCALSAINTSJOINPROP,	
MANHOURS,
LTM,
TEAMHOURS,
week.`week` AS WeekType

from weekspropagation

inner join accounts on weekspropagation.accounts_id=accounts.id
inner join locality on accounts.LOCALITY = locality.ID
inner join historyfeedback on
historyfeedback.id=weekspropagation.historyfeedback_id
inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
inner join batch on batch.id=historyfeedback.BATCH 
inner join week on week.id=historyfeedback.WEEK
inner join userlevel on userlevel.id=historyfeedback.acc_id 
inner join status on status.id=historyfeedback.status_id 
where accounts_id=  SessionId and batch.BATCH= TermNumber and USER_LEVEL = User_level;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGetTeamPropagation`(IN `SessionId` INT, IN `TermNumber` VARCHAR(5), IN `TermMonth` VARCHAR(30), IN `TermYear` VARCHAR(5), IN `User_level` INT)
BEGIN
SET SessionId = REPLACE(SessionId, ' ',"");
SET TermNumber = REPLACE(TermNumber, ' ',"");
SET TermMonth = REPLACE(TermMonth, ' ',"");
SET TermYear = REPLACE(TermYear, ' ',"");
select DISTINCT CONCAT(First_Name, ' ',Last_Name) AS Trainee,FT  
from weekspropagation AS wkprop
INNER JOIN historyfeedback on historyfeedback.id=wkprop.historyfeedback_id
inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
INNER JOIN batch on batch.id=historyfeedback.BATCH 
INNER JOIN accounts AS acct ON acct.id = wkprop.accounts_id
INNER JOIN locality AS lcty ON acct.locality = lcty.ID
INNER JOIN current_teamdata AS ct ON ct.userlevel_id = acct.USER_LEVEL
INNER JOIN teammate AS team ON ct.c_team_id = team.currentteam_id AND team.locality_id = lcty.ID
INNER JOIN trainee_info AS trainee ON team.trainee_id = trainee.trainee_id
INNER JOIN class ON class.ID = trainee.Term
where accounts_id=  SessionId and batch.BATCH= TermNumber 
and 
USER_LEVEL = User_level
;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_GetPropagationRecord`(IN `SessionId` INT, IN `TermNumber` VARCHAR(5), IN `TermMonth` VARCHAR(30), IN `TermYear` VARCHAR(5), IN `User_level` INT)
BEGIN

SET SessionId = REPLACE(SessionId, ' ',"");
SET TermNumber = REPLACE(TermNumber, ' ',"");
SET TermMonth = REPLACE(TermMonth, ' ',"");
SET TermYear = REPLACE(TermYear, ' ',"");
select
HOMESKNOCK,
HOMESPREACH,
PCONTACTED,
RECEIVEDGOSPEL,	
GOPENFOLLOW,
SISBAPTISM + BROBAPTISM AS BAPTISM,
NEWHOMESMTG,
TOTALHOMESMTG,	
TOTALPERSONHMTG,	
PVISITEDNOTHMEET,	
NSMALLGMTG,
SMALLGMTGHELD,	
LOCALATTSMLMTG,	
LOCALSAINTSJOINPROP,	
MANHOURS,
LTM,
TEAMHOURS,
week.`week` AS WeekType

from weekspropagation
inner join historyfeedback on historyfeedback.id=weekspropagation.historyfeedback_id
inner join month on month.id=historyfeedback.MONTH
inner join year on year.id=historyfeedback.YEAR 
inner join batch on batch.id=historyfeedback.BATCH 
inner join week on week.id=historyfeedback.WEEK
inner join userlevel on userlevel.id=historyfeedback.acc_id 
inner join status on status.id=historyfeedback.status_id 
where accounts_id=  SessionId and batch.BATCH= TermNumber 
and USER_LEVEL = User_level;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_SaveContact`(
	prmName varchar(100),
	prmCont varchar(15),
	prmAddress varchar(200),
	prmTopic varchar(250),
	prmRemarks varchar(250),
	prmBap varchar(100),
	prmAGId int,
	prmIsBaptized int
)
BEGIN
	INSERT INTO contactdetails
	(NAME,CONTACTNUMBER,ADDRESS,BAPTISM,
	SHEPHERDING,Remarks,AGId,IsBaptized)
	VALUES
	(prmName,prmCont,prmAddress,prmBap,
	prmTopic,prmRemarks,prmAGId,prmIsBaptized);
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR`(
  x VARCHAR(255),
  delim VARCHAR(12),
  pos INT
) RETURNS varchar(255) CHARSET latin1
RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
`id` int(11) NOT NULL,
  `USERNAME` varchar(225) NOT NULL,
  `PASSWORD` varchar(225) NOT NULL,
  `USER_LEVEL` int(3) DEFAULT NULL,
  `LOCALITY` varchar(225) NOT NULL,
  `DATE_CREATED` varchar(225) NOT NULL COMMENT '0000-00-00 00:00:00.000000',
  `STATUS` int(3) NOT NULL,
  `Time` varchar(225) CHARACTER SET keybcs2 DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `USERNAME`, `PASSWORD`, `USER_LEVEL`, `LOCALITY`, `DATE_CREATED`, `STATUS`, `Time`) VALUES
(29, 'admin', 'jesusiloveyou', 1, 'ADMINISTRATION', '000000000', 1, '0000-00-00 00:00:00.000000'),
(37, 'angat/drt', '1234', 3, '52', '', 2, NULL),
(38, 'baguio', '1234', 3, '18', '12/04/2019 02:43:48 pm', 1, NULL),
(39, 'abra', '1234', 3, '4', '12/04/2019 02:46:58 pm', 2, NULL),
(40, 'abradeilog', '1234', 3, '5', '12/04/2019 02:47:32 pm', 2, NULL),
(41, 'aguinaldo', '1234', 3, '6', '12/04/2019 02:47:52 pm', 2, NULL),
(42, 'aklan', '1234', 3, '7', '12/04/2019 02:49:18 pm', 2, NULL),
(43, 'alaminos', '1234', 3, '8', '12/04/2019 02:49:38 pm', 2, NULL),
(44, 'amulung', '1234', 3, '9', '12/04/2019 02:50:59 pm', 2, NULL),
(45, 'anao', '1234', 3, '10', '12/04/2019 02:51:34 pm', 2, NULL),
(46, 'antipolo', '1234', 3, '11', '12/04/2019 02:51:47 pm', 2, NULL),
(47, 'antique', '1234', 3, '12', '12/04/2019 02:51:59 pm', 2, NULL),
(48, 'apalit/minalin', '1234', 3, '13', '', 2, NULL),
(49, 'atimonan', '1234', 3, '14', '12/04/2019 02:52:24 pm', 2, NULL),
(50, 'bacolod', '1234', 3, '15', '12/04/2019 02:52:56 pm', 2, NULL),
(51, 'badoc', '1234', 3, '16', '12/04/2019 02:53:41 pm', 2, NULL),
(52, 'bagamanoc', '1234', 3, '17', '12/04/2019 02:53:52 pm', 2, NULL),
(53, 'balanga', '1234', 3, '19', '12/04/2019 02:54:07 pm', 2, NULL),
(54, 'baler', '1234', 3, '20', '12/04/2019 02:54:24 pm', 2, NULL),
(55, 'banaue', '1234', 3, '21', '12/04/2019 02:54:37 pm', 2, NULL),
(56, 'bani', '1234', 3, '22', '12/04/2019 02:54:56 pm', 2, NULL),
(57, 'baras', '1234', 3, '23', '12/04/2019 02:55:12 pm', 2, NULL),
(58, 'batac', '1234', 3, '24', '12/04/2019 02:55:27 pm', 2, NULL),
(60, 'bayombong', '1234', 3, '26', '12/04/2019 06:08:54 pm', 2, NULL),
(61, 'batangas', '1234', 3, '25', '12/04/2019 06:13:31 pm', 2, NULL),
(62, 'biÃ±an', '1234', 3, '27', '12/04/2019 06:13:45 pm', 2, NULL),
(63, 'bongabon', '1234', 3, '28', '12/04/2019 06:14:13 pm', 2, NULL),
(64, 'bontoc', '1234', 3, '29', '12/04/2019 06:14:29 pm', 2, NULL),
(65, 'botolan', '1234', 3, '30', '12/04/2019 06:14:42 pm', 2, NULL),
(66, 'cabagan', '1234', 3, '31', '12/04/2019 06:14:59 pm', 2, NULL),
(67, 'cabanatuan', '1234', 3, '32', '12/04/2019 06:15:13 pm', 2, NULL),
(68, 'cabangan', '1234', 3, '33', '12/04/2019 06:15:25 pm', 2, NULL),
(69, 'cabuyao', '1234', 3, '34', '12/04/2019 06:15:45 pm', 2, NULL),
(70, 'cainta', '1234', 3, '35', '12/04/2019 06:16:05 pm', 2, NULL),
(71, 'calabanga', '1234', 3, '36', '12/04/2019 06:16:20 pm', 2, NULL),
(72, 'calamba', '1234', 3, '37', '12/04/2019 06:16:34 pm', 2, NULL),
(73, 'caloocan_n', '1234', 3, '38', '12/04/2019 06:16:46 pm', 2, NULL),
(74, 'caloocan_s', '1234', 3, '39', '12/04/2019 06:34:53 pm', 2, NULL),
(75, 'camiling', '1234', 3, '40', '12/04/2019 06:35:05 pm', 2, NULL),
(76, 'casiguran', '1234', 3, '41', '12/04/2019 06:35:28 pm', 2, NULL),
(77, 'castillejos', '1234', 3, '42', '12/04/2019 06:35:42 pm', 2, NULL),
(78, 'catanauan', '1234', 3, '43', '12/04/2019 06:35:55 pm', 2, NULL),
(79, 'cauayan', '1234', 3, '44', '12/04/2019 06:36:05 pm', 2, NULL),
(80, 'daet', '1234', 3, '45', '12/04/2019 06:36:18 pm', 2, NULL),
(81, 'dasmariÃ±as', '1234', 3, '46', '12/04/2019 06:36:28 pm', 2, NULL),
(82, 'diffun', '1234', 3, '47', '12/04/2019 06:36:39 pm', 2, NULL),
(83, 'dinalungan', '1234', 3, '48', '12/04/2019 06:36:58 pm', 2, NULL),
(84, 'dinalupihan', '1234', 3, '49', '12/04/2019 06:37:19 pm', 2, NULL),
(85, 'dingras', '1234', 3, '50', '12/04/2019 06:37:29 pm', 2, NULL),
(86, 'dipaculao', '1234', 3, '51', '12/04/2019 06:37:38 pm', 2, NULL),
(87, 'dupaxdelnorte', '1234', 3, '53', '12/04/2019 06:37:47 pm', 2, NULL),
(88, 'gapan', '1234', 3, '54', '12/04/2019 06:38:06 pm', 2, NULL),
(89, 'goa', '1234', 3, '56', '12/04/2019 06:38:22 pm', 2, NULL),
(90, 'hermosa', '1234', 3, '57', '12/04/2019 06:38:38 pm', 2, NULL),
(91, 'hungduan', '1234', 3, '58', '12/04/2019 06:38:51 pm', 2, NULL),
(92, 'iba', '1234', 3, '59', '12/04/2019 06:39:13 pm', 2, NULL),
(93, 'ilagan', '1234', 3, '60', '12/04/2019 06:39:45 pm', 2, NULL),
(94, 'iloilo', '1234', 3, '61', '12/04/2019 06:40:03 pm', 2, NULL),
(95, 'iriga', '1234', 3, '62', '12/04/2019 06:40:03 pm', 2, NULL),
(96, 'itogon', '1234', 3, '63', '12/04/2019 06:40:03 pm', 2, NULL),
(97, 'jalajala', '1234', 3, '64', '12/04/2019 06:40:03 pm', 2, NULL),
(98, 'kapangan', '1234', 3, '65', '12/04/2019 06:40:03 pm', 2, NULL),
(99, 'kasibu', '1234', 3, '66', '12/04/2019 06:40:03 pm', 2, NULL),
(100, 'latrinidad', '1234', 3, '67', '12/04/2019 06:41:26 pm', 2, NULL),
(101, 'lamut', '1234', 3, '68', '12/04/2019 06:42:08 pm', 2, NULL),
(102, 'laspiÃ±as', '1234', 3, '69', '12/04/2019 06:44:12 pm', 2, NULL),
(103, 'legazpi', '1234', 3, '70', '12/04/2019 06:44:22 pm', 2, NULL),
(104, 'limay', '1234', 3, '71', '12/04/2019 06:44:36 pm', 2, NULL),
(105, 'lingayen', '1234', 3, '72', '12/04/2019 06:44:36 pm', 2, NULL),
(106, 'lipa', '1234', 3, '73', '12/04/2019 06:44:36 pm', 2, NULL),
(107, 'los baÃ±os', '1234', 3, '74', '12/04/2019 06:44:36 pm', 2, NULL),
(108, 'lubao/guagua', '1234', 3, '75', '', 2, NULL),
(109, 'lucban', '1234', 3, '76', '12/04/2019 06:45:17 pm', 2, NULL),
(110, 'magalang/angeles', '1234', 3, '77', '', 2, NULL),
(111, 'magallanes', '1234', 3, '78', '12/04/2019 06:45:59 pm', 2, NULL),
(112, 'magsingal', '1234', 3, '79', '12/04/2019 06:45:59 pm', 2, NULL),
(113, 'malabon', '1234', 3, '80', '12/04/2019 06:45:59 pm', 2, NULL),
(114, 'mallig', '1234', 3, '81', '12/04/2019 06:45:59 pm', 2, NULL),
(115, 'malolos_lp', '1234', 3, '82', '', 2, NULL),
(116, 'mamburao', '1234', 3, '83', '12/04/2019 06:47:02 pm', 2, NULL),
(117, 'mandaluyong', '1234', 3, '84', '12/04/2019 06:47:02 pm', 2, NULL),
(118, 'mariveles', '1234', 3, '85', '12/04/2019 06:47:22 pm', 2, NULL),
(119, 'masbate', '1234', 3, '86', '12/04/2019 06:47:36 pm', 2, NULL),
(120, 'mexico', '1234', 3, '87', '12/04/2019 06:47:45 pm', 2, NULL),
(122, 'morong', '1234', 3, '88', '12/04/2019 06:48:07 pm', 2, NULL),
(123, 'muÃ±oz', '1234', 3, '89', '12/04/2019 06:48:48 pm', 2, NULL),
(124, 'muntinlupa', '1234', 3, '90', '12/04/2019 06:48:48 pm', 2, NULL),
(125, 'nasugbu', '1234', 3, '91', '12/04/2019 06:48:48 pm', 2, NULL),
(126, 'navotas', '1234', 3, '92', '12/04/2019 06:48:48 pm', 2, NULL),
(127, 'negrosoccidental', '1234', 3, '93', '12/04/2019 06:48:48 pm', 2, NULL),
(128, 'norzagaray', '1234', 3, '94', '12/04/2019 06:48:48 pm', 2, NULL),
(129, 'noveleta', '1234', 3, '95', '12/04/2019 06:49:51 pm', 2, NULL),
(130, 'olongapo', '1234', 3, '96', '12/04/2019 06:49:51 pm', 2, NULL),
(131, 'orion', '1234', 3, '97', '12/04/2019 06:49:51 pm', 2, NULL),
(132, 'padregarcia', '1234', 3, '98', '12/04/2019 06:49:51 pm', 2, NULL),
(133, 'palayan', '1234', 3, '99', '12/04/2019 06:49:51 pm', 2, NULL),
(134, 'paraÃ±aque', '1234', 3, '100', '12/04/2019 06:49:51 pm', 2, NULL),
(135, 'pasay', '1234', 3, '101', '12/04/2019 06:49:51 pm', 2, NULL),
(136, 'pasig', '1234', 3, '102', '12/04/2019 06:49:51 pm', 2, NULL),
(137, 'pateros', '1234', 3, '103', '12/04/2019 06:49:51 pm', 2, NULL),
(138, 'pili', '1234', 3, '104', '12/04/2019 06:49:51 pm', 2, NULL),
(139, 'pioduran', '1234', 3, '105', '12/04/2019 06:49:51 pm', 2, NULL),
(140, 'plaridel/pulilan', '1234', 3, '106', '', 2, NULL),
(141, 'prietodiaz', '1234', 3, '107', '12/04/2019 06:51:46 pm', 2, NULL),
(142, 'pulangui', '1234', 3, '108', '12/04/2019 06:51:46 pm', 2, NULL),
(143, 'quezoncity', '1234', 3, '109', '12/04/2019 06:51:46 pm', 2, NULL),
(144, 'quezon', '1234', 3, '110', '12/04/2019 06:51:46 pm', 2, NULL),
(145, 'ramon', '1234', 3, '111', '12/04/2019 06:51:46 pm', 2, NULL),
(146, 'pantabangan', '1234', 3, '112', '12/04/2019 06:51:46 pm', 2, NULL),
(147, 'rodriguez', '1234', 3, '113', '12/04/2019 06:51:46 pm', 2, NULL),
(148, 'romblon', '1234', 3, '114', '12/04/2019 06:51:46 pm', 2, NULL),
(149, 'rosales', '1234', 3, '115', '12/04/2019 06:51:46 pm', 2, NULL),
(150, 'rosariob', '1234', 3, '116', '12/04/2019 06:51:46 pm', 2, NULL),
(151, 'rosarioc', '1234', 3, '117', '12/04/2019 06:53:04 pm', 2, NULL),
(152, 'rosariol', '1234', 3, '118', '12/04/2019 06:53:04 pm', 2, NULL),
(153, 'sancarlos', '1234', 3, '119', '12/04/2019 06:53:04 pm', 2, NULL),
(154, 'sanisidro', '1234', 3, '120', '12/04/2019 06:53:04 pm', 2, NULL),
(155, 'sanjuan', '1234', 3, '121', '12/04/2019 06:53:04 pm', 2, NULL),
(156, 'sanjuanb', '1234', 3, '122', '12/04/2019 06:53:04 pm', 2, NULL),
(157, 'sanluis', '1234', 3, '123', '12/04/2019 06:53:04 pm', 2, NULL),
(158, 'sanmanuel', '1234', 3, '124', '12/04/2019 09:15:02 pm', 2, NULL),
(159, 'sanmiguel', '1234', 3, '125', '12/04/2019 09:15:27 pm', 2, NULL),
(160, 'santiago', '1234', 3, '126', '12/04/2019 09:15:43 pm', 2, NULL),
(161, 'solano', '1234', 3, '127', '12/04/2019 09:15:57 pm', 2, NULL),
(162, 'sorsogon', '1234', 3, '128', '12/04/2019 09:16:10 pm', 2, NULL),
(163, 'staana', '1234', 3, '129', '12/04/2019 09:16:27 pm', 2, NULL),
(164, 'stacruz_is', '1234', 3, '130', '12/04/2019 09:16:46 pm', 2, NULL),
(165, 'stacruz', '1234', 3, '131', '12/04/2019 09:17:43 pm', 2, NULL),
(166, 'starosa', '1234', 3, '132', '12/04/2019 09:18:05 pm', 2, NULL),
(167, 'stotomas', '1234', 3, '133', '12/04/2019 09:18:26 pm', 2, NULL),
(168, 'subic', '1234', 3, '134', '12/04/2019 09:18:44 pm', 2, NULL),
(169, 'tabuk', '1234', 3, '135', '12/04/2019 09:18:57 pm', 2, NULL),
(170, 'tagaytay', '1234', 3, '136', '12/04/2019 09:19:05 pm', 2, NULL),
(171, 'taguig', '1234', 3, '137', '12/04/2019 09:19:13 pm', 2, NULL),
(172, 'tanauan', '1234', 3, '139', '12/04/2019 09:19:22 pm', 2, NULL),
(173, 'tanay', '1234', 3, '140', '12/04/2019 09:19:36 pm', 2, NULL),
(174, 'tarlac', '1234', 3, '141', '12/04/2019 09:19:46 pm', 2, NULL),
(175, 'tayabas', '1234', 3, '142', '12/04/2019 09:19:58 pm', 2, NULL),
(176, 'tayug', '1234', 3, '143', '12/04/2019 09:20:09 pm', 2, NULL),
(177, 'tuguegarao', '1234', 3, '144', '12/04/2019 09:20:22 pm', 2, NULL),
(178, 'umingan', '1234', 3, '145', '12/04/2019 09:20:22 pm', 2, NULL),
(179, 'valenzuela', '1234', 3, '146', '12/04/2019 09:20:46 pm', 2, NULL),
(180, 'vigan', '1234', 3, '147', '12/04/2019 09:20:59 pm', 2, NULL),
(181, 'villaverde', '1234', 3, '148', '12/04/2019 09:21:07 pm', 2, NULL),
(182, 'virac', '1234', 3, '149', '12/04/2019 09:21:17 pm', 2, NULL),
(183, 'caranglan', '1234', 3, '150', '12/05/2019 07:53:47 am', 2, NULL),
(184, 'bambang', '1234', 3, '151', '01/12/2020 04:59:51 pm', 2, NULL),
(186, 'sample', 'lovechrist', 2, '132', '', 1, NULL),
(187, 'olongapo5', '1234', 4, '96', '02/05/2020 09:01:53 pm', 1, NULL),
(188, 'cabiao', '1234', 2, '154', '', 1, NULL),
(189, 'calumpit', '1234', 2, '155', '', 1, NULL),
(190, 'binangonan', '1234', 2, '156', '', 1, NULL),
(191, 'rosales5', '1234', 4, '115', '', 1, NULL),
(192, 'pandi5', '1234', 4, '158', '', 1, NULL),
(193, 'mariveles5', '1234', 4, '85', '03/11/2020 03:03:20 pm', 1, NULL),
(194, 'sancarlos5', '1234', 4, '119', '03/11/2020 03:03:46 pm', 1, NULL),
(195, 'norzagaray5', '1234', 4, '94', '03/11/2020 03:08:59 pm', 1, NULL),
(196, 'sanildefonso5', '1234', 4, '125', '03/11/2020 03:09:14 pm', 1, NULL),
(197, 'sjdm5', '1234', 4, '157', '03/11/2020 03:09:36 pm', 1, NULL),
(198, 'angeles5', '1234', 4, '77', '03/11/2020 03:09:52 pm', 1, NULL),
(199, 'balanga5', '1234', 4, '19', '03/11/2020 03:10:45 pm', 1, NULL),
(200, 'cabanatuan5', '1234', 4, '32', '03/11/2020 03:11:26 pm', 1, NULL),
(201, 'munoz5', '1234', 4, '89', '03/11/2020 03:11:51 pm', 1, NULL),
(202, 'caranglan5', '1234', 4, '150', '03/11/2020 03:12:06 pm', 1, NULL),
(203, 'palayan5', '1234', 4, '99', '03/11/2020 03:12:30 pm', 1, NULL),
(204, 'tarlac5', '14234', 4, '141', '03/11/2020 03:12:42 pm', 1, NULL),
(205, 'sanmanuel5', '1234', 4, '124', '03/11/2020 03:12:54 pm', 1, NULL),
(206, 'camiling5', '1234', 4, '40', '03/11/2020 03:13:05 pm', 1, NULL),
(207, 'sannarciso5', '1234', 4, '159', '03/11/2020 03:15:01 pm', 1, NULL),
(208, 'magallanes5', '1234', 4, '78', '03/11/2020 03:15:15 pm', 1, NULL),
(209, 'noveleta5', '1234', 4, '95', '03/11/2020 03:15:30 pm', 1, NULL),
(210, 'morong5', '1234', 4, '88', '03/11/2020 03:15:44 pm', 1, NULL),
(211, 'jalajala5', '1234', 4, '64', '03/11/2020 03:15:55 pm', 1, NULL),
(212, 'atimonan5', '1234', 4, '160', '03/11/2020 03:16:52 pm', 1, NULL),
(213, 'lucban5', '1234', 4, '76', '03/11/2020 03:17:03 pm', 1, NULL),
(214, 'losbanos5', '1234', 4, '74', '03/11/2020 03:17:14 pm', 1, NULL),
(215, 'stacruz5', '1234', 4, '131', '03/11/2020 03:17:25 pm', 1, NULL),
(216, 'batangas5', '1234', 4, '25', '03/11/2020 03:17:36 pm', 1, NULL),
(217, 'lipa5', '1234', 4, '73', '03/11/2020 03:18:09 pm', 1, NULL),
(218, 'sanjuanb5', '1234', 4, '122', '03/11/2020 03:18:17 pm', 1, NULL),
(219, 'pateros5', '1234', 4, '103', '03/11/2020 03:18:31 pm', 1, NULL),
(220, 'laspinas5', '1234', 4, '69', '03/11/2020 03:18:42 pm', 1, NULL),
(221, 'taguig5', '1234', 4, '137', '03/11/2020 03:18:53 pm', 1, NULL),
(222, 'sanjuancity5', '1234', 4, '121', '03/11/2020 03:19:02 pm', 1, NULL),
(223, 'quezoncity5', '1234', 4, '109', '03/11/2020 03:19:13 pm', 1, NULL),
(224, 'caloocan5', '1234', 4, '161', '03/11/2020 03:19:58 pm', 1, NULL),
(225, 'drt', '1234', 2, '162', '03/11/2020 04:11:20 pm', 1, NULL),
(226, 'malolos', '1234', 2, '163', '03/11/2020 04:13:19 pm', 2, NULL),
(227, 'paombong', '1234', 2, '164', '03/11/2020 04:14:04 pm', 2, NULL),
(228, 'san miguel', '1234', 2, '165', '03/11/2020 04:14:29 pm', 2, NULL),
(229, 'marilao', '1234', 2, '166', '03/11/2020 04:14:45 pm', 2, NULL),
(230, 'stamaria', '1234', 2, '167', '03/11/2020 04:14:55 pm', 2, NULL),
(231, 'plaridel', '1234', 2, '168', '03/11/2020 04:15:19 pm', 2, NULL),
(232, 'angat', '1234', 2, '169', '03/11/2020 04:15:53 pm', 2, NULL),
(233, 'hagonoy', '1234', 2, '170', '03/11/2020 04:16:08 pm', 2, NULL),
(234, 'pulilan', '1234', 2, '171', '03/11/2020 04:16:17 pm', 2, NULL),
(235, 'mabalacat', '1234', 2, '172', '03/11/2020 04:16:32 pm', 2, NULL),
(236, 'arayat', '1234', 2, '173', '03/11/2020 04:16:44 pm', 2, NULL),
(237, 'sta. ana', '1234', 2, '174', '03/11/2020 04:17:04 pm', 2, NULL),
(238, 'san pablo', '1234', 2, '175', '03/11/2020 04:17:17 pm', 2, NULL),
(239, 'san luis', '1234', 2, '176', '03/11/2020 04:17:30 pm', 2, NULL),
(240, 'minalin', '1234', 2, '177', '03/11/2020 04:17:43 pm', 2, NULL),
(241, 'apalit', '1234', 2, '178', '03/11/2020 04:18:01 pm', 2, NULL),
(242, 'porac', '1234', 2, '179', '03/11/2020 04:18:31 pm', 2, NULL),
(243, 'floridablanca', '1234', 2, '180', '03/11/2020 04:19:05 pm', 2, NULL),
(244, 'san fernando', '1234', 2, '181', '03/11/2020 04:19:24 pm', 2, NULL),
(245, 'magalang', '1234', 2, '182', '03/11/2020 04:19:48 pm', 2, NULL),
(246, 'sto. tomas', '1234', 2, '183', '03/11/2020 04:20:51 pm', 2, NULL),
(247, 'guagua', '1234', 2, '184', '03/11/2020 04:21:05 pm', 2, NULL),
(248, 'bacolor', '1234', 2, '185', '03/11/2020 04:21:15 pm', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`Area_id` int(11) NOT NULL,
  `locations` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`Area_id`, `locations`) VALUES
(1, '4B'),
(2, '3C'),
(3, '5F-C'),
(4, '4C'),
(5, 'FTA-CORNER'),
(6, '4A'),
(7, '3A/3B'),
(8, '2FA'),
(9, '5F-D');

-- --------------------------------------------------------

--
-- Table structure for table `baptism_rpt`
--

CREATE TABLE IF NOT EXISTS `baptism_rpt` (
`baptism_id` int(11) NOT NULL,
  `FullName` varchar(225) NOT NULL,
  `ContactNumber` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `date_baptize` varchar(225) NOT NULL,
  `contactstatus_id` varchar(225) NOT NULL,
  `shepmaterial` varchar(225) NOT NULL,
  `curteam_id` varchar(225) NOT NULL,
  `acc_id` varchar(225) NOT NULL,
  `gender` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `baptism_rpt`
--

INSERT INTO `baptism_rpt` (`baptism_id`, `FullName`, `ContactNumber`, `address`, `date_baptize`, `contactstatus_id`, `shepmaterial`, `curteam_id`, `acc_id`, `gender`) VALUES
(6, 'Micho Robledo', '093471122211', 'Gapan city, valley 1', '01/07/2020', '4', 'Life Study chp.1', '9', '187', '1'),
(7, 'John Victor Liwah', '093471122211', 'Gapan city, valley 1', '02/13/2020', '2', 'Life Study chp.1', '8', '186', '1'),
(8, 'John Victor Liwah', '09304531711', 'Gapan city, valley 1', '02/15/2020', '3', 'Life Study chp.1', '9', '187', '1'),
(9, 'Jose Rizal Potasio', '09304531711', 'Navotas city,district 4', '01/19/1997', '2', 'MHL', '8', '186', '1'),
(11, 'Micho Robledo', '09304531711', 'Gapan city, valley 1', '03/18/2020', '2', 'MHL', '10', '38', '1'),
(12, 'Micho Robledo', '09304531711', 'Gapan city, valley 1', '03/18/2020', '2', 'MHL', '10', '38', '2');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
`ID` int(11) NOT NULL,
  `BATCH` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`ID`, `BATCH`) VALUES
(1, '64th'),
(2, '66th'),
(3, '67th'),
(4, '65th');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`ID` int(11) NOT NULL,
  `FT` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`ID`, `FT`) VALUES
(1, 'FT1'),
(2, 'FT2'),
(3, 'FT3'),
(4, 'FT4');

-- --------------------------------------------------------

--
-- Table structure for table `contactstatus`
--

CREATE TABLE IF NOT EXISTS `contactstatus` (
`ID` int(11) NOT NULL,
  `saints_legend` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactstatus`
--

INSERT INTO `contactstatus` (`ID`, `saints_legend`) VALUES
(1, 'JUNIOR YP-HIGH SCHOOL'),
(2, 'YP-COLLEGE'),
(3, 'YOUNG WORKING -(21-35)'),
(4, 'MATURE WORKING - (36-50)'),
(5, 'MIDDLE AGE - (51-65)'),
(6, 'ELDERLY SAINT');

-- --------------------------------------------------------

--
-- Table structure for table `contatcdetails`
--

CREATE TABLE IF NOT EXISTS `contatcdetails` (
`contact_id` int(11) NOT NULL,
  `FullName` varchar(225) NOT NULL,
  `ContactNumber` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `contactstatus_id` varchar(225) NOT NULL,
  `shepmaterial` varchar(225) NOT NULL,
  `curteam_id` varchar(225) NOT NULL,
  `acc_id` varchar(225) NOT NULL,
  `gender` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contatcdetails`
--

INSERT INTO `contatcdetails` (`contact_id`, `FullName`, `ContactNumber`, `address`, `contactstatus_id`, `shepmaterial`, `curteam_id`, `acc_id`, `gender`) VALUES
(51, 'Micho Robledo', '09304531711', 'Gapan city, valley 1', '1', '', '65', '186', '1'),
(56, 'Micho Robledo', '09304531711', 'Gapan city, valley 1', '3', '', '70', '38', '1');

-- --------------------------------------------------------

--
-- Table structure for table `control_rec`
--

CREATE TABLE IF NOT EXISTS `control_rec` (
`control_rec_id` int(11) NOT NULL,
  `list` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `control_rec`
--

INSERT INTO `control_rec` (`control_rec_id`, `list`) VALUES
(1, 'ABLE'),
(2, 'DISABLED');

-- --------------------------------------------------------

--
-- Table structure for table `current_teamdata`
--

CREATE TABLE IF NOT EXISTS `current_teamdata` (
`c_team_id` int(11) NOT NULL,
  `Month_id` varchar(225) NOT NULL,
  `Year_id` varchar(225) NOT NULL,
  `batch_id` varchar(225) NOT NULL,
  `userlevel_id` varchar(225) NOT NULL,
  `control_data` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_teamdata`
--

INSERT INTO `current_teamdata` (`c_team_id`, `Month_id`, `Year_id`, `batch_id`, `userlevel_id`, `control_data`) VALUES
(9, '4', '5', '3', '4', '2'),
(11, '5', '5', '3', '2', '2'),
(12, '3', '5', '2', '3', '2');

-- --------------------------------------------------------

--
-- Table structure for table `establish_dist`
--

CREATE TABLE IF NOT EXISTS `establish_dist` (
`est_id` int(11) NOT NULL,
  `establishname` varchar(225) NOT NULL,
  `dateestablish` text NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `establish_dist`
--

INSERT INTO `establish_dist` (`est_id`, `establishname`, `dateestablish`, `acc_id`, `historyfeedback`) VALUES
(17, 'Micho Robledos', '03/10/2020', 38, 70);

-- --------------------------------------------------------

--
-- Table structure for table `establish_local`
--

CREATE TABLE IF NOT EXISTS `establish_local` (
`localest_id` int(11) NOT NULL,
  `local_name` varchar(225) NOT NULL,
  `date_establish` text NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `establish_local`
--

INSERT INTO `establish_local` (`localest_id`, `local_name`, `date_establish`, `acc_id`, `historyfeedback`) VALUES
(5, 'san juan ', '03/03/2020', 38, 70);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
`id` int(11) NOT NULL,
  `MONTH` int(225) NOT NULL,
  `YEAR` int(225) NOT NULL,
  `BATCH` int(225) NOT NULL,
  `WEEK` int(225) NOT NULL,
  `acc_id` int(225) NOT NULL,
  `date_started` varchar(225) NOT NULL,
  `status_id` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `MONTH`, `YEAR`, `BATCH`, `WEEK`, `acc_id`, `date_started`, `status_id`) VALUES
(22, 3, 5, 1, 3, 2, '2020-02-22 21:07:02', 2),
(23, 3, 5, 1, 1, 2, '2020-02-22 21:08:28', 2),
(24, 5, 5, 3, 2, 2, '2020-03-03 18:53:15', 2),
(25, 5, 5, 3, 4, 2, '2020-03-04 12:46:26', 2),
(26, 5, 5, 3, 3, 4, '2020-03-06 08:13:27', 2),
(27, 3, 5, 3, 1, 2, '2020-03-10 13:13:31', 2),
(29, 3, 5, 3, 3, 2, '03/10/2020 01:27:21 pm', 2),
(30, 3, 5, 3, 1, 3, '03/14/2020 06:31:47 pm', 2),
(31, 3, 5, 3, 3, 3, '03/14/2020 08:38:17 pm', 2),
(32, 3, 5, 3, 4, 3, '03/14/2020 08:38:37 pm', 2),
(33, 3, 5, 3, 5, 3, '03/15/2020 12:41:21 pm', 2);

-- --------------------------------------------------------

--
-- Table structure for table `historyfeedback`
--

CREATE TABLE IF NOT EXISTS `historyfeedback` (
`id` int(11) NOT NULL,
  `MONTH` int(225) NOT NULL,
  `YEAR` int(225) NOT NULL,
  `BATCH` int(225) NOT NULL,
  `WEEK` int(225) NOT NULL,
  `acc_id` int(225) NOT NULL,
  `date_started` varchar(225) NOT NULL,
  `status_id` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `historyfeedback`
--

INSERT INTO `historyfeedback` (`id`, `MONTH`, `YEAR`, `BATCH`, `WEEK`, `acc_id`, `date_started`, `status_id`) VALUES
(48, 3, 5, 2, 1, 3, '2019-12-04 07:05:00', 2),
(64, 5, 5, 3, 3, 2, '2020-03-03 18:53:15', 1),
(66, 5, 5, 3, 3, 4, '2020-03-06 08:13:27', 1),
(68, 3, 5, 3, 3, 3, '03/14/2020 08:38:17 pm', 1),
(69, 3, 5, 3, 4, 3, '03/14/2020 08:38:37 pm', 1),
(70, 3, 5, 3, 5, 3, '03/15/2020 12:41:21 pm', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locality`
--

CREATE TABLE IF NOT EXISTS `locality` (
`ID` int(11) NOT NULL,
  `PLACES` varchar(225) NOT NULL,
  `Region_id` varchar(225) NOT NULL,
  `area_id` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locality`
--

INSERT INTO `locality` (`ID`, `PLACES`, `Region_id`, `area_id`) VALUES
(4, 'ABRA', '1', '2'),
(5, 'ABRA DE ILOG, OCCIDENTAL MINDORO', '1', '4'),
(6, 'AGUINALDO, CAVITE', '1', '4'),
(7, 'AKLAN', '1', '4'),
(8, 'ALAMINOS, PANGASINAN', '1', '4'),
(9, 'AMULUNG, CAGAYAN', '1', '4'),
(10, 'ANAO/RAMOS, TARLAC', '1', '4'),
(11, 'ANTIPOLO, RIZAL', '4', '4'),
(12, 'ANTIQUE', '1', '4'),
(13, 'APALIT/ MINALIN, PAMPANGA', '3', '4'),
(14, 'ATIMONAN/ GUMACA/ PLARIDEL, QUEZON', '2', '4'),
(15, 'BACOLOD CITY', '4', '2'),
(16, 'BADOC, ILOCOS NORTE', '1', '4'),
(17, 'BAGAMANOC, CATANDUANES', '2', '4'),
(18, 'BAGUIO, BENGUET', '4', '5'),
(19, 'BALANGA, BATAAN', '5', '2'),
(20, 'BALER, AURORA', '1', '1'),
(21, 'BANAUE, IFUGAO', '2', '4'),
(22, 'BANI, PANGASINAN', '1', '3'),
(23, 'BARAS, RIZAL', '4', '4'),
(24, 'BATAC, ILOCOS NORTE', '1', '5'),
(25, 'BATANGAS CITY, BATANGAS', '3', '5'),
(26, 'BAYOMBONG, NUEVA VIZCAYA', '1', '5'),
(27, 'BIÃ‘AN, LAGUNA', '4', '5'),
(28, 'BONGABON, NUEVA ECIJA', '3', '5'),
(29, 'BONTOC, MOUNTAIN PROVINCE', '1', '5'),
(30, 'BOTOLAN, ZAMBALES', '3', '2'),
(31, 'CABAGAN, ISABELA', '1', '5'),
(32, 'CABANATUAN, NUEVA ECIJA', '1', '5'),
(33, 'CABANGAN/ SAN NARCISO, ZAMBALES', '2', '5'),
(34, 'CABUYAO, LAGUNA', '4', '5'),
(35, 'CAINTA, RIZAL', '4', '4'),
(36, 'CALABANGA, CAMARINES SUR', '1', '4'),
(37, 'CALAMBA, LAGUNA', '4', '5'),
(38, 'CALOOCAN (NORTH)', '8', '7'),
(39, 'CALOOCAN (SOUTH)', '8', '7'),
(40, 'CAMILING/ STA. IGNACIA, TARLAC', '1', '4'),
(41, 'CASIGURAN, AURORA', '1', '2'),
(42, 'CASTILLEJOS, ZAMBALES', '3', '2'),
(43, 'CATANAUAN, QUEZON', '1', '2'),
(44, 'CAUAYAN, ISABELA', '1', '5'),
(45, 'DAET, CAMARINES NORTE', '1', '2'),
(46, 'DASMARIÃ‘AS, CAVITE', '4', '4'),
(47, 'DIFFUN, QUIRINO', '1', '2'),
(48, 'DINALUNGAN/ DILASAG, AURORA', '1', '4'),
(49, 'DINALUPIHAN, BATAAN', '1', '2'),
(50, 'DINGRAS, ILOCOS NORTE', '1', '5'),
(51, 'DIPACULAO, AURORA', '1', '5'),
(52, 'DOÃ‘A REMEDIOS TRINIDAD/ ANGAT, BULACAN', '1', '2'),
(53, 'DUPAX DEL NORTE, NUEVA VIZCAYA', '1', '1'),
(54, 'GAPAN, NUEVA ECIJA', '3', '1'),
(56, 'GOA, CAMARINES SUR', '1', '4'),
(57, 'HERMOSA, BATAAN', '1', '2'),
(58, 'HUNGDUAN, IFUGAO', '1', '5'),
(59, 'IBA, ZAMBALES', '1', '4'),
(60, 'ILAGAN, ISABELA', ' 1', '4'),
(61, 'ILOILO/GUIMARAS', '44', '2'),
(62, 'IRIGA, CAMARINES SUR', '2', '1'),
(63, 'ITOGON, BENGUET', ' 1', '4'),
(64, 'JALA JALA, RIZAL', '4', '4'),
(65, 'KAPANGAN, BENGUET', '2', '4'),
(66, 'KASIBU, NUEVA VIZCAYA', ' 1', '4'),
(67, 'LA TRINIDAD, BENGUET', ' 1', '2'),
(68, 'LAMUT, IFUGAO', '2', '2'),
(69, 'LAS PIÃ‘AS CITY', '6', '4'),
(70, 'LEGASPI, ALBAY', '1', '4'),
(71, 'LIMAY, BATAAN', '3', '2'),
(72, 'LINGAYEN, PANGASINAN', ' 1', '4'),
(73, 'LIPA, BATANGAS', ' 1', '4'),
(74, 'LOS BAÃ‘OS, LAGUNA', ' 1', '4'),
(75, 'LUBAO/ FLORIDA/ GUAGUA, PAMPANGA', ' 1', '4'),
(76, 'LUCBAN, QUEZON', '5', '4'),
(77, 'ANGELES CITY, PAMPANGA ', '3', '1'),
(78, 'MAGALLANES, CAVITE', '4', '1'),
(79, 'MAGSINGAL, ILOCOS SUR', '3', '2'),
(80, 'MALABON CITY', '2', '3'),
(81, 'MALLIG, ISABELA', ' 1', '4'),
(82, 'MALOLOS/ CALUMPIT/ HAGONOY, BULACAN', '2', '4'),
(83, 'MAMBURAO, OCCIDENTAL MINDORO', ' 1', '2'),
(84, 'MANDALUYONG CITY', '8', '6'),
(85, 'MARIVELES, BATAAN', '5', '1'),
(86, 'MASBATE', '4', '2'),
(87, 'MEXICO, PAMPANGA', '3', '1'),
(88, 'MORONG, RIZAL', '2', '4'),
(89, 'MUÃ‘OZ, NUEVA ECIJA', ' 1', '2'),
(90, 'MUNTINLUPA', '2', '4'),
(91, 'NASUGBU, BATANGAS', '4', '5'),
(92, 'NAVOTAS CITY', '8', '7'),
(93, 'NEGROS OCCIDENTAL', ' 1', '4'),
(94, 'NORZAGARAY, BULACAN', '3', '3'),
(95, 'NOVELETA, CAVITE', ' 1', '4'),
(96, 'OLONGAPO, ZAMBALES', '4', '4'),
(97, 'ORION, BATAAN', '2', '4'),
(98, 'PADRE GARCIA, BATANGAS', '1', '4'),
(99, 'PALAYAN CITY, NUEVA ECIJA', '2', '4'),
(100, 'PARAÃ‘AQUE CITY', '1', '4'),
(101, 'PASAY CITY', '8', '6'),
(102, 'PASIG CITY', '2', '2'),
(103, 'PATEROS CITY', '1', '4'),
(104, 'PILI, CAMARINES SUR', '4', '2'),
(105, 'PIO DURAN, ALBAY', '2', '1'),
(106, 'PLARIDEL/ PULILAN/ BALIUAG, BULACAN', '2', '4'),
(107, 'PRIETO DIAZ, SORSOGON', '4', '2'),
(108, 'PULANGUI, ALBAY', '5', '4'),
(109, 'QUEZON CITY', '3', '4'),
(110, 'QUEZON, NUEVA VIZCAYA', ' 4', '4'),
(111, 'RAMON, ISABELA', ' 3', '5'),
(112, 'RIZAL/ PANTABANGAN/ LLANERA (Cluster 5), NUEVA ECIJA', '2', '4'),
(113, 'RODRIGUEZ, RIZAL', '4', '4'),
(114, 'ROMBLON', '3', '4'),
(115, 'ROSALES, PANGASINAN', '1', '2'),
(116, 'ROSARIO, BATANGAS', ' ', '2'),
(117, 'ROSARIO, CAVITE', '2', '1'),
(118, 'ROSARIO, LA UNION', '2', '4'),
(119, 'SAN CARLOS, PANGASINAN', '1', '2'),
(120, 'SAN ISIDRO, ISABELA', '4', '5'),
(121, 'SAN JUAN CITY', '5', '2'),
(122, 'SAN JUAN, BATANGAS', ' 1', '4'),
(123, 'SAN LUIS/ SAN SIMON, PAMPANGA', ' 1', '5'),
(124, 'SAN MANUEL, TARLAC', ' 1', '2'),
(125, 'SAN ILDEFONSO, BULACAN', '3', '3'),
(126, 'SANTIAGO CITY, ISABELA', '6', '4'),
(127, 'SOLANO, NUEVA VIZCAYA', '3', '4'),
(128, 'SORSOGON CITY, SORSOGON', '2', '4'),
(129, 'STA. ANA/ ARAYAT, PAMPANGA', '4', '4'),
(130, 'STA. CRUZ, ILOCOS SUR', ' 1', '4'),
(131, 'STA. CRUZ, LAGUNA', '2', '4'),
(132, 'STA. ROSA, LAGUNA', '4', '5'),
(133, 'STO. TOMAS/ BACOLOR, PAMPANGA', '1', '4'),
(134, 'SUBIC, ZAMBALES', '3', '2'),
(135, 'TABUK, KALINGA', '3', '4'),
(136, 'TAGAYTAY, CAVITE', '4', '4'),
(137, 'TAGUIG CITY', '5', '4'),
(139, 'TANAUAN, BATANGAS', ' 1', '4'),
(140, 'TANAY, RIZAL', '2', '5'),
(141, 'TARLAC CITY, TARLAC', '3', '4'),
(142, 'TAYABAS, QUEZON', '4', '4'),
(143, 'TAYUG, PANGASINAN', '5', '4'),
(144, 'TUGUEGARAO, CAGAYAN', '4', '1'),
(145, 'UMINGAN, PANGASINAN', '3', '2'),
(146, 'VALENZUELA CITY', '8', '7'),
(147, 'VIGAN, ILOCOS SUR', '1', '5'),
(148, 'VILLAVERDE, NUEVA VIZCAYA', ' 1', '4'),
(149, 'VIRAC, CATANDUANES', '4', '4'),
(150, 'CARANGLAN, NUEVA ECIJA', '3', '4'),
(151, 'BAMBANG, NUEVA VIZCAYA', '2', '4'),
(153, 'ACACIA, MALABON', ' 1', '4'),
(154, 'CABIAO, NUEVA ECIJA', '3', '1'),
(155, 'CALUMPIT, BULACAN', '3', '3'),
(156, 'BINANGONAN, RIZAL', '4', '4'),
(157, 'SAN JOSE DEL MONTE, BULACAN', '3', '3'),
(158, 'PANDI, BULACAN', '3', '3'),
(159, 'SAN NARCISO, ZAMBALES', '3', '2'),
(160, 'ATIMONAN, QUEZON PROVINCE', '4', '4'),
(161, 'CALOOCAN CITY', '8', '6'),
(162, 'DOÃ‘A REMEDIOS TRINIDAD, BULACAN', '3', '3'),
(163, 'MALOLOS, BULACAN', '3', '3'),
(164, 'PAOMBONG, BULACAN', '3', '3'),
(165, 'SAN MIGUEL, BULACAN', '3', '3'),
(166, 'MARILAO, BULACAN', '3', '3'),
(167, 'STA. MARIA, BULACAN', '3', '3'),
(168, 'PLARIDEL, BULACAN', '3', '3'),
(169, 'ANGAT, BULACAN', '3', '3'),
(170, 'HAGONOY, BULACAN', '3', '3'),
(171, 'PULILAN/ BALIUAG, BULACAN', '3', '3'),
(172, 'MABALACAT, PAMPANGA', '3', '1'),
(173, 'ARAYAT, PAMPANGA', '3', '1'),
(174, 'STA. ANA, PAMPANGA', '3', '1'),
(175, 'SAN PABLO, PAMPANGA', '3', '1'),
(176, 'SAN LUIS, PAMPANGA', '3', '1'),
(177, 'MINALIN, PAMPANGA', '3', '1'),
(178, 'APALIT, PAMPANGA', '3', '1'),
(179, 'PORAC, PAMPANGA', '3', '1'),
(180, 'FLORIDABLANCA, PAMPANGA', '3', '1'),
(181, 'SAN FERNANDO, PAMPANGA', '3', '1'),
(182, 'MAGALANG, PAMPANGA', '3', '1'),
(183, 'STO. TOMAS, PAMPANGA', '3', '1'),
(184, 'GUAGUA, PAMPANGA', '3', '1'),
(185, 'BACOLOR, PAMPANGA', '3', '1'),
(186, 'LUBAO, PAMPANGA', '3', '1'),
(187, 'SAN SIMON, PAMPANGA', '3', '1'),
(188, 'VICTORIA, TARLAC', '3', '2'),
(189, 'ANAO, TARLAC', '3', '2'),
(190, 'STO. DOMINGO, NUEVA ECIJA', '3', '1'),
(191, 'LICAB, NUEVA ECIJA', '3', '1'),
(192, 'ALIAGA, NUEVA ECIJA', '3', '1'),
(193, 'CABANGAN, ZAMBALES', '3', '2'),
(194, 'GEN. TRIAS, CAVITE', '4', '4'),
(195, 'ALAMINOS, LAGUNA', '4', '5'),
(196, 'TAYTAY, RIZAL', '4', '4'),
(197, 'TERESA, RIZAL', '4', '4'),
(198, 'MANILA CITY', '8', '6'),
(199, 'MAKATI CITY', '8', '6');

-- --------------------------------------------------------

--
-- Table structure for table `longproprpt`
--

CREATE TABLE IF NOT EXISTS `longproprpt` (
`longproprpt_id` int(11) NOT NULL,
  `contact_id` varchar(225) NOT NULL,
  `historyfeedback_id` varchar(225) NOT NULL,
  `acc_id` varchar(225) NOT NULL,
  `Sun_LD` varchar(225) NOT NULL,
  `Week_ONE` varchar(225) NOT NULL,
  `Week_TWO` varchar(225) NOT NULL,
  `Week_THREE` varchar(225) NOT NULL,
  `Week_FOUR` varchar(225) NOT NULL,
  `Week_FIVE` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `longprop_feedback`
--

CREATE TABLE IF NOT EXISTS `longprop_feedback` (
`id` int(11) NOT NULL,
  `MONTH` int(6) NOT NULL,
  `YEAR` int(6) NOT NULL,
  `BATCH` int(6) NOT NULL,
  `WEEK` int(6) NOT NULL,
  `acc_id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monitored_contact`
--

CREATE TABLE IF NOT EXISTS `monitored_contact` (
`mon_id` int(11) NOT NULL,
  `contact_id` varchar(225) NOT NULL,
  `historyfeedback` varchar(225) NOT NULL,
  `acc_id` varchar(225) NOT NULL,
  `day_one` varchar(225) NOT NULL,
  `day_two` varchar(225) NOT NULL,
  `day_three` varchar(225) NOT NULL,
  `day_four` varchar(225) NOT NULL,
  `day_five` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monitored_contact`
--

INSERT INTO `monitored_contact` (`mon_id`, `contact_id`, `historyfeedback`, `acc_id`, `day_one`, `day_two`, `day_three`, `day_four`, `day_five`) VALUES
(1, '16', '63', '186', '1', '2', '1', '', ''),
(2, '16', '62', '186', '2', '1', '2', '', ''),
(3, '19', '57', '185', '2', '2', '1', '', ''),
(4, '16', '62', '186', '2', '2', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE IF NOT EXISTS `month` (
`ID` int(11) NOT NULL,
  `MONTH` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`ID`, `MONTH`) VALUES
(6, 'APRIL'),
(4, 'FEBRUARY'),
(3, 'JANUARY'),
(5, 'MARCH'),
(7, 'MAY');

-- --------------------------------------------------------

--
-- Table structure for table `prospect_train`
--

CREATE TABLE IF NOT EXISTS `prospect_train` (
`pros_id` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Status` int(2) NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL,
  `date_prospect` text NOT NULL,
  `cellphone` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prospect_train`
--

INSERT INTO `prospect_train` (`pros_id`, `Name`, `Status`, `acc_id`, `historyfeedback`, `date_prospect`, `cellphone`) VALUES
(1, 'Mark Noven Tanque', 1, 50, 48, '01/12/2020 02:00:39 pm', '0'),
(2, 'Shullamite Pelarion', 2, 50, 48, '01/12/2020 02:00:56 pm', '0'),
(4, 'Ronell Bulgar', 1, 103, 48, '01/12/2020 02:22:26 pm', '1'),
(5, 'Hayrine Garcia', 2, 73, 48, '01/12/2020 04:42:44 pm', '0'),
(6, 'Christian Era', 1, 73, 48, '01/12/2020 04:43:13 pm', '0'),
(7, 'ANGINETTE UTLEG', 2, 85, 48, '01/12/2020 05:21:28 pm', '0'),
(8, 'Radel Rico', 1, 75, 48, '01/12/2020 05:34:00 pm', '0'),
(9, 'Dan Marck Sumaong', 1, 75, 48, '01/12/2020 05:34:53 pm', '0'),
(10, 'Mary Grace Manlupig ', 2, 171, 48, '01/12/2020 05:54:25 pm', '0'),
(11, 'Abigael Perez', 2, 88, 48, '01/12/2020 05:55:50 pm', '0'),
(12, 'Mark Matados', 1, 166, 48, '01/12/2020 08:25:24 pm', '0'),
(13, 'unkown', 1, 166, 48, '01/12/2020 08:25:36 pm', '0'),
(14, 'Lloyd Mark Ordonio', 1, 160, 48, '01/12/2020 08:46:29 pm', '2147483647'),
(15, 'Robert John Parthe', 1, 106, 48, '01/13/2020 11:38:57 am', '2147483647'),
(16, 'brother 1', 1, 177, 48, '01/13/2020 06:35:33 pm', '0'),
(17, 'brother 2', 1, 177, 48, '01/13/2020 06:36:03 pm', '0'),
(18, 'brother 1', 1, 66, 48, '01/13/2020 06:37:55 pm', '0'),
(19, 'sister 1', 2, 66, 48, '01/13/2020 06:38:51 pm', '0'),
(20, 'Marry Mae', 2, 152, 48, '01/13/2020 06:40:10 pm', '0'),
(21, 'Brother1', 1, 136, 48, '01/16/2020 08:52:18 am', '0'),
(23, 'sister1', 2, 136, 48, '01/16/2020 09:08:29 am', '0'),
(24, 'sister2', 2, 136, 48, '01/16/2020 09:08:43 am', '0'),
(25, 'Sister3', 2, 136, 48, '01/16/2020 09:09:18 am', '0'),
(26, 'Sister4', 2, 136, 48, '01/16/2020 09:10:03 am', '0'),
(27, 'sister 5', 2, 136, 48, '01/16/2020 09:10:23 am', '0');

-- --------------------------------------------------------

--
-- Table structure for table `recoverlocal`
--

CREATE TABLE IF NOT EXISTS `recoverlocal` (
`recover_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `daterecover` text NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recoverlocal`
--

INSERT INTO `recoverlocal` (`recover_id`, `name`, `daterecover`, `acc_id`, `historyfeedback`) VALUES
(1, 'Church in Rosario', '01-05-2020', 151, 48),
(2, 'Botolan', '01-12-2020', 65, 48);

-- --------------------------------------------------------

--
-- Table structure for table `recoversaints`
--

CREATE TABLE IF NOT EXISTS `recoversaints` (
`rec_id` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Status` int(2) NOT NULL,
  `Home_address` varchar(225) NOT NULL,
  `cellphone` varchar(12) NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL,
  `Date_recovered` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recoversaints`
--

INSERT INTO `recoversaints` (`rec_id`, `Name`, `Status`, `Home_address`, `cellphone`, `acc_id`, `historyfeedback`, `Date_recovered`) VALUES
(1, 'julie canillo', 2, 'HANDUMANAN BACOLOD CITY', '2147483647', 50, 48, '01-10-2020'),
(2, 'Fenifer Canillo', 2, 'Handumanan Bacolod City', '2147483647', 50, 0, '01-10-2020'),
(3, 'Caroline Desabille', 2, '', '1', 119, 48, '01-12-2020'),
(4, 'Caroline Floralde', 2, 'China St., Brgy. Binagbag, Angat', '2147483647', 37, 48, '12-22-2019'),
(5, 'Rogelio Duka', 1, 'Nalubbunan Quezon', '2147483647', 144, 0, '12-21-2019'),
(6, 'Pinky Palete', 2, 'Nalubbunan Quezon', '1', 144, 48, '12-14-2019'),
(7, 'Shalyn Asiong', 2, '', '0', 42, 48, '01-05-2020'),
(8, 'Myla Dizon', 2, 'San Miguel, Bulacan', '2147483647', 159, 0, '12-15-2019'),
(9, 'Veron', 2, 'Tacay road, Pinsao proper, Baguio city', '0', 38, 48, '01-08-2020'),
(10, 'Lucio quimiguing', 1, '#22 emerald street, odelco subd., Brgy. San Bartolome, Quezon City', '9', 143, 48, '01-12-2020'),
(13, 'Roland Benlot', 1, 'Itogon', '0', 96, 48, '01-05-2020'),
(14, 'Mae Ann Benlot', 2, 'Itogon', '0', 96, 48, '01-05-2020'),
(15, 'Honey Estrada', 2, 'Rockville Quezon City', '9', 143, 0, '01-26-2020'),
(16, 'Mary grace maralas', 2, 'T.S Cruz quezon city', '9', 143, 0, '01-12-2020'),
(17, 'Peter Marston', 2, 'Dormitory Quezon City', '9', 143, 0, '01-05-2020'),
(18, 'Jm espra', 1, '#22 emerald street, odelco subd., Brgy. San Bartolome, Quezon City', '9', 143, 0, '01-05-2020'),
(19, 'Johann Estrada', 1, 'Rockville Quezon City', '9', 143, 0, '11-24-2019'),
(20, 'Michelle Chavez', 2, 'Damong maliit ,Quezon City', '9', 143, 0, '12-29-2019'),
(21, 'Levy Lumontod', 1, 'Dormitory Quezon City', '9', 143, 0, '01-12-2020'),
(22, 'Kastria Bravo', 2, 'Laya, Tabuk City, Kalinga', '0', 169, 48, '12-22-2019'),
(23, 'Glomarie Aquino', 2, 'Block 5 Purok Murmuray, Tabuk City, Kalinga', '639', 169, 48, '12-22-2019'),
(24, 'Hallie Mae Pajarillo', 2, 'Laya, Tabuk City, Kalinga', '639', 169, 48, '12-22-2019'),
(25, 'Gretchen Saflor', 2, 'Laya East, Tabuk City, Kalinga', '639', 169, 48, '12-22-2019'),
(26, 'Cindy Pearl Labbutan', 2, 'Riverside, Socbot, Pinukpuk, Kalinga', '639', 169, 48, '01-05-2020'),
(27, 'Santiago lagrimas', 1, 'MALACAMPA,CAMILING TARLAC', '0', 75, 48, '12-14-19'),
(28, 'Mary jane bermido', 2, 'Kabihasnan', '2147483647', 102, 48, '12-31-19'),
(32, 'Estrilla Gabaon', 2, 'Agbannawag, Rizal, Nueva Ecija', '0', 146, 48, '12-27-2019'),
(33, 'Luz ', 2, 'Agbannawag, Rizal, Nueva Ecija', '0', 146, 48, '12-27-2019'),
(34, 'Jonah Gabaon', 2, 'Agbannawag, Rizal, Nueva Ecija', '0', 146, 0, '12-27-2019'),
(35, 'Auring ', 2, 'Agbannawag, Nueva Ecija', '0', 146, 0, '12-15-2019'),
(36, 'Princess Gabaon', 1, 'Agbannawag, Rizal Nueva Ecija', '0', 146, 0, '01-06-2019'),
(37, 'Jennifer Napay', 2, 'Marinig', '2147483647', 69, 48, '12-17-2019'),
(38, 'Grace Pelangco', 2, 'Southville I-A', '2147483647', 69, 48, '12-30-2019'),
(39, 'Jody Laudicho', 2, 'Southville I', '2147483647', 69, 48, '12-29-2019'),
(40, 'Juvy Balansag', 2, 'St. Joseph 7', '2147483647', 69, 48, '12-22-2019'),
(41, 'Ginalyn Apostol', 2, 'St. Joseph 7', '2147483647', 69, 48, '12-29-2019'),
(42, 'Glenn Apostol', 2, 'Southville ', '2147483647', 69, 48, '12-29-2019'),
(43, 'Zoe Pagaduan', 2, 'Paraiso, Cauayan City', '0', 79, 48, '12-10-2019'),
(44, 'Joshua ', 1, 'Paraiso, Cauayan City', '9', 79, 0, '01-12-2020'),
(45, 'Peter Paul Ruelles', 1, '4th Estate,Area 7 PARAÃ‘AQUE City', '0', 134, 48, '12-29-2019'),
(46, 'Edgar Enriquez', 1, 'Marcos Village, Palayan City', '2147483647', 133, 0, '01-07-2020'),
(47, 'Sheryl ', 2, 'San Antonio, La Huerta, ParaÃ±aque City', '0', 134, 48, '12-22-2019'),
(48, 'Lydia Catalan', 2, 'BF, ParaÃ±aque City', '0', 134, 48, '12-22-2019'),
(49, 'Sarah Capingian', 2, 'Marcos Village, Palayan City', '2147483647', 133, 0, '01-09-2020'),
(50, 'Lymee Garcia', 2, 'BF, ParaÃ±aque City', '0', 134, 48, '12-22-2019'),
(51, 'Camille Fernando', 2, 'Luz Limay, Bataan', '0', 104, 48, '12-15-2019'),
(52, 'Eiyna Jane', 2, '4th Estate, Area 7, ParaÃ±aque City', '0', 134, 48, '01-05-2020'),
(53, 'Aries Bunting', 2, 'Luz Limay, Bataan', '0', 104, 0, '12-29-2019'),
(54, 'Axander Dechoso', 1, 'Puting Buhangin Orion', '0', 104, 0, '02-08-2020'),
(55, 'Wendel Sumalinog', 1, 'San Juan', '0', 152, 48, '01-12-20'),
(56, 'Rose marry Reyes', 2, '', '0', 45, 48, '01-04-2020'),
(57, 'Mary joy bermido', 1, '', '0', 102, 48, '01-12-2020'),
(58, 'sister', 2, '', '0', 142, 48, '01-12-2020'),
(59, 'brother', 1, '', '0', 139, 48, '01-12-2020'),
(60, 'brother2', 1, '', '0', 139, 48, '01-12-2020'),
(61, 'Alfredo Castillo', 1, '', '0', 168, 48, '01-12-2020'),
(62, 'Mayette Castillo', 2, '', '0', 168, 48, '01-12-2020'),
(63, 'Nicole', 2, '', '0', 46, 48, '01-12-2020'),
(64, 'Marina', 2, '', '0', 46, 48, '01-12-2020'),
(65, 'Ella', 2, '', '0', 46, 48, '01-12-2020'),
(66, 'Edilyn', 2, '', '0', 46, 48, '01-12-2020'),
(67, 'Thelma Nartates', 2, '', '0', 68, 48, '01-12-2020'),
(68, 'Brother1', 1, '', '0', 62, 48, '01-12-2020'),
(69, ' Brother2', 1, 'na', '0', 62, 48, '01-12-2020'),
(70, 'Sister1', 2, '', '0', 62, 0, '01-12-2020'),
(71, 'sister1', 2, '', '0', 173, 48, '01-12-2020'),
(72, 'sister2', 2, '', '0', 173, 48, '01-12-2020'),
(73, 'Sister3', 2, '', '0', 173, 48, '01-12-2020'),
(74, 'Sister4', 2, '', '0', 173, 48, '01-12-2020'),
(75, 'sister1', 2, '', '0', 46, 48, '01-12-2020'),
(76, 'sister2', 2, '', '0', 46, 48, '01-12-2020'),
(77, 'Sister3', 2, '', '0', 46, 48, '01-12-2020'),
(78, 'Sister4', 2, '', '0', 46, 48, '01-12-2020'),
(79, 'Sister5', 2, '', '0', 46, 48, '01-12-2020'),
(80, 'Sister6', 2, '', '0', 46, 48, '01-05-2020'),
(81, 'Brother1', 1, '', '0', 46, 48, '01-12-2020'),
(82, 'Brother2', 1, '', '0', 46, 48, '01-12-2020'),
(83, 'Brother3', 1, '', '0', 46, 48, '01-12-2020'),
(84, 'Brother4', 1, '', '0', 46, 48, '01-12-2020');

-- --------------------------------------------------------

--
-- Table structure for table `rec_district`
--

CREATE TABLE IF NOT EXISTS `rec_district` (
`dist_id` int(11) NOT NULL,
  `districtname` varchar(225) NOT NULL,
  `daterecovered` text NOT NULL,
  `acc_id` int(225) NOT NULL,
  `historyfeedback` int(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
`region_id` int(11) NOT NULL,
  `Region` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`region_id`, `Region`) VALUES
(1, 'I'),
(2, 'II'),
(3, 'III'),
(4, 'IV-A'),
(5, 'IV-B'),
(6, 'V'),
(7, 'VI'),
(8, 'NCR'),
(9, 'CAR');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE IF NOT EXISTS `relationship` (
`Rel_id` int(11) NOT NULL,
  `Parent` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relationship`
--

INSERT INTO `relationship` (`Rel_id`, `Parent`) VALUES
(1, 'Father'),
(2, 'Mother'),
(3, 'Uncle');

-- --------------------------------------------------------

--
-- Table structure for table `requestdata`
--

CREATE TABLE IF NOT EXISTS `requestdata` (
`request_id` int(11) NOT NULL,
  `receiver_id` int(225) NOT NULL,
  `content` longtext NOT NULL,
  `sender_id` int(225) NOT NULL,
  `request_status` int(225) NOT NULL,
  `date_requested` text CHARACTER SET keybcs2 NOT NULL,
  `coderequest` int(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requestdata`
--

INSERT INTO `requestdata` (`request_id`, `receiver_id`, `content`, `sender_id`, `request_status`, `date_requested`, `coderequest`) VALUES
(1, 35, 'dada', 29, 2, '11/15/2019 01:00:18 pm', 13),
(2, 35, 'your request approved', 29, 2, '11/15/2019 01:00:18 pm', 13),
(3, 35, 'azsda', 29, 2, '11/15/2019 01:00:18 pm', 13),
(4, 35, 'azsda', 29, 2, '11/15/2019 01:00:18 pm', 13),
(5, 35, 'azsda', 29, 2, '11/15/2019 01:00:18 pm', 13),
(6, 35, 'azsda', 29, 2, '11/15/2019 01:00:18 pm', 13),
(7, 35, 'azsda', 29, 2, '11/15/2019 01:00:18 pm', 13),
(11, 29, 'sadsadsadd', 35, 2, 'timesup', 17),
(12, 29, 'sadadasdasdsadsadsadsadsadsadasdasdsadsadsadsadsadsadsadsa', 35, 2, '11/19/2019 04:09:58 pm', 17),
(13, 29, 'ADSASADADASDSDSDASD', 35, 2, '11/19/2019 06:43:23 pm', 14),
(14, 29, 'wefsdfssdf', 35, 2, '11/20/2019 06:44:01 pm', 18),
(15, 29, 'sdadasd', 35, 2, '11/20/2019 06:48:26 pm', 19),
(16, 29, '', 186, 2, '02/26/2020 06:41:19 pm', 155),
(17, 29, '', 186, 2, '02/26/2020 06:48:21 pm', 155);

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE IF NOT EXISTS `request_status` (
`requeststatus_id` int(11) NOT NULL,
  `request_status` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`requeststatus_id`, `request_status`) VALUES
(1, 'Read'),
(2, 'Not Read');

-- --------------------------------------------------------

--
-- Table structure for table `security_code`
--

CREATE TABLE IF NOT EXISTS `security_code` (
`sec_id` int(11) NOT NULL,
  `securitycode` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `security_code`
--

INSERT INTO `security_code` (`sec_id`, `securitycode`) VALUES
(1, 'cornerstone');

-- --------------------------------------------------------

--
-- Table structure for table `shepherd_code`
--

CREATE TABLE IF NOT EXISTS `shepherd_code` (
`shep_id` int(11) NOT NULL,
  `shepcode` varchar(225) NOT NULL,
  `descrip_shepherding` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shepherd_code`
--

INSERT INTO `shepherd_code` (`shep_id`, `shepcode`, `descrip_shepherding`) VALUES
(1, 'MHL', 'Mystery of Human Life'),
(2, 'F', 'Fellowship');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `ID` int(11) NOT NULL,
  `ACTION` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `ACTION`) VALUES
(1, 'ACTIVATED'),
(2, 'DEACTIVATED');

-- --------------------------------------------------------

--
-- Table structure for table `stat_saints`
--

CREATE TABLE IF NOT EXISTS `stat_saints` (
`stat_id` int(11) NOT NULL,
  `Gender` varchar(25) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stat_saints`
--

INSERT INTO `stat_saints` (`stat_id`, `Gender`) VALUES
(1, 'Brother'),
(2, 'Sister');

-- --------------------------------------------------------

--
-- Table structure for table `teammate`
--

CREATE TABLE IF NOT EXISTS `teammate` (
`teammate_id` int(225) NOT NULL,
  `trainee_id` varchar(225) NOT NULL,
  `currentteam_id` varchar(225) NOT NULL,
  `locality_id` varchar(225) NOT NULL,
  `ft_term` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teammate`
--

INSERT INTO `teammate` (`teammate_id`, `trainee_id`, `currentteam_id`, `locality_id`, `ft_term`) VALUES
(13, '4', '10', '4', '2'),
(14, '129', '10', '96', '4'),
(16, '3', '8', '6', '2'),
(18, '9', '8', '96', '2'),
(24, '340', '11', '154', '3'),
(25, '38', '11', '154', '2'),
(26, '285', '11', '154', '2'),
(27, '81', '11', '155', '3'),
(28, '317', '11', '155', '3'),
(29, '46', '11', '155', '2'),
(30, '96', '11', '156', '3'),
(31, '273', '11', '156', '2'),
(32, '487', '11', '156', '1'),
(51, '7', '11', '132', '2'),
(52, '9', '11', '132', '2'),
(53, '4', '11', '132', '2'),
(54, '5', '11', '132', '3'),
(55, '152', '12', '4', '4'),
(56, '117', '12', '4', '4');

-- --------------------------------------------------------

--
-- Table structure for table `trainee_info`
--

CREATE TABLE IF NOT EXISTS `trainee_info` (
`trainee_id` int(11) NOT NULL,
  `Last_Name` varchar(225) NOT NULL,
  `First_Name` varchar(225) NOT NULL,
  `Middle_Name` varchar(225) NOT NULL,
  `Gender` varchar(225) NOT NULL,
  `Status` varchar(225) NOT NULL,
  `Batch` varchar(5) NOT NULL,
  `Term` varchar(225) NOT NULL,
  `Sending_Locality` varchar(225) NOT NULL,
  `Province` varchar(225) NOT NULL,
  `Region` varchar(225) NOT NULL,
  `Country` varchar(225) NOT NULL,
  `Birthdate` varchar(225) NOT NULL,
  `School` varchar(225) NOT NULL,
  `Degree` varchar(225) NOT NULL,
  `Contact_number` varchar(225) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Emergency_Contact_Person` varchar(225) NOT NULL,
  `Relationship` varchar(225) NOT NULL,
  `Contact_No` varchar(225) NOT NULL,
  `Reg_No` varchar(225) NOT NULL,
  `profile_img` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainee_info`
--

INSERT INTO `trainee_info` (`trainee_id`, `Last_Name`, `First_Name`, `Middle_Name`, `Gender`, `Status`, `Batch`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`, `profile_img`) VALUES
(1, 'Abasola', 'Aljiver', '', '1', '1', '2', '2', 'Oslob', 'Cebu', '7', 'PHL', '4/24/1997', 'University of Cebu- Main Campus', 'BS Criminology', '09214762566', 'aljiverabasola24@GMAIL.COM', 'Alex Abasola', 'Father', '09232154910', '660002', '1583498664-Abasola, Aljiver.jpg'),
(2, 'Abasola', 'Livingstone', '', '1', '1', '2', '2', 'Oslob', 'Cebu', '7', 'PHL', '11/14/1998', 'Negros Oriental State University', 'BSED- Mathematics', '09751842465', 'elgenbagat123@yahoo.com', 'Marciana Abasola', 'Mother', '09232154910', '660001', '1583498637-Abasola, Livingstone.jpg'),
(3, 'Ablan', 'Vincent', '', '1', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '11/24/1998', 'Phinma COC', 'BS Information Technology', ' ', 'vinestar1234@yahoo.com', 'Bernard Ablan', 'Father', '09161098551', '660003', '1583498691-Ablan, Vincent.jpg'),
(4, 'Amulong', 'Jordan', '', '1', '1', '2', '2', 'Tagaytay City', 'Cavite', '4A', 'PHL', '11/8/1995', 'Cavite State University-Indang', 'BS Industrial Engeneering', '09970663417', 'jordanamulong08@gmail.com', 'Marilou Amulong', 'Mother', '09071827148', '660004', '1583498713-Amulong, Jordan.jpg'),
(5, 'Angcahan', 'Nicomedes Jr.', '', '1', '1', '2', '2', 'Quezon', 'Bukidnon', '10', 'PHL', '7/6/1994', 'Quezon Institute of Technology', 'Bachelor of Science in Elementary Education', '09360319934', 'nicoreal.angcahan@gmail.com', ' ', ' ', ' ', '660005', '1583498738-Angcahan, Nicomedes.jpg'),
(6, 'Aying', 'Alcid John', '', '1', '1', '2', '2', 'Clarin', 'Misamis Occidental', '10', 'PHL', '11/13/1993', 'La-Salle University', 'BS-Geodetic Engineer', '09099522150', 'ajfaying@gmail.com', 'Evangeline Aying', 'Mother', '09462987321', '660008', '1583498760-Aying, Alcid John.jpg'),
(7, 'Badiango', 'Ryan Jay', '', '1', '1', '2', '2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '6/7/1998', 'Rizal Technological University', 'BS Statistics', '09299577273', 'ryanjay.badiang070@gmail.com', ' ', ' ', ' ', '660009', '1583498786-Badiango, Ryan Jay.jpg'),
(8, 'Blancada', 'Mark Gil', '', '1', '1', '2', '2', 'Mandaluyong', 'Metro Manila', 'NCR', 'PHL', '5/1/1995', 'Rizal Technological University', 'Bachelor of Science in P.E', '09776413549', 'markgil.blancada@yahoo.com', 'Archie Blancada', 'Brother', '09359182197', '660011', 'logo.png'),
(9, 'Bondoc', 'Jabez ', '', '1', '1', '2', '2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '11/16/1998', 'AMA Computer College-Caloocan', 'BSIT-Web Development', '0', 'none@gmail.com', 'none', 'none', '0', '660012', '1583498811-Bondoc, Jabez.jpg'),
(10, 'Canoy', 'Rogelio', '', '1', '1', '2', '2', 'San Fernando', 'Bukidnon', '10', 'PHL', '4/24/1997', 'San Agustin Institute of Technology', 'Bachelor of Science in Elementary Education', '09076151955', 'none@gmail.com', 'Welma Doblas', 'Grandmother', '09076151955', '660014', '1583498851-Canoy, Rogelio.jpg'),
(11, 'Cavan', 'Cyril', '', '1', '1', '2', '2', 'Digos City', 'Davao Del Sur', '11', 'PHL', '6/12/1998', 'Ateneo de Davao University', 'BS Business Management', '', '', '', '', '', '660015', 'logo.png'),
(12, 'Chen', 'Job', '', '1', '1', '2', '2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '5/5/1998', 'Zhejiang Yuying Vocational and Technical College', 'Major in Apllied English', '8613588344970', '13588344970@163.com', 'Zhaopin Chen', 'Father', '8613085885558', '660017', 'logo.png'),
(13, 'Dayro', 'Mark', '', '1', '1', '2', '2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '8/31/1987', 'Saint Jude College Manila', 'BS Pharmacy', '09152885642', 'mesdayro@gmail.com', 'Elizabeth Putan', 'Sister', '09228490959', '660019', '1583498880-Dayro, Mark.jpg'),
(14, 'De Borja', 'Karl', '', '1', '1', '2', '2', 'Jalajala', 'Rizal', '4A', 'PHL', '7/31/1997', 'STI College - Tanay', 'BS Information Technology', ' ', 'none@gmail.com', ' ', ' ', ' ', '660020', '1583498910-De Borja, Karl.jpg'),
(15, 'Dela Cerna', 'Rodel', '', '1', '1', '2', '2', 'Lala', 'Lanao Del Norte', '10', 'PHL', '10/5/1994', 'North Central Mindanao College', 'Accounting Technology', '09758118986', '5rodeldelacerna@gmail.com', 'Carlo Dioquino', 'Brother', '09059566576', '660021', '1583498936-Dela Cerna, Rodel.jpg'),
(16, 'Dioquino', 'Chris', '', '1', '1', '2', '2', 'Lala', 'Lanao Del Norte', '10', 'PHL', '12/25/1995', 'North Central Mindanao College', 'BS Accountancy', '09556002960', 'dioquinochris@gmail.com', 'Elizabeth Balesteros', 'Sister', '09173096623', '660022', '1583498962-Dioquino, Chris.jpg'),
(17, 'Escobar', 'Joey', '', '1', '1', '2', '2', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '7/17/1995', 'Colegio De Sta Rita De San Carlos, INC.', 'BS Elementary Education', '09099894363', 'joeyescobar@gmail.com', 'Neil P. Escobar ', 'Father', '09275728373', '660023', '1583498989-Escobar, Joey.jpg'),
(18, 'Esmade', 'August', '', '1', '1', '2', '2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '8/13/1997', 'Bestlink College of the Philippines', 'BS Business Administration', '09751792758', 'none@gmail.com', 'Emily Esmade', 'Mother', '09153322303', '660024', '1583499017-Esmade, August.jpg'),
(19, 'Estrabon', 'Hubert', '', '1', '1', '2', '2', 'Koronadal City', 'South Cotabato', '12', 'PHL', '4/25/1996', 'STI College of Koronadal', 'BS In Information Technology', '09174853754', 'EstrabonHub@gmail.com', 'Rose Estrabon', 'Mother', '09214145674', '660025', '1583499042-Estrabon, Hubert.jpg'),
(20, 'Fernandez', 'Chrysolite', '', '1', '1', '2', '2', 'General Trias', 'Cavite', '4A', 'PHL', '2/24/1998', 'Cavite State University - Indang', 'BS Economics - Agriculture', ' ', 'none@gmail.com', ' ', ' ', ' ', '660027', '1583499073-Fernandez, Chrysolite.jpg'),
(21, 'Gabales', 'Erol', '', '1', '1', '2', '2', 'Bulusan', 'Sorsogon', '5', 'PHL', '11/27/1997', 'Sorsogon State College', 'BS Civil Engineering', ' ', 'none@gmail.com', ' ', ' ', ' ', '660028', '1583499102-Gabales, Erol.jpg'),
(22, 'Godoy', 'Vicente', '', '1', '1', '2', '2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '4/25/1991', 'City of Malabon University', 'BS Information Technology', ' ', 'none@gmail.com', ' ', ' ', ' ', '660029', '1583499130-Godoy, Vicente.jpg'),
(23, 'Golosino', 'Genesis', '', '1', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '6/21/1997', 'STI College - Cagayan de Oro City', 'BS Human Resource Management', ' ', 'none@gmail.com', ' ', ' ', ' ', '660030', '1583499158-Golosino, Genesis.jpg'),
(24, 'Gonzales', 'Joseph', '', '1', '1', '2', '2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '1/21/1999', 'Navotas Polythecnic College', 'BSED - Special Education', '  ', 'none@gmail.com', ' ', ' ', ' ', '660031', '1583499187-Gonzales, Joseph.jpg'),
(25, 'Guardaquivil', 'Joshua', '', '1', '1', '2', '2', 'Lala', 'Lanao del Norte', '10', 'PHL', '4/14/1995', 'Mindanao State University-Main Campus', 'BS Statistics', '09675842175', 'joshua14.cg@gmail.com', 'Michael Clarion Guardaquivil', 'Brother', '09050369030', '660032', '1583499218-Guardaquivil, Joshua.jpg'),
(26, 'Hernandez', 'Hubert', '', '1', '1', '2', '2', 'San Juan', 'Batangas', '4A', 'PHL', '10/29/1999', 'Batangas State University', 'BSED - Filipino', ' ', 'none@gmail.com', ' ', ' ', ' ', '660033', '1583499244-Hernandez, Hubert.jpg'),
(27, 'Hsu', 'Hiram', '', '1', '1', '2', '2', 'New Taipei City', 'Taiwan', 'Taiwan', 'TAIWAN', '7/29/1996', 'National Sun Yat-sen University', 'Chinese Literature/Business Management', '0963738325', 'vm6ruo4cj86@gmail.com', 'Mary Jane Josol', 'Father', '0939313440', '660034', '1583499269-Hsu, Hiram.jpg'),
(28, 'Ignacio', 'Laurence', '', '1', '1', '2', '2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '6/10/1998', 'Bestlink College of the Philippines', 'BS Business Administration', ' ', 'none@gmail.com', ' ', ' ', ' ', '660035', '1583499297-Ignacio, Laurence.jpg'),
(29, 'Insang', 'Jason', '', '1', '1', '2', '2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '1/6/1999', 'Ateneo De Zamboanga University', 'BS Accounting Technology', '09990220740', 'insang.jason@gmail.com', 'Insang Vilma Maghanoy', 'Mother', '09759533818', '660036', '1583499323-Insang, Jason.jpg'),
(30, 'Jerusalem', 'Roijervin', '', '1', '1', '2', '2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '2/24/1996', 'ICCT CFI', 'BS Accountancy', ' ', 'none@gmail.com', ' ', ' ', ' ', '660037', '1583499347-Jerusalem, Roijervin.jpg'),
(31, 'Layna', 'June Rill', '', '1', '1', '2', '2', 'Panaon', 'Misamis Occidental', '10', 'PHL', '6/12/1995', 'La-Salle University', 'BSECE', '09079787311', 'junejuly463@gmail.com', 'Judie S. Layna', 'Father', '09502193185', '660038', '1583499371-Layna, June Rill.jpg'),
(32, 'Legilisho', 'Daniel', '', '1', '1', '2', '2', 'Harbin', 'China', 'China', 'CHINA', '1/14/1989', 'Harbin Institute of Technology (China)', 'Master Information Engineer', '86-18846756153', 'danlegishio@yahoo.com', 'James Legilisho Kiyiapi', 'Father', '254734994499', '660039', '1583489029-legilisho, daniel.jpg'),
(33, 'Llupar', 'Neomar', '', '1', '1', '2', '2', 'San Juan', 'Batangas', '4A', 'PHL', '1/29/1996', 'Batangas State University', 'BS Filipino', ' ', 'none@gmail.com', ' ', ' ', ' ', '660040', '1583499399-Llupar, Neomar.jpg'),
(34, 'Macahilas', 'Jasper', '', '1', '1', '2', '2', 'Dasmari', 'Cavite', '4A', 'PHL', '12/27/1995', 'Cavite State University - Indang', 'BS Recreational Management', ' ', 'none@gmail.com', ' ', ' ', ' ', '660041', '1583499425-Macahilas, Jasper.jpg'),
(35, 'Macapili', 'Jesreel', '', '1', '1', '2', '2', 'Lakewood', 'Zamboanga Del Sur', '9', 'PHL', '4/18/1995', 'J.H Cerilles State College', 'Bachelor of Science in Elementary Education', '09463053781', 'jasreelmacapili3@gmail.com', 'Nora Macapili', 'Mother', '09759244126', '660042', '1583499453-Macapili, Jesreel.jpg'),
(36, 'Madarimot', 'Bezalil', '', '1', '1', '2', '2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '11/29/1996', 'JRMSU', 'BSED-Mapeh', '09489105699', 'realname021@gmail.com', 'Cinderella Madarimot', 'Mother', '09489105679', '660043', '1583499479-Madarimot, Bezalil.jpg'),
(37, 'Mallo', 'Joshua', '', '1', '1', '2', '2', 'Casiguran', 'Aurora', '3', 'PHL', '10/8/1998', 'Polytechnic University of the Philippines', 'Bachelor in Transportation Management', ' ', 'none@gmail.com', ' ', ' ', ' ', '660044', '1583499512-Mallo, Joshua.jpg'),
(38, 'Managuelod', 'Adrian', '', '1', '1', '2', '2', 'Divilacan', 'Isabela', '2', 'PHL', '1/26/1998', 'Isabela State University', 'BS Hotel Restaurant and Tourism', ' ', 'kim26@yahoo.com', 'Aguido Macatiag', 'Uncle', '09754119836', '660045', '1583499543-Managuelod, Adrian.jpg'),
(39, 'Manongsong', 'Rhodin', '', '1', '1', '2', '2', 'Calapan City', 'Oriental Mindoro', '4B', 'PHL', '1/13/1998', 'City College of Calapan', 'BS Information System', ' ', 'none@gmail.com', ' ', ' ', ' ', '660046', '1583499584-Manongsong, Rhodin.jpg'),
(40, 'Marquez', 'Daniel', '', '1', '1', '2', '2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '3/22/1994', 'University of the Philippines Diliman', 'MS Physics', '09236092084', 'danielmarquez313@gmail.com', 'Nelson Araojo', 'Friend', '09350943471', '660047', '1583499614-Marquez, Daniel.jpg'),
(41, 'Martinet', 'Samuel', '', '1', '1', '2', '2', 'Valencia', 'Bukidnon', '10', 'PHL', '9/13/1996', 'Valencia College Inc.', 'AB-Sociology Bachelor of Arts', '09176777774', 'none@gmail.com', 'Elmar Martinet', 'Mother', '09176777774', '660048', '1583499644-Martinet, Samuel.jpg'),
(42, 'Maximo', 'Timothy', '', '1', '1', '2', '2', 'Difon', 'Quirino', '2', 'PHL', '11/18/1997', 'University of Cordilleras', 'BSManagement Accounting', '09774244297', 'timothyjohnmaximo@gmail.com', 'Mark Andrei Maximo', 'Brother', '09174040198', '660049', '1583499670-Maximo, Timothy.jpg'),
(43, 'Mi?eque', 'Eddie Jr.', '', '1', '1', '2', '2', 'Baras', 'Rizal', '4A', 'PHL', '7/7/1994', 'Technological Institute of the Philippines', 'BS Marine Transportation', '09278765912', 'mineque94@gmail.com', 'Lily Mineque', 'Mother', '09216935930', '660050', '1583499715-Mineque, Eddie.jpg'),
(44, 'Modanza', 'Jeric ', '', '1', '1', '2', '2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '10/4/1997', 'Navotas Polythecnic College', 'BSBA Marketing', ' ', 'none@gmail.com', ' ', ' ', ' ', '660051', '1583499763-Modanza, Jeric.jpg'),
(45, 'Molano', 'Vincent', '', '1', '1', '2', '2', 'Lingayen', 'Pangasinan', '1', 'PHL', '3/29/1997', 'Pangasinan State University', 'BS Public Administration', ' ', 'none@gmail.com', ' ', ' ', ' ', '660052', '1583499811-Molano, Vincent.jpg'),
(46, 'Mones', 'Emmanuel Joshua', '', '1', '1', '2', '2', 'Las Pi', 'Metro Manila', 'NCR', 'PHL', '8/14/1998', 'Philippine Mechant Marine School', 'BS Customs Admistration', ' ', 'none@gmail.com', ' ', ' ', ' ', '660053', '1583499844-Mones, Emmanuel Joshua.jpg'),
(47, 'Nartates', 'Norven', '', '1', '1', '2', '2', 'Cabangan', 'Zambales', '3', 'PHL', '8/26/1991', 'President Ramon Magsaysay State University', 'BS Agriculture', '09302812286', 'none@gmail.com', 'Thelma Nartates', 'Mother', '09503766042', '660054', '1583500079-Nartates, Norven.jpg'),
(48, 'Nicolas', 'Lowell', '', '1', '1', '2', '2', 'Bi', 'Laguna', '4A', 'PHL', '8/4/1999', 'Polytechnic University of the Philippines-Sta. Rosa', 'BSBA Marketing Management', '09263444970', 'lowelljamesss@gmail.com', 'Mercedita Nicolas', 'Mother', '09392593056', '660055', '1583500111-Nicholas, Lowell.jpg'),
(49, 'Nugas', 'Ken Moses', '', '1', '1', '2', '2', 'Cebu City', 'Cebu', '7', 'PHL', '9/30/1996', 'University of Cebu-Main Campus', 'BSBA-Management Accounting', '09958671492', 'kenugas@gmail.com', 'Ruben Nugas', 'Father', '09151814907', '660056', '1583500137-Nugas, Ken Moses.jpg'),
(50, 'Ogoc', 'Cyril Jr.', '', '1', '1', '2', '2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '9/7/1994', 'Jose Rizal Memorial State University ', 'BS Accounting Technology', ' ', 'none@gmail.com', ' ', ' ', ' ', '660057', '1583500170-Ogoc, Cyril.jpg'),
(51, 'Ontao', 'Marlon', '', '1', '1', '2', '2', 'Amai Manabilang', 'Lanao Del Sur', 'ARMM', 'PHL', '11/1/1993', ' ', 'BSBA', '09868547872', 'none@gmail.com', 'Dina Ontao', 'Mother', '09363547872', '660058', '1583500203-Ontao, Marlon.jpg'),
(52, 'Oropilla', 'Joash', '', '1', '1', '2', '2', 'Alaminos', 'Pangasinan', '1', 'PHL', '6/3/1996', 'Adamson University', 'BS Electronics Engeneering', ' ', 'none@gmail.com', ' ', ' ', ' ', '660059', '1583500278-Oropilla, Joash.jpg'),
(53, 'Pacatang', 'Recvry', '', '1', '1', '2', '2', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '9/18/1986', 'Governor Alfonso D. Tan College', 'BSBA Marketing', ' ', 'none@gmail.com', ' ', ' ', ' ', '660060', '1583500319-Pacatang, Recvry.jpg'),
(54, 'Padre', 'Jhapet', '', '1', '1', '2', '2', 'Cabuyao', 'Laguna', '4A', 'PHL', '12/27/1998', 'Saint Vincent College of Cabuyao', 'BS Information Technology', ' ', 'none@gmail.com', ' ', ' ', ' ', '660061', '1583558176-Padre, Jhapet.jpg'),
(55, 'Paller', 'Kim Seer', '', '1', '1', '2', '2', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/30/1995', 'MSU- Iligan Institute of Technology', 'BS Electrical  Engeneering', ' ', 'none@gmail.com', ' ', ' ', ' ', '660062', '1583558222-Paller, Kim Seer.jpg'),
(56, 'Parungao', 'Jerahmeel', '', '1', '1', '2', '2', 'Dasmari', 'Cavite', '4A', 'PHL', '2/25/1998', 'Cavite State University ', 'BS Industrial Engineering', ' ', 'none@gmail.com', ' ', ' ', ' ', '660063', '1583558262-Parungao, Jehrameel.jpg'),
(57, 'Pasquin', 'Hiromie', '', '1', '1', '2', '2', 'San Simon', 'Pampanga', '3', 'PHL', '1/6/1995', 'Bulacan State University', 'BS Home Economics', '09357634535', 'hiromiepasquin@gmail.com', 'Norberto Pasquin', 'Father', '09978279176', '660064', '1583558289-Pasquin, Hiromie.jpg'),
(58, 'Payot', 'Anthony', '', '1', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '4/26/1994', 'Phinma Cagayan De Oro College', 'BSBA Financial Management', ' ', 'none@gmail.com', ' ', ' ', ' ', '660065', '1583558344-Payot, Anthony.jpg'),
(59, 'Pepito', 'Ritchie', '', '1', '1', '2', '2', 'Don Carlos', 'Bukidnon', '10', 'PHL', '5/30/1997', 'Don Carlos Polytecnic College', 'HRM', '09972074785', 'ritchiepepito@gmail.com', ' ', ' ', '09552153899', '660066', '1583558375-Pepito, RIchie.jpg'),
(60, 'Pino', 'Peniel James', '', '1', '1', '2', '2', 'Butuan City', 'Agusan Del Norte', '13 (CARAGA)', 'PHL', '12/21/1996', 'Holy Child Colleges of Butuan', 'B.S Criminology', '09388510887', 'pjcc385@gmail.com', 'Perla Pino', 'Mother', '09121591507', '660067', '1583558405-Pino, Peniel.jpg'),
(61, 'Pojas', 'Ram Paul', '', '1', '1', '2', '2', 'Molave', 'Zamboanga del sur', '9', 'PHL', '4/9/1996', 'Mindanao State University-Iligan Institute of Technology', 'BSECT-Embedded Systems', '09481126096', 'RAMPAULPOJAS@gmail.com', 'Aurelia Pojas', 'Mother', '09102834479', '660068', '1583558440-Pojas, Ram.jpg'),
(62, 'Rodriguez', 'Larry Boy', '', '1', '1', '2', '2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '7/12/1996', 'Navotas Polytechnic College', 'BSBA Marketing', '09107047805', 'Rodriguez.Larry12@yahoo.com', 'Lanie Rodriguez', 'Sister', '09567886128', '660069', '1583558472-Rodriguez, Larry.jpg'),
(63, 'Rosales', 'James Andrew', '', '1', '1', '2', '2', 'Bacoor', 'Cavite', '4A', 'PHL', '12/23/1997', 'De La Salle University-Dasmarinas', 'Information Technology', '09434510973', 'jamesandrew1203@yahoo.com', 'Romeo Rosales', 'Father', '09233783991', '660070', '1583558512-Rosales, James Andrew.jpg'),
(64, 'Ruta', 'R-jay', '', '1', '1', '2', '2', 'Polomolok', 'South Cotabato', '12', 'PHL', '7/7/1998', 'STI College of General Santos', 'BS Information Technology', '09777220294', 'rjayruta@gmail.com', 'Rodel Ruta', 'Father', '09461606658', '660071', '1583558544-Ruta, RJay.jpg'),
(65, 'Sanchez', 'Joshua Chris', '', '1', '1', '2', '2', 'Ormoc City', 'Leyte', '8', 'PHL', '11/23/1997', 'Eastern Visayas State University', 'BSED-TLE', '09567164030', 'none@gmail.com', ' ', ' ', ' ', '660072', '1583558600-Sanchez, Chris.jpg'),
(66, 'Sarsalejo', 'Arden', '', '1', '1', '2', '2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/10/1996', 'City of Malabon University', 'Secondary Education-Math', '09233380780', 'none@gmail.com', 'Loida Vytongco', 'Guardian', '9257512', '660073', '1583558633-Sarsaleno, Arden.jpg'),
(67, 'Sumalpong', 'Ronel Jay', '', '1', '1', '2', '2', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '10/21/1997', 'Misamis University- Ozamis City', 'BSHRM', '09456049692', 'none@gmail.com', ' ', ' ', ' ', '660074', '1583558671-Sumalpong, Ronel Jay.jpg'),
(68, 'Suma-oy', 'Deshanestrel', '', '1', '1', '2', '2', 'Dipolog City', 'Zamboanga Del Norte', '9', 'PHL', '10/11/1994', 'Andres Bonifacio College', 'BSED-English', '09223101139', 'deshanestrels@gmail.com', 'Rickardo Paghsasian', 'Elder', '09985102075', '660075', '1583558701-Suma-oy, Deshanestrel.jpg'),
(69, 'Talasan', 'Justine', '', '1', '1', '0', '2', 'Bacolod', 'Lanao del Norte', '10', 'PHL', '7/25/1997', 'Mindanao State University-Institute of Technology', 'BEED-English', '09364342631', 'justinetalGOGO@gmail.com', 'Manolito Talasan', 'Father', '09338154957', '660076', 'logo.png'),
(70, 'Tamayo', 'Christian', '', '1', '1', '2', '2', 'Los Ba', 'Laguna', '4A', 'PHL', '10/28/1995', 'LSPU Los Banos Campus', 'Agri-Fisheries and Business Management', '09478043748', 'none@gmail.com', ' ', ' ', ' ', '660077', '1583558741-Tamayo, Christian.jpg'),
(71, 'Tangcay', 'Vessel', '', '1', '1', '2', '2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '7/1/1995', 'Medina Foundation College', 'BS Business Administration', '09129525668', 'none@gmail.com', 'Merely Tangcay', 'Mother', '09073765747', '660078', '1583558782-Tangcay, Vessel.jpg'),
(72, 'Tanoy', 'Noelmar', '', '1', '1', '2', '2', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '5/19/1997', 'Western Mindanao State University', 'BSED-English', '09187263226', 'marmarimo1997@gmail.com', 'Noel Tanoy', 'Father', '09308948265', '660079', '1583558818-Tanoy, Noelmar.jpg'),
(73, 'Tongco', 'Meynard', '', '1', '1', '2', '2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '8/29/1995', 'City of Malabon University', 'Information Technology', '09231946370', 'none@gmail.com', ' ', ' ', ' ', '660080', '1583558851-Tongco, Meynard.jpg'),
(74, 'Tran', 'Phuoc', '', '1', '1', '2', '2', 'Ha Noi', 'Vietnam', 'Vietnam', 'VIETNAM', '10/7/1984', 'Hochiminh City Universityof Technology and Education', 'Electronics', '84795918685', 'phuocty84@gmail.com', 'Vu Thi Cam Yam', 'Wife', '84936463288', '660081', '1583558883-Tran, Phuoc.jpg'),
(75, 'Tuboro', 'Joshua', '', '1', '1', '2', '2', 'Pasig City', 'Metro Manila', 'NCR', 'PHL', '3/26/1998', 'Arellano University', 'Information Technology', '09274960330', 'JOSHUATUBORO@GMAIL.COM', 'Rosa Vel Tuboro', 'Mother', '09664577847', '660082', '1583558912-Tuboro, Joshua.jpg'),
(76, 'Vidad', 'Eben Ezer', '', '1', '1', '2', '2', 'Quezon', 'Bukidnon', '10', 'PHL', '2/22/1995', 'Quezon Institute of Technology', 'Bachelor of Science in Elementary Education', '09460596308', 'none@gmail.com', ' ', ' ', ' ', '660083', '1583558947-Vidad, Eben Ezer.jpg'),
(77, 'X', 'Joseph', '', '1', '1', '2', '2', 'X', 'X', 'X', 'X', '11/3/1965', '', '', '', '', 'Rasool', '', '09128432507', '660084', 'logo.png'),
(78, 'Zheng', 'Enoch', '', '1', '1', '2', '2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '1/22/1997', 'Zhejiang University of Science and Technology', 'Major in Accountancy', '8615990177759', '761523919@99.com', 'Yuzhu Zheng', 'Father', '13868830526', '660085', '1583558987-Zheng, Enoch.jpg'),
(79, 'Acquiatan', 'Jerizim', '', '1', '1', '4', '3', 'Tandag City', 'Surigao Del Sur', '13 (CARAGA)', 'PHL', '1/15/1995', 'Stella Maris College', 'BSED- English', '09381363715', 'jezacquiatan@gmail.com', 'Tito L. Acquitan', 'Father', '09073662362', '65001', '1583561181-jerizim.jpg'),
(80, 'Ambet', 'Erick', '', '1', '1', '4', '3', 'Cagayan De Oro City', 'Misamis Oriental', '10', 'PHL', '3/3/1997', 'J.H. Cerilles State College', 'BSIT', '09676651727', 'erickampaitambet@gmail.com', 'Jeson Omapas', '', '09355550693', '65002', '1583298253-Erick.jpg'),
(81, 'Araneta', 'Meliton', '', '1', '1', '4', '3', 'Bogo City', 'Cebu', '7', 'PHL', '3/18/1995', 'Cebu Technological University', 'BS Marine Engineering', '09451440904', 'melitonaraneta@gmail.com', 'Ligaya Araneta', 'Mother', '09558510260', '65031', '1583561217-meliton.jpg'),
(82, 'BaÃ±ares', 'Christian', '', '1', '1', '4', '3', 'Arayat', 'Pampanga', '3', 'PHL', '8/21/1996', 'Don Honorio Ventura Technological State University', 'Civil Engineering', '09661364914', 'cjmb21@yahoo.com', 'Cristina M. Ba?ares', 'Mother', '09059349519', '65040', 'logo.png'),
(83, 'Calderon', 'Eldie', '', '1', '1', '4', '3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '12/9/1994', 'STI Academic Center', 'BSIT', '09950479971', 'gmeldie38@gmail.com', 'Federico M. Calderon, Jr.', 'Father', '09255556025', '65038', '1583561320-eldie.jpg'),
(84, 'Capisan', 'Joshua', '', '1', '1', '4', '3', 'Dangcagan', 'Bukidnon', '10', 'PHL', '8/20/1996', 'Don Carlos Polytechnic College', 'BSE- English', '09367243287', 'capisanjoshua422@gmail.com', 'Antonio Capisan', 'Father', '09363992957', '65004', '1583560024-Joshua.jpg'),
(85, 'Colminas', 'Michael', '', '1', '1', '4', '3', 'Cebu City', 'Cebu', '7', 'PHL', '9/2/1995', 'University of Cebu- Main', 'BSBA- Marketing Management', '09388809305', 'ue.michael_colminas95@yahoo.com', 'Elma M. Colminas', 'Mother', '09750031094', '65005', '1583560168-Michael Colminas.jpg'),
(86, 'Diano', 'Raciano', '', '1', '1', '4', '3', 'Malimono', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '5/22/1995', 'Surigao State College of Technology', 'BSIT', '09501890583', 'dianoraciano@yahoo.com', 'Diascora A. Diano', 'Mother', '09072313739', '65006', '1583561359-raciano.jpg'),
(87, 'Ende', 'Alvin', '', '1', '1', '4', '3', 'Quezon', 'Bukidnon', '10', 'PHL', '2/15/1995', 'University of San Carlos', 'BSBA- Financial Management', ' ', 'none@gmail.com', ' ', ' ', ' ', '65007', '1583561396-alvin.jpg'),
(88, 'Espejo', 'Loueji', '', '1', '1', '4', '3', 'San Fernando', 'Bukidnon', '10', 'PHL', '11/1/1997', 'Irene B. Antonio College of Mindanao', 'Bachelor of Elementary Education', '09494110513/ 09367560062', 'louejiespejo23@yahoo.com', 'Jeryl A. Inot', 'Sister ', '09998995335', '65008', '1583560138-Loueji espejo.jpg'),
(89, 'Gaddon', 'Wilser', '', '1', '1', '4', '3', 'Banaue', 'Ifugao', '2', 'PHL', '1/21/1999', 'Saint Louis University', 'BS in Electrical Engineering', '09306941428', 'gaddon.wilser@gmail.com', 'Susan Dulnuan Gaddon', 'Mother', '094948431969', '65009', '1583561443-wilser.jpg'),
(90, 'Godornes', 'Jesuie', '', '1', '1', '4', '3', 'Naga', 'Cebu', '7', 'PHL', '10/12/1992', 'Professional Academy of the Philippines', 'BSED- English', '09262136958', 'dalethp.ceronel@yahoo.com', 'Eugeneme B. Coronel', 'Spiritual Father', '09179348242', '65010', '1583559981-Jesuie.jpg'),
(91, 'Hermoso', 'Marlon', '', '1', '1', '4', '3', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '1/23/1994', 'Cebu Technological University', 'BSIT major in Electronic Tech', ' ', 'MarLonhermoso@yahoo.com', 'Erlene Hermoso', 'Mother', '09430727102', '65011', '1583561515-LRM_EXPORT_8199617379318_20191028_180730393-removebg-preview.jpg'),
(92, 'Ipapo', 'Paul', '', '1', '1', '4', '3', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '12/30/1993', 'Bulacan State University', 'BS Mechatronics Engineering', '09214105037', 'ipapo.paul@yahoo.com', 'Lucy Yu Ipapo', 'Mother', '09228263807', '65012', '1583560262-Paul Ipapo.jpg'),
(93, 'Jungao', 'John', '', '1', '1', '4', '3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '6/19/1996', 'Mindanao State University - Iligan Institute of Technology', 'AB- Sociology', '09164567627', 'jdmjungao@gmail.com', 'Myla Z. Jungao', 'Mother', '09177740248', '65013', '1583561554-jano.jpg'),
(94, 'Justimbaste', 'Kim', '', '1', '1', '4', '3', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '11/26/1986', 'The National Teachers College', 'BSE- Mathematics', ' ', 'Septerkim@yahoo.com', 'Malou Ah', 'Serving One', '5618140', '65035', '1583561655-kim justim.jpg'),
(95, 'Liwag', 'John Victor', '', '1', '1', '4', '3', 'Lucena City', 'Quezon Province', '4A', 'PHL', '2/20/1997', 'Manuel S. Enverga University Foundation', 'BS Electronics Engineering', '09476005703', 'jva_liwag95@rocketmail.com', 'Ma.Venus T. Liwag', 'Mother', '09425984132', '65034', '1583298080-John Victor.jpg'),
(96, 'Macanas', 'Leoniel', '', '1', '1', '4', '3', 'Mariveles', 'Bataan', '3', 'PHL', '5/1/1994', 'Polytechnic University of the Philippines', 'BS Accountancy', '09773659946', 'leonielmacanas@gmail.com', 'Lielanie Macanas', 'Mother', '09773659946', '65036', '1582201416-leonel.jpg'),
(97, 'Mahawan', 'Glenn', '', '1', '1', '4', '3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/30/1996', 'Western Mindanao State University- ESU Molave', 'Bachelor of Elementary Education', '09483884233/09074466708', 'mahawanglenn@gmail.com', 'Ruth T. Mahawan', 'Mother', '09483884233', '65014', '1583559918-Glenn.jpg'),
(98, 'Mapute', 'Edgardo', '', '1', '1', '4', '3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '4/13/1995', 'Western Mindanao State Univeristy', 'BSED- Social Studies', '09487808348', 'none@gmail.com', 'Rebecca F. Mapute', 'Mother', '09995439413', '65015', '1583561602-edgardo.jpg'),
(99, 'Mascariola', 'Richmark', '', '1', '1', '4', '3', 'Cebu City', 'Cebu', '7', 'PHL', '2/19/1996', 'University of Cebu', 'BSBA- Marketing Management', '2725055/09393577264', 'richmark14@icloud.com', 'Roel M. Mascariola', 'Father', '09285004808', '65017', '1583560291-Richmark.jpg'),
(100, 'Mateo', 'Saturnino Jr.', '', '1', '1', '4', '3', 'Cauayan', 'Isabela', '2', 'PHL', '11/22/1997', 'Isabela State University', 'Bachelor of Secondary Education', '09555815001', 'JP9575781@gmail.com', 'Gabriel Mateo Saturnino, Sr.', 'Guardian', '09975635184', '65018', '1583561698-saturn.jpg'),
(101, 'Mator', 'Enoch', '', '1', '1', '4', '3', 'Dasmari', 'Cavite', '4A', 'PHL', '5/1/1986', ' ', ' ', ' ', 'none@gmail.com', ' ', ' ', ' ', '65019', '1583559885-Enoch Mator.jpg'),
(102, 'Monasterio', 'Jomar', '', '1', '1', '4', '3', 'General Santos City', 'South Cotabato', '12', 'PHL', '5/22/1996', 'Ramon Magsaysay Memorial Colleges', 'BSED- English', ' ', 'jomarmonasterio@yahoo.com', 'Rosaline Monasterio', 'Mother', '09075425891', '65016', '1583561765-jomar.jpg'),
(103, 'Palacio', 'Junie', '', '1', '1', '4', '3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '9/20/1995', 'Western Mindanao State University- External Studies Unit', 'BEED', '09301444571/09187275833', 'none@gmail.com', 'Orpha Jhaelle B. Palacio', 'Wife', '09301444571', '65020', '1583560057-Junie.jpg'),
(104, 'Palma', 'Ken', '', '1', '1', '4', '3', 'Butuan City', 'Agusan Del Norte', '13 (CARAGA)', 'PHL', '6/7/1997', 'AMA Computer Learning Center College of Butuan', 'BS Information Technology', '09465768345', 'kencharlesp74@gmail.com', 'Jessie L. Palma', 'Mother', '09125360729', '65021', '1583560096-Ken Palma.jpg'),
(105, 'Quije', 'Pablo Jr.', '', '1', '1', '4', '3', 'Molave', 'Zamboanga del Sur', '9', 'PHL', '12/5/1990', ' ', 'Computer Science', ' ', 'none@gmail.com', ' ', ' ', ' ', '65039', '1583560212-Pablo.jpg'),
(106, 'Ranolo', 'Bon', '', '1', '1', '4', '3', 'Zamboanga City', 'Zambonga Del Sur', '9', 'PHL', '3/31/1997', 'Western Mindanao State', 'BS Psychology', '09066630720', 'bonilou31@gmail.com', 'Lolita M. Ranolo', 'Mother', '09050236599', '65023', '1583561829-bon.jpg'),
(107, 'Ruta', 'Jeremy', '', '1', '1', '4', '3', 'Polomolok', 'South Cotabato', '12', 'PHL', '2/18/1991', 'Philippine State College of Aeronautics', 'BS- AMT', '09955322566', 'none@gmail.com', 'Victoria Ruta', 'Mother', '094638471727', '65024', '1583561891-LRM_EXPORT_8475280645619_20191028_181206056-removebg-preview.jpg'),
(108, 'Shi', 'Renew', '', '1', '1', '4', '3', 'Dalian', 'LiaoNing', 'China', 'CHINA', '1/11/1989', 'The Science and Technology of Hunan University', 'Bachelor of Engineering', '+8613261679531', 'timebear@gmail.com', 'Fan Juan', 'Mother', '+8615524731503', '65025', '1583561973-renew.jpg'),
(109, 'Sususco', 'Jemuel', '', '1', '1', '4', '3', 'Antipolo City', 'Rizal', '4A', 'PHL', '8/29/1994', 'ICCT Colleges Foundations, Inc.', 'BS Information Technology', '09070479521', 'sususcojemuel29@gmail.com', 'Jubilie S. Perocho', 'Sister', '09176374100', '65026', '1583559943-Jemuel.jpg'),
(110, 'Tano', 'Mark', '', '1', '1', '4', '3', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '10/29/1995', 'University of San Jose Recoletos', 'BS Civil Engineering', '09771414531/3849315', 'markwitness@gmail.com', 'Rebecca B. Tano', 'Mother', '09236229213', '65027', 'logo.png'),
(111, 'Tiu', 'John', '', '1', '1', '4', '3', 'Cebu City', 'Cebu', '7', 'PHL', '6/26/1996', 'University of San Carlos', 'BS HRM', '09955689172', 'johntiu2016@gmail.com', 'Alan Tiu', 'Father', '09176220917', '65028', '1583561994-john tiu.jpg'),
(112, 'Tual', 'Ben', '', '1', '1', '4', '3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '6/12/1995', 'Misamis University', 'BEED', '09099649135', 'none@gmail.com', 'Elsie Tual', 'Mother', '09099649135', '65029', '1583562048-Ben Tual.jpg'),
(113, 'Tumimbang', 'Ian', '', '1', '1', '4', '3', 'San Fernando', 'Bukidnon', '10', 'PHL', '3/18/1995', 'Bukidnon State University', 'Bachelor of Elementary Education', ' ', 'none@gmail.com', 'Lucio Millan', 'Co-worker', '09061985248', '65037', '1583562080-ian.jpg'),
(114, 'Yaw', 'Yves', '', '1', '1', '4', '3', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '10/10/1994', 'STI College of Caloocan', 'BSBM- Operations Management', '09164389795', 'jmsyvsw@gmail.com', 'Alma G. Yaw', 'Mother', '09333031509', '65030', '1583560344-Yves Yaw.jpg'),
(115, 'Acedera', 'Monsour', '', '1', '1', '1', '4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/24/1997', 'CMPI', 'BSIT', '09294081484', '', 'Meen Jameeel Ul-Haq', 'Brother', '09215866340', '64001', 'logo.png'),
(116, 'Almendras', 'Benedict John', '', '1', '1', '1', '4', 'Dasmari', 'Cavite', '4A', 'PHL', '8/21/1995', 'Cavite State University - Main Campus', 'Bachelor of Agricultural Entrepreneurship', '09057829237', 'almendrasbenjo@gmail.com', 'Bernard Q. Almendras', 'Father', '09395127297', '64002', '1582203359-benedict.jpg'),
(117, 'AraÃ±as', 'Paul James', '', '1', '1', '1', '4', 'Danao City', 'Cebu', '7', 'PHL', '5/15/1997', 'University of Cebu - Lapu-Lapu and Mandaue', 'Business Administration - Marketing Management', '09294950668', 'pauljamees21@gmail.com', 'Hanane Ara', 'Mother', '9506990292', '64004', '1582200864-1581996540-logo.png'),
(118, 'Arbutante', 'Jasper Jess', '', '1', '2', '1', '4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '2/12/1994', 'Bohol Island State University', 'Architecture', '09303968595', 'theredkim@gmail.com', 'Jessie Arbutante', 'Father', '9088933905', '64005', '1582202368-jasperjezz.jpg'),
(119, 'Armonio', 'Sherwin', '', '1', '1', '1', '4', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '10/9/1995', 'Navotas Polytechnic College', 'BSBA Major in Marketing', '', 'sherwincris.09@gmail.com', 'Aracell Calanog', 'Sister in the Lord', '9228168207', '64006', 'logo.png'),
(120, 'AvendaÃ±o', 'Mian', '', '1', '1', '1', '4', 'Malolos City', 'Bulacan', '3', 'PHL', '9/7/1996', 'Bulacan State University', 'BS in Mechatronics Engineering', '09292904240', 'mianavendano@gmail.com', 'Jesus Michael P. Avenda', 'Father', '09238993341', '64007', 'logo.png'),
(121, 'Baloran', 'Joseph', '', '1', '1', '1', '4', 'Kalawit ', 'Zamboanga Del Norte', '9', 'PHL', '8/26/1996', 'Sibugay Technical Institute Inc.', 'Bachelor of Technical Teacher Education', '09355109520', 'josephj4@gmail.com', 'Ipilan Baloran', 'Parent', '9262671950', '64008', 'logo.png'),
(122, 'Balucan', 'Jonhrielbert', '', '1', '1', '1', '4', 'Amadeo', 'Cavite', '4A', 'PHL', '11/9/1996', 'Cavite State University', 'BS Applied Mathematics', '09059574357', 'rielbert009@gmail.com', 'Ricky L. Balucan', 'Father', '09364230973', '64009', 'logo.png'),
(123, 'Balucan', 'Jovirimbert', '', '1', '1', '1', '4', 'Amadeo', 'Cavite', '4A', 'PHL', '8/14/1992', 'Cavite State University', 'BS Industrial Engineering', '09758365697', 'jovirimbertbalucan@gmail.com', 'Ricky L. Balucan', 'Father', '09364230973', '64010', '1582202178-Jovirimbert.jpg'),
(124, 'Bensola', 'Junrey', '', '1', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '12/28/1992', 'Cebu Technological University', 'BSIT - MST', '09495547701', 'junreybensula@gmail.com', 'Jeremiah Aba-a', 'Brother in Christ', '09097159072', '64011', 'logo.png'),
(125, 'Bensula', 'Christopher', '', '1', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '5/24/1993', 'Cebu Technological University', 'BSIT- RAC', '09173896295', 'christoffbenz@gmail.com', 'Jeremiah Aba-a', 'Brother in Christ', '09097159072', '64012', '1582201963-christopher.jpg'),
(126, 'Bensula', 'Edlerson', '', '1', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '12/19/1989', 'Cebu Technological University', 'BSIT - MST', '09368063035', 'none@gmail.com', 'Lydia Obligado', 'Sister in Christ', '09232882826', '64013', '1582202878-elderson.jpg'),
(127, 'Buenaflor', 'Mark Rigor', '', '1', '1', '1', '4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/21/1997', 'City of Malabon University', 'BS Management Accounting', '09557610548', 'markbuenaflor05@gmail.com', 'Gertrudes Buenaflor', 'Mother', '09555099064', '64014', 'logo.png'),
(128, 'Cai', 'Jan Zandro', '', '1', '1', '1', '4', 'Baras', 'Rizal', '4A', 'PHL', '2/21/1995', 'Manila Central University', 'Doctor of Optometry', '09269980515', 'janzandrocaina@ymail.com', 'Alejandro A. Cai', 'Father', '09172440804', '64015', 'logo.png'),
(129, 'CastaÃ±ares', 'Solomon Jr.', 'Lanoi', '1', '1', '1', '4', 'Maasim', 'Sarangani', '12', 'PHL', '10/8/1994', 'Ramon Magsaysay Memorial Colleges', 'Civil Engineering', '09207253602', 'solomoncastanares@gmail.com', 'Anette L. CastaÃ±ares', 'Mother', '09074217645', '64016', '1584362699-solomon.jpg'),
(130, 'Clavite', 'Elwin', '', '1', '1', '1', '4', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '10/1/1997', 'PHINMA - Cagayan de Oro College', 'BSIT - Multimedia', '09554197407', 'claviteelvin@gmail.com', 'Maria Clavite', 'Mother', '09161276920', '64018', '1582202809-elwin.jpg'),
(131, 'De La Fuente', 'Jasper', '', '1', '1', '1', '4', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '7/14/1997', 'Cagayan State University', 'BS Computer Engineering', '09063600850', 'jasperdelafuente@yahoo.com', 'Evelyn L. De La Fuente', 'Mother', '09175958566', '64020', '1582204293-jasper.jpg'),
(132, 'Dini-ay', 'David Neil', '', '1', '1', '1', '4', 'Dapitan City', 'Zamboanga del Norte', '9', 'PHL', '3/22/1996', 'Jose Rizal Memorial State University', 'Hotel and Restaurant Management', '0', 'none@gmail.com', 'Nilo Dini-ay', 'Father', '09502216739', '64022', '1582202488-david neil.jpg'),
(133, 'Elayan', 'Joycer', '', '1', '1', '1', '4', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '8/2/1995', 'University of Science and Technology of SP', 'BS Environmental ST', '09058022006', 'elayan888@gmail.com', 'Reuel Pallugna', 'Church Elder', '09069342816', '64023', 'logo.png'),
(134, 'Endino', 'Jemer', '', '1', '1', '1', '4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '9/29/1992', 'Zamboanga City State Polytechnic College', 'BSED Mathematics', '09365849537', 'none@gmail.com', 'Jason Insang', 'Boardmate', '09777980346', '64024', '1582202584-jemerendino.jpg'),
(135, 'Garcia', 'Jesus II', '', '1', '1', '1', '4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '3/19/1993', 'Surigao State College of Technology', 'Bachelor in Architectural Enginr', '09079648957', 'none@gmail.com', 'Nelba Garcia', 'Mother', '09652253754', '64025', '1582202693-jesustwo.jpg'),
(136, 'Hidalgo', 'John Bert', '', '1', '1', '1', '4', 'Imelda', 'Zamboanga Sibugay', '9', 'PHL', '2/26/1996', 'Western Mindanao State University - Imelda ESU', 'Bachelor of Arts in Political Science', '09365463817', 'none@gmail.com', 'Mary Jane Josol', 'Guardian', '09268202719', '64026', '1582201217-johnbert.jpg'),
(137, 'Huang', 'Antipas', '', '1', '1', '1', '4', 'Quanzhou', 'Fujian', 'China', 'CHINA', '1/9/1990', 'Huazhong Agricultural University', 'Feeding of Special Economic Animals', '86-13808502052', '', 'Huang Qinghai', 'Father', '86-13808502052', '660086', 'logo.png'),
(138, 'Ignacio', 'Jophet', '', '1', '1', '1', '4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '8/18/1993', 'Western Mindanao State University', 'BS Social Work', '09382126806', 'japhetignacio@yahoo.com', 'Anita Ignacio', 'Mother', '09102823057', '64027', 'img/'),
(139, 'Ihekweme', 'Benjamin ', '', '1', '1', '1', '4', 'Ojo', 'Lagos', 'Lagos', 'NIGERIA', '5/12/1967', 'n/a', '#N/A', '0', 'none@gmail.com', 'n/a', 'n/a', '0', '536', '1582201869-benjamin.jpg'),
(140, 'Imperio', 'Owen', '', '1', '1', '1', '4', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '7/18/1998', 'Colegio de San Juan de Letran', 'Marketing Management', '09054899395', 'owenimperio23@gmail.com', 'Edgar Imperio', 'Father', '09175167818', '64028', 'logo.png'),
(141, 'Lagare', 'Ephraim Jr.', '', '1', '1', '1', '4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '8/1/1993', 'Surigao State College of Technology', 'BA English Language and Literature', '09278247590', 'zeragal@ymail.com', 'Ephraim Lagare Sr. ', 'Father', '09176777617', '64029', '1582203458-ephraim.jpg'),
(142, 'Maghuyop', 'Melvin', '', '1', '1', '1', '4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '1/9/1997', 'Western Mindanao State University', 'BS Social Work', '09465529763', 'melvinmaghuyop@yahoo.com', 'Misraim Maghuyop', 'Mother', '09090505397', '64031', 'logo.png'),
(143, 'Mirafuentes', 'Lloyd', '', '1', '1', '1', '4', 'Manukan', 'Zamboanga Del Norte', '9', 'PHL', '9/30/1992', 'Saint Eslanislao Kostka College', 'BSBA - Marketing Management', '09500974603', 'mirafuenteslloyd@yahoo.com', 'Alberto Mirafuentes', 'Father', '09212650889', '64032', 'logo.png'),
(144, 'Momo', 'Ronard', '', '1', '1', '1', '4', 'Quezon', 'Bukidnon', '10', 'PHL', '5/5/1995', 'Bukidnon State University', 'Community Development', '', '', 'Gelbert Balabag', 'Uncle', '09357720180', '64033', 'logo.png'),
(145, 'Mondaya', 'Julius', '', '1', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '2/26/1991', 'Cebu Technological University', 'BSIT - Mechanical', '09254438941', 'Juliusmondaya@yahoo.com', 'Jeremiah Aba-a', 'Spiritual Father', '09097159072', '64034', 'logo.png'),
(146, 'Nini', 'Rich Jasper', '', '1', '1', '1', '4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '12/28/1997', 'Quezon City Polytechnic University', 'Industrial Engineering', '09555432305', 'richjaspernini1997@gmail.com', 'Richard Nini', 'Father', '09438296394', '64035', '1582201601-jaspernini.jpg'),
(147, 'Perocho', 'Kemwel', '', '1', '1', '1', '4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '1/27/1996', 'Western Mindanao State University - ESU', 'BS Scoial Work', '09075588863', '', 'Jesie Fernan', '', '09209682114', '64038', 'logo.png'),
(148, 'Quilar', 'Chrizolite', '', '1', '1', '1', '4', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '5/27/1997', 'JH Cerilles State College', 'BSIT', '09462635331', 'none@gmail.com', 'Juvelyn Dela Cruz', 'Sister', '09103677666', '64039', '1583562311-chrysolite.jpg'),
(149, 'Rama', 'Jesmar', '', '1', '1', '1', '4', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '12/25/1994', 'JH Cerilles State College', 'BS Animal Science', '09105258445', 'none@gmail.com', 'Kim Lodia', 'Elder', '09076199749', '64040', '1582203961-jesmar.jpg'),
(150, 'Rarugal', 'Renato Jr.', '', '1', '1', '1', '4', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '8/26/1997', 'Navotas Polytechnic College', 'Bachelor of Elementary Education', '09955715354', 'brotherrenato40@gmail.com', 'Araceli Cruz Canalog', 'Sister in Mtg. Hall', '09228168207', '64041', '1582201729-renato.jpg'),
(151, 'Redoble', 'Rey Jemes', '', '1', '1', '1', '4', 'Quezon', 'Bukidnon', '10', 'PHL', '10/19/1996', 'Central Mindanao University', 'BS Agriculture', '09974957716', 'reyjemes.redoble@gmail.com', '', '', '', '64042', 'logo.png'),
(152, 'Robledo', 'Micho', '', '1', '1', '1', '4', 'Tawi-Tawi', 'Tawi-Tawi', 'ARMM', 'PHL', '11/23/1995', 'MSU - Tawi-Tawi College of Technology and Oceanography', 'BS - Information Technoloy', '09461440950', 'mikean2araman@gmail.com', 'Michael Robledo', 'Father', '09482645720', '64043', 'logo.png'),
(153, 'Royo', 'Clyde', '', '1', '1', '1', '4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/9/1996', 'Polytechnic University of the Philippines', 'BSEE', '09217764385', 'clyde_royo@ymail.com', 'Diego Royo', 'Father', '09335451749', '64044', 'logo.png'),
(154, 'Sabiano', 'Romel', '', '1', '1', '1', '4', 'Roxas', 'Palawan', '4B', 'PHL', '8/23/1993', 'Palawan State University', 'BS Agriculture', '09353620903', 'romelsabiano@gmail.com', '', '', '', '64045', 'logo.png'),
(155, 'Sajonia', 'Rembrandt', '', '1', '1', '1', '4', 'Tarlac City', 'Tarlac', '3', 'PHL', '4/10/1995', 'Misamis University Oroquieta City', 'Bachelor of Elementary Education', '09107185130', 'rembrandt_sajonia@gmail.com', '', '', '', '64046', 'logo.png'),
(156, 'Sotero', 'Fernando Jr.', '', '1', '1', '1', '4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/16/1993', 'Dr. Aurelio Mendoza Memorial Colleges', 'BEED', '0', 'none@gmail.com', '-', '-', '0', '130', '1582204150-fernando.jpg'),
(157, 'Tabudlo', 'Marven Roy', '', '1', '1', '1', '4', 'Cotabato City', 'Maguindanao', '12', 'PHL', '12/28/1993', 'Sharriff Kabunsuan College Inc.', 'BSEd Major in English', '09465611079', 'marvenroy06@gmail.com', 'Magdalena A. Tabudlo', 'Mother', '09269589236', '64047', 'logo.png'),
(158, 'Tual', 'Julito', '', '1', '1', '1', '4', 'Cainta', 'Rizal', '4A', 'PHL', '11/26/1992', 'Westen Mindanao State University', 'Social Studies', '09552540180', 'julito_tual@yahoo.com', 'Eliezer Manliguez', 'none', '09509325038', '64048', '1582201122-julito.jpg'),
(159, 'Vergara', 'Dominador', '', '1', '1', '1', '4', 'Tabina', 'Zamboanga Del Sur', '9', 'PHL', '8/8/1993', 'JH Cerilles State College Tabina Campus', 'BSED English', '09469748526', 'none@gmail.com', 'Arnel Omas', 'Elder', '09463275608', '64049', '1582204428-dominador.jpg'),
(160, 'Villarubia', 'Khem', '', '1', '1', '1', '4', 'Don Carlos', 'Bukidnon', '10', 'PHL', '4/29/1995', 'Don Carlos Polytechnic College', 'BSIT', '09979904609', 'KHEMVILLARUBIA@gmail.com', 'Lucio Millan', '', '09061985248', '64050', 'logo.png'),
(161, 'Wang', 'Joseph', '', '1', '1', '1', '4', 'Ningbo', 'Zhejiang', 'China', 'CHINA', '4/5/1996', 'Wuhan University of Science and Technology', 'Materials Processing and Controlling Engineering', '18667838107', 'josephwang31@163.com', 'Wang Weiping', 'Father', '15558271627', '64051', 'logo.png'),
(162, 'Zonio', 'Gedione', '', '1', '1', '1', '4', 'Libacao City', 'Aklan', '6', 'PHL', '12/30/1992', 'Libacao College of Science and Technology', 'BS HRM', '09071986734', 'none@gmail.com', 'Giddy Zonio', 'Father', '09300906119', '64055', '1583562410-gedion.jpg'),
(163, 'Asuncion', 'John Oliver', '', '1', '1', '3', '1', 'San Juan', 'Ilocos Sur', 'I', 'PHL', '10/25/1997', 'polytechnic university of philippines-bataan', 'bsed-english', '9363546529', 'none@gmail.com', 'manuel jesus esteban', 'Father', '09302701304', '670001', '1583573869-Asuncion.jpeg'),
(164, 'Balingitao', 'Peniel', '', '1', '1', '3', '1', 'Tigbao', 'Zamboanga Del Sur', 'IX', 'PHL', '8/20/1994', 'josecina herira', 'bs-forestry', '09300444207', 'none@gmail.com', 'm&f', 'parents', '09300444707', '670002', '1583573910-Peniel.jpeg'),
(165, 'Bonghanoy', 'Ree', '', '1', '1', '3', '1', 'Molave', 'Zamboanga Del Sur', 'IX', 'PHL', '12/4/1994', ' ', 'bs-marine engineering', '9197578955', 'none@gmail.com', 'pablitab.bonghanoy', 'Mother', '09075249990', '670003', '1583585158-Binghanoy.jpeg'),
(166, 'Bulgar', 'Ronnel', '', '1', '1', '3', '1', 'Legazpi City', 'Albay', 'V', 'PHL', '10/18/1997', 'bicol university', 'bs-mechanical engineering', '9162126061', 'ronnelbulgar123@gmail.com', 'Nelia b.bulgar', 'Mother', '09173330500', '670004', '1583585262-Bulgar.jpeg'),
(167, 'Cabaddu', 'Ryan', '', '1', '1', '3', '1', 'Tuguegarao', 'Cagayan', 'II', 'PHL', '11/9/1994', 'saint paul university philippines', 'bs-accountancy', '9654971849', 'none@gmail.com', 'reynaldo a.cabaddu', 'Father', '09451903163/309-4582', '670005', '1583574054-Ryan.jpeg'),
(168, 'Calubag ', 'Maynard', '', '1', '1', '3', '1', 'Aloran', ' Misamis Occidental', 'X', 'PHL', '10/31/1992', 'misamis university ozamis city', 'bs-civil engineering', '9103018304', 'johnmaynardc@yahoo.com', 'vernie l.calubag', 'Father', '09124328104', '670006', '1583583620-Calubag.jpeg'),
(169, 'Candawan', 'Renz', '', '1', '1', '3', '1', 'Tagum', 'Davao Del Norte', 'XI', 'PHL', '4/15/1998', 'western mindanao state university', 'bsed-social studies', '9502211695', 'candawanrenz2@gmail.com', 'loida candawan', 'Mother', '09976131112/09644201284', '670007', '1583583662-Candawan.jpeg'),
(170, 'Cano', 'Gabriel', '', '1', '1', '3', '1', 'Cainta ', 'Rizal', 'IV-A', 'PHL', '4/28/1995', 'technological institute of the philippines-qc', 'bs-civil engineering', '9778459434', 'gabbyriel00@gmail.com', 'veronica u cano', 'Mother', '09175147739', '670008', '1583583699-Gabb.jpeg'),
(171, 'Castueras', 'Stephen', '', '1', '1', '3', '1', 'San Mateo', 'Rizal', 'IV-A', 'PHL', '7/7/1991', 'eulogio', 'bsit-electronics tech', '9475990703', 'seven.castueras@gmail.com', ' ', ' ', ' ', '670009', '1583583732-Castueras.jpeg'),
(172, 'Cellona', 'Ebenezer', '', '1', '1', '3', '1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '4/27/1996', 'centro escolar university', 'bs-accountancy', '9959324974', 'CELLONA.BENZ@GMAIL.COM', 'elena v.cellona', 'Mother', '09212091712', '670010', '1583583759-Cellona.jpeg'),
(173, 'De Guzman', 'Jhester', '', '1', '1', '3', '1', 'Malolos City', 'Bulacan', 'III', 'PHL', '9/19/1996', 'bulacan state university', 'BS-Industrial Tech major in Mechatonics', ' ', '.@gmail.com', ' ', ' ', ' ', '670044', '1583583807-De guzman.jpeg'),
(174, 'Dela Cruz', 'Nick', '', '1', '1', '3', '1', 'San Jose', 'Occidental Mindoro', '4B', 'PHL', '5/4/1992', 'occidental mindanao state college', 'bs-information technology', '09095432955', 'delacruznico505@gmail.com', 'arthur dela cruz', 'Father', '09480081917', '670011', '1583583837-Dela cruz.jpeg'),
(175, 'Dela Fuente', 'Jeffrey', '', '1', '1', '3', '1', 'Tuguegarao', 'Cagayan', 'II', 'PHL', '9/21/1997', 'cagayan state university', 'bs-civil engineering', '09973949044\09668025003', 'jeffreydelafuente30@gmail.com', 'alfredo jose s.dela fuente', 'Father', '09175192991', '670012', '1583583868-Dela fuente.jpeg'),
(176, 'Dela PeÃ±a', 'Ranel', '', '1', '1', '3', '1', 'Sergio Osme', 'Zamboanga Del Norte', 'IX', 'PHL', '6/16/1995', 'andres bonifacio college', 'bs-ed.english', '9121799944', 'raneldelapenae@gmail.com', 'fedelina e.dela Pe', 'Mother', '09466668203', '670013', '1583583919-Dela pena.jpeg'),
(177, 'Dulia', 'Willy', '', '1', '1', '3', '1', 'Talacogon', 'Agusan Del Sur', 'CARAGA', 'PHL', '9/21/1997', 'agusan del sur state college of agriculture&technology', 'BS Agriculture', '9389112393', 'dwillybert@gmail.com', 'Herlina B.Dulia', 'Mother', '09465119704', '670014', '1583583960-Dulia.jpeg'),
(178, 'Durac', 'Samson', '', '1', '1', '3', '1', 'Digos City', 'Davao del Sur', 'Xi', 'PHL', '4/19/1989', 'mat3 college of thec', 'bs-criminology', '9272932858', 'samsondurac6@gmail.com', 'jonathan m.durac', 'brother', '09988478607', '670015', '1583584031-Samson.jpeg'),
(179, 'Era', 'Christian ', '', '1', '1', '3', '1', 'Caloocan', 'Metro Manila', 'NCR', 'PHL', '1/19/1991', 'feu-institute of technology', 'bs-science in IT', '9567502737', 'christianera09@gmail.com', 'rizaldy era', 'Father', '09121410853', '670016', '1583584062-Era.jpeg'),
(180, 'EtcobaÃ±ez', 'Aaron', '', '1', '1', '3', '1', 'Tacloban City', 'Leyte', 'VIII', 'PHL', '5/18/1998', 'eastern visagas state university', 'bs-marketing', '9773507586', 'aaron.etcoba?ez15@gmail.com', 'ruel r.Etcoba', 'Father', '09205093568', '670017', '1583584099-Etcobanez.jpeg'),
(181, 'Fabe', 'J-Lorenzo', '', '1', '1', '3', '1', 'Iligan City', 'Lanao Del Norte', 'X', 'PHL', '10/31/1998', 'mindanao state university', 'be-math', '9068254806', 'jlorenzo.fabe@gmail.com', 'jefferson s.fabe', 'brother', '09464043614', '670018', '1583584127-Fabe.jpeg');
INSERT INTO `trainee_info` (`trainee_id`, `Last_Name`, `First_Name`, `Middle_Name`, `Gender`, `Status`, `Batch`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`, `profile_img`) VALUES
(182, 'Felias', 'Neil', '', '1', '1', '3', '1', 'Cagayan De Oro City', 'Misamis oriental', 'X', 'PHL', '9/4/1988', 'southern philippine college', 'b-elementry education', '9266456549', 'neilian_08@yahoo.com', 'romeo m.felias', 'Father', '09054166967', '670019', '1583584163-Felias.jpeg'),
(183, 'Flores', 'Rolly Mark', '', '1', '1', '3', '1', 'Roxas', 'Palawan', 'IV-B', 'PHL', '2/8/1997', 'palawan state university', 'bs-financial management', '9101199667', 'serolfkramy6llor@gmail.com', 'rosalie flores', 'Mother', '09967446834', '670020', '1583584196-Flores.jpeg'),
(184, 'Gabonada', 'Neron', '', '1', '1', '3', '1', 'Cagayan De ro City', 'Camiguin', 'X', 'PHL', '4/12/1999', 'camiguin polytechnic state college', 'bs-computer science', '9675784292', 'emkay30@gmail.com', 'edgar Gabonada', 'Father', '09263449169', '670021', '1583584243-Gabonada.jpeg'),
(185, 'Genelerao', 'Junry', '', '1', '1', '3', '1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '6/3/1994', 'jhcsc', 'bs-hrm', '9663696929', 'junrygenelerao@yahoo.com', 'maryjane f.genelerao', 'Mother', '09127462505/09124951359', '670022', '1583584279-Generalao.jpeg'),
(186, 'Gumiran', 'Jemarch', '', '1', '1', '3', '1', 'Quezon', 'Bukidnon', 'X', 'PHL', '3/22/1993', 'quezon institute of technology', 'b-elementry education', '9754173278', 'gumiran.jemarch@gmail.com', 'john rolan t.gumiran', 'brother', '09264495013', '670023', '1583584311-Gumiran.jpeg'),
(187, 'Juegos', 'Samuel', '', '1', '1', '3', '1', 'Iligan City', 'Lanao Del Norte', 'X', 'PHL', '1/26/1998', 'mindanao state university', 'bs-hrm', '9278768557', 'samuel54@gmail.com', 'marivic g.juegos', 'Mother', '09366731472', '670024', '1583584342-Juegos.jpeg'),
(188, 'Labastilla', 'Mannasseh', '', '1', '1', '3', '1', 'Molave', 'Zamboanga Del Sur', 'IX', 'PHL', '2/26/1999', 'western mindanao state university', 'bsed-english', '9661524882', '.@gmail.com', 'theresita b.celerinos', 'Mother', '09187290366', '670025', '1583584386-Labastilla.jpeg'),
(189, 'Lagos', 'Richard', '', '1', '1', '3', '1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '11/21/1993', 'western mindanao state university', 'bs-social work', '9197499336', '.@gmail.com', 'julean/norma lagos', 'parents', '09964459766', '670026', '1583584422-Lagos.jpeg'),
(190, 'Lape', 'Lourince', '', '1', '1', '3', '1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/6/1997', 'mindanao state university', 'bs-m', '9657297333', 'lapelourince@gmail.com', 'loremer l.lape', 'brother', '09124343327', '670027', '1583584453-Lape.jpeg'),
(191, 'Limbudan', 'Blend', '', '1', '1', '3', '1', 'Malita', 'Davao Occidental', 'XI', 'PHL', '7/9/1997', 'southern philippines agri-business&marine&aguahe technology school', 'bs-marine biology', '09758159186', '.@gmail.com', 'jumessa limbudan', 'sibling', '09755985086', '670028', '1583584490-Lembudan.jpeg'),
(192, 'Malaran', 'Anecito III', '', '1', '1', '3', '1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '6/23/1997', 'western mindanao state university', 'bsed-english', '9076242303', '.@gmail.com', 'anecito t.malaran.sr', 'Father', '09124472913', '670029', '1583584525-Malaran.jpeg'),
(193, 'Mamate', 'Roman', '', '1', '1', '3', '1', 'Lakewood', 'Zamboanga Del Sur', '9', 'PHL', '6/24/1994', 'jhcsc', 'bsed-english', '9382049925', '.@gmail.com', 'parents', 'parents', '09199918971', '670030', '1583584594-Mamate.jpeg'),
(194, 'Nericua', 'Daniel', '', '1', '1', '3', '1', 'Aloran', 'Misamis Occidental', 'X', 'PHL', '11/24/1996', 'western mindanao state university', 'bsed-mathematics', '9382184625', '.@gmail.com', 'jason m.nericua', 'brother', '09503389005', '670032', '1583584664-Nericua.jpeg'),
(195, 'Ordonio', 'Lloyd', '', '1', '1', '3', '1', 'Divilacan', 'Isabela', 'II', 'PHL', '10/24/1996', 'north eastern college', 'bs-geodetic engineering', '9365004236', 'lloydordonio24@gmail.com', 'agwido s.macatiag', 'uncle', '09754119836', '670033', '1583584704-Ordonio.jpeg'),
(196, 'Parungao', 'Joseph Joshua', '', '1', '1', '3', '1', 'Dasmari', 'Cavite', 'IV-A', 'PHL', '2/6/1998', 'cavite state university', 'bs-civil engineering', '9499336160', 'jparungao@yahoo.com', 'joey a.parungao', 'Father', '09975192299', '670034', '1583584739-Parungao.jpeg'),
(197, 'Penales', 'Reve', '', '1', '1', '3', '1', 'Tigbao', 'Zamboanga Del Sur', 'XI', 'PHL', '1/16/1998', 'jhcsc', 'bsed-english', '9301376428', 'dionysus.rjpenales@gmail.com', 'randy penales', 'brother', '09108810830', '670035', '1583584782-Penales.jpeg'),
(198, 'Ramos', 'John Mark', '', '1', '1', '3', '1', 'Navotas City', 'Metro Manila', 'NCR', 'PHL', '4/26/1994', 'novatas polytechnic college', 'bsba-marketing', '9668364099', 'jmkrms1994@gmail.com', 'araceli calang', 'deacon/s.o', '09228168207', '670036', '1583584813-Ramos.jpeg'),
(199, 'Rico', 'Radel', '', '1', '1', '3', '1', 'Camiling', 'Tarlac', 'III', 'PHL', '6/19/1991', 'tarlac state unicersity', 'bs-entrepreneurship', '9568895551', '.@gmail.com', 'orlando tabilisma ', 'brother in christ', '09050726740', '670037', '1583584851-Rico.jpeg'),
(200, 'San Pedro', 'Brylle', '', '1', '1', '3', '1', 'San Mateo', 'Rizal', 'IV-A', 'PHL', '8/10/1997', 'marikina polytechinic college', 'automotive technology', '9208328812', 'bryllesanpedro@yahoo.com', 'sean tasper castveras', 'shepherd', '09327328158', '670038', '1583584885-San pedro.jpeg'),
(201, 'Somblingo', 'Arvin', '', '1', '1', '3', '1', 'Tupi', 'South Cotabato', 'XII', 'PHL', '1/24/1998', 'seait', 'bsba-marketing', '9197887974', 'somblingoarvin@gmail.com', 'phoebe somblingo', 'Mother', '09382745044', '670039', '1583584967-Somblingo.jpeg'),
(202, 'Sumaong', 'Dan Marc', '', '1', '1', '3', '1', 'Camiling', 'Tarlac', 'III', 'PHL', '4/1/1993', 'tarlac agricultural university', 'beed', '9158734648', '.@gmail.com', 'romy tolentino ', 'spiritual father', '09327293933', '670040', '1583584931-Somaoang.jpeg'),
(203, 'Tambic', 'Rickson', '', '1', '1', '3', '1', 'La Trinidad', 'Benguet', 'CAR ', 'PHL', '11/10/1995', 'benguet state university', 'doctor of veterinary medicine', '9482767832', 'tambicrick@gmail.com', 'linda c.tambic', 'Mother', '09128869909', '670041', '1583585006-Tambic.jpeg'),
(204, 'Tanque', 'Noven', '', '1', '1', '3', '1', 'Bacolod', 'Negros Occidental', 'VI', 'PHL', '11/4/1995', 'carlos hilado memorial state college', 'bs-accountancy', '9999483356', 'marknorventanque@gmail.com', 'neann may j.tanque', 'sister', '09429505989', '670042', '1583585055-Tanque.jpeg'),
(205, 'Templado', 'Klint', '', '1', '1', '3', '1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '4/9/1999', 'pagadian capitol college', 'bs-criminology', ' ', 'klintpoponos@gmail.com', 'lelibeth m.templado', 'Mother', '09308668743', '670043', '1583585095-Templado.jpeg'),
(206, 'Abalde', 'Grace', '', '2', '1', '2', '2', 'Kumalarang', 'Zamboanga Del Sur', '9', 'PHL', '9/18/1996', 'Mindanao State University-Lanao Norte Agricultural College', 'BEED-General Education', '09361786325', 'none@gmail.com', 'Gerry Calwan Abalde', 'Father', '09557618025', '661001', '1583475520-Grace.jpg'),
(207, 'Aclao', 'Jee-lou', '', '2', '1', '2', '2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '5/15/1997', 'Medina College-Ozamisz City', 'BS-Pharmacy', '09300210145', 'none@gmail.com', 'Luzviminda Aclao', 'Mother', '09053405358', '661002', '1583652291-Jeelou_1.jpg'),
(208, 'Adcoy', 'Jizette', '', '2', '1', '2', '2', 'San Nicolas', 'Ilocos Norte', '1', 'PHL', '5/20/1997', 'Mariano Marcos State University', 'Bachelor of Science in Electrical Engineer', '09127862039', 'jizetteadcoy@gmail.com', 'Jaime Adcoy', 'Father', '09127862039', '661003', '1583475569-Jizette.jpg'),
(209, 'Anani', 'Olivia', '', '2', '1', '2', '2', 'Wuhan', 'China', 'China', 'CHINA', '11/12/1997', 'Hubei University of Technology', 'Business', '15623339105', 'oliviaanani97@gmail.com', 'qwert', 'qwe', '1234', '661004', '1583660418-Olivia Anani.jpg'),
(210, 'Apolinares', 'Leny', '', '2', '1', '2', '2', 'Antiquera', 'Bohol', '7', 'PHL', '9/13/1996', 'Bohol Island State University', 'BS Mechanical Engeneering', '09461143001/09458531620', 'lenyapolinares1@gmail.com', 'Dario P. Apolinares', 'Father', '09508076540/09078253032', '661005', '1583475609-Leny.jpg'),
(211, 'Arbois', 'Jasper', '', '2', '1', '2', '2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '11/15/1996', 'Mindanao State University-Iligan Institute of Technology', 'BS Electronics and Communication Engineer', '09106409363', 'jasperarbois15@gmail.com', 'Simfroso Arbois', 'Father', '09092885048', '661006', '1583476165-Jasper.jpg'),
(212, 'Arciosa', 'Marry Claire', '', '2', '1', '2', '2', 'Pasay', 'Metro Manila', 'NCR', 'PHL', '8/16/1996', 'STI College Paranaque', 'BSIT Major in Programming', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661007', '1583475667-Claire.jpg'),
(213, 'Baco', 'Raschelle', '', '2', '1', '2', '2', 'Midsalip', 'Zamboanga Del Sur', '9', 'PHL', '1/9/1997', 'Josefina Herrera Cerilles State College', 'Bachelor of Science in Elementary Education', '09465358695', 'rachellebaco@gmail.com', 'Ailyn Alvaro', 'Sister', '09469274161', '661008', '1583475696-Raschelle.jpg'),
(214, 'Balucan', 'Noraine Joy', '', '2', '1', '2', '2', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '12/14/1993', 'Jose Rizal Memorial State University', 'BSHRM', '1234', 'none@gmail.com', 'qwert', 'qwer', '1234', '661009', '1583475745-Noraine.jpg'),
(215, 'Barcelo', 'Emerald', '', '2', '1', '2', '2', 'Pantabangan', 'Nueva Ecija', '3', 'PHL', '3/31/1993', 'Philippine Merchant Marine School', 'BS in Customs Administration', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661010', '1583477158-Emerald.jpg'),
(216, 'Bastillada', 'Ninfa', '', '2', '1', '2', '2', 'Mandaue City', 'Cebu', '7', 'PHL', '6/1/1994', 'University of Cebu', 'BS Secondary Education-English', '09225455675', 'nininbastillada123@gmail.com', 'Jusue Bastillada', 'Brother', '09169951661', '661011', '1583476914-Ninfa.jpg'),
(217, 'Batitang', 'Casey Vi', '', '2', '1', '2', '2', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '10/14/1998', 'Mindanao State University-Iligan Institute of Technology', 'Bachelor of Arts in History', '09121673197', 'batitangcaseyvi@gmail.com', 'Sheila Vi Batitang', 'Sister', '09073069974', '661012', '1583476129-Casey Vi.jpg'),
(218, 'Bawalan', 'Trixie', '', '2', '1', '2', '2', 'Silang', 'Cavite', '4A', 'PHL', '12/24/1998', 'Cavite State University', 'BA Journalism', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661013', '1583476099-Trixie Bawalan.jpg'),
(219, 'Benolirao', 'Eden', '', '2', '1', '2', '2', 'Minglanilla', 'Cebu', '7', 'PHL', '12/9/1997', 'University of Cebu', 'BS Management Accounting', '09205794378', 'edenbenolirao09@gmail.com', 'Jeseca M. Benolirao', 'Mother', '09339757096', '661014', '1583476071-Eden.jpg'),
(220, 'Bermejo', 'Ivy', '', '2', '1', '2', '2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/4/1995', 'University of Rizal System', 'BSE-English', '09294932915', 'ivybermejo.980@gmail.com', 'Raquel Rueles', 'Churchmate', '09062827640', '661015', '1583476049-Ivy.jpg'),
(221, 'Bernal', 'Daniella', '', '2', '1', '2', '2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '7/11/1998', 'The National Teachers College', 'BSE-English', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661016', '1583475979-Daniela.jpg'),
(222, 'Buco', 'Evelyn', '', '2', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '8/16/1995', 'Golden Heritage Polytechnic College', 'BS in Office Administration', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661017', '1583475948-Evelyn Buco.jpg'),
(223, 'Cabatingan', 'Angelica', '', '2', '1', '2', '2', 'Remedios Trinidad Romualdez', 'Agusan Del Norte', '10', 'PHL', '11/17/1997', 'Xavier Ateneo De Cagayan University', 'AB International Studies', '09161559687', 'lykacabatingan@gmail.com', 'Bonifacio P. Cabatingan', 'Father', '1234', '661018', '1583475892-Angelica Cabatingan.jpg'),
(224, 'Calog', 'Shizah', '', '2', '1', '2', '2', 'Plaridel', 'Misamis Occidental', '10', 'PHL', '4/6/1999', 'Foundation University', 'BSBA-Management Accounting', '09095333769', 'calogshizah@gmail.com', 'Russell Calog', 'Mother', '09752278921', '661019', '1583475862-Shizah.jpg'),
(225, 'Camacam', 'Jahze-el', '', '2', '1', '2', '2', 'Santiago City', 'Isabela', '2', 'PHL', '11/14/1998', 'University of the Philippines Los Banos', 'BS Biology (Zoology)', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661020', '1583475824-Jahzeel.jpg'),
(226, 'Cambangay', 'Mary Queen', '', '2', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '10/23/1997', 'Pilgrim Christian College', 'BEED- Early Childhood Education', '09058483369', 'maryqueenc.patag@gmail.com', 'Uriel Cambangay', 'Father', '09355453642', '661021', '1583475786-Mary Queen.jpg'),
(227, 'Canapi', 'Ma. Josel', '', '2', '1', '2', '2', 'Bi', 'Laguna', '4A', 'PHL', '6/29/1998', 'Cavite State University-Don Severino De Las Alas Campus', 'BS in Development Management', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661022', '1583476016-Josel.jpg'),
(228, 'Chen', 'Prisca', '', '2', '1', '2', '2', 'Wen Zhou', 'Zhe Jiang', 'China', 'CHINA', '7/17/1998', 'Zhejiang Industrial and Commercial College of Technology', 'International Trade Affairs', ' ', 'none@gmail.com', ' ', ' ', ' ', '661024', '1583664288-Prisca.jpg'),
(229, 'Chen', 'Cindy', '', '2', '1', '2', '2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '8/28/1997', 'Taizhou University ', 'English', '17858667036', '871732157@99.com', 'Shao Zhao Chen ', 'Father', '13587854836', '661025', '1583664415-Cindy.jpg'),
(230, 'Cokee', 'Michelle', '', '2', '1', '2', '2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '5/4/1982', 'Philippine Womens University', 'BSHM-Culminary', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661026', '1583477864-Michelle Cokee.jpg'),
(231, 'Conde', 'Caselyn', '', '2', '1', '2', '2', 'Balanga', 'Bataan', '3', 'PHL', '12/28/1998', 'Bataan Peninsula State University', 'BSBA-Operations Management', '09452441550', 'condecaselyn@yahoo.com', 'Ruth Conde', 'Mother', '09502533515', '661027', '1583477902-Caselyn.jpg'),
(232, 'De la Fuente', 'Angelica', '', '2', '1', '2', '2', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '10/9/1998', 'Cagayan State University (Andrew', 'BS in Enterpreneurship', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661029', '1583477946-Angelica Dela Fuente.jpg'),
(233, 'DeguiÃ±on', 'Rotchelle', '', '2', '1', '2', '2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '1/18/1999', 'Bukidnon State University', 'BA-Social Science', '09363414966', 'deguirotchelle@gmail.com', 'Dennis Pacturan', 'Brother', '1234', '661028', '1583477989-Rotchelle.jpg'),
(234, 'Dosdos', 'Mary Jane', '', '2', '1', '2', '2', 'Magsaysay', 'Occidental Mindoro', '4B', 'PHL', '1/23/1999', 'OMSC-Murtha Campus', 'BS Agricultural Education', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661030', '1583478034-Mary Jane.jpg'),
(235, 'Du', 'Dylan', '', '2', '1', '2', '2', 'Shanghai', 'China', 'China', 'CHINA', ' ', ' ', ' ', ' ', 'none@gmail.com', ' ', ' ', ' ', '661109', '1583661703-dylan.jpg'),
(236, 'Dumadag', 'Leacel', '', '2', '1', '2', '2', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '9/30/1996', 'Western Mindanao State University', 'BEED', '09500997398', 'leaceldumadag28@yahoo.com', 'qwert', 'qwe', '1234', '661031', '1583478084-Leacel.jpg'),
(237, 'Dumalay', 'Jenesa', '', '2', '1', '2', '2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '2/11/1998', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Botany)', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661032', '1583652087-Jenesa.jpg'),
(238, 'Dumayas', 'Gladys', '', '2', '1', '2', '2', 'Tigbao', 'Zamboanga Del Sur', '9', 'PHL', '1/16/1997', 'Our Lady of Fatima University-Valenzuela', 'BS in Medical Technology', '09277317091', 'sansandumayas@gmail.com', 'Nelida Dumayas', 'Mother', '09198559669/09175055121', '661033', 'logo.png'),
(239, 'Elag', 'Sheryl', '', '2', '1', '2', '2', 'Jimenez', 'Misamis Occidental', '10', 'PHL', '12/15/1995', 'University of Science and Technology of Southern Philippines', 'BSE-TLE', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661034', '1583484977-Sheryl.jpg'),
(240, 'Entia', 'Lorely', '', '2', '1', '2', '2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '7/30/1990', 'Western Mindanao State University', 'Bachelor of Elementary Education', '09061702544', 'I_entia@gmail.com', 'Glorype Ruiles/Shiela Entia', 'Mother', '09354933417/09364139244', '661035', '1583487309-Lorely.jpg'),
(241, 'Esmade', 'Abelyn', '', '2', '1', '2', '2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '2/18/1999', 'Polytechnic University of the Philippines', 'BA Broadcast Communication', '09295427140', 'abelynesmade@gmail.com', 'Emelyn Esmada', 'Mother', '09153322303', '661036', '1583485287-Abelyn Esmade.jpg'),
(242, 'Estipona', 'Rosemarie', '', '2', '1', '2', '2', 'Irosin', 'Sorsogon', '5', 'PHL', '5/20/1997', 'Veritas College of Irasin', 'BSBA Financial Management', '09093203855', 'inchrist.rosemarie@gmail.com', 'Adelta Guarte', 'Guardian', '09389529566', '661037', '1583487516-Rosemarie.jpg'),
(243, 'Garcia', 'Richael', '', '2', '1', '2', '2', 'Bogo City', 'Cebu', '7', 'PHL', '7/9/1996', 'Madridesos Community College', 'BSE Major in Filipino', '09121144836', 'garciarichael30@gmail.com', 'Elsa Garcia', 'Mother', '09103441751', '661039', '1583488408-richael.jpg'),
(244, 'Gavino', 'Hannah', '', '2', '1', '2', '2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '9/14/1998', 'University of Caloocan City', 'BS in Accounting Technology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661040', '1583652475-Precious Hannah.jpg'),
(245, 'Gealon', 'Shiegella', '', '2', '1', '2', '2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '9/19/1998', 'Siliman University', 'Bachelor of Mass Communication', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661041', '1583661447-Shiegella.jpg'),
(246, 'Giwo', 'Ezeria', '', '2', '1', '2', '2', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '10/29/1995', 'Cagayan State University', 'BS in Agricultural Engineering', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661042', '1583661362-Ezeria.jpg'),
(247, 'Gonzales', 'Emmanuela', '', '2', '1', '2', '2', 'Dasmari', 'Cavite', '4A', 'PHL', '5/1/1997', 'De La Salle University-Dasmarinas', 'BSE-English', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661043', '1583661239-Emmanuela.jpg'),
(248, 'Gutang', 'Cherry Rose', '', '2', '1', '2', '2', 'Minglanilla', 'Cebu', '7', 'PHL', '9/9/1998', 'University of San Jose-Recoletos', 'AB International Studies', '09297798354', 'cherrykaye034@gmail.com', 'Lorna Gutang', 'Mother', '09494686309', '661044', '1583661150-Cherry Rose.jpg'),
(249, 'Hernandez', 'Mary Grace', '', '2', '1', '2', '2', 'Canaman', 'Camarines Sur', '5', 'PHL', '12/22/1992', 'Bicol State College of Applied Sciences and Technology', 'BS Elementary Education', '09467229397', 'marygracemacasinaghernando@gmail.com', 'Manuela Hernandez', 'Mother', '09123310081/ 09480217656', '661045', '1583661035-mary grace hernandez.jpg'),
(250, 'Ibale', 'Jesly faith', '', '2', '1', '2', '2', 'Cebu City', 'Cebu', '7', 'PHL', '11/17/1991', 'Cebu Technological University', 'BS Civil Engineering', '09326110569', 'jeslyfaithibale@gmail.com', 'Lydia Obligado', 'Guardian', '09232882826', '661046', '1583660878-Jesly.jpg'),
(251, 'Ilao', 'Carina', '', '2', '1', '2', '2', 'Mariveles', 'Bataan', '3', 'PHL', '12/10/1989', 'Polytechnic University of the Philippines-Bataan', 'BS Accountancy', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661047', '1583660795-Carina.jpg'),
(252, 'Imperio', 'Reynalie', '', '2', '1', '2', '2', 'Vigan', 'Ilocos Sur', '1', 'PHL', '11/3/1998', 'University of Northern Philippines', 'BSBA Human Resource Development Management', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661048', '1583660715-Reynalie.jpg'),
(253, 'Lee', 'Hannah', '', '2', '1', '2', '2', 'Ansan', 'South Korea', 'South Korea', 'SOUTH KOREA', '9/27/1992', 'Wonju-sangi University', 'English-TESOL', '01030697023', 'littlelee@naver.com', 'Testimony Kim', ' ', '01075458087', '661051', '1583664181-Hannah.jpg'),
(254, 'Mabasle', 'Onyza', '', '2', '1', '2', '2', 'Sibagat', 'Agusan Del Sur', '13 (CARAGA)', 'PHL', '11/13/1996', 'Agusan Del Sur College', 'Bachelor of Arts in English', '093831663292', 'none@gmail.com', 'Felipe Mabasle', 'Father', '09125133977', '661052', '1583660603-Onyza.jpg'),
(255, 'Madrid', 'Olivia', '', '2', '1', '2', '2', 'San Mateo', 'Isabela', '2', 'PHL', '10/4/1996', 'Cagayan Valley Computer and Information Technology College, Inc.', 'Bachelor of Science in Accountancy', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661053', '1583660522-Olivia.jpg'),
(256, 'Maghanoy', 'Shella', '', '2', '1', '2', '2', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '6/10/1997', 'City of Malabon University ', 'BSE Mapeh', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661054', '1583660168-Shella.jpg'),
(257, 'Mapute', 'Cherry Mae', '', '2', '1', '2', '2', 'Aloran', 'Misamis Occidental', '10', 'PHL', '4/24/1994', 'Western Mindanao State University', 'BSEd Major in English', '  ', 'none@gmail.com', ' ', ' ', ' ', '661055', '1583660052-cherrymae.jpg'),
(258, 'Marquilla', 'Armelyn', '', '2', '1', '2', '2', 'Bayugan', 'Agusan Del Sur', '13 (CARAGA)', 'PHL', '5/19/1999', 'Philippine Normal University- Mindanao Campus', 'BS in Early Childhood', '09463574670', 'armelynalways99@gmail.com', 'Aida M. Permi', 'Mother', '09487972791', '661056', '1583659925-Armelyn.jpg'),
(259, 'Matas', 'Daylene', '', '2', '1', '2', '2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '6/27/1996', 'Bukidnon State University', 'BA-Social Science', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661057', '1583659836-Daylene.jpg'),
(260, 'Mavunga', 'Privilege', '', '2', '1', '2', '2', 'Hangzhou', 'China', 'China', 'CHINA', '9/25/1994', 'Zhejiang Gongshang University', 'BS International Law', '1234', 'privyy251@yahoo.com', 'Mavunga Otilia', 'Mother', '263 772 961 327 ', '661058', '1583659746-Privilege.jpg'),
(261, 'Miagao', 'Veronijean', '', '2', '1', '2', '2', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '8/18/1997', 'Surigao State College of Technology', 'AB English Language & Literature', '09074064816', 'jinjinmiagao@gmail.com', 'Veronica Miagao ', 'Mother', '09309341526', '661059', '1583659615-Veronijean.jpg'),
(262, 'Mondejar', 'Ch''ry Jnyth', '', '2', '1', '2', '2', 'Iligan City', 'Lanao del Norte', '10', 'PHL', '8/25/1998', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Zoology)', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661060', '1583659536-Jnyth.jpg'),
(263, 'Monteseven', 'Julita', '', '2', '1', '2', '2', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '11/16/1997', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Zoology)', '09068433476', 'juliemonterseven@gmail.com', 'Pablita Monteseven', 'Mother', '09554782126', '661061', '1583477729-Julita.jpg'),
(264, 'Monteseven', 'Mary Joy', '', '2', '1', '2', '2', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '12/20/1996', 'University of Science and Technology of Southern Philippines', 'Bachelor of Science in Med Tech', '09489255702', 'mj.mondeseven.must@gmail.com', 'qwerty', 'qwert', '1234', '661062', '1583659454-Mary Joy.jpg'),
(265, 'Nadao', 'Archelyn', '', '2', '1', '2', '2', 'Carrascal', 'Surigao Del Sur', '13 (CARAGA)', 'PHL', '8/7/1997', 'Saint Paul University Surigao', 'BS in Accounting Technology', '09106435017', 'archelynrosenadao@gmail.com', 'Estrelita Nadao', 'Mother', '9092644433', '661063', '1583659295-Archelyn Nadao.jpg'),
(266, 'Nericua', 'Noeme', '', '2', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '7/10/1994', 'Golden Heritage Polytechnic College', 'BSOA - Major in Office Management', '', '', '', '', '', '661064', 'logo.png'),
(267, 'Oga', 'Mercy Mae', '', '2', '1', '2', '2', 'Sibutad', 'Zamboanga del Norte', '9', 'PHL', '6/16/1997', 'Mindanao State University-Marawi City', 'BSBA Management', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661065', '1583659030-Mercy.jpg'),
(268, 'Omas', 'Freshness', '', '2', '1', '2', '2', 'Tabina', 'Zambonga del Sur', '9', 'PHL', '1/25/1998', 'Mindanao State University-Iligan Institute of Technology', 'BSBA Business Economics', '09477890633', 'freshness.omas@gmsuit.edu.ph', 'Arnel Omas', 'Father', '09463275608', '661067', '1583658891-Freshness.jpg'),
(269, 'Ondac', 'Belen', '', '2', '1', '2', '2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '10/22/1987', 'Marian College', 'Bachelor of Science in Commerce', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661068', '1583658813-Belen Ondac.jpg'),
(270, 'Onsing', 'Cresill Mae', '', '2', '1', '2', '2', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '7/12/1995', 'De La Salle Araneta University', 'AB-Psychology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661069', '1583658721-Cresill.jpg'),
(271, 'Ontao', 'Sunshine', '', '2', '1', '2', '2', 'Amai Manabilang', 'Lanao Del Sur', 'ARMM', 'PHL', '10/22/1996', 'Bukidnon State University', 'BA-Social Science', '09363547872', 'Shineontao@gmail.com', 'Dines Pacturan', 'Brother', '09362316148', '661070', '1583477816-Sunshine.jpg'),
(272, 'Paderes', 'Jeanyfair', '', '2', '1', '2', '2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '9/29/1998', 'Philippine Normal University', 'Bachelor in Science Education-Biology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661071', '1583658533-Jeany fair.jpg'),
(273, 'Pagaoa', 'Betina Faye', '', '2', '1', '2', '2', 'Tanza', 'Cavite', '4A', 'PHL', '6/20/1999', 'Cavite State University Main Campus', 'Information Technology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661073', '1583656462-Betina Faye.jpg'),
(274, 'Palomar', 'Shekinah', '', '1', '1', '2', '2', 'Sablayan', 'Occidental Mindoro', '4B', 'PHL', '12/18/1998', 'Our Lady of Fatima University - Val', 'Bachelor of Science in Pharmacy', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661074', '1583656374-Shekinah.jpg'),
(275, 'Pancho', 'Beulah', '', '2', '1', '2', '2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '12/15/1995', 'Pateros Technological College', 'BS Office Administration', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661075', '1583656014-Beulah.jpg'),
(276, 'Pilota', 'Kathleen', '', '2', '1', '2', '2', 'Minglanilla', 'Cebu', '7', 'PHL', '3/13/1998', 'University of San Jose-Recoletos', 'Business Administration', '09205794443', 'kathleenpilota13@gmail.com', 'Jocelyn Pilota', 'Mother', '09433699544', '661076', '1583655832-Kathleen.jpg'),
(277, 'Plata', 'Ruth', '', '2', '1', '2', '2', 'Casiguran', 'Aurora', '3', 'PHL', '3/5/1997', 'Arellano University', 'Bachelor of Science in Accountancy', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661077', '1583655729-Ruth.jpg'),
(278, 'Ramil', 'Felcrist', '', '1', '1', '2', '2', 'Salvador', 'Lanao Del Norte', '10', 'PHL', '3/18/1993', 'North Central Mindanao Colleges', 'BS Elementary Education', '09363672605', 'none@gmail.com', 'Feliciano Ramil', 'Father', '09974131346', '661079', '1583655563-Felcrist.jpg'),
(279, 'Restauro', 'Gladys Suzzane', '', '2', '1', '2', '2', 'Don Carlos', 'Bukidnon', '10', 'PHL', '5/7/1987', 'Don Carlos Polytechnic College', 'Bachelor of Arts in Economics', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661080', '1583655337-Gladys.jpg'),
(280, 'Retagle', 'Chelsie', '', '2', '1', '2', '2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '8/13/1996', 'Eulogio "Amang" Rodriguez Institute of Science and Technology', 'BSBA-Marketing', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661081', '1583655223-Chelsee.jpg'),
(281, 'Ricarte', 'Shula Mae', '', '2', '1', '2', '2', 'Ormoc City', 'Leyte', '8', 'PHL', '9/28/1998', 'Western Leyte College Inc.', 'BSED-English', '1234', 'none@gmail.com', 'qwert', 'qwe', '1234', '661082', '1583477776-Shula mae.jpg'),
(282, 'Rosales', 'Phoebe Grace', '', '2', '1', '2', '2', 'Bacoor', 'Cavite', '4A', 'PHL', '8/13/1998', 'Cavite State University Main Campus', 'Information Technology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661083', '1583655107-Phoebe Rosales.jpg'),
(283, 'Roxas', 'Maeriehl Joy', '', '2', '1', '2', '2', 'Pagbilao', 'Quezon', '4A', 'PHL', ' ', ' ', 'BS Marketing', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661084', '1583655003-Maehriel.jpg'),
(284, 'San Pedro', 'Beverly', '', '2', '1', '2', '2', 'San Mateo', 'Rizal', '4A', 'PHL', '10/18/1992', 'San Mateo Municipal College', 'Marketing Management', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661085', '1583654813-Beverly.jpg'),
(285, 'Sardual', 'Evelyn', '', '2', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '2/5/1992', 'Golden Heritage Polytechnic College', 'BS Office Administration', ' ', 'none@gmail.com', ' ', ' ', ' ', '661086', '1583650630-Evelynn Sardual-removebg-preview.jpg'),
(286, 'Sebial', 'Mary Mae', '', '2', '1', '2', '2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '1/21/1997', 'University of Science and Technology of Southern Philippines', 'Bachelor of Secondary Education-TLE', '09976577377', 'marymaesebial@gmail.com', 'Merly Serbial-Carpio', 'Mother', '09051600751', '661087', '1583654682-Mary mae Sebial.jpg'),
(287, 'Sebonga', 'Jolina', '', '2', '1', '2', '2', 'Surigao City', 'Surigao del Norte', '13 (CARAGA)', 'PHL', '8/30/1998', 'Surigao State College of Technology', 'BS Environmental Science', '09483824908', 'jolina.sebonga19@gmail.com', 'Arlene P. Sebonga', 'Mother', '09464693228', '661088', '1583654392-Jolina.jpg'),
(288, 'Servanda', 'Jersy', '', '2', '1', '2', '2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '12/4/1998', 'Taguig City University', 'Bachelor of Secondary Education', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661089', '1583654291-Jersy.jpg'),
(289, 'Siuyco', 'Olive', '', '2', '1', '2', '2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '5/23/1996', 'Misamis University', 'BSED-English', '09465935699', 'osiuyco@gmail.com', 'Erlinde M. Siuyco', 'Mother', '09462340571', '661090', '1583653075-Olive.jpg'),
(290, 'Solis', 'Khristine', '', '2', '1', '2', '2', 'Marilao', 'Bulacan', '3', 'PHL', '4/18/1999', 'Bulacan State University-Sarmiento Campus', 'Information Technology', '09050465068', 'khristinesolis18@gmail.com', 'Joseph Solis', 'Father', '09332320975', '661091', '1583471794-Kristine, Solis.jpg'),
(291, 'Sorongon', 'Sierra', '', '2', '1', '2', '2', 'New Lucena', 'Iloilo', '6', 'PHL', '10/5/1998', 'West Visayas State University ', 'BS Applied Mathematics ', '1234', 'sierramesorongon@yahoo.com', 'Arleen T. Sorongon', 'Mother', '09456018564', '661092', '1583652928-Sierra.jpg'),
(292, 'Suaso', 'Crisna', '', '2', '1', '2', '2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '2/8/1997', 'Bukidnon State University', 'BA-Social Science', '09067111475', 'crisnajeansuaso@gmail.com', 'Dennis Pacturan', 'Brother', '09362316148', '661093', '1583652693-Crisna.jpg'),
(293, 'Tadiar', 'Angel Joy', '', '2', '1', '2', '2', 'Rodriguez', 'Rizal', '4A', 'PHL', '7/23/1995', 'National University', 'Accounting Technology', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661094', '1583652591-Angel Joy Tadiar.jpg'),
(294, 'Tagnipis', 'Jemima', '', '2', '1', '2', '2', 'General Santos City', 'South Cotabato', '12', 'PHL', '11/14/1998', 'Holy Trinity College', 'BSBA Marketing Management', '09101477222', 'tagnipisjemimacraft@gmail.com', 'Frisco N. Tagnipis', 'Father', '09101309880', '661095', '1583488874-Jemima.jpg'),
(295, 'Talig', 'Grace May', '', '2', '1', '2', '2', 'General Santos City', 'South Cotabato', '12', 'PHL', '10/8/1996', 'Southern Philippines Academy College', 'Bachelor of Elementary Education', '09075670686', 'talig.gracemay@yahoo.com', 'Renato Talig', 'Father', '09288511543', '661096', '1583488752-Grace mae.jpg'),
(296, 'Tumimbang', 'Aida', '', '2', '1', '2', '2', 'San Fernando', 'Bukidnon', '10', 'PHL', '8/5/1997', 'Bukidnon State University', 'BSBA Major in Financial Management', '09557446015', 'aidatumimbang20@gmail.com', 'Dennis Pacturan', 'Brother', '09362316148', '661098', '1583488630-Aida Tumimbang.jpg'),
(297, 'Tunay', 'Elisha May', '', '2', '1', '2', '2', 'Casiguran', 'Aurora', '3', 'PHL', '5/28/1995', 'Aurora State College of Technology', 'BS Civil Engineering', '1234', 'none@gmail.com', 'qwerty', 'qwert', '1234', '661099', '1583488538-Elisha.jpg'),
(298, 'Viernes', 'Judy Ann', '', '2', '1', '2', '2', 'Badoc', 'Ilocos Norte', '1', 'PHL', '7/12/1996', 'Mariano Marcos State University', 'BS Cooperative Management', '09207996036', 'cabanglanjhudyanne@gmail.com', 'Melba Viernes', 'Mother', '09095524298', '661100', '1583484294-Judy Ann Vire.jpg'),
(299, 'Wang', 'Sally', '', '2', '1', '2', '2', 'Shaoxing', 'Zhe Jiang', 'China', 'CHINA', '7/16/1996', 'Ningbo University of Technology', 'English', ' ', 'none@gmail.com', ' ', ' ', ' ', '661101', '1583664050-Sally.jpg'),
(300, 'Wang', 'Nicole', '', '2', '1', '2', '2', 'Hangzhou', 'Zhe Jiang', 'China', 'CHINA', '10/4/1998', 'Zhejiang Yuying Vocational and Technical College', 'Major in Secretary', ' ', 'none@gmail.com', ' ', ' ', ' ', '661102', '1583663923-Nicole.jpg'),
(301, 'Wang', 'Abby', '', '2', '1', '2', '2', 'Jinan', 'Shandong', 'China', 'CHINA', '1/1/1998', 'Shandong Polytechnic', 'Bachelor of Science in Accountancy', ' ', 'none@gmail.com', ' ', ' ', ' ', '661103', '1583664354-Wang, Abby.jpg'),
(302, 'Wang', 'Della', '', '2', '1', '2', '2', 'Shanghai', 'China', 'China', 'CHINA', '10/11/1997', 'Danghua University', 'Textile', '18613795383059', '1394158443@99.com', ' ', ' ', ' ', '661104', '1583384581-Wang, Della.jpg'),
(303, 'Weng', 'Alivia', '', '2', '1', '2', '2', 'Qu Zhou', 'Zhe Jiang', 'China', 'CHINA', '12/3/1996', 'Lu Zhou Institute of Technicians', 'Preschool Educations', '1515072004', '787374625@qq.com', 'Wang Yong Mei', 'Mother', '15157072004', '661105', '1583663854-Weng. Alivia.jpg'),
(304, '', 'Hanna', '', '2', '1', '2', '2', 'X', 'X', 'X', 'X', '8/28/1979', '', '', '', 'Parvane.159@gmail.com', 'Rasool', '', '09128432507', '661106', 'logo.png'),
(305, 'Abella', 'Caryl', ' ', '2', '1', '4', '3', 'Mandaluyong', 'Metro Manila', 'NCR', 'PHL', '2/5/1995', 'Stella Maris College', 'BS Accountancy', '09983835214', 'carylab234@yahoo.com', 'Anita Hayao', 'Sister', '09983835214', '65154', '1583729436-Caryl-removebg-preview.jpg'),
(306, 'Ambet', 'Crystalene', ' ', '2', '1', '4', '3', 'Lapuyan', 'Zamboanga Del Sur', '9', 'PHL', '4/13/1997', 'J.H. Cerilles State College', 'BEED', '13/04/97', '.@gmail.com', 'Aton Ambet', 'Father', '09161312652', '65102', '1583729760-Crytalene-removebg-preview.jpg'),
(307, 'Ang', 'Blossom', ' ', '2', '1', '4', '3', 'Cebu City', 'Cebu', '7', 'PHL', '9/26/1987', 'Cebu Doctor', 'BS Nursing', '09272199320/ (032) 2683424', 'fastpay.encashment@gmail.com', 'Johnny Ang', 'Father', '09066823088', '65103', '1583736472-Blossom-removebg-preview.jpg'),
(308, 'Anuario', 'Dhevi Ann', ' ', '2', '1', '4', '3', 'Tubod', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '10/31/1996', 'Northeastern Mindanao Colleges', 'Bachelor of Elementary Education', '09501592262', 'dheviann.annuario@gmail.com', 'Virgilio L. Anuario', 'Father', '09501592262', '65104', '1583736917-Dhevi_ann-removebg-preview.jpg'),
(309, 'Balbaquera', 'Mildred', ' ', '2', '1', '4', '3', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/28/1989', 'Mary the Queen College of Quezon City', 'BSBA- Human Resource', '09216465366', 'balbaqueramildred@gmail.com', 'Melodie Bacergo ', 'Sister', '09129918041', '65105', '1583736666-Mildrid-removebg-preview.jpg'),
(310, 'Balios', 'Legyn', ' ', '2', '1', '4', '3', 'Bacolod', 'Lanao Del Norte', '10', 'PHL', '4/9/1998', 'Mindanao State University- Maigo School of Arts and Trades', 'BEED - GenEd', '09265143171', 'balioslegyn816@gmail.com', 'Tessie R. Balios', 'Mother', '09971649124', '65106', '1583736724-Legyn-removebg-preview.jpg'),
(311, 'Baloncio', 'Jiza', ' ', '2', '1', '4', '3', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '2/21/1998', 'Stella Maris College', 'BEED', '09487956493', '.@gmail.com', 'Liza D. Baloncio', 'Mother', '09216917977', '65107', '1583737133-Jiza-removebg-preview.jpg'),
(312, 'Bendula', 'Shiela Mae', ' ', '2', '1', '4', '3', 'Dumalinao', 'Zamboanga Del Sur', '9', 'PHL', '6/14/1995', 'J.H. Cerilles State College', 'BA English', '09103461674', 'shiebendula@gmail.com', 'Danillo Madarimot', '', '09197495232', '65108', '1583737079-Sheila.jpg'),
(313, 'Cadotdot', 'Rodelis', ' ', '2', '1', '4', '3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '8/29/1995', 'Western Mindanao State University', 'BEED- Special Education', '09207775572/09127480935', '.@gmail.com', 'Rubylin Cadotdot', 'Father', '09207775572', '65109', '1583736553-Rodeles-removebg-preview.jpg'),
(314, 'Caerlang', 'Anelly', ' ', '2', '1', '4', '3', 'Tubod', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '9/13/1995', 'STI College- Surigao', 'BS Information Technology', '09271625270', 'caerlanganelly57@gmail.com', 'Rolly A. Caerlang', 'Father', '09464318442', '65110', '1583737180-Anelly-removebg-preview.jpg'),
(315, 'Cahayagan', 'Myrrh', ' ', '2', '1', '4', '3', 'V. Sagun', 'Zamboanga Del Sur', '9', 'PHL', '5/11/1997', 'Saint Columbian College', 'BS Accountancy', '09268739989/09484875925', 'shulammitecahayagan@gmail.com', 'Phoebe Cahayagan', 'Mother', '09484875925', '65111', '1583736610-Myrhh-removebg-preview.jpg'),
(316, 'Cano', 'Shewanie', '', '2', '1', '4', '3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '6/13/1994', 'Misamis University', 'Doctor of Dental Medicine', '09957214584', 'maejaneshewanie@yahoo.com', 'Eme C. Waldenburg', 'Mother', '071415052795', '65113', 'logo.png'),
(317, 'Canta', 'Ruth', ' ', '2', '1', '4', '3', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '4/29/1997', 'Tagoloan Community College', 'BSED- English', '09264701765/09265802107', 'jacelleruthcanta@gmail.com', 'Joel Canta', 'Father', '09264701765', '65114', '1583737246-Ruth-removebg-preview.jpg'),
(318, 'Capua', 'Irish Joy', ' ', '2', '1', '4', '3', 'Bolinao', 'Pangasinan', '1', 'PHL', '7/18/1994', 'Virgen Milagrosa University Foundation Inc.', 'BS Pharmacy', '9953028612', 'ijcapua119@gmail.com', 'Nancy Capua', 'Mother', '09088981157', '814', '1583736892-Iresh_joy-removebg-preview.jpg'),
(319, 'Carcillar', 'Jade', '', '2', '2', '4', '3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '1/16/1996', 'MSU- IIT', 'AB- Sociology', '09457666973', 'januarez16@gmail.com', 'Rowena M. Carcillar', 'Mother', '09051254593', '65115', 'logo.png'),
(320, 'Cruz', 'Tiffany Grace', ' ', '2', '1', '4', '3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/29/1995', 'Adamson University', 'BS Chemical Engineering', '9568215/09228122789', 'teegeecruz@gmail.com', 'Liberty V. Cruz', 'Mother', '092288110481', '65117', '1583736515-Teffany_grace-removebg-preview.jpg'),
(321, 'Daguman', 'Charis', ' ', '2', '1', '4', '3', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '11/24/1994', 'Western Mindanao State University', 'Bachelor of Physical Education', '9265536/09972518937', 'dagumancharis@gmail.com', 'Ranulfo G. Daguman', 'Father', '09175713635/9265536', '65118', '1583736964-Charis-removebg-preview.jpg'),
(322, 'Dela cruz', 'Chassah Yelle', '', '2', '1', '4', '3', 'Kalibo', 'Aklan', '6', 'PHL', '8/8/1998', 'Aklan State University- College of Industrial Technology', 'BSEd (T.L.E)', '09973926039', 'yelledelacruz8898@gmail.com', 'Jessa Dela Cruz', 'Sister', '09051947695', '65119', 'logo.png'),
(323, 'Ebarat', 'Glianne', ' ', '2', '1', '4', '3', 'Panaon', 'Misamis Occidental', '10', 'PHL', '3/31/1997', 'University of Science and Technology of Southern Philippines', 'BS Marine Biology', '09462761497', '.@gmail.com', 'Erma Rae Bugas Ebarat', 'Mother', '09462761497', '65152', '1583729987-Glianne.jpg'),
(324, 'Econg', 'Cyrene Phi', ' ', '2', '1', '4', '3', 'Davao City', 'Davao Del Norte', '11', 'PHL', '7/29/1991', 'Western Mindanao State University', 'BSED- English', '09061844389', 'zyrenephi@gmail.com', 'Ruth E. Mila', 'Aunt', '09499603065', '65120', '1583736940-Cyrene_phi-removebg-preview.jpg'),
(325, 'Egbus', 'Glennes', ' ', '2', '1', '4', '3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '11/7/1995', 'Western Mindanao State University- ESU Molave', 'Bachelor in Elementary Education', '09307581828', 'egbusglennesmarie@yahoo.com', 'Myrna A. Egbus', 'Mother', '09107277184', '65121', '1583729953-Glennes.jpg'),
(326, 'Espiritu', 'Pneuma', ' ', '2', '1', '4', '3', 'Dipolog City', 'Zamboanga Del Norte', '9', 'PHL', '10/21/1998', 'University of San Carlos', 'BSBA- Financial Management', '09300200466/09163852761', 'espiritupneuma@gmail.com', 'Benedicto Espiritu Jr.', 'Father', '09300200466', '65123', '1583736580-Pneuma-removebg-preview.jpg'),
(327, 'Fernandez', 'Merycris', ' ', '2', '1', '4', '3', 'Mandaue City', 'Cebu', '7', 'PHL', '7/7/1995', 'Pamantasan ng Cabuyao', 'BSBA Marketing', '09192245667', 'merycrisfernandez07@gmail.com', 'Cristubal J. Fernandez', 'Father', '09331569648/09479716842', '65124', '1583736699-Merychriz-removebg-preview.jpg'),
(328, 'Galloniga', 'Shinely', ' ', '2', '1', '4', '3', 'Davao City', 'Davao Del Sur', '11', 'PHL', '12/6/1994', 'University of Mindanao', 'BSED- Social Studies', '09286684400/2850516', '.@gmail.com', 'Dina G. Jurasa', 'Aunt', '09488912061', '65125', '1583737333-Shinelly-removebg-preview.jpg'),
(329, 'Geguiera', 'Abegail', ' ', '2', '1', '4', '3', 'Rizal', 'Palawan', '4B', 'PHL', '10/8/1997', 'Western Philippines University', 'BSED Social Studies', '09481529731', 'abegailgulimangeguiera@gmail.com', 'Gabriel Geguira/Miraflor Geguiera', 'Parents', '09505405257', '65155', '1583737383-Abegail-removebg-preview.jpg'),
(330, 'Godornes', 'Daleth', ' ', '2', '1', '4', '3', 'Naga', 'Cebu', '7', 'PHL', '7/14/1993', 'Professional Academy of the Philippines', 'BSED- English', '09353493805', 'daleth.coronel@yahoo.com', 'Isabel Coronel', 'Mother', '09152634889', '65126', '1583729876-Dalet.jpg'),
(331, 'Haway', 'Andrea', ' ', '2', '1', '4', '3', 'Lucena City', 'Quezon Province', '4A', 'PHL', '12/2/1996', 'University of the Philippines- Los Ba', 'BS Agricultural & Biosystems Engineering', '09369160197', 'amhaway@up.edu.ph', 'Editha M. Haway', 'Mother', '09981700486', '65129', '1583729808-Andrea-removebg-preview.jpg'),
(332, 'Icagoy', 'Igane', ' ', '2', '1', '4', '3', 'Kalibo', 'Aklan', '6', 'PHL', '9/7/1997', 'Aklan State University- College of Industrial Technology', 'Bachelor of Secondary Education- TLE', '09300180332', 'iganeicagoy144@gmail.com', 'Bro. Rogerie Eufre', 'Co-worker', '09233345570', '65130', '1583730039-Igane.jpg'),
(333, 'Isidro', 'Jara Patricia', ' ', '2', '1', '4', '3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '12/6/1996', 'Mindanao State University- Iligan Institute of Technology', 'BS Mathematics', '09675838713', 'pinxpatricia@gmail.com', 'Estrella P. Beniga', 'Grandmother', '09979647106', '65131', '1583736869-Jara_patrecia-removebg-preview.jpg'),
(334, 'Labod', ' Mylien', ' ', '2', '1', '4', '3', 'Saint Bernard', 'Leyte', '8', 'PHL', '1/10/1996', 'Visayas State University', 'BS Agribusiness', '09363965545', 'mylienzoe3@gmail.com', 'Fernando Labod', 'Father', '09359470547', '65132', '1583736641-Mylein-removebg-preview.jpg'),
(335, 'Legua', 'Josiefiel', ' ', '2', '1', '4', '3', 'Tacloban City', 'Leyte', '8', 'PHL', '9/22/1990', 'University of the Philippines Visayas Tacloban College', 'BS Management', '09057817888/ (053)5231082', 'josiefieljoy@gmail.com', 'Pe?afiel Flor M. Legua', 'Mother', '09171154998', '65133', '1583736747-Josiefiel-removebg-preview.jpg'),
(336, 'Madarimot', 'Mirell', ' ', '2', '1', '4', '3', 'Lakewood', 'Zamboanga Del Sur', '9', 'PHL', '5/5/1996', 'Western Mindanao State University', 'BEED- General Education', '09482822299', 'mirellmae19@gmail.com', 'Lesiel Balatero', 'Sister', '09187093752', '65134', '1583737442-Mirell-removebg-preview.jpg'),
(337, 'Malbuyo', 'Divine', ' ', '2', '1', '4', '3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '2/24/1998', 'Siliman University', 'BS Medtech', '09052565834/5214039', 'divinepmalbuyo@su.edu.ph', 'Jelin Malbuyo', 'Mother', '09652009221', '65135', '1583729904-Divine-removebg-preview.jpg'),
(338, 'Malong', 'Menchie', '', '2', '1', '4', '3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '11/7/1988', 'Iligan Medical Center Colleges', 'BS Nursing', '09192662468', 'luvmench@yahoo.com', 'Susan Matutina', 'Mother', '09094704127', '65136', 'logo.png'),
(339, 'Nini', 'Jezza Mae', ' ', '2', '1', '4', '3', 'Tangub', 'Misamis Occidental', '10', 'PHL', '12/31/1997', 'Mindanao State University- Iligan Institute of Technology', 'BS Biology', '09090621953', 'ninijezza@gmail.com', 'Jacinto Nini Jr.', 'Father', '09098213155', '65137', '1583736797-Jezza_mae-removebg-preview.jpg'),
(340, 'Nini', 'Jazmine Mae', '', '2', '1', '4', '3', 'Tangub', 'Misamis Occidental', '10', 'PHL', '12/31/1997', 'Mindanao State University- Iligan Institute of Technology', 'BSED- MAPEH', '09485796754', 'jazminenini@gmai.com', 'Jacinto Nini Jr. ', 'Father', '09093213155', '65138', '1583650169-Jazmine_mae-removebg-preview.jpg'),
(341, 'Ongue', 'Alethia', ' ', '2', '1', '4', '3', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '1/13/1996', 'Mindanao State University- Maigo School of Arts and Trades', 'BEED- General Education', '09655482678', 'gracie9706@gmail.com', 'Roderick E. Ongue', 'Father', '09068797846', '65139', '1583737475-Alethia-removebg-preview.jpg'),
(342, 'Padayao', 'Chenalyn', ' ', '2', '1', '4', '3', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '9/15/1997', 'Misamis Oriental Institute of Science and Technology', 'BSED- English', '09169379498', '.@gmail.com', 'Timoteo Padayao', 'Father', '09169379498', '65140', '1583729847-Chenalyn.jpg'),
(343, 'Perez', 'Mary Jill', ' ', '2', '1', '4', '3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '6/24/1992', 'University of the East- Caloocan', 'BS Accounting Technology', '3735678', 'maryjillperez@yahoo.com', 'Marife Perez', 'Mother', '09293291307', '65142', '1583736771-Jill-removebg-preview.jpg'),
(344, 'Prieto', 'Jasper', ' ', '2', '1', '4', '3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '3/18/1998', 'Misamis University- Ozamis City', 'BS Medical Technology', '09207244511', 'prieto.jaja.00@gmail.com', 'Emma Prieto', 'Mother', '09107321915/09351207786', '65143', '1583736846-Jasper-removebg-preview.jpg'),
(345, 'Prongco', 'Jean', ' ', '2', '1', '4', '3', 'General Santos City', 'South Cotabato', '12', 'PHL', '9/9/1996', 'Notre Dame of Dadiangas University', 'Bachelor of Library and Information Sciences', '09104208088', 'Iprongco@yahoo.com', 'Lorefe Prongco', 'Mother', '09460439712', '65144', '1583730066-Jean.jpg'),
(346, 'Rosales', 'Dorothy', ' ', '2', '1', '4', '3', 'Bacoor', 'Cavite', '4A', 'PHL', '9/22/1996', 'Cavite State University', 'BS Business Management- Financial', '09950218906', 'dorothyrosales1@gmail.com', 'Arleen Rosales', 'Mother', '09065677360', '65145', '1583729928-Dorothy.jpg'),
(347, 'Saluta', 'Jay', ' ', '2', '1', '4', '3', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '10/18/1993', 'Misamis University', 'Social Work', '09300266281', 'salutajay18@gmail.com', 'Jebusa Saluta', 'Mother', '09488596987', '65146', '1583736822-Jay-removebg-preview.jpg'),
(348, 'Sayles', 'Everose', '', '2', '1', '4', '3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '12/30/1996', 'Western Mindanao State University- External Studies Unit', 'BSED- English', '09504102543', '', 'Phoebe Sayles', 'Mother', '09504102543', '65147', 'logo.png'),
(349, 'Tumampos', 'Brigette', ' ', '2', '1', '4', '3', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '10/16/1996', 'Misamis University- Ozamis City', 'BS Medical Technology', '09452544417/5453451', 'btumampos@gmail.com', 'Veronica Tumampos', 'Mother', '09357233028', '65149', '1583736992-Brigete-removebg-preview.jpg'),
(350, 'Valeriano', 'Grace', ' ', '2', '1', '4', '3', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '7/22/1995', 'Bestlink College of the Philippines', 'BS Office Administration', '09381474126', 'grace072295@yahoo.com', 'Mhiles Chua', 'Aunt', '09215102740', '65156', '1583730013-Grace.jpg'),
(351, 'Woiwa', 'Michelle', ' ', '2', '1', '4', '3', 'X', 'X', '10', 'PNG', ' ', ' ', ' ', ' ', '.@gmail.com', ' ', ' ', ' ', '65157', '1583730108-Michelle.jpg'),
(352, 'Aba-a', 'Neshama', '', '2', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '4/8/1998', 'Cebu Institute of Technology University', 'BSBA-Management Accounting', '09234322952', 'neshamaabaa@gmail.com', 'Lorna Aba-a', 'Mother', '09362584285', '64101', 'logo.png'),
(353, 'Abalde', 'Precil', '', '2', '1', '1', '4', 'Kapatagan', 'Lanao del Norte', '10', 'PHL', '7/25/1994', 'Mindanao State University - LNAC Campus', 'BEED - GenEd', '09755225649', 'precilabalde@gmail.com', 'Jerry Abalde', 'Father', '09557618025', '64102', 'logo.png'),
(354, 'Abejuela', 'Janice', '', '2', '1', '1', '4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '2/6/1997', 'Bukidnon State University', 'BA Philosophy', '09069180701', 'janiceabejuela06@gmail.com', 'Teresita Abejuela', 'Mother', '09358692468', '64103', 'logo.png'),
(355, 'Abellera', 'Cristina', '', '2', '1', '1', '4', 'Umingan', 'Pangasinan', '1', 'PHL', '2/20/1989', 'Union Christian College', 'BS Nursing', '09184144433', '', 'Elmie R. Abellera', 'Mother', '09498778359', '64104', 'logo.png'),
(356, 'Acedera', 'Margarett', '', '2', '1', '1', '4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/27/1995', 'City of Malabon University', 'BSIT', '0924081484', 'acedera.margarett@gmail.com', 'Meen Jameeel Ul-Haq', 'Sister', '09215866340', '64105', 'logo.png'),
(357, 'Almonia', 'Charity', '', '2', '1', '1', '4', 'Lala', 'Lanao Del Norte', '10', 'PHL', '11/15/1993', 'Christ the King College De Maranding', 'BS Business Administration', '09356667280', 'almonia57@gmail.com', 'Reward Villanueva', 'Cousin', '09753081941', '64106', 'logo.png'),
(358, 'Andrino', 'Rona', '', '2', '1', '1', '4', 'Bogo City', 'Cebu', '7', 'PHL', '9/19/1997', 'Cebu Technological University', 'BSED-TLE', '09354116033', 'andrino.rona@gmail.com', 'Bro. Roel Andrino', '', '09354116033', '64107', 'logo.png');
INSERT INTO `trainee_info` (`trainee_id`, `Last_Name`, `First_Name`, `Middle_Name`, `Gender`, `Status`, `Batch`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`, `profile_img`) VALUES
(359, 'Angus', 'Sabina', '', '2', '1', '1', '4', 'Maigo', 'Lanao Del Norte', '10', 'PHL', '8/27/1997', 'Mindanao State University', 'BS Insdustrial Tech-garment Tech', '09262375709', 'sabinaangus082797', 'Bernabe C. Dimol', 'Brother in Christ', '09058935288', '64108', 'logo.png'),
(360, 'Arbutante', 'Christine', '', '2', '1', '1', '4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '9/4/1992', 'Bohol Island State University', 'BS Industrial Psychology', '09306784217', 'arbutante.christine@yahoo.com', 'Jessie C. Arbutante', 'Uncle', '09088933908', '64110', 'logo.png'),
(361, 'Arcena', 'Elishia', '', '2', '1', '1', '4', 'Naic', 'Cavite', '4A', 'PHL', '10/31/1998', 'STI College Rosario', 'BS Information Technology', '09975465642 / 09976032054', 'elishiaarcena@gmail.com', 'Arnie Arcena', 'Mother', '09357707565', '64111', '1582205076-elisha.jpg'),
(362, 'Arevalo', 'Mylene', '', '2', '1', '1', '4', 'Canaman', 'Camarines Sur', '5', 'PHL', '9/5/1997', 'Naga College Foundation', 'BS Entrepreneurship', '09450941679', 'mylenearevalo88@gmail.com', 'Ma. Elena B. Arevalo', 'Mother', '09297233967', '64112', 'logo.png'),
(363, 'Asiong', 'Sheryl Lou', '', '2', '1', '1', '4', 'Kalibo', 'Aklan', '6', 'PHL', '1/8/1990', 'North Western Visayan Colleges', 'Bachelor in Elementary Education', '09307429918', 'asiong_sheryllou@yahoo.com', '', '', '', '64113', 'logo.png'),
(364, 'Bastillada', 'Ressa', '', '2', '1', '1', '4', 'Iligan City', 'Lanao del Norte', '10', 'PHL', '2/25/1996', 'St. Peter''s College', 'BSBA Financial Management', '09357998562', 'sasabastillada@gmail.com', 'Analiza Bastillada', 'Mother', '09358528486', '64114', 'logo.png'),
(365, 'Bongcawel', 'Shirly Ann', '', '2', '1', '1', '4', 'Kibawe', 'Bukidnon', '10', 'PHL', '7/13/1993', 'Southwestern University', 'BS Pharmacy', '09269136530', 'bongcawelshirly29@gmail.com', 'Secema Abriol Bongcawel', 'Mother', '09979288073', '64115', 'logo.png'),
(366, 'Bonghanoy', 'Liza Cliere', '', '2', '1', '1', '4', 'Molave', 'Zamboanga del Sur', '9', 'PHL', '11/24/1995', 'Western Mindanao State University', 'BSED-Social Studies', '09306051227', '', 'Roldan A. Bonghanoy', 'Father', '09197578955', '64116', 'logo.png'),
(367, 'Brioso', 'Jennifer', '', '2', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '3/21/1990', 'University of San Carlos', 'BSED- English', '09168765536', 'nefibrioso@hotmail.com', 'Nathaniel V. Brioso', 'Father', '09222546648', '64117', 'logo.png'),
(368, 'Calamaya', 'Anna Fe', '', '2', '1', '1', '4', 'Tolosa', 'Leyte', '8', 'PHL', '2/27/1995', 'Leyte Normal University', 'BS Home Arts university', '09509948961', 'annclmy@gmail.com', 'Antonio M. Calamaya', 'Father', '09994793643', '64118', 'logo.png'),
(369, 'Calib', 'Glydel', '', '2', '1', '1', '4', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '7/12/1997', 'Southern Capital Colleges', 'BSBA Marketing Management', '09488794961', 'glydelcalib@yahoo.com', 'Randel Ibrahim Y. Calib', 'Father', '09207989194', '64119', 'logo.png'),
(370, 'Camarao', 'Daisy Mae', '', '2', '1', '1', '4', 'San Fernando City', 'La Union', '1', 'PHL', '12/3/1997', 'Don Mariano Marcos State University', 'Bachelor of Science in Business Administration', '09158169802', 'camaraodaisy@yahoo.com', 'Dominador Camarao', 'Father', '09177760606', '64120', 'logo.png'),
(371, 'CaÃ±ete', 'Aileen', '', '2', '1', '1', '4', 'San Remegio', 'Cebu', '7', 'PHL', '12/29/1995', 'Cebu technological University', 'BSED-TLE', '09974817914', 'aileenalbarancanete@gmail.com', 'Bro. Alan Ca?ete', 'Father', '09233658215', '64121', '1582204671-aileen.jpg'),
(372, 'Castigon', 'Marilyn', '', '2', '1', '1', '4', 'Lebak', 'Sultan Kudarat', '12', 'PHL', '3/8/1989', 'Pamantasan ng Lungsod ng Pasig', 'Information Technology', '09424522725', 'renalyn083D16@gmail.com', 'Carlos Castigon', 'Father', '09102571627', '64122', 'logo.png'),
(373, 'Castro', 'Marie Claire', '', '2', '1', '1', '4', 'Do?a Remedios Trinidad', 'Bulacan', '3', 'PHL', '12/15/1992', 'Norzagaray, Bulacan', 'BS HRM', '09098322529', 'LadylynCastro17@yahoo.com', 'Efren Castro', 'Father', '09554416580', '64123', 'logo.png'),
(374, 'Catalu', 'Grace', '', '2', '1', '1', '4', 'Puerto Princesa City', 'Palawan', '4B', 'PHL', '2/8/1990', 'Palawan State University', 'BS in Agriculture', '09125484157', 'gracecataluna@gmail.com', 'Gedeon D. Catalu', 'Father', '09068632423', '64124', 'logo.png'),
(375, 'Co', 'Loren', '', '2', '1', '1', '4', 'Baguio City', 'Benguet', 'CAR', 'PHL', '11/14/1996', 'Saint Louis University', 'Bachelor in Medical Technology', '09550547677', 'lorenco.lc@gmail.com', 'Zaldy Co', 'Father', '09175061651', '64127', 'logo.png'),
(376, 'Del Rosario', 'Precious', '', '2', '1', '1', '4', 'San Jose Del Monte', 'Bulacan', '3', 'PHL', '7/25/1995', 'Bulacan State University', 'BS Mechanical Engineering', '09553085375', 'preciousdr0725@gmail.com', 'Elizabeth Del Rosario', 'Mother', '09553085375', '64129', 'logo.png'),
(377, 'Dionaldo', 'Cherryl Ann ', '', '2', '1', '1', '4', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '3/15/1997', 'Quezon City Polytechnic University', 'BS Information Technology', '09751065705', 'chiicahay15.dionaldo@yahoo.com', 'Sis Maribel Villarosa', 'Shepherd', '09173128188', '64130', 'logo.png'),
(378, 'Ebale', 'Mary Grace', '', '2', '1', '1', '4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '8/18/1992', 'Zamboanga City State College of Marine Sciences and Technology', 'BS HRM', '09956909910', 'marygraceebale44341@gmail.com', 'Eunice Ebale', 'Sister', '09263433350', '64132', 'logo.png'),
(379, 'Flores', 'Mirra Joy', '', '2', '1', '1', '4', 'Sumilao', 'Bukidnon', '10', 'PHL', '8/23/1994', 'Bukidnon State University', 'BSE - English', '09264740725', '', 'Fely G. Flores', 'Mother', '09103012673', '64133', 'logo.png'),
(380, 'Garcia', 'Alyssa Joy', '', '2', '1', '1', '4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '1/30/1998', 'Surigao State College of Technology', 'Bachelor of Science in Information Technology', '09095985338', 'alysonjanegarcia@gmail.com', 'Nelba Garcia', 'Mother', '09052253754', '64135', 'logo.png'),
(381, 'Jadomas', 'Jairah', '', '2', '1', '1', '4', 'Iloilo City', 'Iloilo', '6', 'PHL', '3/15/1997', 'Iloilo Science and Technology', 'Bachelor of Science in Architecture', '9090221650', 'jairahjadel5@gmail.com', 'Joebert Jadomas', 'Father', '09185467872', '64137', 'logo.png'),
(382, 'Lofranco', 'Caroline', '', '2', '1', '1', '4', 'Cebu City', 'Cebu', '7', 'PHL', '12/6/1995', 'Cebu Technological University - Main Campus', 'BSIT - Garments', '09104514262', 'carolinelofranco96@gmail.com', 'Joann Lofranco', 'Sister', '09156551024', '64140', 'logo.png'),
(383, 'Mahinay', 'Tabita', '', '2', '1', '1', '4', 'El Nido', 'Palawan', '4B', 'PHL', '11/21/1996', 'University of the East', 'BS HRM', '09988696287', 'tabitamahinay21@gmail.com', 'Jhun Jhun Mahinay', 'Father', '09399192296', '64141', '1582205153-tabita.jpg'),
(384, 'Makiling', 'Jay Marie', '', '2', '1', '1', '4', 'Tanauan City', 'Batangas', '4A', 'PHL', '11/9/1995', 'DMMC-Institute of Health Sciences', 'BSBA Major in Operation Management', '09304166639', 'jaymakiling@gmail.com', 'Marites Makiling', 'Mother', '09506632094', '64142', 'logo.png'),
(385, 'Matas', 'Jerry Dame', '', '2', '1', '1', '4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '4/14/1996', 'Bukidnon State University', 'BA Philosophy', '09501107193', '', 'Manuel Matas', 'Father', '09168920165', '64143', 'logo.png'),
(386, 'Medellada', 'April Mae', '', '2', '1', '1', '4', 'Kumalarang', 'Zamboanga Del Sur', '9', 'PHL', '4/9/1996', 'Misamis University - Ozamiz', 'BS Biology', '09776061763', 'aprilmaemedellada@gmail.com', 'Amada P. Medellada ', 'Mother', '09464649803', '64144', 'logo.png'),
(387, 'Medillo', 'Rolen', '', '2', '1', '1', '4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '12/5/1997', 'Saint Calumban College', 'BS Accounting Technology', '09166371033', 'rolenmedillo1997@gmail.com', 'Emelito A. Senas', 'Uncle', '09365957546', '64145', 'logo.png'),
(388, 'Mesina', 'Vanessa', '', '2', '1', '1', '4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '8/3/1998', 'City of Malabon University', 'BSIT', '09566271639', 'vanessamesina@gmail.com', 'Rhizalyn Mesina', 'Sister', '0975867863', '64146', 'logo.png'),
(389, 'Molit', 'Anelyn', '', '2', '1', '1', '4', 'Camalig', 'Albay', '5', 'PHL', '7/13/1995', 'Southern Luzon Technological College Foundation Inc.', 'BSBA Human Resource', '09090448992', 'molitannie7131995@gmail.com', 'John Dorol', 'Brother in the church', '09173330500', '64147', 'logo.png'),
(390, 'Morales', 'Medelyn', '', '2', '1', '1', '4', 'Padre Garcia', 'Batangas', '4A', 'PHL', '4/5/1995', 'Kolehiyo ng Lungsod ng Lipa', 'Bachelor of Science in Computer Science', '09771353054', 'medelynmorales05@gmail.com', 'Demostry Morales', 'Parent', '09128516291', '64149', 'logo.png'),
(391, 'Muego', 'Michelle', '', '2', '1', '1', '4', 'Pagadian City', 'Zamboanga del Sur', '9', 'PHL', '3/6/1990', 'Saint Columban College', 'BSBA Financial Management', '09359862916', 'mitchellemuego@gmail.com', 'Rogelio R. Muego', 'Father', '09079669565', '64150', 'logo.png'),
(392, 'Ochagabia', 'Arlyn', '', '2', '1', '1', '4', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '10/30/1981', 'Alfonso D. Tan College', 'BSOA - Major in Office Management', '09215101084', 'pooh_ar123@yahoo.com', 'Leonora Subrabas', 'Mother', '09215566619', '64151', '1582204789-arlyn.jpg'),
(393, 'Pacinio', 'Nelle', '', '2', '1', '1', '4', 'Bogo City', 'Cebu', '7', 'PHL', '10/11/1998', 'Cebu Normal University', 'Bachelor of Secondary Education- English', '09974038190', 'nellelovegod@gmail.com', 'Melisa and Erwin Godornes', 'Parents', '09273244959/ 09086760636', '64152', 'logo.png'),
(394, 'Paculba', 'Charlotte', '', '2', '1', '1', '4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '6/6/1998', 'The University of Manila', 'BSBA - HDRM', '09357447116', 'charlottepaculba07@gmail.com', 'Estrellita D. Paculba', 'Mother', '09391297934', '64153', 'logo.png'),
(395, 'Pan', 'Esther', '', '2', '1', '1', '4', 'Cixi', 'Zhe Jiang', 'China', 'CHINA', '3/1/1997', 'Zhejiang Technical Institute of Economics', 'Logistics Management', '13884480562', '496000307@qq.com', 'Chen Zhen', 'Serving Brother', '13777838707', '64154', 'logo.png'),
(396, 'Pante', 'Ana Maria', '', '2', '1', '1', '4', 'Bacoor', 'Cavite', '4A', 'PHL', '1/18/1997', 'Cavite State University', 'Business Management - Marketing', '09958901977', 'Ananapante@gmail.com', 'Rhomar Pante', 'Brother', '09753034245', '64155', 'logo.png'),
(397, 'Petines', 'Angelica', '', '2', '1', '1', '4', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '3/20/1997', 'Pamantasan ng Lungsod ng Valenzuela', 'BSBA Human Resources Dvt. Mgt.', '09218630272', 'anggepetine@gmail.com', 'Crispin Petines', 'Father', '09773903982 / 09356732399', '64156', 'logo.png'),
(398, 'Prongco', 'Jonnafe', '', '2', '1', '1', '4', 'General Santos City', 'South Cotabato', '12', 'PHL', '3/29/1993', 'Notre Dame of Dadiangas University', 'BSEd - English', '09289351881', 'jprongco2@gmail.com', 'Lorefe A. Prongco', 'Mother', '09460439712', '64157', 'logo.png'),
(399, 'Rama', 'Gracelyn', '', '2', '1', '1', '4', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '6/22/1993', 'JHCSC', 'BSIT', '09482019168', '', 'Kim Codia', 'Elder', '09076199749', '64158', 'logo.png'),
(400, 'Ramil', 'Ma. Meledine', '', '2', '1', '1', '4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/4/1998', 'Quezon City Polytechnic University', 'BS Entrepreneurship', '09195602992', 'mariameledineramil@yahoo.com', 'Dina Ramil', 'Mother', '09274020605', '64159', 'logo.png'),
(401, 'Salapas', 'Angelika', '', '2', '1', '1', '4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '10/22/1997', 'Western Mindanao State University', 'BS Biology', '09066860267/ 09089234565', 'salapasangelika@gmail.com', 'Margie Salapas', 'Sister', '09268410609', '64161', '1582204741-angelika.jpg'),
(402, 'Salingay', 'Jie Ann', '', '2', '1', '1', '4', 'Aloran', 'Misamis Occidental', '10', 'PHL', '8/13/1997', 'Western Mindanao State University', 'BSED English', '09382321825', 'none@gmail.com', 'Alma B. Salingay', 'Mother', '09308588220', '64162', '1582191484-jieann.jpg'),
(403, 'Salvatierra', 'Abbie Joyce', '', '2', '1', '1', '4', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '1/11/1998', 'University of Manila', 'BS Computer Science', '09753663134', 'joycesalvatierra16@yahoo.com', 'Mary Grace Abello ', 'Sister in Christ', '09229044983', '64163', 'logo.png'),
(404, 'Salvatierra', 'Abbie Joy', '', '2', '1', '1', '4', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '1/11/1998', 'University of Manila', 'BS Computer Science', '09154886749', 'abbie.salvatierra@yahoo.com', 'Mary Grace Abello ', 'Serving One', '09229044983', '64164', 'logo.png'),
(405, 'Sayles', 'Edelyn', '', '2', '1', '1', '4', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/20/1994', 'Western Mindanao State University', 'BSED English', '09503381223', 'saylesedelun@yahoo.com', 'Phoebe Sayles', 'Mother', '09267333872', '64166', 'logo.png'),
(406, 'Sinining', 'Mary Rose', '', '2', '1', '1', '4', 'Bacolod City', 'Negros Occidental', '6', 'PHL', '7/9/1997', 'Carlos Hilado Memorial State College', 'BS Office Administration', '09469013818', 'marygracesenining@gmail.com', 'Ma. Robilyn C. Lagare', 'Spiritual Mother', '09433676564', '64168', 'logo.png'),
(407, 'Solis', 'Cristy', '', '2', '1', '1', '4', 'Marawi City', 'Lanao del Sur', 'ARMM', 'PHL', '3/7/1996', 'Mindanao State University Main Campus - Marawi City', 'BS Social Work', '09461311637', 'solic_cristy@yahoo.com', 'Harley V. Solis Jr. ', 'Brother', '+966503585703', '64169', 'logo.png'),
(408, 'Tabuco', 'Mechel', '', '2', '1', '1', '4', 'Imelda', 'Zamboanga Sibugay', '9', 'PHL', '6/23/1997', 'Western Mindanao State University - IESU', 'Bachelor of Arts in Political Science', '09059182852', '', 'Meldred Tabuco', 'Sister', '09353668838', '64171', 'logo.png'),
(409, 'Tano', 'Giselle', '', '2', '1', '1', '4', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '9/30/1996', 'University of San Carlos - Downtown Campus', 'Management Accounting', '09332687145', 'gslljtn451@gmail.com', 'Rebecca Tano', 'Mother', '09236229213', '64172', 'logo.png'),
(410, 'Ula', 'Sherea', '', '2', '1', '1', '4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/3/1996', 'Polytechnic University of the Philippines', 'BSIT', '09272555520', 'usherea@yahoo.com', 'Robert and Serina Ula', 'Parents', '09296894698 / 09081732892', '64174', 'logo.png'),
(411, 'Ursal', 'Bernadeth', '', '2', '1', '1', '4', 'Bogo City', 'Cebu', '7', 'PHL', '9/27/1995', 'Cebu Technological University', 'BSED - TLE', '09365966485', 'bernadeth.ursal@yahoo.com', 'Maria T. Ursal', 'Mother', '0936-075-1966', '64175', '1582204874-bernadeth.jpg'),
(412, 'Vega', 'Joje', '', '2', '2', '1', '4', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '10/23/1995', 'Ta?on College', 'BEED - GenEd', '09092063943', 'jojevega23@yahoo.com/ jojevega@gmail.com', 'Jeremy Vega', 'Father', '0923-616-6131', '64178', 'logo.png'),
(413, 'Vega', 'Christine', '', '2', '1', '1', '4', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '10/13/1996', 'Central Philippine State University', 'Bachelor of Science in Criminology', '09973700750', 'blancotine02@gmail.com', 'Jeremy Vega', 'Father', '0923-616-6131', '64177', 'logo.png'),
(414, 'Velasco', 'Madel', '', '2', '1', '1', '4', 'Bogo City', 'Cebu', '7', 'PHL', '5/30/1995', 'Cebu Technological University', 'BSED - TLE', '09051363776', 'madelle.velasco@yahoo.com', 'Julita A. Velasco', 'Mother', '0997-882-8475', '64179', 'logo.png'),
(415, 'Villanueva', 'Midan', '', '2', '1', '1', '4', 'Molave', 'Zamboanga Del Sur', '9', 'PHL', '1/20/1987', 'Western Mindanao State University', 'BEED', '09465158667', 'midanvillanueva@gmail.com', 'Pacita M. Villanueva', 'Mother', '0946-725-6855', '64181', 'logo.png'),
(416, 'Weng', 'Hellen', '', '2', '1', '1', '4', 'New Taipei City', 'Taiwan', 'Taiwan', 'TAIWAN', '7/30/1993', 'TamKang University', 'Bachelor of Arts', '886-923806801', 'hellen820730@gmail.com', 'Weng, Ting I', 'Father', '886-933833043', '64182', 'logo.png'),
(417, 'Yecyec', 'Gether', '', '2', '1', '1', '4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '3/2/1996', 'University of Bohol', 'BS Pharmacy', '09075012604', 'geth.godman08@yahoo.com', 'Maxilinoa Yecyec', 'Mother', '0910-270-3430', '64184', 'logo.png'),
(418, 'Montecalbo', 'Aizel', '', '2', '1', '4', '3', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '10/17/1995', 'Jose Rizal Memorial State University - Dapitan', 'BS HRM', '09072938174', 'Aizelantanomontecalbo@gmail.com', 'Pedelia Montecalbo', 'Mother', '09559909581', '64148', 'logo.png'),
(419, 'Abando', 'Ashley', '', '2', '1', '3', '1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '9/20/1998', 'rizal technological university', 'bs-computer education', '9334391583', 'abandojajay@yahoo.com', 'arruro a.abando', 'Father', '9334391583', '671001', '1583652785-Ashly-removebg-preview.jpg'),
(420, 'Aclao', 'Jee-lynn', '', '2', '1', '3', '1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '10/19/1998', 'misamis university ozamis city', 'bs-medical technology', '9382679347', 'aclaojeelynn@gmail.com', 'lueviminda v.aclao', 'Mother', '09053405358', '671002', '1583652682-Aclao-removebg-preview.jpg'),
(421, 'Aragon', 'Leslie', '', '2', '1', '3', '1', 'Mariveles ', 'Bataan', 'III', 'PHL', '9/26/1997', 'polytechnic university of philippines-bataan', 'bsed-english', '9305636391', 'none@gmail.com', 'artenia aragon', 'Mother', '09100351895', '671004', '1583652716-Aragon-removebg-preview.jpg'),
(422, 'Argawanon', 'Jehan', '', '2', '1', '3', '1', 'Bogo', 'Cebu', 'VII', 'PHL', '12/6/1998', 'cebu normal university', 'bsed-mapeh', '9995106311', 'jhanargawanon@gmail.com', 'analiza m.argawanon', 'Mother', '09123662696/09123316840', '671005', '1583652751-Argawanon-removebg-preview.jpg'),
(423, 'Bagay', 'Decelyn', '', '2', '1', '3', '1', 'Margosatubig', 'Zamboanga Del Sur', 'IX', 'PHL', '10/17/1998', 'saint columban college', 'bsba-operation management', '9301298973', 'dess123bagay@gmail.com', 'wenilyn bagay', 'sister', '09109141360', '671006', '1583652825-Bagay-removebg-preview.jpg'),
(424, 'Balacuit', 'Pearl', '', '2', '1', '3', '1', 'Balingasag', 'Misamis oriental', 'X', 'PHL', '6/3/1999', 'misamis oriental institute of science&technology', 'bed', '9286212934', 'pearlbalacuit@yahoo.com', 'virgilio j.balaguit', 'Father', '09185915232', '671007', '1583655732-Pearl-removebg-preview.jpg'),
(425, 'Balacuit', 'Zoe', '', '2', '1', '3', '1', 'Balingasag', 'Misamis oriental', 'X', 'PHL', '6/3/1999', 'misamis oriental institute of science&technology', 'bed', '9161500223', 'balacuitzoeshullamite@yahoo.com', 'virgilio j.balaguit', 'Father', '09185915232', '671008', 'logo.png'),
(426, 'Bibit', 'Shekinah', '', '2', '1', '3', '1', 'Lucena City', 'Quezon Province', 'X', 'PHL', '10/10/1998', 'southern luzon state unicersity', 'bs-nursing', '9464861771', 's2sbits@gmail.com', 'saras zila bibit', 'sister', '09664597479', '671009', '1583652869-Bibit-removebg-preview.jpg'),
(427, 'Broce', 'Kate', '', '2', '1', '3', '1', 'Sta. Maria', 'Bulacan', 'III', 'PHL', '7/29/1994', 'bulacan state unicersity', 'bsed-english', '9324064754', 'jonnahagodmaninchrist@gmail.com', 'joanne libuton', 'aunt', '09238198885', '671010', 'logo.png'),
(428, 'Bumohya', 'Marian', '', '2', '1', '3', '1', 'Calapan City', 'Oriental Mindoro', 'IV-B', 'PHL', '9/14/1998', 'batangas state unicersity main I', 'bs-pshchology', '9668217363', 'bumohyamarian@gmail.com', 'constantine bumohya', 'Father', '09958848914', '671011', '1583652902-Bumohya-removebg-preview.jpg'),
(429, 'Buot', 'Sandra', '', '2', '1', '3', '1', 'Consolacion', 'Cebu', 'VII', 'PHL', '6/4/1996', 'up-cebu', 'bs-biology', '9426787490', 'sebuot@up.edu.ph', 'guillerma e.buot', 'Mother', '09995589643', '671012', '1583652953-Buot-removebg-preview.jpg'),
(430, 'Caliso', 'Nelia', '', '2', '1', '3', '1', 'Dipolog City', 'Zamboanga Del Norte ', 'IX', 'PHL', '10/11/1998', 'jhcsc', 'bsed-english', '9098373133', 'none@gmail.com', 'elizbeth d.tumarong', 'cousion', '09489450458', '671013', '1583653013-Caleso-removebg-preview.jpg'),
(431, 'Calo', 'Keziah', '', '2', '1', '3', '1', 'Butuan City', 'Agusan Del Norte', 'XIII', 'PHL', '12/18/1998', 'father saturnino urias university', 'bs-accountancy', '9484749557', 'angelkez41@gmail.com', 'marissa t.calo', 'Mother', '09306298439', '671014', '1583653055-Calo-removebg-preview.jpg'),
(432, 'Cambangay', 'Jackielou', '', '2', '1', '3', '1', 'Cagayan De Oro City', 'Misamis Oriental', 'X', 'PHL', '3/9/1999', 'phinma-cagayan de oro college', 'early childrenhood education', '9366498120', 'kielcambangay@gmail.com', 'uriel g.cambangay', 'Father', '09355453642', '671015', '1583653108-Cambangay-removebg-preview.jpg'),
(433, 'CaÃ±eda', 'Chesterly', '', '2', '1', '3', '1', 'Tubod ', 'Lanao Del Norte', 'X', 'PHL', '3/30/1998', 'mindanao state university-iligan institute of technology', 'ab history', '9365532617', 'cchesterly@gmail.com', 'chanler CaÃ±eda', 'brother', '09758951419', '671016', '1583653162-Caneda-removebg-preview.jpg'),
(434, 'Canlas', 'Myvilene', '', '2', '1', '3', '1', 'Makati  City', 'Metro Manila', 'NCR', 'PHL', '12/27/1991', 'western mindanao state university', 'bs-accountancy', ' ', 'none@gmail.com', ' ', ' ', ' ', '671017', '1583653197-Canlas-removebg-preview.jpg'),
(435, 'Cari', 'Anna Mae', '', '2', '1', '3', '1', 'San Fernando City', 'La Union', 'I', 'PHL', '6/22/1993', 'la finn', 'bs-hm', '9476582820', 'carinoannamae@gmail.com', 'lovblla aban', 'sister in christ', '09232737238', '671018', '1583653314-Carino-removebg-preview.jpg'),
(436, 'Casis', 'Rechell', '', '2', '1', '3', '1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '4/21/1993', 'university of cebu-banilao campus', 'bs-tourism', '9167393451', 'rechellcasis93@gmail', 'sabino casis', 'Father', '09327710797', '671019', 'logo.png'),
(437, 'Casuyac', 'Mary Joy', '', '2', '1', '3', '1', 'Tukuran', 'Zamboanga Del Sur', 'IX', 'PHL', '11/28/1998', 'saint columban college', 'bsep-tle', '9301356884', 'mj.casuyac@gmail.com', 'rosemarie j.casuyac', 'Mother', '09300455893', '671020', '1583655395-Mary-removebg-preview.jpg'),
(438, 'Catalu', 'Ghey Ann', '', '2', '1', '3', '1', 'Brooke', 'Palawan', 'IV-B', 'PHL', '11/3/1998', 'palawan state university', 'bsed-english', '9559568503', 'none@gmail.com', 'gedeon d.Catalu', 'Father', '123', '671021', '1583653936-Ghey_ann-removebg-preview.jpg'),
(439, 'Culanag', 'Le-shaidda', '', '2', '1', '3', '1', 'Mariveles ', 'Bataan', 'III', 'PHL', '1/27/1998', 'polytechnic university of philippines-bataan', 'bsed-english', '9383467894', 'leshaiddaculanag32@gmail.com', 'lea l.culanag', 'Mother', '09483782256', '671022', '1583653434-Culanag-removebg-preview.jpg'),
(440, 'Cuming', 'Sheila Mae', '', '2', '1', '3', '1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '12/21/1996', 'western mindanao state university', 'bsed-filipino', '9078148917', 'none@gmail.com', 'arnold&febe cuming', 'parents', '09071163064/09126047167', '671023', '1583653467-Cuming-removebg-preview.jpg'),
(441, 'Daguman', 'Crystal', '', '2', '1', '3', '1', 'Zamboanga City', 'Zamboanga Del Sur', 'IX', 'PHL', '9/14/1998', 'western mindanao state university', 'b-elementry education', '9974413178', 'crystaldaguman@yahoo.com', 'ranulfo daguman', 'Father', '09175713635', '671024', '1583653374-Crystal-removebg-preview.jpg'),
(442, 'Dalagan', 'Recel', '', '2', '1', '3', '1', 'Carmen', 'Bohol', 'VII', 'PHL', '11/15/1997', 'trinidad municipal college', 'bs-office ad.', '948452915', 'dalaganrecel197@gmail.com', 'rufina dalagan', 'Mother', '09489892463', '671025', '1583653502-Dalagan-removebg-preview.jpg'),
(443, 'Deapera', 'Sherlyn', '', '2', '1', '3', '1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '6/7/1998', 'southern luzon state unicersity', 'bs-preschool education', '9462443757', 'deaperasherlynl@gmail', 'elizabeth p.deapera', 'Mother', '09098619693', '671026', '1583653536-Deapera-removebg-preview.jpg'),
(444, 'Deluna', 'Perlyn', '', '2', '1', '3', '1', 'Dipolog City', 'Zamboanga Del Norte', 'IX', 'PHL', '2/1/1998', 'jose rizal memorial state unicersity-dipolog', 'bsed', '9099017300', 'none@gmail.com', 'elizabeth d.tumarong', 'sister', '09489450458', '671027', '1583653564-Deluna-removebg-preview.jpg'),
(445, 'Dioqui', 'Evelyn', '', '2', '1', '3', '1', 'Lala', 'Lanao Del Norte', 'X', 'PHL', '3/21/1997', 'north central mindanao college', 'bs-general education', '9169941670', 'none@gmail.com', 'elizabeth d.ballesteros', 'sister', '09173096623', '671028', '1583653603-Deuquino-removebg-preview.jpg'),
(446, 'Dudoyan', 'Lea', '', '2', '1', '3', '1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '10/19/1997', 'university of southeastern philippines', 'bs-entrepreneurship', '9104094994', 'leadudoyan19@gmail.com', 'mr&mrs.dino dudoyan', 'parents', '09488426210', '671029', 'logo.png'),
(447, 'Dulawan', 'Grail', '', '2', '1', '3', '1', 'Kasibu', 'Nueva Vizcaya', 'II', 'PHL', '11/18/1993', 'saint mary', 'bs-civil engineering', '9179493528', 'dulawan.grail@gmail.com', 'jenifer ansibey', 'sister', '09158529671', '671030', '1583653646-Dulawan-removebg-preview.jpg'),
(448, 'Enario', 'Little', '', '2', '1', '3', '1', 'Kumalarang', 'Zamboanga Del Sur', 'IX', 'PHL', '11/17/1994', 'mindanao state university buug campus', 'bs-agronomy', '9979012576', 'elittlemae@yahoo.com', 'medeline enario', 'Mother', '09365756112', '671031', '1583653674-Enario-removebg-preview.jpg'),
(449, 'Esteban', 'Marianne', '', '2', '1', '3', '1', 'Mariveles ', 'Bataan', 'III', 'PHL', '10/25/1997', 'University of Northern Philippines', 'bsit-electronics tech', '09363546529', 'none@gmail.com', 'oliva asuncion', 'Mother', '09777841785', '671032', '1583653717-Esteban-removebg-preview.jpg'),
(450, 'Eugenio', 'Jona Liezl', '', '2', '1', '3', '1', 'San Mariano', 'Isabela', 'II', 'PHL', '10/14/1987', 'quirino state university campus', 'bs-agri', '9273720646', 'none@gmail.com', 'aida valdez', 'aunt', '09560962965', '671033', '1583653751-Eugenio-removebg-preview.jpg'),
(451, 'Garcia', 'Hayrine', '', '2', '1', '3', '1', 'Caloocan', 'Metro Manila', 'NCR', 'PHL', '3/10/1998', 'university of caloocan', 'bpa-public administration', '9152611593', 'hayrine.garcia@yahoo.com', 'hernando garcia', 'Father', '1234', '671034', '1583653901-Garcia-removebg-preview.jpg'),
(452, 'Gomo', 'Pamela', '', '2', '1', '3', '1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '9/23/1998', 'southern luzon state unicersity', 'bsed-pre-education', '9101698015', 'pamelagomo@gmail.com', 'yolando p.gomo', 'Mother', '09299599598', '671035', 'logo.png'),
(453, 'Hokia', 'Edlyn', '', '2', '1', '3', '1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '5/10/1997', 'up-diliman', 'bs-civil engineering', '9985544416', 'mai_hokia@yahoo.com', 'jeanne c.hokia', 'Mother', '09177924894/09232400143/3724269', '671036', '1583653967-Hokia-removebg-preview.jpg'),
(454, 'Ibardelosa', 'Charlene', '', '2', '1', '3', '1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '4/27/1998', 'southern luzon state unicersity', 'beed-sped', '9466778995', 'ibardelosacharlene@gmail.com', 'mylene v.ibardelosa', 'Mother', '09003453027', '671037', '1583654003-Ibardilosa-removebg-preview.jpg'),
(455, 'Inocian', 'Adorny', '', '1', '1', '3', '1', 'Cebu City', 'Cebu', 'VII', 'PHL', '11/7/1998', 'cebu normal university', 'beed-sped', '9279526008', 'adornyinocian@gmail.com', 'jocelyn b.inocian', 'Mother', '09205234432', '671038', '1583654156-Inocian-removebg-preview.jpg'),
(456, 'Jerusalem', 'Jennica', '', '2', '1', '3', '1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '12/15/1993', 'icct college foundation inc', 'bs-information technology', '9569680114', 'annjennicajerusalem@gmail.com', 'jessica jerusalem', 'Mother', '1234', '671039', '1583654235-Jerusalem-removebg-preview.jpg'),
(457, 'Juan', 'Xyrelle', '', '2', '1', '3', '1', 'Sto. Domingo', 'Nueva Ecija', 'III', 'PHL', '12/17/1999', 'central luzon state unicersity', 'bs-agriculture', '9458274909', 'xyrlljuan@gmail.com', 'teresita p.juan', 'Mother', '09162132353', '671040', '1583654279-Juan-removebg-preview.jpg'),
(458, 'LaÃ±a', 'Teresa', '', '2', '1', '3', '1', 'Cebu City', 'Cebu', 'VII', 'PHL', '2/16/1998', 'cebu technological university', 'beed', '9309027678', 'teresalana.26@gmail.com', 'jerna lomocso', 'sister in flesh', '09356080794/09284894240', '671041', '1583654351-Lana-removebg-preview.jpg'),
(459, 'Landao', 'Ma. Rowena', '', '2', '1', '3', '1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '10/28/1999', 'philippine normal university', 'bs-filipino education', '9060923537', 'landaomarowenq@gmail.com', 'rowena landao', 'Mother', '09392076272', '671042', '1583654386-Landao-removebg-preview.jpg'),
(460, 'Liwanag', 'Janna', '', '2', '1', '3', '1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '8/21/1999', 'mapua university', 'bs-chemical engineering', '9385107364', 'hbrjnnlwng@gmail.com', 'nazario c.liwanag', 'Father', ' ', '671043', '1583654426-Liwanag-removebg-preview.jpg'),
(461, 'Luarez', 'Guerlain', '', '2', '1', '3', '1', 'San Francisco', 'Agusan Del Sur', 'XIII', 'PHL', '9/25/1996', 'caraga state university', 'bs-biology', '9483160154', 'luarezguerlainkate@gmail.com', 'luarez virgel.m', 'Father', '091010 51198', '671044', '1583654455-Luarez-removebg-preview.jpg'),
(463, 'Maceda', 'Shulamite', ' ', '2', '1', '3', '1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '6/12/1998', 'new era university', 'b-elementry education', '9456012560', 'shulamitemrrmaceda@gmail.com', 'grace joy r.maceda', 'Mother', '09065255719', '671046', '1583728581-Maceda-removebg-preview.jpg'),
(464, 'Maghinay', 'Jehdalie', '', '2', '1', '3', '1', 'La Libertad', 'Zamboanga Del Norte', 'IX', 'PHL', '9/14/1994', 'jose rizal memorial state unicersity', 'b-elementry education', '9363251769', 'none@gmail.com', 'librado i.wate', 'grandfather', '09461460767', '671047', '1583654545-Maghinay-removebg-preview.jpg'),
(465, 'Manlupig', 'Mary Grace', '', '2', '1', '3', '1', 'Taguig', 'Metro Manila', 'NCR', 'PHL', '1/10/1997', 'MSU- IIT', 'BEED-English', '09309555941', 'none@gmail.com', 'vanessa agraba t.manlupig', 'sister', '09304535025', '671048', '1583654588-Manlupig-removebg-preview.jpg'),
(466, 'Marco', 'Christine Ann', '', '2', '1', '3', '1', 'Sindangan', 'Zamboanga Del Norte', 'IX', 'PHL', '1/14/1998', 'saint joseph college of sindangan inc', 'bsed-english', '09558900680', 'none@gmail.com', 'ana d.marco&grace d.chiong', 'Mother&aunt', '09368882402/09173222286', '671049', '1583655270-Marco-removebg-preview.jpg'),
(467, 'Marquez', 'Chosen', '', '2', '1', '3', '1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '3/18/1997', 'central mindanao university', 'bs-accountancy', '9265587310', 'chosenmarquez@gmail.com', 'marivic marqyez', 'Mother', '09301547293', '671050', '1583655308-Marquiz-removebg-preview.jpg'),
(468, 'Mendoza', 'Pamela', '', '2', '1', '3', '1', 'Danao City', 'Cebu', 'VII', 'PHL', '2/12/1995', 'collegio de san antonio de padua de la salle supervised sch.', 'b-second education-science', '9296282335', '', 'catalino p.mendoza', 'Father', '09973441950/09262804172', '671051', 'logo.png'),
(469, 'Mole', 'Honeybeth', '', '2', '1', '3', '1', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '4/25/1999', 'city of malabon university', 'bse-english', '9971484224', 'beth.moleno@gmail.com', 'linnie Mole', 'Mother', '09553201994/09353630509', '671052', '1583655438-Moleno-removebg-preview.jpg'),
(470, 'Obod', 'Ericka Jane', '', '2', '1', '3', '1', 'Ozamiz City', 'Misamis Occidental', 'X', 'PHL', '9/14/1996', 'colegio de san francisco javier', 'bs-social work', '9387346493', 'none@gmail.com', 'rebecca obod', 'Mother', '09087851302', '671053', '1583655480-Obod-removebg-preview.jpg'),
(471, 'Olivar', 'Romelee', '', '2', '1', '3', '1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '12/19/1997', 'jose rizal memorial state unicersity', 'bs-civil engineering', '9261836818', 'oromelee9@gmail.com', 'romeo c.olivar', 'Father', '09431392253', '671054', '1583655516-Olivar-removebg-preview.jpg'),
(472, 'Omanyag', 'Mildred', '', '2', '1', '3', '1', 'La Libertad', 'Zamboanga Del Norte', 'IX', 'PHL', '12/28/1994', 'andres bonifacio college', 'bsed-mathematics', '9489390335', 'omanyag22@gmail.com', 'jean a.dma', 'sister', '09465003765/09091386139', '671055', '1583655562-Omanyag-removebg-preview.jpg'),
(473, 'Pacatang', 'Fatima', '', '2', '1', '3', '1', 'Tagbilaran', 'Bohol', '7', 'PHL', '5/13/1999', 'bohol island state university', 'bs-entrepreneurship', '09484521798', 'none@gmail.com', 'aneeita u.pacatang', 'Mother', '09462384726', '671056', '1583653822-Fatima-removebg-preview.jpg'),
(474, 'Palarca', 'Cyril ', '', '2', '1', '3', '1', 'Mu', 'Nueva Ecija', 'III', 'PHL', '12/4/1995', 'central luzon state unicersity', 'bs-agriculture', '9499917428', 'cypalarca04@gmail', 'gemma palarch', 'Mother', '09499917428', '671057', '1583655594-Palarca-removebg-preview.jpg'),
(475, 'Panganoron', 'Mafeth', '', '2', '1', '3', '1', 'Iligan City', 'Misamis Occidental', 'X', 'PHL', '3/21/1997', 'mindanao state university-iligan institute of technology', 'bstte-drafting', '9269687613', 'none@gmail.com', 'nickel jean s.lagare', 'spiritual mother', '09128001388', '671058', '1583655655-Panganoron-removebg-preview.jpg'),
(476, 'Papa', 'Rejoice', '', '2', '1', '3', '1', 'Cagayan De Oro City', 'Misamis Oriental', 'X', 'PHL', '7/19/1998', 'Xavier Ateneo De Cagayan University', 'bs-information system', '9262332645', 'none@gmail.com', 'katherine u.papa', 'Mother', '09069712992', '671059', '1583655683-Papa-removebg-preview.jpg'),
(477, 'Perez', 'Abegail', '', '2', '1', '3', '1', 'Gapan City', 'Nueva Ecija', 'III', 'PHL', '6/11/1994', 'neust&art', 'bse english&art', '9150835308', 'abegailcarrascoperez', 'athena ramirez', 'sister in christ', '09972915369', '671060', 'logo.png'),
(478, 'Perocho', 'Sheckena', '', '2', '1', '3', '1', 'Makati  City', 'Metro Manila', ' NCR', 'PHL', '8/17/1998', 'negros oriental state university', 'bs-office system mngt', '9068682489', 'sheckenagrace@gmail.com', 'jennifer b.perocho', 'Mother', '09558390699', '671061', '1583655827-Perocho-removebg-preview.jpg'),
(479, 'Pimentel', 'Irene', '', '2', '1', '3', '1', 'Mu', 'Nueva Ecija', 'III', 'PHL', '12/27/1997', 'central luzon state unicersity', 'bsed-social studies', '9459659473', 'pimentelaireen@gmail.com', 'irene i.pimentel', 'Mother', '09338132627', '671062', '1583654193-Irene-removebg-preview.jpg'),
(480, 'Poliran', 'Angelika', '', '2', '1', '3', '1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '5/4/1999', 'zambonga state college of marine sciences and technology', 'bs-agriculture', '9092167690', 'angelikapoliranika@gmail.com', 'mario m.poliran', 'Father', '09480823221', '671063', '1583655856-Poliran-removebg-preview.jpg'),
(481, 'Pungtan', 'Arnoliza', '', '2', '1', '3', '1', 'Buug ', 'Zamboanga Sibugay', 'IX', 'PHL', '7/7/1998', 'mindanao state university buug campus', 'bsed-filipino', '9093359079', 'arnolizapungtan@gmail.com', 'arnold pungtan sr.', 'Father', '09752959800', '671064', '1583655890-Pungtan-removebg-preview.jpg'),
(482, 'Rivera', 'Alma', ' ', '2', '1', '3', '1', 'Cebu City', 'Cebu', 'VII', 'PHL', '6/21/1989', 'university of cebu', 'english', '9108143061', 'arumasan45@gmail.c0m', 'jemima rivera', 'Mother', '09423711839', '671065', '1583728829-Rivera-removebg-preview.jpg'),
(484, 'Samson', 'Maria Rose', '', '2', '1', '3', '1', 'Milagros', 'Masbate', 'V', 'PHL', '3/15/1994', 'dr.emilio b.espinosa,sr.memorial state college of agriculture&technology', 'bse-english', '9272360342', 'mariarosesamson@gmail.com', 'heide a.samson', 'Mother', '09303464094', '671067', '1583656003-Samson-removebg-preview.jpg'),
(485, 'Sanchez', 'Janssen', '', '2', '1', '3', '1', 'Malaybalay', 'Bukidnon', 'X', 'PHL', '6/20/1998', 'liceo de cagayan university', 'bs-medical technology', '9750440685', 'patetsanchez21@gmail.com', 'arlene g.sanchez', 'Mother', '09178876128', '671068', '1583656031-SancheZ-removebg-preview.jpg'),
(486, 'Sarsalejo', 'Archeneth', '', '2', '1', '3', '1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '1/30/1997', 'city of malabon university', 'bse-english', '9979014862', 'archeneth.sarsalejo97@gmail.com', 'deborah cabiles', 'aunt', '09338101272', '671069', '1583656073-Sarsalejo-removebg-preview.jpg'),
(487, 'Senobin', 'Bethlehem', '', '2', '1', '3', '1', 'Valenzuela', 'Metro Manila', 'NCR', 'PHL', '6/14/1999', 'our lady of fatima university', 'bsit', '9979552246', 'edensenobin@gmail.com', 'jocelyn senobin', 'Mother', '09753984294', '671070', 'logo.png'),
(488, 'Servas', 'Deaza  May', ' ', '2', '1', '3', '1', 'Panaon', 'Misamis Occidental', 'X', 'PHL', '5/8/1998', 'jose rizal memorial state university', 'bsed-social studies', '9077115799', 'servasdeaza09@gmail.com', 'danilo c.servas', 'Father', '09465195469', '671071', '1583728908-Servas-removebg-preview.jpg'),
(490, 'Sumalinog', 'Yenyell', '', '2', '1', '3', '1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '10/31/1996', 'university of cebu-lapu lapu and mandave', 'bs-elementary education', '9167761687', 'yenyellsumalinog@gmail.com', 'nenen sumalinog', 'Mother', '09420031349', '671073', '1583656105-Sumalinog-removebg-preview.jpg'),
(491, 'Sumaylo', 'Jay Sel', '', '2', '1', '3', '1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '1/11/1994', 'university of cevu-banilao', 'bsit', '9297311352', 'sjaysel@gmail.com', 'noemi/zaena sumaylo', 'sister', '09223584568/09223788245', '671074', 'logo.png'),
(492, 'Tomimbang', 'Febe', '', '2', '1', '3', '1', 'Tangub City', 'Misamis Occidental', 'X', 'PHL', '2/2/1998', 'mindanao state university-iligan institute of technology', 'bs-metallurgical engineering', '9556246140', 'febzki14@gmail.com', 'jimmt j.tomimbang', 'Father', '09308911038', '671075', '1583656412-Tumimbang-removebg-preview.jpg'),
(493, 'Tumanda', 'Rose Ann', ' ', '2', '1', '3', '1', 'Batuan', 'Bohol', 'VII', 'PHL', '7/26/1997', 'batuan college inc.', 'beed', '9098972764', 'roseanntumanda18@gmail.com', 'felicitas tumanda', 'Mother', '09385141124', '671076', '1583728982-Tumanda-removebg-preview.jpg'),
(494, 'Utleg', 'Anginette', '', '2', '1', '3', '1', 'Solsona', 'Ilocos Norte', 'I', 'PHL', '8/4/1997', 'Mariano Marcos State University', 'bs-electrical engineering', '9094118568', 'none@gmail.com', 'nestor tuliao', 'uncle', '09156518745', '671077', '1583656452-Utleg-removebg-preview.jpg'),
(495, 'Vasquez', 'Junabe', ' ', '2', '1', '3', '1', 'Taytay', 'Palawan', 'IV-B', 'PHL', '6/18/1997', 'Western Philippines University', 'bs-elementary education', '9350360766', '.@gmail.com', 'abner p.vasquez', 'Father', ' ', '671078', '1583729035-Vasquez-removebg-preview.jpg'),
(496, 'Vendicacion', 'Herzl Anne', ' ', '2', '1', '3', '1', 'San Ildefonso', 'Bulacan', 'III', 'PHL', '12/13/1995', 'la consolacion college manila', 'bs-accountancy', '9156006956', 'herzlanne@gmail.com', 'analiza a.vendicacion', 'Mother', '09338593994', '671079', '1583729283-Venbicassion-removebg-preview.jpg'),
(497, 'Verano', 'Abilyn', ' ', '2', '1', '3', '1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '9/18/1989', 'saint peter', 'bs-electrical engineering', '9498326330', 'v.abilyn@gmail', 'marlene terrible verano', 'Mother', '09196031391', '671080', '1583729250-Verano-removebg-preview.jpg'),
(498, '', 'Ruth', '', '2', '1', '3', '1', 'Country X', 'N/A', 'N/A', 'X', '8/25/1989', '', 'ba-industried&tourism', '', '', 'bro.ezra', 'husband', '09183159569', '671081', 'logo.png'),
(499, 'Yuba', 'Aprilyn', ' ', '2', '1', '3', '1', 'Malita', 'Davao Occidental', 'XI', 'PHL', '4/22/1996', 'southern philippines agri-business&marine&aguahe technology school', 'bs-agri-bussiness', '9354129439', '.@gmail.com', 'eunice pepuual', 'aunt', '09066454929', '671083', '1583729116-Yuba-removebg-preview.jpg'),
(500, 'Zacal', 'Rayl', ' ', '2', '1', '3', '1', 'Lakewood', 'Zamboanga Del Sur', 'IX', 'PHL', '10/5/1998', 'jhcsc', 'bs-secondary education', '9484843548', 'zeeraylmianecabz@gmail.com', 'reylan m.zacal', 'Father', '09300463362', '671084', '1583729071-Zacal-removebg-preview.jpg'),
(501, 'Pelarion', 'Shullamite', '', '2', '1', '3', '1', 'Villadolia', 'Negros Occidental', ' ', 'PHL', '7/14/1998', 'la carlota city college', 'bsed-mapeh', '09273595969', 'none@gmail.com', 'ma.elena pelarion', 'mouther', '09091432394/09353576128', '671086', '1583655793-Pelarion-removebg-preview.jpg'),
(502, 'Regasajo', 'Marah', '', '2', '1', '3', '1', 'quezon', 'Bukidnon', 'X', 'PHL', '7/15/1993', 'quezon institute of technology', 'bs-elementary education', '09107266729', 'none@gmail.com', 'cristia r.salado', 'sibling', '09103353097', '671085', '1583655192-Marah-removebg-preview.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `trainee_info_temp`
--

CREATE TABLE IF NOT EXISTS `trainee_info_temp` (
`trainee_id` int(11) NOT NULL,
  `Last_Name` varchar(225) NOT NULL,
  `First_Name` varchar(225) NOT NULL,
  `ID_Name` varchar(225) NOT NULL,
  `Full_Name` varchar(225) NOT NULL,
  `Middle_Name` varchar(225) NOT NULL,
  `Gender` varchar(225) NOT NULL,
  `Status` varchar(225) NOT NULL,
  `Term` varchar(225) NOT NULL,
  `Sending_Locality` varchar(225) NOT NULL,
  `Province` varchar(225) NOT NULL,
  `Region` varchar(225) NOT NULL,
  `Country` varchar(225) NOT NULL,
  `Birthdate` varchar(225) NOT NULL,
  `School` varchar(225) NOT NULL,
  `Degree` varchar(225) NOT NULL,
  `Contact_number` varchar(225) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Emergency_Contact_Person` varchar(225) NOT NULL,
  `Relationship` varchar(225) NOT NULL,
  `Contact_No` varchar(225) NOT NULL,
  `Reg_No` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=503 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainee_info_temp`
--

INSERT INTO `trainee_info_temp` (`trainee_id`, `Last_Name`, `First_Name`, `ID_Name`, `Full_Name`, `Middle_Name`, `Gender`, `Status`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`) VALUES
(1, 'Abasola', 'Aljiver', 'Aljiver', 'Abasola, Aljiver', 'Maribao', 'B', '1', 'FT2', 'Oslob', 'Cebu', '7', 'PHL', '4/24/1997', 'University of Cebu- Main Campus', 'BS Criminology', '09214762566', 'aljiverabasola24@GMAIL.COM', 'Alex Abasola', 'Father ', '09232154910', '660002'),
(2, 'Abasola', 'Livingstone', 'Livingstone', 'Abasola, Livingstone', 'Maribao', 'B', '1', 'FT2', 'Oslob', 'Cebu', '7', 'PHL', '11/14/1998', 'Negros Oriental State University', 'BSED- Mathematics', '09751842465', 'elgenbagat123@yahoo.com', 'Marciana Abasola', 'Mother', '09232154910', '660001'),
(3, 'Ablan', 'Vincent', 'Vincent', 'Ablan, Vincent', 'Montehermoso', 'B', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '11/24/1998', 'Phinma COC', 'BS Information Technology', '', 'vinestar1234@yahoo.com', 'Bernard Ablan', 'Father', '09161098551', '660003'),
(4, 'Amulong', 'Jordan', 'Jordan', 'Amulong, Jordan', 'Tagle', 'B', '1', 'FT2', 'Tagaytay City', 'Cavite', '4A', 'PHL', '11/8/1995', 'Cavite State University-Indang', 'BS Industrial Engeneering', '09970663417', 'jordanamulong08@gmail.com', 'Marilou Amulong', 'Mother', '09071827148', '660004'),
(5, 'Angcahan', 'Nicomedes Jr.', 'Nicomedes Jr.', 'Angcahan, Nicomedes Jr.', 'Real', 'B', '1', 'FT2', 'Quezon', 'Bukidnon', '10', 'PHL', '7/6/1994', 'Quezon Institute of Technology', 'Bachelor of Science in Elementary Education', '09360319934', 'nicoreal.angcahan@gmail.com', '', '', '', '660005'),
(6, 'Aying', 'Alcid John', 'Alcid John', 'Aying, Alcid John', 'Fulgueras', 'B', '1', 'FT2', 'Clarin', 'Misamis Occidental', '10', 'PHL', '11/13/1993', 'La-Salle University', 'BS-Geodetic Engineer', '09099522150', 'ajfaying@gmail.com', 'Evangeline Aying', 'Mother', '09462987321', '660008'),
(7, 'Badiango', 'Ryan Jay', 'Ryan Jay', 'Badiango, Ryan Jay', 'Augusto', 'B', '1', 'FT2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '6/7/1998', 'Rizal Technological University', 'BS Statistics', '09299577273', 'ryanjay.badiang070@gmail.com', '', '', '', '660009'),
(8, 'Blancada', 'Mark Gil', 'Mark Gil', 'Blancada, Mark Gil', 'Gogo', 'B', '1', 'FT2', 'Mandaluyong', 'Metro Manila', 'NCR', 'PHL', '5/1/1995', 'Rizal Technological University', 'Bachelor of Science in P.E', '09776413549', 'markgil.blancada@yahoo.com', 'Archie Blancada', 'Brother', '09359182197', '660011'),
(9, 'Bondoc', 'Jabez Joshua', 'Jabez', 'Bondoc, Jabez', 'Guillen', 'B', '1', 'FT2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '11/16/1998', 'AMA Computer College-Caloocan', 'BSIT-Web Development', '', '', '', '', '', '660012'),
(10, 'Canoy', 'Rogelio', 'Rogelio', 'Canoy, Rogelio', '', 'B', '1', 'FT2', 'San Fernando', 'Bukidnon', '10', 'PHL', '4/24/1997', 'San Agustin Institute of Technology', 'Bachelor of Science in Elementary Education', '09076151955', '', 'Welma Doblas', 'Grandmother', '09076151955', '660014'),
(11, 'Cavan', 'Cyril', 'Cyril', 'Cavan, Cyril', '', 'B', '1', 'FT2', 'Digos City', 'Davao Del Sur', '11', 'PHL', '6/12/1998', 'Ateneo de Davao University', 'BS Business Management', '', '', '', '', '', '660015'),
(12, 'Chen', 'Weiji', 'Job', 'Chen, Job', '', 'B', '1', 'FT2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '5/5/1998', 'Zhejiang Yuying Vocational and Technical College', 'Major in Apllied English', '8613588344970', '13588344970@163.com', 'Zhaopin Chen', 'Father', '8613085885558', '660017'),
(13, 'Dayro', 'Mark Eugen', 'Mark Eugen', 'Dayro, Mark Eugen', 'Saludo', 'B', '1', 'FT2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '8/31/1987', 'Saint Jude College Manila', 'BS Pharmacy', '09152885642', 'mesdayro@gmail.com', 'Elizabeth Putan', 'Sister', '09228490959', '660019'),
(14, 'De Borja', 'Karl', 'Karl', 'De Borja, Karl', 'Manimtim', 'B', '1', 'FT2', 'Jalajala', 'Rizal', '4A', 'PHL', '7/31/1997', 'STI College - Tanay', 'BS Information Technology', '', '', '', '', '', '660020'),
(15, 'Dela Cerna', 'Rodel', 'Rodel', 'Dela Cerna, Rodel', 'Asok', 'B', '1', 'FT2', 'Lala', 'Lanao Del Norte', '10', 'PHL', '10/5/1994', 'North Central Mindanao College', 'Accounting Technology', '09758118986', '5rodeldelacerna@gmail.com', 'Carlo Dioquino', 'Brother', '09059566576', '660021'),
(16, 'Dioquino', 'Chris', 'Chris', 'Dioquino, Chris', 'Labitad', 'B', '1', 'FT2', 'Lala', 'Lanao Del Norte', '10', 'PHL', '12/25/1995', 'North Central Mindanao College', 'BS Accountancy', '09556002960', 'dioquinochris@gmail.com', 'Elizabeth Balesteros', 'Sister', '09173096623', '660022'),
(17, 'Escobar', 'Joey', 'Joey', 'Escobar, Joey', 'Partolo', 'B', '1', 'FT2', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '7/17/1995', 'Colegio De Sta Rita De San Carlos, INC.', 'BS Elementary Education', '09099894363', 'joeyescobar@gmail.com', 'Neil P. Escobar ', 'Father', '09275728373', '660023'),
(18, 'Esmade', 'August', 'August', 'Esmade, August', 'Letimas', 'B', '1', 'FT2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '8/13/1997', 'Bestlink College of the Philippines', 'BS Business Administration', '09751792758', '', 'Emily Esmade', 'Mother', '09153322303', '660024'),
(19, 'Estrabon', 'Hubert', 'Hubert', 'Estrabon, Hubert', 'Obuyes', 'B', '1', 'FT2', 'Koronadal City', 'South Cotabato', '12', 'PHL', '4/25/1996', 'STI College of Koronadal', 'BS In Information Technology', '09174853754', 'EstrabonHub@gmail.com', 'Rose Estrabon', 'Mother', '09214145674', '660025'),
(20, 'Fernandez', 'Chrysolite', 'Chrysolite', 'Fernandez, Chrysolite', 'Campo', 'B', '1', 'FT2', 'General Trias', 'Cavite', '4A', 'PHL', '2/24/1998', 'Cavite State University - Indang', 'BS Economics - Agriculture', '', '', '', '', '', '660027'),
(21, 'Gabales', 'Erol', 'Erol', 'Gabales, Erol', 'Honra', 'B', '1', 'FT2', 'Bulusan', 'Sorsogon', '5', 'PHL', '11/27/1997', 'Sorsogon State College', 'BS Civil Engineering', '', '', '', '', '', '660028'),
(22, 'Godoy', 'Vicente', 'Vicente', 'Godoy, Vicente', 'Dela Torre', 'B', '1', 'FT2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '4/25/1991', 'City of Malabon University', 'BS Information Technology', '', '', '', '', '', '660029'),
(23, 'Golosino', 'Genesis', 'Genesis', 'Golosino, Genesis', '', 'B', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '6/21/1997', 'STI College - Cagayan de Oro City', 'BS Human Resource Management', '', '', '', '', '', '660030'),
(24, 'Gonzales', 'Joseph', 'Joseph', 'Gonzales, Joseph', '', 'B', '1', 'FT2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '1/21/1999', 'Navotas Polythecnic College', 'BSED - Special Education', '', '', '', '', '', '660031'),
(25, 'Guardaquivil', 'Joshua', 'Joshua', 'Guardaquivil, Joshua', 'Clarion', 'B', '1', 'FT2', 'Lala', 'Lanao del Norte', '10', 'PHL', '4/14/1995', 'Mindanao State University-Main Campus', 'BS Statistics', '09675842175', 'joshua14.c@gmail.com', 'Michael Clarion Guardaquivil', 'Brother', '09050369030', '660032'),
(26, 'Hernandez', 'Hubert', 'Hubert', 'Hernandez, Hubert', '', 'B', '1', 'FT2', 'San Juan', 'Batangas', '4A', 'PHL', '10/29/1999', 'Batangas State University', 'BSED - Filipino', '', '', '', '', '', '660033'),
(27, 'Hsu', 'Chien-Hua', 'Hiram', 'Hsu, Hiram', '', 'B', 'Inactive', 'FT2', 'New Taipei City', 'Taiwan', 'Taiwan', 'TAIWAN', '7/29/1996', 'National Sun Yat-sen University', 'Chinese Literature/Business Management', '0963738325', 'vm6ruo4cj86@gmail.com', 'Mary Jane Josol', 'Father', '0939313440', '660034'),
(28, 'Ignacio', 'Mark Laurence', 'Laurence', 'Ignacio, Laurence', 'Basa', 'B', '1', 'FT2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '6/10/1998', 'Bestlink College of the Philippines', 'BS Business Administration', '', '', '', '', '', '660035'),
(29, 'Insang', 'Jason', 'Jason', 'Insang, Jason', 'Maghanoy', 'B', '1', 'FT2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '1/6/1999', 'Ateneo De Zamboanga University', 'BS Accounting Technology', '09990220740', 'insang.jason@gmail.com', 'Insang Vilma Maghanoy', 'Mother', '09759533818', '660036'),
(30, 'Jerusalem', 'Roijervin', 'Roijervin', 'Jerusalem, Roijervin', 'Lavente', 'B', '1', 'FT2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '2/24/1996', 'ICCT CFI', 'BS Accountancy', '', '', '', '', '', '660037'),
(31, 'Layna', 'June Rill', 'June Rill', 'Layna, June Rill', 'Tagalogon', 'B', '1', 'FT2', 'Panaon', 'Misamis Occidental', '10', 'PHL', '6/12/1995', 'La-Salle University', 'BSECE', '09079787311', 'junejuly463@gmail.com', 'Judie S. Layna', 'Father', '09502193185', '660038'),
(32, 'Legilisho', 'Daniel', 'Daniel', 'Legilisho, Daniel', 'Sankale', 'B', '1', 'FT2', 'Harbin', 'China', 'China', 'CHINA', '1/14/1989', 'Harbin Institute of Technology (China)', 'Master Information Engineer', '86-18846756153', 'danlegishio@yahoo.com', 'James Legilisho Kiyiapi', 'Father', '254734994499', '660039'),
(33, 'Llupar', 'Neomar', 'Neomar', 'Llupar, Neomar', '', 'B', '1', 'FT2', 'San Juan', 'Batangas', '4A', 'PHL', '1/29/1996', 'Batangas State University', 'BS Filipino', '', '', '', '', '', '660040'),
(34, 'Macahilas', 'Jasper', 'Jasper', 'Macahilas, Jasper', 'Gonzales', 'B', '1', 'FT2', 'Dasmari', 'Cavite', '4A', 'PHL', '12/27/1995', 'Cavite State University - Indang', 'BS Recreational Management', '', '', '', '', '', '660041'),
(35, 'Macapili', 'Jesreel', 'Jesreel', 'Macapili, Jesreel', 'Regalado', 'B', '1', 'FT2', 'Lakewood', 'Zamboanga Del Sur', '9', 'PHL', '4/18/1995', 'J.H Cerilles State College', 'Bachelor of Science in Elementary Education', '09463053781', 'jasreelmacapili3@gmail.com', 'Nora Macapili', 'Mother', '09759244126', '660042'),
(36, 'Madarimot', 'Bezalil', 'Bezalil', 'Madarimot, Bezalil', 'Lagata', 'B', '1', 'FT2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '11/29/1996', 'JRMSU', 'BSED-Mapeh', '09489105699', 'realname021@gmail.com', 'Cinderella Madarimot', 'Mother', '09489105679', '660043'),
(37, 'Mallo', 'Joshua', 'Joshua', 'Mallo, Joshua', 'Tambong', 'B', '1', 'FT2', 'Casiguran', 'Aurora', '3', 'PHL', '10/8/1998', 'Polytechnic University of the Philippines', 'Bachelor in Transportation Management', '', '', '', '', '', '660044'),
(38, 'Managuelod', 'Kim Adrian', 'Adrian', 'Managuelod, Adrian', 'Macatiag', 'B', '1', 'FT2', 'Divilacan', 'Isabela', '2', 'PHL', '1/26/1998', 'Isabela State University', 'BS Hotel Restaurant and Tourism', '', 'kim26@yahoo.com', 'Aguido Macatiag', 'Uncle', '09754119836', '660045'),
(39, 'Manongsong', 'Rhodin', 'Rhodin', 'Manongsong, Rhodin', '', 'B', '1', 'FT2', 'Calapan City', 'Oriental Mindoro', '4B', 'PHL', '1/13/1998', 'City College of Calapan', 'BS Information System', '', '', '', '', '', '660046'),
(40, 'Marquez', 'Daniel', 'Daniel', 'Marquez, Daniel', 'Francisco', 'B', '1', 'FT2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '3/22/1994', 'University of the Philippines Diliman', 'MS Physics', '09236092084', 'danielmarquez313@gmail.com', 'Nelson Araojo', 'Friend', '09350943471', '660047'),
(41, 'Martinet', 'Samuel', 'Samuel', 'Martinet, Samuel', 'Publico', 'B', '1', 'FT2', 'Valencia', 'Bukidnon', '10', 'PHL', '9/13/1996', 'Valencia College Inc.', 'AB-Sociology Bachelor of Arts', '09176777774', '', 'Elmar Martinet', 'Mother', '09176777774', '660048'),
(42, 'Maximo', 'Timothy John', 'Timothy', 'Maximo, Timothy', 'Ancheta', 'B', '1', 'FT2', 'Difon', 'Quirino', '2', 'PHL', '11/18/1997', 'University of Cordilleras', 'BSManagement Accounting', '09774244297', 'timothyjohnmaximo@gmail.com', 'Mark Andrei Maximo', 'Brother', '09174040198', '660049'),
(43, 'Mi?eque', 'Eddie Jr.', 'Eddie Jr.', 'Mi?eque, Eddie Jr.', 'Taladatad', 'B', '1', 'FT2', 'Baras', 'Rizal', '4A', 'PHL', '7/7/1994', 'Technological Institute of the Philippines', 'BS Marine Transportation', '09278765912', 'mineque94@gmail.com', 'Lily Mineque', 'Mother', '09216935930', '660050'),
(44, 'Modanza', 'Jeric ', 'Jeric', 'Modanza, Jeric', 'Acero', 'B', '1', 'FT2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '10/4/1997', 'Navotas Polythecnic College', 'BSBA Marketing', '', '', '', '', '', '660051'),
(45, 'Molano', 'Vincent', 'Vincent', 'Molano, Vincent', '', 'B', '1', 'FT2', 'Lingayen', 'Pangasinan', '1', 'PHL', '3/29/1997', 'Pangasinan State University', 'BS Public Administration', '', '', '', '', '', '660052'),
(46, 'Mones', 'Emmanuel Joshua', 'Emmanuel Joshua', 'Mones, Emmanuel Joshua', 'Jose', 'B', '1', 'FT2', 'Las Pi', 'Metro Manila', 'NCR', 'PHL', '8/14/1998', 'Philippine Mechant Marine School', 'BS Customs Admistration', '', '', '', '', '', '660053'),
(47, 'Nartates', 'Norven', 'Norven', 'Nartates, Norven', 'Dolusras', 'B', '1', 'FT2', 'Cabangan', 'Zambales', '3', 'PHL', '8/26/1991', 'President Ramon Magsaysay State University', 'BS Agriculture', '09302812286', '', 'Thelma Nartates', 'Mother', '09503766042', '660054'),
(48, 'Nicolas', 'Lowell James', 'Lowell', 'Nicolas, Lowell', 'Cancio', 'B', '1', 'FT2', 'Bi', 'Laguna', '4A', 'PHL', '8/4/1999', 'Polytechnic University of the Philippines-Sta. Rosa', 'BSBA Marketing Management', '09263444970', 'lowelljamesss@gmail.com', 'Mercedita Nicolas', 'Mother', '09392593056', '660055'),
(49, 'Nugas', 'Ken Moses', 'Ken Moses', 'Nugas, Ken Moses', 'Verdida', 'B', '1', 'FT2', 'Cebu City', 'Cebu', '7', 'PHL', '9/30/1996', 'University of Cebu-Main Campus', 'BSBA-Management Accounting', '09958671492', 'kenugas@gmail.com', 'Ruben Nugas', 'Father', '09151814907', '660056'),
(50, 'Ogoc', 'Cyril Jr.', 'Cyril Jr.', 'Ogoc, Cyril Jr.', 'Malinet', 'B', '1', 'FT2', 'Dapitan City', 'Zamboanga del Norte', '9', 'PHL', '9/7/1994', 'Jose Rizal Memorial State University ', 'BS Accounting Technology', '', '', '', '', '', '660057'),
(51, 'Ontao', 'Marlon', 'Marlon', 'Ontao, Marlon', 'Maglasang', 'B', '1', 'FT2', 'Amai Manabilang', 'Lanao Del Sur', 'ARMM', 'PHL', '11/1/1993', '', 'BSBA', '09868547872', '', 'Dina Ontao', 'Mother', '09363547872', '660058'),
(52, 'Oropilla', 'Joash Ezekiel', 'Joash', 'Oropilla, Joash', 'Piandong', 'B', '1', 'FT2', 'Alaminos', 'Pangasinan', '1', 'PHL', '6/3/1996', 'Adamson University', 'BS Electronics Engeneering', '', '', '', '', '', '660059'),
(53, 'Pacatang', 'Recvry', 'Recvry', 'Pacatang, Recvry', '', 'B', '1', 'FT2', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '9/18/1986', 'Governor Alfonso D. Tan College', 'BSBA Marketing', '', '', '', '', '', '660060'),
(54, 'Padre', 'King Jhapet', 'Jhapet', 'Padre, Jhapet', '', 'B', '1', 'FT2', 'Cabuyao', 'Laguna', '4A', 'PHL', '12/27/1998', 'Saint Vincent College of Cabuyao', 'BS Information Technology', '', '', '', '', '', '660061'),
(55, 'Paller', 'Kim Seer', 'Kim Seer', 'Paller, Kim Seer', '', 'B', '1', 'FT2', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/30/1995', 'MSU- Iligan Institute of Technology', 'BS Electrical  Engeneering', '', '', '', '', '', '660062'),
(56, 'Parungao', 'Jerahmeel', 'Jerahmeel', 'Parungao, Jerahmeel', 'Castillo', 'B', '1', 'FT2', 'Dasmari', 'Cavite', '4A', 'PHL', '2/25/1998', 'Cavite State University ', 'BS Industrial Engineering', '', '', '', '', '', '660063'),
(57, 'Pasquin', 'Hiromie', 'Hiromie', 'Pasquin, Hiromie', 'Delfin', 'B', '1', 'FT2', 'San Simon', 'Pampanga', '3', 'PHL', '1/6/1995', 'Bulacan State University', 'BS Home Economics', '09357634535', 'hiromiepasquin@gmail.com', 'Norberto Pasquin', 'Father', '09978279176', '660064'),
(58, 'Payot', 'John Anthony', 'Anthony', 'Payot, Anthony', '', 'B', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '4/26/1994', 'Phinma Cagayan De Oro College', 'BSBA Financial Management', '', '', '', '', '', '660065'),
(59, 'Pepito', 'Ritchie', 'Ritchie', 'Pepito, Ritchie', 'Baliguat', 'B', '1', 'FT2', 'Don Carlos', 'Bukidnon', '10', 'PHL', '5/30/1997', 'Don Carlos Polytecnic College', 'HRM', '09972074785', 'ritchiepepito@gmail.com', '', '', '09552153899', '660066'),
(60, 'Pino', 'Peniel James', 'Peniel', 'Pino, Peniel', 'Jenova', 'B', '1', 'FT2', 'Butuan City', 'Agusan Del Norte', '13 (CARAGA)', 'PHL', '12/21/1996', 'Holy Child Colleges of Butuan', 'B.S Criminology', '09388510887', 'pjcc385@gmail.com', 'Perla Pino', 'Mother', '09121591507', '660067'),
(61, 'Pojas', 'Ram Paul', 'Ram', 'Pojas, Ram', 'Gomez', 'B', '1', 'FT2', 'Molave', 'Zamboanga del sur', '9', 'PHL', '4/9/1996', 'Mindanao State University-Iligan Institute of Technology', 'BSECT-Embedded Systems', '09481126096', 'RAMPAULPOJAS@gmail.com', 'Aurelia Pojas', 'Mother', '09102834479', '660068'),
(62, 'Rodriguez', 'Larry Boy', 'Larry', 'Rodriguez, Larry', 'Ornopia', 'B', '1', 'FT2', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '7/12/1996', 'Navotas Polytechnic College', 'BSBA Marketing', '09107047805', 'Rodriguez.Larry12@yahoo.com', 'Lanie Rodriguez', 'Sister', '09567886128', '660069'),
(63, 'Rosales', 'James Andrew', 'James Andrew', 'Rosales, James Andrew', '', 'B', '1', 'FT2', 'Bacoor', 'Cavite', '4A', 'PHL', '12/23/1997', 'De La Salle University-Dasmarinas', 'Information Technology', '09434510973', 'jamesandrew1203@yahoo.com', 'Romeo Rosales', 'Father', '09233783991', '660070'),
(64, 'Ruta', 'R-jay', 'R-jay', 'Ruta, R-jay', 'Estosata', 'B', '1', 'FT2', 'Polomolok', 'South Cotabato', '12', 'PHL', '7/7/1998', 'STI College of General Santos', 'BS Information Technology', '09777220294', 'rjayruta@gmail.com', 'Rodel Ruta', 'Father', '09461606658', '660071'),
(65, 'Sanchez', 'Joshua Chris', 'Joshua Chris', 'Sanchez, Joshua Chris', '', 'B', '1', 'FT2', 'Ormoc City', 'Leyte', '8', 'PHL', '11/23/1997', 'Eastern Visayas State University', 'BSED-TLE', '09567164030', '', '', '', '', '660072'),
(66, 'Sarsalejo', 'Arden', 'Arden', 'Sarsalejo, Arden', 'Daiz', 'B', '1', 'FT2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/10/1996', 'City of Malabon University', 'Secondary Education-Math', '09233380780', '', 'Loida Vytongco', 'Guardian', '9257512', '660073'),
(67, 'Sumalpong', 'Ronel Jay', 'Ronel Jay', 'Sumalpong, Ronel Jay', '', 'B', '1', 'FT2', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '10/21/1997', 'Misamis University- Ozamis City', 'BSHRM', '09456049692', '', '', '', '', '660074'),
(68, 'Suma-oy', 'Deshanestrel', 'Deshanestrel', 'Suma-oy, Deshanestrel', 'Suhay', 'B', '1', 'FT2', 'Dipolog City', 'Zamboanga Del Norte', '9', 'PHL', '10/11/1994', 'Andres Bonifacio College', 'BSED-English', '09223101139', 'deshanestrels@gmail.com', 'Rickardo Paghsasian', 'Elder', '09985102075', '660075'),
(69, 'Talasan', 'Justine Israel', 'Justine Israel', 'Talasan, Justine Israel', 'Moquiala', 'B', '1', 'FT2', 'Bacolod', 'Lanao del Norte', '10', 'PHL', '7/25/1997', 'Mindanao State University-Institute of Technology', 'BEED-English', '09364342631', 'justinetalGOGO@gmail.com', 'Manolito Talasan', 'Father', '09338154957', '660076'),
(70, 'Tamayo', 'Christian', 'Christian', 'Tamayo, Christian', '', 'B', '1', 'FT2', 'Los Ba', 'Laguna', '4A', 'PHL', '10/28/1995', 'LSPU Los Banos Campus', 'Agri-Fisheries and Business Management', '09478043748', '', '', '', '', '660077'),
(71, 'Tangcay', 'Vessel', 'Vessel', 'Tangcay, Vessel', '', 'B', '1', 'FT2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '7/1/1995', 'Medina Foundation College', 'BS Business Administration', '09129525668', '', 'Merely Tangcay', 'Mother', '09073765747', '660078'),
(72, 'Tanoy', 'Noelmar', 'Noelmar', 'Tanoy, Noelmar', '', 'B', '1', 'FT2', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '5/19/1997', 'Western Mindanao State University', 'BSED-English', '09187263226', 'marmarimo1997@gmail.com', 'Noel Tanoy', 'Father', '09308948265', '660079'),
(73, 'Tongco', 'Meynard', 'Meynard', 'Tongco, Meynard', 'Mercado', 'B', '1', 'FT2', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '8/29/1995', 'City of Malabon University', 'Information Technology', '09231946370', '', '', '', '', '660080'),
(74, 'Tran', 'Phuoc', 'Phuoc', 'Tran, Phuoc', 'Quang', 'B', 'Inactive', 'FT2', 'Ha Noi', 'Vietnam', 'Vietnam', 'VIETNAM', '10/7/1984', 'Hochiminh City Universityof Technology and Education', 'Electronics', '84795918685', 'phuocty84@gmail.com', 'Vu Thi Cam Yam', 'Wife', '84936463288', '660081'),
(75, 'Tuboro', 'Joshua', 'Joshua', 'Tuboro, Joshua', 'Sy', 'B', '1', 'FT2', 'Pasig City', 'Metro Manila', 'NCR', 'PHL', '3/26/1998', 'Arellano University', 'Information Technology', '09274960330', 'JOSHUATUBORO@GMAIL.COM', 'Rosa Vel Tuboro', 'Mother', '09664577847', '660082'),
(76, 'Vidad', 'Eben Ezer', 'Eben Ezer', 'Vidad, Eben Ezer', 'Ontao', 'B', '1', 'FT2', 'Quezon', 'Bukidnon', '10', 'PHL', '2/22/1995', 'Quezon Institute of Technology', 'Bachelor of Science in Elementary Education', '09460596308', '', '', '', '', '660083'),
(77, 'X', 'Joseph', 'Joseph', 'X, Joseph', '', 'B', '1', 'FT2', 'X', 'X', 'X', 'X', '11/3/1965', '', '', '', '', 'Rasool', '', '09128432507', '660084'),
(78, 'Zheng', 'Guotian', 'Enoch', 'Zheng, Enoch', '', 'B', '1', 'FT2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '1/22/1997', 'Zhejiang University of Science and Technology', 'Major in Accountancy', '8615990177759', '761523919@99.com', 'Yuzhu Zheng', 'Father', '13868830526', '660085'),
(79, 'Acquiatan', 'Jerizim', 'Jerizim', 'Acquiatan, Jerizim', 'Buta', 'B', '1', 'FT3', 'Tandag City', 'Surigao Del Sur', '13 (CARAGA)', 'PHL', '1/15/1995', 'Stella Maris College', 'BSED- English', '09381363715', 'jezacquiatan@gmail.com', 'Tito L. Acquitan', 'Father', '09073662362', '65001'),
(80, 'Ambet', 'Erick', 'Erick', 'Ambet, Erick', 'Ampait', 'B', '1', 'FT3', 'Cagayan De Oro City', 'Misamis Oriental', '10', 'PHL', '3/3/1997', 'J.H. Cerilles State College', 'BSIT', '09676651727', 'erickampaitambet@gmail.com', 'Jeson Omapas', '', '09355550693', '65002'),
(81, 'Araneta', 'Meliton', 'Meliton', 'Araneta, Meliton', 'Lasdoce', 'B', '1', 'FT3', 'Bogo City', 'Cebu', '7', 'PHL', '3/18/1995', 'Cebu Technological University', 'BS Marine Engineering', '09451440904', 'melitonaraneta@gmail.com', 'Ligaya Araneta', 'Mother', '09558510260', '65031'),
(82, 'Ba?ares', 'Christian Jer', 'Christian', 'Ba?ares, Christian', '', 'B', '1', 'FT3', 'Arayat', 'Pampanga', '3', 'PHL', '8/21/1996', 'Don Honorio Ventura Technological State University', 'Civil Engineering', '09661364914', 'cjmb21@yahoo.com', 'Cristina M. Ba?ares', 'Mother', '09059349519', '65040'),
(83, 'Calderon', 'Eldie', 'Eldie', 'Calderon, Eldie', 'Cruz', 'B', '1', 'FT3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '12/9/1994', 'STI Academic Center', 'BSIT', '09950479971', 'gmeldie38@gmail.com', 'Federico M. Calderon, Jr.', 'Father', '09255556025', '65038'),
(84, 'Capisan', 'Joshua', 'Joshua', 'Capisan, Joshua', 'Balaba', 'B', '1', 'FT3', 'Dangcagan', 'Bukidnon', '10', 'PHL', '8/20/1996', 'Don Carlos Polytechnic College', 'BSE- English', '09367243287', 'capisanjoshua422@gmail.com', 'Antonio Capisan', 'Father', '09363992957', '65004'),
(85, 'Colminas', 'Michael', 'Michael', 'Colminas, Michael', 'Mascariola', 'B', '1', 'FT3', 'Cebu City', 'Cebu', '7', 'PHL', '9/2/1995', 'University of Cebu- Main', 'BSBA- Marketing Management', '09388809305', 'ue.michael_colminas95@yahoo.com', 'Elma M. Colminas', 'Mother', '09750031094', '65005'),
(86, 'Diano', 'Raciano', 'Raciano', 'Diano, Raciano', 'Aleonar', 'B', '1', 'FT3', 'Malimono', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '5/22/1995', 'Surigao State College of Technology', 'BSIT', '09501890583', 'dianoraciano@yahoo.com', 'Diascora A. Diano', 'Mother', '09072313739', '65006'),
(87, 'Ende', 'Alvin', 'Alvin', 'Ende, Alvin', 'Repuesta', 'B', '1', 'FT3', 'Quezon', 'Bukidnon', '10', 'PHL', '2/15/1995', 'University of San Carlos', 'BSBA- Financial Management', '', '', '', '', '', '65007'),
(88, 'Espejo', 'Loueji', 'Loueji', 'Espejo, Loueji', 'Casas', 'B', '1', 'FT3', 'San Fernando', 'Bukidnon', '10', 'PHL', '11/1/1997', 'Irene B. Antonio College of Mindanao', 'Bachelor of Elementary Education', '09494110513/ 09367560062', 'louejiespejo23@yahoo.com', 'Jeryl A. Inot', 'Sister ', '09998995335', '65008'),
(89, 'Gaddon', 'Wilser', 'Wilser', 'Gaddon, Wilser', '', 'B', '1', 'FT3', 'Banaue', 'Ifugao', '2', 'PHL', '1/21/1999', 'Saint Louis University', 'BS in Electrical Engineering', '09306941428', 'gaddon.wilser@gmail.com', 'Susan Dulnuan Gaddon', 'Mother', '094948431969', '65009'),
(90, 'Godornes', 'Jesuie', 'Jesuie', 'Godornes, Jesuie', '', 'B', '1', 'FT3', 'Naga', 'Cebu', '7', 'PHL', '10/12/1992', 'Professional Academy of the Philippines', 'BSED- English', '09262136958', 'dalethp.ceronel@yahoo.com', 'Eugeneme B. Coronel', 'Spiritual Father', '09179348242', '65010'),
(91, 'Hermoso', 'Marlon', 'Marlon', 'Hermoso, Marlon', 'Gomez', 'B', '1', 'FT3', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '1/23/1994', 'Cebu Technological University', 'BSIT major in Electronic Tech', '', 'MarLonhermoso@yahoo.com', 'Erlene Hermoso', 'Mother', '09430727102', '65011'),
(92, 'Ipapo', 'Paul Jonadabson', 'Paul', 'Ipapo, Paul', 'Yu', 'B', '1', 'FT3', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '12/30/1993', 'Bulacan State University', 'BS Mechatronics Engineering', '09214105037', 'ipapo.paul@yahoo.com', 'Lucy Yu Ipapo', 'Mother', '09228263807', '65012'),
(93, 'Jungao', 'John', 'John', 'Jungao, John', 'Zerua', 'B', '1', 'FT3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '6/19/1996', 'Mindanao State University - Iligan Institute of Technology', 'AB- Sociology', '09164567627', 'jdmjungao@gmail.com', 'Myla Z. Jungao', 'Mother', '09177740248', '65013'),
(94, 'Justimbaste', 'Reynald Jade', 'Kim', 'Justimbaste, Kim', '', 'B', '1', 'FT3', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '11/26/1986', 'The National Teachers College', 'BSE- Mathematics', '', 'Septerkim@yahoo.com', 'Malou Ah', 'Serving One', '5618140', '65035'),
(95, 'Liwag', 'John Victor', 'John Victor', 'Liwag, John Victor', '', 'B', '1', 'FT3', 'Lucena City', 'Quezon Province', '4A', 'PHL', '2/20/1997', 'Manuel S. Enverga University Foundation', 'BS Electronics Engineering', '09476005703', 'jva_liwag95@rocketmail.com', 'Ma.Venus T. Liwag', 'Mother', '09425984132', '65034'),
(96, 'Macanas', 'Leoniel', 'Leoniel', 'Macanas, Leoniel', 'Bancepra', 'B', '1', 'FT3', 'Mariveles', 'Bataan', '3', 'PHL', '5/1/1994', 'Polytechnic University of the Philippines', 'BS Accountancy', '09773659946', 'leonielmacanas@gmail.com', 'Lielanie Macanas', 'Mother', '09773659946', '65036'),
(97, 'Mahawan', 'Glenn', 'Glenn', 'Mahawan, Glenn', 'Tayone', 'B', '1', 'FT3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/30/1996', 'Western Mindanao State University- ESU Molave', 'Bachelor of Elementary Education', '09483884233/09074466708', 'mahawanglenn@gmail.com', 'Ruth T. Mahawan', 'Mother', '09483884233', '65014'),
(98, 'Mapute', 'Edgardo', 'Edgardo', 'Mapute, Edgardo', 'Flores', 'B', '1', 'FT3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '4/13/1995', 'Western Mindanao State Univeristy', 'BSED- Social Studies', '09487808348', '', 'Rebecca F. Mapute', 'Mother', '09995439413', '65015'),
(99, 'Mascariola', 'Richmark', 'Richmark', 'Mascariola, Richmark', 'Apalit', 'B', '1', 'FT3', 'Cebu City', 'Cebu', '7', 'PHL', '2/19/1996', 'University of Cebu', 'BSBA- Marketing Management', '2725055/09393577264', 'richmark14@icloud.com', 'Roel M. Mascariola', 'Father', '09285004808', '65017'),
(100, 'Mateo', 'Saturnino Jr.', 'Saturnino Jr.', 'Mateo, Saturnino Jr.', 'Mano', 'B', '1', 'FT3', 'Cauayan', 'Isabela', '2', 'PHL', '11/22/1997', 'Isabela State University', 'Bachelor of Secondary Education', '09555815001', 'JP9575781@gmail.com', 'Gabriel Mateo Saturnino, Sr.', 'Guardian', '09975635184', '65018'),
(101, 'Mator', 'El-Mcintosh Sr.', 'Enoch', 'Mator, Enoch', '', 'B', '1', 'FT3', 'Dasmari', 'Cavite', '4A', 'PHL', '5/1/1986', '', '', '', '', '', '', '', '65019'),
(102, 'Monasterio', 'Jomar', 'Jomar', 'Monasterio, Jomar', 'Monasterio', 'B', '1', 'FT3', 'General Santos City', 'South Cotabato', '12', 'PHL', '5/22/1996', 'Ramon Magsaysay Memorial Colleges', 'BSED- English', '', 'jomarmonasterio@yahoo.com', 'Rosaline Monasterio', 'Mother', '09075425891', '65016'),
(103, 'Palacio', 'Junie', 'Junie', 'Palacio, Junie', 'Landeza', 'B', '1', 'FT3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '9/20/1995', 'Western Mindanao State University- External Studies Unit', 'BEED', '09301444571/09187275833', '', 'Orpha Jhaelle B. Palacio', 'Wife', '09301444571', '65020'),
(104, 'Palma', 'Ken Charles', 'Ken', 'Palma, Ken', 'Lintao', 'B', '1', 'FT3', 'Butuan City', 'Agusan Del Norte', '13 (CARAGA)', 'PHL', '6/7/1997', 'AMA Computer Learning Center College of Butuan', 'BS Information Technology', '09465768345', 'kencharlesp74@gmail.com', 'Jessie L. Palma', 'Mother', '09125360729', '65021'),
(105, 'Quije', 'Pablo Jr.', 'Pablo Jr.', 'Quije, Pablo Jr.', '', 'B', '1', 'FT3', 'Molave', 'Zamboanga del Sur', '9', 'PHL', '12/5/1990', '', 'Computer Science', '', '', '', '', '', '65039'),
(106, 'Ranolo', 'John Bonilou', 'Bon', 'Ranolo, Bon', 'Necesario', 'B', '1', 'FT3', 'Zamboanga City', 'Zambonga Del Sur', '9', 'PHL', '3/31/1997', 'Western Mindanao State', 'BS Psychology', '09066630720', 'bonilou31@gmail.com', 'Lolita M. Ranolo', 'Mother', '09050236599', '65023'),
(107, 'Ruta', 'Jeremy Victor', 'Jeremy', 'Ruta, Jeremy', '', 'B', '1', 'FT3', 'Polomolok', 'South Cotabato', '12', 'PHL', '2/18/1991', 'Philippine State College of Aeronautics', 'BS- AMT', '09955322566', '', 'Victoria Ruta', 'Mother', '094638471727', '65024'),
(108, 'Shi', 'Jianxiong', 'Renew', 'Shi, Renew', '', 'B', '1', 'FT3', 'Dalian', 'LiaoNing', 'China', 'CHINA', '1/11/1989', 'The Science and Technology of Hunan University', 'Bachelor of Engineering', '+8613261679531', 'timebear@gmail.com', 'Fan Juan', 'Mother', '+8615524731503', '65025'),
(109, 'Sususco', 'Jemuel', 'Jemuel', 'Sususco, Jemuel', 'Saladaga', 'B', '1', 'FT3', 'Antipolo City', 'Rizal', '4A', 'PHL', '8/29/1994', 'ICCT Colleges Foundations, Inc.', 'BS Information Technology', '09070479521', 'sususcojemuel29@gmail.com', 'Jubilie S. Perocho', 'Sister', '09176374100', '65026'),
(110, 'Tano', 'Mark Witness', 'Mark', 'Tano, Mark', 'Balagbis', 'B', '1', 'FT3', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '10/29/1995', 'University of San Jose Recoletos', 'BS Civil Engineering', '09771414531/3849315', 'markwitness@gmail.com', 'Rebecca B. Tano', 'Mother', '09236229213', '65027'),
(111, 'Tiu', 'John', 'John', 'Tiu, John', 'Ong', 'B', '1', 'FT3', 'Cebu City', 'Cebu', '7', 'PHL', '6/26/1996', 'University of San Carlos', 'BS HRM', '09955689172', 'johntiu2016@gmail.com', 'Alan Tiu', 'Father', '09176220917', '65028'),
(112, 'Tual', 'Ben Robert', 'Ben', 'Tual, Ben', 'Calimpong', 'B', '1', 'FT3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '6/12/1995', 'Misamis University', 'BEED', '09099649135', '', 'Elsie Tual', 'Mother', '09099649135', '65029'),
(113, 'Tumimbang', 'Ian', 'Ian', 'Tumimbang, Ian', '', 'B', '1', 'FT3', 'San Fernando', 'Bukidnon', '10', 'PHL', '3/18/1995', 'Bukidnon State University', 'Bachelor of Elementary Education', '', '', 'Lucio Millan', 'Co-worker', '09061985248', '65037'),
(114, 'Yaw', 'James Yves', 'Yves', 'Yaw, Yves', 'Gonia', 'B', '1', 'FT3', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '10/10/1994', 'STI College of Caloocan', 'BSBM- Operations Management', '09164389795', 'jmsyvsw@gmail.com', 'Alma G. Yaw', 'Mother', '09333031509', '65030'),
(115, 'Acedera', 'Monsour', 'Monsour', 'Acedera, Monsour', 'Reynaldo', 'B', '1', 'FT4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/24/1997', 'CMPI', 'BSIT', '09294081484', '', 'Meen Jameeel Ul-Haq', 'Brother', '09215866340', '64001'),
(116, 'Almendras', 'Benedict John', 'Benedict', 'Almendras, Benedict', 'Orosio', 'B', '1', 'FT4', 'Dasmari', 'Cavite', '4A', 'PHL', '8/21/1995', 'Cavite State University - Main Campus', 'Bachelor of Agricultural Entrepreneurship', '09057829237', 'almendrasbenjo@gmail.com', 'Bernard Q. Almendras', 'Father', '09395127297', '64002'),
(117, 'Ara', 'Paul James', 'Paul James', 'Ara?as, Paul James', 'Gabisay', 'B', '1', 'FT4', 'Danao City', 'Cebu', '7', 'PHL', '5/15/1997', 'University of Cebu - Lapu-Lapu and Mandaue', 'Business Administration - Marketing Management', '09294950668', 'pauljamees21@gmail.com', 'Hanane Ara', 'Mother', '9506990292', '64004'),
(118, 'Arbutante', 'Jasper Jess', 'Jasper Jess', 'Arbutante, Jasper Jess', 'Ramil', 'B', '1', 'FT4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '2/12/1994', 'Bohol Island State University', 'Architecture', '09303968595', 'theredkim@gmail.com', 'Jessie Arbutante', 'Father', '9088933905', '64005'),
(119, 'Armonio', 'Sherwin Cris', 'Sherwin', 'Armonio, Sherwin', 'Dela Cruz', 'B', '1', 'FT4', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '10/9/1995', 'Navotas Polytechnic College', 'BSBA Major in Marketing', '', 'sherwincris.09@gmail.com', 'Aracell Calanog', 'Sister in the Lord', '9228168207', '64006'),
(120, 'Avenda', 'Stephen Mian Daniel', 'Mian', 'Avenda?o, Mian', 'Manliquez', 'B', '1', 'FT4', 'Malolos City', 'Bulacan', '3', 'PHL', '9/7/1996', 'Bulacan State University', 'BS in Mechatronics Engineering', '09292904240', 'mianavendano@gmail.com', 'Jesus Michael P. Avenda', 'Father', '09238993341', '64007'),
(121, 'Baloran', 'Joseph', 'Joseph', 'Baloran, Joseph', 'Bartiana', 'B', '1', 'FT4', 'Kalawit ', 'Zamboanga Del Norte', '9', 'PHL', '8/26/1996', 'Sibugay Technical Institute Inc.', 'Bachelor of Technical Teacher Education', '09355109520', 'josephj4@gmail.com', 'Ipilan Baloran', 'Parent', '9262671950', '64008'),
(122, 'Balucan', 'Jonhrielbert', 'Jonhrielbert', 'Balucan, Jonhrielbert', 'Coronel', 'B', '1', 'FT4', 'Amadeo', 'Cavite', '4A', 'PHL', '11/9/1996', 'Cavite State University', 'BS Applied Mathematics', '09059574357', 'rielbert009@gmail.com', 'Ricky L. Balucan', 'Father', '09364230973', '64009'),
(123, 'Balucan', 'Jovirimbert', 'Jovirimbert', 'Balucan, Jovirimbert', 'Coronel', 'B', '1', 'FT4', 'Amadeo', 'Cavite', '4A', 'PHL', '8/14/1992', 'Cavite State University', 'BS Industrial Engineering', '09758365697', 'jovirimbertbalucan@gmail.com', 'Ricky L. Balucan', 'Father', '09364230973', '64010'),
(124, 'Bensola', 'Junrey', 'Junrey', 'Bensola, Junrey', 'Turtuga', 'B', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '12/28/1992', 'Cebu Technological University', 'BSIT - MST', '09495547701', 'junreybensula@gmail.com', 'Jeremiah Aba-a', 'Brother in Christ', '09097159072', '64011'),
(125, 'Bensula', 'Christopher', 'Christopher', 'Bensula, Christopher', 'Lastimosa', 'B', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '5/24/1993', 'Cebu Technological University', 'BSIT- RAC', '09173896295', 'christoffbenz@gmail.com', 'Jeremiah Aba-a', 'Brother in Christ', '09097159072', '64012'),
(126, 'Bensula', 'Edlerson', 'Edlerson', 'Bensula, Edlerson', 'Lastimosa', 'B', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '12/19/1989', 'Cebu Technological University', 'BSIT - MST', '09368063035', '', 'Lydia Obligado', 'Sister in Christ', '09232882826', '64013'),
(127, 'Buenaflor', 'Mark Rigor', 'Mark Rigor', 'Buenaflor, Mark Rigor', 'Alejandro', 'B', '1', 'FT4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/21/1997', 'City of Malabon University', 'BS Management Accounting', '09557610548', 'markbuenaflor05@gmail.com', 'Gertrudes Buenaflor', 'Mother', '09555099064', '64014'),
(128, 'Cai', 'Jan Zandro', 'Jan Zandro', 'Cai?a, Jan Zandro', 'Tee', 'B', '1', 'FT4', 'Baras', 'Rizal', '4A', 'PHL', '2/21/1995', 'Manila Central University', 'Doctor of Optometry', '09269980515', 'janzandrocaina@ymail.com', 'Alejandro A. Cai', 'Father', '09172440804', '64015'),
(129, 'Casta?ares', 'Solomon Jr.', 'Solomon', 'Casta?ares, Solomon', 'Lanoi', 'B', 'Inactive', 'FT4', 'Maasim', 'Sarangani', '12', 'PHL', '10/8/1994', 'Ramon Magsaysay Memorial Colleges', 'Civil Engineering', '09207253602', 'solomoncastanares@gmail.com', 'Anette L. Casta?ares', 'Mother', '09074217645', '64016'),
(130, 'Clavite', 'Elwin', 'Elwin', 'Clavite, Elwin', 'Sepriveda', 'B', '1', 'FT4', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '10/1/1997', 'PHINMA - Cagayan de Oro College', 'BSIT - Multimedia', '09554197407', 'claviteelvin@gmail.com', 'Maria Clavite', 'Mother', '09161276920', '64018'),
(131, 'De La Fuente', 'Jasper', 'Jasper', 'De La Fuente, Jasper', 'Lee', 'B', '1', 'FT4', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '7/14/1997', 'Cagayan State University', 'BS Computer Engineering', '09063600850', 'jasperdelafuente@yahoo.com', 'Evelyn L. De La Fuente', 'Mother', '09175958566', '64020'),
(132, 'Dini-ay', 'David Neil', 'David Neil', 'Dini-ay, David Neil', 'Valdehueza', 'B', '1', 'FT4', 'Dapitan City', 'Zamboanga del Norte', '9', 'PHL', '3/22/1996', 'Jose Rizal Memorial State University', 'Hotel and Restaurant Management', '', '', 'Nilo Dini-ay', 'Father', '09502216739', '64022'),
(133, 'Elayan', 'Joycer', 'Joycer', 'Elayan, Joycer', 'Madale', 'B', '1', 'FT4', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '8/2/1995', 'University of Science and Technology of SP', 'BS Environmental ST', '09058022006', 'elayan888@gmail.com', 'Reuel Pallugna', 'Church Elder', '09069342816', '64023'),
(134, 'Endino', 'Jemer', 'Jemer', 'Endino, Jemer', 'Apatan', 'B', '1', 'FT4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '9/29/1992', 'Zamboanga City State Polytechnic College', 'BSED Mathematics', '09365849537', '', 'Jason Insang', 'Boardmate', '09777980346', '64024'),
(135, 'Garcia', 'Jesus II', 'Jesus II', 'Garcia, Jesus II', 'Bitas', 'B', '1', 'FT4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '3/19/1993', 'Surigao State College of Technology', 'Bachelor in Architectural Enginr'' Tech', '09079648957', '', 'Nelba Garcia', 'Mother', '09652253754', '64025'),
(136, 'Hidalgo', 'John Bert', 'John Bert', 'Hidalgo, John Bert', 'Pelangco', 'B', '1', 'FT4', 'Imelda', 'Zamboanga Sibugay', '9', 'PHL', '2/26/1996', 'Western Mindanao State University - Imelda ESU', 'Bachelor of Arts in Political Science', '09365463817', '', 'Mary Jane Josol', 'Guardian', '09268202719', '64026'),
(137, 'Huang', 'Huarong', 'Antipas', 'Huang, Antipas', '', 'B', '1', 'FT4', 'Quanzhou', 'Fujian', 'China', 'CHINA', '1/9/1990', 'Huazhong Agricultural University', 'Feeding of Special Economic Animals', '86-13808502052', '', 'Huang Qinghai', 'Father', '86-13808502052', '660086'),
(138, 'Ignacio', 'Jophet', 'Jophet', 'Ignacio, Jophet', 'Maghanoy', 'B', '1', 'FT4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '8/18/1993', 'Western Mindanao State University', 'BS Social Work', '09382126806', 'japhetignacio@yahoo.com', 'Anita Ignacio', 'Mother', '09102823057', '64027'),
(139, 'Ihekweme', 'Benjamin ', 'Benjamin', 'Ihekweme, Benjamin', 'Nwokezuike', 'B', '1', 'FT4', 'Ojo', 'Lagos', 'Lagos', 'NIGERIA', '5/12/1967', '', '#N/A', '', '', '', '', '', '536'),
(140, 'Imperio', 'Owen Bradford', 'Owen', 'Imperio, Owen', 'Notarte', 'B', '1', 'FT4', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '7/18/1998', 'Colegio de San Juan de Letran', 'Marketing Management', '09054899395', 'owenimperio23@gmail.com', 'Edgar Imperio', 'Father', '09175167818', '64028'),
(141, 'Lagare', 'Ephraim Jr.', 'Ephraim Jr.', 'Lagare, Ephraim Jr.', 'Bitas', 'B', '1', 'FT4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '8/1/1993', 'Surigao State College of Technology', 'BA English Language and Literature', '09278247590', 'zeragal@ymail.com', 'Ephraim Lagare Sr. ', 'Father', '09176777617', '64029'),
(142, 'Maghuyop', 'Melvin', 'Melvin', 'Maghuyop, Melvin', 'Ontolan', 'B', '1', 'FT4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '1/9/1997', 'Western Mindanao State University', 'BS Social Work', '09465529763', 'melvinmaghuyop@yahoo.com', 'Misraim Maghuyop', 'Mother', '09090505397', '64031'),
(143, 'Mirafuentes', 'Lloyd', 'Lloyd', 'Mirafuentes, Lloyd', 'Reambonanza', 'B', '1', 'FT4', 'Manukan', 'Zamboanga Del Norte', '9', 'PHL', '9/30/1992', 'Saint Eslanislao Kostka College', 'BSBA - Marketing Management', '09500974603', 'mirafuenteslloyd@yahoo.com', 'Alberto Mirafuentes', 'Father', '09212650889', '64032'),
(144, 'Momo', 'Ronard', 'Ronard', 'Momo, Ronard', 'Balabag', 'B', '1', 'FT4', 'Quezon', 'Bukidnon', '10', 'PHL', '5/5/1995', 'Bukidnon State University', 'Community Development', '', '', 'Gelbert Balabag', 'Uncle', '09357720180', '64033'),
(145, 'Mondaya', 'Julius', 'Julius', 'Mondaya, Julius', 'Auguis', 'B', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '2/26/1991', 'Cebu Technological University', 'BSIT - Mechanical', '09254438941', 'Juliusmondaya@yahoo.com', 'Jeremiah Aba-a', 'Spiritual Father', '09097159072', '64034'),
(146, 'Nini', 'Rich Jasper', 'Rich Jasper', 'Nini, Rich Jasper', 'Fernandez', 'B', '1', 'FT4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '12/28/1997', 'Quezon City Polytechnic University', 'Industrial Engineering', '09555432305', 'richjaspernini1997@gmail.com', 'Richard Nini', 'Father', '09438296394', '64035'),
(147, 'Perocho', 'Kemwel', 'Kemwel', 'Perocho, Kemwel', 'Am-is', 'B', '1', 'FT4', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '1/27/1996', 'Western Mindanao State University - ESU', 'BS Scoial Work', '09075588863', '', 'Jesie Fernan', '', '09209682114', '64038'),
(148, 'Quilar', 'Chrizolite', 'Chrizolite', 'Quilar, Chrizolite', 'Bongales', 'B', '1', 'FT4', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '5/27/1997', 'JH Cerilles State College', 'BSIT', '09462635331', '', 'Juvelyn Dela Cruz', 'Sister', '09103677666', '64039'),
(149, 'Rama', 'Jesmar', 'Jesmar', 'Rama, Jesmar', 'Dagaang', 'B', '1', 'FT4', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '12/25/1994', 'JH Cerilles State College', 'BS Animal Science', '09105258445', '', 'Kim Lodia', 'Elder', '09076199749', '64040'),
(150, 'Rarugal', 'Renato Jr.', 'Renato', 'Rarugal, Renato', 'Langora', 'B', '1', 'FT4', 'Navotas', 'Metro Manila', 'NCR', 'PHL', '8/26/1997', 'Navotas Polytechnic College', 'Bachelor of Elementary Education', '09955715354', 'brotherrenato40@gmail.com', 'Araceli Cruz Canalog', 'Sister in Mtg. Hall', '09228168207', '64041'),
(151, 'Redoble', 'Rey Jemes', 'Rey Jemes', 'Redoble, Rey Jemes', 'Millan', 'B', '1', 'FT4', 'Quezon', 'Bukidnon', '10', 'PHL', '10/19/1996', 'Central Mindanao University', 'BS Agriculture', '09974957716', 'reyjemes.redoble@gmail.com', '', '', '', '64042'),
(152, 'Robledo', 'Micho', 'Micho', 'Robledo, Micho', 'Araman', 'B', '1', 'FT4', 'Tawi-Tawi', 'Tawi-Tawi', 'ARMM', 'PHL', '11/23/1995', 'MSU - Tawi-Tawi College of Technology and Oceanography', 'BS - Information Technoloy', '09461440950', 'mikean2araman@gmail.com', 'Michael Robledo', 'Father', '09482645720', '64043'),
(153, 'Royo', 'Clyde', 'Clyde', 'Royo, Clyde', 'Malig-on', 'B', '1', 'FT4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/9/1996', 'Polytechnic University of the Philippines', 'BSEE', '09217764385', 'clyde_royo@ymail.com', 'Diego Royo', 'Father', '09335451749', '64044'),
(154, 'Sabiano', 'Romel', 'Romel', 'Sabiano, Romel', 'Arias', 'B', '1', 'FT4', 'Roxas', 'Palawan', '4B', 'PHL', '8/23/1993', 'Palawan State University', 'BS Agriculture', '09353620903', 'romelsabiano@gmail.com', '', '', '', '64045'),
(155, 'Sajonia', 'Rembrandt', 'Rembrandt', 'Sajonia, Rembrandt', 'Calingacion', 'B', '1', 'FT4', 'Tarlac City', 'Tarlac', '3', 'PHL', '4/10/1995', 'Misamis University Oroquieta City', 'Bachelor of Elementary Education', '09107185130', 'rembrandt_sajonia@gmail.com', '', '', '', '64046'),
(156, 'Sotero', 'Fernando Jr.', 'Fernando Jr.', 'Sotero, Fernando Jr.', '', 'B', '1', 'FT4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '1/16/1993', 'Dr. Aurelio Mendoza Memorial Colleges', 'BEED', '', '', '', '', '', '130'),
(157, 'Tabudlo', 'Marven Roy', 'Marven Roy', 'Tabudlo, Marven Roy', 'Abaquita', 'B', '1', 'FT4', 'Cotabato City', 'Maguindanao', '12', 'PHL', '12/28/1993', 'Sharriff Kabunsuan College Inc.', 'BSEd Major in English', '09465611079', 'marvenroy06@gmail.com', 'Magdalena A. Tabudlo', 'Mother', '09269589236', '64047'),
(158, 'Tual', 'Julito', 'Julito', 'Tual, Julito', 'Lomandog', 'B', '1', 'FT4', 'Cainta', 'Rizal', '4A', 'PHL', '11/26/1992', 'Westen Mindanao State University', 'Social Studies', '09552540180', 'julito_tual@yahoo.com', 'Eliezer Manliguez', '', '09509325038', '64048'),
(159, 'Vergara', 'Dominador', 'Dominador', 'Vergara, Dominador', 'Maghanoy', 'B', '1', 'FT4', 'Tabina', 'Zamboanga Del Sur', '9', 'PHL', '8/8/1993', 'JH Cerilles State College Tabina Campus', 'BSED English', '09469748526', '', 'Arnel Omas', 'Elder', '09463275608', '64049'),
(160, 'Villarubia', 'Khem', 'Khem', 'Villarubia, Khem', 'Ladrillo', 'B', '1', 'FT4', 'Don Carlos', 'Bukidnon', '10', 'PHL', '4/29/1995', 'Don Carlos Polytechnic College', 'BSIT', '09979904609', 'KHEMVILLARUBIA@gmail.com', 'Lucio Millan', '', '09061985248', '64050'),
(161, 'Wang', 'Chunjian', 'Joseph', 'Wang, Joseph', '', 'B', '1', 'FT4', 'Ningbo', 'Zhejiang', 'China', 'CHINA', '4/5/1996', 'Wuhan University of Science and Technology', 'Materials Processing and Controlling Engineering', '18667838107', 'josephwang31@163.com', 'Wang Weiping', 'Father', '15558271627', '64051'),
(162, 'Zonio', 'Gedione', 'Gedione', 'Zonio, Gedione', 'Zambrona', 'B', '1', 'FT4', 'Libacao City', 'Aklan', '6', 'PHL', '12/30/1992', 'Libacao College of Science and Technology', 'BS HRM', '09071986734', '', 'Giddy Zonio', 'Father', '09300906119', '64055'),
(163, 'Asuncion', 'John Oliver', 'Oliver', 'Asuncion, Oliver', 'Salvador', 'B', '1', 'FT1', 'San Juan', 'Ilocos Sur', 'I', 'PHL', '10/25/1997', 'polytechnic university of philippines-bataan', 'bsed-english', '9363546529', '', 'manuel jesus esteban', 'Father', '09302701304', '670001'),
(164, 'Balingitao', 'Peniel', 'Peniel', 'Balingitao, Peniel', 'Nemenzo', 'B', '1', 'FT1', 'Tigbao', 'Zamboanga Del Sur', 'IX', 'PHL', '8/20/1994', 'josecina herira', 'bs-forestry', '09300444207', '', 'm&f', 'parents', '09300444707', '670002'),
(165, 'Bonghanoy', 'Ree Pehjzee', 'Ree', 'Bonghanoy, Ree', 'Bugot', 'B', '1', 'FT1', 'Molave', 'Zamboanga Del Sur', 'IX', 'PHL', '12/4/1994', '', 'bs-marine engineering', '9197578955', '', 'pablitab.bonghanoy', 'mother', '09075249990', '670003'),
(166, 'Bulgar', 'Ronnel', 'Ronnel', 'Bulgar, Ronnel', 'Bonaobra', 'B', '1', 'FT1', 'Legazpi City', 'Albay', 'V', 'PHL', '10/18/1997', 'bicol university', 'bs-mechanical engineering', '9162126061', 'ronnelbulgar123@gmail.com', 'Nelia b.bulgar', 'mother', '09173330500', '670004'),
(167, 'Cabaddu', 'Ryan Rey', 'Ryan', 'Cabaddu, Ryan', 'De Vera', 'B', '1', 'FT1', 'Tuguegarao', 'Cagayan', 'II', 'PHL', '11/9/1994', 'saint paul university philippines', 'bs-accountancy', '9654971849', '', 'reynaldo a.cabaddu', 'father', '09451903163/309-4582', '670005'),
(168, 'Calubag ', 'John Maynard', 'Maynard', 'Calubag , Maynard', 'Baclayo', 'B', '1', 'FT1', 'Aloran', ' Misamis Occidental', 'X', 'PHL', '10/31/1992', 'misamis university ozamis city', 'bs-civil engineering', '9103018304', 'johnmaynardc@yahoo.com', 'vernie l.calubag', 'father', '09124328104', '670006'),
(169, 'Candawan', 'Renz', 'Renz', 'Candawan, Renz', 'Baco', 'B', '1', 'FT1', 'Tagum', 'Davao Del Norte', 'XI', 'PHL', '4/15/1998', 'western mindanao state university', 'bsed-social studies', '9502211695', 'candawanrenz2gmail.com', 'loida candawan', 'mother', '09976131112/09644201284', '670007'),
(170, 'Cano', 'Gabriel', 'Gabriel', 'Cano, Gabriel', 'Udtujan', 'B', '1', 'FT1', 'Cainta ', 'Rizal', 'IV-A', 'PHL', '4/28/1995', 'technological institute of the philippines-qc', 'bs-civil engineering', '9778459434', 'gabbyriel00@gmail.com', 'veronica u cano', 'mother', '09175147739', '670008'),
(171, 'Castueras', 'Stephen Rhoy', 'Stephen', 'Castueras, Stephen', 'Dabu', 'B', '1', 'FT1', 'San Mateo', 'Rizal', 'IV-A', 'PHL', '7/7/1991', 'eulogio''''amag'''' roergnez institute of science&tech', 'bsit-electronics tech', '9475990703', 'seven.castueras@gmail.com', '', '', '', '670009'),
(172, 'Cellona', 'Ebenezer', 'Ebenezer', 'Cellona, Ebenezer', 'Vargas', 'B', '1', 'FT1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '4/27/1996', 'centro escolar university', 'bs-accountancy', '9959324974', 'CELLONA.BENZ@GMAIL.COM', 'elena v.cellona', 'mother', '09212091712', '670010'),
(173, 'De Guzman', 'Jhester', 'Jhester', 'De Guzman, Jhester', 'Barlaam', 'B', '1', 'FT1', 'Malolos City', 'Bulacan', 'III', 'PHL', '9/19/1996', 'bulacan state university', 'BS-Industrial Tech major in Mechatonics', '', '', '', '', '', '670044'),
(174, 'Dela Cruz', 'Leynar Nick', 'Nick', 'Dela Cruz, Nick', 'Duque', 'B', '1', 'FT1', 'San Jose', 'Occidental Mindoro', '4B', 'PHL', '5/4/1992', 'occidental mindanao state college', 'bs-information technology', '09095432955', 'delacruznico505@gmail.com', 'arthur dela cruz', 'father', '09480081917', '670011'),
(175, 'Dela Fuente', 'Jeffrey', 'Jeffrey', 'Dela Fuente, Jeffrey', 'Del Mundo', 'B', '1', 'FT1', 'Tuguegarao', 'Cagayan', 'II', 'PHL', '9/21/1997', 'cagayan state university', 'bs-civil engineering', '09973949044\\09668025003', 'jeffreydelafuente30@gmail.com', 'alfredo jose s.dela fuente', 'father', '09175192991', '670012'),
(176, 'Dela Pe', 'Ranel', 'Ranel', 'Dela Pe?a, Ranel', 'Entero', 'B', '1', 'FT1', 'Sergio Osme', 'Zamboanga Del Norte', 'IX', 'PHL', '6/16/1995', 'andres bonifacio college', 'bs-ed.english', '9121799944', 'raneldelapenae@gmail.com', 'fedelina e.dela Pe', 'mother', '09466668203', '670013'),
(177, 'Dulia', 'Willy Bert', 'Willy', 'Dulia, Willy', 'Berandal', 'B', '1', 'FT1', 'Talacogon', 'Agusan Del Sur', 'CARAGA', 'PHL', '9/21/1997', 'agusan del sur state college of agriculture&technology', 'BS Agriculture', '9389112393', 'dwillybert@gmail.com', 'Herlina B.Dulia', 'mother', '09465119704', '670014'),
(178, 'Durac', 'Samson', 'Samson', 'Durac, Samson', 'Misoles', 'B', '1', 'FT1', 'Digos City', 'Davao del Sur', 'Xi', 'PHL', '4/19/1989', 'mat3 college of thec', 'bs-criminology', '9272932858', 'samsondurac6@gmail.com', 'jonathan m.durac', 'brother', '09988478607', '670015'),
(179, 'Era', 'Christian ', 'Christian ', 'Era, Christian ', 'Catu', 'B', '1', 'FT1', 'Caloocan', 'Metro Manila', 'NCR', 'PHL', '1/19/1991', 'feu-institute of technology', 'bs-science in IT', '9567502737', 'christianera09@gmail.com', 'rizaldy era', 'father', '09121410853', '670016'),
(180, 'Etcoba', 'Aaron Paul', 'Aaron', 'Etcoba?ez, Aaron', 'Rico', 'B', '1', 'FT1', 'Tacloban City', 'Leyte', 'VIII', 'PHL', '5/18/1998', 'eastern visagas state university', 'bs-marketing', '9773507586', 'aaron.etcoba?ez15@gmail.com', 'ruel r.Etcoba', 'father', '09205093568', '670017');
INSERT INTO `trainee_info_temp` (`trainee_id`, `Last_Name`, `First_Name`, `ID_Name`, `Full_Name`, `Middle_Name`, `Gender`, `Status`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`) VALUES
(181, 'Fabe', 'J-Lorenzo', 'J-Lorenzo', 'Fabe, J-Lorenzo', 'Sabizon', 'B', '1', 'FT1', 'Iligan City', 'Lanao Del Norte', 'X', 'PHL', '10/31/1998', 'mindanao state university', 'be-math', '9068254806', 'jlorenzo.fabe@gmail.com', 'jefferson s.fabe', 'brother', '09464043614', '670018'),
(182, 'Felias', 'Christopher Neil', 'Neil', 'Felias, Neil', 'Conde', 'B', '1', 'FT1', 'Cagayan De Oro City', 'Misamis oriental', 'X', 'PHL', '9/4/1988', 'southern philippine college', 'b-elementry education', '9266456549', 'neilian_08@yahoo.com', 'romeo m.felias', 'father', '09054166967', '670019'),
(183, 'Flores', 'Rolly Mark', 'Rolly Mark', 'Flores, Rolly Mark', 'Baring', 'B', '1', 'FT1', 'Roxas', 'Palawan', 'IV-B', 'PHL', '2/8/1997', 'palawan state university', 'bs-financial management', '9101199667', 'serolfkramy6llor@gmail.com', 'rosalie flores', 'mother', '09967446834', '670020'),
(184, 'Gabonada', 'Neron Keen', 'Neron', 'Gabonada, Neron', 'Reponte', 'B', '1', 'FT1', 'Cagayan De ro City', 'Camiguin', 'X', 'PHL', '4/12/1999', 'camiguin polytechnic state college', 'bs-computer science', '9675784292', 'emkay30@gmail.com', 'edgar Gabonada', 'father', '09263449169', '670021'),
(185, 'Genelerao', 'Junry', 'Junry', 'Genelerao, Junry', 'Florida', 'B', '1', 'FT1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '6/3/1994', 'jhcsc', 'bs-hrm', '9663696929', 'junrygenelerao@yahoo.com', 'maryjane f.genelerao', 'mother', '09127462505/09124951359', '670022'),
(186, 'Gumiran', 'Jemarch', 'Jemarch', 'Gumiran, Jemarch', 'Tejada', 'B', '1', 'FT1', 'Quezon', 'Bukidnon', 'X', 'PHL', '3/22/1993', 'quezon institute of technology', 'b-elementry education', '9754173278', 'gumiran.jemarch@gmail.com', 'john rolan t.gumiran', 'brother', '09264495013', '670023'),
(187, 'Juegos', 'Samuel', 'Samuel', 'Juegos, Samuel', 'Galloniga', 'B', '1', 'FT1', 'Iligan City', 'Lanao Del Norte', 'X', 'PHL', '1/26/1998', 'mindanao state university', 'bs-hrm', '9278768557', 'samuel54@gmail.com', 'marivic g.juegos', 'mother', '09366731472', '670024'),
(188, 'Labastilla', 'Esrah Mannasseh', 'Mannasseh', 'Labastilla, Mannasseh', 'Bugot', 'B', '1', 'FT1', 'Molave', 'Zamboanga Del Sur', 'IX', 'PHL', '2/26/1999', 'western mindanao state university', 'bsed-english', '9661524882', '', 'theresita b.celerinos', 'mother', '09187290366', '670025'),
(189, 'Lagos', 'Richard', 'Richard', 'Lagos, Richard', 'Aquino', 'B', '1', 'FT1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '11/21/1993', 'western mindanao state university', 'bs-social work', '9197499336', '', 'julean/norma lagos', 'parents', '09964459766', '670026'),
(190, 'Lape', 'Lourince', 'Lourince', 'Lape, Lourince', 'Laquio', 'B', '1', 'FT1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/6/1997', 'mindanao state university', 'bs-m', '9657297333', 'lapelourince@gmail.com', 'loremer l.lape', 'brother', '09124343327', '670027'),
(191, 'Limbudan', 'Blend Leo', 'Blend', 'Limbudan, Blend', 'Panay', 'B', '1', 'FT1', 'Malita', 'Davao Occidental', 'XI', 'PHL', '7/9/1997', 'southern philippines agri-business&marine&aguahe technology school', 'bs-marine biology', '09758159186', '', 'jumessa limbudan', 'sibling', '09755985086', '670028'),
(192, 'Malaran', 'Anecito III', 'Anecito III', 'Malaran, Anecito III', 'Manatad', 'B', '1', 'FT1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '6/23/1997', 'western mindanao state university', 'bsed-english', '9076242303', '', 'anecito t.malaran.sr', 'father', '09124472913', '670029'),
(193, 'Mamate', 'Roman', 'Roman', 'Mamate, Roman', 'Lopez', 'B', '1', 'FT1', 'Lakewood', 'Zamboanga Del Sur', '', 'PHL', '6/24/1994', 'jhcsc', 'bsed-english', '9382049925', '', 'parents', 'parents', '09199918971', '670030'),
(194, 'Nericua', 'Daniel', 'Daniel', 'Nericua, Daniel', 'Mira', 'B', '1', 'FT1', 'Aloran', 'Misamis Occidental', 'X', 'PHL', '11/24/1996', 'western mindanao state university', 'bsed-mathematics', '9382184625', '', 'jason m.nericua', 'brother', '09503389005', '670032'),
(195, 'Ordonio', 'Lloyd Mark', 'Lloyd', 'Ordonio, Lloyd', 'Macatiag', 'B', '1', 'FT1', 'Divilacan', 'Isabela', 'II', 'PHL', '10/24/1996', 'north eastern college', 'bs-geodetic engineering', '9365004236', 'lloydordonio24@gmail.com', 'agwido s.macatiag', 'uncle', '09754119836', '670033'),
(196, 'Parungao', 'Joseph Joshua', 'Joseph Joshua', 'Parungao, Joseph Joshua', 'Agocoy', 'B', '1', 'FT1', 'Dasmari', 'Cavite', 'IV-A', 'PHL', '2/6/1998', 'cavite state university', 'bs-civil engineering', '9499336160', 'jparungao@yahoo.com', 'joey a.parungao', 'father', '09975192299', '670034'),
(197, 'Penales', 'Reve John', 'Reve', 'Penales, Reve', 'Contega', 'B', '1', 'FT1', 'Tigbao', 'Zamboanga Del Sur', 'XI', 'PHL', '1/16/1998', 'jhcsc', 'bsed-english', '9301376428', 'dionysus.rjpenales@gmail.com', 'randy penales', 'brother', '09108810830', '670035'),
(198, 'Ramos', 'John Mark', 'John Mark', 'Ramos, John Mark', 'Ellorde', 'B', '1', 'FT1', 'Navotas City', 'Metro Manila', 'NCR', 'PHL', '4/26/1994', 'novatas polytechnic college', 'bsba-marketing', '9668364099', 'jmkrms1994@gmail.com', 'araceli calang', 'deacon/s.o', '09228168207', '670036'),
(199, 'Rico', 'Radel', 'Radel', 'Rico, Radel', 'Sambile', 'B', '1', 'FT1', 'Camiling', 'Tarlac', 'III', 'PHL', '6/19/1991', 'tarlac state unicersity', 'bs-entrepreneurship', '9568895551', '', 'orlando tabilisma ', 'brother in christ', '09050726740', '670037'),
(200, 'San Pedro', 'Brylle', 'Brylle', 'San Pedro, Brylle', 'Talagtag', 'B', '1', 'FT1', 'San Mateo', 'Rizal', 'IV-A', 'PHL', '8/10/1997', 'marikina polytechinic college', 'automotive technology', '9208328812', 'bryllesanpedro@yahoo.com', 'sean tasper castveras', 'shepherd', '09327328158', '670038'),
(201, 'Somblingo', 'Arvin', 'Arvin', 'Somblingo, Arvin', 'Cabatingan', 'B', '1', 'FT1', 'Tupi', 'South Cotabato', 'XII', 'PHL', '1/24/1998', 'seait', 'bsba-marketing', '9197887974', 'somblingoarvin@gmail.com', 'phoebe somblingo', 'mother', '09382745044', '670039'),
(202, 'Sumaong', 'Dan Mark', 'Dan Mark', 'Sumaong, Dan Mark', 'Dela Rosa', 'B', '1', 'FT1', 'Camiling', 'Tarlac', 'III', 'PHL', '4/1/1993', 'tarlac agricultural university', 'beed', '9158734648', '', 'romy tolentino ', 'spiritual father', '09327293933', '670040'),
(203, 'Tambic', 'Rickson', 'Rickson', 'Tambic, Rickson', 'Cato', 'B', '1', 'FT1', 'La Trinidad', 'Benguet', 'CAR ', 'PHL', '11/10/1995', 'benguet state university', 'doctor of veterinary medicine', '9482767832', 'tambicrick@gmail.com', 'linda c.tambic', 'mother', '09128869909', '670041'),
(204, 'Tanque', 'Mark Norven', ' Norven', 'Tanque,  Norven', 'Jimera', 'B', '1', 'FT1', 'Bacolod', 'Negros Occidental', 'VI', 'PHL', '11/4/1995', 'carlos hilado memorial state college', 'bs-accountancy', '9999483356', 'marknorventanque@gmail.com', 'neann may j.tanque', 'sister', '09429505989', '670042'),
(205, 'Templado', 'Klint Breit', 'Klint', 'Templado, Klint', 'Ian', 'B', '1', 'FT1', 'Pagadian', 'Zamboanga Del Sur', 'IX', 'PHL', '4/9/1999', 'pagadian capitol college', 'bs-criminology', '', 'klintpoponos@gmail.com', 'lelibeth m.templado', 'mother', '09308668743', '670043'),
(206, 'Abalde', 'Grace', 'Grace', 'Abalde, Grace', 'Carrillo', 'S', '1', 'FT2', 'Kumalarang', 'Zamboanga Del Sur', '9', 'PHL', '9/18/1996', 'Mindanao State University-Lanao Norte Agricultural College', 'BEED-General Education', '09361786325', '', 'Gerry Calwan Abalde', 'Father', '09557618025', '661001'),
(207, 'Aclao', 'Jee-lou', 'Jee-lou', 'Aclao, Jee-lou', 'Vega', 'S', '1', 'FT2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '5/15/1997', 'Medina College-Ozamisz City', 'BS-Pharmacy', '09300210145', '', 'Luzviminda Aclao', 'Mother', '09053405358', '661002'),
(208, 'Adcoy', 'Jizette', 'Jizette', 'Adcoy, Jizette', 'Guillermo', 'S', '1', 'FT2', 'San Nicolas', 'Ilocos Norte', '1', 'PHL', '5/20/1997', 'Mariano Marcos State University', 'Bachelor of Science in Electrical Engineer', '09127862039', 'jizetteadcoy@gmail.com', 'Jaime Adcoy', 'Father', '09127862039', '661003'),
(209, 'Anani', 'Olivia', 'Olivia', 'Anani, Olivia', '', 'S', '1', 'FT2', 'Wuhan', 'China', 'China', 'CHINA', '11/12/1997', 'Hubei University of Technology', 'Business', '15623339105', 'oliviaanani97@gmail.com', '', '', '', '661004'),
(210, 'Apolinares', 'Leny', 'Leny', 'Apolinares, Leny', 'Baldo', 'S', '1', 'FT2', 'Antiquera', 'Bohol', '7', 'PHL', '9/13/1996', 'Bohol Island State University', 'BS Mechanical Engeneering', '09461143001/09458531620', 'lenyapolinares1@gmail.com', 'Dario P. Apolinares', 'Father', '09508076540/09078253032', '661005'),
(211, 'Arbois', 'Jasper', 'Jasper', 'Arbois, Jasper', 'Tutong', 'S', '1', 'FT2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '11/15/1996', 'Mindanao State University-Iligan Institute of Technology', 'BS Electronics and Communication Engineer', '09106409363', 'jasperarbois15@gmail.com', 'Simfroso Arbois', 'Father', '09092885048', '661006'),
(212, 'Arciosa', 'Marry Claire', 'Marry Claire', 'Arciosa, Marry Claire', 'Facurib', 'S', '1', 'FT2', 'Pasay', 'Metro Manila', 'NCR', 'PHL', '8/16/1996', 'STI College Paranaque', 'BSIT Major in Programming', '', '', '', '', '', '661007'),
(213, 'Baco', 'Raschelle', 'Raschelle', 'Baco, Raschelle', 'Balucan', 'S', '1', 'FT2', 'Midsalip', 'Zamboanga Del Sur', '9', 'PHL', '1/9/1997', 'Josefina Herrera Cerilles State College', 'Bachelor of Science in Elementary Education', '09465358695', 'rachellebaco@gmail.com', 'Ailyn Alvaro', 'Sister', '09469274161', '661008'),
(214, 'Balucan', 'Noraine Joy', 'Noraine Joy', 'Balucan, Noraine Joy', '', 'S', '1', 'FT2', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '12/14/1993', 'Jose Rizal Memorial State University', 'BSHRM', '', '', '', '', '', '661009'),
(215, 'Barcelo', 'Queen Emerald', 'Emerald', 'Barcelo, Emerald', '', 'S', '1', 'FT2', 'Pantabangan', 'Nueva Ecija', '3', 'PHL', '3/31/1993', 'Philippine Merchant Marine School', 'BS in Customs Administration', '', '', '', '', '', '661010'),
(216, 'Bastillada', 'Ninfa', 'Ninfa', 'Bastillada, Ninfa', '', 'S', '1', 'FT2', 'Mandaue City', 'Cebu', '7', 'PHL', '6/1/1994', 'University of Cebu', 'BS Secondary Education-English', '09225455675', 'nininbastillada123@gmail.com', 'Jusue Bastillada', 'Brother', '09169951661', '661011'),
(217, 'Batitang', 'Casey Vi', 'Casey Vi', 'Batitang, Casey Vi', 'Tolentino', 'S', '1', 'FT2', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '10/14/1998', 'Mindanao State University-Iligan Institute of Technology', 'Bachelor of Arts in History', '09121673197', 'batitangcaseyvi@gmail.com', 'Sheila Vi Batitang', 'Sister', '09073069974', '661012'),
(218, 'Bawalan', 'Trixie Grace', 'Trixie', 'Bawalan, Trixie', 'Barco', 'S', '1', 'FT2', 'Silang', 'Cavite', '4A', 'PHL', '12/24/1998', 'Cavite State University', 'BA Journalism', '', '', '', '', '', '661013'),
(219, 'Benolirao', 'Eden', 'Eden', 'Benolirao, Eden', 'Macahibag', 'S', '1', 'FT2', 'Minglanilla', 'Cebu', '7', 'PHL', '12/9/1997', 'University of Cebu', 'BS Management Accounting', '09205794378', 'edenbenolirao09@gmail.com', 'Jeseca M. Benolirao', 'Mother', '09339757096', '661014'),
(220, 'Bermejo', 'Ivy', 'Ivy', 'Bermejo, Ivy', 'Sebanes', 'S', '1', 'FT2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/4/1995', 'University of Rizal System', 'BSE-English', '09294932915', 'ivybermejo.980@gmail.com', 'Raquel Rueles', 'Churchmate', '09062827640', '661015'),
(221, 'Bernal', 'Daniella', 'Daniella', 'Bernal, Daniella', 'Bolla', 'S', '1', 'FT2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '7/11/1998', 'The National Teachers College', 'BSE-English', '', '', '', '', '', '661016'),
(222, 'Buco', 'Evelyn', 'Evelyn', 'Buco, Evelyn', '', 'S', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '8/16/1995', 'Golden Heritage Polytechnic College', 'BS in Office Administration', '', '', '', '', '', '661017'),
(223, 'Cabatingan', 'Angelica', 'Angelica', 'Cabatingan, Angelica', 'Alipao', 'S', '1', 'FT2', 'Remedios Trinidad Romualdez', 'Agusan Del Norte', '10', 'PHL', '11/17/1997', 'Xavier Ateneo De Cagayan University', 'AB International Studies', '09161559687', 'lykacabatingan@gmail.com', 'Bonifacio P. Cabatingan', 'Father', '', '661018'),
(224, 'Calog', 'Shizah', 'Shizah', 'Calog, Shizah', 'Sisi', 'S', '1', 'FT2', 'Plaridel', 'Misamis Occidental', '10', 'PHL', '4/6/1999', 'Foundation University', 'BSBA-Management Accounting', '09095333769', 'calogshizah@gmail.com', 'Russell Calog', 'Mother', '09752278921', '661019'),
(225, 'Camacam', 'Nesalyn Jahze-el', 'Nesalyn Jahze-el', 'Camacam, Nesalyn Jahze-el', 'Iniba', 'S', '1', 'FT2', 'Santiago City', 'Isabela', '2', 'PHL', '11/14/1998', 'University of the Philippines Los Banos', 'BS Biology (Zoology)', '', '', '', '', '', '661020'),
(226, 'Cambangay', 'Mary Queen', 'Mary Queen', 'Cambangay, Mary Queen', 'Ma?amosa', 'S', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '10/23/1997', 'Pilgrim Christian College', 'BEED- Early Childhood Education', '09058483369', 'maryqueenc.patag@gmail.com', 'Uriel Cambangay', 'Father', '09355453642', '661021'),
(227, 'Canapi', 'Ma. Josel', 'Ma. Josel', 'Canapi, Ma. Josel', 'Ludovice', 'S', '1', 'FT2', 'Bi', 'Laguna', '4A', 'PHL', '6/29/1998', 'Cavite State University-Don Severino De Las Alas Campus', 'BS in Development Management', '', '', '', '', '', '661022'),
(228, 'Chen', 'Chen', 'Prisca', 'Chen, Prisca', '', 'S', '1', 'FT2', 'Wen Zhou', 'Zhe Jiang', 'China', 'CHINA', '7/17/1998', 'Zhejiang Industrial and Commercial College of Technology', 'International Trade Affairs', '', '', '', '', '', '661024'),
(229, 'Chen', 'Xinyi', 'Cindy', 'Chen, Cindy', '', 'S', '1', 'FT2', 'Wenzhou', 'Zhe Jiang', 'China', 'CHINA', '8/28/1997', 'Taizhou University ', 'English', '17858667036', '871732157@99.com', 'Shao Zhao Chen ', 'Father', '13587854836', '661025'),
(230, 'Cokee', 'Michelle', 'Michelle', 'Cokee, Michelle', 'Ang', 'S', '1', 'FT2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '5/4/1982', 'Philippine Womens University', 'BSHM-Culminary', '', '', '', '', '', '661026'),
(231, 'Conde', 'Caselyn', 'Caselyn', 'Conde, Caselyn', 'Matawaran', 'S', '1', 'FT2', 'Balanga', 'Bataan', '3', 'PHL', '12/28/1998', 'Bataan Peninsula State University', 'BSBA-Operations Management', '09452441550', 'condecaselyn@yahoo.com', 'Ruth Conde', 'Mother', '09502533515', '661027'),
(232, 'De la Fuente', 'Angelica', 'Angelica', 'De la Fuente, Angelica', '', 'S', '1', 'FT2', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '10/9/1998', 'Cagayan State University (Andrew''s Campus)', 'BS in Enterpreneurship', '', '', '', '', '', '661029'),
(233, 'Degui', 'Rotchelle', 'Rotchelle', 'Degui?on, Rotchelle', 'Dagano', 'S', '1', 'FT2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '1/18/1999', 'Bukidnon State University', 'BA-Social Science', '09363414966', 'deguirotchelle@gmail.com', 'Dennis Pacturan', 'Brother', '', '661028'),
(234, 'Dosdos', 'Mary Jane', 'Mary Jane', 'Dosdos, Mary Jane', 'Palomo', 'S', '1', 'FT2', 'Magsaysay', 'Occidental Mindoro', '4B', 'PHL', '1/23/1999', 'OMSC-Murtha Campus', 'BS Agricultural Education', '', '', '', '', '', '661030'),
(235, 'Du', 'Dylan', 'Dylan', 'Du, Dylan', '', 'S', '1', 'FT2', 'Shanghai', 'China', 'China', 'CHINA', '', '', '', '', '', '', '', '', '661109'),
(236, 'Dumadag', 'Leacel', 'Leacel', 'Dumadag, Leacel', 'Liano', 'S', '1', 'FT2', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '9/30/1996', 'Western Mindanao State University', 'BEED', '09500997398', 'leaceldumadag28@yahoo.com', '', '', '', '661031'),
(237, 'Dumalay', 'Jenesa', 'Jenesa', 'Dumalay, Jenesa', 'Arbois', 'S', '1', 'FT2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '2/11/1998', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Botany)', '', '', '', '', '', '661032'),
(238, 'Dumayas', 'Gladys', 'Gladys', 'Dumayas, Gladys', 'Longaquit', 'S', '1', 'FT2', 'Tigbao', 'Zamboanga Del Sur', '9', 'PHL', '1/16/1997', 'Our Lady of Fatima University-Valenzuela', 'BS in Medical Technology', '09277317091', 'sansandumayas@gmail.com', 'Nelida Dumayas', 'Mother', '09198559669/09175055121', '661033'),
(239, 'Elag', 'Sheryl', 'Sheryl', 'Elag, Sheryl', 'Atap', 'S', '1', 'FT2', 'Jimenez', 'Misamis Occidental', '10', 'PHL', '12/15/1995', 'University of Science and Technology of Southern Philippines', 'BSE-TLE', '', '', '', '', '', '661034'),
(240, 'Entia', 'Lorely', 'Lorely', 'Entia, Lorely', 'Balasabas', 'S', '1', 'FT2', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '7/30/1990', 'Western Mindanao State University', 'Bachelor of Elementary Education', '09061702544', 'I_entia@gmail.com', 'Glorype Ruiles/Shiela Entia', 'Mother', '09354933417/09364139244', '661035'),
(241, 'Esmade', 'Abelyn', 'Abelyn', 'Esmade, Abelyn', 'Letimas', 'S', '1', 'FT2', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '2/18/1999', 'Polytechnic University of the Philippines', 'BA Broadcast Communication', '09295427140', 'abelynesmade@gmail.com', 'Emelyn Esmada', 'Mother', '09153322303', '661036'),
(242, 'Estipona', 'Rosemarie', 'Rosemarie', 'Estipona, Rosemarie', '', 'S', '1', 'FT2', 'Irosin', 'Sorsogon', '5', 'PHL', '5/20/1997', 'Veritas College of Irasin', 'BSBA Financial Management', '09093203855', 'inchrist.rosemarie@gmail.com', 'Adelta Guarte', 'Guardian', '09389529566', '661037'),
(243, 'Garcia', 'Richael', 'Richael', 'Garcia, Richael', 'Amigo', 'S', '1', 'FT2', 'Bogo City', 'Cebu', '7', 'PHL', '7/9/1996', 'Madridesos Community College', 'BSE Major in Filipino', '09121144836', 'garciarichael30@gmail.com', 'Elsa Garcia', 'Mother', '09103441751', '661039'),
(244, 'Gavino', 'Precious Hannah', 'Hannah', 'Gavino, Hannah', 'Batican', 'S', '1', 'FT2', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '9/14/1998', 'University of Caloocan City', 'BS in Accounting Technology', '', '', '', '', '', '661040'),
(245, 'Gealon', 'Shiegella Rae', 'Shiegella Rae', 'Gealon, Shiegella Rae', 'Cuasotor', 'S', '1', 'FT2', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '9/19/1998', 'Siliman University', 'Bachelor of Mass Communication', '', '', '', '', '', '661041'),
(246, 'Giwo', 'Ezeria', 'Ezeria', 'Giwo, Ezeria', '', 'S', '1', 'FT2', 'Tuguegarao City', 'Cagayan', '2', 'PHL', '10/29/1995', 'Cagayan State University', 'BS in Agricultural Engineering', '', '', '', '', '', '661042'),
(247, 'Gonzales', 'Emmanuela', 'Emmanuela', 'Gonzales, Emmanuela', 'Villarin', 'S', '1', 'FT2', 'Dasmari', 'Cavite', '4A', 'PHL', '5/1/1997', 'De La Salle University-Dasmarinas', 'BSE-English', '', '', '', '', '', '661043'),
(248, 'Gutang', 'Cherry Rose', 'Cherry Rose', 'Gutang, Cherry Rose', 'Arroyo', 'S', '1', 'FT2', 'Minglanilla', 'Cebu', '7', 'PHL', '9/9/1998', 'University of San Jose-Recoletos', 'AB International Studies', '09297798354', 'cherrykaye034@gmail.com', 'Lorna Gutang', 'Mother', '09494686309', '661044'),
(249, 'Hernandez', 'Mary Grace', 'Mary Grace', 'Hernandez, Mary Grace', 'Macasinag', 'S', '1', 'FT2', 'Canaman', 'Camarines Sur', '5', 'PHL', '12/22/1992', 'Bicol State College of Applied Sciences and Technology', 'BS Elementary Education', '09467229397', 'marygracemacasinaghernando@gmail.com', 'Manuela Hernandez', 'Mother', '09123310081/ 09480217656', '661045'),
(250, 'Ibale', 'Jesly faith', 'Jesly faith', 'Ibale, Jesly faith', 'Empas', 'S', '1', 'FT2', 'Cebu City', 'Cebu', '7', 'PHL', '11/17/1991', 'Cebu Technological University', 'BS Civil Engineering', '09326110569', 'jeslyfaithibale@gmail.com', 'Lydia Obligado', 'Guardian', '09232882826', '661046'),
(251, 'Ilao', 'Carina', 'Carina', 'Ilao, Carina', 'Pega', 'S', '1', 'FT2', 'Mariveles', 'Bataan', '3', 'PHL', '12/10/1989', 'Polytechnic University of the Philippines-Bataan', 'BS Accountancy', '', '', '', '', '', '661047'),
(252, 'Imperio', 'Reynalie', 'Reynalie', 'Imperio, Reynalie', 'Concepcion', 'S', '1', 'FT2', 'Vigan', 'Ilocos Sur', '1', 'PHL', '11/3/1998', 'University of Northern Philippines', 'BSBA Human Resource Development Management', '', '', '', '', '', '661048'),
(253, 'Lee', 'Eun Hye', 'Hannah', 'Lee, Hannah', '', 'S', '1', 'FT2', 'Ansan', 'South Korea', 'South Korea', 'SOUTH KOREA', '9/27/1992', 'Wonju-sangi University', 'English-TESOL', '01030697023', 'littlelee@naver.com', 'Testimony Kim', '', '01075458087', '661051'),
(254, 'Mabasle', 'Onyza', 'Onyza', 'Mabasle, Onyza', 'Fabian', 'S', '1', 'FT2', 'Sibagat', 'Agusan Del Sur', '13 (CARAGA)', 'PHL', '11/13/1996', 'Agusan Del Sur College', 'Bachelor of Arts in English', '093831663292', '', 'Felipe Mabasle', 'Father', '09125133977', '661052'),
(255, 'Madrid', 'Olivia', 'Olivia', 'Madrid, Olivia', 'Labor', 'S', '1', 'FT2', 'San Mateo', 'Isabela', '2', 'PHL', '10/4/1996', 'Cagayan Valley Computer and Information Technology College, Inc.', 'Bachelor of Science in Accountancy', '', '', '', '', '', '661053'),
(256, 'Maghanoy', 'Shella', 'Shella', 'Maghanoy, Shella', 'Lomocso', 'S', '1', 'FT2', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '6/10/1997', 'City of Malabon University ', 'BSE Mapeh', '', '', '', '', '', '661054'),
(257, 'Mapute', 'Cherry Mae', 'Cherry Mae', 'Mapute, Cherry Mae', 'Flores', 'S', '1', 'FT2', 'Aloran', 'Misamis Occidental', '10', 'PHL', '4/24/1994', 'Western Mindanao State University', 'BSEd Major in English', '', '', '', '', '', '661055'),
(258, 'Marquilla', 'Armelyn', 'Armelyn', 'Marquilla, Armelyn', '', 'S', '1', 'FT2', 'Bayugan', 'Agusan Del Sur', '13 (CARAGA)', 'PHL', '5/19/1999', 'Philippine Normal University- Mindanao Campus', 'BS in Early Childhood', '09463574670', 'armelynalways99@gmail.com', 'Aida M. Permi', 'Mother', '09487972791', '661056'),
(259, 'Matas', 'Daylene', 'Daylene', 'Matas, Daylene', 'Ongus', 'S', '1', 'FT2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '6/27/1996', 'Bukidnon State University', 'BA-Social Science', '', '', '', '', '', '661057'),
(260, 'Mavunga', 'Privilege', 'Privilege', 'Mavunga, Privilege', 'Ruvimso', 'S', '1', 'FT2', 'Hangzhou', 'China', 'China', 'CHINA', '9/25/1994', 'Zhejiang Gongshang University', 'BS International Law', '', 'privyy251@yahoo.com', 'Mavunga Otilia', 'Mother', '263 772 961 327 ', '661058'),
(261, 'Miagao', 'Veronijean', 'Veronijean', 'Miagao, Veronijean', 'Princillo', 'S', '1', 'FT2', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '8/18/1997', 'Surigao State College of Technology', 'AB English Language & Literature', '09074064816', 'jinjinmiagao@gmail.com', 'Veronica Miagao ', 'Mother', '09309341526', '661059'),
(262, 'Mondejar', 'Ch''ry Jnyth', 'Ch''ry Jnyth', 'Mondejar, Ch''ry Jnyth', '', 'S', '1', 'FT2', 'Iligan City', 'Lanao del Norte', '10', 'PHL', '8/25/1998', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Zoology)', '', '', '', '', '', '661060'),
(263, 'Monteseven', 'Julita', 'Julita', 'Monteseven, Julita', 'Deliscoro', 'S', '1', 'FT2', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '11/16/1997', 'Mindanao State University-Iligan Institute of Technology', 'BS Biology (Zoology)', '09068433476', 'juliemonterseven@gmail.com', 'Pablita Monteseven', 'Mother', '09554782126', '661061'),
(264, 'Monteseven', 'Mary Joy', 'Mary Joy', 'Monteseven, Mary Joy', 'Deliscoro', 'S', '1', 'FT2', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '12/20/1996', 'University of Science and Technology of Southern Philippines', 'Bachelor of Science in Med Tech', '09489255702', 'mj.mondeseven.must@gmail.com', '', '', '', '661062'),
(265, 'Nadao', 'Archelyn', 'Archelyn', 'Nadao, Archelyn', 'Angeles', 'S', '1', 'FT2', 'Carrascal', 'Surigao Del Sur', '13 (CARAGA)', 'PHL', '8/7/1997', 'Saint Paul University Surigao', 'BS in Accounting Technology', '09106435017', 'archelynrosenadao@gmail.com', 'Estrelita Nadao', 'Mother', '9092644433', '661063'),
(266, 'Nericua', 'Noeme', 'Noeme', 'Nericua, Noeme', '', 'S', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '7/10/1994', 'Golden Heritage Polytechnic College', 'BSOA - Major in Office Management', '', '', '', '', '', '661064'),
(267, 'Oga', 'Mercy Mae', 'Mercy Mae', 'Oga, Mercy Mae', 'Cutao', 'S', '1', 'FT2', 'Sibutad', 'Zamboanga del Norte', '9', 'PHL', '6/16/1997', 'Mindanao State University-Marawi City', 'BSBA Management', '', '', '', '', '', '661065'),
(268, 'Omas', 'Freshness', 'Freshness', 'Omas, Freshness', 'Opiala', 'S', '1', 'FT2', 'Tabina', 'Zambonga del Sur', '9', 'PHL', '1/25/1998', 'Mindanao State University-Iligan Institute of Technology', 'BSBA Business Economics', '09477890633', 'freshness.omas@gmsuit.edu.ph', 'Arnel Omas', 'Father', '09463275608', '661067'),
(269, 'Ondac', 'Belen', 'Belen', 'Ondac, Belen', 'Bicoy', 'S', '1', 'FT2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '10/22/1987', 'Marian College', 'Bachelor of Science in Commerce', '', '', '', '', '', '661068'),
(270, 'Onsing', 'Cresill Mae', 'Cresill Mae', 'Onsing, Cresill Mae', 'Cabanes', 'S', '1', 'FT2', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '7/12/1995', 'De La Salle Araneta University', 'AB-Psychology', '', '', '', '', '', '661069'),
(271, 'Ontao', 'Sunshine', 'Sunshine', 'Ontao, Sunshine', 'Maglasang', 'S', '1', 'FT2', 'Amai Manabilang', 'Lanao Del Sur', 'ARMM', 'PHL', '10/22/1996', 'Bukidnon State University', 'BA-Social Science', '09363547872', 'Shineontao@gmail.com', 'Dines Pacturan', 'Brother', '09362316148', '661070'),
(272, 'Paderes', 'Jeanyfair', 'Jeanyfair', 'Paderes, Jeanyfair', '', 'S', '1', 'FT2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '9/29/1998', 'Philippine Normal University', 'Bachelor in Science Education-Biology', '', '', '', '', '', '661071'),
(273, 'Pagaoa', 'Betina Faye', 'Betina Faye', 'Pagaoa, Betina Faye', 'Valencia', 'S', '1', 'FT2', 'Tanza', 'Cavite', '4A', 'PHL', '6/20/1999', 'Cavite State University Main Campus', 'Information Technology', '', '', '', '', '', '661073'),
(274, 'Palomar', 'Shekinah', 'Shekinah', 'Palomar, Shekinah', 'Bullagay', 'S', '1', 'FT2', 'Sablayan', 'Occidental Mindoro', '4B', 'PHL', '12/18/1998', 'Our Lady of Fatima University - Val', 'Bachelor of Science in Pharmacy', '', '', '', '', '', '661074'),
(275, 'Pancho', 'Beulah', 'Beulah', 'Pancho, Beulah', 'Eimedolan', 'S', '1', 'FT2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '12/15/1995', 'Pateros Technological College', 'BS Office Administration', '', '', '', '', '', '661075'),
(276, 'Pilota', 'Kathleen', 'Kathleen', 'Pilota, Kathleen', 'Macahibag', 'S', '1', 'FT2', 'Minglanilla', 'Cebu', '7', 'PHL', '3/13/1998', 'University of San Jose-Recoletos', 'Business Administration', '09205794443', 'kathleenpilota13@gmail.com', 'Jocelyn Pilota', 'Mother', '09433699544', '661076'),
(277, 'Plata', 'Ruth', 'Ruth', 'Plata, Ruth', '', 'S', '1', 'FT2', 'Casiguran', 'Aurora', '3', 'PHL', '3/5/1997', 'Arellano University', 'Bachelor of Science in Accountancy', '', '', '', '', '', '661077'),
(278, 'Ramil', 'Felcrist', 'Felcrist', 'Ramil, Felcrist', 'Calolo', 'S', '1', 'FT2', 'Salvador', 'Lanao Del Norte', '10', 'PHL', '3/18/1993', 'North Central Mindanao Colleges', 'BS Elementary Education', '09363672605', '', 'Feliciano Ramil', 'Father', '09974131346', '661079'),
(279, 'Restauro', 'Gladys Suzzane', 'Gladys Suzzane', 'Restauro, Gladys Suzzane', 'Lagare', 'S', '1', 'FT2', 'Don Carlos', 'Bukidnon', '10', 'PHL', '5/7/1987', 'Don Carlos Polytechnic College', 'Bachelor of Arts in Economics', '', '', '', '', '', '661080'),
(280, 'Retagle', 'Chelsie', 'Chelsie', 'Retagle, Chelsie', 'Geraldino', 'S', '1', 'FT2', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '8/13/1996', 'Eulogio "Amang" Rodriguez Institute of Science and Technology', 'BSBA-Marketing', '', '', '', '', '', '661081'),
(281, 'Ricarte', 'Shula Mae', 'Shula Mae', 'Ricarte, Shula Mae', 'Pacardo', 'S', '1', 'FT2', 'Ormoc City', 'Leyte', '8', 'PHL', '9/28/1998', 'Western Leyte College Inc.', 'BSED-English', '', '', '', '', '', '661082'),
(282, 'Rosales', 'Phoebe Grace', 'Phoebe Grace', 'Rosales, Phoebe Grace', 'Paraiso', 'S', '1', 'FT2', 'Bacoor', 'Cavite', '4A', 'PHL', '8/13/1998', 'Cavite State University Main Campus', 'Information Technology', '', '', '', '', '', '661083'),
(283, 'Roxas', 'Maeriehl Joy', 'Maeriehl Joy', 'Roxas, Maeriehl Joy', 'Villa', 'S', '1', 'FT2', 'Pagbilao', 'Quezon', '4A', 'PHL', '', '', 'BS Marketing', '', '', '', '', '', '661084'),
(284, 'San Pedro', 'Beverly', 'Beverly', 'San Pedro, Beverly', 'Talagtag', 'S', '1', 'FT2', 'San Mateo', 'Rizal', '4A', 'PHL', '10/18/1992', 'San Mateo Municipal College', 'Marketing Management', '', '', '', '', '', '661085'),
(285, 'Sardual', 'Evelyn', 'Evelyn', 'Sardual, Evelyn', 'Talisik', 'S', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '2/5/1992', 'Golden Heritage Polytechnic College', 'BS Office Administration', '', '', '', '', '', '661086'),
(286, 'Sebial', 'Mary Mae', 'Mary Mae', 'Sebial, Mary Mae', '', 'S', '1', 'FT2', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '1/21/1997', 'University of Science and Technology of Southern Philippines', 'Bachelor of Secondary Education-TLE', '09976577377', 'marymaesebial@gmail.com', 'Merly Serbial-Carpio', 'Mother', '09051600751', '661087'),
(287, 'Sebonga', 'Jolina', 'Jolina', 'Sebonga, Jolina', 'Princillo', 'S', '1', 'FT2', 'Surigao City', 'Surigao del Norte', '13 (CARAGA)', 'PHL', '8/30/1998', 'Surigao State College of Technology', 'BS Environmental Science', '09483824908', 'jolina.sebonga19@gmail.com', 'Arlene P. Sebonga', 'Mother', '09464693228', '661088'),
(288, 'Servanda', 'Jersy', 'Jersy', 'Servanda, Jersy', '', 'S', '1', 'FT2', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '12/4/1998', 'Taguig City University', 'Bachelor of Secondary Education', '', '', '', '', '', '661089'),
(289, 'Siuyco', 'Olive', 'Olive', 'Siuyco, Olive', 'Manaba', 'S', '1', 'FT2', 'Calamba', 'Misamis Occidental', '10', 'PHL', '5/23/1996', 'Misamis University', 'BSED-English', '09465935699', 'osiuyco@gmail.com', 'Erlinde M. Siuyco', 'Mother', '09462340571', '661090'),
(290, 'Solis', 'Khristine Irene', 'Khristine Irene', 'Solis, Khristine Irene', 'Palmes', 'S', '1', 'FT2', 'Marilao', 'Bulacan', '3', 'PHL', '4/18/1999', 'Bulacan State University-Sarmiento Campus', 'Information Technology', '', '', '', '', '', '661091'),
(291, 'Sorongon', 'Sierra Mae', 'Sierra Mae', 'Sorongon, Sierra Mae', 'Tangle', 'S', '1', 'FT2', 'New Lucena', 'Iloilo', '6', 'PHL', '10/5/1998', 'West Visayas State University ', 'BS Applied Mathematics ', '', 'sierramesorongon@yahoo.com', 'Arleen T. Sorongon', 'Mother', '09456018564', '661092'),
(292, 'Suaso', 'Crisna Jean', 'Crisna Jean', 'Suaso, Crisna Jean', 'Suello', 'S', '1', 'FT2', 'Malaybalay', 'Bukidnon', '10', 'PHL', '2/8/1997', 'Bukidnon State University', 'BA-Social Science', '09067111475', 'crisnajeansuaso@gmail.com', 'Dennis Pacturan', 'Brother', '09362316148', '661093'),
(293, 'Tadiar', 'Angel Joy', 'Angel Joy', 'Tadiar, Angel Joy', 'Espinoria', 'S', '1', 'FT2', 'Rodriguez', 'Rizal', '4A', 'PHL', '7/23/1995', 'National University', 'Accounting Technology', '', '', '', '', '', '661094'),
(294, 'Tagnipis', 'Jemima', 'Jemima', 'Tagnipis, Jemima', 'Cubian', 'S', '1', 'FT2', 'General Santos City', 'South Cotabato', '12', 'PHL', '11/14/1998', 'Holy Trinity College', 'BSBA Marketing Management', '09101477222', 'tagnipisjemimacraft@gmail.com', 'Frisco N. Tagnipis', 'Father', '09101309880', '661095'),
(295, 'Talig', 'Grace May', 'Grace May', 'Talig, Grace May', 'Bacay', 'S', '1', 'FT2', 'General Santos City', 'South Cotabato', '12', 'PHL', '10/8/1996', 'Southern Philippines Academy College', 'Bachelor of Elementary Education', '09075670686', 'talig.gracemay@yahoo.com', 'Renato Talig', 'Father', '09288511543', '661096'),
(296, 'Tumimbang', 'Aida', 'Aida', 'Tumimbang, Aida', 'Cloma', 'S', '1', 'FT2', 'San Fernando', 'Bukidnon', '10', 'PHL', '8/5/1997', 'Bukidnon State University', 'BSBA Major in Financial Management', '09557446015', 'aidatumimbang20@gmail.com', 'Dennis Pacturan', 'Brother', '09362316148', '661098'),
(297, 'Tunay', 'Elisha May', 'Elisha May', 'Tunay, Elisha May', 'Ta', 'S', '1', 'FT2', 'Casiguran', 'Aurora', '3', 'PHL', '5/28/1995', 'Aurora State College of Technology', 'BS Civil Engineering', '', '', '', '', '', '661099'),
(298, 'Viernes', 'Judy Ann', 'Judy Ann', 'Viernes, Judy Ann', 'Cabanglan', 'S', '1', 'FT2', 'Badoc', 'Ilocos Norte', '1', 'PHL', '7/12/1996', 'Mariano Marcos State University', 'BS Cooperative Management', '09207996036', 'cabanglanjhudyanne@gmail.com', 'Melba Viernes', 'Mother', '09095524298', '661100'),
(299, 'Wang', 'Chenen', 'Sally', 'Wang, Sally', '', 'S', '1', 'FT2', 'Shaoxing', 'Zhe Jiang', 'China', 'CHINA', '7/16/1996', 'Ningbo University of Technology', 'English', '', '', '', '', '', '661101'),
(300, 'Wang', 'Huihuang', 'Nicole', 'Wang, Nicole', '', 'S', '1', 'FT2', 'Hangzhou', 'Zhe Jiang', 'China', 'CHINA', '10/4/1998', 'Zhejiang Yuying Vocational and Technical College', 'Major in Secretary', '', '', '', '', '', '661102'),
(301, 'Wang', 'Xinjie', 'Abby', 'Wang, Abby', '', 'S', '1', 'FT2', 'Jinan', 'Shandong', 'China', 'CHINA', '1/1/1998', 'Shandong Polytechnic', 'Bachelor of Science in Accountancy', '', '', '', '', '', '661103'),
(302, 'Wang', 'Yu', 'Della', 'Wang, Della', '', 'S', '1', 'FT2', 'Shanghai', 'China', 'China', 'CHINA', '10/11/1997', 'Danghua University', 'Textile', '18613795383059', '1394158443@99.com', '', '', '', '661104'),
(303, 'Weng', 'Xinjie', 'Alivia', 'Weng, Alivia', '', 'S', '1', 'FT2', 'Qu Zhou', 'Zhe Jiang', 'China', 'CHINA', '12/3/1996', 'Lu Zhou Institute of Technicians', 'Preschool Educations', '1515072004', '787374625@qq.com', 'Wang Yong Mei', 'Mother', '15157072004', '661105'),
(304, 'X', 'Hanna', 'Hanna', 'X, Hanna', '', 'S', '1', 'FT2', 'X', 'X', 'X', 'X', '8/28/1979', '', '', '', 'Parvane.159@gmail.com', 'Rasool', '', '09128432507', '661106'),
(305, 'Abella', 'Caryl', 'Caryl', 'Abella, Caryl', 'Yuag', 'S', '1', 'FT3', 'Mandaluyong', 'Metro Manila', 'NCR', 'PHL', '2/5/1995', 'Stella Maris College', 'BS Accountancy', '09983835214', 'carylab234@yahoo.com', 'Anita Hayao', 'Sister', '09983835214', '65154'),
(306, 'Ambet', 'Crystalene', 'Crystalene', 'Ambet, Crystalene', 'Biclay', 'S', '1', 'FT3', 'Lapuyan', 'Zamboanga Del Sur', '9', 'PHL', '4/13/1997', 'J.H. Cerilles State College', 'BEED', '13/04/97', '', 'Aton Ambet', 'Father', '09161312652', '65102'),
(307, 'Ang', 'New Blossom', 'Blossom', 'Ang, Blossom', 'Chan', 'S', '1', 'FT3', 'Cebu City', 'Cebu', '7', 'PHL', '9/26/1987', 'Cebu Doctor''s University', 'BS Nursing', '09272199320/ (032) 2683424', 'fastpay.encashment@gmail.com', 'Johnny Ang', 'Father', '09066823088', '65103'),
(308, 'Anuario', 'Dhevi Ann', 'Dhevi Ann', 'Anuario, Dhevi Ann', 'Fabre', 'S', '1', 'FT3', 'Tubod', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '10/31/1996', 'Northeastern Mindanao Colleges', 'Bachelor of Elementary Education', '09501592262', 'dheviann.annuario@gmail.com', 'Virgilio L. Anuario', 'Father', '09501592262', '65104'),
(309, 'Balbaquera', 'Mildred', 'Mildred', 'Balbaquera, Mildred', 'Bongcawil', 'S', '1', 'FT3', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/28/1989', 'Mary the Queen College of Quezon City', 'BSBA- Human Resource', '09216465366', 'balbaqueramildred@gmail.com', 'Melodie Bacergo ', 'Sister', '09129918041', '65105'),
(310, 'Balios', 'Legyn', 'Legyn', 'Balios, Legyn', 'Rodriguez', 'S', '1', 'FT3', 'Bacolod', 'Lanao Del Norte', '10', 'PHL', '4/9/1998', 'Mindanao State University- Maigo School of Arts and Trades', 'BEED - GenEd', '09265143171', 'balioslegyn816@gmail.com', 'Tessie R. Balios', 'Mother', '09971649124', '65106'),
(311, 'Baloncio', 'Jiza Jane', 'Jiza', 'Baloncio, Jiza', '', 'S', '1', 'FT3', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '2/21/1998', 'Stella Maris College', 'BEED', '09487956493', '', 'Liza D. Baloncio', 'Mother', '09216917977', '65107'),
(312, 'Bendula', 'Shiela Mae', 'Shiela Mae', 'Bendula, Shiela Mae', 'Tampugao', 'S', '1', 'FT3', 'Dumalinao', 'Zamboanga Del Sur', '9', 'PHL', '6/14/1995', 'J.H. Cerilles State College', 'BA English', '09103461674', 'shiebendula@gmail.com', 'Danillo Madarimot', '', '09197495232', '65108'),
(313, 'Cadotdot', 'Rodelis', 'Rodelis', 'Cadotdot, Rodelis', 'Pilapil', 'S', '1', 'FT3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '8/29/1995', 'Western Mindanao State University', 'BEED- Special Education', '09207775572/09127480935', '', 'Rubylin Cadotdot', 'Father', '09207775572', '65109'),
(314, 'Caerlang', 'Anelly', 'Anelly', 'Caerlang, Anelly', 'Babanto', 'S', '1', 'FT3', 'Tubod', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '9/13/1995', 'STI College- Surigao', 'BS Information Technology', '09271625270', 'caerlanganelly57@gmail.com', 'Rolly A. Caerlang', 'Father', '09464318442', '65110'),
(315, 'Cahayagan', 'Shulammite Myrrh', 'Myrrh', 'Cahayagan, Myrrh', 'Bantilan', 'S', '1', 'FT3', 'V. Sagun', 'Zamboanga Del Sur', '9', 'PHL', '5/11/1997', 'Saint Columbian College', 'BS Accountancy', '09268739989/09484875925', 'shulammitecahayagan@gmail.com', 'Phoebe Cahayagan', 'Mother', '09484875925', '65111'),
(316, 'Cano', ' Mae Jane Shewanie', 'Shewanie', 'Cano, Shewanie', 'Centino', 'S', '1', 'FT3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '6/13/1994', 'Misamis University', 'Doctor of Dental Medicine', '09957214584', 'maejaneshewanie@yahoo.com', 'Eme C. Waldenburg', 'Mother', '071415052795', '65113'),
(317, 'Canta', 'Jacelle Ruth', 'Ruth', 'Canta, Ruth', 'Sabares', 'S', '1', 'FT3', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '4/29/1997', 'Tagoloan Community College', 'BSED- English', '09264701765/09265802107', 'jacelleruthcanta@gmail.com', 'Joel Canta', 'Father', '09264701765', '65114'),
(318, 'Capua', 'Irish Joy', 'Irish Joy', 'Capua, Irish Joy', 'Lomboy', 'S', '1', 'FT3', 'Bolinao', 'Pangasinan', '1', 'PHL', '7/18/1994', 'Virgen Milagrosa University Foundation Inc.', 'BS Pharmacy', '9953028612', 'ijcapua119@gmail.com', 'Nancy Capua', 'Mother', '09088981157', '814'),
(319, 'Carcillar', 'Jade', 'Jade', 'Carcillar, Jade', 'Maghanoy', 'S', '1', 'FT3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '1/16/1996', 'MSU- IIT', 'AB- Sociology', '09457666973', 'januarez16@gmail.com', 'Rowena M. Carcillar', 'Mother', '09051254593', '65115'),
(320, 'Cruz', 'Tiffany Grace', 'Tiffany Grace', 'Cruz, Tiffany Grace', '', 'S', '1', 'FT3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/29/1995', 'Adamson University', 'BS Chemical Engineering', '9568215/09228122789', 'teegeecruz@gmail.com', 'Liberty V. Cruz', 'Mother', '092288110481', '65117'),
(321, 'Daguman', 'Charis', 'Charis', 'Daguman, Charis', 'Dela Cerna', 'S', '1', 'FT3', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '11/24/1994', 'Western Mindanao State University', 'Bachelor of Physical Education', '9265536/09972518937', 'dagumancharis@gmail.com', 'Ranulfo G. Daguman', 'Father', '09175713635/9265536', '65118'),
(322, 'Dela cruz', 'Chassah Yelle', 'Chassah Yelle', 'Dela cruz, Chassah Yelle', 'Dimaculangan', 'S', '1', 'FT3', 'Kalibo', 'Aklan', '6', 'PHL', '8/8/1998', 'Aklan State University- College of Industrial Technology', 'BSEd (T.L.E)', '09973926039', 'yelledelacruz8898@gmail.com', 'Jessa Dela Cruz', 'Sister', '09051947695', '65119'),
(323, 'Ebarat', 'Glianne Rae', 'Glianne Rae', 'Ebarat, Glianne Rae', 'Bugas', 'S', '1', 'FT3', 'Panaon', 'Misamis Occidental', '10', 'PHL', '3/31/1997', 'University of Science and Technology of Southern Philippines', 'BS Marine Biology', '09462761497', '', 'Erma Rae Bugas Ebarat', 'Mother', '09462761497', '65152'),
(324, 'Econg', 'Cyrene Phi', 'Cyrene Phi', 'Econg, Cyrene Phi', 'Labastilla', 'S', '1', 'FT3', 'Davao City', 'Davao Del Norte', '11', 'PHL', '7/29/1991', 'Western Mindanao State University', 'BSED- English', '09061844389', 'zyrenephi@gmail.com', 'Ruth E. Mila', 'Aunt', '09499603065', '65120'),
(325, 'Egbus', 'Glennes Marie', 'Glennes', 'Egbus, Glennes', 'Arcenas', 'S', '1', 'FT3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '11/7/1995', 'Western Mindanao State University- ESU Molave', 'Bachelor in Elementary Education', '09307581828', 'egbusglennesmarie@yahoo.com', 'Myrna A. Egbus', 'Mother', '09107277184', '65121'),
(326, 'Espiritu', 'Pneuma', 'Pneuma', 'Espiritu, Pneuma', 'Baroro', 'S', '1', 'FT3', 'Dipolog City', 'Zamboanga Del Norte', '9', 'PHL', '10/21/1998', 'University of San Carlos', 'BSBA- Financial Management', '09300200466/09163852761', 'espiritupneuma@gmail.com', 'Benedicto Espiritu Jr.', 'Father', '09300200466', '65123'),
(327, 'Fernandez', 'Merycris', 'Mery Cris', 'Fernandez, Mery Cris', 'Dago-oc', 'S', '1', 'FT3', 'Mandaue City', 'Cebu', '7', 'PHL', '7/7/1995', 'Pamantasan ng Cabuyao', 'BSBA Marketing', '09192245667', 'merycrisfernandez07@gmail.com', 'Cristubal J. Fernandez', 'Father', '09331569648/09479716842', '65124'),
(328, 'Galloniga', 'Shinely', 'Shinely', 'Galloniga, Shinely', 'Jaranilla', 'S', '1', 'FT3', 'Davao City', 'Davao Del Sur', '11', 'PHL', '12/6/1994', 'University of Mindanao', 'BSED- Social Studies', '09286684400/2850516', '', 'Dina G. Jurasa', 'Aunt', '09488912061', '65125'),
(329, 'Geguiera', 'Abegail', 'Abegail', 'Geguiera, Abegail', '', 'S', '1', 'FT3', 'Rizal', 'Palawan', '4B', 'PHL', '10/8/1997', 'Western Philippines University', 'BSED Social Studies', '09481529731', 'abegailgulimangeguiera@gmail.com', 'Gabriel Geguira/Miraflor Geguiera', 'Parents', '09505405257', '65155'),
(330, 'Godornes', 'Daleth', 'Daleth', 'Godornes, Daleth', 'Coronel', 'S', '1', 'FT3', 'Naga', 'Cebu', '7', 'PHL', '7/14/1993', 'Professional Academy of the Philippines', 'BSED- English', '09353493805', 'daleth.coronel@yahoo.com', 'Isabel Coronel', 'Mother', '09152634889', '65126'),
(331, 'Haway', 'Andrea Carla', 'Andrea Carla', 'Haway, Andrea Carla', 'Mondragon', 'S', '1', 'FT3', 'Lucena City', 'Quezon Province', '4A', 'PHL', '12/2/1996', 'University of the Philippines- Los Ba', 'BS Agricultural & Biosystems Engineering', '09369160197', 'amhaway@up.edu.ph', 'Editha M. Haway', 'Mother', '09981700486', '65129'),
(332, 'Icagoy', 'Igane', 'Igane', 'Icagoy, Igane', 'Pagunsan', 'S', '1', 'FT3', 'Kalibo', 'Aklan', '6', 'PHL', '9/7/1997', 'Aklan State University- College of Industrial Technology', 'Bachelor of Secondary Education- TLE', '09300180332', 'iganeicagoy144@gmail.com', 'Bro. Rogerie Eufre', 'Co-worker', '09233345570', '65130'),
(333, 'Isidro', 'Jara Patricia', 'Jara', 'Isidro, Jara', 'Beniga', 'S', '1', 'FT3', 'Iligan City', 'Lanao Del Norte', '10', 'PHL', '12/6/1996', 'Mindanao State University- Iligan Institute of Technology', 'BS Mathematics', '09675838713', 'pinxpatricia@gmail.com', 'Estrella P. Beniga', 'Grandmother', '09979647106', '65131'),
(334, 'Labod', ' Mylien', 'Mylien', 'Labod, Mylien', 'Bernabe', 'S', '1', 'FT3', 'Saint Bernard', 'Leyte', '8', 'PHL', '1/10/1996', 'Visayas State University', 'BS Agribusiness', '09363965545', 'mylienzoe3@gmail.com', 'Fernando Labod', 'Father', '09359470547', '65132'),
(335, 'Legua', 'Josiefiel Joy', 'Josefiel', 'Legua, Josefiel', 'Milado', 'S', '1', 'FT3', 'Tacloban City', 'Leyte', '8', 'PHL', '9/22/1990', 'University of the Philippines Visayas Tacloban College', 'BS Management', '09057817888/ (053)5231082', 'josiefieljoy@gmail.com', 'Pe?afiel Flor M. Legua', 'Mother', '09171154998', '65133'),
(336, 'Madarimot', 'Mirell Mae', 'Mirrell', 'Madarimot, Mirrell', 'Ehorpe', 'S', '1', 'FT3', 'Lakewood', 'Zamboanga Del Sur', '9', 'PHL', '5/5/1996', 'Western Mindanao State University', 'BEED- General Education', '09482822299', 'mirellmae19@gmail.com', 'Lesiel Balatero', 'Sister', '09187093752', '65134'),
(337, 'Malbuyo', 'Divine', 'Divine', 'Malbuyo, Divine', 'Paredes', 'S', '1', 'FT3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '2/24/1998', 'Siliman University', 'BS Medtech', '09052565834/5214039', 'divinepmalbuyo@su.edu.ph', 'Jelin Malbuyo', 'Mother', '09652009221', '65135'),
(338, 'Malong', 'Menchie', 'Menchie', 'Malong, Menchie', 'Matutina', 'S', '1', 'FT3', 'Pagadian City', 'Zamboanga Del Sur', '9', 'PHL', '11/7/1988', 'Iligan Medical Center Colleges', 'BS Nursing', '09192662468', 'luvmench@yahoo.com', 'Susan Matutina', 'Mother', '09094704127', '65136'),
(339, 'Nini', 'Jezza Mae', 'Jezza Mae', 'Nini, Jezza Mae', 'Sumampong', 'S', '1', 'FT3', 'Tangub', 'Misamis Occidental', '10', 'PHL', '12/31/1997', 'Mindanao State University- Iligan Institute of Technology', 'BS Biology', '09090621953', 'ninijezza@gmail.com', 'Jacinto Nini Jr.', 'Father', '09098213155', '65137'),
(340, 'Nini', 'Jazmine Mae', 'Jazmine Mae', 'Nini, Jazmine Mae', 'Sumampong', 'S', '1', 'FT3', 'Tangub', 'Misamis Occidental', '10', 'PHL', '12/31/1997', 'Mindanao State University- Iligan Institute of Technology', 'BSED- MAPEH', '09485796754', 'jazminenini@gmai.com', 'Jacinto Nini Jr. ', 'Father', '09093213155', '65138'),
(341, 'Ongue', 'Alethia', 'Alethia', 'Ongue, Alethia', '', 'S', '1', 'FT3', 'Tubod', 'Lanao Del Norte', '10', 'PHL', '1/13/1996', 'Mindanao State University- Maigo School of Arts and Trades', 'BEED- General Education', '09655482678', 'gracie9706@gmail.com', 'Roderick E. Ongue', 'Father', '09068797846', '65139'),
(342, 'Padayao', 'Chenalyn', 'Chenalyn', 'Padayao, Chenalyn', 'Millan', 'S', '1', 'FT3', 'Cagayan de Oro City', 'Misamis Oriental', '10', 'PHL', '9/15/1997', 'Misamis Oriental Institute of Science and Technology', 'BSED- English', '09169379498', '', 'Timoteo Padayao', 'Father', '09169379498', '65140'),
(343, 'Perez', 'Mary Jill', 'Jill', 'Perez, Jill', 'Patricio', 'S', '1', 'FT3', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '6/24/1992', 'University of the East- Caloocan', 'BS Accounting Technology', '3735678', 'maryjillperez@yahoo.com', 'Marife Perez', 'Mother', '09293291307', '65142'),
(344, 'Prieto', 'Jasper', 'Jasper', 'Prieto, Jasper', 'Anghag', 'S', '1', 'FT3', 'Ozamiz City', 'Misamis Occidental', '10', 'PHL', '3/18/1998', 'Misamis University- Ozamis City', 'BS Medical Technology', '09207244511', 'prieto.jaja.00@gmail.com', 'Emma Prieto', 'Mother', '09107321915/09351207786', '65143'),
(345, 'Prongco', 'Lovely Jean', 'Jean', 'Prongco, Jean', '', 'S', '1', 'FT3', 'General Santos City', 'South Cotabato', '12', 'PHL', '9/9/1996', 'Notre Dame of Dadiangas University', 'Bachelor of Library and Information Sciences', '09104208088', 'Iprongco@yahoo.com', 'Lorefe Prongco', 'Mother', '09460439712', '65144'),
(346, 'Rosales', 'Dorothy Lois', 'Dorothy', 'Rosales, Dorothy', 'Paraiso', 'S', '1', 'FT3', 'Bacoor', 'Cavite', '4A', 'PHL', '9/22/1996', 'Cavite State University', 'BS Business Management- Financial', '09950218906', 'dorothyrosales1@gmail.com', 'Arleen Rosales', 'Mother', '09065677360', '65145'),
(347, 'Saluta', 'Jay', 'Jay', 'Saluta, Jay', 'Abing', 'S', '1', 'FT3', 'Sinacaban', 'Misamis Occidental', '10', 'PHL', '10/18/1993', 'Misamis University', 'Social Work', '09300266281', 'salutajay18@gmail.com', 'Jebusa Saluta', 'Mother', '09488596987', '65146'),
(348, 'Sayles', 'Everose', 'Everose', 'Sayles, Everose', '', 'S', '1', 'FT3', 'Aloran', 'Misamis Occidental', '10', 'PHL', '12/30/1996', 'Western Mindanao State University- External Studies Unit', 'BSED- English', '09504102543', '', 'Phoebe Sayles', 'Mother', '09504102543', '65147'),
(349, 'Tumampos', 'Brigette', 'Brigette', 'Tumampos, Brigette', 'Bijo', 'S', '1', 'FT3', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '10/16/1996', 'Misamis University- Ozamis City', 'BS Medical Technology', '09452544417/5453451', 'btumampos@gmail.com', 'Veronica Tumampos', 'Mother', '09357233028', '65149'),
(350, 'Valeriano', 'Mary Grace', 'Grace', 'Valeriano, Grace', '', 'S', '1', 'FT3', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '7/22/1995', 'Bestlink College of the Philippines', 'BS Office Administration', '09381474126', 'grace072295@yahoo.com', 'Mhiles Chua', 'Aunt', '09215102740', '65156'),
(351, 'Woiwa', 'Michelle', 'Michelle', 'Woiwa, Michelle', '', 'S', '1', 'FT3', 'X', 'X', '10', 'PNG', '', '', '', '', '', '', '', '', '65157'),
(352, 'Aba-a', 'Neshama', 'Neshama', 'Aba-a, Neshama', 'Maicom', 'S', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '4/8/1998', 'Cebu Institute of Technology University', 'BSBA-Management Accounting', '09234322952', 'neshamaabaa@gmail.com', 'Lorna Aba-a', 'Mother', '09362584285', '64101'),
(353, 'Abalde', 'Precil', 'Precil', 'Abalde, Precil', 'Carillo', 'S', '1', 'FT4', 'Kapatagan', 'Lanao del Norte', '10', 'PHL', '7/25/1994', 'Mindanao State University - LNAC Campus', 'BEED - GenEd', '09755225649', 'precilabalde@gmail.com', 'Jerry Abalde', 'Father', '09557618025', '64102'),
(354, 'Abejuela', 'Janice', 'Janice', 'Abejuela, Janice', 'C.', 'S', '1', 'FT4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '2/6/1997', 'Bukidnon State University', 'BA Philosophy', '09069180701', 'janiceabejuela06@gmail.com', 'Teresita Abejuela', 'Mother', '09358692468', '64103'),
(355, 'Abellera', 'Maria Cristina', 'Cristina', 'Abellera, Cristina', 'Ramos', 'S', '1', 'FT4', 'Umingan', 'Pangasinan', '1', 'PHL', '2/20/1989', 'Union Christian College', 'BS Nursing', '09184144433', '', 'Elmie R. Abellera', 'Mother', '09498778359', '64104'),
(356, 'Acedera', 'Margarett', 'Margarett', 'Acedera, Margarett', 'Reynaldo', 'S', '1', 'FT4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '9/27/1995', 'City of Malabon University', 'BSIT', '0924081484', 'acedera.margarett@gmail.com', 'Meen Jameeel Ul-Haq', 'Sister', '09215866340', '64105'),
(357, 'Almonia', 'Charity', 'Charity', 'Almonia, Charity', 'Embate', 'S', '1', 'FT4', 'Lala', 'Lanao Del Norte', '10', 'PHL', '11/15/1993', 'Christ the King College De Maranding', 'BS Business Administration', '09356667280', 'almonia57@gmail.com', 'Reward Villanueva', 'Cousin', '09753081941', '64106'),
(358, 'Andrino', 'Rona', 'Rona', 'Andrino, Rona', 'Lasdoce', 'S', '1', 'FT4', 'Bogo City', 'Cebu', '7', 'PHL', '9/19/1997', 'Cebu Technological University', 'BSED-TLE', '09354116033', 'andrino.rona@gmail.com', 'Bro. Roel Andrino', '', '09354116033', '64107'),
(359, 'Angus', 'Sabina Mae', 'Sabina', 'Angus, Sabina', 'Brioso', 'S', '1', 'FT4', 'Maigo', 'Lanao Del Norte', '10', 'PHL', '8/27/1997', 'Mindanao State University', 'BS Insdustrial Tech-garment Tech', '09262375709', 'sabinaangus082797', 'Bernabe C. Dimol', 'Brother in Christ', '09058935288', '64108');
INSERT INTO `trainee_info_temp` (`trainee_id`, `Last_Name`, `First_Name`, `ID_Name`, `Full_Name`, `Middle_Name`, `Gender`, `Status`, `Term`, `Sending_Locality`, `Province`, `Region`, `Country`, `Birthdate`, `School`, `Degree`, `Contact_number`, `Email`, `Emergency_Contact_Person`, `Relationship`, `Contact_No`, `Reg_No`) VALUES
(360, 'Arbutante', 'Christine', 'Christine', 'Arbutante, Christine', 'Castillo', 'S', '1', 'FT4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '9/4/1992', 'Bohol Island State University', 'BS Industrial Psychology', '09306784217', 'arbutante.christine@yahoo.com', 'Jessie C. Arbutante', 'Uncle', '09088933908', '64110'),
(361, 'Arcena', 'Elishia', 'Elishia', 'Arcena, Elishia', 'Pilac', 'S', '1', 'FT4', 'Naic', 'Cavite', '4A', 'PHL', '10/31/1998', 'STI College Rosario', 'BS Information Technology', '09975465642 / 09976032054', 'elishiaarcena@gmail.com', 'Arnie Arcena', 'Mother', '09357707565', '64111'),
(362, 'Arevalo', 'Mylene', 'Mylene', 'Arevalo, Mylene', 'Bibay', 'S', '1', 'FT4', 'Canaman', 'Camarines Sur', '5', 'PHL', '9/5/1997', 'Naga College Foundation', 'BS Entrepreneurship', '09450941679', 'mylenearevalo88@gmail.com', 'Ma. Elena B. Arevalo', 'Mother', '09297233967', '64112'),
(363, 'Asiong', 'Sheryl Lou', 'Sheryl Lou', 'Asiong, Sheryl Lou', 'Carlos', 'S', '1', 'FT4', 'Kalibo', 'Aklan', '6', 'PHL', '1/8/1990', 'North Western Visayan Colleges', 'Bachelor in Elementary Education', '09307429918', 'asiong_sheryllou@yahoo.com', '', '', '', '64113'),
(364, 'Bastillada', 'Ressa', 'Ressa', 'Bastillada, Ressa', 'Napone', 'S', '1', 'FT4', 'Iligan City', 'Lanao del Norte', '10', 'PHL', '2/25/1996', 'St. Peter''s College', 'BSBA Financial Management', '09357998562', 'sasabastillada@gmail.com', 'Analiza Bastillada', 'Mother', '09358528486', '64114'),
(365, 'Bongcawel', 'Shirly Ann', 'Shirly Ann', 'Bongcawel, Shirly Ann', 'Abriol', 'S', '1', 'FT4', 'Kibawe', 'Bukidnon', '10', 'PHL', '7/13/1993', 'Southwestern University', 'BS Pharmacy', '09269136530', 'bongcawelshirly29@gmail.com', 'Secema Abriol Bongcawel', 'Mother', '09979288073', '64115'),
(366, 'Bonghanoy', 'Liza Cliere', 'Liza Cliere', 'Bonghanoy, Liza Cliere', 'Bugot', 'S', '1', 'FT4', 'Molave', 'Zamboanga del Sur', '9', 'PHL', '11/24/1995', 'Western Mindanao State University', 'BSED-Social Studies', '09306051227', '', 'Roldan A. Bonghanoy', 'Father', '09197578955', '64116'),
(367, 'Brioso', 'Jennifer', 'Jennifer', 'Brioso, Jennifer', 'Sevilleno', 'S', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '3/21/1990', 'University of San Carlos', 'BSED- English', '09168765536', 'nefibrioso@hotmail.com', 'Nathaniel V. Brioso', 'Father', '09222546648', '64117'),
(368, 'Calamaya', 'Anna Fe', 'Anna Fe', 'Calamaya, Anna Fe', 'Magayones', 'S', '1', 'FT4', 'Tolosa', 'Leyte', '8', 'PHL', '2/27/1995', 'Leyte Normal University', 'BS Home Arts university', '09509948961', 'annclmy@gmail.com', 'Antonio M. Calamaya', 'Father', '09994793643', '64118'),
(369, 'Calib', 'Glydel', 'Glydel', 'Calib, Glydel', 'Tac-an', 'S', '1', 'FT4', 'Oroquieta City', 'Misamis Occidental', '10', 'PHL', '7/12/1997', 'Southern Capital Colleges', 'BSBA Marketing Management', '09488794961', 'glydelcalib@yahoo.com', 'Randel Ibrahim Y. Calib', 'Father', '09207989194', '64119'),
(370, 'Camarao', 'Daisy Mae', 'Daisy Mae', 'Camarao, Daisy Mae', 'Ducusin', 'S', '1', 'FT4', 'San Fernando City', 'La Union', '1', 'PHL', '12/3/1997', 'Don Mariano Marcos State University', 'Bachelor of Science in Business Administration', '09158169802', 'camaraodaisy@yahoo.com', 'Dominador Camarao', 'Father', '09177760606', '64120'),
(371, 'Ca?ete', 'Aileen Grace', 'Aileen', 'Ca?ete, Aileen', 'Albaran', 'S', '1', 'FT4', 'San Remegio', 'Cebu', '7', 'PHL', '12/29/1995', 'Cebu technological University', 'BSED-TLE', '09974817914', 'aileenalbarancanete@gmail.com', 'Bro. Alan Ca?ete', 'Father', '09233658215', '64121'),
(372, 'Castigon', 'Marilyn', 'Marilyn', 'Castigon, Marilyn', 'Ampo', 'S', '1', 'FT4', 'Lebak', 'Sultan Kudarat', '12', 'PHL', '3/8/1989', 'Pamantasan ng Lungsod ng Pasig', 'Information Technology', '09424522725', 'renalyn083D16@gmail.com', 'Carlos Castigon', 'Father', '09102571627', '64122'),
(373, 'Castro', 'Marie Claire Ladylyn', 'Marie Claire', 'Castro, Marie Claire', 'San Gabriel', 'S', '1', 'FT4', 'Do?a Remedios Trinidad', 'Bulacan', '3', 'PHL', '12/15/1992', 'Norzagaray, Bulacan', 'BS HRM', '09098322529', 'LadylynCastro17@yahoo.com', 'Efren Castro', 'Father', '09554416580', '64123'),
(374, 'Catalu', 'Grace', 'Grace', 'Catalu?a, Grace', 'Geguera', 'S', '1', 'FT4', 'Puerto Princesa City', 'Palawan', '4B', 'PHL', '2/8/1990', 'Palawan State University', 'BS in Agriculture', '09125484157', 'gracecataluna@gmail.com', 'Gedeon D. Catalu', 'Father', '09068632423', '64124'),
(375, 'Co', 'Loren Lavinnia', 'Loren', 'Co, Loren', 'Vicencio', 'S', '1', 'FT4', 'Baguio City', 'Benguet', 'CAR', 'PHL', '11/14/1996', 'Saint Louis University', 'Bachelor in Medical Technology', '09550547677', 'lorenco.lc@gmail.com', 'Zaldy Co', 'Father', '09175061651', '64127'),
(376, 'Del Rosario', 'Precious', 'Precious', 'Del Rosario, Precious', 'Pongasi', 'S', '1', 'FT4', 'San Jose Del Monte', 'Bulacan', '3', 'PHL', '7/25/1995', 'Bulacan State University', 'BS Mechanical Engineering', '09553085375', 'preciousdr0725@gmail.com', 'Elizabeth Del Rosario', 'Mother', '09553085375', '64129'),
(377, 'Dionaldo', 'Cherryl Ann ', 'Cherryl', 'Dionaldo, Cherryl', 'Yorpo', 'S', '1', 'FT4', 'Caloocan City', 'Metro Manila', 'NCR', 'PHL', '3/15/1997', 'Quezon City Polytechnic University', 'BS Information Technology', '09751065705', 'chiicahay15.dionaldo@yahoo.com', 'Sis Maribel Villarosa', 'Shepherd', '09173128188', '64130'),
(378, 'Ebale', 'Mary Grace', 'Mary Grace', 'Ebale, Mary Grace', 'Almonia', 'S', '1', 'FT4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '8/18/1992', 'Zamboanga City State College of Marine Sciences and Technology', 'BS HRM', '09956909910', 'marygraceebale44341@gmail.com', 'Eunice Ebale', 'Sister', '09263433350', '64132'),
(379, 'Flores', 'Mirra Joy', 'Mirra Joy', 'Flores, Mirra Joy', 'Geronimo', 'S', '1', 'FT4', 'Sumilao', 'Bukidnon', '10', 'PHL', '8/23/1994', 'Bukidnon State University', 'BSE - English', '09264740725', '', 'Fely G. Flores', 'Mother', '09103012673', '64133'),
(380, 'Garcia', 'Alyssa Joy', 'Alyssa Joy', 'Garcia, Alyssa Joy', 'Bitas', 'S', '1', 'FT4', 'Surigao City', 'Surigao Del Norte', '13 (CARAGA)', 'PHL', '1/30/1998', 'Surigao State College of Technology', 'Bachelor of Science in Information Technology', '09095985338', 'alysonjanegarcia@gmail.com', 'Nelba Garcia', 'Mother', '09052253754', '64135'),
(381, 'Jadomas', 'Jonah Jairah', 'Jairah', 'Jadomas, Jairah', 'Bivas', 'S', '1', 'FT4', 'Iloilo City', 'Iloilo', '6', 'PHL', '3/15/1997', 'Iloilo Science and Technology', 'Bachelor of Science in Architecture', '9090221650', 'jairahjadel5@gmail.com', 'Joebert Jadomas', 'Father', '09185467872', '64137'),
(382, 'Lofranco', 'Caroline', 'Caroline', 'Lofranco, Caroline', 'Pailden', 'S', '1', 'FT4', 'Cebu City', 'Cebu', '7', 'PHL', '12/6/1995', 'Cebu Technological University - Main Campus', 'BSIT - Garments', '09104514262', 'carolinelofranco96@gmail.com', 'Joann Lofranco', 'Sister', '09156551024', '64140'),
(383, 'Mahinay', 'Tabita', 'Tabita', 'Mahinay, Tabita', 'Italla', 'S', '1', 'FT4', 'El Nido', 'Palawan', '4B', 'PHL', '11/21/1996', 'University of the East', 'BS HRM', '09988696287', 'tabitamahinay21@gmail.com', 'Jhun Jhun Mahinay', 'Father', '09399192296', '64141'),
(384, 'Makiling', 'Jay Marie', 'Jay Marie', 'Makiling, Jay Marie', 'Avenido', 'S', '1', 'FT4', 'Tanauan City', 'Batangas', '4A', 'PHL', '11/9/1995', 'DMMC-Institute of Health Sciences', 'BSBA Major in Operation Management', '09304166639', 'jaymakiling@gmail.com', 'Marites Makiling', 'Mother', '09506632094', '64142'),
(385, 'Matas', 'Jerry Dame', 'Jerry Dame', 'Matas, Jerry Dame', 'Lapuz', 'S', '1', 'FT4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '4/14/1996', 'Bukidnon State University', 'BA Philosophy', '09501107193', '', 'Manuel Matas', 'Father', '09168920165', '64143'),
(386, 'Medellada', 'April Mae', 'April Mae', 'Medellada, April Mae', 'Pondoc', 'S', '1', 'FT4', 'Kumalarang', 'Zamboanga Del Sur', '9', 'PHL', '4/9/1996', 'Misamis University - Ozamiz', 'BS Biology', '09776061763', 'aprilmaemedellada@gmail.com', 'Amada P. Medellada ', 'Mother', '09464649803', '64144'),
(387, 'Medillo', 'Rolen', 'Rolen', 'Medillo, Rolen', 'Senas', 'S', '1', 'FT4', 'Malaybalay City', 'Bukidnon', '10', 'PHL', '12/5/1997', 'Saint Calumban College', 'BS Accounting Technology', '09166371033', 'rolenmedillo1997@gmail.com', 'Emelito A. Senas', 'Uncle', '09365957546', '64145'),
(388, 'Mesina', 'Vanessa Joy', 'Vanessa', 'Mesina, Vanessa', 'B', 'S', '1', 'FT4', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '8/3/1998', 'City of Malabon University', 'BSIT', '09566271639', 'vanessamesina@gmail.com', 'Rhizalyn Mesina', 'Sister', '0975867863', '64146'),
(389, 'Molit', 'Anelyn', 'Anelyn', 'Molit, Anelyn', 'Pe?aflor', 'S', '1', 'FT4', 'Camalig', 'Albay', '5', 'PHL', '7/13/1995', 'Southern Luzon Technological College Foundation Inc.', 'BSBA Human Resource', '09090448992', 'molitannie7131995@gmail.com', 'John Dorol', 'Brother in the church', '09173330500', '64147'),
(390, 'Morales', 'Medelyn', 'Medelyn', 'Morales, Medelyn', 'Andres', 'S', '1', 'FT4', 'Padre Garcia', 'Batangas', '4A', 'PHL', '4/5/1995', 'Kolehiyo ng Lungsod ng Lipa', 'Bachelor of Science in Computer Science', '09771353054', 'medelynmorales05@gmail.com', 'Demostry Morales', 'Parent', '09128516291', '64149'),
(391, 'Muego', 'Michelle', 'Michelle', 'Muego, Michelle', 'Gallega', 'S', '1', 'FT4', 'Pagadian City', 'Zamboanga del Sur', '9', 'PHL', '3/6/1990', 'Saint Columban College', 'BSBA Financial Management', '09359862916', 'mitchellemuego@gmail.com', 'Rogelio R. Muego', 'Father', '09079669565', '64150'),
(392, 'Ochagabia', 'Arlyn', 'Arlyn', 'Ochagabia, Arlyn', 'Mansing', 'S', '1', 'FT4', 'Taguig City', 'Metro Manila', 'NCR', 'PHL', '10/30/1981', 'Alfonso D. Tan College', 'BSOA - Major in Office Management', '09215101084', 'pooh_ar123@yahoo.com', 'Leonora Subrabas', 'Mother', '09215566619', '64151'),
(393, 'Pacinio', 'Nelle', 'Nelle', 'Pacinio, Nelle', 'Almocera', 'S', '1', 'FT4', 'Bogo City', 'Cebu', '7', 'PHL', '10/11/1998', 'Cebu Normal University', 'Bachelor of Secondary Education- English', '09974038190', 'nellelovegod@gmail.com', 'Melisa and Erwin Godornes', 'Parents', '09273244959/ 09086760636', '64152'),
(394, 'Paculba', 'Charlotte', 'Charlotte', 'Paculba, Charlotte', 'Deloso', 'S', '1', 'FT4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '6/6/1998', 'The University of Manila', 'BSBA - HDRM', '09357447116', 'charlottepaculba07@gmail.com', 'Estrellita D. Paculba', 'Mother', '09391297934', '64153'),
(395, 'Pan', 'Cheng Cheng', 'Esther', 'Pan, Esther', 'Na', 'S', '1', 'FT4', 'Cixi', 'Zhe Jiang', 'China', 'CHINA', '3/1/1997', 'Zhejiang Technical Institute of Economics', 'Logistics Management', '13884480562', '496000307@qq.com', 'Chen Zhen', 'Serving Brother', '13777838707', '64154'),
(396, 'Pante', 'Ana Maria Tel', 'Ana Maria', 'Pante, Ana Maria', 'Espela', 'S', '1', 'FT4', 'Bacoor', 'Cavite', '4A', 'PHL', '1/18/1997', 'Cavite State University', 'Business Management - Marketing', '09958901977', 'Ananapante@gmail.com', 'Rhomar Pante', 'Brother', '09753034245', '64155'),
(397, 'Petines', 'Angelica', 'Angelica', 'Petines, Angelica', 'Pansoy', 'S', '1', 'FT4', 'Valenzuela City', 'Metro Manila', 'NCR', 'PHL', '3/20/1997', 'Pamantasan ng Lungsod ng Valenzuela', 'BSBA Human Resources Dvt. Mgt.', '09218630272', 'anggepetine@gmail.com', 'Crispin Petines', 'Father', '09773903982 / 09356732399', '64156'),
(398, 'Prongco', 'Jonnafe Mae', 'Jonnafe', 'Prongco, Jonnafe', '', 'S', '1', 'FT4', 'General Santos City', 'South Cotabato', '12', 'PHL', '3/29/1993', 'Notre Dame of Dadiangas University', 'BSEd - English', '09289351881', 'jprongco2@gmail.com', 'Lorefe A. Prongco', 'Mother', '09460439712', '64157'),
(399, 'Rama', 'Gracelyn Mae', 'Gracelyn', 'Rama, Gracelyn', 'D.', 'S', '1', 'FT4', 'Dinas', 'Zamboanga Del Sur', '9', 'PHL', '6/22/1993', 'JHCSC', 'BSIT', '09482019168', '', 'Kim Codia', 'Elder', '09076199749', '64158'),
(400, 'Ramil', 'Ma. Meledine', 'Meledine', 'Ramil, Meledine', 'Sedenio', 'S', '1', 'FT4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '1/4/1998', 'Quezon City Polytechnic University', 'BS Entrepreneurship', '09195602992', 'mariameledineramil@yahoo.com', 'Dina Ramil', 'Mother', '09274020605', '64159'),
(401, 'Salapas', 'Angelika', 'Angelika', 'Salapas, Angelika', 'Alocello', 'S', '1', 'FT4', 'Zamboanga City', 'Zamboanga Del Sur', '9', 'PHL', '10/22/1997', 'Western Mindanao State University', 'BS Biology', '09066860267/ 09089234565', 'salapasangelika @gmail.com', 'Margie Salapas', 'Sister', '09268410609', '64161'),
(402, 'Salingay', 'Jie Ann', 'Jie Ann', 'Salingay, Jie Ann', 'Baco', 'S', '1', 'FT4', 'Aloran', 'Misamis Occidental', '10', 'PHL', '8/13/1997', 'Western Mindanao State University', 'BSED English', '09382321825', '', 'Alma B. Salingay', 'Mother', '09308588220', '64162'),
(403, 'Salvatierra', 'Abbie Joyce', 'Abbie Joyce', 'Salvatierra, Abbie Joyce', 'Cruz', 'S', '1', 'FT4', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '1/11/1998', 'University of Manila', 'BS Computer Science', '09753663134', 'joycesalvatierra16@yahoo.com', 'Mary Grace Abello ', 'Sister in Christ', '09229044983', '64163'),
(404, 'Salvatierra', 'Abbie Joy', 'Abbie Joy', 'Salvatierra, Abbie Joy', 'Cruz', 'S', '1', 'FT4', 'Manila City', 'Metro Manila', 'NCR', 'PHL', '1/11/1998', 'University of Manila', 'BS Computer Science', '09154886749', 'abbie.salvatierra@yahoo.com', 'Mary Grace Abello ', 'Serving One', '09229044983', '64164'),
(405, 'Sayles', 'Edelyn', 'Edelyn', 'Sayles, Edelyn', 'Balase', 'S', '1', 'FT4', 'Aloran', 'Misamis Occidental', '10', 'PHL', '3/20/1994', 'Western Mindanao State University', 'BSED English', '09503381223', 'saylesedelun@yahoo.com', 'Phoebe Sayles', 'Mother', '09267333872', '64166'),
(406, 'Sinining', 'Mary Rose', 'Mary Rose', 'Sinining, Mary Rose', 'Maderaje', 'S', '1', 'FT4', 'Bacolod City', 'Negros Occidental', '6', 'PHL', '7/9/1997', 'Carlos Hilado Memorial State College', 'BS Office Administration', '09469013818', 'marygracesenining@gmail.com', 'Ma. Robilyn C. Lagare', 'Spiritual Mother', '09433676564', '64168'),
(407, 'Solis', 'Cristy', 'Cristy', 'Solis, Cristy', 'Villacruz', 'S', '1', 'FT4', 'Marawi City', 'Lanao del Sur', 'ARMM', 'PHL', '3/7/1996', 'Mindanao State University Main Campus - Marawi City', 'BS Social Work', '09461311637', 'solic_cristy@yahoo.com', 'Harley V. Solis Jr. ', 'Brother', '+966503585703', '64169'),
(408, 'Tabuco', 'Mechel', 'Mechel', 'Tabuco, Mechel', 'Pasco', 'S', '1', 'FT4', 'Imelda', 'Zamboanga Sibugay', '9', 'PHL', '6/23/1997', 'Western Mindanao State University - IESU', 'Bachelor of Arts in Political Science', '09059182852', '', 'Meldred Tabuco', 'Sister', '09353668838', '64171'),
(409, 'Tano', 'Giselle Joy', 'Giselle', 'Tano, Giselle', 'Balagbis', 'S', '1', 'FT4', 'Lapu-lapu City', 'Cebu', '7', 'PHL', '9/30/1996', 'University of San Carlos - Downtown Campus', 'Management Accounting', '09332687145', 'gslljtn451@gmail.com', 'Rebecca Tano', 'Mother', '09236229213', '64172'),
(410, 'Ula', 'Sherea', 'Sherea', 'Ula, Sherea', 'Urbano', 'S', '1', 'FT4', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '9/3/1996', 'Polytechnic University of the Philippines', 'BSIT', '09272555520', 'usherea@yahoo.com', 'Robert and Serina Ula', 'Parents', '09296894698 / 09081732892', '64174'),
(411, 'Ursal', 'Bernadeth', 'Bernadeth', 'Ursal, Bernadeth', 'Tequin', 'S', '1', 'FT4', 'Bogo City', 'Cebu', '7', 'PHL', '9/27/1995', 'Cebu Technological University', 'BSED - TLE', '09365966485', 'bernadeth.ursal@yahoo.com', 'Maria T. Ursal', 'Mother', '0936-075-1966', '64175'),
(412, 'Vega', 'Joje Margarette', 'Joje', 'Vega, Joje', 'Gabo', 'S', '1', 'FT4', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '10/23/1995', 'Ta?on College', 'BEED - GenEd', '09092063943', 'jojevega23@yahoo.com/ jojevega@gmail.com', 'Jeremy Vega', 'Father', '0923-616-6131', '64178'),
(413, 'Vega', 'Christine Mae', 'Christine', 'Vega, Christine', 'Gabo', 'S', '1', 'FT4', 'San Carlos City', 'Negros Occidental', '6', 'PHL', '10/13/1996', 'Central Philippine State University', 'Bachelor of Science in Criminology', '09973700750', 'blancotine02@gmail.com', 'Jeremy Vega', 'Father', '0923-616-6131', '64177'),
(414, 'Velasco', 'Madel', 'Madel', 'Velasco, Madel', 'Ancero', 'S', '1', 'FT4', 'Bogo City', 'Cebu', '7', 'PHL', '5/30/1995', 'Cebu Technological University', 'BSED - TLE', '09051363776', 'madelle.velasco@yahoo.com', 'Julita A. Velasco', 'Mother', '0997-882-8475', '64179'),
(415, 'Villanueva', 'Midan', 'Midan', 'Villanueva, Midan', 'Mira', 'S', '1', 'FT4', 'Molave', 'Zamboanga Del Sur', '9', 'PHL', '1/20/1987', 'Western Mindanao State University', 'BEED', '09465158667', 'midanvillanueva@gmail.com', 'Pacita M. Villanueva', 'Mother', '0946-725-6855', '64181'),
(416, 'Weng', 'Ruo Jia', 'Hellen', 'Weng, Hellen', '', 'S', '1', 'FT4', 'New Taipei City', 'Taiwan', 'Taiwan', 'TAIWAN', '7/30/1993', 'TamKang University', 'Bachelor of Arts', '886-923806801', 'hellen820730@gmail.com', 'Weng, Ting I', 'Father', '886-933833043', '64182'),
(417, 'Yecyec', 'Gether', 'Gether', 'Yecyec, Gether', 'Exclamado', 'S', '1', 'FT4', 'Tagbilaran City', 'Bohol', '7', 'PHL', '3/2/1996', 'University of Bohol', 'BS Pharmacy', '09075012604', 'geth.godman08@yahoo.com', 'Maxilinoa Yecyec', 'Mother', '0910-270-3430', '64184'),
(418, 'Montecalbo', 'Aizel', 'Aizel', 'Montecalbo, Aizel', 'Antano', 'S', '1', 'FT3', 'Sindangan', 'Zamboanga del Norte', '9', 'PHL', '10/17/1995', 'Jose Rizal Memorial State University - Dapitan', 'BS HRM', '09072938174', 'Aizelantanomontecalbo@gmail.com', 'Pedelia Montecalbo', 'Mother', '09559909581', '64148'),
(419, 'Abando', 'Jean Ashley', 'Ashley', 'Abando, Ashley', 'Guanzon', 'S', '1', 'FT1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '9/20/1998', 'rizal technological university', 'bs-computer education', '9334391583', 'abandojajay@yahoo.com', 'arruro a.abando', 'father', '9334391583', '671001'),
(420, 'Aclao', 'Jee-lynn', 'Jee-lynn', 'Aclao, Jee-lynn', 'Vega', 'S', '1', 'FT1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '10/19/1998', 'misamis university ozamis city', 'bs-medical technology', '9382679347', 'aclaojeelynn@gmail.com', 'lueviminda v.aclao', 'mother', '09053405358', '671002'),
(421, 'Aragon', 'Leslie', 'Leslie', 'Aragon, Leslie', 'Bulan', 'S', '1', 'FT1', 'Mariveles ', 'Bataan', 'III', 'PHL', '9/26/1997', 'polytechnic university of philippines-bataan', 'bsed-english', '9305636391', '', 'artenia aragon', 'mother', '09100351895', '671004'),
(422, 'Argawanon', 'Jehan Marie', 'Jehan', 'Argawanon, Jehan', 'Montecalvo', 'S', '1', 'FT1', 'Bogo', 'Cebu', 'VII', 'PHL', '12/6/1998', 'cebu normal university', 'bsed-mapeh', '9995106311', 'jhanargawanon@gmail.com', 'analiza m.argawanon', 'mother', '09123662696/09123316840', '671005'),
(423, 'Bagay', 'Decelyn', 'Decelyn', 'Bagay, Decelyn', 'Cali?ahan', 'S', '1', 'FT1', 'Margosatubig', 'Zamboanga Del Sur', 'IX', 'PHL', '10/17/1998', 'saint columban college', 'bsba-operation management', '9301298973', 'dess123bagay@gmail.com', 'wenilyn bagay', 'sister', '09109141360', '671006'),
(424, 'Balacuit', 'Pearl Zoe', 'Pearl', 'Balacuit, Pearl', 'Embate', 'S', '1', 'FT1', 'Balingasag', 'Misamis oriental', 'X', 'PHL', '6/3/1999', 'misamis oriental institute of science&technology', 'bed', '9286212934', 'pearlbalacuit@yahoo.com', 'virgilio j.balaguit', 'father', '09185915232', '671007'),
(425, 'Balacuit', 'Zoe Shullamite', 'Zoe', 'Balacuit, Zoe', 'Embate', 'S', '1', 'FT1', 'Balingasag', 'Misamis oriental', 'X', 'PHL', '6/3/1999', 'misamis oriental institute of science&technology', 'bed', '9161500223', 'balacuitzoeshullamite@yahoo.com', 'virgilio j.balaguit', 'father', '09185915232', '671008'),
(426, 'Bibit', 'Shekinah Zildred Sam ', 'Shekinah', 'Bibit, Shekinah', 'Soliman', 'S', '1', 'FT1', 'Lucena City', 'Quezon Province', 'X', 'PHL', '10/10/1998', 'southern luzon state unicersity', 'bs-nursing', '9464861771', 's2sbits@gmail.com', 'saras zila bibit', 'sister', '09664597479', '671009'),
(427, 'Broce', 'Jonnah Kate', 'Kate', 'Broce, Kate', 'Libuton', 'S', '1', 'FT1', 'Sta. Maria', 'Bulacan', 'III', 'PHL', '7/29/1994', 'bulacan state unicersity', 'bsed-english', '9324064754', 'jonnahagodmaninchrist@gmail.com', 'joanne libuton', 'aunt', '09238198885', '671010'),
(428, 'Bumohya', 'Marian', 'Marian', 'Bumohya, Marian', 'De Guzman', 'S', '1', 'FT1', 'Calapan City', 'Oriental Mindoro', 'IV-B', 'PHL', '9/14/1998', 'batangas state unicersity main I', 'bs-pshchology', '9668217363', 'bumohyamarian@gmail.com', 'constantine bumohya', 'father', '09958848914', '671011'),
(429, 'Buot', 'Sandra Faith', 'Sandra', 'Buot, Sandra', 'Erejer', 'S', '1', 'FT1', 'Consolacion', 'Cebu', 'VII', 'PHL', '6/4/1996', 'up-cebu', 'bs-biology', '9426787490', 'sebuot@up.edu.ph', 'guillerma e.buot', 'mother', '09995589643', '671012'),
(430, 'Caliso', 'Nelia', 'Nelia', 'Caliso, Nelia', 'Besirel', 'S', '1', 'FT1', 'Dipolog City', 'Zamboanga Del Norte ', 'IX', 'PHL', '10/11/1998', 'jhcsc', 'bsed-english', '9098373133', '', 'elizbeth d.tumarong', 'cousion', '09489450458', '671013'),
(431, 'Calo', 'Angel Keziah', 'Keziah', 'Calo, Keziah', 'Ticmon', 'S', '1', 'FT1', 'Butuan City', 'Agusan Del Norte', 'XIII', 'PHL', '12/18/1998', 'father saturnino urias university', 'bs-accountancy', '9484749557', 'angelkez41@gmail.com', 'marissa t.calo', 'mother', '09306298439', '671014'),
(432, 'Cambangay', 'Jackielou', 'Jackielou', 'Cambangay, Jackielou', 'Ma?amosa', 'S', '1', 'FT1', 'Cagayan De Oro City', 'Misamis Oriental', 'X', 'PHL', '3/9/1999', 'phinma-cagayan de oro college', 'early childrenhood education', '9366498120', 'kielcambangay@gmail.com', 'uriel g.cambangay', 'father', '09355453642', '671015'),
(433, 'Ca?eda', 'Chesterly', 'Chesterly', 'Ca?eda, Chesterly', 'Belhot', 'S', '1', 'FT1', 'Tubod ', 'Lanao Del Norte', 'X', 'PHL', '3/30/1998', 'mindanao state university-iligan institute of technology', 'ab history', '9365532617', 'cchesterly@gmail.com', 'chanler Ca?eda', 'sister', '09758951419', '671016'),
(434, 'Canlas', 'Myvilene', 'Myvilene', 'Canlas, Myvilene', 'Cabanela', 'S', '1', 'FT1', 'Makati  City', 'Metro Manila', 'NCR', 'PHL', '12/27/1991', 'western mindanao state university', 'bs-accountancy', '', '', '', '', '', '671017'),
(435, 'Cari', 'Anna Mae', 'Anna Mae', 'Cari?o, Anna Mae', 'Cari', 'S', '1', 'FT1', 'San Fernando City', 'La Union', 'I', 'PHL', '6/22/1993', 'la finn''s scholastica', 'bs-hm', '9476582820', 'carinoannamae@gmail.com', 'lovblla aban', 'sister in christ', '09232737238', '671018'),
(436, 'Casis', 'Rechell', 'Rechell', 'Casis, Rechell', 'Culanag ', 'S', '1', 'FT1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '4/21/1993', 'university of cebu-banilao campus', 'bs-tourism', '9167393451', 'rechellcasis93@gmail', 'sabino casis', 'father', '09327710797', '671019'),
(437, 'Casuyac', 'Mary Joy', 'Mary Joy', 'Casuyac, Mary Joy', 'Jemera', 'S', '1', 'FT1', 'Tukuran', 'Zamboanga Del Sur', 'IX', 'PHL', '11/28/1998', 'saint columban college', 'bsep-tle', '9301356884', 'mj.casuyac@gmail.com', 'rosemarie j.casuyac', 'mother', '09300455893', '671020'),
(438, 'Catalu', 'Ghey Ann', 'Ghey Ann', 'Catalu?a, Ghey Ann', 'Guiegera', 'S', '1', 'FT1', 'Brooke''s Point', 'Palawan', 'IV-B', 'PHL', '11/3/1998', 'palawan state university', 'bsed-english', '9559568503', '', 'gedeon d.Catalu', 'father', '', '671021'),
(439, 'Culanag', 'Le-shaidda', 'Le-shaidda', 'Culanag, Le-shaidda', 'Lazaro', 'S', '1', 'FT1', 'Mariveles ', 'Bataan', 'III', 'PHL', '1/27/1998', 'polytechnic university of philippines-bataan', 'bsed-english', '9383467894', 'leshaiddaculanag32@gmail.com', 'lea l.culanag', 'mother', '09483782256', '671022'),
(440, 'Cuming', 'Sheila Mae', 'Sheila Mae', 'Cuming, Sheila Mae', 'Gabito', 'S', '1', 'FT1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '12/21/1996', 'western mindanao state university', 'bsed-filipino', '9078148917', '', 'arnold&febe cuming', 'parents', '09071163064/09126047167', '671023'),
(441, 'Daguman', 'Crystal Grace', 'Crystal', 'Daguman, Crystal', 'Dela Cerna', 'S', '1', 'FT1', 'Zamboanga City', 'Zamboanga Del Sur', 'IX', 'PHL', '9/14/1998', 'western mindanao state university', 'b-elementry education', '9974413178', 'crystaldaguman@yahoo.com', 'ranulfo daguman', 'father', '09175713635', '671024'),
(442, 'Dalagan', 'Recel', 'Recel', 'Dalagan, Recel', 'Fulgencio', 'S', '1', 'FT1', 'Carmen', 'Bohol', 'VII', 'PHL', '11/15/1997', 'trinidad municipal college', 'bs-office ad.', '948452915', 'dalaganrecel197@gmail.com', 'rufina dalagan', 'mother', '09489892463', '671025'),
(443, 'Deapera', 'Sherlyn', 'Sherlyn', 'Deapera, Sherlyn', 'Pantoha', 'S', '1', 'FT1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '6/7/1998', 'southern luzon state unicersity', 'bs-preschool education', '9462443757', 'deaperasherlynl@gmail', 'elizabeth p.deapera', 'mother', '09098619693', '671026'),
(444, 'Deluna', 'Perlyn', 'Perlyn', 'Deluna, Perlyn', 'Baquiro', 'S', '1', 'FT1', 'Dipolog City', 'Zamboanga Del Norte', 'IX', 'PHL', '2/1/1998', 'jose rizal memorial state unicersity-dipolog', 'bsed', '9099017300', '', 'elizabeth d.tumarong', 'sister', '09489450458', '671027'),
(445, 'Dioqui', 'Evelyn', 'Evelyn', 'Dioqui?o, Evelyn', 'Labitad', 'S', '1', 'FT1', 'Lala', 'Lanao Del Norte', 'X', 'PHL', '3/21/1997', 'north central mindanao college', 'bs-general education', '9169941670', '', 'elizabeth d.ballesteros', 'sister', '09173096623', '671028'),
(446, 'Dudoyan', 'Lea', 'Lea', 'Dudoyan, Lea', 'Gumawid', 'S', '1', 'FT1', 'Dumingag', 'Zamboanga Del Sur', 'IX', 'PHL', '10/19/1997', 'university of southeastern philippines', 'bs-entrepreneurship', '9104094994', 'leadudoyan19@gmail.com', 'mr&mrs.dino dudoyan', 'parents', '09488426210', '671029'),
(447, 'Dulawan', 'Grail', 'Grail', 'Dulawan, Grail', 'Bantuwag', 'S', '1', 'FT1', 'Kasibu', 'Nueva Vizcaya', 'II', 'PHL', '11/18/1993', 'saint mary''s university', 'bs-civil engineering', '9179493528', 'dulawan.grail@gmail.com', 'jenifer ansibey', 'sister', '09158529671', '671030'),
(448, 'Enario', 'Little Mae', 'Little', 'Enario, Little', 'Pacatang', 'S', '1', 'FT1', 'Kumalarang', 'Zamboanga Del Sur', 'IX', 'PHL', '11/17/1994', 'mindanao state university buug campus', 'bs-agronomy', '9979012576', 'elittlemae@yahoo.com', 'medeline enario', 'mother', '09365756112', '671031'),
(449, 'Esteban', 'Marianne', 'Marianne', 'Esteban, Marianne', 'Langgao', 'S', '1', 'FT1', 'Mariveles ', 'Bataan', 'III', 'PHL', '10/25/1997', 'University of Northern Philippines', 'bsit-electronics tech', '09363546529', '', 'oliva asuncion', 'Mother', '09777841785', '671032'),
(450, 'Eugenio', 'Jona Liezl', 'Jona Liezl', 'Eugenio, Jona Liezl', 'Ancheta', 'S', '1', 'FT1', 'San Mariano', 'Isabela', 'II', 'PHL', '10/14/1987', 'quirino state university campus', 'bs-agri', '9273720646', '', 'aida valdez', 'aunt', '09560962965', '671033'),
(451, 'Garcia', 'Hayrine', 'Hayrine', 'Garcia, Hayrine', 'Buhiyan', 'S', '1', 'FT1', 'Caloocan', 'Metro Manila', 'NCR', 'PHL', '3/10/1998', 'university of caloocan', 'bpa-public administration', '9152611593', 'hayrine.garcia@yahoo.com', 'hernando garcia', 'father', '', '671034'),
(452, 'Gomo', 'Pamela', 'Pamela', 'Gomo, Pamela', 'Prado', 'S', '1', 'FT1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '9/23/1998', 'southern luzon state unicersity', 'bsed-pre-education', '9101698015', 'pamelagomo@gmail.com', 'yolando p.gomo', 'mother', '09299599598', '671035'),
(453, 'Hokia', 'Edlyn Julianne', 'Edlyn', 'Hokia, Edlyn', 'Chua', 'S', '1', 'FT1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '5/10/1997', 'up-diliman', 'bs-civil engineering', '9985544416', 'mai_hokia@yahoo.com', 'jeanne c.hokia', 'mother', '09177924894/09232400143/3724269', '671036'),
(454, 'Ibardelosa', 'Charlene May', 'Charlene', 'Ibardelosa, Charlene', 'Villapando', 'S', '1', 'FT1', 'Lucban ', 'Quezon Province', 'IV-A', 'PHL', '4/27/1998', 'southern luzon state unicersity', 'beed-sped', '9466778995', 'ibardelosacharlene@gmail.com', 'mylene v.ibardelosa', 'mother', '09003453027', '671037'),
(455, 'Inocian', 'Adorny', 'Adorny', 'Inocian, Adorny', 'Bontilao', 'S', '1', 'FT1', 'Cebu City', 'Cebu', 'VII', 'PHL', '11/7/1998', 'cebu normal university', 'beed-sped', '9279526008', 'adornyinocian@gmail.com', 'jocelyn b.inocian', 'mother', '09205234432', '671038'),
(456, 'Jerusalem', 'Ann Jennica', 'Jennica', 'Jerusalem, Jennica', 'Lavente', 'S', '1', 'FT1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '12/15/1993', 'icct college foundation inc', 'bs-information technology', '9569680114', 'annjennicajerusalem@gmail.com', 'jessica jerusalem', 'mother', '', '671039'),
(457, 'Juan', 'Xyrelle', 'Xyrelle', 'Juan, Xyrelle', 'Palma', 'S', '1', 'FT1', 'Sto. Domingo', 'Nueva Ecija', 'III', 'PHL', '12/17/1999', 'central luzon state unicersity', 'bs-agriculture', '9458274909', 'xyrlljuan@gmail.com', 'teresita p.juan', 'mother', '09162132353', '671040'),
(458, 'La', 'Teresa', 'Teresa', 'La?a, Teresa', 'Tagpuno', 'S', '1', 'FT1', 'Cebu City', 'Cebu', 'VII', 'PHL', '2/16/1998', 'cebu technological university', 'beed', '9309027678', 'teresalana.26@gmail.com', 'jerna lomocso', 'sister in flesh', '09356080794/09284894240', '671041'),
(459, 'Landao', 'Ma. Rowena', 'Ma. Rowena', 'Landao, Ma. Rowena', 'Dimaala', 'S', '1', 'FT1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '10/28/1999', 'philippine normal university', 'bs-filipino education', '9060923537', 'landaomarowenq@gmail.com', 'rowena landao', 'mother', '09392076272', '671042'),
(460, 'Liwanag', 'Heber Janna', 'Janna', 'Liwanag, Janna', 'Dorol', 'S', '1', 'FT1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '8/21/1999', 'mapua university', 'bs-chemical engineering', '9385107364', 'hbrjnnlwng@gmail.com', 'nazario c.liwanag', 'father', ' ', '671043'),
(461, 'Luarez', 'Guerlain Kate', 'Guerlain', 'Luarez, Guerlain', '', 'S', '1', 'FT1', 'San Francisco', 'Agusan Del Sur', 'XIII', 'PHL', '9/25/1996', 'caraga state university', 'bs-biology', '9483160154', 'luarezguerlainkate@gmail.com', 'luarez virgel.m', 'father', '091010 51198', '671044'),
(462, 'Maceda', 'Haira Mae', 'Haira', 'Maceda, Haira', 'Garcia', 'S', '1', 'FT1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '5/13/1995', 'father saturnino urias university', 'ab-english lanuage', '09123434539', '', 'mel joseph r.maceda', 'husband', '09991509071', '671045'),
(463, 'Maceda', 'Shulamite Mirah Rose', 'Shulamite', 'Maceda, Shulamite', '', 'S', '1', 'FT1', 'Pasig', 'Metro Manila', 'NCR', 'PHL', '6/12/1998', 'new era university', 'b-elementry education', '9456012560', 'shulamitemrrmaceda@gmail.com', 'grace joy r.maceda', 'mother', '09065255719', '671046'),
(464, 'Maghinay', 'Jehdalie', 'Jehdalie', 'Maghinay, Jehdalie', 'Wate', 'S', '1', 'FT1', 'La Libertad', 'Zamboanga Del Norte', 'IX', 'PHL', '9/14/1994', 'jose rizal memorial state unicersity', 'b-elementry education', '9363251769', '', 'librado i.wate', 'grandfather', '09461460767', '671047'),
(465, 'Manlupig', 'Mary Grace', 'Grace', 'Manlupig, Grace', 'Tagotongan', 'S', '1', 'FT1', 'Taguig', 'Metro Manila', 'NCR', 'PHL', '1/10/1997', 'MSU- IIT', 'BEED-English', '09309555941', '', 'vanessa agraba t.manlupig', 'sister', '09304535025', '671048'),
(466, 'Marco', 'Christine Ann', 'Christine Ann', 'Marco, Christine Ann', 'Dontar', 'S', '1', 'FT1', 'Sindangan', 'Zamboanga Del Norte', 'IX', 'PHL', '1/14/1998', 'saint joseph college of sindangan inc', 'bsed-english', '09558900680', '', 'ana d.marco&grace d.chiong', 'Mother&aunt', '09368882402/09173222286', '671049'),
(467, 'Marquez', 'Chosen', 'Chosen', 'Marquez, Chosen', 'Aranas', 'S', '1', 'FT1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '3/18/1997', 'central mindanao university', 'bs-accountancy', '9265587310', 'chosenmarquez@gmail.com', 'marivic marqyez', 'mother', '09301547293', '671050'),
(468, 'Mendoza', 'Pamela', 'Pamela', 'Mendoza, Pamela', 'Chavez', 'S', '1', 'FT1', 'Danao City', 'Cebu', 'VII', 'PHL', '2/12/1995', 'collegio de san antonio de padua de la salle supervised sch.', 'b-second education-science', '9296282335', '', 'catalino p.mendoza', 'father', '09973441950/09262804172', '671051'),
(469, 'Mole', 'Honeybeth', 'Honeybeth', 'Mole?o, Honeybeth', '', 'S', '1', 'FT1', 'Malabon City', 'Metro Manila', 'NCR', 'PHL', '4/25/1999', 'city of malabon university', 'bse-english', '9971484224', 'beth.moleno@gmail.com', 'linnie Mole', 'mother', '09553201994/09353630509', '671052'),
(470, 'Obod', 'Ericka Jane', 'Ericka Jane', 'Obod, Ericka Jane', 'Aba', 'S', '1', 'FT1', 'Ozamiz City', 'Misamis Occidental', 'X', 'PHL', '9/14/1996', 'colegio de san francisco javier', 'bs-social work', '9387346493', '', 'rebecca obod', 'mother', '09087851302', '671053'),
(471, 'Olivar', 'Romelee', 'Romelee', 'Olivar, Romelee', 'Parojinog', 'S', '1', 'FT1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '12/19/1997', 'jose rizal memorial state unicersity', 'bs-civil engineering', '9261836818', 'oromelee9@gmail.com', 'romeo c.olivar', 'father', '09431392253', '671054'),
(472, 'Omanyag', 'Mildred', 'Mildred', 'Omanyag, Mildred', 'Acla', 'S', '1', 'FT1', 'La Libertad', 'Zamboanga Del Norte', 'IX', 'PHL', '12/28/1994', 'andres bonifacio college', 'bsed-mathematics', '9489390335', 'omanyag 22@gmail.com', 'jean a.dma', 'sister', '09465003765/09091386139', '671055'),
(473, 'Pacatang', 'Fatima', 'Fatima', 'Pacatang, Fatima', 'udtohan', 'S', '1', 'FT1', 'Tagbilaran', 'Bohol', '7', 'PHL', '5/13/1999', 'bohol island state university', 'bs-entrepreneurship', '09484521798', '', 'aneeita u.pacatang', 'mother', '09462384726', '671056'),
(474, 'Palarca', 'Cyril ', 'Cyril ', 'Palarca, Cyril ', 'Vendollo', 'S', '1', 'FT1', 'Mu', 'Nueva Ecija', 'III', 'PHL', '12/4/1995', 'central luzon state unicersity', 'bs-agriculture', '9499917428', 'cypalarca04@gmail', 'gemma palarch', 'mother', '09499917428', '671057'),
(475, 'Panganoron', 'Mafeth Shen', 'Mafeth', 'Panganoron, Mafeth', '', 'S', '1', 'FT1', 'Iligan City', 'Misamis Occidental', 'X', 'PHL', '3/21/1997', 'mindanao state university-iligan institute of technology', 'bstte-orafting', '9269687613', '', 'nickel jean s.lagare', 'spiritual mother', '09128001388', '671058'),
(476, 'Papa', 'Rejoice', 'Rejoice', 'Papa, Rejoice', 'Ucab', 'S', '1', 'FT1', 'Cagayan De Oro City', 'Misamis Oriental', 'X', 'PHL', '7/19/1998', 'Xavier Ateneo De Cagayan University', 'bs-information system', '9262332645', '', 'katherine u.papa', 'mother', '09069712992', '671059'),
(477, 'Perez', 'Abegail', 'Abegail', 'Perez, Abegail', 'Carrasco', 'S', '1', 'FT1', 'Gapan City', 'Nueva Ecija', 'III', 'PHL', '6/11/1994', 'neust&art', 'bse english&art', '9150835308', 'abegailcarrascoperez', 'athena ramirez', 'sister in christ', '09972915369', '671060'),
(478, 'Perocho', 'Sheckena Grace', 'Sheckena', 'Perocho, Sheckena', 'Baconawa', 'S', '1', 'FT1', 'Makati  City', 'Metro Manila', ' NCR', 'PHL', '8/17/1998', 'negros oriental state university', 'bs-office system mngt', '9068682489', 'sheckenagrace@gmail.com', 'jennifer b.perocho', 'mother', '09558390699', '671061'),
(479, 'Pimentel', 'Irene', 'Irene', 'Pimentel, Irene', 'Idio', 'S', '1', 'FT1', 'Mu', 'Nueva Ecija', 'III', 'PHL', '12/27/1997', 'central luzon state unicersity', 'bsed-social studies', '9459659473', 'pimentelaireen@gmail.com', 'irene i.pimentel', 'mother', '09338132627', '671062'),
(480, 'Poliran', 'Angelika', 'Angelika', 'Poliran, Angelika', 'Acaaso', 'S', '1', 'FT1', 'Oroquieta City', 'Misamis Occidental', 'X', 'PHL', '5/4/1999', 'zambonga state college of marine sciences and technology', 'bs-agriculture', '9092167690', 'angelikapoliranika@gmail.com', 'mario m.poliran', 'father', '09480823221', '671063'),
(481, 'Pungtan', 'Arnoliza', 'Arnoliza', 'Pungtan, Arnoliza', 'Conahap', 'S', '1', 'FT1', 'Buug ', 'Zamboanga Sibugay', 'IX', 'PHL', '7/7/1998', 'mindanao state university buug campus', 'bsed-filipino', '9093359079', 'arnolizapungtan@gmail.com', 'arnold pungtan sr.', 'father', '09752959800', '671064'),
(482, 'Rivera', 'Alma', 'Alma', 'Rivera, Alma', 'Enerio', 'S', '1', 'FT1', 'Cebu City', 'Cebu', 'VII', 'PHL', '6/21/1989', 'university of cebu', 'english', '9108143061', 'arumasan45@gmail.c0m', 'jemima rivera', 'mother', '09423711839', '671065'),
(483, 'Rivera', 'Reena Xandra', 'Xandra', 'Rivera, Xandra', 'Reyes', 'S', '1', 'FT1', 'Quezon City', 'Metro Manila', 'NCR', 'PHL', '2/23/1995', 'new era university', 'ab-masscommunication', '9203434985', 'xnanahrivera28@gmail.com', 'asuncion dorol retes', 'mother', '09214931070', '671066'),
(484, 'Samson', 'Maria Rose', 'Maria Rose', 'Samson, Maria Rose', 'Aganan', 'S', '1', 'FT1', 'Milagros', 'Masbate', 'V', 'PHL', '3/15/1994', 'dr.emilio b.espinosa,sr.memorial state college of agriculture&technology', 'bse-english', '9272360342', 'mariarosesamson@gmail.com', 'heide a.samson', 'mother', '09303464094', '671067'),
(485, 'Sanchez', 'Janssen', 'Janssen', 'Sanchez, Janssen', 'Galacio', 'S', '1', 'FT1', 'Malaybalay', 'Bukidnon', 'X', 'PHL', '6/20/1998', 'liceo de cagayan university', 'bs-medical technology', '9750440685', 'patetsanchez21@gmail.com', 'arlene g.sanchez', 'mother', '09178876128', '671068'),
(486, 'Sarsalejo', 'Archeneth', 'Archeneth', 'Sarsalejo, Archeneth', 'Daiz', 'S', '1', 'FT1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '1/30/1997', 'city of malabon university', 'bse-english', '9979014862', 'archeneth.sarsalejo97', 'deborah cabiles', 'aunt', '09338101272', '671069'),
(487, 'Senobin', 'Eden Bethlehem', 'Bethlehem', 'Senobin, Bethlehem', 'Tumatoy', 'S', '1', 'FT1', 'Valenzuela', 'Metro Manila', 'NCR', 'PHL', '6/14/1999', 'our lady of fatima university', 'bsit', '9979552246', 'edensenobin@gmail.com', 'jocelyn senobin', 'mother', '09753984294', '671070'),
(488, 'Servas', 'Deaza  May', 'Deaza  May', 'Servas, Deaza  May', 'Luzano', 'S', '1', 'FT1', 'Panaon', 'Misamis Occidental', 'X', 'PHL', '5/8/1998', 'jose rizal memorial state university', 'bsed-social studies', '9077115799', 'servasdeaza09@gmail.com', 'danilo c.servas', 'father', '09465195469', '671071'),
(489, 'Suan', 'Jean', 'Jean', 'Suan, Jean', 'Madarimot', 'S', '1', 'FT1', 'Buug ', 'Zamboanga Sibugay', 'IX', 'PHL', '1/9/1998', 'mindanao state university buug campus', 'beed-gen-ed', '9267837639', 'jeansuan10@gmail.com', 'enriquita m.suan', 'mother', '09161184120', '671072'),
(490, 'Sumalinog', 'Yenyell', 'Yenyell', 'Sumalinog, Yenyell', 'Rodriguez', 'S', '1', 'FT1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '10/31/1996', 'university of cebu-lapu lapu and mandave', 'bs-elementary education', '9167761687', 'yenyellsumalinog@gmail.com', 'nenen sumalinog', 'mother', '09420031349', '671073'),
(491, 'Sumaylo', 'Jaysel', 'Jaysel', 'Sumaylo, Jaysel', 'Bacu', 'S', '1', 'FT1', 'Mandaue City', 'Cebu', 'VII', 'PHL', '1/11/1994', 'university of cevu-banilao', 'bsit', '9297311352', 'sjaysel@gmail.com', 'noemi/zaena sumaylo', 'sister', '09223584568/09223788245', '671074'),
(492, 'Tomimbang', 'Febe Joy', 'Febe', 'Tomimbang, Febe', 'Nini', 'S', '1', 'FT1', 'Tangub City', 'Misamis Occidental', 'X', 'PHL', '2/2/1998', 'mindanao state university-iligan institute of technology', 'bs-metallurgical engineering', '9556246140', 'febzki14@gmail.com', 'jimmt j.tomimbang', 'father', '09308911038', '671075'),
(493, 'Tumanda', 'Rose Ann', 'Rose Ann', 'Tumanda, Rose Ann', 'Anub', 'S', '1', 'FT1', 'Batuan', 'Bohol', 'VII', 'PHL', '7/26/1997', 'batuan college inc.', 'beed', '9098972764', 'roseanntumanda18@gmail.com', 'felicitas tumanda', 'mother', '09385141124', '671076'),
(494, 'Utleg', 'Anginette', 'Anginette', 'Utleg, Anginette', 'Tuliao', 'S', '1', 'FT1', 'Solsona', 'Ilocos Norte', 'I', 'PHL', '8/4/1997', 'Mariano Marcos State University', 'bs-electrical engineering', '9094118568', '', 'nestor tuliao', 'uncle', '09156518745', '671077'),
(495, 'Vasquez', 'Junabe', 'Junabe', 'Vasquez, Junabe', 'Geguera', 'S', '1', 'FT1', 'Taytay', 'Palawan', 'IV-B', 'PHL', '6/18/1997', 'Western Philippines University', 'bs-elementary education', '9350360766', '', 'abner p.vasquez', 'Father', '', '671078'),
(496, 'Vendicacion', 'Herzl Anne', 'Herzl Anne', 'Vendicacion, Herzl Anne', 'Albienda', 'S', '1', 'FT1', 'San Ildefonso', 'Bulacan', 'III', 'PHL', '12/13/1995', 'la consolacion college manila', 'bs-accountancy', '9156006956', 'herzlanne@gmail.com', 'analiza a.vendicacion', 'mother', '09338593994', '671079'),
(497, 'Verano', 'Abilyn', 'Abilyn', 'Verano, Abilyn', 'Terrible', 'S', '1', 'FT1', 'Malabon', 'Metro Manila', 'NCR', 'PHL', '9/18/1989', 'saint peter''s college-iligan city', 'bs-electrical engineering', '9498326330', 'v.abilyn@gmail', 'marlene terrible verano', 'mother', '09196031391', '671080'),
(498, 'X', 'Ruth', 'Ruth', 'X, Ruth', 'N/A', 'S', '1', 'FT1', 'Country X', 'N/A', 'N/A', 'X', '8/25/1989', '', 'ba-industried&tourism', '', '', 'bro.ezra', 'husband', '09183159569', '671081'),
(499, 'Yuba', 'Aprilyn', 'Aprilyn', 'Yuba, Aprilyn', 'Puri', 'S', '1', 'FT1', 'Malita', 'Davao Occidental', 'XI', 'PHL', '4/22/1996', 'southern philippines agri-business&marine&aguahe technology school', 'bs-agri-bussiness', '9354129439', '', 'eunice pepuual', 'aunt', '09066454929', '671083'),
(500, 'Zacal', 'Michelaine Rayl', 'Rayl', 'Zacal, Rayl', 'Cabaluna', 'S', '1', 'FT1', 'Lakewood', 'Zamboanga Del Sur', 'IX', 'PHL', '10/5/1998', 'jhcsc', 'bs-secondary education', '9484843548', 'zeeraylmianecabz@gmail.com', 'reylan m.zacal', 'father', '09300463362', '671084'),
(501, 'Pelarion', 'Shullamite', 'Shullamite', 'Pelarion, Shullamite', '', 'S', '1', 'FT1', 'Villadolia', 'Negros Occidental', '', 'PHL', '7/14/1998', 'la carlota city college', 'bsed-mapeh', '09273595969', '', 'ma.elena pelarion', 'mouther', '09091432394/09353576128', '671086'),
(502, 'Regasajo', 'Marah', 'Marah', 'Regasajo, Marah', '', 'S', '1', 'FT1', 'quezon', 'Bukidnon', 'X', 'PHL', '7/15/1993', 'quezon institute of technology', 'bs-elementary education', '09107266729', '', 'cristia r.salado', 'sibling', '09103353097', '671085');

-- --------------------------------------------------------

--
-- Table structure for table `userlevel`
--

CREATE TABLE IF NOT EXISTS `userlevel` (
`ID` int(11) NOT NULL,
  `LEVEL` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlevel`
--

INSERT INTO `userlevel` (`ID`, `LEVEL`) VALUES
(1, 'ADMIN'),
(2, 'WEEKEND'),
(3, 'LONG PROPAGATION'),
(4, '5 DAYS PROPAGATION');

-- --------------------------------------------------------

--
-- Table structure for table `visitationday`
--

CREATE TABLE IF NOT EXISTS `visitationday` (
`visitationday_id` int(11) NOT NULL,
  `day_schedule` varchar(10) NOT NULL,
  `day_abbreviation` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitationday`
--

INSERT INTO `visitationday` (`visitationday_id`, `day_schedule`, `day_abbreviation`) VALUES
(1, 'SUNDAY', 'S'),
(2, 'LORD''S DAY', 'LD'),
(3, 'MONDAY', 'M'),
(4, 'TUESDAY', 'T'),
(5, 'WEDNESDAY', 'W'),
(6, 'THURSDAY', 'Th'),
(7, 'FRIDAY', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `week`
--

CREATE TABLE IF NOT EXISTS `week` (
`ID` int(11) NOT NULL,
  `week` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `week`
--

INSERT INTO `week` (`ID`, `week`) VALUES
(1, '5 WEEKS'),
(3, 'Week 6'),
(4, 'WEEK 7'),
(5, 'WEEK 8'),
(6, 'WEEK 9'),
(7, 'WEEK 10'),
(8, 'WEEK 11'),
(9, 'WEEK 12'),
(10, 'WEEK 13'),
(11, 'WEEK 14'),
(12, 'WEEK 15'),
(13, 'WEEK 16'),
(14, 'WEEK 17'),
(15, 'Week 1'),
(16, 'Week 2'),
(17, 'Week 3'),
(18, 'Week 4'),
(19, 'Week 5');

-- --------------------------------------------------------

--
-- Table structure for table `weekendrpt`
--

CREATE TABLE IF NOT EXISTS `weekendrpt` (
`weekendrpt_id` int(11) NOT NULL,
  `contact_id` varchar(225) NOT NULL,
  `historyfeedback_id` varchar(225) NOT NULL,
  `acc_id` varchar(225) NOT NULL,
  `week_one` varchar(225) NOT NULL,
  `week_two` varchar(225) NOT NULL,
  `week_three` varchar(225) NOT NULL,
  `week_four` varchar(225) NOT NULL,
  `week_five` varchar(225) NOT NULL,
  `week_six` varchar(225) NOT NULL,
  `week_seven` varchar(225) NOT NULL,
  `week_eight` varchar(225) NOT NULL,
  `week_nine` varchar(225) NOT NULL,
  `week_ten` varchar(225) NOT NULL,
  `week_eleven` varchar(225) NOT NULL,
  `week_twelve` varchar(225) NOT NULL,
  `week_thirteen` varchar(225) NOT NULL,
  `week_fourteen` varchar(225) NOT NULL,
  `week_fifthteen` varchar(225) NOT NULL,
  `week_sixteen` varchar(225) NOT NULL,
  `week_seventeen` varchar(225) NOT NULL,
  `week_eighteen` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekendrpt`
--

INSERT INTO `weekendrpt` (`weekendrpt_id`, `contact_id`, `historyfeedback_id`, `acc_id`, `week_one`, `week_two`, `week_three`, `week_four`, `week_five`, `week_six`, `week_seven`, `week_eight`, `week_nine`, `week_ten`, `week_eleven`, `week_twelve`, `week_thirteen`, `week_fourteen`, `week_fifthteen`, `week_sixteen`, `week_seventeen`, `week_eighteen`) VALUES
(13, '54', '48', '38', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'MHL-MHL-MHL-MHL-MHL', '');

-- --------------------------------------------------------

--
-- Table structure for table `weekspropagation`
--

CREATE TABLE IF NOT EXISTS `weekspropagation` (
`id_weekprop` int(11) NOT NULL,
  `HOMESKNOCK` int(225) NOT NULL,
  `HOMESPREACH` int(225) NOT NULL,
  `PCONTACTED` int(225) NOT NULL,
  `RECEIVEDGOSPEL` int(225) NOT NULL,
  `GOPENFOLLOW` int(225) NOT NULL,
  `BROBAPTISM` int(225) NOT NULL,
  `SISBAPTISM` int(225) NOT NULL,
  `NEWHOMESMTG` int(225) NOT NULL,
  `TOTALHOMESMTG` int(225) NOT NULL,
  `TOTALPERSONHMTG` int(225) NOT NULL,
  `PVISITEDNOTHMEET` int(225) NOT NULL,
  `NSMALLGMTG` int(225) NOT NULL,
  `SMALLGMTGHELD` int(225) NOT NULL,
  `LOCALATTSMLMTG` int(225) NOT NULL,
  `LOCALSAINTSJOINPROP` int(225) NOT NULL,
  `MANHOURS` int(225) NOT NULL,
  `LTM` int(225) NOT NULL,
  `TEAMHOURS` int(225) NOT NULL,
  `Time_Submitted` text NOT NULL,
  `Time_Updated` text NOT NULL,
  `countlimitupt` int(6) NOT NULL,
  `accounts_id` int(225) NOT NULL,
  `historyfeedback_id` int(225) NOT NULL,
  `manipulate_but` varchar(22) NOT NULL,
  `readonly` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekspropagation`
--

INSERT INTO `weekspropagation` (`id_weekprop`, `HOMESKNOCK`, `HOMESPREACH`, `PCONTACTED`, `RECEIVEDGOSPEL`, `GOPENFOLLOW`, `BROBAPTISM`, `SISBAPTISM`, `NEWHOMESMTG`, `TOTALHOMESMTG`, `TOTALPERSONHMTG`, `PVISITEDNOTHMEET`, `NSMALLGMTG`, `SMALLGMTGHELD`, `LOCALATTSMLMTG`, `LOCALSAINTSJOINPROP`, `MANHOURS`, `LTM`, `TEAMHOURS`, `Time_Submitted`, `Time_Updated`, `countlimitupt`, `accounts_id`, `historyfeedback_id`, `manipulate_but`, `readonly`) VALUES
(8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 'disabled', 1),
(10, 14, 6, 63, 42, 24, 3, 5, 0, 1, 3, 4, 1, 1, 11, 1, 4, 11, 5, '01/12/2020 02:08:32 pm', '01/12/2020 02:37:21 pm', 0, 119, 48, 'disabled', 1),
(11, 279, 59, 181, 62, 0, 3, 6, 5, 2, 5, 4, 1, 1, 4, 3, 12, 30, 4, '01/12/2020 02:20:33 pm', '01/12/2020 11:07:29 pm', 0, 103, 48, 'disabled', 1),
(12, 33, 13, 71, 67, 35, 6, 8, 6, 3, 5, 3, 0, 0, 0, 3, 8, 24, 4, '01/12/2020 03:18:35 pm', '', 0, 93, 48, 'disabled', 1),
(13, 4, 1, 11, 9, 8, 1, 2, 3, 2, 3, 4, 2, 1, 2, 2, 3, 3, 4, '01/12/2020 03:21:28 pm', '', 0, 181, 48, 'disabled', 1),
(14, 0, 0, 29, 24, 13, 3, 4, 3, 3, 5, 2, 0, 0, 0, 2, 6, 44, 4, '01/12/2020 03:20:01 pm', '', 0, 51, 48, 'disabled', 1),
(15, 31, 15, 60, 30, 10, 1, 2, 5, 2, 3, 3, 2, 1, 3, 2, 6, 13, 5, '01/12/2020 03:26:21 pm', '', 0, 37, 48, 'disabled', 1),
(16, 9, 9, 70, 21, 5, 2, 5, 3, 3, 3, 3, 0, 2, 7, 4, 9, 8, 5, '01/12/2020 03:44:42 pm', '', 0, 112, 48, 'disabled', 1),
(17, 43, 22, 68, 39, 20, 2, 7, 5, 2, 2, 2, 0, 1, 11, 3, 4, 35, 5, '01/12/2020 03:44:16 pm', '', 0, 100, 48, 'disabled', 1),
(18, 25, 23, 126, 122, 34, 6, 5, 3, 2, 3, 2, 0, 2, 8, 3, 12, 21, 5, '01/12/2020 03:48:45 pm', '', 0, 44, 48, 'disabled', 1),
(19, 87, 27, 93, 43, 29, 1, 4, 7, 7, 5, 3, 0, 1, 12, 3, 10, 18, 5, '01/12/2020 03:48:04 pm', '01/12/2020 08:14:49 pm', 0, 79, 48, 'disabled', 1),
(20, 64, 26, 67, 59, 6, 5, 1, 2, 2, 5, 4, 0, 1, 5, 3, 11, 18, 6, '01/12/2020 03:48:40 pm', '', 0, 80, 48, 'disabled', 1),
(21, 70, 37, 106, 60, 21, 4, 8, 8, 3, 4, 2, 1, 1, 4, 1, 2, 8, 4, '01/12/2020 03:53:01 pm', '', 0, 144, 48, 'disabled', 1),
(22, 0, 0, 58, 54, 42, 6, 15, 5, 2, 4, 2, 0, 1, 11, 4, 8, 14, 3, '01/12/2020 03:59:33 pm', '01/12/2020 04:06:10 pm', 0, 114, 48, 'disabled', 1),
(23, 148, 17, 58, 31, 7, 2, 1, 7, 3, 4, 2, 2, 1, 6, 3, 5, 12, 5, '01/12/2020 03:58:25 pm', '', 0, 42, 48, 'disabled', 1),
(24, 15, 10, 76, 66, 2, 3, 16, 0, 2, 5, 5, 0, 1, 11, 5, 15, 43, 182, '01/12/2020 04:01:05 pm', '01/12/2020 06:36:07 pm', 0, 66, 48, 'disabled', 1),
(25, 77, 32, 116, 61, 58, 2, 1, 4, 2, 6, 5, 0, 1, 9, 2, 7, 11, 5, '01/12/2020 04:01:56 pm', '', 0, 98, 48, 'disabled', 1),
(26, 66, 35, 73, 68, 45, 18, 11, 10, 2, 3, 4, 0, 1, 12, 4, 13, 29, 8, '01/12/2020 04:01:27 pm', '', 0, 105, 48, 'disabled', 1),
(27, 40, 24, 61, 36, 13, 2, 1, 0, 2, 4, 1, 0, 2, 15, 3, 3, 85, 4, '01/12/2020 04:07:48 pm', '', 0, 38, 48, 'disabled', 1),
(28, 1, 1, 29, 27, 7, 1, 7, 3, 2, 3, 2, 0, 0, 0, 2, 6, 15, 4, '01/12/2020 04:11:58 pm', '01/12/2020 04:13:13 pm', 0, 99, 48, 'disabled', 1),
(29, 0, 0, 9, 9, 0, 2, 2, 0, 1, 2, 4, 0, 1, 3, 2, 4, 16, 5, '01/12/2020 04:14:38 pm', '', 0, 60, 48, 'disabled', 1),
(30, 12, 8, 38, 25, 13, 3, 1, 7, 4, 13, 1, 0, 0, 0, 2, 5, 8, 6, '01/12/2020 04:10:47 pm', '', 0, 87, 48, 'disabled', 1),
(31, 32, 11, 57, 28, 9, 0, 0, 5, 2, 3, 2, 0, 1, 18, 3, 14, 42, 7, '01/12/2020 04:15:22 pm', '', 0, 136, 48, 'disabled', 1),
(32, 14, 6, 34, 31, 11, 4, 1, 3, 2, 4, 3, 0, 1, 4, 2, 4, 8, 4, '01/12/2020 04:16:27 pm', '', 0, 58, 48, 'disabled', 1),
(33, 8, 3, 8, 3, 3, 6, 5, 0, 1, 4, 6, 0, 0, 0, 3, 13, 11, 6, '01/12/2020 04:02:50 pm', '', 0, 154, 48, 'disabled', 1),
(34, 22, 12, 122, 110, 58, 3, 6, 2, 65, 158, 12, 0, 20, 332, 4, 133, 200, 162, '01/12/2020 04:23:35 pm', '', 0, 82, 48, 'disabled', 1),
(35, 109, 34, 130, 63, 13, 12, 15, 3, 3, 4, 3, 1, 4, 15, 4, 4, 102, 4, '01/12/2020 04:31:27 pm', '', 0, 73, 48, 'disabled', 1),
(36, 23, 11, 35, 21, 8, 0, 0, 4, 2, 2, 3, 0, 0, 0, 0, 0, 9, 5, '01/12/2020 04:35:59 pm', '', 0, 159, 48, 'disabled', 1),
(37, 43, 4, 9, 9, 0, 4, 3, 3, 1, 5, 5, 1, 1, 3, 3, 3, 76, 4, '01/12/2020 04:35:15 pm', '', 0, 143, 48, 'disabled', 1),
(38, 111, 45, 110, 78, 54, 3, 2, 5, 1, 3, 3, 0, 0, 0, 1, 4, 3, 129, '01/12/2020 04:49:12 pm', '01/12/2020 04:52:10 pm', 0, 165, 48, 'disabled', 1),
(39, 0, 0, 11, 11, 0, 2, 1, 0, 2, 4, 2, 0, 2, 15, 2, 2, 0, 5, '01/12/2020 05:00:26 pm', '', 0, 96, 48, 'disabled', 1),
(40, 11, 6, 90, 52, 4, 7, 6, 6, 2, 4, 1, 0, 0, 0, 2, 6, 14, 5, '01/12/2020 05:04:02 pm', '', 0, 85, 48, 'disabled', 1),
(41, 109, 45, 374, 189, 14, 8, 14, 6, 2, 4, 2, 0, 0, 0, 3, 8, 22, 5, '01/12/2020 04:56:26 pm', '01/12/2020 05:19:24 pm', 0, 183, 48, 'disabled', 1),
(42, 179, 73, 58, 50, 5, 4, 6, 6, 1, 2, 2, 1, 1, 8, 2, 4, 38, 6, '01/12/2020 04:59:56 pm', '', 0, 137, 48, 'disabled', 1),
(43, 43, 26, 82, 46, 23, 10, 9, 2, 17, 42, 8, 0, 7, 19, 3, 33, 26, 121, '01/12/2020 05:05:10 pm', '', 0, 39, 48, 'disabled', 1),
(44, 111, 45, 110, 78, 54, 3, 2, 5, 1, 3, 3, 0, 0, 0, 1, 4, 3, 5, '01/12/2020 05:08:48 pm', '', 0, 164, 48, 'disabled', 1),
(45, 42, 20, 57, 42, 9, 8, 5, 11, 2, 4, 3, 0, 1, 10, 2, 7, 15, 6, '01/12/2020 05:09:35 pm', '', 0, 184, 48, 'disabled', 1),
(46, 57, 25, 112, 73, 18, 3, 8, 8, 37, 103, 68, 1, 9, 50, 3, 102, 21, 82, '01/12/2020 05:06:40 pm', '', 0, 169, 48, 'disabled', 1),
(47, 80, 34, 67, 43, 32, 2, 5, 5, 1, 2, 5, 1, 1, 3, 2, 3, 7, 16, '01/12/2020 05:12:13 pm', '', 0, 161, 48, 'disabled', 1),
(48, 83, 35, 200, 177, 14, 1, 0, 3, 2, 4, 3, 0, 1, 6, 1, 3, 33, 5, '01/12/2020 05:16:33 pm', '', 0, 174, 48, 'disabled', 1),
(49, 62, 8, 61, 19, 15, 1, 2, 8, 2, 3, 4, 0, 1, 6, 3, 5, 12, 4, '01/12/2020 05:26:48 pm', '', 0, 118, 48, 'disabled', 1),
(50, 118, 27, 203, 51, 23, 3, 1, 4, 2, 4, 3, 0, 1, 6, 2, 11, 13, 6, '01/12/2020 05:29:47 pm', '', 0, 75, 48, 'disabled', 1),
(51, 122, 49, 130, 107, 49, 20, 37, 5, 2, 3, 7, 3, 1, 5, 3, 10, 4, 3, '01/12/2020 05:33:41 pm', '01/12/2020 05:45:31 pm', 0, 149, 48, 'disabled', 1),
(52, 311, 88, 308, 168, 51, 9, 16, 6, 2, 2, 3, 0, 1, 2, 3, 5, 9, 4, '01/12/2020 05:35:08 pm', '01/12/2020 05:41:12 pm', 0, 180, 48, 'disabled', 1),
(53, 174, 29, 106, 54, 20, 0, 3, 4, 2, 18, 19, 1, 10, 45, 20, 58, 10, 4, '01/12/2020 05:35:42 pm', '01/20/2020 01:31:14 pm', 0, 88, 48, 'disabled', 1),
(54, 480, 76, 340, 139, 131, 6, 8, 11, 7, 11, 14, 1, 4, 26, 6, 11, 49, 5, '01/12/2020 05:40:07 pm', '', 0, 171, 48, 'disabled', 1),
(55, 180, 65, 160, 55, 14, 4, 3, 5, 2, 4, 3, 0, 0, 0, 1, 4, 11, 7, '01/12/2020 05:33:51 pm', '', 0, 109, 48, 'disabled', 1),
(56, 12, 11, 68, 45, 23, 13, 8, 5, 2, 4, 6, 0, 0, 0, 2, 4, 15, 5, '01/12/2020 05:36:25 pm', '', 0, 78, 48, 'disabled', 1),
(57, 174, 63, 96, 45, 25, 1, 2, 13, 3, 6, 3, 0, 1, 6, 2, 6, 36, 9, '01/12/2020 05:43:12 pm', '', 0, 102, 48, 'disabled', 1),
(58, 336, 28, 257, 44, 18, 2, 5, 7, 2, 2, 3, 0, 0, 0, 2, 3, 3, 3, '01/12/2020 05:46:34 pm', '', 0, 84, 48, 'disabled', 1),
(59, 23, 11, 53, 13, 12, 0, 0, 5, 3, 4, 2, 1, 1, 5, 2, 5, 26, 6, '01/12/2020 05:45:51 pm', '', 0, 131, 48, 'disabled', 1),
(60, 249, 61, 271, 112, 35, 0, 6, 2, 1, 2, 5, 0, 1, 5, 2, 5, 49, 5, '01/12/2020 05:50:05 pm', '', 0, 135, 48, 'disabled', 1),
(61, 24, 8, 24, 18, 11, 1, 2, 8, 2, 4, 2, 0, 0, 0, 3, 8, 20, 3, '01/12/2020 05:37:51 pm', '', 0, 90, 48, 'disabled', 1),
(62, 32, 12, 29, 16, 11, 9, 3, 9, 2, 5, 5, 1, 1, 7, 1, 7, 25, 8, '01/12/2020 05:50:54 pm', '01/16/2020 09:30:17 am', 0, 49, 48, 'disabled', 1),
(63, 68, 44, 56, 52, 19, 9, 7, 5, 2, 4, 3, 1, 1, 3, 2, 4, 50, 4, '01/12/2020 05:48:22 pm', '', 0, 177, 48, 'disabled', 1),
(64, 17, 13, 40, 37, 10, 10, 11, 12, 50, 108, 19, 0, 8, 49, 54, 141, 116, 103, '01/12/2020 05:54:07 pm', '01/13/2020 12:02:01 pm', 0, 140, 48, 'disabled', 1),
(65, 167, 44, 91, 90, 0, 5, 9, 9, 36, 61, 18, 0, 9, 35, 14, 54, 124, 136, '01/12/2020 06:05:54 pm', '01/12/2020 06:46:01 pm', 0, 124, 48, 'disabled', 1),
(66, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 12, '01/12/2020 05:39:42 pm', '03/21/2020 01:21:48 pm', 1, 145, 48, 'disabled', 1),
(67, 110, 31, 57, 56, 54, 6, 5, 9, 2, 4, 3, 0, 0, 0, 1, 2, 9, 4, '01/12/2020 06:31:32 pm', '', 0, 125, 48, 'disabled', 1),
(68, 69, 26, 54, 42, 22, 4, 7, 5, 2, 3, 4, 0, 0, 0, 2, 7, 9, 9, '01/12/2020 06:46:45 pm', '01/12/2020 07:25:53 pm', 0, 129, 48, 'disabled', 1),
(69, 20, 16, 29, 29, 16, 8, 8, 12, 6, 9, 4, 1, 2, 7, 4, 10, 50, 6, '01/12/2020 06:46:19 pm', '', 0, 67, 48, 'disabled', 1),
(70, 0, 0, 27, 24, 10, 9, 5, 8, 10, 34, 7, 0, 1, 9, 6, 2, 17, 3, '01/12/2020 06:50:22 pm', '', 0, 76, 48, 'disabled', 1),
(71, 2, 1, 43, 27, 6, 0, 1, 6, 17, 20, 0, 0, 1, 5, 3, 5, 15, 5, '01/12/2020 06:55:38 pm', '', 0, 70, 48, 'disabled', 1),
(72, 2, 2, 7, 5, 0, 2, 1, 4, 3, 5, 2, 0, 1, 2, 2, 5, 5, 5, '01/12/2020 07:01:11 pm', '', 0, 97, 48, 'disabled', 1),
(73, 77, 42, 83, 74, 54, 5, 13, 6, 2, 4, 3, 0, 1, 7, 3, 5, 10, 7, '01/12/2020 06:54:52 pm', '', 0, 146, 48, 'disabled', 1),
(74, 58, 27, 79, 36, 22, 5, 2, 7, 2, 3, 5, 0, 1, 15, 3, 6, 34, 4, '01/12/2020 06:44:13 pm', '', 0, 107, 48, 'disabled', 1),
(75, 51, 30, 102, 40, 12, 7, 9, 7, 4, 6, 2, 5, 2, 16, 3, 12, 70, 9, '01/12/2020 07:22:53 pm', '', 0, 179, 48, 'disabled', 1),
(76, 145, 25, 86, 57, 7, 2, 3, 5, 2, 3, 3, 0, 1, 2, 1, 2, 11, 5, '01/12/2020 07:50:19 pm', '', 0, 126, 48, 'disabled', 1),
(77, 129, 88, 230, 189, 29, 40, 17, 19, 4, 7, 5, 0, 1, 7, 4, 27, 33, 6, '01/12/2020 07:49:03 pm', '', 0, 47, 48, 'disabled', 1),
(78, 96, 18, 66, 52, 46, 2, 5, 7, 1, 3, 1, 3, 13, 20, 2, 5, 48, 4, '01/12/2020 07:18:58 pm', '01/12/2020 08:18:22 pm', 0, 69, 48, 'disabled', 1),
(79, 18, 5, 41, 10, 7, 0, 0, 2, 2, 3, 7, 0, 1, 8, 3, 3, 20, 7, '01/12/2020 08:03:24 pm', '', 0, 53, 48, 'disabled', 1),
(80, 20, 6, 30, 13, 8, 0, 0, 11, 15, 83, 49, 1, 1, 5, 7, 116, 17, 141, '01/12/2020 08:05:19 pm', '', 0, 72, 48, 'disabled', 1),
(81, 54, 16, 77, 20, 17, 2, 1, 3, 57, 167, 36, 1, 13, 110, 52, 176, 287, 182, '01/12/2020 08:07:15 pm', '', 0, 134, 48, 'disabled', 1),
(82, 0, 0, 7, 7, 7, 2, 1, 2, 2, 3, 4, 0, 0, 0, 2, 5, 7, 4, '01/12/2020 08:12:24 pm', '', 0, 83, 48, 'disabled', 1),
(83, 38, 16, 48, 46, 11, 2, 2, 3, 2, 3, 1, 1, 1, 3, 2, 6, 60, 4, '01/12/2020 08:14:56 pm', '', 0, 155, 48, 'disabled', 1),
(84, 146, 46, 140, 72, 50, 8, 3, 12, 3, 8, 4, 1, 1, 10, 4, 14, 31, 6, '01/12/2020 08:04:51 pm', '', 0, 46, 48, 'disabled', 1),
(85, 5, 5, 19, 15, 12, 1, 2, 9, 2, 4, 5, 1, 2, 7, 2, 4, 12, 7, '01/12/2020 08:17:06 pm', '', 0, 132, 48, 'disabled', 1),
(86, 35, 24, 258, 63, 27, 3, 10, 8, 2, 5, 2, 0, 1, 4, 3, 7, 20, 4, '01/12/2020 08:18:55 pm', '', 0, 56, 48, 'disabled', 1),
(87, 33, 26, 82, 72, 27, 21, 9, 4, 2, 5, 1, 0, 0, 0, 2, 8, 23, 5, '01/12/2020 08:19:40 pm', '', 0, 86, 48, 'disabled', 1),
(88, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '01/12/2020 08:19:25 pm', '', 0, 29, 48, 'disabled', 1),
(89, 35, 23, 137, 106, 26, 11, 9, 7, 2, 4, 2, 0, 0, 0, 2, 4, 18, 5, '01/12/2020 08:22:10 pm', '', 0, 61, 48, 'disabled', 1),
(90, 42, 24, 77, 59, 35, 2, 2, 5, 3, 6, 3, 0, 0, 0, 3, 110, 4, 7, '01/12/2020 08:20:42 pm', '', 0, 63, 48, 'disabled', 1),
(91, 271, 30, 234, 93, 45, 8, 7, 2, 1, 2, 2, 2, 3, 5, 3, 3, 96, 4, '01/12/2020 08:23:42 pm', '', 0, 166, 48, 'disabled', 1),
(92, 31, 16, 46, 21, 8, 0, 0, 4, 3, 4, 2, 2, 1, 5, 3, 7, 16, 6, '01/12/2020 08:23:13 pm', '', 0, 133, 48, 'disabled', 1),
(93, 0, 0, 98, 98, 2, 1, 2, 0, 2, 3, 3, 0, 0, 0, 3, 4, 14, 4, '01/12/2020 08:25:11 pm', '', 0, 54, 48, 'disabled', 1),
(94, 249, 34, 254, 85, 51, 0, 4, 12, 2, 3, 1, 2, 2, 7, 3, 6, 27, 8, '01/12/2020 08:27:00 pm', '01/12/2020 08:32:44 pm', 0, 147, 48, 'disabled', 1),
(95, 3, 3, 27, 23, 14, 0, 4, 3, 3, 8, 2, 1, 1, 5, 2, 11, 18, 7, '01/12/2020 08:30:51 pm', '', 0, 172, 48, 'disabled', 1),
(96, 63, 12, 33, 25, 18, 4, 3, 4, 1, 2, 2, 1, 1, 5, 2, 3, 9, 4, '01/12/2020 08:33:23 pm', '', 0, 43, 48, 'disabled', 1),
(97, 5, 3, 4, 4, 3, 2, 3, 1, 2, 3, 3, 0, 1, 6, 4, 9, 19, 7, '01/12/2020 08:32:32 pm', '', 0, 104, 48, 'disabled', 1),
(98, 78, 39, 73, 50, 13, 2, 2, 4, 2, 7, 3, 2, 1, 5, 5, 5, 22, 4, '01/12/2020 08:33:29 pm', '', 0, 148, 48, 'disabled', 1),
(99, 131, 31, 165, 55, 30, 5, 9, 7, 10, 14, 1, 0, 2, 5, 2, 6, 18, 4, '01/12/2020 08:11:25 pm', '', 0, 176, 48, 'disabled', 1),
(100, 20, 3, 118, 8, 7, 0, 1, 4, 2, 3, 3, 0, 0, 0, 12, 5, 10, 4, '01/12/2020 08:30:18 pm', '', 0, 122, 48, 'disabled', 1),
(101, 61, 28, 111, 60, 19, 8, 12, 7, 2, 6, 3, 1, 2, 11, 4, 13, 67, 7, '01/12/2020 08:27:21 pm', '', 0, 94, 48, 'disabled', 1),
(102, 278, 88, 226, 125, 9, 1, 6, 3, 4, 6, 0, 0, 0, 0, 3, 4, 32, 5, '01/12/2020 08:32:45 pm', '01/12/2020 08:39:49 pm', 0, 160, 48, 'disabled', 1),
(103, 136, 22, 160, 30, 26, 0, 3, 15, 2, 3, 3, 0, 1, 3, 3, 3, 10, 5, '01/12/2020 08:41:59 pm', '01/16/2020 09:26:11 am', 0, 173, 48, 'disabled', 1),
(104, 100, 48, 163, 122, 52, 8, 8, 11, 3, 8, 3, 0, 0, 0, 4, 6, 40, 6, '01/12/2020 08:45:27 pm', '', 0, 170, 48, 'disabled', 1),
(105, 26, 21, 79, 63, 22, 5, 3, 2, 2, 4, 3, 1, 1, 14, 4, 8, 37, 2, '01/12/2020 08:46:10 pm', '', 0, 62, 48, 'disabled', 1),
(106, 178, 19, 41, 39, 22, 3, 2, 2, 2, 4, 1, 0, 2, 6, 0, 0, 35, 5, '01/12/2020 08:52:33 pm', '', 0, 81, 48, 'disabled', 1),
(107, 33, 28, 53, 48, 48, 6, 14, 7, 4, 7, 5, 0, 2, 10, 2, 15, 16, 8, '01/12/2020 08:51:14 pm', '', 0, 151, 48, 'disabled', 1),
(108, 71, 18, 33, 32, 22, 2, 2, 10, 3, 4, 2, 0, 0, 0, 2, 7, 9, 5, '01/12/2020 08:54:39 pm', '', 0, 158, 48, 'disabled', 1),
(109, 41, 5, 54, 23, 7, 10, 4, 3, 4, 7, 3, 2, 1, 5, 1, 6, 45, 8, '01/12/2020 08:59:07 pm', '', 0, 113, 48, 'disabled', 1),
(110, 41, 10, 111, 38, 12, 0, 0, 3, 3, 4, 3, 0, 1, 9, 2, 3, 12, 5, '01/12/2020 08:58:08 pm', '', 0, 57, 48, 'disabled', 1),
(111, 51, 11, 29, 28, 21, 6, 6, 4, 2, 4, 4, 1, 2, 15, 3, 8, 32, 5, '01/12/2020 09:03:03 pm', '', 0, 115, 48, 'disabled', 1),
(112, 64, 23, 66, 35, 12, 0, 0, 11, 3, 3, 3, 0, 0, 0, 2, 5, 8, 5, '01/12/2020 09:07:18 pm', '', 0, 45, 48, 'disabled', 1),
(113, 2, 2, 39, 17, 17, 5, 12, 0, 4, 7, 9, 0, 2, 67, 26, 8, 75, 14, '01/12/2020 09:07:45 pm', '', 0, 152, 48, 'disabled', 1),
(114, 72, 21, 170, 49, 23, 8, 18, 6, 2, 4, 3, 1, 2, 11, 2, 7, 23, 6, '01/12/2020 09:14:36 pm', '', 0, 153, 48, 'disabled', 1),
(115, 20, 11, 141, 132, 78, 6, 15, 6, 1, 3, 3, 1, 1, 6, 1, 5, 16, 5, '01/12/2020 09:17:00 pm', '', 0, 178, 48, 'disabled', 1),
(116, 148, 29, 230, 151, 13, 3, 3, 10, 2, 3, 2, 0, 1, 4, 3, 8, 17, 6, '01/12/2020 09:38:38 pm', '', 0, 128, 48, 'disabled', 1),
(117, 13, 5, 14, 7, 3, 1, 2, 3, 2, 4, 2, 0, 2, 12, 2, 6, 61, 6, '01/12/2020 09:46:38 pm', '', 0, 117, 48, 'disabled', 1),
(118, 29, 21, 55, 53, 46, 25, 10, 9, 3, 6, 1, 0, 0, 0, 1, 3, 18, 4, '01/12/2020 10:20:24 pm', '', 0, 142, 48, 'disabled', 1),
(119, 68, 21, 36, 35, 26, 1, 1, 2, 2, 3, 3, 0, 1, 2, 1, 6, 8, 6, '01/12/2020 10:23:09 pm', '', 0, 168, 48, 'disabled', 1),
(120, 60, 26, 99, 44, 28, 2, 5, 2, 2, 3, 2, 0, 1, 2, 2, 2, 9, 3, '01/12/2020 10:19:58 pm', '', 0, 68, 48, 'disabled', 1),
(121, 55, 19, 36, 25, 25, 4, 3, 2, 6, 7, 0, 0, 5, 5, 3, 3, 10, 14, '01/12/2020 10:20:53 pm', '', 0, 92, 48, 'disabled', 1),
(122, 109, 21, 90, 77, 34, 9, 4, 2, 1, 1, 1, 2, 1, 4, 1, 3, 6, 4, '01/12/2020 10:29:29 pm', '', 0, 139, 48, 'disabled', 1),
(123, 0, 0, 10, 10, 5, 1, 2, 2, 3, 4, 3, 0, 1, 6, 2, 5, 13, 5, '01/12/2020 10:26:24 pm', '01/12/2020 10:39:05 pm', 0, 108, 48, 'disabled', 1),
(124, 56, 21, 119, 29, 18, 3, 8, 4, 2, 4, 4, 0, 1, 1, 3, 6, 11, 5, '01/12/2020 10:20:34 pm', '', 0, 77, 48, 'disabled', 1),
(125, 40, 11, 21, 12, 11, 1, 1, 1, 69, 100, 55, 0, 1, 4, 3, 19, 1, 161, '01/12/2020 10:27:24 pm', '', 0, 167, 48, 'disabled', 1),
(126, 177, 61, 114, 62, 58, 1, 5, 17, 1, 3, 3, 1, 1, 6, 1, 3, 10, 7, '01/12/2020 10:25:23 pm', '', 0, 65, 48, 'disabled', 1),
(127, 0, 0, 24, 24, 24, 1, 3, 0, 75, 250, 7, 1, 8, 24, 4, 14, 56, 202, '01/12/2020 10:26:36 pm', '01/12/2020 10:39:32 pm', 0, 48, 48, 'disabled', 1),
(128, 59, 16, 105, 22, 0, 1, 5, 1, 2, 1, 3, 0, 1, 2, 1, 2, 3, 7, '01/12/2020 10:36:30 pm', '', 0, 120, 48, 'disabled', 1),
(129, 44, 18, 99, 64, 15, 20, 8, 5, 2, 2, 2, 1, 1, 5, 1, 2, 29, 6, '01/12/2020 10:45:40 pm', '', 0, 130, 48, 'disabled', 1),
(130, 24, 4, 83, 25, 25, 4, 8, 6, 3, 6, 5, 0, 1, 6, 2, 4, 36, 10, '01/12/2020 10:55:30 pm', '', 0, 163, 48, 'disabled', 1),
(131, 18, 12, 30, 30, 11, 1, 3, 2, 16, 30, 8, 1, 1, 7, 8, 16, 21, 37, '01/12/2020 11:03:54 pm', '01/12/2020 11:07:40 pm', 0, 157, 48, 'disabled', 1),
(132, 110, 41, 159, 95, 40, 9, 2, 7, 27, 37, 7, 1, 5, 37, 22, 257, 58, 227, '01/12/2020 10:34:16 pm', '', 0, 110, 48, 'disabled', 1),
(133, 52, 40, 103, 55, 49, 2, 4, 4, 2, 3, 1, 0, 0, 0, 1, 5, 5, 6, '01/13/2020 07:43:18 am', '', 0, 141, 48, 'disabled', 1),
(134, 100, 33, 104, 48, 21, 3, 2, 8, 2, 3, 3, 0, 0, 0, 3, 3, 2, 4, '01/13/2020 07:43:57 am', '', 0, 111, 48, 'disabled', 1),
(135, 39, 5, 74, 9, 2, 1, 1, 4, 2, 3, 2, 2, 1, 3, 1, 5, 6, 5, '01/13/2020 07:56:06 am', '', 0, 64, 48, 'disabled', 1),
(136, 10, 6, 38, 27, 10, 8, 12, 5, 2, 3, 4, 0, 2, 9, 2, 8, 27, 6, '01/13/2020 08:02:38 am', '', 0, 182, 48, 'disabled', 1),
(137, 1, 1, 3, 3, 3, 1, 3, 4, 2, 5, 2, 0, 0, 0, 3, 2, 5, 6, '01/13/2020 08:06:05 am', '', 0, 52, 48, 'disabled', 1),
(138, 28, 21, 48, 43, 43, 3, 1, 2, 2, 3, 4, 0, 1, 6, 4, 7, 30, 5, '01/13/2020 08:12:37 am', '', 0, 55, 48, 'disabled', 1),
(139, 196, 53, 149, 75, 51, 4, 2, 8, 3, 4, 2, 0, 1, 4, 3, 6, 8, 4, '01/13/2020 08:22:23 am', '', 0, 138, 48, 'disabled', 1),
(140, 107, 37, 100, 50, 45, 1, 1, 8, 2, 4, 3, 1, 1, 8, 2, 4, 12, 4, '01/13/2020 08:32:36 am', '', 0, 101, 48, 'disabled', 1),
(141, 21, 21, 33, 33, 3, 2, 5, 6, 1, 1, 1, 0, 0, 0, 1, 1, 3, 1, '01/13/2020 08:33:40 am', '', 0, 156, 48, 'disabled', 1),
(142, 24, 22, 111, 42, 10, 7, 10, 9, 2, 4, 3, 1, 1, 3, 2, 10, 44, 5, '01/13/2020 11:13:13 am', '', 0, 175, 48, 'disabled', 1),
(143, 22, 4, 41, 17, 4, 2, 3, 1, 2, 3, 3, 0, 0, 0, 11, 7, 15, 4, '01/13/2020 11:24:19 am', '', 0, 89, 48, 'disabled', 1),
(144, 9, 4, 22, 18, 2, 1, 1, 3, 2, 5, 0, 0, 4, 10, 2, 8, 26, 5, '01/13/2020 11:34:59 am', '', 0, 106, 48, 'disabled', 1),
(145, 130, 18, 89, 46, 5, 0, 2, 5, 2, 4, 4, 0, 0, 0, 3, 7, 9, 6, '01/13/2020 11:43:25 am', '', 0, 95, 48, 'disabled', 1),
(146, 22, 10, 344, 336, 21, 4, 17, 11, 1, 3, 4, 1, 1, 10, 2, 9, 50, 5, '01/13/2020 01:04:58 pm', '', 0, 162, 48, 'disabled', 1),
(147, 12, 8, 157, 35, 35, 9, 9, 4, 2, 4, 5, 2, 1, 6, 2, 12, 11, 7, '01/13/2020 01:10:23 pm', '01/13/2020 01:10:42 pm', 0, 71, 48, 'disabled', 1),
(148, 50, 7, 202, 34, 4, 0, 1, 0, 2, 2, 2, 0, 2, 8, 1, 2, 21, 6, '01/13/2020 03:55:22 pm', '01/13/2020 04:02:38 pm', 0, 74, 48, 'disabled', 1),
(149, 49, 26, 127, 36, 25, 7, 2, 2, 2, 4, 2, 2, 2, 5, 2, 3, 9, 5, '01/13/2020 06:51:16 pm', '01/13/2020 06:53:22 pm', 0, 116, 48, 'disabled', 1),
(150, 0, 0, 82, 63, 9, 2, 0, 6, 42, 178, 1, 4, 18, 89, 82, 342, 55, 174, '01/13/2020 07:36:23 pm', '01/13/2020 07:44:43 pm', 0, 91, 48, 'disabled', 1),
(151, 89, 74, 151, 98, 32, 0, 4, 6, 3, 29, 3, 0, 0, 0, 3, 11, 4, 6, '01/13/2020 07:50:10 pm', '', 0, 40, 48, 'disabled', 1),
(152, 70, 16, 104, 42, 29, 0, 0, 11, 22, 69, 43, 2, 2, 9, 6, 158, 14, 160, '01/13/2020 07:55:08 pm', '', 0, 41, 48, 'disabled', 1),
(153, 3, 2, 6, 6, 1, 0, 4, 1, 1, 3, 2, 0, 0, 0, 1, 9, 7, 9, '01/14/2020 07:16:31 am', '', 0, 150, 48, 'disabled', 1),
(154, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 12, '03/21/2020 09:31:19 am', '03/21/2020 01:23:14 pm', 2, 186, 64, '', 1),
(156, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, 12, '03/21/2020 12:27:08 pm', '03/21/2020 01:22:16 pm', 2, 187, 66, '', 1),
(158, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 12, '03/21/2020 09:02:14 pm', '', 0, 38, 70, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
`ID` int(11) NOT NULL,
  `YR` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`ID`, `YR`) VALUES
(5, '2020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`Area_id`);

--
-- Indexes for table `baptism_rpt`
--
ALTER TABLE `baptism_rpt`
 ADD PRIMARY KEY (`baptism_id`);

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contactstatus`
--
ALTER TABLE `contactstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contatcdetails`
--
ALTER TABLE `contatcdetails`
 ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `control_rec`
--
ALTER TABLE `control_rec`
 ADD PRIMARY KEY (`control_rec_id`);

--
-- Indexes for table `current_teamdata`
--
ALTER TABLE `current_teamdata`
 ADD PRIMARY KEY (`c_team_id`);

--
-- Indexes for table `establish_dist`
--
ALTER TABLE `establish_dist`
 ADD PRIMARY KEY (`est_id`);

--
-- Indexes for table `establish_local`
--
ALTER TABLE `establish_local`
 ADD PRIMARY KEY (`localest_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historyfeedback`
--
ALTER TABLE `historyfeedback`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locality`
--
ALTER TABLE `locality`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `longproprpt`
--
ALTER TABLE `longproprpt`
 ADD PRIMARY KEY (`longproprpt_id`);

--
-- Indexes for table `longprop_feedback`
--
ALTER TABLE `longprop_feedback`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitored_contact`
--
ALTER TABLE `monitored_contact`
 ADD PRIMARY KEY (`mon_id`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `MONTH` (`MONTH`);

--
-- Indexes for table `prospect_train`
--
ALTER TABLE `prospect_train`
 ADD PRIMARY KEY (`pros_id`);

--
-- Indexes for table `recoverlocal`
--
ALTER TABLE `recoverlocal`
 ADD PRIMARY KEY (`recover_id`);

--
-- Indexes for table `recoversaints`
--
ALTER TABLE `recoversaints`
 ADD PRIMARY KEY (`rec_id`);

--
-- Indexes for table `rec_district`
--
ALTER TABLE `rec_district`
 ADD PRIMARY KEY (`dist_id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
 ADD PRIMARY KEY (`region_id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
 ADD PRIMARY KEY (`Rel_id`);

--
-- Indexes for table `requestdata`
--
ALTER TABLE `requestdata`
 ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
 ADD PRIMARY KEY (`requeststatus_id`);

--
-- Indexes for table `security_code`
--
ALTER TABLE `security_code`
 ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `shepherd_code`
--
ALTER TABLE `shepherd_code`
 ADD PRIMARY KEY (`shep_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `stat_saints`
--
ALTER TABLE `stat_saints`
 ADD PRIMARY KEY (`stat_id`);

--
-- Indexes for table `teammate`
--
ALTER TABLE `teammate`
 ADD PRIMARY KEY (`teammate_id`);

--
-- Indexes for table `trainee_info`
--
ALTER TABLE `trainee_info`
 ADD PRIMARY KEY (`trainee_id`);

--
-- Indexes for table `trainee_info_temp`
--
ALTER TABLE `trainee_info_temp`
 ADD PRIMARY KEY (`trainee_id`);

--
-- Indexes for table `userlevel`
--
ALTER TABLE `userlevel`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `visitationday`
--
ALTER TABLE `visitationday`
 ADD PRIMARY KEY (`visitationday_id`);

--
-- Indexes for table `week`
--
ALTER TABLE `week`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `weekendrpt`
--
ALTER TABLE `weekendrpt`
 ADD PRIMARY KEY (`weekendrpt_id`);

--
-- Indexes for table `weekspropagation`
--
ALTER TABLE `weekspropagation`
 ADD PRIMARY KEY (`id_weekprop`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=249;
--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
MODIFY `Area_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `baptism_rpt`
--
ALTER TABLE `baptism_rpt`
MODIFY `baptism_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contactstatus`
--
ALTER TABLE `contactstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `contatcdetails`
--
ALTER TABLE `contatcdetails`
MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `control_rec`
--
ALTER TABLE `control_rec`
MODIFY `control_rec_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `current_teamdata`
--
ALTER TABLE `current_teamdata`
MODIFY `c_team_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `establish_dist`
--
ALTER TABLE `establish_dist`
MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `establish_local`
--
ALTER TABLE `establish_local`
MODIFY `localest_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `historyfeedback`
--
ALTER TABLE `historyfeedback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `locality`
--
ALTER TABLE `locality`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `longproprpt`
--
ALTER TABLE `longproprpt`
MODIFY `longproprpt_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `longprop_feedback`
--
ALTER TABLE `longprop_feedback`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monitored_contact`
--
ALTER TABLE `monitored_contact`
MODIFY `mon_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `month`
--
ALTER TABLE `month`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `prospect_train`
--
ALTER TABLE `prospect_train`
MODIFY `pros_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `recoverlocal`
--
ALTER TABLE `recoverlocal`
MODIFY `recover_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `recoversaints`
--
ALTER TABLE `recoversaints`
MODIFY `rec_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `rec_district`
--
ALTER TABLE `rec_district`
MODIFY `dist_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
MODIFY `region_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
MODIFY `Rel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `requestdata`
--
ALTER TABLE `requestdata`
MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `request_status`
--
ALTER TABLE `request_status`
MODIFY `requeststatus_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `security_code`
--
ALTER TABLE `security_code`
MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shepherd_code`
--
ALTER TABLE `shepherd_code`
MODIFY `shep_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stat_saints`
--
ALTER TABLE `stat_saints`
MODIFY `stat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `teammate`
--
ALTER TABLE `teammate`
MODIFY `teammate_id` int(225) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `trainee_info`
--
ALTER TABLE `trainee_info`
MODIFY `trainee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=503;
--
-- AUTO_INCREMENT for table `trainee_info_temp`
--
ALTER TABLE `trainee_info_temp`
MODIFY `trainee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=503;
--
-- AUTO_INCREMENT for table `userlevel`
--
ALTER TABLE `userlevel`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `visitationday`
--
ALTER TABLE `visitationday`
MODIFY `visitationday_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `week`
--
ALTER TABLE `week`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `weekendrpt`
--
ALTER TABLE `weekendrpt`
MODIFY `weekendrpt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `weekspropagation`
--
ALTER TABLE `weekspropagation`
MODIFY `id_weekprop` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
