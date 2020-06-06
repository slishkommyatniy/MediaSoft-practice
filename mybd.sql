-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 06 2020 г., 16:23
-- Версия сервера: 5.7.29
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mybd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `uploaded_text`
--

CREATE TABLE `uploaded_text` (
  `ID` int(11) NOT NULL,
  `content` text,
  `date` date DEFAULT NULL,
  `words_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `uploaded_text`
--

INSERT INTO `uploaded_text` (`ID`, `content`, `date`, `words_count`) VALUES
(24, 'В город ворвалась зима.\r\n Еще вчера ветер гонял по улицам опавшие листья, моросил холодный дождь.\r\n Сегодня же с утра все белым-бело. За ночь снежная туча щедро поделилась снегом,\r\n который теперь искрился и переливался в лучах яркого утреннего солнца.\r\n Лицо прохожих, одетых в теплые шубы и пуховики, были по-детски радостными.\r\n Ребятишки же не скрывали свой восторг и громко радовались долгожданному снегу.\r\n Возле школ развернулись настоящие снежные баталии.\r\n Многие школьники, да и некоторые учителя оказались обстреляны снежками.\r\n У всех в этот день было радостное, приподнятое настроение.\r\n Зима вступила в свои владения, подарив людям ощущение сказки, волшебства.', '2020-06-06', 94);

-- --------------------------------------------------------

--
-- Структура таблицы `word`
--

CREATE TABLE `word` (
  `ID` int(11) NOT NULL,
  `text_id` int(11) DEFAULT NULL,
  `word` text,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `uploaded_text`
--
ALTER TABLE `uploaded_text`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `word`
--
ALTER TABLE `word`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `uploaded_text`
--
ALTER TABLE `uploaded_text`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `word`
--
ALTER TABLE `word`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2402;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
