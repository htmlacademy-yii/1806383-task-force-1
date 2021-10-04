<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class CityTable extends DataBaseControl
{
    protected $query = "CREATE TABLE `city` (
                    `id` int PRIMARY KEY AUTO_INCREMENT,
                    `city` varchar(255),
                    `coordinatesLatitude` decimal(10,8) DEFAULT NULL,
                    `coordinatesLongitude` decimal(11,8) DEFAULT NULL
                    )";

}
