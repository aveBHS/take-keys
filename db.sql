-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Сен 22 2021 г., 16:35
-- Версия сервера: 5.7.35-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `property`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `address` text NOT NULL,
  `cost` int(11) NOT NULL,
  `metroId` int(11) NOT NULL,
  `phones` text NOT NULL,
  `rooms` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `floors` int(11) NOT NULL,
  `sq` float NOT NULL,
  `categoryId` int(11) NOT NULL,
  `sectionId` int(11) NOT NULL,
  `typeAd` int(11) NOT NULL,
  `cityId` int(11) NOT NULL,
  `regionId` int(11) NOT NULL,
  `source` varchar(100) NOT NULL,
  `isAd` int(11) NOT NULL DEFAULT '0' COMMENT '0 - нет, 1 - да',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - активен\r\n1 - проверка\r\n2 - архив'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `object_types`
--

CREATE TABLE `object_types` (
  `object_type_id` int(11) NOT NULL,
  `object_type_slug` text NOT NULL,
  `price_adder` int(11) NOT NULL,
  `price_subtractor` int(11) NOT NULL,
  `inpars_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `object_types`
--

INSERT INTO `object_types` (`object_type_id`, `object_type_slug`, `price_adder`, `price_subtractor`, `inpars_id`) VALUES
(1, 'Комната', 5000, 5000, 32),
(2, '1-к квартира', 10000, 10000, 28),
(3, 'Студия', 10000, 10000, 47);

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `messenger` text,
  `object_type` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `distance` int(11) NOT NULL DEFAULT '1000',
  `address` varchar(255) DEFAULT NULL,
  `lat` float NOT NULL DEFAULT '0',
  `min_send_time` varchar(5) NOT NULL DEFAULT '8:00',
  `max_send_time` varchar(5) NOT NULL DEFAULT '22:00',
  `lng` float NOT NULL DEFAULT '0',
  `last_result` text,
  `purchased` int(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `updates`
--

CREATE TABLE `updates` (
  `id` int(11) NOT NULL,
  `type` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `updates`
--

INSERT INTO `updates` (`id`, `type`, `time`) VALUES
(1, 'parser', 1632317688);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `object_types`
--
ALTER TABLE `object_types`
  ADD PRIMARY KEY (`object_type_id`);

--
-- Индексы таблицы `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Индексы таблицы `updates`
--
ALTER TABLE `updates`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234235;
--
-- AUTO_INCREMENT для таблицы `object_types`
--
ALTER TABLE `object_types`
  MODIFY `object_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
