<?php


namespace DataBaseUtils\fillTables;


class CityFill extends \DataBaseUtils\CsvToSQLConverter
{
    protected string $query = "INSERT INTO city (city,coordinatesLatitude,coordinatesLongitude)
                VALUES (?,?,?)";
    protected string $regular = "#[a-zA-Zа-яА-ЯёЁ \-]+,[0-9]+\.[0-9]+,[0-9]+\.[0-9]+#u";

    protected function fillTable(): void
    {
        set_time_limit(120);
        parent::fillTable();
    }

}
