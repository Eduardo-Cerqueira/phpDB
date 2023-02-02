CREATE TABLE
  `account` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `fullname` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `function` int(10) DEFAULT 0,
    `created_at` datetime DEFAULT current_timestamp(),
    `last_connection` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `fullname` (`fullname`, `email`)
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
  `transaction` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` varchar(255) NOT NULL,
    `emitter_id` varchar(255) NOT NULL,
    `emitter_amount` varchar(255) NOT NULL,
    `emitter_currency` varchar(255) NOT NULL,
    `receiver_id` varchar(255) NOT NULL,
    `receiver_amount` varchar(255) NOT NULL,
    `receiver_currency` varchar(255) NOT NULL,
    `status` boolean DEFAULT NULL,
    `processed` boolean NOT NULL,
    `processed_by` varchar(255) NOT NULL,
    `processed_at` datetime,
    `created_at` datetime DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_general_ci
