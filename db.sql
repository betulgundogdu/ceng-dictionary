CREATE DATABASE `ceng_dict`;

CREATE TABLE `Category` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`c_id`)
);

CREATE TABLE `Header` (
  `h_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`h_id`),
  KEY `Header_FK` (`c_id`),
  CONSTRAINT `Header_FK`
    FOREIGN KEY (`c_id`)
    REFERENCES `Category` (`c_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `Entry` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) NOT NULL,
  `text` text CHARACTER SET utf8,
  `created_date` date DEFAULT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `Entry_FK` (`u_id`),
  KEY `Entry_FK_1` (`h_id`),
  CONSTRAINT `Entry_FK` 
    FOREIGN KEY (`u_id`) 
    REFERENCES `User` (`u_id`) 
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `Entry_FK_1`
    FOREIGN KEY (`h_id`)
    REFERENCES `Header` (`h_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

CREATE TABLE `User` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `created_at` date NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`u_id`)
);

CREATE TABLE `Message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `context` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  PRIMARY KEY (`m_id`),
  KEY `Message_FK` (`sender_id`),
  KEY `Message_FK_1` (`receiver_id`),
  CONSTRAINT `Message_FK` 
    FOREIGN KEY (`sender_id`) 
    REFERENCES `User` (`u_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `Message_FK_1` 
    FOREIGN KEY (`receiver_id`) 
    REFERENCES `User` (`u_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO ceng_dict.Category (title) VALUES
	 ('genel'),
	 ('os'),
	 ('embedded'),
	 ('ai / ml'),
	 ('networks'),
	 ('web'),
	 ('mobil');

INSERT INTO ceng_dict.Header (title,c_id) VALUES
	 ('hello world',1);

INSERT INTO ceng_dict.User (username,password,created_at,type) VALUES
	 ('admin',123, 19-01-2021, 'admin');