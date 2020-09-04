-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Wrz 2020, 22:21
-- Wersja serwera: 10.4.6-MariaDB
-- Wersja PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `invoice`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faktury`
--

CREATE TABLE `faktury` (
  `id` int(11) NOT NULL,
  `nazwa_wystawcy` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `ulica_wystawcy` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `budynek_wystawcy` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `kod_wystawcy` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `miasto_wystawcy` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nip_wystawcy` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `nazwa_odbiorcy` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `ulica_odbiorcy` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `budynek_odbiorcy` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `kod_odbiorcy` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `miasto_odbiorcy` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nip_odbiorcy` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `metoda_platnosci` varchar(15) COLLATE utf8_polish_ci NOT NULL,
  `data_wystawienia` date NOT NULL,
  `numer_faktury` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `faktury`
--

INSERT INTO `faktury` (`id`, `nazwa_wystawcy`, `ulica_wystawcy`, `budynek_wystawcy`, `kod_wystawcy`, `miasto_wystawcy`, `nip_wystawcy`, `nazwa_odbiorcy`, `ulica_odbiorcy`, `budynek_odbiorcy`, `kod_odbiorcy`, `miasto_odbiorcy`, `nip_odbiorcy`, `metoda_platnosci`, `data_wystawienia`, `numer_faktury`) VALUES
(1, 'Very Important Company', 'Unii Lubelskiej', '12', '71-123', 'Szczecin', '3416771902', 'CzesÅ‚aw MiÅ‚osz', 'Santocka', '233/2', '71-113', 'Szczecin', '2361234456', 'Karta', '2020-09-03', 'FVT/20200903/1'),
(2, 'Very Important Company', 'Unii Lubelskiej', '12', '71-123', 'Szczecin', '3416771902', 'CzesÅ‚aw MiÅ‚osz', 'Santocka', '233/2', '71-113', 'Szczecin', '2361234456', 'Karta', '2020-09-03', 'FVT/20200903/2'),
(3, 'Very Important Company', 'Unii Lubelskiej', '12', '71-123', 'Szczecin', '3416771902', 'Jan Matejko', 'Santocka', '233/2', '71-113', 'Szczecin', '2361234456', 'Karta', '2020-09-03', 'FVT/20200903/3'),
(4, 'Very Important Company', 'Unii Lubelskiej', '12', '71-123', 'Szczecin', '3416771902', 'WisÅ‚awa Szymborska', 'Santocka', '233/2', '71-113', 'Szczecin', '2361234456', 'GotÃ³wka', '2020-09-03', 'FVT/20200903/4');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pozycje_faktury`
--

CREATE TABLE `pozycje_faktury` (
  `id_pozycji` int(11) NOT NULL,
  `nazwa` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `cena_netto` float NOT NULL,
  `stawka_vat` float NOT NULL,
  `ilosc` int(11) NOT NULL,
  `id_faktury` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pozycje_faktury`
--

INSERT INTO `pozycje_faktury` (`id_pozycji`, `nazwa`, `cena_netto`, `stawka_vat`, `ilosc`, `id_faktury`) VALUES
(351, 'Kawa', 22, 8, 2, 1),
(352, 'Herbata', 2, 7, 5, 1),
(353, 'Herbata', 22, 8, 2, 2),
(354, 'Herbata', 22, 8, 2, 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `faktury`
--
ALTER TABLE `faktury`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pozycje_faktury`
--
ALTER TABLE `pozycje_faktury`
  ADD PRIMARY KEY (`id_pozycji`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `faktury`
--
ALTER TABLE `faktury`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT dla tabeli `pozycje_faktury`
--
ALTER TABLE `pozycje_faktury`
  MODIFY `id_pozycji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=356;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
