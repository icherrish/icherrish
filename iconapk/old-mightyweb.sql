/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 8.0.23-0ubuntu0.20.04.1 : Database - mightyweb_new
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/*Table structure for table `app_settings` */

DROP TABLE IF EXISTS `app_settings`;

CREATE TABLE `app_settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `app_settings` */

insert  into `app_settings`(`id`,`key`,`value`) values (NULL,'appconfiguration','{\"app_name\":\"Mighty Web \",\"url\":\"https://meetmighty.com/mighty-intro/mighty-web-intro/\",\"appLanuguage\":\"en\",\"isJavascriptEnable\":\"true\",\"isSplashScreen\":\"true\",\"isZoomFunctionality\":\"false\",\"navigationStyle\":\"sidedrawer\",\"header_style\":\"left\",\"is_walkthrough\":\"true\",\"is_webrtc\":\"false\",\"is_floating_button\":\"true\",\"floating_button_style\":\"regular\",\"is_pull_refresh\":\"true\",\"tab_style\":\"tab_with_title_icon\",\"bottom_navigation\":\"bottom_navigation_3\",\"walkthrough_style\":\"walkthrough_style_3\",\"clear_cookie\":\"false\",\"isExitPopupScreen\":\"true\",\"disable_header\":\"false\",\"disable_footer\":\"false\",\"app_logo\":\"https://meetmighty.com/mightywebbuilder/upload/app_logo.png\",\"floating_button\":\"https://meetmighty.com/mightywebbuilder/upload/floating_button.png\"}'),(NULL, 'admob', '{\"ads_type\":\"admob\",\"admobBannerID\":\"\",\"admobIntentialID\":\"\",\"admobBannerIDIOS\":\"\",\"admobIntentialIDIOS\":\"\",\"facebookBannerID\":\"\",\"facebookIntentialID\":\"\",\"facebookBannerIDIOS\":\"\",\"facebookIntentialIDIOS\":\"\"}'),(NULL, 'progressbar', '{\"is_progressbar\":\"true\",\"loaderStyle\":\"FadingCircle\"}'),(NULL,'theme','{\"themeStyle\":\"Theme6\",\"customColor\":null,\"gradientColor1\":null,\"gradientColor2\":null}'),(NULL,'about','{\"whatsAppNumber\":\"98796543210\",\"instagramUrl\":\"https://www.instagram.com/\",\"twitterUrl\":\"https://twitter.com/login\",\"facebookUrl\":\"https://www.facebook.com/\",\"callNumber\":\"9876543210\",\"snapchat\":\"https://www.snapchat.com/\",\"skype\":\"https://www.skype.com/en/\",\"messenger\":\"https://www.messenger.com/\",\"youtube\":\"https://www.youtube.com/\",\"isShowAbout\":\"true\"}'),(NULL,'onesignal_configuration','{\"app_id\":\"xxxxx\",\"rest_api_key\":\"xxxxx\"}'), (NULL, 'splash_configuration', '{\"first_color\":\"#3788ff\",\"second_color\":\"#4581e8\",\"title\":\"Mighty Web\",\"enable_title\":\"true\",\"title_color\":\"#ffffff\",\"enable_logo\":\"true\",\"enable_background\":\"false\",\"splash_logo_url\":\"https://meetmighty.com/mightywebbuilder/upload/splash_logo.png\",\"splash_background_url\":\"https://meetmighty.com/mightywebbuilder/upload/splash_background.png\"}'), (NULL, 'exitpopup_configuration', '{\"title\":\"Do you want to exit at this moment? \",\"positive_text\":\"Yes\",\"negative_text\":\"No\",\"enable_image\":\"true\",\"exit_image_url\":\"https://meetmighty.com/mightywebbuilder/upload/cancel.png\"}'), (NULL, 'share_content', '{\"share\":\"share conntentt https://meetmighty.com/mighty/contact/\"}');

/*Table structure for table `left_header_icon` */

DROP TABLE IF EXISTS `left_header_icon`;

CREATE TABLE `left_header_icon` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `left_header_icon` */

insert  into `left_header_icon`(`id`,`title`,`value`,`image`,`type`,`url`,`status`,`created_at`,`updated_at`) values (1,'Back Button 1','ic_back1','ic_back1.png','event',NULL,0,'2021-04-09 05:19:17','2021-04-09 05:19:17'),(2,'Back Button 2','ic_back2','ic_back2.png','event',NULL,1,'2021-04-09 05:19:27','2021-04-09 05:19:27'),(3,'Home','ic_home','ic_home.png','event',NULL,0,'2021-04-09 05:20:00','2021-04-09 05:20:00'),(4,'Profile','ic_profile','ic_profile.png','url','https://www.google.com/',0,'2021-04-09 05:20:29','2021-04-09 05:20:29'),(5,'Close','ic_close','ic_close.png','event',NULL,0,'2021-04-09 05:20:30','2021-04-09 05:20:30'),(6,'Search','ic_search','ic_search.png','url','https://www.google.com/',0,'2021-04-09 05:20:36','2021-04-09 05:20:36'),(7,'Add','ic_add','ic_add.png','url','https://www.google.com/',0,'2021-04-09 05:20:51','2021-04-09 05:20:51');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255),
  `type` varchar(255) DEFAULT NULL,
  `image` varchar(255),
  `url` varchar(255),
  `status` tinyint(1) DEFAULT '1',
  `parent_id` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`title`,`type`,`image`,`url`,`status`) values (1,'Home','bottom_navigation','1618040510-ic_home.png','https://meetmighty.com/mightywebbuilder',1),(2,'Search','bottom_navigation','1618040523-ic_search.png','https://codecanyon.net/user/meetmighty/portfolio',1),(3,'Cart','bottom_navigation','1618040544-ic_cart.png','https://www.myntra.com/',1),(4,'Settings','bottom_navigation','1618040565-ic_settings.png','https://www.google.com/',1),(7,'About','sidedrawer','1618655222-icon_4.png','https://themeforest.net/user/meetmighty',1);

/*Table structure for table `right_header_icon` */

DROP TABLE IF EXISTS `right_header_icon`;

CREATE TABLE `right_header_icon` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `right_header_icon` */

insert  into `right_header_icon`(`id`,`title`,`value`,`image`,`type`,`url`,`status`,`created_at`,`updated_at`) values (1,'Reload','ic_reload','ic_reload.png','event',NULL,1,'2020-06-07 21:28:42','2020-06-07 21:28:42'),(2,'Search','ic_search','ic_search.png','url','https://www.google.com/',1,'2020-06-07 21:48:16','2020-06-07 21:48:16'),(3,'Cart','ic_cart','ic_cart.png','url','https://www.myntra.com/',0,'2021-04-09 05:11:40','2021-04-09 05:11:40'),(4,'Settings','ic_settings','ic_settings.png','url','https://www.google.com/',0,'2021-04-09 10:33:15','2021-04-09 10:33:17'),(5,'Share','ic_share','ic_share.png','event',NULL,0,'2020-06-07 21:46:42','2020-06-07 21:46:42'),(6,'Close','ic_close','ic_close.png','event',NULL,0,'2021-04-09 05:10:36','2021-04-09 05:10:36'),(7,'Profile','ic_profile','ic_profile.png','url','https://www.google.com/',0,'2021-04-09 05:11:54','2021-04-09 05:11:54'),(8,'Message','ic_message','ic_message.png','url','https://www.google.com/',0,'2021-04-09 05:12:47','2021-04-09 05:12:47'),(9,'Notification','ic_notification','ic_notification.png','url','https://www.google.com/',0,'2021-04-09 05:13:11','2021-04-09 05:13:11'), (NULL, 'Favourite', 'ic_favourite', 'ic_favourite.png\r\n', 'url', 'https://www.google.com/', '0', '2021-06-24 17:01:26', NULL), (NULL, 'Add', 'ic_add', 'ic_add.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:01:26', NULL), (NULL, 'List', 'ic_list', 'ic_list.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:03:34', NULL), (NULL, 'Filter', 'ic_filter', 'ic_filter.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:03:34', NULL), (NULL, 'Chat', 'ic_chat', 'ic_chat.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:04:24', NULL), (NULL, 'About', 'ic_about', 'ic_about.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:04:24', NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`first_name`,`last_name`) values (1,'admin@example.com','21232f297a57a5a743894a0e4a801fc3','Admin','Admin');

/*Table structure for table `walkthrough` */

DROP TABLE IF EXISTS `walkthrough`;

CREATE TABLE `walkthrough` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `walkthrough` (`id`, `title`, `subtitle`, `image`, `status`) VALUES (NULL, 'Mighty Web', 'MightyWeb app is used to convert your Website to Application Mobile', 'default.png', '1'), (NULL, 'Theme Style', 'Mighty Web holds stunning options of Theme styles that you can apply to your mobile app to define your app better.', 'default.png', '1');

/*Table structure for table `walkthrough` */

DROP TABLE IF EXISTS `floating_button`;

CREATE TABLE `floating_button` ( 
  `id` int unsigned NOT NULL AUTO_INCREMENT, 
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `floating_button` (`id`, `title`, `image`, `url`, `status`) VALUES (NULL, 'Search', 'ic_search.png', 'https://www.google.com/', '1'), (NULL, 'Message', 'ic_message.png', 'https://www.google.com/', '1'), (NULL, 'Share', 'ic_share.png', 'https://www.google.com/', '1'), (NULL, 'Home', 'ic_home.png', 'https://www.google.com/', '1');

/*Table structure for table `user_agent` */

DROP TABLE IF EXISTS `user_agent`;

CREATE TABLE `user_agent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `android` text,
  `ios` text,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_agent` */

INSERT INTO `user_agent` (`id`, `title`, `android`, `ios`, `status`) VALUES (NULL, 'Web Browser', 'random', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1', '1');


/*Table structure for table `tabs` */

DROP TABLE IF EXISTS `tabs`;

CREATE TABLE `tabs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tabs` */
INSERT INTO `tabs` (`id`, `title`, `image`, `url`, `status`) VALUES (NULL, 'Home', 'ic_home.png', 'https://www.google.com/', '1'), (NULL, 'Search', 'ic_search.png', 'https://www.google.com/', '1'), (NULL, 'Profile', 'ic_profile.png', 'https://www.google.com/', '1'), (NULL, 'Wishlist', 'ic_heart.png', 'https://www.google.com/', '1');

/*Table structure for table `pages` */
CREATE TABLE `pages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
