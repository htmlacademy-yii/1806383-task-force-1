<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class EvaluationsTable extends DataBaseControl
{
    protected $query="CREATE TABLE `evaluations` (
                `id` int PRIMARY KEY AUTO_INCREMENT,
                `date` DATE NOT NULL,
                `rate` decimal,
                `isTaskComplete` int ,
                `failedTask` int ,
                `comment` text,
                `userId` int
                )";

}
