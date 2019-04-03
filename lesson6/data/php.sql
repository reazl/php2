-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Мар 29 2019 г., 17:48
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `count` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `session_id`, `product_id`, `count`) VALUES
(41, 'lcbd07e6t05jde59ljvi7qu07krd74i4', 3, 1),
(42, 'lcbd07e6t05jde59ljvi7qu07krd74i4', 2, 1),
(51, '365cs5rbh555fdk7gq4is6j9qk3c94vl', 1, 1),
(52, '365cs5rbh555fdk7gq4is6j9qk3c94vl', 1, 1),
(53, 'a1vbgaj2hpprru8um7qg95kcoae4gvbo', 2, 1),
(54, 'a1vbgaj2hpprru8um7qg95kcoae4gvbo', 1, 1),
(55, 'a1vbgaj2hpprru8um7qg95kcoae4gvbo', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `description`, `time`) VALUES
(1, 'Фаст-фуд', 2),
(2, 'Салаты', 8),
(3, 'Горячие блюда', 12),
(4, 'Десерты', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `prev` text NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `text`, `prev`, `category`) VALUES
(1, 'В нашем ресторане появилась кока-кола!!!\r\nНедавно мы закупили два ящика классической и диетической кока-колы для наших дорогих гостей', 'Ваша любимая кола снова с Вами!', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category`) VALUES
(1, 'Пицца', 'С сыром, круглая.', 22, 1),
(2, 'Пончик', 'Сладкий, с шоколадом.', 12, 1),
(3, 'Хот-дог', 'Псевдомясная сосиска в булке', 20, 1),
(4, 'Оливье', 'Салат оливье классический', 24, 2),
(6, 'Крабовый', 'Крабовый салат с крабовыми палочками, но без крабов', 22, 2),
(8, 'Стейк Стриплойн', 'Стейк из мраморной говядины под грибным соусом', 36, 3),
(10, 'Жареная картоха', 'Жареный картофель на сковороде ', 26, 3),
(12, 'Чизкейк \"Нью-йорк\"', 'Классический чизкейк под клюквенным соусом', 18, 4),
(13, 'Эклер', 'Пирожное с заварным кремом', 15, 4),
(14, 'Кока-кола', 'Классическая/диетическая, 0.5', 12, 5),
(15, 'Компотик', 'Сухофруктовый', 13, 5),
(17, 'Милкшейк', 'Клубника/вишня/абрикос', 17, 5),
(32, 'Бутерброд', 'Бутерброд с докторской колбаской', 12, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `hash` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(9, 'admin', '$2y$10$yHO1NnmsJyGlm61IyayYFuCsQ7mE1p5dc5/bdptcsl8OI8VGJSoI.', NULL),
(10, 'user', '$2y$10$BaGOsrjxIVB.8mLCK5GrzupS2HTCnUka.k3wIr6s6c1ore26UIsTu', NULL),
(11, '111', '$2y$10$4EjpDeohH7TZRX7/B.2aIuG5aFWIDFMQxDzlGpzIU1jGPRxZzlXzm', NULL),
(12, '222', '$2y$10$o1brKujekAOGCarTjpPixutED2HOMTjy2Sgw7n7QeJ0wEVPv4MDBa', NULL),
(13, '333', '$2y$10$mryrSBdy19/ANP/ycaLRQOcppLHogMhc2HHYQ6tbSE7K/DaCH5UNO', NULL),
(14, '444', '$2y$10$iWeAkQ1pKT2Pbvh8JTuCD.Rzz21EgjeqRUN8KCFLYRQaPZpRJdIdG', '843017365c9cddd4a91fd9.28694037'),
(15, '555', '$2y$10$ahDPFD2Qmdh.pMK0VKIxKewvgK68GKgkrm3hTYNrT9UYn/4pr8t2O', '971679945c9cde0d6cac82.52684992'),
(16, '1234', '$2y$10$9PmdVqivgvj.TmdkAkbq.ObD92UOiJQ7gZu9sCeusHW8.5K6JnNIm', NULL),
(17, '11111', '$2y$10$O01dI8Xi6rhfPh4VNZ39w.J.9kZVtiUDRAMstwm5FL3GgHV3rKfUC', NULL),
(18, '', '$2y$10$btyRT2t67YKWGYo7YUz8PODGzuvbW89P6Exi.LitIyS5GjXxpss02', NULL),
(19, '', '$2y$10$PbLYVo7NIXLRgmkrPRHKgu5LKttdU/6StIUqHGGzJhVGcZTu4Pxly', NULL),
(20, 'admin', '$2y$10$2EpgXHSEraxFhKq0A55AG.myAoOOMhpjFunHCmmho.6iHZQeuCCEq', NULL),
(21, 'admin', '$2y$10$Q2WW0zMTzblGcd5gKWOevOVqkBIHkMowb4P1VzAN7ZR8jXU3gk24W', NULL),
(22, 'admin', '$2y$10$pjGn3V1gRERllJWYj1anFuHeUAJ894sDZgNNOL9K.wDH7cID6IlJe', NULL),
(23, 'admin', '$2y$10$zuJUjmzp7VsiyVVEok.6rOfPD1/NdTdhG4mivhzuHknqeZu.YBmBi', NULL),
(24, 'admin', '$2y$10$icaoX8S51TZJjVFvxqaDM.dwdIpDjs0Su9a61897rUc3S2qzahs06', NULL),
(25, 'admin', '$2y$10$iaieXQNZurZr4Vwrhq5ou.jdfEhP6ILEQHQEiNutQeIZ3dc16ccHC', NULL),
(26, 'admin', '$2y$10$/hC./2by/gFkkkkKnejc9em.VKeUGsW.EpuW1q3DPCBlEXXZng1xq', NULL),
(27, 'admin', '$2y$10$F2hxp9fIOtoNBDLsHguM2ujCNF9/jUAhtnOiZTqHR0.d8CZn.ckIK', NULL),
(28, 'admin', '$2y$10$eP1MtkJj49DKWIRQu.wjs.ZO6diJAK.sFr3om8LQC4A6.stGcu88K', NULL),
(29, 'admin', '$2y$10$qM1Zvae2gpq2kWPasFChvut6sGE.JvM6iZzCJLM7/nfJ.CZKQL3gS', NULL),
(30, 'admin', '$2y$10$UJqRHM8c1M4ffjcWfpMFLOzqbE4frN.YETpMp.xhNEurAaqSyn/im', NULL),
(31, 'admin', '$2y$10$leXCHy1HjeSTvkaRxsvxGuwPml2Ii8ndqKcf1nqwfX8m4ul3aRhCe', NULL),
(32, 'admin', '$2y$10$Vq0mF8dVDLNXAqSGl18soeC4U4sZ0yJNm7tMCOrQvzp94N5LkNZSi', NULL),
(33, 'admin', '$2y$10$sKDMJtM6jFbM3y5ulVkP.uMrsMy6q7PJCYL3nl3qj/PT520C4kbzS', NULL),
(34, 'admin', '$2y$10$/JS5Q64VmjxUyYJ3HLBhW.Aa0u2rEIlvKy89RbEMQ.8EgpoENlELm', NULL),
(35, 'admin', '$2y$10$lzLmXmqEfXA3oEaS6MjAteWvFB0wNFqmLzBh3ujHc4lSgGjWH3Q1q', NULL),
(36, 'admin', '$2y$10$QlGtUYWYVEndns6RnxOQAeJdEaQziHvZ5jGut5jU63.pDp2RvRNj2', NULL),
(37, 'admin', '$2y$10$g8vcNGrxUbYnbGaNK4FD5O2FZWP1e9.fMJcMJLblLvY4ZE94rHn8K', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
