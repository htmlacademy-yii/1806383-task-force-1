<?php


namespace DataBaseUtils\createTables;


use DataBaseUtils\DataBaseControl;

class CategoryTable extends DataBaseControl
{
    protected $query = "CREATE TABLE `category` (
                    `id` int PRIMARY KEY AUTO_INCREMENT,
                    `categoriesRU` varchar(255),
                    `categoriesENG` varchar(255)
                    )";
    protected $query2 = "CREATE TABLE `userCategory` (
                    `userId` INT NOT NULL,
                    `categoryId` INT NOT NULL,
                    CONSTRAINT `userCategory_PK` PRIMARY KEY (`userId`,`categoryId`)
                     )";

    protected function createTable():void
    {
        $this->PDOquery($this->query);

        $this->PDOquery($this->query2);
    }
}
