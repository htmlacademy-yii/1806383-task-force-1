<?php


namespace DataBaseUtils\fillTables;


class CategoryFill extends \DataBaseUtils\CsvToSQLConverter
{
    protected string $query = "INSERT INTO category (categoriesRU,categoriesENG)
                VALUES (?,?)";
    protected string $regular = "#[а-яА-ЯёЁ \-]+#";

}
