<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class IncludeTable extends DataBaseControl
{
    protected $query="CREATE TABLE `include` (
                    `id` int PRIMARY KEY AUTO_INCREMENT,
                    `attachment` MEDIUMBLOB
                    )";

}
