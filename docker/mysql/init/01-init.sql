CREATE DATABASE IF NOT EXISTS `web-log` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `web-log`;

CREATE TABLE IF NOT EXISTS `users` (
                                       `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                       `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `login` VARCHAR(100) NOT NULL,
    `password` CHAR(32) NOT NULL,
    `reg_date` INT UNSIGNED DEFAULT UNIX_TIMESTAMP(),
    PRIMARY KEY (`id`),
    UNIQUE KEY `login_unique` (`login`),
    UNIQUE KEY `email_unique` (`email`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `articles` (
                                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `title` VARCHAR(255) NOT NULL,
    `anons` TEXT NOT NULL,
    `full_text` MEDIUMTEXT NOT NULL,
    `date` INT UNSIGNED NOT NULL,
    `author` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `comments` (
                                          `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
                                          `name` VARCHAR(255) NOT NULL,
    `message` TEXT NOT NULL,
    `article_id` INT UNSIGNED NOT NULL,
    `date` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `article_idx` (`article_id`),
    CONSTRAINT `fk_comments_article`
    FOREIGN KEY (`article_id`) REFERENCES `articles`(`id`)
    ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
