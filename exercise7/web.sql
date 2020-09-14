-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 13 2020 г., 20:39
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `web`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `age` tinyint(3) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `skills` json DEFAULT NULL,
  `jobTitle` varchar(50) DEFAULT NULL,
  `companyName` varchar(50) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `age`, `birthday`, `email`, `country`, `city`, `address`, `skills`, `jobTitle`, `companyName`, `startDate`, `endDate`) VALUES
(10, 'Zuboriev', 'аиываи', 33, '2020-09-10', 'zuborev.kh@gmail.com', 'Montenegro', 'ываиываиы', 'ваиываи', '[\"ыивыаи\", \"ываивыаиыв\", \"аиываивы\", \"\", \"\"]', 'ываивыаиы', 'ваиываи', '2020-09-03', '2020-09-18'),
(11, 'Zuboriev', 'SAsdsdf', 22, NULL, 'grush2un@rambler.ru', 'Montenegro', 'asdvasdv', 'asdvsadv', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(12, 'svsdvs', 'dvsdvsd', NULL, NULL, 'adsmin@admin.com', 'Montenegro', 'sdvsdv', 'sdvsdv', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(13, 'Zuboriev', 'sdfbsdfb', NULL, NULL, 'zuboddrev.kh@gmail.com', 'Montenegro', 'sdfbs', 'dfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(14, 'Zuboriev', 'sdf', 33, NULL, 'grussdfbhun@rambler.ru', 'Montenegro', 'sdfb', 'sdb', '[\"sdfbdsfbs\", \"dfbdsfb\", \"sdbds\", \"sdbdsfbs\", \"dbdfb\"]', 'sdfbdsfbs', 'dbdfb', '2020-09-03', '2020-09-03'),
(15, 'Zuboriev', 'dvsdvsd', 33, NULL, 'zubodsddsvsdrev.kh@gmail.coms', 'Montenegro', 'asdvasdvas', 'dvsadv', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(16, 'Zuboriev', 'Andrey', 23, '2020-09-04', 'zubor22ev.kh@gmail.com', 'Montenegro', 'sdvsdvsdv', 'sadvsdfvsdf', '[\"sdfbdsfbsd\", \"sdfbdsfbdfb\", \"sdfbdfb\", \"dsbdfbdsfbdfsb\", \"sdbdsfbsd\"]', 'sdfdsfbdsfb', 'sdfbdsfbds', '2020-09-02', '2020-09-17'),
(17, 'Vasiliy', 'Sdsfbdfb', 44, '2020-09-03', 'gruhfun@rambler.ru', 'Ukraine', 'dfbdfb', 'dfbdfbdfbdfb', '[\"xdbdsfbdsfbs\", \"bsdbsdfbdsfb\", \"sdbsdfbsdfbs\", \"dfbdsfbsdfbs\", \"dbsdfbsdfb\"]', 'sdfbsdfbsd', 'sdfbdsfb', '2020-09-26', '2020-10-02'),
(18, 'dfbsdfbsdfb', 'sdfb', 17, NULL, 'zuboredsfbv.kh@gmail.com', 'Montenegro', 'dfbs', 'dbf', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(19, 'Zuboriev', 'ФЫВИмываи', 44, '2020-09-03', 'zubвorev.nik77@gmail.com', 'Montenegro', 'аптапт', 'автапт', '[\"ватпват\", \"ватватп\", \"ватватв\", \"атват\", \"ватва\"]', 'ватватв', 'атавт', '2020-09-03', '2020-09-25'),
(20, 'аптчаптчап', 'тсчтачпт', 44, NULL, 'grushпun@rambler.ru', 'Montenegro', 'чаптчаптча', 'тсчти', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(21, 'иываиываиыва', 'ивыаивыаи', 43, NULL, 'grushвыаиun@rambler.ru', 'Montenegro', 'ывиываи', 'ываивыаи', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(22, 'выаивыаи', 'ываиываи', 33, NULL, 'gruсshun@rambler.ruс', 'Montenegro', 'выаиываиы', 'ваиываи', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(23, 'Zuboriev', '444444', 44, NULL, 'gru4shun@rambler.ru', 'Montenegro', 'dfbsdfb', NULL, '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(24, 'Zuboriev', '####', 33, NULL, 'grushufbn@rambler.rud', 'Montenegro', 'dfbdfb', 'dfbdfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(25, 'Zuboriev', 'sdfbsdfb', 33, NULL, 'zubordbfev.kh@gmail.com', 'Montenegro', 'sdfbdsf', 'sdfbsdfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(26, 'Zuboriev', 'adfbsdfb', 33, NULL, 'zubossrev.kh@gmail.com', 'Montenegro', 'adfbsdfb', NULL, '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(27, 'sdfbsdfb', 'sfdbdsfb', 44, NULL, 'zuborfev.kh@gmail.comf', 'Montenegro', 'dfbsdfbs', 'dfbdsfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(28, 'апьапь', 'апьпарь', 55, NULL, 'zuborрev.kh@gmail.comр', 'Montenegro', 'апьпаьап', 'ьпаь', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(29, 'Zuboriev', 'ватавт', 44, NULL, 'zuborааev.kh@gmail.com', 'Montenegro', 'ватавт', 'ватапт', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(30, 'Zuboriev', 'апиваыи', 44, NULL, 'zuboааrev.kh@gmail.com', 'Montenegro', 'вапиавп', 'вававва', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(31, 'Zuboriev', 'dbdfb', 33, NULL, 'zuborddev.kh@gmail.com', 'Montenegro', 'sdfbsdfb', 'sdfbsdfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(32, 'sdfbdfsb', 'sdfdb', 33, NULL, 'zubosdbrev.kh@gmail.com', 'Montenegro', 'dfbdsfb', 'sdfbdfsb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(33, 'Zuboriev', 'ergerg', 33, NULL, 'zuboreddv.kh@gmail.com', 'Montenegro', 'sdfgdfg', 'sdfgdfg', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(34, 'Zuboriev', 'sdfbdsfb', 22, NULL, 'zubborev.kh@gmail.comsd', 'Montenegro', 'sbdfb', 'sdfbdfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL),
(35, 'Zuboriev', 'fdbsd', 33, NULL, 'grushun@rambler.ru', 'Montenegro', 'sdfbdsfbs', 'dfbdsfb', '[\"\", \"\", \"\", \"\", \"\"]', NULL, NULL, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
