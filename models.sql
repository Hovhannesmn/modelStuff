-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 18 2015 г., 20:36
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `models`
--

-- --------------------------------------------------------

--
-- Структура таблицы `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`, `file_size`, `url`, `title`, `caption`, `alt`, `description`, `width`, `height`, `created_at`, `updated_at`) VALUES
(1, 'slide_1_1.jpg', 'image/jpeg', '81.27 KB', 'uploads/slide_1_1.jpg', 'Slide-1jpg', '', '', '', 0, 0, '2015-09-16 11:23:26', '2015-09-16 11:23:26'),
(2, 'slide_2_1.jpg', 'image/jpeg', '74.84 KB', 'uploads/slide_2_1.jpg', 'Slide-2jpg', '', '', '', 0, 0, '2015-09-16 11:23:26', '2015-09-16 11:23:26'),
(3, 'slide_3_1.jpg', 'image/jpeg', '132.96 KB', 'uploads/slide_3_1.jpg', 'Slide-3jpg', '', '', '', 0, 0, '2015-09-16 11:23:27', '2015-09-16 11:23:27'),
(4, 'nicci-bg-left_1.jpg', 'image/jpeg', '54.44 KB', 'uploads/nicci-bg-left_1.jpg', 'Nicci-bg-leftjpg', '', '', '', 0, 0, '2015-09-16 11:26:16', '2015-09-16 11:26:16'),
(5, 'nicci-bg-right_1.jpg', 'image/jpeg', '45.49 KB', 'uploads/nicci-bg-right_1.jpg', 'Nicci-bg-rightjpg', '', '', '', 0, 0, '2015-09-16 11:26:16', '2015-09-16 11:26:16');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_07_26_125009_create_media_table', 1),
('2015_07_28_121036_create_roles_table', 1),
('2015_07_28_121048_create_role_user_table', 1),
('2015_07_29_134218_Create_service_table', 1),
('2015_07_30_125259_create_schedules_table', 1),
('2015_07_31_133715_create_profiles_table', 1),
('2015_08_02_135958_create_profile_service_table', 1),
('2015_08_03_112447_create_profile_gallery_table', 1),
('2015_08_15_184145_create_pages_table', 1),
('2015_08_15_185301_create_page_translations_table', 1),
('2015_08_19_121829_create_sliders_table', 1),
('2015_08_19_153533_create_galleries_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `content`, `settings`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Home', '', '{"template":"home"}', '', '', '', '2015-09-16 11:22:39', '2015-09-16 11:22:39'),
(2, 'about', 'About me', '', '{"template":"profile"}', '', '', '', '2015-09-16 11:25:29', '2015-09-16 11:25:29'),
(3, 'services', 'Our meeting', '', '{"template":"services"}', '', '', '', '2015-09-16 11:28:11', '2015-09-16 11:28:11'),
(4, 'contact', 'Contact me', '', '{"template":"contacts"}', '', '', '', '2015-09-18 07:30:54', '2015-09-18 07:30:54');

-- --------------------------------------------------------

--
-- Структура таблицы `page_translations`
--

CREATE TABLE IF NOT EXISTS `page_translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `settings` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cellphone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `languages` text COLLATE utf8_unicode_ci NOT NULL,
  `age` int(10) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `breast_number` int(10) unsigned NOT NULL,
  `breast_letter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `haircolor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intimicy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smoke` tinyint(1) NOT NULL,
  `drink` tinyint(1) NOT NULL,
  `about_short` text COLLATE utf8_unicode_ci NOT NULL,
  `about_full` text COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `name`, `contact_email`, `cellphone`, `nationality`, `languages`, `age`, `weight`, `height`, `breast_number`, `breast_letter`, `haircolor`, `intimicy`, `smoke`, `drink`, `about_short`, `about_full`, `confirmed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nicci Paris', 'nicciparis@gmail.com', '708-901-0598', 'German', '["English","Deutsch"]', 23, 50, 186, 60, 'D', 'dark_brown', 'clean', 0, 0, '{"de":"Nesciunt officiis debitis placeat occaecati earum est ea.","en":"Laboriosam doloribus ipsum eveniet aliquid ducimus saepe odit.","it":"Doloremque error fuga deserunt libero ut qui.","pl":"Sit qui dicta totam iusto non veniam.","ua":"Delectus doloremque amet beatae delectus quo quo.","ru":"Assumenda laboriosam reiciendis delectus dolorum sapiente."}', '{"de":"Et et mollitia praesentium enim officiis quibusdam deleniti. Ut at repellendus ipsum qui. Ut molestiae officia officia porro. Sint magni dolores doloribus ut ex qui.","en":"Incidunt nemo non autem distinctio odio. Suscipit exercitationem quia ea quo iste reprehenderit. Et laborum dignissimos ad vitae accusamus. Recusandae iusto voluptas reiciendis cumque ad iusto tempora ratione.","it":"Rerum ab aut sunt rerum nemo officiis magnam. Velit sint molestias et unde molestiae. Dolorum eum odio est cupiditate autem molestias impedit. Amet cumque nihil nulla sapiente dolor dolores fuga pariatur.","pl":"Sapiente veritatis magnam velit enim repellendus et explicabo. Enim optio qui qui iure inventore non. Sed et qui aliquid voluptatem temporibus aut.","ua":"Nisi cupiditate ea ipsam quia. Officiis ratione possimus non eligendi ad aperiam. Sint vitae aut repellendus cum et quidem rerum.","ru":"Aperiam expedita omnis aut est quos a. Similique ut soluta est. Eaque repellendus ipsa hic reprehenderit tenetur placeat dolores."}', 1, '2015-09-16 11:19:26', '2015-09-16 11:19:26');

-- --------------------------------------------------------

--
-- Структура таблицы `profile_images`
--

CREATE TABLE IF NOT EXISTS `profile_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_general` tinyint(1) NOT NULL,
  `order` int(10) unsigned NOT NULL,
  `width` int(10) unsigned NOT NULL,
  `height` int(10) unsigned NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `profile_images`
--

INSERT INTO `profile_images` (`id`, `profile_id`, `is_general`, `order`, `width`, `height`, `url`, `created_at`, `updated_at`) VALUES
(1, '1', 1, 0, 692, 1139, 'uploads/profiles/1/65570.jpg', '2015-09-16 11:26:55', '2015-09-16 11:26:55'),
(2, '1', 0, 0, 784, 1176, 'uploads/profiles/1/97365.jpg', '2015-09-16 11:27:11', '2015-09-16 11:27:11'),
(3, '1', 0, 1, 784, 1176, 'uploads/profiles/1/15700.jpg', '2015-09-16 11:27:11', '2015-09-16 11:27:11'),
(4, '1', 0, 2, 784, 1176, 'uploads/profiles/1/17114.jpg', '2015-09-16 11:27:12', '2015-09-16 11:27:12'),
(5, '1', 0, 3, 784, 1176, 'uploads/profiles/1/50547.jpg', '2015-09-16 11:27:12', '2015-09-16 11:27:12'),
(6, '1', 0, 4, 784, 1176, 'uploads/profiles/1/36441.jpg', '2015-09-16 11:27:12', '2015-09-16 11:27:12'),
(7, '1', 0, 5, 784, 1176, 'uploads/profiles/1/84882.jpg', '2015-09-16 11:27:12', '2015-09-16 11:27:12');

-- --------------------------------------------------------

--
-- Структура таблицы `profile_service`
--

CREATE TABLE IF NOT EXISTS `profile_service` (
  `profile_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `profile_service`
--

INSERT INTO `profile_service` (`profile_id`, `service_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(1, 12),
(1, 14),
(1, 15),
(1, 17),
(1, 19),
(1, 22),
(1, 23),
(1, 24);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'model');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(10) unsigned NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `days` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `slug`, `name`, `created_at`, `updated_at`) VALUES
(1, 'kissing', '{"de":"Kissing"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'french_kissing', '{"de":"French kissing"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'dirty_talk', '{"de":"Dirty talk"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'role_play', '{"de":"Role play"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'sex_toys', '{"de":"Sex toys"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'sex_classic', '{"de":"Sex classic"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'sex_anal', '{"de":"Sex anal"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'sex_lesbian', '{"de":"Sex lesbian"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'sex_group', '{"de":"Sex group"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'sex_couples', '{"de":"Couples"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'double_penetration', '{"de":"Double Penetration"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'handjob', '{"de":"Hand job"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'mutual_masturbation', '{"de":"Mutual masturbation"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'blowjob', '{"de":"Blow job"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'deep_throat', '{"de":"Deep throat"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'mutual_natural_oral', '{"de":"Mutual natural oral"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'cunnilingus', '{"de":"Cunnilingus for me"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'prostate_massage', '{"de":"Prostate massage"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'cum_on_body', '{"de":"Cum on body"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'cum_on_face', '{"de":"Facial - cum on face"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'cum_in_mouth', '{"de":"Cum in mouth"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'classic_massage', '{"de":"Classic massage"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'sensual_massage', '{"de":"Sensual massage"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'erotic_massage', '{"de":"Erotic massage"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'full_body_massage', '{"de":"Full Body Massage"}', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'New slider', '[{"url":"http:\\/\\/cms.dev\\/uploads\\/slide_1_1.jpg","title":"","content":""},{"url":"http:\\/\\/cms.dev\\/uploads\\/slide_2_1.jpg","title":"","content":""},{"url":"http:\\/\\/cms.dev\\/uploads\\/slide_3_1.jpg","title":"","content":""}]', '2015-09-16 11:23:33', '2015-09-16 11:23:45');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nicci Paris', 'nicciparis@gmail.com', '$2y$10$9GJPo4lUqRedGH8G.R3HRe.EeLX7z63TN3d8U4ja2kRRGma3P9O/2', '5vAcVipeMf', '2015-09-16 11:19:26', '2015-09-16 11:19:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
