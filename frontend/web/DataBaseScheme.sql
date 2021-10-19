CREATE TABLE `user` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `fullName` varchar(255),
  `password` varchar(255),
  `createdAt` timestamp,
  `about` varchar(255),
  `age` date,
  `cityId` int,
  `street` varchar(255),
  `home` varchar(255),
  `facebook` char(255),
  `email` char(255),
  `number` int,
  `categoryId` int
);

CREATE TABLE `task` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `clientId` int,
  `workerId` int,
  `title` char(255),
  `categoryId` int,
  `createdAt` timestamp,
  `description` varchar(255),
  `price` int,
  `term` date
);

CREATE TABLE `evaluations` (
  `id` int PRIMARY KEY,
  `rate` decimal,
  `isTaskComplete` int,
  `failedTask` int,
  `comment` varchar(255)
);

CREATE TABLE `comment` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `comment` varchar(255),
  `time` timestamp,
  `price` int,
  `userId` int
);

CREATE TABLE `include` (
  `id` int PRIMARY KEY,
  `attachment` MEDIUMBLOB
);

CREATE TABLE `city` (
  `id` int,
  `city` varchar(255),
  `coordinatesLatitude` decimal(10,8) DEFAULT NULL,
  `coordinatesLongitude` decimal(11,8) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `category` (
  `id` int PRIMARY KEY,
  `categories` varchar(255)
);

CREATE TABLE `userCategory` (
  `userId` INT NOT NULL,
  `categoryId` INT NOT NULL,
  CONSTRAINT `userCategory_PK` PRIMARY KEY (`userId`,`categoryId`)

);

ALTER TABLE `task` ADD FOREIGN KEY (`clientId`) REFERENCES `user` (`id`);

ALTER TABLE `user` ADD FOREIGN KEY (`id`) REFERENCES `evaluations` (`id`);

ALTER TABLE `comment` ADD FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `comment` ADD FOREIGN KEY (`id`) REFERENCES `task` (`id`);

ALTER TABLE `include` ADD FOREIGN KEY (`id`) REFERENCES `task` (`id`);

ALTER TABLE `task` ADD CONSTRAINT task_FK FOREIGN KEY (`categoryId`) REFERENCES `category`(`id`);


ALTER TABLE `userCategory` ADD CONSTRAINT `userCategory_FK` FOREIGN KEY (`categoryId`) REFERENCES `category`(`id`);
ALTER TABLE `userCategory` ADD CONSTRAINT `userCategory_FK_1` FOREIGN KEY (`userId`) REFERENCES `user`(`id`);


ALTER TABLE `user` ADD CONSTRAINT `user_FK` FOREIGN KEY (`cityId`) REFERENCES `cityTable`(`id`);

