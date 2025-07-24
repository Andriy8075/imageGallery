-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Лип 21 2025 р., 15:57
-- Версія сервера: 10.4.32-MariaDB
-- Версія PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `image_gallery`
--

-- --------------------------------------------------------

--
-- Структура таблиці `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `images`
--

INSERT INTO `images` (`id`, `user_id`, `title`, `description`, `file_path`, `created_at`, `updated_at`) VALUES
(1, 1, 'Image 1', 'Description for image 1', 'uevQFk3dcU37kUBqwPhtYmaQaRaHJu5ZGChxPSWF.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(2, 1, 'Image 2', 'Description for image 2', 't0IVYJHhE5peml7FHjEhzsZzmM4jqoWCi6uUIPf2.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(3, 1, 'Image 3', 'Description for image 3', 'IB9FA6p9YBvOE9nC3PJ2qgOXWSJiieXyQy3IFD6r.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(4, 3, 'Image 4', 'Description for image 4', 'Ke9GcdFeycQZXs8lF3B9O8oPaXbKkVAJyMq5LpOG.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(5, 1, 'Image 5', 'Description for image 5', '1pT9pptv0ruzlJuYAMOeCYMFiJhhxoRN4PPswDmo.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(6, 3, 'Image 6', 'Description for image 6', '8gKWIlSwEN4ZlgxfMG6Tdg8blJqIA4onjH5jefT7.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(7, 5, 'Image 7', 'Description for image 7', 'a2YJyteBakcPPMVnujXWljmSjQzLlOImT1l1a3CV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(8, 4, 'Image 8', 'Description for image 8', '46Q4Ce7scHZF38vonGYyqKjVR71zLOLoLi0k2GgC.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(9, 4, 'Image 9', 'Description for image 9', 'DMmGFm8EwVCkETWOanKPgGIK7wHjTRFiMqNWJ61Q.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(10, 3, 'Image 10', 'Description for image 10', 'kqPBkZr8fUmooJFd5Y2lJzsAF6EC51WjcaLUO9UW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(11, 5, 'Image 11', 'Description for image 11', 'IP2J1MKujHO38CzrTJp05CiPBy9BuOzSFZDtvRiD.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(12, 3, 'Image 12', 'Description for image 12', 'nxUwr3nZEBP9hWWGRtOtb4Jkcqz0d7NZcSratyck.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(13, 1, 'Image 13', 'Description for image 13', 'PbpbnPPXETe7WOte5MrqPaVu189L9F49ULyrCRgd.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(14, 1, 'Image 14', 'Description for image 14', 'cUeKOoLwdEC6wK2hJhTUvB9i0Vo8Q0wvbaObxXm3.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(15, 1, 'Image 15', 'Description for image 15', '54XcvftcUJUZWqaZ40SjwuynMhT3NtO0gxi1agsV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(16, 2, 'Image 16', 'Description for image 16', 'Ao3jgDkfVY7cLmEhIeJ1MTOB1NvABCkFew9t9v21.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(17, 4, 'Image 17', 'Description for image 17', 'gX25X9UMDi66oxWZWRdM1geOZrf9wFOG4GxUdRp4.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(18, 3, 'Image 18', 'Description for image 18', 'suECRenwiralQ3WjFYEvT6f4Y5BTkeMieRK7an03.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(19, 3, 'Image 19', 'Description for image 19', '7UpRNXlxJlnMQgiF3xAKDDeFL8RWUj9YJLbhh38X.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(20, 4, 'Image 20', 'Description for image 20', 'IctxNxVgwLSuVNfM2TBfq5TbIGqsudfqE7ZXdoBp.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(21, 5, 'Image 21', 'Description for image 21', '0nwnJffzpzt0UZ0fdJBVTWCT5mkin3Z9PdRlkEig.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(22, 2, 'Image 22', 'Description for image 22', 'RScInQptXnUtBlNoXf1xcknaC6oZyx92fquggVG1.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(23, 2, 'Image 23', 'Description for image 23', 'JczgBJE62yl2HxoWO98vOqxjfB77IYCYmT4Qnu0a.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(24, 2, 'Image 24', 'Description for image 24', '8bQZRSFsfGIH7NBq344B3oNgLG0ya1t02V2tSpc3.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(25, 3, 'Image 25', 'Description for image 25', 'F5kWHMouTUxBzQvCGg7qddsz5dZnlWIgOGpx4yH9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(26, 5, 'Image 26', 'Description for image 26', 'GbcnPyKqF0BQWE9f6OaG1YyWV1uHqf0P31dxE0TD.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(27, 5, 'Image 27', 'Description for image 27', 'pUf1H7PCjkPEIgxaGX32kKhEzOEJUEYwiwzFMi2I.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(28, 4, 'Image 28', 'Description for image 28', '5YEhvfIGEMzuI6NsE5m63TYdK9p6OZoBpzX5ZIkY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(29, 1, 'Image 29', 'Description for image 29', '2ghK5jTHKO8V0RvkNaP3PRB3CyxZEWMLYaC0RNhb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(30, 2, 'Image 30', 'Description for image 30', '9QdFWv9bWJWTxVQrTzX0iz2bcpXHcyCowET6CLpM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(31, 5, 'Image 31', 'Description for image 31', '7oJuIxb6d9YuoN18T5KfLhF5ZiM7POlaepMTEAT4.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(32, 3, 'Image 32', 'Description for image 32', 'PTVOmX7NGQri2n7hilXtuM4VDMHKW1MjTlYdJaRJ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(33, 4, 'Image 33', 'Description for image 33', 'xzbVdIKimVXACMVoSZFT4zfKbEGl5dgTaWZKrSXg.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(34, 2, 'Image 34', 'Description for image 34', 'IfXmrGXWCzMMcITeb34arrOVWI83waQHWslczdTu.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(35, 5, 'Image 35', 'Description for image 35', '002ZUPLGqkWqMfekotv5elpNgtI84m26YIyIdHg4.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(36, 3, 'Image 36', 'Description for image 36', 'cuAlnfIKeB8mPCr1Z56op3MbriFJtxnNE3k5XJEn.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(37, 1, 'Image 37', 'Description for image 37', 'cLa9xo1nVXjHZBIa92SWjwDKgKXaaMooibI0UQ1f.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(38, 2, 'Image 38', 'Description for image 38', 'lhFWVFx3VqGcKcInAELTkbra1hac4su1rid9G701.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(39, 3, 'Image 39', 'Description for image 39', 'IwhQRodOl5zNpEWbZhUa3aE6qfu3stIwThfJWTmj.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(40, 1, 'Image 40', 'Description for image 40', 'CK9uaTMrtM0Y5eIVgN8GhHcfFgVYyOmb5d2ItVn7.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(41, 3, 'Image 41', 'Description for image 41', 'ywVGIzRHGOLZfVbkpnVGnHbpz3gRfH7pQaaWlnKy.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(42, 5, 'Image 42', 'Description for image 42', 'MVqUCAOdgkeV0GVgAqQlnwsOLJ9CC9ThUj7EIFUB.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(43, 2, 'Image 43', 'Description for image 43', 'TO4fNk9wFvaCjgf6B7PJnlF1hL1mZOuDRgAmzcD9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(44, 2, 'Image 44', 'Description for image 44', '8ICKxSgrD39czmzxTlrw34l19TL0KJAQwnBiPMoe.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(45, 1, 'Image 45', 'Description for image 45', 'gIbLLA0kdhR0PMQWAI2rs3yJ1FlcRX6QC9V8cCSE.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(46, 4, 'Image 46', 'Description for image 46', '7ZJUt45FvGUA8GcbieRq2xwenV8hHFuFCQLOlb6f.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(47, 1, 'Image 47', 'Description for image 47', 'dyU95iHVM19mecuq87uO5ZrzaV3NlM0p7nEaHSRW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(48, 4, 'Image 48', 'Description for image 48', 'ROtoYKoLIVuXFD8kTeX3ooy6uqnnqcSdr7G0ez6s.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(49, 4, 'Image 49', 'Description for image 49', 'ELv0ynUrJ24P08SWhWg3ZGtCN5HSh9zRNL14olwL.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(50, 2, 'Image 50', 'Description for image 50', '7KVIzFYKzpseQbCfpcytdoK3DianmkJ17tFKpzbs.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(51, 1, 'Image 51', 'Description for image 51', 'QOzOLYSnj9QCJKn6i9610rCMr9d6j3BQXpAy05XR.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(52, 3, 'Image 52', 'Description for image 52', 'u7UDUjuMHbWJx4R7FKl2RzTfAX1ZwXFt0fpbHzPC.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(53, 5, 'Image 53', 'Description for image 53', 'gn4Qq5iP2r75WO4zsleDWOMnXB3s5iaxVk4C8FO7.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(54, 4, 'Image 54', 'Description for image 54', '4aETZOmN9iuW09RfHPdVYX271u3H7J8AugQZlsPz.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(55, 1, 'Image 55', 'Description for image 55', '9kGD7XTebR4zz9EF2B3BY98kpR0MRUlJ9AbKSe2T.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(56, 2, 'Image 56', 'Description for image 56', '6FVNaNrjrj66Vr9YUrcw4QYQ0ETaCjdSrODulfr4.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(57, 1, 'Image 57', 'Description for image 57', 'pttxWelA2TxXpOmREDGNYEfrgKLme577q9A1NayP.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(58, 1, 'Image 58', 'Description for image 58', 'PfznGyoSG26p5Ft8A7wli6o7OPnWRWExEYUZZPMV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(59, 4, 'Image 59', 'Description for image 59', '1UjGKRvkpDKQvc9lNq9IisyLjQAnmeWdAR3D4U0f.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(60, 1, 'Image 60', 'Description for image 60', 'Db8Ppp0NQifcsLqtJQEXqrpq88oUoBZk04LDQLwM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(61, 5, 'Image 61', 'Description for image 61', 'aTWxRl6tcAaD3vcPQwj0HjYdHfeI0fg249PVHI35.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(62, 5, 'Image 62', 'Description for image 62', 'Q36KCJRXhSlSbsCsR8fkUbY2Xk4P52bVw9ljgfs1.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(63, 1, 'Image 63', 'Description for image 63', 'hoLKd7ClcBKoStfHuwcfOoA4R8KtULscxDQc1TDh.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(64, 1, 'Image 64', 'Description for image 64', 'DZNoZix4QeAMGXO20335K2gWl3iezYcKxWLjmnIQ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(65, 2, 'Image 65', 'Description for image 65', 'EbvOEY19tQt0hE9MML8NNJbPbA68bmhMOHfeO0cu.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(66, 5, 'Image 66', 'Description for image 66', 'xbnk3KNC4WDGes0523Hpw1vW4xH8DOFKUkcLiInv.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(67, 5, 'Image 67', 'Description for image 67', 'sSdHblk50CWc35rFA9mZRVOI5R9zX23mSUh818pI.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(68, 4, 'Image 68', 'Description for image 68', 'H5ZO33lLNn3XUzvNGxEl3L9fZTwsRjdOLAmAqMZD.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(69, 4, 'Image 69', 'Description for image 69', '9UiJ213FcYFPgzuxS05lbs3nT8w1tMr7Rzh7WvpN.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(70, 4, 'Image 70', 'Description for image 70', 'Hy5CA5JqS26ll9pAQrKmAhVxE6T01M7FKoIRt9O3.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(71, 5, 'Image 71', 'Description for image 71', 'lTVE7RN42SdypVmeJTC1dKiunn6H7QJT8HFVsqEM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(72, 1, 'Image 72', 'Description for image 72', 'aoLGKXQFe6xmTP1tI7mJuEFqX0W0zPmjXUTy4rfh.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(73, 3, 'Image 73', 'Description for image 73', 'PjUBmb9aCUQuAiaJ3Lx1SmVKXEaGINBFR50wUkp4.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(74, 5, 'Image 74', 'Description for image 74', 'H1zpci2l6x5pEcBGe9rsVpw3YyfMBhblwxKDvdYF.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(75, 3, 'Image 75', 'Description for image 75', 'wY38OYfEW6xoSgOiwhcMfDqSXu8xjtVqDYUhuYBx.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(76, 2, 'Image 76', 'Description for image 76', 'oV9EZpuhmYhvKWJT2W1UhqTB0axTIgTO1E1rXA00.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(77, 1, 'Image 77', 'Description for image 77', 'plhCfviixtxI3w52420eG2B9PT0IpNufTS6sky0K.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(78, 2, 'Image 78', 'Description for image 78', 'eqJdlhRwLqoOHfezPH5dawp44YIA6QN3rTD0KTnW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(79, 2, 'Image 79', 'Description for image 79', 'aPLHFUefpE9jfmTZOVIwzagHgx4s2wdpmO4x568O.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(80, 5, 'Image 80', 'Description for image 80', 'wMP6Uv44F3ZJWFHZqilFUFfKISrKcotS74G0ZJHW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(81, 4, 'Image 81', 'Description for image 81', 'N804pAMBZBsBcFTtk2d3AFQCdMKkhcYHW9FQIGRc.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(82, 5, 'Image 82', 'Description for image 82', 'wHwba9iKggBVJqNXqpl1ZihQWoyk2TuwG2Vo934b.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(83, 4, 'Image 83', 'Description for image 83', 'pbZbar51DCxhinSPU7GEpNqVV7Ll1OHP5uCmsWSM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(84, 1, 'Image 84', 'Description for image 84', 'fnwupSmhBwnqrK4N0hOQYusbv8Wzd1wfXI3PqS2O.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(85, 2, 'Image 85', 'Description for image 85', '1dkJaK6fbaspzA4aSFMQ4KUGwWMtEFETKaGV5lqq.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(86, 5, 'Image 86', 'Description for image 86', 'sk5dsJBvDu9iprdCrUHSTdEuQb3cseaLCMv8bCYj.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(87, 1, 'Image 87', 'Description for image 87', 'mI8vXWo2lXzwpiX5Crv6DrxgekUpRkgyaIncZJ7p.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(88, 2, 'Image 88', 'Description for image 88', 'laZsUZ8oST5lxrXAKAzwaT2LZSXPxMCJ9XeZzu9L.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(89, 3, 'Image 89', 'Description for image 89', 'HKSQ7clmI8N7cu7gcECu4rCRDCv0nRL8lq5AeHOL.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(90, 5, 'Image 90', 'Description for image 90', 'enoLolSjPUQpaHSYyPWKQrxMfPUi6HfkOXX4FFVx.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(91, 3, 'Image 91', 'Description for image 91', 'fryxKbZ25m18x5KTTutlbeVrSpb1BapyQKUDvg1K.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(92, 1, 'Image 92', 'Description for image 92', 'HoQo4FCpprM0wmVf1GpIR8LWGvaPCHak7YGzPO2V.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(93, 4, 'Image 93', 'Description for image 93', 'rFOQ60SrOLXOp91JHEbc4I9e0gQCtuIVd8XAAMRm.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(94, 3, 'Image 94', 'Description for image 94', 'mwcg9slsdLvP9eF5p73syQelnySSjfNHRMiDnSRV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(95, 2, 'Image 95', 'Description for image 95', 'ARqV38DbtFj6r3Gr946nkHejAMzlmNQzpShbIBow.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(96, 5, 'Image 96', 'Description for image 96', '5urHDMLSBiqRBTdxpa4YK4cTT5EIQshdHdHu3ANY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(97, 1, 'Image 97', 'Description for image 97', 'waTTEAVZo992C1akjF1VM5c21Hljo4mz0n2yzd5G.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(98, 5, 'Image 98', 'Description for image 98', 'uUH6ZAVZUgWhplqJUzO63bKSs0qA66saJXp95oqJ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(99, 4, 'Image 99', 'Description for image 99', 'Vknd35s1MM5qlyvjADaGErYaPNgxyom8Dggo28Zb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(100, 4, 'Image 100', 'Description for image 100', '2DNBvp3c9Kdeec9KXelyyMHHDTku16PMGrCivvrb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(101, 1, 'Image 101', 'Description for image 101', 'kLBHBl2CWALUkgoc0hCbvWhaLjmt03fM1bNngl4S.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(102, 3, 'Image 102', 'Description for image 102', 'Cuj6EIwCQiU9k9bBP4F3GdH7K0JpLNkX3eVtNnLW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(103, 4, 'Image 103', 'Description for image 103', 'NVzdGj6bZv3Pa3cEiWiOoxfCYsneS2YHCRzfuSxb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(104, 4, 'Image 104', 'Description for image 104', 'gwtYwiboTNpT3X6oRMzNlSL99txBwaaWCmMloUd1.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(105, 2, 'Image 105', 'Description for image 105', 'sNANmPj0wopZiLRkEZaMTp7KoYAwkmr2sQKnaVvo.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(106, 1, 'Image 106', 'Description for image 106', 'LQd0ccIRdAXxMYSNJ4IhViV6VdAAs9KK7hyTm4OI.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(107, 5, 'Image 107', 'Description for image 107', 'DMR2wAN79z5izoQhAYup5Jr18KFdpKkeq6O4QmVT.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(108, 4, 'Image 108', 'Description for image 108', '32IV41FzdPRjfvJnUi0RRXVoFIfiEFDSGVXO6GY7.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(109, 5, 'Image 109', 'Description for image 109', 'i8PLhe8DCz1Ou6fPBlFcSP0NiGaSq7z0FGCya99w.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(110, 4, 'Image 110', 'Description for image 110', 'HXqArvoJIidO0saM9wQEkJhGQZOSccBUBGnFmDNM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(111, 3, 'Image 111', 'Description for image 111', 'CZb40iHYNC18YHc6N5JiQEjyu1KnjYYryCnkZfvc.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(112, 2, 'Image 112', 'Description for image 112', 'p4LJqYPLRDj4oX8A0y5OE9dHWcmYePnTjiGdxgUF.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(113, 1, 'Image 113', 'Description for image 113', 'VauFN5bZTKL70hp5XVSHmOcaZUfTA2Q5SqFrdynF.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(114, 3, 'Image 114', 'Description for image 114', 'QZhdIEmaojvRhVG4LNR2o0Maxxac8y2iArcLYs4N.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(115, 5, 'Image 115', 'Description for image 115', 'G5pEiwautiy11ZXS1lXILlFaZKX2jytO4hDnygx8.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(116, 3, 'Image 116', 'Description for image 116', 'mT0DEK4op3GE2Opc1og5FzlVI1dVxARIPWNTys1B.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(117, 4, 'Image 117', 'Description for image 117', '6Gkx9xgqRI7rKOiOzJKP2C6FqGWMjPOSrZ01zWe9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(118, 2, 'Image 118', 'Description for image 118', 'ni5SPEz854s1yvn0DmIy0XWxE2fwVYALVYuBSzQQ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(119, 4, 'Image 119', 'Description for image 119', 'ZTqEBbjlPR57VUwxfjNs9AJ3QAEgbOLDgmuhL6Ch.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(120, 5, 'Image 120', 'Description for image 120', 'lnhnToN8UsSGqMXj8fPlKgfD0EYWu29cWeYM2BKX.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(121, 1, 'Image 121', 'Description for image 121', 'OolUddXH74o7QsASSp9IRI6Mw6LTTNnmD6iafEMw.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(122, 4, 'Image 122', 'Description for image 122', 'iZWys4yIrqIsS7cntgz56fifY59W2KRksQ52uj4U.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(123, 4, 'Image 123', 'Description for image 123', '9woKzCMTekCrJbvAT3lI4dHPsXmRD9Bveqs4s1mH.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(124, 4, 'Image 124', 'Description for image 124', 'xKdEUKaQr2O3nbV9FbkM4qKO54Qb7Hahkj1f2nLg.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(125, 3, 'Image 125', 'Description for image 125', 'AqQ2SHn61WP6OYEdcV7i89q6os3NnBVfOh0zw7zM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(126, 4, 'Image 126', 'Description for image 126', 'HEShJxqTjSvIm0EJcKmcoA21xrsqUynk1iIltiSV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(127, 1, 'Image 127', 'Description for image 127', 'WP7oX83KCF4cpENOrlc5BwqTAl7hixF6hJLx7NWP.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(128, 1, 'Image 128', 'Description for image 128', 'gc7hLhhr3Dlse7U3lPprLa54PQx642bcnkARHQBm.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(129, 5, 'Image 129', 'Description for image 129', 'szioAqsqscfZCGA9s0D8Y57MgSPkryg5mlgF0E0b.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(130, 3, 'Image 130', 'Description for image 130', '481zFdwoIS2zvhvXcOFnVza8rDGSI0MBUZSdiI6Z.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(131, 1, 'Image 131', 'Description for image 131', 'g93dKQlxtVpGJFhDq9ngomgVYOqAmWq6vvKAczrI.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(132, 3, 'Image 132', 'Description for image 132', 'vqCG7QJa4gRJ0frYFHpo5rDan1t7VgsBiH3aR1iK.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(133, 2, 'Image 133', 'Description for image 133', 'BsgEl3skIX2JXAsztSR5kKQEfQnP9wJgKZ8wqiFY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(134, 1, 'Image 134', 'Description for image 134', 'M0Qu34z1mdgTtlpBzgn6iucFDtHopuwXfMqmMbOV.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(135, 1, 'Image 135', 'Description for image 135', 'pR8DXsmbS4DkatOQs1n5eVVaY3Wu64RqKbid4DFY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(136, 1, 'Image 136', 'Description for image 136', 'vqxw75IVwESWtAQHjDFcwcqAV9GhrJP6e4kfzMHU.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(137, 2, 'Image 137', 'Description for image 137', 'DcLEAGXJz9iWQUad1oWB1wF6zj1LPDF43KCgbi4W.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(138, 4, 'Image 138', 'Description for image 138', 'gPGrIhqqZKOUAAUBkQ6gwoWdGEGD6l92Oxs3rK3k.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(139, 3, 'Image 139', 'Description for image 139', 'T0SQ5kpLZrW8stAC85cSwrRaBPE1YSv4k142Q8ib.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(140, 3, 'Image 140', 'Description for image 140', 'qQ5vawU02RRp6oGanrLtMRlK2VL5TBeWNOZzcki1.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(141, 1, 'Image 141', 'Description for image 141', 'yoPS1nbVcRGgmsW94SY6DYmMThWM6LlClKwBlSKq.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(142, 4, 'Image 142', 'Description for image 142', '5lEh7NoOQM99qHlIvMj8GCeUq19a3mnJw4UaOuto.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(143, 5, 'Image 143', 'Description for image 143', 'RdztY3qbTivYqptA81CHlkqvHDFK3gGNS9eJuAad.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(144, 5, 'Image 144', 'Description for image 144', 'x5WrHYw0cBshKFgdSkYPH4xlGGlpC2bqEQaqD74W.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(145, 5, 'Image 145', 'Description for image 145', 'IqmgYDvHW1gLOBAVbDy3mPQZ8MwfErqSpL3061ab.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(146, 1, 'Image 146', 'Description for image 146', 'TRXr2tLa3yc0P9s747uyeAjdUdFyMg8fntTKi4u9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(147, 1, 'Image 147', 'Description for image 147', 'rNGWr7nAsTyvqc8WbZJ3NaHqXJDOyfBv70M6aU6b.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(148, 4, 'Image 148', 'Description for image 148', 'UQl0fZ3dTMWCOGGIKSZY65ncktXHJaxsNatlYga5.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(149, 1, 'Image 149', 'Description for image 149', 'o7tYbmXbuDwKHKC59NmJ8vZk0ctVMdOTYCsigU5E.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(150, 3, 'Image 150', 'Description for image 150', '1ypdcJ8oLTAMVI88z7YuzQAipMX4Lv1v8UdGlEL8.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(151, 3, 'Image 151', 'Description for image 151', 'mp4Y3VhpgBHoTQhBsXlb4JB3GYg9nA4YUu4C9GsM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(152, 1, 'Image 152', 'Description for image 152', 'AtHZzn6gFT468yLeviFDQ4PFzi3t29wbxnmuW5LE.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(153, 5, 'Image 153', 'Description for image 153', 'jt7J92gNJ1r28elqPjRuYvL5OTgPa792RB89i1KY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(154, 5, 'Image 154', 'Description for image 154', 'igLsOHvDm6BrY0GfVitFlxEDTZN6qRnCYBDPoCWs.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(155, 3, 'Image 155', 'Description for image 155', 'vG0J2ZNV8rWFhwLW0oFszvWTfskiXwzemlKSXWWb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(156, 3, 'Image 156', 'Description for image 156', 'Gf4sLAz0hrEzyIPJjU1ug74SYpr81CpgWYZ77Dbt.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(157, 4, 'Image 157', 'Description for image 157', 'ejw5ORI0hN7C3VhWE7hEMIQ5VRxDo6Y2acxnRcsU.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(158, 4, 'Image 158', 'Description for image 158', '204kx2sRbVvaIElBN0CNbrbuFb9zRG97ObdO3VrB.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(159, 3, 'Image 159', 'Description for image 159', 'M4B893xx7V07OW4nthH2y8k426vmIktsYFX8wNKa.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(160, 3, 'Image 160', 'Description for image 160', 'OlIPspc0zhmUzfuvvkiO9c82EU9Ap7Q5XSrISLWX.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(161, 3, 'Image 161', 'Description for image 161', 'x5iUbMeQztRx0fnS9mVvJhtGmuyUVK8gSsZFKHrl.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(162, 2, 'Image 162', 'Description for image 162', 'jxY0Vqo1nvjwl2MPx6sLedmIV3yiscixsh63ynDM.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(163, 5, 'Image 163', 'Description for image 163', '7jPEYpCHr3k2kqQBlg2rW3KLh9lTxiRUmgSoCjNE.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(164, 2, 'Image 164', 'Description for image 164', 'cBznounEZ4TD1xDkKszp1QA83LprKxIzZlcmIpvs.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(165, 5, 'Image 165', 'Description for image 165', 'uxwJXoqTasZhjigf7FwuMAVozmbld8suR1MRZGZL.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(166, 5, 'Image 166', 'Description for image 166', 'GoSubAIgu6WIWQDTyxSQUXApVSNg6Sd6T7agJZ3U.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(167, 5, 'Image 167', 'Description for image 167', '93HpEaCijnmAAje9N2D8ksnGyfy7GqfOM9wRlQSe.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(168, 2, 'Image 168', 'Description for image 168', 'stMwk0FMo8LFtZtKgIdDfyTp9QbNtNokLOQLxk51.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(169, 1, 'Image 169', 'Description for image 169', 'Dicz3VOPZqqdDNJ0q81D1fQNMrBT7zIZAvSHawXb.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(170, 5, 'Image 170', 'Description for image 170', 'mjdheoenBLVIxth0S6DlXQ8pt377gBpvEvualPgJ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(171, 4, 'Image 171', 'Description for image 171', 'IyjwZPQAfsZknLGt12yVOIISfCfCu3YBEG8A3xyI.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(172, 2, 'Image 172', 'Description for image 172', 'wn9gmDyygf7HFfl628yMpopyqA3bGMZ5jUgB809O.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(173, 3, 'Image 173', 'Description for image 173', 'Nf5nOyEC3czo8r9fNpdsArfn94rhjbOMdPJmWRCZ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(174, 3, 'Image 174', 'Description for image 174', 'vEZ55xCuy7gvK2D6ttdVD6QO3hUvlBe7ige25Agn.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(175, 4, 'Image 175', 'Description for image 175', 'SofCwK3ZDhUHOcOtVTeC0eBZMepVikwg8fefj4bD.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(176, 5, 'Image 176', 'Description for image 176', 'dDNhomapLyT2NrK387f63oNJ1JSZsfHY7uM5seQW.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(177, 3, 'Image 177', 'Description for image 177', 'Yt4oQrfIluvVsCJJtQmkW85prPT1X3d2Yf4mmQWQ.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(178, 2, 'Image 178', 'Description for image 178', 'k4uNeJjMjHX8fYy7sR6LqBMeMnkVkymxsdbaQlyY.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(179, 2, 'Image 179', 'Description for image 179', 'AwoNwvyMhvKUQygv2oFXHcICmhJJh8dS5LSDipAj.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(180, 5, 'Image 180', 'Description for image 180', 'ESzc2Co0ry3Ku1lBNUMYloLohLJqfHK0m952QBPT.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(181, 2, 'Image 181', 'Description for image 181', 'hOqwz11fN8iS7TroqNLB7NwmpYMLmbyxpkdLc0Pq.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(182, 5, 'Image 182', 'Description for image 182', 'rFXiQs29chj6uDi33n7KD0cMf7gtXQO4xjy3J9hn.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(183, 5, 'Image 183', 'Description for image 183', 'DgbqVqKYOyKCfvg3X0YyvN40oNrU0SEALs0va8Nw.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(184, 1, 'Image 184', 'Description for image 184', 'c5flMAY4BZHkyNA5MLHNo64T435WiGCTpi0XL4M0.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(185, 1, 'Image 185', 'Description for image 185', '1BWFsu604av7Llxlo4k4pSEnQIms7fcnW5UHlvyo.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(186, 5, 'Image 186', 'Description for image 186', '0ypxhApPQ5ZBvsbIFEZdtXtptK6qdipA1OH8V4R9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(187, 2, 'Image 187', 'Description for image 187', 'RVxX1TlJOYtCpEnbQ2PzTprP9kCDdXrRD2ADvgS8.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(188, 4, 'Image 188', 'Description for image 188', 'jZIn9bcfhXnLETzZjq6crArsaFoCd9boo09Zy47e.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(189, 4, 'Image 189', 'Description for image 189', 'VisCDjEfn1an46Z0tDIhm47UCEmU3PeNkgCM7crG.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(190, 1, 'Image 190', 'Description for image 190', 'aNLJegWwKBpBVUTWaidT9VRe2aZ3qBL1nZH3fJbk.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(191, 4, 'Image 191', 'Description for image 191', 'I3e3uQ5rbPgSemEVTSQkocEKwPSQLYnYyjhaEuu9.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(192, 4, 'Image 192', 'Description for image 192', 'kgLNFZnoAU6Y4gZsSryrSKUqecOFEZJnXKE8Tk6X.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(193, 4, 'Image 193', 'Description for image 193', 'pM6PZMPRdAEeynWZLxprchmSnNgLzCw8RNFvHZOl.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(194, 4, 'Image 194', 'Description for image 194', '8eDZZsOsnrN8urn0PYYVqylp3zZ3rZy8dSEFhq0I.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(195, 2, 'Image 195', 'Description for image 195', 'Zb6pWfz3Wp1STn0RT3PPYD91VyapJSAuT448AqWt.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(196, 3, 'Image 196', 'Description for image 196', 'G79grfZejsKLExlQTknhyaZNsbY8exttK235aKW0.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(197, 1, 'Image 197', 'Description for image 197', 'EhI19zeCbhMKEKfktaFBBpF7e5CpTBYbvtGbqCy6.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(198, 1, 'Image 198', 'Description for image 198', 'riV1oy7xjwBG6Fk1GIQpITLYMaP9RuXAh7VLOzuU.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(199, 3, 'Image 199', 'Description for image 199', '5mB6g1hllquVCyVNCy8T90PGyNIkBfGQ1TLfFYXP.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(200, 2, 'Image 200', 'Description for image 200', 'ZxxKBBOaBfWKrRlMIeUzkEe1yV9wqoO6hvuQCHHG.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(201, 4, 'Image 201', 'Description for image 201', '9meHHX6D4OYoG997ND0Y3Nzt6l3L6H9Atyb7hI4U.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(202, 2, 'Image 202', 'Description for image 202', 'KChpFCMCQSIy78aksay7zkdcygKIoJN8tj5QeDwE.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(203, 4, 'Image 203', 'Description for image 203', 'B3M05HgdCqTTTWfbOGVfr64IL3nU8KBEk0dQacbX.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(204, 3, 'Image 204', 'Description for image 204', 'XR3QzZp3sWx1UhbFHRVVjsdej7c1N7OViUuxrPBz.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04'),
(205, 4, 'Image 205', 'Description for image 205', 'myTG7KciYwigN5eMypkoDOFiSgfZr0ICPUxcREqN.jpg', '2025-07-21 10:53:04', '2025-07-21 10:53:04');

-- --------------------------------------------------------

--
-- Структура таблиці `image_user_likes`
--

CREATE TABLE `image_user_likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `image_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `image_user_likes`
--

INSERT INTO `image_user_likes` (`id`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 4, 63, NULL, NULL),
(2, 3, 62, NULL, NULL),
(3, 4, 11, NULL, NULL),
(4, 2, 21, NULL, NULL),
(5, 3, 58, NULL, NULL),
(6, 2, 14, NULL, NULL),
(7, 3, 15, NULL, NULL),
(8, 4, 35, NULL, NULL),
(9, 5, 21, NULL, NULL),
(10, 4, 82, NULL, NULL),
(11, 1, 93, NULL, NULL),
(12, 2, 75, NULL, NULL),
(13, 1, 24, NULL, NULL),
(14, 1, 82, NULL, NULL),
(15, 4, 27, NULL, NULL),
(16, 5, 5, NULL, NULL),
(17, 4, 92, NULL, NULL),
(18, 5, 88, NULL, NULL),
(19, 1, 54, NULL, NULL),
(20, 2, 27, NULL, NULL),
(21, 4, 87, NULL, NULL),
(22, 3, 54, NULL, NULL),
(23, 2, 25, NULL, NULL),
(24, 5, 52, NULL, NULL),
(25, 4, 30, NULL, NULL),
(26, 1, 76, NULL, NULL),
(27, 3, 97, NULL, NULL),
(28, 5, 33, NULL, NULL),
(29, 5, 96, NULL, NULL),
(30, 5, 29, NULL, NULL),
(31, 1, 42, NULL, NULL),
(32, 2, 96, NULL, NULL),
(33, 5, 81, NULL, NULL),
(34, 1, 60, NULL, NULL),
(35, 5, 49, NULL, NULL),
(36, 5, 3, NULL, NULL),
(37, 5, 63, NULL, NULL),
(38, 4, 61, NULL, NULL),
(39, 2, 29, NULL, NULL),
(40, 5, 22, NULL, NULL),
(41, 2, 97, NULL, NULL),
(42, 5, 42, NULL, NULL),
(43, 3, 83, NULL, NULL),
(44, 3, 41, NULL, NULL),
(45, 3, 72, NULL, NULL),
(46, 1, 58, NULL, NULL),
(47, 4, 26, NULL, NULL),
(48, 1, 86, NULL, NULL),
(49, 1, 98, NULL, NULL),
(50, 4, 80, NULL, NULL),
(51, 4, 4, NULL, NULL),
(52, 3, 76, NULL, NULL),
(53, 4, 20, NULL, NULL),
(54, 4, 90, NULL, NULL),
(55, 1, 9, NULL, NULL),
(56, 3, 87, NULL, NULL),
(57, 2, 99, NULL, NULL),
(58, 1, 43, NULL, NULL),
(59, 5, 75, NULL, NULL),
(60, 4, 51, NULL, NULL),
(61, 5, 82, NULL, NULL),
(62, 5, 11, NULL, NULL),
(63, 1, 84, NULL, NULL),
(64, 1, 55, NULL, NULL),
(65, 1, 72, NULL, NULL),
(66, 4, 81, NULL, NULL),
(67, 4, 6, NULL, NULL),
(68, 3, 19, NULL, NULL),
(69, 1, 81, NULL, NULL),
(70, 4, 95, NULL, NULL),
(71, 4, 88, NULL, NULL),
(72, 3, 71, NULL, NULL),
(73, 2, 94, NULL, NULL),
(74, 4, 89, NULL, NULL),
(75, 5, 72, NULL, NULL),
(76, 4, 55, NULL, NULL),
(77, 3, 37, NULL, NULL),
(78, 5, 30, NULL, NULL),
(79, 5, 15, NULL, NULL),
(80, 5, 76, NULL, NULL),
(81, 3, 96, NULL, NULL),
(82, 5, 62, NULL, NULL),
(83, 3, 6, NULL, NULL),
(84, 5, 80, NULL, NULL),
(85, 4, 59, NULL, NULL),
(86, 2, 37, NULL, NULL),
(87, 3, 55, NULL, NULL),
(88, 3, 92, NULL, NULL),
(89, 1, 28, NULL, NULL),
(90, 2, 88, NULL, NULL),
(91, 1, 96, NULL, NULL),
(92, 4, 41, NULL, NULL),
(93, 1, 10, NULL, NULL),
(94, 3, 36, NULL, NULL),
(95, 2, 83, NULL, NULL),
(96, 1, 23, NULL, NULL),
(97, 2, 9, NULL, NULL),
(98, 2, 62, NULL, NULL),
(99, 3, 73, NULL, NULL),
(100, 1, 75, NULL, NULL),
(101, 3, 12, NULL, NULL),
(102, 5, 61, NULL, NULL),
(103, 4, 10, NULL, NULL),
(104, 4, 79, NULL, NULL),
(105, 2, 76, NULL, NULL),
(106, 2, 51, NULL, NULL),
(107, 4, 3, NULL, NULL),
(108, 3, 28, NULL, NULL),
(109, 2, 30, NULL, NULL),
(110, 2, 31, NULL, NULL),
(111, 3, 80, NULL, NULL),
(112, 1, 77, NULL, NULL),
(113, 5, 97, NULL, NULL),
(114, 3, 21, NULL, NULL),
(115, 3, 34, NULL, NULL),
(116, 3, 30, NULL, NULL),
(117, 1, 48, NULL, NULL),
(118, 4, 31, NULL, NULL),
(119, 5, 54, NULL, NULL),
(120, 2, 5, NULL, NULL),
(121, 5, 85, NULL, NULL),
(122, 1, 39, NULL, NULL),
(123, 2, 60, NULL, NULL),
(124, 3, 40, NULL, NULL),
(125, 1, 83, NULL, NULL),
(126, 1, 11, NULL, NULL),
(127, 3, 61, NULL, NULL),
(128, 1, 71, NULL, NULL),
(129, 3, 52, NULL, NULL),
(130, 2, 67, NULL, NULL),
(131, 4, 86, NULL, NULL),
(132, 5, 44, NULL, NULL),
(133, 1, 87, NULL, NULL),
(134, 4, 5, NULL, NULL),
(135, 5, 68, NULL, NULL),
(136, 2, 26, NULL, NULL),
(137, 2, 48, NULL, NULL),
(138, 5, 58, NULL, NULL),
(139, 2, 66, NULL, NULL),
(140, 2, 78, NULL, NULL),
(141, 5, 53, NULL, NULL),
(142, 4, 83, NULL, NULL),
(143, 5, 10, NULL, NULL),
(144, 3, 49, NULL, NULL),
(145, 2, 39, NULL, NULL),
(146, 5, 48, NULL, NULL),
(147, 5, 13, NULL, NULL),
(148, 4, 75, NULL, NULL),
(149, 4, 2, NULL, NULL),
(150, 4, 100, NULL, NULL),
(151, 2, 64, NULL, NULL),
(152, 1, 1, NULL, NULL),
(153, 3, 8, NULL, NULL),
(154, 2, 56, NULL, NULL),
(155, 1, 94, NULL, NULL),
(156, 1, 59, NULL, NULL),
(157, 1, 49, NULL, NULL),
(158, 2, 54, NULL, NULL),
(159, 1, 4, NULL, NULL),
(160, 5, 36, NULL, NULL),
(161, 1, 52, NULL, NULL),
(162, 4, 9, NULL, NULL),
(163, 2, 34, NULL, NULL),
(164, 4, 84, NULL, NULL),
(165, 4, 19, NULL, NULL),
(166, 4, 12, NULL, NULL),
(167, 3, 57, NULL, NULL),
(168, 3, 84, NULL, NULL),
(169, 1, 80, NULL, NULL),
(170, 4, 98, NULL, NULL),
(171, 1, 22, NULL, NULL),
(172, 4, 21, NULL, NULL),
(173, 1, 38, NULL, NULL),
(174, 2, 69, NULL, NULL),
(175, 2, 36, NULL, NULL),
(176, 5, 31, NULL, NULL),
(177, 2, 45, NULL, NULL),
(178, 3, 91, NULL, NULL),
(179, 4, 99, NULL, NULL),
(180, 2, 58, NULL, NULL),
(181, 3, 42, NULL, NULL),
(182, 5, 16, NULL, NULL),
(183, 4, 76, NULL, NULL),
(184, 4, 48, NULL, NULL),
(185, 4, 22, NULL, NULL),
(186, 3, 93, NULL, NULL),
(187, 3, 56, NULL, NULL),
(188, 2, 40, NULL, NULL),
(189, 4, 49, NULL, NULL),
(190, 3, 68, NULL, NULL),
(191, 4, 42, NULL, NULL),
(192, 2, 85, NULL, NULL),
(193, 3, 43, NULL, NULL),
(194, 1, 61, NULL, NULL),
(195, 1, 13, NULL, NULL),
(196, 2, 81, NULL, NULL),
(197, 5, 87, NULL, NULL),
(198, 2, 71, NULL, NULL),
(199, 3, 99, NULL, NULL),
(200, 5, 98, NULL, NULL),
(201, 3, 82, NULL, NULL),
(202, 5, 18, NULL, NULL),
(203, 5, 32, NULL, NULL),
(204, 1, 65, NULL, NULL),
(205, 5, 86, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблиці `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_16_094341_create_images_table', 1),
(5, '2025_01_16_152051_create_image_user_likes_table', 1),
(6, '2025_01_25_175856_create_comments_table', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Prof. Dedric Walsh III', 'pagac.timmothy@example.org', '2025-07-21 10:48:52', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'ytpAIVVazn', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(2, 'Cora Schaefer I', 'zschoen@example.net', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'PZ9lw5Tcog', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(3, 'Bradly Howell', 'zoie44@example.org', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'Zpy1bEvf7z', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(4, 'Mrs. Annetta Walsh III', 'lang.kory@example.com', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', '1ndVQiFqCj', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(5, 'Monique Tillman', 'hdeckow@example.com', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', '7vaYhDejrU', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(6, 'Dr. Christine Cormier', 'peggie.fahey@example.org', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', '6ifWrdoJWR', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(7, 'Estelle Monahan', 'chet.mckenzie@example.org', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'MbnGyUCXDF', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(8, 'Dr. Nelson Mante', 'reymundo28@example.org', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'lAx5ioe4xZ', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(9, 'Garland Friesen', 'leatha.hilpert@example.com', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'woE4ZLzEPD', '2025-07-21 10:48:53', '2025-07-21 10:48:53'),
(10, 'Mrs. Alize Gottlieb', 'hauck.bulah@example.com', '2025-07-21 10:48:53', '$2y$12$V.1H6WGICRxcOyHaYNoZU.gWjMzKeB//9g7/w5Pk/zWg2I2VeblZy', 'rJFJnHIK2N', '2025-07-21 10:48:53', '2025-07-21 10:48:53');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Індекси таблиці `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_user_id_foreign` (`user_id`),
  ADD KEY `comments_image_id_foreign` (`image_id`);

--
-- Індекси таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Індекси таблиці `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_user_id_foreign` (`user_id`);

--
-- Індекси таблиці `image_user_likes`
--
ALTER TABLE `image_user_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `image_user_likes_user_id_image_id_unique` (`user_id`,`image_id`),
  ADD KEY `image_user_likes_image_id_foreign` (`image_id`);

--
-- Індекси таблиці `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Індекси таблиці `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Індекси таблиці `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT для таблиці `image_user_likes`
--
ALTER TABLE `image_user_likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT для таблиці `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Обмеження зовнішнього ключа таблиці `image_user_likes`
--
ALTER TABLE `image_user_likes`
  ADD CONSTRAINT `1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `image_user_likes_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
