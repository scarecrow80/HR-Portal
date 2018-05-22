-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22. Mai, 2018 20:21 p.m.
-- Server-versjon: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hr_portal`
--
CREATE DATABASE IF NOT EXISTS `db_hr_portal` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_hr_portal`;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Checklist`
--

CREATE TABLE `Checklist` (
  `idChecklist` int(11) NOT NULL,
  `checkpointsNO` varchar(200) NOT NULL,
  `checkpointsEN` varchar(200) NOT NULL,
  `responsible` varchar(10) NOT NULL,
  `nationality` varchar(10) NOT NULL,
  `leader` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `Checklist`
--

INSERT INTO `Checklist` (`idChecklist`, `checkpointsNO`, `checkpointsEN`, `responsible`, `nationality`, `leader`) VALUES
(1, 'Tilpasset liste og utpeking av roller.', 'Customized list and role distribution', 'Leder', 'Norsk', 'Nei'),
(2, 'SDI gir en konfirmasjon av at arbeidskontrakt har kommet tilbake.', 'SDI gives a confirmation that the contract of the new instated has been accepted', 'Leder', 'Norsk', 'Nei'),
(3, 'Alt nødvendig lagt i personal mappen.', 'All necessary documents are delivered to his or her personnel file', 'HR', 'Norsk', 'Nei'),
(4, 'Registrering av ny bruker i BAS.', 'Registration of a new user in BAS (useradministrative system', 'HR', 'Norsk', 'Nei'),
(5, 'Orden på kontorplass og alt medfølgende.', 'Fix office space and everything that is accompanied by that.', 'Leder', 'Norsk', 'Nei'),
(6, 'Bestilling av IT-utstyr.', 'Ordering of necessary IT equipment.', 'Leder', 'Norsk', 'Nei'),
(7, 'Orientere til kollegaer.', 'Inform the colleagues.', 'Leder', 'Norsk', 'Nei'),
(8, 'Informasjon om oppmøte.', 'Information about attendance on the first day at the office.', 'Fadder', 'Norsk', 'Nei'),
(9, 'Velkomsthilsen og sikkerhetsinformasjon.', 'Greetings and delivery of relevant classified information.', 'Leder', 'Norsk', 'Nei'),
(10, 'Velkomst med de nærmeste.', 'Greetings with your fellow co-workers.', 'Fadder', 'Norsk', 'Nei'),
(11, 'Mailsystemet.', 'Introduction to the email system used at the work place.', 'Leder', 'Norsk', 'Nei'),
(12, 'Sjekk av IT-utstyr.', 'Making sure that all IT equipment is working and in place.', 'Fadder', 'Norsk', 'Nei'),
(13, 'HMS-opplæring grunnleggende.', 'A basic introduction to fire emergencies protocols.', 'Leder', 'Norsk', 'Nei'),
(14, 'Omvisning over hele arbeidsplassen.', 'A guided tour over the local office', 'Fadder', 'Norsk', 'Nei'),
(15, 'Et vennlig fjes hver dag.', 'Social contact from a familiar face.', 'Fadder', 'Norsk', 'Nei'),
(16, 'Eget arbeidsforhold.', 'An orientation of your personal working space environment', 'HR', 'Norsk', 'Nei'),
(17, 'Den generelle HMS delen.', 'Training and introduction into the health and safety regulations at the faculty (HSE or HMS in Norwegian.', 'HR', 'Norsk', 'Nei'),
(18, 'Intranett introduksjon.', 'An introduction into the local intranet.', 'Fadder', 'Norsk', 'Nei'),
(19, 'Opplæringsplan.', 'Give the new co-worker information on recommended courses for the newly employee and sign up to an introductory day for the newly employed.', 'Leder', 'Norsk', 'Nei'),
(20, 'Sosiale og kulturelle tilbud.', 'Share social and cultural events and offerings for the faculty.', 'Fadder', 'Norsk', 'Nei'),
(21, 'Arbeidsplassvurdering.', 'Ordering and reviewing of working space environment.', 'HR', 'Norsk', 'Nei'),
(22, 'Oppfølgings og informasjonssamtale.', 'A follow-up conversation about work situation and other necessary information.', 'Leder', 'Norsk', 'Nei'),
(23, 'Omvisning av alle studiestedene.', 'Guided tour of all the campuses.', 'Fadder', 'Norsk', 'Nei'),
(24, 'Om nødvendig en ny oppfølgingsamtale.', 'If necessary at a later state another follow-up conversation.', 'Leder', 'Norsk', 'Nei'),
(25, 'Fadder gis samtidig som BAS registrering.', 'Mentor is given and informed to the new leader at the same time as the registration on BAS.', 'HR', 'Norsk', 'Ja'),
(26, 'Lederen er med i planlegging av sin egen startperiode.', 'The newly recruited leader is included in planning of his own starting period.', 'HR', 'Norsk', 'Ja'),
(27, 'Introduksjonsperm og tidligere innsikt i viktig informasjon.', 'Introductory folder and earlier access into vital information of the working space.', 'HR', 'Norsk', 'Ja'),
(28, 'Dataprogram og riktige rettigheter.', 'Prepare the IT equipment with the necessary applications and access rights for the system in the faculty.', 'IKT', 'Norsk', 'Ja'),
(29, 'Interessentanalyse.', 'Go through the stakeholder management for the university and the department and the schedules of meeting and events.', 'Leder', 'Norsk', 'Ja'),
(30, 'Kompetanseutvikling/lederkurs.', 'Startup meeting with plan for development of skills by for example taking courses on leadership.', 'Leder', 'Norsk', 'Ja'),
(31, 'Innføringsmoduler og rask kjennskap til sentrale prosesser.', 'Introduced to introductory modules in field of administrative work.', 'Leder', 'Norsk', 'Ja'),
(32, 'Velkomstdokumenter og informasjon sendes på engelsk.', 'Welcome documents and information sent in English.', 'HR', 'Utenlandsk', 'Nei'),
(33, 'Nasjonalitet skal registreres i registreringsskjema for rekruttering, på arbeidskontrakt og i SAP.', 'Nationality is included in the registration form for recruiting, workcontract and in SAP.', 'HR', 'Utenlandsk', 'Nei'),
(34, 'Tilbud om assistanse for visum, ved behov, skal tilbys.', 'Offering to assist in a work-related visa.', 'HR', 'Utenlandsk', 'Nei'),
(35, 'Tilbud om hjelp til bolig, norsk kurs og andre mottakstilbud skal vurderes ref. HiOA’s rammeavtale med Oslo Handelskammer for intl. mottak og UiO’s «Norwegian for Academics».', 'Offering to assist in acquiring an apartment. HR department will use their treaty with Oslo chamber of commerce as a building block.', 'HR', 'Utenlandsk', 'Nei'),
(36, 'BAS passord - hvis den tilsatte har glemt passordet husk at man må ha registrert norsk mobilnummer i https://www.hioa.no/minprofil og trenger norsk D-eller fødselsnummer for å kunne bruke løsningen. M', 'Information of BAS password change. If the new recruited does not have a Norwegian cellphone and Norwegian D-number BIT must be contacted.', 'HR', 'Utenlandsk', 'Nei');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Newemployee`
--

CREATE TABLE `Newemployee` (
  `idNewemployee` int(11) NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `workposition` varchar(45) DEFAULT NULL,
  `international` varchar(10) DEFAULT NULL COMMENT 'Norsk/engelsk',
  `startdate` date DEFAULT NULL COMMENT 'Ansatt dato'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Newemployee_has_Checklist`
--

CREATE TABLE `Newemployee_has_Checklist` (
  `Newemployee_idNewemployee` int(11) NOT NULL,
  `Checklist_idChecklist` int(11) NOT NULL,
  `checked` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Users`
--

CREATE TABLE `Users` (
  `idUsers` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `usertype` varchar(10) DEFAULT NULL COMMENT 'Leder/fadder etc',
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `Users`
--

INSERT INTO `Users` (`idUsers`, `firstname`, `lastname`, `username`, `usertype`, `password`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `Users_has_Newemployee`
--

CREATE TABLE `Users_has_Newemployee` (
  `Users_idUsers` int(11) NOT NULL,
  `Newemployee_idNewemployee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Checklist`
--
ALTER TABLE `Checklist`
  ADD PRIMARY KEY (`idChecklist`),
  ADD UNIQUE KEY `idChecklist_UNIQUE` (`idChecklist`);

--
-- Indexes for table `Newemployee`
--
ALTER TABLE `Newemployee`
  ADD PRIMARY KEY (`idNewemployee`),
  ADD UNIQUE KEY `idNewemployee_UNIQUE` (`idNewemployee`);

--
-- Indexes for table `Newemployee_has_Checklist`
--
ALTER TABLE `Newemployee_has_Checklist`
  ADD PRIMARY KEY (`Newemployee_idNewemployee`,`Checklist_idChecklist`),
  ADD KEY `fk_Newemployee_has_Checklist_Checklist1_idx` (`Checklist_idChecklist`),
  ADD KEY `fk_Newemployee_has_Checklist_Newemployee1_idx` (`Newemployee_idNewemployee`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`idUsers`),
  ADD UNIQUE KEY `idUsers_UNIQUE` (`idUsers`);

--
-- Indexes for table `Users_has_Newemployee`
--
ALTER TABLE `Users_has_Newemployee`
  ADD PRIMARY KEY (`Users_idUsers`,`Newemployee_idNewemployee`),
  ADD KEY `fk_Users_has_Newemployee_Newemployee1_idx` (`Newemployee_idNewemployee`),
  ADD KEY `fk_Users_has_Newemployee_Users_idx` (`Users_idUsers`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Checklist`
--
ALTER TABLE `Checklist`
  MODIFY `idChecklist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `Newemployee`
--
ALTER TABLE `Newemployee`
  MODIFY `idNewemployee` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `idUsers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `Newemployee_has_Checklist`
--
ALTER TABLE `Newemployee_has_Checklist`
  ADD CONSTRAINT `fk_Newemployee_has_Checklist_Checklist1` FOREIGN KEY (`Checklist_idChecklist`) REFERENCES `Checklist` (`idChecklist`)
  ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Newemployee_has_Checklist_Newemployee1` FOREIGN KEY (`Newemployee_idNewemployee`) REFERENCES `Newemployee` (`idNewemployee`)
  ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `Users_has_Newemployee`
--
ALTER TABLE `Users_has_Newemployee`
  ADD CONSTRAINT `fk_Users_has_Newemployee_Newemployee1` FOREIGN KEY (`Newemployee_idNewemployee`) REFERENCES `Newemployee` (`idNewemployee`)
  ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Users_has_Newemployee_Users` FOREIGN KEY (`Users_idUsers`) REFERENCES `Users` (`idUsers`)
  ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
--
-- Hendelser
--
CREATE DEFINER=`db_hr_portal`@`%` EVENT `Schedule delete Newemployee`
  ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:30' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `Newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR)$$

CREATE DEFINER=`db_hr_portal`@`%` EVENT `Schedule delete Checklist`
  ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `Newemployee_has_Checklist` WHERE `Newemployee_idNewemployee`
IN (SELECT `idNewemployee` FROM `Newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR))$$

CREATE DEFINER=`db_hr_portal`@`%` EVENT `Schedule delete mentor`
  ON SCHEDULE EVERY 1 MONTH STARTS '2018-05-05 16:20:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Testing if delete'
DO DELETE FROM `Users_has_Newemployee` WHERE `Newemployee_idNewemployee`
IN (SELECT `idNewemployee` FROM `Newemployee` WHERE `startdate` < DATE_SUB(NOW(), INTERVAL 1 YEAR))$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
