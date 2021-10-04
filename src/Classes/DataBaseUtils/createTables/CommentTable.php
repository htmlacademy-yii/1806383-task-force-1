<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class CommentTable extends DataBaseControl
{
    protected $query="CREATE TABLE `comment` (
                    `id` int PRIMARY KEY AUTO_INCREMENT,
                    `comment` text,
                    `time` timestamp,
                    `rate` int,
                    `userId` int,
                    `taskId` int
                    )";

}
