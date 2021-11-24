/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

INSERT INTO `articles` (`id`, `title`, `alias`, `description`, `keywords`, `excerpt`, `text`, `img`, `created_at`, `updated_at`, `user_id`, `category_id`) VALUES
(1, 'This is the title of the first article. Enjoy it', 'article-1', 'Краткое описание', 'Ключи', '<p>Fusce nec accumsan eros. Aenean ac orci a magna vestibulum posuere quis nec nisi. Maecenas rutrum vehicula condimentum. Donec volutpat nisl ac mauris consectetur gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel vulputate nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>', '<p>Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Sed fringilla vehicula est at pellentesque. Aenean imperdiet elementum arcu id facilisis. Mauris sed leo eros.</p>\r\n\r\n<p>Duis nulla purus, malesuada in gravida sed, viverra at elit. Praesent nec purus sem, non imperdiet quam. Praesent tincidunt tortor eu libero scelerisque quis consequat justo elementum. Maecenas aliquet facilisis ipsum, commodo eleifend odio ultrices et. Maecenas arcu arcu, luctus a laoreet et, fermentum vel lectus. Cras consectetur ipsum venenatis ligula aliquam hendrerit. Suspendisse rhoncus hendrerit fermentum. Ut eget rhoncus purus.</p>\r\n\r\n<p>Cras a tellus eu justo lobortis tristique et nec mauris. Etiam tincidunt tellus ut odio elementum adipiscing. Maecenas cursus dolor sit amet leo elementum ut semper velit lobortis. Pellentesque posue!</p>', '{\"mini\":\"6199f7354ef71_mini.jpg\",\"max\":\"6199f7354ef71_max.jpg\",\"full\":\"6199f7354ef71.jpg\"}', '2021-09-20 05:41:04', '2021-11-21 07:37:25', 1, 2);
INSERT INTO `articles` (`id`, `title`, `alias`, `description`, `keywords`, `excerpt`, `text`, `img`, `created_at`, `updated_at`, `user_id`, `category_id`) VALUES
(2, 'Nice & Clean. The best for your blog!', 'article-2', NULL, NULL, '<p>Fusce nec accumsan eros. Aenean ac orci a magna vestibulum posuere quis nec nisi. Maecenas rutrum vehicula condimentum. Donec volutpat nisl ac mauris consectetur gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel vulputate nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>', '<p>Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Sed fringilla vehicula est at pellentesque. Aenean imperdiet elementum arcu id facilisis. Mauris sed leo eros.</p>\r\n\r\n<p>Duis nulla purus, malesuada in gravida sed, viverra at elit. Praesent nec purus sem, non imperdiet quam. Praesent tincidunt tortor eu libero scelerisque quis consequat justo elementum. Maecenas aliquet facilisis ipsum, commodo eleifend odio ultrices et. Maecenas arcu arcu, luctus a laoreet et, fermentum vel lectus. Cras consectetur ipsum venenatis ligula aliquam hendrerit. Suspendisse rhoncus hendrerit fermentum. Ut eget rhoncus purus.</p>\r\n\r\n<p>Cras a tellus eu justo lobortis tristique et nec mauris. Etiam tincidunt tellus ut odio elementum adipiscing. Maecenas cursus dolor sit amet leo elementum ut semper velit lobortis. Pellentesque posue!</p>', '{\"mini\":\"6199f76e3dd55_mini.jpg\",\"max\":\"6199f76e3dd55_max.jpg\",\"full\":\"6199f76e3dd55.jpg\"}', '2021-11-04 14:14:44', '2021-11-21 07:38:22', 1, 2);
INSERT INTO `articles` (`id`, `title`, `alias`, `description`, `keywords`, `excerpt`, `text`, `img`, `created_at`, `updated_at`, `user_id`, `category_id`) VALUES
(3, 'Section shortcodes & sticky posts!', 'article-3', NULL, NULL, '<p>Fusce nec accumsan eros. Aenean ac orci a magna vestibulum posuere quis nec nisi. Maecenas rutrum vehicula condimentum. Donec volutpat nisl ac mauris consectetur gravida. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel vulputate nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>', '<p>Fusce rutrum lectus id nibh ullamcorper aliquet. Pellentesque pretium mauris et augue fringilla non bibendum turpis iaculis. Donec sit amet nunc lorem. Sed fringilla vehicula est at pellentesque. Aenean imperdiet elementum arcu id facilisis. Mauris sed leo eros.</p>\r\n\r\n<p>Duis nulla purus, malesuada in gravida sed, viverra at elit. Praesent nec purus sem, non imperdiet quam. Praesent tincidunt tortor eu libero scelerisque quis consequat justo elementum. Maecenas aliquet facilisis ipsum, commodo eleifend odio ultrices et. Maecenas arcu arcu, luctus a laoreet et, fermentum vel lectus. Cras consectetur ipsum venenatis ligula aliquam hendrerit. Suspendisse rhoncus hendrerit fermentum. Ut eget rhoncus purus.</p>\r\n\r\n<p>Cras a tellus eu justo lobortis tristique et nec mauris. Etiam tincidunt tellus ut odio elementum adipiscing. Maecenas cursus dolor sit amet leo elementum ut semper velit lobortis. Pellentesque posue!</p>', '{\"mini\":\"6199f7d93dd4a_mini.jpg\",\"max\":\"6199f7d93dd4a_max.jpg\",\"full\":\"6199f7d93dd4a.jpg\"}', '2021-11-04 14:14:33', '2021-11-21 08:28:32', 1, 4);

INSERT INTO `categories` (`id`, `title`, `alias`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Блог', 'blog', 0, '2021-09-20 05:36:29', NULL);
INSERT INTO `categories` (`id`, `title`, `alias`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'Компьютеры', 'computers', 1, '2021-09-20 05:38:16', NULL);
INSERT INTO `categories` (`id`, `title`, `alias`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'Интересное', 'interesting', 1, NULL, NULL);
INSERT INTO `categories` (`id`, `title`, `alias`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 'Советы', 'advice', 1, '2021-09-20 05:38:16', NULL);

INSERT INTO `comments` (`id`, `name`, `email`, `website`, `text`, `parent_id`, `created_at`, `updated_at`, `user_id`, `article_id`) VALUES
(1, 'AnnaLissa', 'slavamarchkov@gmail.com', 'https://site.ru', 'Ну вы даете! Вообще ужас!', 0, '2021-11-08 15:13:25', NULL, NULL, 1);
INSERT INTO `comments` (`id`, `name`, `email`, `website`, `text`, `parent_id`, `created_at`, `updated_at`, `user_id`, `article_id`) VALUES
(3, '', '', '', 'Комментарий от зарегистрированного пользователя', 0, '2021-11-10 15:24:15', NULL, 1, 1);
INSERT INTO `comments` (`id`, `name`, `email`, `website`, `text`, `parent_id`, `created_at`, `updated_at`, `user_id`, `article_id`) VALUES
(4, 'Name', 'email@mail.ru', 'https://site.ru', 'Привет, мир!!!', 1, '2021-11-12 08:36:26', NULL, NULL, 1);
INSERT INTO `comments` (`id`, `name`, `email`, `website`, `text`, `parent_id`, `created_at`, `updated_at`, `user_id`, `article_id`) VALUES
(5, 'Ben', 'ben@mail.ru', 'https://site.ru', 'Привет!', 4, '2021-11-12 08:36:26', NULL, NULL, 1),
(6, 'Name', 'email@mail.ru', 'https://site.ru', 'Hello world!', 5, '2021-11-12 08:37:49', NULL, NULL, 1),
(7, 'Ben', 'ben@mail.ru', 'https://site.ru', 'Comment', 3, '2021-11-12 08:36:26', NULL, NULL, 1),
(8, 'slsls', 'lsldld', 'ldldld', 'dlflfl', 0, '2021-11-12 15:07:13', '2021-11-12 15:07:13', NULL, 1),
(9, 'slsls', 'lsldld', 'ldldld', 'dccccccc', 1, '2021-11-12 15:09:37', '2021-11-12 15:09:37', NULL, 1),
(10, 'MyName', 'slavamarchkov@gmail.com', 'http://uandex.ru', 'The GET method is not supported for this route. Supported methods: POST.', 0, '2021-11-14 13:42:30', '2021-11-14 13:42:30', NULL, 1),
(11, 'ggdsgsda', 'GAAAG', 'вававы', '​Best regards,\r\n​Viacheslav Marchkov\r\nWhatsApp: +7-913-213-555-9\r\nEmail: slavamarchkov@gmail.com', 0, '2021-11-14 13:59:20', '2021-11-14 13:59:20', NULL, 1),
(12, 'ggdsgsda', 'GAAAG', 'вававы', '​Best regards,\r\n​Viacheslav Marchkov\r\nWhatsApp: +7-913-213-555-9\r\nEmail: slavamarchkov@gmail.com', 0, '2021-11-14 13:59:57', '2021-11-14 13:59:57', NULL, 1),
(13, 'ввввв', 'ыыы', 'ыыы', 'ыыыыыы', 1, '2021-11-14 14:01:02', '2021-11-14 14:01:02', NULL, 1),
(14, 'Slava', 'slavamarchkov@gmail.com', 'http://mail.ru', 'Почему вы так считаете?', 10, '2021-11-14 14:08:24', '2021-11-14 14:08:24', NULL, 1),
(15, 'Slava', 'slavamarchkov@gmail.com', 'fhfhfh', 'Ответ на коммент 13', 12, '2021-11-14 14:13:42', '2021-11-14 14:13:42', NULL, 1),
(16, 'Slava', 'slavamarchkov@gmail.com', 'http://google.ru', 'Это первый комментарий', 0, '2021-11-14 14:27:10', '2021-11-14 14:27:10', NULL, 3),
(17, 'hhghghg', 'вововов', 'вовов', 'овововов', 16, '2021-11-14 14:32:33', '2021-11-14 14:32:33', NULL, 3),
(18, 'аоаоао', 'аоаоаоё', 'воаао', 'вовоаоао', 0, '2021-11-14 14:32:57', '2021-11-14 14:32:57', NULL, 3),
(19, 'fjffkj', 'jdldl``', 'jdsdsd', 'dk;sdlk;sdk', 0, '2021-11-14 14:43:25', '2021-11-14 14:43:25', NULL, 3),
(38, NULL, NULL, NULL, 'Еще один комментарий', 19, '2021-11-21 08:16:22', '2021-11-21 08:16:22', 1, 3);



INSERT INTO `filters` (`id`, `title`, `alias`, `created_at`, `updated_at`) VALUES
(1, 'Brand Identity', 'brand-identity', '2021-09-20 05:22:36', NULL);
INSERT INTO `filters` (`id`, `title`, `alias`, `created_at`, `updated_at`) VALUES
(2, 'Web Development', 'web-development', '2021-09-20 05:24:36', NULL);


INSERT INTO `menus` (`id`, `title`, `path`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Главная', 'http://corp-laravel.local', 0, '2021-09-20 05:47:52', '2021-11-24 03:10:56');
INSERT INTO `menus` (`id`, `title`, `path`, `parent_id`, `created_at`, `updated_at`) VALUES
(2, 'Блог', 'http://corp-laravel.local/articles', 0, '2021-09-20 05:51:25', '2021-11-24 03:07:46');
INSERT INTO `menus` (`id`, `title`, `path`, `parent_id`, `created_at`, `updated_at`) VALUES
(3, 'Компьютеры', 'http://corp-laravel.local/articles/cat/computers', 2, '2021-09-20 05:51:25', '2021-11-24 03:07:41');
INSERT INTO `menus` (`id`, `title`, `path`, `parent_id`, `created_at`, `updated_at`) VALUES
(4, 'Интересное', 'http://corp-laravel.local/articles/cat/interesting', 2, '2021-09-20 05:51:25', '2021-11-24 03:07:36'),
(5, 'Советы', 'http://corp-laravel.local/articles/cat/advice', 2, '2021-09-20 05:51:25', '2021-11-24 03:07:06'),
(6, 'Портфолио', 'http://corp-laravel.local/portfolios', 0, '2021-09-20 05:51:25', '2021-11-24 03:08:44'),
(7, 'Контакты', 'http://corp-laravel.local/contacts', 0, '2021-09-20 05:51:25', '2021-11-24 03:10:37');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(15, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(16, '2021_09_14_084627_create_articles_table', 1),
(17, '2021_09_14_085432_create_portfolios_table', 1),
(18, '2021_09_14_085625_create_filters_table', 1),
(19, '2021_09_14_085812_create_comments_table', 1),
(20, '2021_09_14_090308_create_sliders_table', 1),
(21, '2021_09_14_090455_create_menus_table', 1),
(22, '2021_09_14_090719_create_categories_table', 1),
(23, '2021_09_14_103240_change_articles_table', 2),
(24, '2021_09_14_103934_change_comments_table', 3),
(25, '2021_09_14_104045_change_portfolios_table', 4),
(26, '2021_11_05_151523_change_users_table', 5),
(27, '2021_11_06_051921_create_roles_table', 6),
(28, '2021_11_06_051946_create_permissions_table', 6),
(29, '2021_11_06_052017_create_permission_role_table', 6),
(30, '2021_11_06_052654_create_role_user_table', 6),
(31, '2021_11_06_053306_change_role_user_table', 7),
(32, '2021_11_06_053325_change_permission_role_table', 7),
(33, '2021_11_14_145519_change_articles_table_add_meta', 8),
(34, '2021_11_15_055900_change_portfolios_table_add_meta', 9);

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('slavamarchkov@gmail.com', '$2y$10$Cec4FYQGJY5.4w2W6Sq6rOi4C1PaWKV3v7.GMGuLr2L/6CAZ8/c5S', '2021-09-20 05:33:59');


INSERT INTO `permission_role` (`id`, `created_at`, `updated_at`, `role_id`, `permission_id`) VALUES
(1, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 1);
INSERT INTO `permission_role` (`id`, `created_at`, `updated_at`, `role_id`, `permission_id`) VALUES
(12, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 2);
INSERT INTO `permission_role` (`id`, `created_at`, `updated_at`, `role_id`, `permission_id`) VALUES
(13, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 3);
INSERT INTO `permission_role` (`id`, `created_at`, `updated_at`, `role_id`, `permission_id`) VALUES
(14, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 4),
(17, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 7),
(18, '2021-11-16 09:57:52', '2021-11-16 09:57:52', 2, 1),
(19, '2021-11-06 05:48:36', '2021-11-06 05:48:36', 1, 8),
(20, NULL, NULL, 2, 5),
(21, NULL, NULL, 2, 6),
(27, NULL, NULL, 1, 10),
(28, '2021-11-24 11:24:55', '2021-11-24 11:24:55', 1, 11),
(29, '2021-11-24 14:21:19', '2021-11-24 14:21:19', 1, 12),
(30, '2021-11-24 15:20:34', '2021-11-24 15:20:34', 1, 5),
(31, '2021-11-24 15:20:34', '2021-11-24 15:20:34', 1, 6),
(32, '2021-11-24 15:20:34', '2021-11-24 15:20:34', 1, 9),
(33, '2021-11-24 15:20:43', '2021-11-24 15:20:43', 1, 13);

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'VIEW_ADMIN', '2021-11-06 05:44:50', '2021-11-06 05:44:50');
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'ADD_ARTICLE', '2021-11-06 05:44:50', '2021-11-06 05:44:50');
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'UPDATE_ARTICLE', '2021-11-06 05:44:50', '2021-11-06 05:44:50');
INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'DELETE_ARTICLE', '2021-11-06 05:44:50', '2021-11-06 05:44:50'),
(5, 'VIEW_ADMIN_ARTICLES', '2021-11-06 05:44:50', '2021-11-06 05:44:50'),
(6, 'VIEW_ADMIN_USERS', '2021-11-06 05:44:50', '2021-11-06 05:44:50'),
(7, 'EDIT_USERS', '2021-11-06 05:44:50', '2021-11-06 05:44:50'),
(8, 'EDIT_PERMISSIONS', '2021-11-21 14:38:58', '2021-11-21 14:38:58'),
(9, 'VIEW_ADMIN_MENU', '2021-11-22 08:56:06', '2021-11-22 08:56:06'),
(10, 'EDIT_MENU', '2021-11-22 08:56:07', '2021-11-22 08:56:07'),
(11, 'UPDATE_USER', '2021-11-24 11:24:20', '2021-11-24 11:24:20'),
(12, 'DELETE_USER', '2021-11-24 14:21:08', '2021-11-24 14:21:08'),
(13, 'VIEW_ADMIN_PORTFOLIOS', '2021-11-24 14:21:08', '2021-11-24 14:21:08');



INSERT INTO `portfolios` (`id`, `title`, `alias`, `description`, `keywords`, `text`, `customer`, `img`, `created_at`, `updated_at`, `filter_alias`) VALUES
(1, 'Steep This!', 'project1', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', 'Steep This!', '{\"mini\":\"0061-175x175.jpg\",\"max\":\"0061-770x368.jpg\",\"path\":\"0061.jpg\"}', '2021-11-03 12:17:41', '2021-11-03 12:17:41', 'brand-identity');
INSERT INTO `portfolios` (`id`, `title`, `alias`, `description`, `keywords`, `text`, `customer`, `img`, `created_at`, `updated_at`, `filter_alias`) VALUES
(2, 'Kineda', 'project2', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', '', '{\"mini\":\"009-175x175.jpg\",\"max\":\"009-770x368.jpg\",\"path\":\"009.jpg\"}', '2021-11-03 12:19:29', '2021-11-03 12:19:29', 'brand-identity');
INSERT INTO `portfolios` (`id`, `title`, `alias`, `description`, `keywords`, `text`, `customer`, `img`, `created_at`, `updated_at`, `filter_alias`) VALUES
(3, 'Love', 'project3', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', '', '{\"mini\":\"0011-175x175.jpg\",\"max\":\"0043-770x368.jpg\",\"path\":\"0043.jpg\"}', '2021-11-03 12:19:29', '2021-11-03 12:19:29', 'brand-identity');
INSERT INTO `portfolios` (`id`, `title`, `alias`, `description`, `keywords`, `text`, `customer`, `img`, `created_at`, `updated_at`, `filter_alias`) VALUES
(4, 'Guanacos', 'project4', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', 'Steep This!', '{\"mini\":\"0027-175x175.jpg\",\"max\":\"0027-770x368.jpg\",\"path\":\"0027.jpg\"}', '2021-11-03 12:19:29', '2021-11-03 12:21:31', 'web-development'),
(5, 'Miller Bob', 'project5', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', 'customer', '{\"mini\":\"0071-175x175.jpg\",\"max\":\"0071-770x368.jpg\",\"path\":\"0071.jpg\"}', '2021-11-03 12:19:29', '2021-11-03 12:47:10', 'brand-identity'),
(6, 'Nili Studios', 'project6', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', '', '{\"mini\":\"0052-175x175.jpg\",\"max\":\"0052-770x368.jpg\",\"path\":\"0052.jpg\"}', '2021-11-03 12:47:41', '2021-11-03 12:47:41', 'brand-identity'),
(7, 'VItale Premium', 'project7', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', 'Steep This!', '{\"mini\":\"0081-175x175.jpg\",\"max\":\"0081-770x368.jpg\",\"path\":\"0081.jpg\"}', '2021-11-03 12:48:45', '2021-11-03 12:48:45', 'brand-identity'),
(8, 'Digitpool Medien', 'project8', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', 'customer', '{\"mini\":\"0071-175x175.jpg\",\"max\":\"0071.jpg\",\"path\":\"0071-770x368.jpg\"}', '2021-11-03 12:49:32', '2021-11-03 12:49:32', 'brand-identity'),
(9, 'Octopus', 'project9', NULL, NULL, '<p>Nullam volutpat, mauris scelerisque iaculis semper, justo odio rutrum urna, at cursus urna nisl et ipsum. Donec dapibus lacus nec sapien faucibus eget suscipit lorem mattis.</p>\r\n\r\n<p>Donec non mauris ac nulla consectetur pretium sit amet rhoncus neque. Maecenas aliquet, diam sed rhoncus vestibulum, sem lacus ultrices est, eu hendrerit tortor nulla in dui. Suspendisse enim purus, euismod interdum viverra eget, ultricies eu est. Maecenas dignissim mauris id est semper suscipit. Suspendisse venenatis vestibulum quam, quis porttitor arcu vestibulum et.</p>\r\n\r\n<p>Sed porttitor eros ut purus elementum a consectetur purus vulputate</p>', '', '{\"mini\":\"0081-175x175.jpg\",\"max\":\"0081.jpg\",\"path\":\"0081-770x368.jpg\"}', '2021-11-03 12:50:19', '2021-11-03 12:50:19', 'web-development');

INSERT INTO `role_user` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(1, '2021-11-06 05:43:40', '2021-11-06 05:43:40', 1, 1);
INSERT INTO `role_user` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(9, '2021-11-16 07:55:03', '2021-11-16 07:55:03', 2, 2);
INSERT INTO `role_user` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(11, '2021-11-24 09:45:06', '2021-11-24 09:45:06', 4, 2);
INSERT INTO `role_user` (`id`, `created_at`, `updated_at`, `user_id`, `role_id`) VALUES
(12, '2021-11-24 12:12:51', '2021-11-24 12:12:51', 3, 2),
(13, '2021-11-24 12:14:38', '2021-11-24 12:14:38', 5, 3);

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2021-11-06 05:41:50', '2021-11-06 05:41:50');
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Moderator', '2021-11-06 05:41:50', '2021-11-06 05:41:50');
INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Guest', '2021-11-06 05:41:50', '2021-11-06 05:41:50');

INSERT INTO `sliders` (`id`, `title`, `text`, `img`, `created_at`, `updated_at`) VALUES
(1, '<h2 style=\"color: #fff\">CORPORATE, MULTIPURPOSE.<br /><span>PINK RIO</span></h2>', 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque.', 'xx.jpg', '2021-09-20 05:32:36', NULL);
INSERT INTO `sliders` (`id`, `title`, `text`, `img`, `created_at`, `updated_at`) VALUES
(2, '<h2 style=\"color:#fff\">PINK RIO. <span>STRONG AND POWERFUL.</span></h2>', 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque', '00314.jpg', '2021-09-20 05:32:36', NULL);
INSERT INTO `sliders` (`id`, `title`, `text`, `img`, `created_at`, `updated_at`) VALUES
(3, '<h2 style=\"color:#fff\">PINK RIO.<br />STRONG AND BEAUTIFUL.</h2>', 'Nam id quam a odio euismod pellentesque. Etiam congue rutrum risus non vestibulum. Quisque a diam at ligula blandit consequat. Mauris ac mi velit, a tempor neque', 'dd.jpg', '2021-09-20 05:32:36', NULL);

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `login`) VALUES
(1, 'Marchkoff Viacheslav', 'slavamarchkov@gmail.com', NULL, '$2y$10$tbGWFM3fOlXQ8FXFiC1ytObLsQ3xAerMqsSahwM3aSUwFbeJZPv1.', NULL, '2021-09-14 11:05:32', '2021-09-14 11:05:32', 'admin');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `login`) VALUES
(2, 'Slava', 'slavamarchkov@yandex.ru', NULL, '$2y$10$tbGWFM3fOlXQ8FXFiC1ytObLsQ3xAerMqsSahwM3aSUwFbeJZPv1.', NULL, '2021-09-14 11:05:32', '2021-09-14 11:05:32', 'SlavaMarchello');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `login`) VALUES
(3, 'Сушков Саша', 'carolunas@yandex.ru', NULL, '$2y$10$L5XdfdQN85I.vo2UWT9Fv.Xr7C3oESeuTBBfs4minInMJGJ.PPHkO', NULL, '2021-11-24 09:34:27', '2021-11-24 12:12:51', 'sushkov');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `login`) VALUES
(4, 'User2', 'user2@user.com', NULL, '$2y$10$KhOGoQSlNSTfrT.0ndDDLuAufPKtiAd8YgdgzaTbzKYwPHWKek/ha', NULL, '2021-11-24 09:45:06', '2021-11-24 09:45:06', 'user2'),
(5, 'User3', 'user3@user.com', NULL, '$2y$10$r8MPNRx2vrafHOFayEUJwu9PWm4JVuZX29IkFSlA2Wa9satGe3TL2', NULL, '2021-11-24 12:14:38', '2021-11-24 12:14:38', 'user3');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;