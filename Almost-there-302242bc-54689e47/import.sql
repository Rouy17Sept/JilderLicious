CREATE DATABASE `yfood`;

CREATE USER 'bit_academy'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'bit_academy'@'localhost';

USE `yfood`;

CREATE TABLE `yfood`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(100) NOT NULL,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `email` VARCHAR(250) NOT NULL,
  `role` ENUM('1', '2') NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `yfood`.`category` (
    id INT NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    active ENUM('YES','NO') NOT NULL,
    favorite ENUM('YES','NO') NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE `yfood`.`product` (
    id INT NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(100) NOT NULL,
    product_description VARCHAR(100) NULL,
    product_price VARCHAR(100) NOT NULL,
    product_image VARCHAR(100) NULL,
    category_id INT NOT NULL,
    active ENUM('YES','NO') NOT NULL,
    favorite ENUM('YES','NO') NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (category_id) REFERENCES category(id)
);


CREATE TABLE `yfood`.`tbl_order` (
  id INT NOT NULL AUTO_INCREMENT,
  food VARCHAR(100) NOT NULL,
  price VARCHAR(100) NOT NULL,
  quantity VARCHAR(100) NOT NULL,
  total VARCHAR(100) NOT NULL,
  user_id INT NOT NULL,
  status ENUM('1', '2', '3') NOT NULL,
  customer_name VARCHAR(100) NOT NULL,
  customer_phone VARCHAR(100) NOT NULL,
  customer_email VARCHAR(100) NOT NULL,
  customer_address VARCHAR(100) NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES user(id)
);

ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `customer_postcode` VARCHAR(100) NOT NULL AFTER `customer_address`;
ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `customer_city` VARCHAR(100) NOT NULL AFTER `customer_postcode`;
ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `payment_method` VARCHAR(100) NOT NULL AFTER `customer_city`;

ALTER TABLE `yfood`.`category` ADD COLUMN `category_image` VARCHAR(100) NULL AFTER `category_name`;

CREATE TABLE `yfood`.`contact` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(100) NULL,
  `ordernr` VARCHAR(100) NULL,
  `message` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`)
  );

ALTER TABLE `yfood`.`contact` ADD COLUMN `created_at` DATETIME NULL AFTER `message`;
ALTER TABLE `yfood`.`contact` ADD COLUMN `updated_at` DATETIME NULL AFTER `created_at`;
ALTER TABLE `yfood`.`contact` ADD COLUMN `ip` VARCHAR(100) NULL AFTER `updated_at`;
ALTER TABLE `yfood`.`contact` ADD COLUMN `status` VARCHAR(100) NULL AFTER `ip`;
ALTER TABLE `yfood`.`contact` ADD COLUMN `last_updated_by` VARCHAR(100) NULL AFTER `status`;

ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `ip_address` VARCHAR(100) NULL AFTER `customer_city`;
ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `ordernr` VARCHAR(100) NULL AFTER `id`;
ALTER TABLE `yfood`.`tbl_order` ADD COLUMN product_id INT NOT NULL;

ALTER TABLE `tbl_order` CHANGE `status` `status` ENUM('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;

ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `payment_status` ENUM('0','1','2','3', '4', '5')  NULL AFTER `payment_method`;


CREATE TABLE `yfood`.`tbl_administrator` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NULL,
  `password` VARCHAR(100) NULL,
  `about` VARCHAR(255) NULL,
  `favicon` VARCHAR(100) NULL,
  `logo` VARCHAR(100) NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  `postcode` VARCHAR(100) NULL,
  `city` VARCHAR(100) NULL,
  `address` VARCHAR(100) NULL,
  `phone` VARCHAR(100) NULL,
  `mobile` VARCHAR(100) NULL,
  `facebook` VARCHAR(100) NULL,
  `twitter` VARCHAR(100) NULL,
  `instagram` VARCHAR(100) NULL,
  `linkedin` VARCHAR(100) NULL,
  `youtube` VARCHAR(100) NULL,
  `google` VARCHAR(100) NULL,
  PRIMARY KEY (`id`)
  );

ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `comment` VARCHAR(255) NULL AFTER `product_id`;

ALTER TABLE `yfood`.`tbl_order` CHANGE `status` `status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL;
ALTER TABLE `yfood`.`tbl_order` CHANGE `payment_status` `payment_status` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;
ALTER TABLE `yfood`.`tbl_order` ADD COLUMN `last_updated_by` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL;	