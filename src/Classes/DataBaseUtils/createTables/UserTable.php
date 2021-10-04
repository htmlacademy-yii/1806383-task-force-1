<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;


class UserTable extends DataBaseControl
{
    protected $query="CREATE TABLE `user` (
                    `id` int PRIMARY KEY AUTO_INCREMENT,
                    `fullName` varchar(255),
                    `password` varchar(255),
                    `createdAt` timestamp,
                    `about` varchar(255),
                    `age` date,
                    `cityId` int,
                    `adress` varchar(255),
                    `phone` bigint,
                    `skype` char(255),
                    `email` char(255),
                    `categoryId` int
                    )";

}
