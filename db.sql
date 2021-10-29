-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 29 2021 г., 19:01
-- Версия сервера: 5.7.36-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.10

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

--
-- Дамп данных таблицы `megafon_links`
--

INSERT INTO `megafon_links` (`id`, `number`, `link`) VALUES
(2, '79388715974', 'https://take-keys.com/id17297526'),
(3, '79388734695', 'https://take-keys.com/id167354685'),
(4, '79384530942', 'https://take-keys.com/id187535689'),
(5, '79384719579', 'https://take-keys.com/id137284654'),
(6, '79384677562', 'https://take-keys.com/id17378004'),
(7, '79384692672', 'https://take-keys.com/id17297526'),
(8, '79384933301', 'https://take-keys.com/id163735736'),
(9, '79384911233', 'https://take-keys.com/id17864728'),
(10, '79384678883', 'https://take-keys.com/id1834528235'),
(11, '79384919455', 'https://take-keys.com/id176369369'),
(12, '79388739174', 'https://take-keys.com/id14268358'),
(13, '79384527173', 'https://take-keys.com/id18649368'),
(14, '79384605327', 'https://take-keys.com/id13285367'),
(15, '79384521496', 'https://take-keys.com/id15473273'),
(16, '79384637106', 'https://take-keys.com/id163157312'),
(17, '79384916690', 'https://take-keys.com/id14562357'),
(18, '79384882515', 'https://take-keys.com/id165367908'),
(20, '79384547046', 'https://take-keys.com/id14372635'),
(21, '79384909738', 'https://take-keys.com/id13468345'),
(22, '79388732644', 'https://take-keys.com/id1546723477'),
(23, '79388727549', 'https://take-keys.com/id1674374389'),
(24, '79384606858', 'https://take-keys.com/id19345728'),
(25, '79384540725', 'https://take-keys.com/id16734573'),
(26, '79384518676', 'https://take-keys.com/id167278245'),
(27, '79384967646', 'https://take-keys.com/id173426724'),
(28, '79384521081', 'https://take-keys.com/id146724778'),
(29, '79384898057', 'https://take-keys.com/id17346836'),
(30, '79384662119', 'https://take-keys.com/id14257853'),
(31, '79384890025', 'https://take-keys.com/id167345832'),
(32, '79384944936', 'https://take-keys.com/id1529743'),
(33, '79384521959', 'https://take-keys.com/id1637838'),
(34, '79384923221', 'https://take-keys.com/id1393678'),
(35, '79384934871', 'https://take-keys.com/id178463894'),
(36, '79384910894', 'https://take-keys.com/id15463467'),
(37, '79388723352', 'https://take-keys.com/id11219826'),
(38, '79384567668', 'https://take-keys.com/id17563724'),
(39, '79384569007', 'https://take-keys.com/id1326842'),
(40, '79384669343', 'https://take-keys.com/id135637345'),
(41, '79388716235', 'https://take-keys.com/id124356784'),
(42, '79384974350', 'https://take-keys.com/id14245785'),
(43, '79388726155', 'https://take-keys.com/id13256346'),
(44, '79384537116', 'https://take-keys.com/id167437936'),
(45, '79384954737', 'https://take-keys.com/id12345723'),
(46, '79384510264', 'https://take-keys.com/id1387337'),
(47, '79388754536', 'https://take-keys.com/id1352365'),
(48, '79388700225', 'https://take-keys.com/id1463782'),
(49, '79388780234', 'https://take-keys.com/id13256725'),
(50, '79384919066', 'https://take-keys.com/id123452764'),
(51, '79384633137', 'https://take-keys.com/id145623723'),
(52, '79384898740', 'https://take-keys.com/id12526634'),
(53, '79388721563', 'https://take-keys.com/id14562677');

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
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ava` varchar(255) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `ava`, `text`, `created`) VALUES
(1, 'Иванов Иван', 'ava.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '2021-10-27 18:54:18'),
(2, 'Иванов Иван', 'ava.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '2021-10-27 18:54:21'),
(3, 'Иванов Иван', 'ava.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '2021-10-27 18:54:26'),
(4, 'Иванов Иван', 'ava.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '2021-10-27 18:54:26'),
(5, 'Иванов Иван', 'ava.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '2021-10-27 18:54:26');

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
(1, 'parser', 1635523251);

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
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT для таблицы `call_results`
--
ALTER TABLE `call_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145969;
--
-- AUTO_INCREMENT для таблицы `megafon_links`
--
ALTER TABLE `megafon_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT для таблицы `notifies`
--
ALTER TABLE `notifies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT для таблицы `object_types`
--
ALTER TABLE `object_types`
  MODIFY `object_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;
--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `updates`
--
ALTER TABLE `updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
