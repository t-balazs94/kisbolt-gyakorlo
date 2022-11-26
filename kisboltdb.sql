-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2022. Okt 28. 20:58
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `kisboltdb`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `beszerzes`
--

CREATE TABLE `beszerzes` (
  `beszerzesid` int(11) NOT NULL,
  `termekid` int(11) NOT NULL,
  `bdatum` varchar(40) NOT NULL,
  `bar` int(20) NOT NULL,
  `darabszam` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `beszerzes`
--

INSERT INTO `beszerzes` (`beszerzesid`, `termekid`, `bdatum`, `bar`, `darabszam`) VALUES
(8, 2, '2022-10-28', 250, 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `termek`
--

CREATE TABLE `termek` (
  `termekid` int(11) NOT NULL,
  `gyarto` varchar(50) NOT NULL,
  `megnevezes` varchar(50) NOT NULL,
  `nettoar` int(20) NOT NULL,
  `tipus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `termek`
--

INSERT INTO `termek` (`termekid`, `gyarto`, `megnevezes`, `nettoar`, `tipus`) VALUES
(2, 'Dreher', 'Dreher Áfonya', 250, 'élelmiszer');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `beszerzes`
--
ALTER TABLE `beszerzes`
  ADD PRIMARY KEY (`beszerzesid`),
  ADD KEY `TERMEKID_FK` (`termekid`);

--
-- A tábla indexei `termek`
--
ALTER TABLE `termek`
  ADD PRIMARY KEY (`termekid`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `beszerzes`
--
ALTER TABLE `beszerzes`
  MODIFY `beszerzesid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `termek`
--
ALTER TABLE `termek`
  MODIFY `termekid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `beszerzes`
--
ALTER TABLE `beszerzes`
  ADD CONSTRAINT `TERMEKID_FK` FOREIGN KEY (`termekid`) REFERENCES `termek` (`termekid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
