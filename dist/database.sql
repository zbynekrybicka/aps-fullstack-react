CREATE TABLE IF NOT EXISTS `user` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` CHAR(255) NOT NULL,
  `password` CHAR(64) NOT NULL,
  `role` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;

INSERT INTO `user` (`username`, `password`, `role`) VALUES ('test', '$2y$12$8Ig54ZFseLU0Ze0FaAmLPOVymqTPyU8MlfqKAdYM72Q354BW8bLIy', 1);