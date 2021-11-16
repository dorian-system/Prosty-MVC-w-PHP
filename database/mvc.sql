-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 16 Lis 2021, 11:04
-- Wersja serwera: 5.7.33-36
-- Wersja PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `01357044_mvc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `path`, `description`, `visible`, `position`) VALUES
(1, 0, 'Start', 'start', 'System artykułów', 1, 1),
(2, 0, 'Panel Administratora', 'panel-admin', 'Panel Administratora', 1, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `content` text COLLATE utf8_polish_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `created` date NOT NULL,
  `lastmod` date NOT NULL,
  `visible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pages`
--

INSERT INTO `pages` (`id`, `path`, `content`, `title`, `category`, `description`, `keywords`, `created`, `lastmod`, `visible`) VALUES
(1, 'start', '<div><b>Szkielet katalogów:</b></div><div><div class=\"container\"><ul><li><code class=\"php plain\">config<br></code></li><li><code class=\"php plain\">controller</code></li><li><code class=\"php plain\">model</code></li><li><code class=\"php plain\">view</code></li><li><code class=\"php plain\">web</code></li></ul></div></div>', 'Prosty system artykułów', 'PHP', 'Prosty system artykułów MVC PHP', 'mvc php', '2021-11-16', '2021-11-16', 1),
(2, 'panel-admin', '<div>Adres: /admin</div><div>Login: admin</div><div>Hasło: admin<br></div>', 'Panel Administratora', 'PHP', 'Panel Administratora', 'Panel Administratora', '2021-11-16', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `site_info`
--

CREATE TABLE `site_info` (
  `site_name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `site_slogan` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `home_page` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `404_content` text COLLATE utf8_polish_ci NOT NULL,
  `404_title` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `site_info`
--

INSERT INTO `site_info` (`site_name`, `site_slogan`, `home_page`, `404_content`, `404_title`) VALUES
('Prosty MVC', 'MVC PHP', 'start', '<h3><span style=\"color:#B22222;\"><strong>Nie znaleziono żądanego URL-a na tym serwerze. Jeśli wpisałeś URL-a ręcznie, sprawdź, czy się nie pomyliłeś.</strong></span></h3>\r\n', 'Strona nie znaleziona');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(100) COLLATE utf8_polish_ci NOT NULL,
  `user_pass` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `user_email` varchar(100) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_pass`, `user_email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@sait.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
