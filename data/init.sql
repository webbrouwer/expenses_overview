CREATE DATABASE expenses_overview_2;

use expenses_overview_2;

CREATE TABLE expenses (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    value decimal(13,2) NOT NULL,
    category text NOT NULL,
    date date NULL
);
