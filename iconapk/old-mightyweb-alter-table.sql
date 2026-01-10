/*
INSERT INTO `right_header_icon` (`id`, `title`, `value`, `image`, `type`, `url`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'QR Code', 'ic_qr_code', 'ic_qr_code.png', 'event', NULL, '0', '2022-07-25 05:10:36', NULL);
*/
/*Table structure for table `pages` */
/*
CREATE TABLE `pages` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `title` varchar(255) DEFAULT NULL,
    `image` varchar(255) DEFAULT NULL,
    `url` varchar(255) DEFAULT NULL,
    `status` tinyint(1) DEFAULT '1',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

*/


/*Data for the table `right_header_icon` */
/*
INSERT INTO `right_header_icon` (`id`, `title`, `value`, `image`, `type`, `url`, `status`, `created_at`, `updated_at`) VALUES (NULL, 'Favourite', 'ic_favourite', 'ic_favourite.png\r\n', 'url', 'https://www.google.com/', '0', '2021-06-24 17:01:26', NULL), (NULL, 'Add', 'ic_add', 'ic_add.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:01:26', NULL), (NULL, 'List', 'ic_list', 'ic_list.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:03:34', NULL), (NULL, 'Filter', 'ic_filter', 'ic_filter.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:03:34', NULL), (NULL, 'Chat', 'ic_chat', 'ic_chat.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:04:24', NULL), (NULL, 'About', 'ic_about', 'ic_about.png', 'url', 'https://www.google.com/', '0', '2021-06-24 17:04:24', NULL);
*/
/*Table structure for table `user_agent` */

/*
DROP TABLE IF EXISTS `user_agent`;

CREATE TABLE `user_agent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `android` text,
  `ios` text,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/
/*Data for the table `user_agent` */
/*
INSERT INTO `user_agent` (`id`, `title`, `android`, `ios`, `status`) VALUES (NULL, 'Web Browser', 'random', 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.1 Mobile/15E148 Safari/604.1', '1');
*/

/*Table structure for table `tabs` */
/*
DROP TABLE IF EXISTS `tabs`;

CREATE TABLE `tabs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
*/
/*Data for the table `tabs` */
/*
INSERT INTO `tabs` (`id`, `title`, `image`, `url`, `status`) VALUES (NULL, 'Home', 'ic_home.png', 'https://www.google.com/', '1'), (NULL, 'Search', 'ic_search.png', 'https://www.google.com/', '1'), (NULL, 'Profile', 'ic_profile.png', 'https://www.google.com/', '1'), (NULL, 'Wishlist', 'ic_heart.png', 'https://www.google.com/', '1');
*/


/*Table structure for table `floating_button` */
/*
DROP TABLE IF EXISTS `floating_button`;

CREATE TABLE `floating_button` ( 
  `id` int unsigned NOT NULL AUTO_INCREMENT, 
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL, 
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL, 
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL, 
  `status` tinyint(1) DEFAULT '1', 
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `floating_button` (`id`, `title`, `image`, `url`, `status`) VALUES (NULL, 'Search', 'ic_search.png', 'https://www.google.com/', '1'), (NULL, 'Message', 'ic_message.png', 'https://www.google.com/', '1'), (NULL, 'Share', 'ic_share.png', 'https://www.google.com/', '1'), (NULL, 'Home', 'ic_home.png', 'https://www.google.com/', '1');
*/
/* Add `parent_id` in menu table*/

 /* ALTER TABLE `menu` ADD `parent_id` INT(11) NULL DEFAULT '0' AFTER `status`; */


/*Table structure for table `walkthrough` */
/*
DROP TABLE IF EXISTS `walkthrough`;

CREATE TABLE `walkthrough` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` text,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `walkthrough` (`id`, `title`, `subtitle`, `image`, `status`) VALUES (NULL, 'Mighty Web', 'MightyWeb app is used to convert your Website to Application Mobile', 'default.png', '1'), (NULL, 'Theme Style', 'Mighty Web holds stunning options of Theme styles that you can apply to your mobile app to define your app better.', 'default.png', '1');
*/