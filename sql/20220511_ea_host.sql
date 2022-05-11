CREATE TABLE `ea_host` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `chinese_name` varchar(256) DEFAULT NULL,
  `english_name` varchar(256) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `logo` varchar(256) DEFAULT NULL,
  `description` varchar(256) DEFAULT '',
  `main_color` varchar(32) DEFAULT NULL,
  `secondary_color` varchar(32) DEFAULT NULL,
  `text_color` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ea_host` (`id`, `chinese_name`, `english_name`, `url`, `logo`, `description`, `main_color`, `secondary_color`, `text_color`) 
  VALUES ('1', '車友趣', 'car2dude', 'https://www.car2dude.com/', 'https://reserve.car2dude.com/assets/img/logo.png', '車輛保養維修最佳夥伴', '#ff7e35', NULL, NULL);