-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 16 2021 г., 14:12
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
-- Структура таблицы `calls`
--

CREATE TABLE `calls` (
  `id` int(11) NOT NULL,
  `call_id` varchar(25) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `call_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Новая заявка\r\n1 - Заявка отправлена\r\n2 - Получен результат',
  `call_type` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Звонок после регистрации\r\n1 - Звонок собственнику по запросу',
  `result_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `call_results`
--

CREATE TABLE `call_results` (
  `id` int(11) NOT NULL,
  `is_owner` int(11) NOT NULL,
  `is_actual` int(11) NOT NULL,
  `record` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `path` text NOT NULL,
  `isAd` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `megafon_links`
--

CREATE TABLE `megafon_links` (
  `id` int(11) NOT NULL,
  `number` text NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `notifies`
--

CREATE TABLE `notifies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - новый\r\n1 - принят\r\n2 - обработан',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `name` text,
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
  `metroSlug` text,
  `materialSlug` text,
  `source` varchar(100) NOT NULL,
  `isAd` int(11) NOT NULL DEFAULT '0' COMMENT '0 - нет, 1 - да',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - активен\r\n1 - проверка\r\n2 - архив',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `lng` float NOT NULL DEFAULT '0',
  `min_send_time` varchar(5) NOT NULL DEFAULT '8:00',
  `max_send_time` varchar(5) NOT NULL DEFAULT '22:00',
  `last_result` text,
  `recommendations` text,
  `whatsapp_sent` int(11) NOT NULL DEFAULT '0',
  `purchased` int(11) NOT NULL DEFAULT '0',
  `is_free` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 - Деактивация\r\n1 - Новая заявка\r\n2 - Идет отправка промо\r\n3 - Ожидание брони\r\n4 - Готов к отправке подбора\r\n5 - Идет отправка подбора',
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
(1, 'parser', 1634353010);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Пользователь',
  `remember_token` varchar(128) DEFAULT NULL,
  `email_token` varchar(32) DEFAULT NULL,
  `reset_token` varchar(128) DEFAULT NULL,
  `request_id` int(11) NOT NULL DEFAULT '-1',
  `admin` int(11) NOT NULL DEFAULT '0',
  `joined` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `call_results`
--
ALTER TABLE `call_results`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `megafon_links`
--
ALTER TABLE `megafon_links`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`(11));

--
-- Индексы таблицы `notifies`
--
ALTER TABLE `notifies`
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
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `calls`
--
ALTER TABLE `calls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT для таблицы `call_results`
--
ALTER TABLE `call_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116123;
--
-- AUTO_INCREMENT для таблицы `megafon_links`
--
ALTER TABLE `megafon_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT для таблицы `notifies`
--
ALTER TABLE `notifies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `object_types`
--
ALTER TABLE `object_types`
  MODIFY `object_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT для таблицы `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
