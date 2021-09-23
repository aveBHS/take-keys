-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 24 2021 г., 00:52
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `inpars`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
                          `id` int NOT NULL,
                          `object_id` int NOT NULL,
                          `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
                           `id` bigint NOT NULL,
                           `title` varchar(255) NOT NULL,
                           `description` text NOT NULL,
                           `lat` float NOT NULL,
                           `lng` float NOT NULL,
                           `address` text NOT NULL,
                           `cost` int NOT NULL,
                           `metroId` int NOT NULL,
                           `name` varchar(255) NOT NULL,
                           `phones` text NOT NULL,
                           `rooms` int NOT NULL,
                           `floor` int NOT NULL,
                           `floors` int NOT NULL,
                           `sq` float NOT NULL,
                           `categoryId` int NOT NULL,
                           `sectionId` int NOT NULL,
                           `typeAd` int NOT NULL,
                           `cityId` int NOT NULL,
                           `regionId` int NOT NULL,
                           `metroSlug` text,
                           `materialSlug` text,
                           `source` varchar(100) NOT NULL,
                           `isAd` int NOT NULL DEFAULT '0' COMMENT '0 - нет, 1 - да',
                           `status` int NOT NULL DEFAULT '0' COMMENT '0 - активен\r\n1 - проверка\r\n2 - архив',
                           `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `object_types`
--

CREATE TABLE `object_types` (
                                `object_type_id` int NOT NULL,
                                `object_type_slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                                `price_adder` int NOT NULL,
                                `price_subtractor` int NOT NULL,
                                `inpars_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
                            `id` int NOT NULL,
                            `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                            `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                            `messenger` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
                            `object_type` int NOT NULL,
                            `price` int NOT NULL,
                            `distance` int NOT NULL DEFAULT '1000',
                            `address` varchar(255) DEFAULT NULL,
                            `lat` float NOT NULL DEFAULT '0',
                            `min_send_time` varchar(5) NOT NULL DEFAULT '8:00',
                            `max_send_time` varchar(5) NOT NULL DEFAULT '22:00',
                            `lng` float NOT NULL DEFAULT '0',
                            `last_result` text,
                            `whatsapp_sent` int NOT NULL DEFAULT '0',
                            `purchased` int NOT NULL DEFAULT '0',
                            `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `updates`
--

CREATE TABLE `updates` (
                           `id` int NOT NULL,
                           `type` text NOT NULL,
                           `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `updates`
--

INSERT INTO `updates` (`id`, `type`, `time`) VALUES
    (1, 'parser', 500048);

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
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
    MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `object_types`
--
ALTER TABLE `object_types`
    MODIFY `object_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `requests`
--
ALTER TABLE `requests`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `updates`
--
ALTER TABLE `updates`
    MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
