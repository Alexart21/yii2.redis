-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 172.17.0.1
-- Время создания: Апр 27 2021 г., 12:07
-- Версия сервера: 8.0.23
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `alexart1_mih`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`127.0.0.1` PROCEDURE `getContent` (IN `act` VARCHAR(255))  NO SQL
SELECT * FROM content WHERE page=act$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE `auth` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `callback`
--

CREATE TABLE `callback` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` bigint NOT NULL,
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `name`, `text`, `ip`, `created_at`, `color`) VALUES
(9, 'default_new', 'bla-bla', '0000', '2021-04-27 10:35:08', '111'),
(10, 'default_new', 'bla-bla', '0000', '2021-04-27 10:44:08', '111');

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

CREATE TABLE `content` (
  `id` bigint UNSIGNED NOT NULL,
  `page` varchar(255) NOT NULL,
  `page_text` mediumtext NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_seo` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `last_mod` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `page`, `page_text`, `title`, `title_seo`, `description`, `last_mod`) VALUES
(1, 'index', '        <article>\r\n    <img width=\"250\" height=\"179\" class=\"resp_img\" src=\"/img/main_img/web2.jpg\" alt=\"веб дизайн\" title=\"веб дизайн\">\r\n    <h2 class=\"header_shadow\">Алекс-арт21 — создание только эффективных сайтов</h2>\r\n    <p>\r\n        У нас сформирован профессиональный коллектив из дизайнеров, web-разработчиков, <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\r\n        специалистов.\r\n        Каждый из нас отлично знает свое дело, будь то\r\n        разработка дизайн-макета сайта-визитки или проектирование базы данных интернет магазина. Все вместе мы\r\n        уже команда способная решить поставленные задачи в установленные сроки.\r\n    </p>\r\n    <p><strong class=\"mark\">Мы не просто делаем сайты \"под ключ\", но и предоставляем комплексные и эффективные решения\r\n            для современного бизнеса.</strong>\r\n    </p>\r\n    <p class=\"strong_text\">\r\n        Разрабатываем только современные сайты и добиваемся роста посещаемости и конверсии.\r\n        <br>\r\n        Применяем только бизнес подход ориентированный не на \"креативность\", а на результат.\r\n        <br>\r\n        Предлагаем только свежие решения.\r\n        <br>\r\n    </p>\r\n    <h3 class=\"h_2 punkt no_border\">Предоставляемые услуги:</h3>\r\n    <div id=\"uslugi_outer\" class=\"list_block\">\r\n        <ul id=\"uslugi\">\r\n            <li>\r\n                <span class=\"l1\"></span> <strong><a title=\"создание сайтов\" class=\"list_link link-anim portf-call\" href=\"/sozdanie\">создание сайтов</a></strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"редизайн сайтов\">редизайн существующих сайтов</strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"модернизация сайтов\">модернизация сайтов под стандарты <abbr title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML5</abbr>\r\n                    и <abbr title=\"англ. Cascading Style Sheets, version 3 — каскадные таблицы стилей\">CSS3</abbr></strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong>\r\n                    <a title=\"адаптивная верстка\" class=\"list_link link-anim\" href=\"/sozdanie#response\">адаптивная\r\n                        верстка</a>\r\n                </strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"постановка статичных html сайтов на движок\">постановка статичных html сайтов на\r\n                    \"движок\"</strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"разработка системы управления сайтом\">разработка индивидуальной <abbr title=\"англ. Content Management System (система управления содержимым) — информационная система или компьютерная программа для обеспечения и организации совместного процесса создания, редактирования и управления контентом\">CMS</abbr></strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong>\r\n                    <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO </abbr><a title=\"продвижение сайтов\" class=\"list_link link-anim portf-call\" href=\"/prodvijenie\">продвижение\r\n                        сайтов</a>\r\n                </strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong>\r\n                    <a title=\"контекстная реклама\" class=\"list_link link-anim\" href=\"/prodvijenie#context\">контекстная\r\n                        реклама</a>\r\n                    на Яндекс и Google</strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"рерайт копирайт\">наполнение оригинальным контентом (рерайт, копирайт)</strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span> <strong>консультации, обучение персонала</strong>\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                <strong title=\"техническая и информационная поддержка веб-ресурсов\">техническая и информационная\r\n                    поддержка веб-ресурсов</strong>\r\n            </li>\r\n        </ul>\r\n    </div>\r\n    <br>\r\n    <br>\r\n    <div id=\"site\">\r\n        <div id=\"s1\">\r\n            <div class=\"site_block\">\r\n                <a href=\"/sozdanie#sait_vizitka\" class=\"portf-call\" title=\"сайт визитка\">\r\n                    <h2 class=\"h_2 punkt link-anim\">Сайт визитка</h2>\r\n                </a>\r\n                <p>\r\n                    Идеальный вариант для старта в интернете.\r\n                    <br>\r\n                    В дальнейшем можно улучшать и развивать\r\n                    <br>\r\n                    возможности сайта и его наполнение.\r\n                    <br>\r\n                </p>\r\n                <ul>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        до 5 страниц информации\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        размещение прайс листов\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        форма обратной связи\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        срок исполнения от 7 дней\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        цена от\r\n                        <span class=\"red\">7 000</span>\r\n                        <span class=\"rubl\">руб.</span>\r\n                    </li>\r\n                </ul>\r\n                <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать сайт визитку</a>\r\n            </div>\r\n        </div>\r\n        <div id=\"s2\">\r\n            <div class=\"site_block\">\r\n                <a href=\"/sozdanie#korporativniy_sait\" class=\"portf-call\" title=\"корпоративный сайт\">\r\n                    <h2 class=\"h_2 punkt link-anim\">Корпоративный сайт</h2>\r\n                </a>\r\n                <p>\r\n                    Многофункциональный портал для компании\r\n                    <br>\r\n                    и важный маркетинговый инструмент для\r\n                    <br>\r\n                    продвижения ваших товаров и(или) услуг.\r\n                    <br>\r\n                </p>\r\n                <ul>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        каталог товаров и услуг\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        система управления сайтом\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\r\n                        оптимизация\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        срок исполнения от 21 дня\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        цена от\r\n                        <span>12 000</span>\r\n                        <span class=\"rubl\">руб.</span>\r\n                    </li>\r\n                </ul>\r\n                <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать корпоративный сайт</a>\r\n            </div>\r\n        </div>\r\n        <div id=\"s3\">\r\n            <div class=\"site_block\">\r\n                <a href=\"/sozdanie#internet_magazin\" class=\"portf-call\" title=\"интернет магазин\">\r\n                    <h2 class=\"h_2 punkt link-anim\">Интернет магазин</h2>\r\n                </a>\r\n                <p>\r\n                    Оптимально для увеличения продаж.\r\n                    <br>\r\n                    Обязательно включает системы для добавления\r\n                    товара и оформления заказа.\r\n                    <br>\r\n                </p>\r\n                <ul>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        полноценный интернет магазин\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        система управления сайтом\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        система добавления/удаления товаров\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        срок исполнения от 21 дня\r\n                    </li>\r\n                    <li>\r\n                        <span class=\"l2\"></span>\r\n                        цена от\r\n                        <span>20 000</span>\r\n                        <span class=\"rubl\">руб.</span>\r\n                    </li>\r\n                </ul>\r\n                <a href=\"/#contacts\" title=\"заказать интернет магазин\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать интернет магазин</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n    <div id=\"bonus\">\r\n        <h2 class=\"header_shadow\">Для всех сайтов :</h2>\r\n        <ul>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                Индивидуальный дизайн\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                Форма обратной связи(заявки)\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                Регистрация домена и размещение на выбранном хостинге\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                Регистрация в поисковых системах Яндекс и Google\r\n            </li>\r\n            <li>\r\n                <span class=\"l1\"></span>\r\n                Счетчик посетителей (по желанию заказчика)\r\n            </li>\r\n        </ul>\r\n    </div>\r\n    <h2 class=\"h_2 header_shadow\">Процесс работы над сайтом и контакты с заказчиком</h2>\r\n    <p>\r\n        Взаимодействие с заказчиком идет на всем процессе создания сайта от первого телефонного звонка.\r\n        На всю свою работу даем бессрочную гарантию. Обучим Ваш персонал если необходимо.\r\n    </p>\r\n    <p>\r\n        Конечно же как и всякий уважающий себя коллектив мы беремся не за все заказы. Если встает выбор взяться\r\n        за заказ или отклонить его то тут у нас действует нехитрое правило которое мы условно называем\r\n        \"правилом двух плюсов\". Если из трех критериев а именно <b>проект</b>\r\n        ,\r\n        <b>гонорар</b>\r\n        и\r\n        <b>заказчик</b>\r\n        нас устраивают минимум два, то мы беремся за заказ. За интересный проект можно взяться и при низкой\r\n        оплате. Другой вариант — проект интересный, гонорар отличный, а заказчик невероятный зануда.\r\n        Конечно же беремся (кто же откажется от денег :) ).\r\n    </p>\r\n    <div id=\"etap\">\r\n        <h2>Этапы создания сайта можно условно разделить на:</h2>\r\n        <br>\r\n        <ul>\r\n            <li class=\"link-anim\">постановку целей</li>\r\n            <li class=\"link-anim\">дизайн</li>\r\n            <li class=\"link-anim\">верстку</li>\r\n            <li class=\"link-anim\">программирование</li>\r\n            <li class=\"link-anim\">наполнение</li>\r\n            <li class=\"link-anim\">тестирование</li>\r\n            <li class=\"link-anim\">запуск</li>\r\n        </ul>\r\n    </div>\r\n    <output id=\"etap_target\"></output>\r\n    <script>\r\n        var etap = [\r\n            \"Уяснение задач заказчика, определение целевой аудитории сайта, написание брифа(в народном фольклоре ТЗ).Прототипирование или составление эскиза где определяются расположения элементов страниц.\",\r\n            \"Определение концепции дизайна.Цветовое и графическое решение будущего сайта, выбор шрифтов и др.\",\r\n            \"Страницы сайта должны корректно отображаться во всех браузерах.Как правило хорошего тона нынче можно говорить об <a class=\\\"portf-call\\\" href=\\\"/sozdanie#response\\\"><b> адаптивной верстке</b></a> т.е. сайт должен быть хорошо читаем без потери функционала и на смартфонах и на планшетах и на настольных пк, и даже на тех устройствах, которые появятся в будущем.\",\r\n            \"Программирование идет параллельно с версткой.Постановка сайта \\\"на движок\\\" выбранный заказчиком(или разработанный нами).Проектирование и наполнение контентом базы данных(если требуется).Можем предложить собственную CMS которая в отличии от \\\"универсальных\\\" будет заточена под Ваш конкретный сайт и очень проста в использовании.\",\r\n            \"Наполнение содержимым.Если сайт будет продвигаться в поисковиках, пишутся грамотные SEO тексты под поисковые запросы по ключевым словам.\",\r\n            \"Здесь идет полная проверка работоспособности сайта.Так же тестируется стойкость к XSS атакам и SQL инъекциям.\",\r\n            \"Собственно выкладка на выбранный хостинг.Этот этап может быть сделан уже в процессе верстки.Например когда коммерческий сайт планируеться к SEO продвижению.Ведь SEO&mdash; процесс нескорый и тут время-деньги.\"\r\n        ];\r\n        var allLi = document.querySelectorAll(\'#etap li\'); // выбрали все li\r\n        for (var i = 0; i < allLi.length; i++) {\r\n            allLi[i].addEventListener(\"click\", target);\r\n        }\r\n        function target(e) {\r\n            e = e || event;\r\n            var obj = e.target || e.srcElement; // перестраховка\r\n            for (var i = 0; i < allLi.length; i++) {\r\n                if (obj == allLi[i]) { // красим нажатую ссылку\r\n                    obj.classList.add(\'etap_active\'); // добавим класс нажатой ссылки\r\n                    obj.classList.remove(\'link-anim\'); // у нажатой не нужна анимация\r\n                } else { // возврат к умолчанию\r\n                    var a = allLi[i].classList;\r\n                    if (a.contains(\'etap_active\')) a.remove(\'etap_active\');\r\n                    if (!a.contains(\'link-anim\')) a.add(\'link-anim\');\r\n                }\r\n            }\r\n            var txt = obj.firstChild.nodeValue; // получаем текст ссылки\r\n            var n; // индекс в массиве описания etap\r\n            switch (txt) {\r\n                case \"постановку целей\":\r\n                    n = 0;\r\n                    break;\r\n                case \"дизайн\":\r\n                    n = 1;\r\n                    break;\r\n                case \"верстку\":\r\n                    n = 2;\r\n                    break;\r\n                case \"программирование\":\r\n                    n = 3;\r\n                    break;\r\n                case \"наполнение\":\r\n                    n = 4;\r\n                    break;\r\n                case \"тестирование\":\r\n                    n = 5;\r\n                    break;\r\n                case \"запуск\":\r\n                    n = 6;\r\n                    break;\r\n            }\r\n            document.getElementById(\'etap_target\').innerHTML = etap[n]; // впендюриваем описание куда надо\r\n        }\r\n    </script>\r\n    <br>\r\n</article>\r\n<div id=\"cms\">\r\n    <strong>Мы используем CMS и фреймворки :</strong>\r\n    <br>\r\n    <div>\r\n        <div id=\"joomla\"></div>\r\n        <div id=\"wordpress\"></div>\r\n        <div id=\"dle\"></div>\r\n        <img width=\"40\" height=\"40\" alt=\"Yii\" src=\"data:image/png;base64,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\">\r\n    </div>\r\n    <br>\r\n    <pre>joomla  wordpress drupal     yii2</pre>\r\n</div>\r\n<!-- </section> -->\r\n    <a name=\"contacts\" rel=\"nofollow\"></a>\r\n    <br>\r\n    <br>\r\n    <br>\r\n<!--noindex-->\r\n\r\n<div class=\"h1 text-center\">Возникли вопросы ?</div>\r\n<div class=\"h2 text-center\">Напишите нам и получите исчерпывающую консультацию.</div>', 'Создание и продвижение сайтов в Чебоксарах', 'Создание сайтов под ключ в Чебоксарах', '', 1619524645),
(2, 'sozdanie', '\n        <img width=\"250\" height=\"167\" class=\"resp_img\" src=\"/img/main_img/sozdanie.jpg\" alt=\"создание сайтов\" title=\"создание сайтов\">\n<article>\n    <h2 class=\"header_shadow\">Создание сайтов для бизнеса и не только</h2>\n    <p>\n        Интернет — основная медиа среда сегодняшнего времени.<br>\n        <strong>Сайт</strong> сегодня — один из приоритетных инструментов для развития бизнеса.\n        Большинство предпринимателей стараются завести в сети интернет свою площадку для привлечения новых клиентов\n        и развития своей деятельности.\n        Иными словами, отсутствие своего сайта у компании ощутимый минус для неё.\n        <br>\n        Наша группа готова предложить\n        Вам услуги по созданию сайтов любой тематики и направленности и для любого региона. Только\n        сделанный профессионально информационно насыщенный сайт сможет дать Вам поток потенциальных клиентов.\n        <br>\n    </p>\n    <p>\n        Если говорить о <b>сайтах для бизнеса</b> то их весьма условно можно разделить на 3 основные категории.<br>\n    </p>\n    <b>Итак:</b><br>\n    <h2 id=\"sait_vizitka\" class=\"header_shadow\">Сайт визитка</h2>\n    <p>\n        <img width=\"250\" height=\"171\" class=\"resp_img no_shadow no_border align-left\" src=\"/img/main_img/vizitka.jpg\" alt=\"сайт визитка\" title=\"сайт визитка\">\n        Идеальный вариант для старта в интернете. В дальнейшем можно улучшать и развивать возможности сайта и его\n        наполнение.<br>\n        <strong>Сайт визитка</strong> — веб-ресурс, основное предназначение которого быстро и в яркой,\n        запоминающейся форме представить Вашу компанию в сети интернет.<br>\n        Обычно сайт визитка состоит из 5 разделов: <em>Главная страница, О компании, Услуги, Прайс лист, Контакты.</em>\n        Несмотря на небольшие размеры такой сайт - основной инструмент для деятельности предпринимателей\n        в сети интернет и содержит все необходимое для бизнеса.<br>\n    </p>\n    <h3>Заказав у нас сайт визитку вы получите:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;5-7 страниц информации на сайте</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Размещение прайс листов</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Форму обратной связи и(или) заявки на сайте</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Схему проезда до вашей организации</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрацию и покупку домена</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрацию в поисковых системах Яндекс и Google</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Валидный <abbr title=\"англ. HyperText Markup Language, version 5 — язык для структурирования и представления содержимого всемирной паутины\">HTML</abbr>\n            код\n        </li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Оптимизированную для <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            структуру страниц\n        </li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Установку счетчика посещений</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n    </ul>\n    <p></p>\n    <p>\n        Создание сайтов этой категории обычно занимает 5-7 дней после написания брифа\n        и утверждения структуры, дизайна.<br>\n        <strong>Цена для сайта визитки</strong> от <span class=\"red\">7 000</span> <span class=\"rubl\"> руб.</span><br>\n        <a href=\"/#contacts\" title=\"заказать сайт визитку\" class=\"zayavka link-anim\"><span class=\"l3\"></span> сделать заявку на сайт визитку</a>\n    </p>\n    <div class=\"hr\"></div>\n    <h2 id=\"korporativniy_sait\" class=\"header_shadow\">Корпоративный сайт</h2>\n    <p>\n        <img width=\"250\" height=\"136\" class=\"resp_img no_border no_shadow align-left\" src=\"/img/main_img/corp.jpg\" alt=\"корпоративный сайт\" title=\"корпоративный сайт\">\n        Веб-ресурс с множеством задач от повышения престижа организации до\n        продвижения товаров.\n        Создании сайтов этой категории требует индивидуального подхода и по цене ощутимо выше чем для простых сайтов.\n        В первую очередь из за большего объема работ, количества размещаемой информации, более тщательной\n        проработки дизайна и других факторов. Работы выполняются после анализа рынка и сайтов конкурирующих\n        компаний. По желанию заказчика пишутся положительные отзывы о компании.\n    </p>\n    <p>\n        На <strong>создание корпоративного сайта</strong> как правило\n        уходит от трех недель. Корпоративный сайт отличается от сайта визитки в первую очередь\n        наличием системы управления контентом (CMS), каталога товаров с возможностью оперативного\n        добавления(удаления) или изменения их описания. Возможно как написание индивидуальной CMS, учитывающей\n        все потребности Вашего сайта так и вариант с готовыми CMS (Joomla, Wordpress, DLE). Следует сказать\n        что \"универсальные\" cms достаточно сложны в использовании для неподготовленного человека и поэтому\n        мы готовы написать для Вас систему управления контентом под Ваш конкретный сайт где внесение изменений\n        будет не сложнее, чем например поменять фото в соцсетях :).<br>\n        <strong>Цена для корпоративного сайта</strong> от <span class=\"red\">12 000</span> <span class=\"rubl\"> руб.</span><br>\n    </p>\n    <h3>В цену включены:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;До 50 страниц информации</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            оптимизация всех страниц\n        </li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Каталог товаров и услуг</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Микроразметка для товаров и контактов</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Форма обратной связи(заявки)</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Система управления контентом</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Новости или блог</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Регистрация в поисковых системах</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Счетчик посетителей</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Настройка систем Яндекс метрика и Google analitics</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Cопровождение после сдачи в течении 3 месяцев</li>\n    </ul>\n    <br>\n    <a href=\"/#contacts\" title=\"заказать корпоративный сайт\" class=\"zayavka link-anim\"><span class=\"l3\"></span> сделать заявку на корпоративный сайт</a>\n    <div class=\"hr\"></div>\n    <h2 id=\"internet_magazin\" class=\"header_shadow\">Интернет магазин</h2>\n    <p>\n        <img width=\"250\" height=\"209\" class=\"resp_img no_border no_shadow align-left\" src=\"/img/main_img/market.jpg\" alt=\"интернет иагазин\" title=\"интернет магазин\">\n        <strong>Интернет магазин</strong> — наиболее перспективный и развивающийся вид бизнеса в интернете.\n        Создание сайтов такого уровня имеет свои особенности. Это обязательное наличие системы для\n        добавления и удаления товара, каталога товаров, корзины покупателя, быстрого поиска товаров, удобной формы для\n        заказа товара. Конечно же обязательно наличие базы данных для клиентов.\n    </p>\n    <p>\n        Онлайн магазин наиболее удобный способ для осуществления продаж не требующий затрат на аренду и\n        оптимален для их увеличения. Так же минимизированы затраты на персонал в торговом зале. Стоимость\n        создания интернет магазина зависит от таких факторов: объема каталога товаров, интеграции с\n        платежными системами, интеграции сайта с системой 1С, наличия авторизации пользователей и др.\n        Сроки исполнения для <strong>интернет магазина</strong> от трех недель.\n        <strong>Цена для интернет магазина</strong> от <span class=\"red\">20 000</span> <span class=\"rubl\"> руб.</span><br>\n    </p>\n    <h3>Цена включает:</h3>\n    <ul class=\"list list_block\">\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Индивидуальный дизайн</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Внутреннюю оптимизацию всех страниц</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Наполнение сайта содержимым</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Поиск по товарам</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Систему для добавления/удаления товара</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Корзину покупателя</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Удобную форму для заказа товара покупателем</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Продающие <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            тексты\n        </li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Счетчик посещений</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Настройку целей в Яндекс метрике</li>\n        <li><span class=\"l1\"></span>&nbsp;&nbsp;Техническое сопровождение сайта в течении 3 месяцев</li>\n    </ul>\n    <br>\n    <a href=\"/#contacts\" title=\"заказать разработку интернет магазина\" class=\"zayavka link-anim\"><span class=\"l3\"></span> заказать разработку интернет магазина</a>\n    <div class=\"hr\"></div>\n    <p>\n        На практике получить привлекательный по дизайну (или как минимум не вызывающий отторжения)\n        и удобный для посетителя сайт не такая тривиальная задача, как видится\n        на первый взгляд. Для создания приятного и простого в использовании сайта, красиво\n        представляющего контент, хорошо читаемого и без ненужных излишеств, требуется приложить некоторые усилия.\n        Как правило, большинство вебмастеров часто пренебрегают фактором юзабилити(англ. usability — дословно\n        «возможность использования», «способность быть использованным», «полезность») сайтов, что немного прискорбно.\n        Поэтому создание сайтов нужно доверять слаженной команде специалистов, способных выполнить эту\n        многоступенчатую работу в заранее оговоренные сроки.\n    </p>\n    <div>\n        <img width=\"250\" height=\"208\" class=\"resp_img no_border no_shadow align-left slide-in\" src=\"/img/main_img/response.jpg\" alt=\"адаптивная верстка\" title=\"адаптивная верстка\">\n        <h2 id=\"response\" class=\"header_shadow\">Создание сайтов с адаптивным дизайном</h2>\n        <p>\n            <strong>Адаптивная верстка</strong> или <strong>адаптивный дизайн</strong> (респонсивный дизайн, отзывчивый\n            дизайн, responsive web design, RWD)—\n            направление в веб дизайне, когда ресурс должен быть одинаково удобным для просмотра и без потери функционала\n            читаем на\n            любых устройствах вне зависимости от ширины экрана. Будь то смартфон, планшет, ноутбук, настольный\n            компьютер, проектор или даже устройство, которого еще нет, но появится в будущем.\n        </p>\n        <p>\n            Сайт, который Вы сейчас видите разработан с учетом минимальной ширины экрана 340 пикселей без\n            горизонтального скролла. Вы можете попробовать уменьшить окно вашего браузера и нажав кнопку \"обновить\"\n            или клавишу F5 увидите, как изменилась страница. При определенной ширине экрана левое меню исчезнет\n            и вместо него появиться знакомый многим \"гамбургер\", верхнее меню уменьшится в размерах\n            или сложиться \"в два\" или \"в три этажа\", уменьшатся в размерах некоторые изображения и часть шрифтов.\n            Это лишь один из возможных способов добиться адаптивного дизайна.\n        </p>\n        <p>\n            <strong>Создание сайтов с адаптивным дизайном</strong> сегодня является правилом хорошего тона при\n            веб разработке. Мы готовы предоставить услуги как по созданию адаптивных сайтов,\n            так и по редизайну существующих сайтов с учетом адаптивности.\n        </p>\n    </div>\n</article>', 'Создание сайтов В Чебоксарах', 'Создание сайтов любой сложности и назначения В Чебоксарах', '', 1619524677),
(3, 'prodvijenie', '\n        \n    <article>\n    <img width=\"250\" height=\"144\" class=\"resp_img\" src=\"/img/main_img/seo.jpg\" alt=\"продвижение сайтов\" title=\"продвижение сайтов\">\n    <h2 id=\"base_seo\" class=\"header_shadow\">Продвижение сайта, необходимый минимум и с чего начинается раскрутка\n        сайта</h2>\n    <h3>Продвижение сайта и базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr><sup class=\"prim\">*</sup> оптимизация</h3>\n    <p>\n        Обычно вопрос нужно ли продвижение сайта возникает вскоре после того, как Ваш сайт появился в сети интернет.\n        Мы профессионально занимаемся оказанием услуг физическим и юридическим лицам, планирующим активную\n        маркетинговую деятельность в сети.\n    </p>\n    <p>\n        <mark><strong>Раскрутка сайта</strong> <b>малоэффективна</b></mark>\n        ,(или даже бессмысленна) если внутренняя структура страниц не подчиняется\n        определенным правилам.\n        Что бы добиться структурной и семантической правильности страниц и проводится\n        <mark><strong>базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n                оптимизация.</strong></mark>\n        <br>\n        Базовая <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n        оптимизация начинается с написания правильных мета тегов таких как <code>description</code> и наличия\n        ключевых слов в теге <code><b>title</b></code>.\n        Положительное влияние на продвижение сайта так же оказывает наличие заголовков H1 и далее, их\n        правильная структура и наличие ключевых фраз в них, оптимизация изображений и тега <code><b>alt</b></code>,\n        написание привлекательного для посетителей сниппета. На этом этапе, который идет в процессе верстки мы\n        добиваемся корректности внутренней структуры страниц с точки зрения поисковых машин и соответствия\n        стандартам консорциума <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\">W3C.</abbr><sup class=\"prim\">**</sup>\n    </p>\n    <p>\n        Благоприятное действие на продвижение сайта оказывает так же их корректное\n        отображение на мобильных устройствах.\n        Ну и конечно правильная орфография всех текстов Вашего сайта. (Даже если у вас красный диплом филолога\n        и вы уверены в правописании необходимо будет проверить текст в специальных сервисах поисковых систем,\n        ведь Яндекс может считать по другому).\n    </p>\n    <p>\n        Сразу же после выкладки на выбранный хостинг мы регистрируем Ваш\n        сайт в поисковых системах Яндекс и Google и(по желанию заказчика) устанавливаем счетчики посещений.\n        Настраивается правильная отдача сервером заголовков <code><b>LastModified</b></code>, проводиться склейка\n        зеркал.\n        Создаются файлы <code><b>sitemap.xml</b></code> и <code><b>robots.txt</b></code>. Возможно сделать\n        автоматическую генерацию файла <code><b>sitemap.xml</b></code>.\n    </p>\n    <p>\n        <b class=\"underline\">Примечания:</b><br>\n        <em>\n            <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\"><b>SEO</b></abbr>\n            (search engine optimization) — оптимизация для поисковых машин, в народном фольклоре\n            продвижение или раскрутка сайта.<br>\n            <abbr title=\"англ. World Wide Web Consortium, W3C — организация, разрабатывающая и внедряющая технологические стандарты для Всемирной паутины\"><b>W3C</b></abbr>\n            (World Wide Web Consortium) — всемирный консорциум по интернету.\n        </em>\n    </p>\n</article>\n<div class=\"hr\"></div>\n<article>\n    <h2 id=\"key_seo\" class=\"header_shadow\">Продвижение сайта (раскрутка сайта) по ключевым фразам</h2>\n    <p>\n        В первую очередь необходимо ответить на несколько важных вопросов:<br>\n        Для чего вам нужен сайт ?<br>\n        Для чего сайт нужен вашим пользователям ?<br>\n        Чем он лучше/хуже других похожих сайтов ?<br>\n        Какая целевая аудитория Вашего сайта ?<br>\n        Ведь вполне может быть что именно для Вашего сайта эффективней окажется не <strong><abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n            продвижение</strong> а например,&nbsp;<b><a href=\"#reklama\" class=\"list_link\">контекстная реклама</a></b>.\n    </p>\n    <p>\n        Следует сразу сказать что поисковые машины не <i>индексируют сайты,</i> они <strong>индексируют\n            страницы!</strong><br>\n        И тут самая частая ошибка горе seo-оптимизаторов это приземление всех запросов на главную страницу сайта.\n        Но раз термин <strong>продвижение сайта</strong> уже давно закрепился то и мы будем использовать его.<br>\n        На этапе продвижения по ключевым словам проводиться анализ конкурентов, составление семантического ядра сайта и\n        выбор приземляющих страниц(\n        <b>ключевая страница</b>, <b>приземляющая страница</b>, <b>jump page</b>, <b>landing page</b>, <b>точка\n            входа</b>) однозначно отвечающих на запрос пользователя\n        (запросы семантического ядра), привязка запросов к страницам сайта, внутренняя перелинковка и другая\n        оказывающая важное влияние на продвижение сайта работа.<br>\n        Обязательно проверяется текст на удобочитаемость, уникальность, плотность ключевых слов, заспамленность и\n        рекламный шум.\n        При необходимости пишутся и размещаются положительные отзывы о компании.\n\n    </p>\n    <p>\n        После того как работа над внутренней структурой сайта закончена начинается продвижение сайта\n        с учетом внешних факторов.Это в первую очередь наращивание ссылочной массы за счет регистрации в\n        \"белых\" каталогах, покупки \"вечных\" ссылок, использования сервис агрегаторов а так же блоговое и\n        статейное продвижение сайта. Проводиться настройка целей в системах Яндекс метрика и Google analitics.<br>\n        Мы используем <b>только легальные способы продвижения</b>. \"Черная\" SEO оптимизация не наш профиль!\n    </p>\n    <div id=\"seo_list\">\n        <h3 class=\"header_shadow\">SEO продвижение сайта, основные требования к ресурсу:</h3>\n        <ul>\n            <li>Сайт сделан не на flash, java script, iframe (возможны AJAX сайты при соблюдении определенных правил)\n            </li>\n            <li>Все доступы и права принадлежат владельцу сайта</li>\n            <li>Возраст ресурса превышает 1 год</li>\n            <li>Сайт находиться в работоспособном состоянии</li>\n            <li>Хостинг соответствует заявленным требованиям скорости/нагрузки</li>\n            <li>Сайт не аффилирован и не имеет однотипного поддомена</li>\n            <li>Сайт является основным зеркалом</li>\n            <li>Сбалансированное семантическое ядро</li>\n            <li>Контент</li>\n            <li>Сайт не содержит запрещенных законом материалов</li>\n            <li>На сайте информативная входная страница</li>\n        </ul>\n    </div>\n    <br>\n    <p>\n        Стоимость на продвижение сайта по ключевым фразам зависит от многих факторов: <br>\n        коммерческой популярности запроса, возраста сайта и др.\n    </p>\n    <a href=\"/#contacts\" title=\"продвижение сайта стоимость\" class=\"zayavka link-anim\"><span class=\"l3\"></span> узнать стоимость продвижения для Вашего сайта</a><br>\n    <br>\n</article>\n<div class=\"hr\"></div>\n<article>\n    <h2 id=\"context\" class=\"header_shadow\">Контекстная реклама</h2>\n    <!-- <h3 class=\"header_shadow\">Контекстная реклама. Что это?</h3> -->\n    <p>\n        SEO продвижение сайта в топ 10 яндекса может занять от 3 до 6 месяцев в зависимости от ряда\n        факторов. Да и стоит это ощутимых денег. Совсем нередко стоимость SEO продвижения сайта превышает стоимость\n        разработки самого сайта.Что же делать если коммерческая отдача нужна незамедлительно?\n    </p>\n    <p>\n        Выход есть! Вам на помощь придет <strong>контекстная реклама</strong>.<br>\n    </p>\n    <p>Пользователи ежедневно заходят на разные тематические сайты раздраженно выключая всевозможные\n        рекламные баннеры и игнорируя назойливые объявления. Совсем другой случай когда пользователь при\n        посещении Яндекса видит текстовый блок по интересующей его тематике. Вкратце это и есть контекстная\n        реклама. При этом информация о Вашем сайте попадает в топ выдачи Яндекса независимо от того на\n        какой позиции он реально находиться.\n    </p>\n    <p>\n        Если вы обращали внимание на надпись \"реклама\" в поисковой выдаче Яндекса или Google то это оно и есть.<br>\n        Пользователь заходит на поисковик, вводит свой запрос и видит примерно\n        следующее:\n    </p>\n    <figure class=\"kontext_img\">\n        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/yandex.jpg\" alt=\"контекстная реклама на Яндекс\" title=\"контекстная реклама на Яндекс\">\n        <figcaption class=\"strong_text\">Так может выглядеть реклама на Яндекс</figcaption>\n    </figure>\n    <figure class=\"kontext_img\">\n        <img width=\"400\" height=\"382\" class=\"resp_img\" src=\"/img/main_img/google.jpg\" alt=\"контекстная реклама на Google\" title=\"контекстная реклама на Google\">\n        <figcaption class=\"strong_text\">Контекстная реклама на Google Adwords</figcaption>\n    </figure>\n    <p class=\"clear\">\n        То, что выделено на фото красной рамкой и есть контекстная реклама. Туда можете попасть\n        и Вы.\n        Для этого нужно составить грамотный список ключевых фраз наиболее релевантных\n        роду деятельности Вашей фирмы и уже на их основании написать привлекательные для потенциальных клиентов\n        объявления с\n        заголовками.\n    </p>\n    <p>\n        К плюсам контекстной рекламы относиться также то, что Вы платите лишь за непосредственный переход\n        на Ваш сайт и сами устанавливаете цену за клик. Чем выше Вы заявили стоимость перехода,\n        тем выше будет Ваша позиция на странице выдачи поисковика (действует аукционный принцип). Можно также настроить\n        выдачу в зависимости\n        от времени суток или от географической привязки. Например, объявление \"доставка пиццы\" показывать\n        с 11<sup>00</sup> до 14<sup>00</sup>(т.е. в обеденное время) в регионе Чебоксары.\n    </p>\n    <h3 class=\"header_shadow\">Настройка контекстной рекламы</h3>\n    <p>\n        Мы готовы профессионально провести рекламную компанию Вашей фирмы в Яндекс и Google\n        по современным маркетинговым техникам. Составим объявления, подберем популярные ключевые слова, соответствующие\n        роду деятельности Вашей организации.\n    </p>\n    <p>\n    </p><ul>\n        <li><strong>Настройка рекламы на Яндекс</strong> <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span></li>\n        <li><strong>Настройка рекламы на Google</strong> <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span></li>\n        <li><strong>Настройка рекламы на Яндекс Директ и Google Adwords</strong> <span class=\"red\">4 500</span>\n            <span class=\"rubl\"> руб.</span> (единоразово)\n        </li>\n    </ul>\n    <strong>Профессиональное ведение рекламной кампании</strong> от <span class=\"red\">3 000</span> <span class=\"rubl\"> руб.</span>/месяц<br>\n    <span class=\"strong_text\">При заказе сайта от 40 000 <span class=\"rubl\"> руб.</span> настройку проведем <b class=\"underline\">БЕСПЛАТНО.</b></span>\n    <p></p>\n    <h2>Продвижение сайта методами <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr>\n        или контекстная реклама, что выбрать?</h2>\n    <p>\n        Следует сказать, что контекстная реклама абсолютно не влияет на позицию сайта в поисковой выдаче.\n        Поэтому большинство компаний используют оба инструмента (и <b>контекстную рекламу</b> и <b>SEO продвижение</b>)\n        для наибольшей эффективности. Еще отметим что результат от контекстной рекламы очень скор, но и пропадет сразу\n        как закончатся Ваши деньги на счету того же яндекса т.е. платить придется\n        постоянно (впрочем, как и в любой другой рекламе). Для продвижения сайта ситуация другая —\n        результата приходится ждать обычно до 3 месяцев (иногда более) но и результат долгосрочный. При грамотном\n        продвижении\n        сайта подвинуть его из топа будет не так просто (мы не занимаемся \"черным\" продвижением когда сайт\n        за 2 недели попадает в топ а затем вылетает в бан). В нашей практике были случаи когда сайт уже после\n        прекращения <abbr title=\"англ. search engine optimization — комплекс мер по внутренней и внешней оптимизации, для поднятия позиций сайта в результатах выдачи поисковых систем\">SEO</abbr> продвижения висел в топе еще 2 года.<br> Поэтому наша рекомендация — применяйте\n        и <b>продвижение сайта</b> и <b>контекстную рекламу!</b>\n    </p>\n</article>', 'Продвижение сайтов в Чебоксарах', 'Продвижение в поисковых системах и раскрутка в сети в Чебоксарах', '', 1619524758),
(4, 'portfolio', '\n    test', 'Создание и продвижение сайтов от Alex-art21', NULL, NULL, 1619524854),
(5, 'parsing', '<img width=\"250\" height=\"167\" class=\"resp_img\" src=\"/img/main_img/parsing.jpg\" alt=\"парсинг сайтов\"\r\n     title=\"парсинг сайтов\">\r\n<article>\r\n    <h2 class=\"header_shadow\">Парсинг сайтов</h2>\r\n    <p>\r\n        <span class=\"mark\">Создали сайт и не знаете чем его наполнить ?</span><br/>\r\n        Подобная проблема совсем не редкость.Где же взять контент?\r\n        Конечно же в интернете.\r\n    </p>\r\n    <p>\r\n        Другая ситуация - Вам необходим постоянный мониторинг сайтов например конкурентов.И в этом случае\r\n        Вам на помощь придут программы парсеры.\r\n    </p>\r\n    <h3 class=\"header_shadow\">Что же такое парсинг сайтов и кому это может понадобится</h3>\r\n    <p>\r\n        Говоря по простому парсинг сайтов это получение любых необходимых структурированных\r\n        данных из сети интернет.Т.е. добывание нужной информации как то статьи,картинки,\r\n        видео или любой другой контент.Конечно все это можно сделать и вручную. <b>Но !</b><br/>\r\n        Если вам нужно найти и скачать несколько фотографий или статей то конечно яндекс с\r\n        гуглом вам в помощь.<br/>\r\n        При больших же объемах информации делать это вручную весьма утомительно.\r\n        Этот процесс можно автоматизировать.Тут Вам на помощь придут программы парсеры.\r\n    </p>\r\n    <p>\r\n        <strong>Достоинства парсинга:</strong>\r\n    <ul>\r\n        <li><span class=\"l1\"></span>\r\n            Программа парсер быстро и и безошибочно отделит служебную и техническую информацию\r\n            от нужной.\r\n        </li>\r\n        <li><span class=\"l1\"></span>\r\n            Парсер легко справляется с большими объемами информации.\r\n        </li>\r\n        <li><span class=\"l1\"></span>\r\n            Минимальное участие человека.Практически весь процесс автоматизирован.\r\n        </li>\r\n    </ul>\r\n    <br/>\r\n    <strong>Недостатки:</strong>\r\n    <br/>\r\n    <p>\r\n        Недостаток пожалуй единственный но достаточно серьезный. Это <b>Копипаст!</b><br/>\r\n        Копипаст первейший враг поисковых машин!<br/>\r\n        Поэтому всегда старайтесь использовать уникальный контент.\r\n\r\n    </p>\r\n    <p>\r\n        Стоимость парсинга сайта начинается от <span class=\"red\">1&#8202;500 </span><span class=\"rubl\">руб.</span>\r\n    </p>\r\n    <p>\r\n        Если Вам нужен парсинг сайта свяжитесь с нами любым удобным для Вас способом.Мы осуществим\r\n        парсинг любых сайтов в том числе и сайтов с авторизацией и соцсетей.<br>\r\n        Полученные данные предоставим в любом удобном для Вас формате(CSV,XLS,или дамп базы данных).\r\n    </p>\r\n</article>', 'Парсинг сайтов в Чебоксарах', NULL, NULL, 1619524829);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `post`
--

CREATE TABLE `post` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_read` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` tinyint DEFAULT '10',
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `auth_key` varchar(255) DEFAULT NULL,
  `register_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `role`, `password_hash`, `auth_key`, `register_token`, `password_reset_token`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin_alex', 'aa@aa.aa', 20, '$2y$13$jF.GXQIDY5Fql3wIC6xl0umb2wMhKVqmT/UprLeh5TvMuiLFToURK', '3rjscfq-g6joiOf0enXKWLIgY-6IXpZC', NULL, NULL, 10, 0, 1612886660),
(83, 'vasya', 'vasya@mail.ru', 10, '$2y$13$nrMx2BcSdCYy.Q4u6NOKTe0iDgB/GYGKthwIpx2jwyTDhgI8xA9Py', 'lPynNaCfDACT3qcJdjmxT0OSQMitR7CW', NULL, NULL, 0, 1610285462, 1612961505),
(84, 'Petya', 'petya@yandex.ru', 10, '$2y$13$6qcJW0EfdykTXP1fYtwNp.pOSkh4SBP4qHJYL7xyo2Z4.6zWFM9W6', 'eUi9d8HhMLK2amEXz87rWb-HvThNyYZl', NULL, NULL, 10, 1612972142, 1612972223);

-- --------------------------------------------------------

--
-- Структура таблицы `wschat`
--

CREATE TABLE `wschat` (
  `id` bigint NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `text` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color` varchar(7) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-auth-user_id-user-id` (`user_id`);

--
-- Индексы таблицы `callback`
--
ALTER TABLE `callback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_2` (`page`),
  ADD KEY `page` (`page`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Индексы таблицы `wschat`
--
ALTER TABLE `wschat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth`
--
ALTER TABLE `auth`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `callback`
--
ALTER TABLE `callback`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `post`
--
ALTER TABLE `post`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT для таблицы `wschat`
--
ALTER TABLE `wschat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk-auth-user_id-user-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
