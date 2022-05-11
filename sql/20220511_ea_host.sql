CREATE TABLE `ea_host` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `value` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('1', 'chinese_name', '車友趣');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('2', 'english_name', 'car2dude');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('3', 'url', 'https://www.car2dude.com/');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('4', 'logo', 'https://reserve.car2dude.com/assets/img/logo.png');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('5', 'description', '車輛保養維修最佳夥伴');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('6', 'main_color', '#ff7e35');
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('7', 'secondary_color', NULL);
INSERT INTO `ea_host` (`id`, `name`, `value`) VALUES ('8', 'logo', NULL);