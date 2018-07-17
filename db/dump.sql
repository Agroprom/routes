SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `host1328075_poezdki`
--

-- --------------------------------------------------------

--
-- Структура таблицы `couriers`
--

CREATE TABLE `couriers` (
  `id` int(11) NOT NULL,
  `fio` varchar(64) CHARACTER SET cp1251 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `couriers`
--

INSERT INTO `couriers` (`id`, `fio`) VALUES
(1, 'Ivanov Ivan Ivanovich'),
(2, 'Petrov Sergey Eduardovich'),
(3, 'Sidorov Roman Anatolivich'),
(4, 'Skryabin Boris Valentinovuch'),
(5, 'Malcev Petr Petrovich'),
(6, 'Ryabin Anton Antonovich'),
(7, 'Aleksashin Sidr Sidorovich'),
(8, 'Kabanov Roman Romanovich'),
(9, 'Koshin Alexey Alexseevich'),
(10, 'Nikolaev Nikolay Stapanovich');

-- --------------------------------------------------------

--
-- Структура таблицы `couriers_regions`
--

CREATE TABLE `couriers_regions` (
  `courier_id` int(10) UNSIGNED NOT NULL,
  `region_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL COMMENT 'Дата выезда',
  `return_date` date NOT NULL COMMENT 'Дата возвращения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `title` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `goto_days` smallint(5) UNSIGNED NOT NULL,
  `return_days` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `title`, `goto_days`, `return_days`) VALUES
(1, 'Peterburg', 1, 1),
(2, 'Ufa', 2, 3),
(3, 'Nizhniy Novgorod', 1, 2),
(4, 'Vladimir', 4, 5),
(5, 'Kostroma', 6, 7),
(6, 'Ekaterinburg', 8, 9),
(7, 'Kovrov', 3, 3),
(8, 'Voronez', 9, 8),
(9, 'Samara', 7, 6),
(10, 'Astrahan', 12, 15);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `couriers_regions`
--
ALTER TABLE `couriers_regions`
  ADD KEY `start_date` (`start_date`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
