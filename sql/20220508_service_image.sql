/* 9:07:51 PM easyap_localhost easyappointments */ 
ALTER TABLE `ea_services` ADD `image` INT  NULL  DEFAULT NULL  AFTER `duration`;
/* 9:07:59 PM easyap_localhost easyappointments */
ALTER TABLE `ea_services` CHANGE `image` `image` VARCHAR(256)  NULL  DEFAULT NULL;
