CREATE TABLE IF NOT EXISTS `#__user_registration_form`
( `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT(8) NOT NULL ,
  `accept` VARCHAR(50) NOT NULL ,
  `timestamp` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` TEXT NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
