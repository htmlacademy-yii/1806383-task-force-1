<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class TaskTable extends DataBaseControl
{
    protected $query="CREATE TABLE `task` (
                `id` int PRIMARY KEY AUTO_INCREMENT,
                `clientId` int,
                `workerId` int,
                `categoryId` int,
                `title` varchar(255),
                `adress` varchar(255),
                `createdAt` date,
                `description` text,
                `price` int,
                `term` date,
                `latitude` decimal(10,8) DEFAULT NULL,
                `longitude` decimal(11,8) DEFAULT NULL
                )";
}
