# Instructions

- Install dependencies

```bash
php composer.phar install

```

- Add configuration

Edit config/constants.php
db config and base url etc..

- Tables

```SQL
DROP TABLE IF EXISTS `short_url`;
CREATE TABLE `short_url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `short_url_log`;
CREATE TABLE `short_url_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `short_url_id` int(11) NOT NULL,
  `client_ip` varchar(255) NOT NULL,
  `logged_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `short_url_id` (`short_url_id`),
  CONSTRAINT `short_url_log_ibfk_1` FOREIGN KEY (`short_url_id`) REFERENCES `short_url` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

```

- start server

```bash
php -S localhost:8080

```