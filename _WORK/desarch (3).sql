-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 12 2021 г., 13:22
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `desarch`
--

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Время последнего обновления',
  `customer_name` varchar(60) NOT NULL COMMENT 'Название заказчика',
  `customer_type` varchar(30) NOT NULL COMMENT 'Тип заказчика',
  `customer_description` text COMMENT 'Описание заказчика'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_update`, `customer_name`, `customer_type`, `customer_description`) VALUES
(2, '2021-09-10 09:24:53', 'ЗАО \"ТПК ЮгТехМонтаж\"', 'Опт', 'Монтажная организация'),
(3, '2021-09-10 09:25:49', 'ТИР \"Вольный стрелок\"', 'Розница', 'Это какое-то крутое описание'),
(4, '2021-09-13 08:13:07', 'ООО \"Вересковый мед\"', 'Розница', 'Это тестовый заказчик'),
(5, '2021-09-13 10:32:49', 'ЗАО \"Бурановские Бабушки\"', 'Сети', 'Это только что добавленный заказчик'),
(6, '2021-09-13 14:31:21', 'ЗАО \"Красное колесо\"', 'Розница', 'Новый заказчик'),
(7, '2021-09-14 07:34:01', 'ЗАО \"Белое и красное\"', 'Сети', 'Что-то про заказчика'),
(8, '2021-09-14 09:44:11', 'ООО \"Красная стрела\"', 'Опт', 'Описание конкретного заказчика'),
(14, '2021-09-14 12:11:57', 'ООО \"Новый заказчик\"', 'Опт', 'Без описания'),
(15, '2021-09-14 12:20:25', 'ООО \"ТНТ-Ростов\"', 'Сети', 'Телекомпания');

-- --------------------------------------------------------

--
-- Структура таблицы `designes`
--

CREATE TABLE `designes` (
  `design_id` int(11) NOT NULL,
  `creative_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `design_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `design_name` varchar(256) NOT NULL DEFAULT 'Новый дизайн',
  `design_source_url` varchar(512) DEFAULT NULL,
  `design_creative_style` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `designes`
--

INSERT INTO `designes` (`design_id`, `creative_id`, `user_id`, `design_update`, `design_name`, `design_source_url`, `design_creative_style`) VALUES
(1, 1, 61, '2021-10-12 08:09:03', 'Серая машина', 'www.depositphotos.com', 'Растительный');

-- --------------------------------------------------------

--
-- Структура таблицы `hash_tags`
--

CREATE TABLE `hash_tags` (
  `hash_id` int(11) NOT NULL,
  `hash_name` varchar(128) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `hash_tags`
--

INSERT INTO `hash_tags` (`hash_id`, `hash_name`) VALUES
(1, 'Абстракция'),
(2, 'Авокадо'),
(3, 'Аниме'),
(4, 'Вензель'),
(5, 'Волна'),
(6, 'Геометрия'),
(7, 'Дерево'),
(8, 'Диагональ'),
(9, 'Единорог'),
(10, 'Животные'),
(11, 'Зайчик'),
(12, 'Звезды'),
(13, 'Зигзаг'),
(14, 'Кактусы'),
(15, 'Камуфляж'),
(16, 'Клетка'),
(17, 'Коты'),
(18, 'Кристалы'),
(19, 'Круги'),
(20, 'Кружево'),
(21, 'Леопард'),
(22, 'Листья'),
(23, 'Меандр'),
(24, 'Мишка'),
(25, 'Мозаика'),
(26, 'Мрамор'),
(27, 'Оливки'),
(28, 'Осьминоги'),
(29, 'Пальмы'),
(30, 'Плетенка'),
(31, 'Полоски'),
(32, 'Принт арт-деко'),
(33, 'Птицы'),
(34, 'Пчелки'),
(35, 'Ромашки'),
(36, 'Тай-дай'),
(37, 'Твид'),
(38, 'Текстуры'),
(39, 'Тропики'),
(40, 'Фрукты'),
(41, 'Цветы'),
(42, 'Шкура'),
(43, 'Этника'),
(44, 'Малевич'),
(45, 'Весенняя тема');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `task_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата последного обновления',
  `task_setdatetime` date NOT NULL COMMENT 'Дата постановки задачи',
  `task_deadline` date NOT NULL COMMENT 'Крайний срок',
  `user_id` int(11) NOT NULL COMMENT 'Постановщик задачи',
  `customer_id` int(11) NOT NULL COMMENT 'Заказчик',
  `task_name` varchar(128) NOT NULL COMMENT 'Название задачи',
  `task_number` varchar(128) NOT NULL COMMENT 'Номер задачи',
  `task_status` varchar(64) NOT NULL DEFAULT 'Черновик' COMMENT 'Статус задачи',
  `task_description` varchar(256) DEFAULT NULL COMMENT 'Описание задачи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_update`, `task_setdatetime`, `task_deadline`, `user_id`, `customer_id`, `task_name`, `task_number`, `task_status`, `task_description`) VALUES
(1, '2021-10-12 08:00:54', '2021-10-12', '2021-10-17', 2, 15, 'Закупка дизайнов', 'FR-0001', 'Поставлена', ''),
(2, '2021-10-12 09:59:12', '2021-10-12', '2021-10-14', 2, 7, 'Тест электронной почты', 'FR-0002', 'Поставлена', 'Это задание - тестирование электронной почты'),
(3, '2021-10-12 10:05:20', '2021-10-12', '2021-10-12', 2, 4, 'Какая-то тестовая задача', 'FR-0192', 'Поставлена', 'wqewqer'),
(4, '2021-10-12 10:05:31', '2021-10-12', '2021-10-12', 2, 2, 'Разработка лоскутного одеяла', 'FR-0192', 'Поставлена', ''),
(5, '2021-10-12 10:09:50', '2021-10-12', '2021-10-12', 2, 2, 'Разработка лоскутного одеяла', 'FR-0192', 'Поставлена', '131');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_login` varchar(30) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_name` varchar(30) DEFAULT NULL,
  `user_surname` varchar(50) DEFAULT NULL,
  `user_hash` varchar(32) DEFAULT '',
  `user_role` varchar(30) DEFAULT NULL,
  `user_superior` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_name`, `user_surname`, `user_hash`, `user_role`, `user_superior`) VALUES
(1, 'zoom@tk-ug.ru', 'f25c28fa4d121e1ac3a1286c59822424', 'Сергей', 'Цветков', 'b29e3c9e982c946d84f8bacf76c33bd1', 'adm', NULL),
(2, 'frolova@tk-ug.ru', '4b125a92f0480f68a9d4d38e492b7278', 'Юлианна', 'Фролова', 'eae5bc283aa5c561053a5a6a05762ca9', 'mgr', NULL),
(61, 'surkova@tk-ug.ru', '8beda5eb46666320a6895a443f06febb', 'Вероника', 'Суркова', '7461b100d9b29b679a33f4be7dc0f30b', 'dgr', 2),
(62, 'lilit@tk-ug.ru', 'b8e2e5a0a3a541242657d3199c6c2282', 'Лилит', 'Аршакян', '2399cf3c6557d37556b25b2512c6dbda', 'dgr', 2),
(63, 'daria@tk-ug.ru', '9f482d7e3332ec534c4edc23ab608e7a', 'Дарья', 'Филатьева', '', 'dgr', 2),
(64, 'melnik@tk-ug.ru', 'e217c791bc88277a56caceee1f930ab8', 'Дмитрий', 'Мельник', '833a44d5d585b06b848b0c5e12911ba4', 'ctr', NULL),
(65, 'grozov@tk-ug.ru', '32215a59e22348eb55d8b1b777cf0b06', 'Александр', 'Грозов', '82226372107aafa579a34a4f39607905', 'ctr', NULL),
(66, 'kosse@tk-ug.ru', '8957ee7bd966918dfc9221e9bd45ec97', 'Андрей', 'Коссе', 'a52007b0b2c58a419aca972a7a49f853', 'ctr', NULL),
(67, 'pupkin@tk-ug.ru', 'c924740cbaf4032b197ff7c64c059320', 'Василий', 'Пупкин', '', 'dgr', 68),
(68, 'stalin@tk-ug.ru', '93eefcd98d3ff87dcdd0c506d04acefc', 'Елена', 'Артеменко', '', 'mgr', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `сreatives`
--

CREATE TABLE `сreatives` (
  `creative_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL COMMENT 'Родительская задача',
  `creative_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Изменение',
  `creative_start_date` date DEFAULT NULL COMMENT 'Начало работы',
  `creative_end_date` date DEFAULT NULL COMMENT 'Окончание работы',
  `creative_name` varchar(128) NOT NULL DEFAULT 'Новый креатив' COMMENT 'Название',
  `creative_source` varchar(256) DEFAULT NULL COMMENT 'Источник вдохновения',
  `creative_development_type` varchar(128) DEFAULT NULL COMMENT 'Тип разработки',
  `creative_status` varchar(64) NOT NULL DEFAULT 'В задаче' COMMENT 'Статус по оценкам',
  `creative_style` varchar(128) DEFAULT NULL COMMENT 'Стиль креатива',
  `user_id` int(11) DEFAULT NULL COMMENT 'Дизайнер креатива',
  `creative_magnitude` varchar(128) DEFAULT NULL COMMENT 'Изменение по отношению к оригиналу в %',
  `creative_description` varchar(512) DEFAULT NULL COMMENT 'Описание',
  `creative_hash_list` varchar(256) DEFAULT NULL COMMENT 'Набор тегов'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `сreatives`
--

INSERT INTO `сreatives` (`creative_id`, `task_id`, `creative_update`, `creative_start_date`, `creative_end_date`, `creative_name`, `creative_source`, `creative_development_type`, `creative_status`, `creative_style`, `user_id`, `creative_magnitude`, `creative_description`, `creative_hash_list`) VALUES
(1, 1, '2021-10-12 08:02:07', '2021-10-12', '2021-10-12', 'Белый ветер', 'www.depositphotos.com', 'Компиляция', 'Принят', 'Персонажи', 61, 'от 50 до 80%', 'Это креатив скомпилирован из нескольких картинок', 'Абстракция|Авокадо|Коты|Листья');

-- --------------------------------------------------------

--
-- Структура таблицы `сreative_grades`
--

CREATE TABLE `сreative_grades` (
  `сreative_grade_id` int(11) NOT NULL,
  `creative_grade_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creative_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creative_grade_pos` varchar(56) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `сreative_grades`
--

INSERT INTO `сreative_grades` (`сreative_grade_id`, `creative_grade_update`, `creative_id`, `user_id`, `creative_grade_pos`) VALUES
(1, '2021-10-12 08:07:08', 1, 65, 'on'),
(2, '2021-10-12 08:07:27', 1, 64, 'on'),
(3, '2021-10-12 08:07:43', 1, 66, 'on');

-- --------------------------------------------------------

--
-- Структура таблицы `сreative_сomments`
--

CREATE TABLE `сreative_сomments` (
  `сreative_comment_id` int(11) NOT NULL,
  `creative_comment_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creative_id` int(11) NOT NULL COMMENT 'ID Креатива',
  `user_id` int(11) NOT NULL COMMENT 'ID Юзера',
  `creative_comment_focus` varchar(128) NOT NULL DEFAULT 'neutral' COMMENT 'Направленность',
  `creative_comment_content` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `сreative_сomments`
--

INSERT INTO `сreative_сomments` (`сreative_comment_id`, `creative_comment_update`, `creative_id`, `user_id`, `creative_comment_focus`, `creative_comment_content`) VALUES
(1, '2021-10-12 08:06:19', 1, 2, 'positive', 'Дизайн принят постановщиком задачи.');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Индексы таблицы `designes`
--
ALTER TABLE `designes`
  ADD PRIMARY KEY (`design_id`);

--
-- Индексы таблицы `hash_tags`
--
ALTER TABLE `hash_tags`
  ADD PRIMARY KEY (`hash_id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `сreatives`
--
ALTER TABLE `сreatives`
  ADD PRIMARY KEY (`creative_id`);

--
-- Индексы таблицы `сreative_grades`
--
ALTER TABLE `сreative_grades`
  ADD PRIMARY KEY (`сreative_grade_id`);

--
-- Индексы таблицы `сreative_сomments`
--
ALTER TABLE `сreative_сomments`
  ADD PRIMARY KEY (`сreative_comment_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `designes`
--
ALTER TABLE `designes`
  MODIFY `design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `hash_tags`
--
ALTER TABLE `hash_tags`
  MODIFY `hash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT для таблицы `сreatives`
--
ALTER TABLE `сreatives`
  MODIFY `creative_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `сreative_grades`
--
ALTER TABLE `сreative_grades`
  MODIFY `сreative_grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `сreative_сomments`
--
ALTER TABLE `сreative_сomments`
  MODIFY `сreative_comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
