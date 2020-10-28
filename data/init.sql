CREATE DATABASE expenses_overview;

use expenses_overview;

CREATE TABLE `expenses` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `value` decimal(13,2) NOT NULL,
    `category` text NOT NULL,
    `date` date NOT NULL
);

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `is_active` enum('0','1') NOT NULL,
    `date_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;