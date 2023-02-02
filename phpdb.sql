CREATE TABLE
  `account` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `fullname` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `function` int(10) DEFAULT 0,
    `IBAN` varchar(27) NOT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    `last_connection` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `fullname` (`fullname`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `IBAN` (`IBAN`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci

  CREATE TABLE
  `currency` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `multiplier` int(100) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci

  CREATE TABLE
  `transactions` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(255) NOT NULL,
    `user_id` varchar(255) NOT NULL,
    `amount` int(255) NOT NULL,
    `currency` varchar(255) NOT NULL,
    `status` tinyint(1) DEFAULT NULL,
    `processed` tinyint(1) DEFAULT 0,
    `processed_at` datetime DEFAULT NULL,
    `processed_by` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci

  CREATE TABLE
  `transfers` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `sender` varchar(255) NOT NULL,
    `receiver` varchar(255) NOT NULL,
    `amount` int(255) NOT NULL,
    `currency` varchar(255) NOT NULL,
    `created_at` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci
