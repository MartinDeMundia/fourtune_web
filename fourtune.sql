/*
MySQL Data Transfer
Source Host: localhost
Source Database: fourtune
Target Host: localhost
Target Database: fourtune
Date: 2/26/2021 4:51:49 PM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for fourtune_events
-- ----------------------------
CREATE TABLE `fourtune_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(300) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `event_description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_featured_image` varchar(500) DEFAULT NULL,
  `event_location` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fourtune_images
-- ----------------------------
CREATE TABLE `fourtune_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(500) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fourtune_token_coins_earned
-- ----------------------------
CREATE TABLE `fourtune_token_coins_earned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `coins_earned` decimal(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  `game` varchar(50) DEFAULT NULL,
  `level` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fourtune_token_price
-- ----------------------------
CREATE TABLE `fourtune_token_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game` varchar(45) DEFAULT NULL,
  `token_qty` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` smallint(6) DEFAULT NULL,
  `level` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fourtune_token_purchases
-- ----------------------------
CREATE TABLE `fourtune_token_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `purchase_date` datetime DEFAULT NULL,
  `token_amount` decimal(10,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for fourtune_token_transfer
-- ----------------------------
CREATE TABLE `fourtune_token_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(11) DEFAULT NULL,
  `to_user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `totals_from` decimal(10,2) DEFAULT NULL,
  `totals_to` decimal(10,2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `fourtune_events` VALUES ('16', 'Connect, Innovate and Trade', '2021-02-23 00:00:00', 'WealthFest Africa - Annual Membership\r\n\r\nNetwork with African entrepreneurs, mentors and investors from all sectors\r\nOpportunity to pitch your business and access early-stage investment \r\n', '500.00', '2021-02-26 09:22:29', '2021-02-26 12:33:01', 'http://workstation.fourtune-api/uploads/events/Connect-Innovate-and-Trade/6038bdd59156a.jpg', 'Nairobi, Kenya');
INSERT INTO `fourtune_events` VALUES ('17', 'Camping', '2021-03-16 00:00:00', 'Mountain Climbing at Mount Suswa', '30.50', '2021-02-26 09:50:26', '2021-02-26 09:50:26', 'http://workstation.fourtune-api/uploads/events/Camping/6038c462030c4.jpg', 'Mount Suswa');
INSERT INTO `fourtune_images` VALUES ('30', 'http://workstation.fourtune-api/uploads/events/more/16/event_image2.jpg', '16', '2021-02-26 09:22:30', '2021-02-26 09:22:30', 'events');
INSERT INTO `fourtune_images` VALUES ('31', 'http://workstation.fourtune-api/uploads/events/more/17/event_image1.jpg', '17', '2021-02-26 09:50:26', '2021-02-26 09:50:26', 'events');
INSERT INTO `fourtune_images` VALUES ('32', 'http://workstation.fourtune-api/uploads/events/more/17/bg9.jpg', '17', '2021-02-26 09:50:26', '2021-02-26 09:50:26', 'events');
INSERT INTO `fourtune_token_coins_earned` VALUES ('1', '26', '5.00', '2021-02-14 16:27:00', '2021-02-14 16:27:00', 'Chess', '10');
INSERT INTO `fourtune_token_coins_earned` VALUES ('2', '26', '7.00', '2021-02-14 16:27:00', '2021-02-14 16:27:00', 'Spider Solitaire', '5');
INSERT INTO `fourtune_token_coins_earned` VALUES ('3', '26', '9.00', '2021-02-14 16:27:00', '2021-02-14 16:27:00', 'Candy Crush', '4');
INSERT INTO `fourtune_token_coins_earned` VALUES ('14', '26', '0.45', '2021-02-16 11:12:02', '2021-02-16 11:12:02', 'Maze', '1');
INSERT INTO `fourtune_token_coins_earned` VALUES ('15', '26', '0.45', '2021-02-16 11:25:17', '2021-02-16 11:25:17', 'Maze', '1');
INSERT INTO `fourtune_token_coins_earned` VALUES ('16', '26', '0.45', '2021-02-16 11:46:33', '2021-02-16 11:46:33', 'Maze', '1');
INSERT INTO `fourtune_token_coins_earned` VALUES ('17', '26', '0.45', '2021-02-17 08:18:23', '2021-02-17 08:18:23', 'Maze', '1');
INSERT INTO `fourtune_token_coins_earned` VALUES ('18', '26', '0.10', '2021-02-17 08:41:41', '2021-02-17 08:41:41', 'Tetris', '1');
INSERT INTO `fourtune_token_coins_earned` VALUES ('19', '26', '0.50', '2021-02-17 08:44:27', '2021-02-17 08:44:27', 'Tetris', '0');
INSERT INTO `fourtune_token_coins_earned` VALUES ('20', '26', '0.50', '2021-02-17 08:48:44', '2021-02-17 08:48:44', 'Tetris', '0');
INSERT INTO `fourtune_token_coins_earned` VALUES ('21', '27', '0.45', '2021-02-18 13:57:29', '2021-02-18 13:57:29', 'Maze', '1');
INSERT INTO `fourtune_token_price` VALUES ('170', 'Maze', '39.00', '0.45', '2021-02-15 07:18:28', '2021-02-14 11:22:28', null, '1');
INSERT INTO `fourtune_token_price` VALUES ('171', 'Chess', '4.00', '0.34', '2021-02-14 11:29:16', '2021-02-14 11:29:16', null, '1');
INSERT INTO `fourtune_token_price` VALUES ('177', 'Blockis Master', '56.00', '0.95', '2021-02-15 07:19:16', '2021-02-15 07:19:16', null, '1');
INSERT INTO `fourtune_token_price` VALUES ('178', 'Maze', null, '0.45', '2021-02-16 10:24:55', '2021-02-16 10:24:55', null, '2');
INSERT INTO `fourtune_token_price` VALUES ('179', 'Tetris', null, '0.50', '2021-02-17 08:41:06', '2021-02-17 08:41:06', null, '0');
INSERT INTO `fourtune_token_price` VALUES ('180', 'Tetris', null, '0.10', '2021-02-17 08:41:17', '2021-02-17 08:41:17', null, '1');
INSERT INTO `fourtune_token_purchases` VALUES ('1', '12', '2021-02-14 16:15:00', '45.00', '2021-02-14 16:16:10', '2021-02-14 16:16:10');
INSERT INTO `fourtune_token_purchases` VALUES ('2', '25', '2021-02-15 10:54:44', '58.00', '2021-02-15 10:54:44', '2021-02-15 10:54:44');
INSERT INTO `fourtune_token_purchases` VALUES ('3', '26', '2021-02-15 11:41:11', '14.00', '2021-02-15 11:41:11', '2021-02-15 11:41:11');
INSERT INTO `fourtune_token_purchases` VALUES ('4', '26', '2021-03-15 11:41:39', '39.00', '2021-02-15 11:41:39', '2021-02-15 11:41:39');
INSERT INTO `fourtune_token_purchases` VALUES ('5', '26', '2021-07-15 12:48:45', '5.00', '2021-02-15 12:48:45', '2021-02-15 12:48:45');
INSERT INTO `fourtune_token_purchases` VALUES ('6', '26', '2021-12-15 14:40:04', '20.00', '2021-02-15 14:40:04', '2021-02-15 14:40:04');
INSERT INTO `fourtune_token_transfer` VALUES ('1', '26', '25', '10.00', '86.00', '1351.00', '2021-02-15 13:49:48', '2021-02-15 13:49:48');
INSERT INTO `fourtune_token_transfer` VALUES ('2', '26', '25', '10.00', '76.00', '1361.00', '2021-02-15 14:01:47', '2021-02-15 14:01:47');
INSERT INTO `fourtune_token_transfer` VALUES ('3', '26', '25', '6.00', '70.00', '1367.00', '2021-02-15 14:02:55', '2021-02-15 14:02:55');
