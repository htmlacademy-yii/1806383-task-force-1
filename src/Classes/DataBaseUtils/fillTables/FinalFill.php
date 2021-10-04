<?php


namespace DataBaseUtils\fillTables;


class FinalFill extends \DataBaseUtils\CsvToSQLConverter
{
    protected $fill;

    public function __construct()
    {
        $this->fill = [
            "Users" => "users",
            "Category" => "categories",
            "Task" => "tasks",
            "Opinions" => "opinions",
            "Replies" => "replies",
            "Profiles" => "profiles",
            "City" => "cities"
        ];
    }

    public function fillTables()
    {

        foreach ($this->fill as $key => $value) {

            $baseName = __NAMESPACE__ . '\\' . $key . "Fill";
            $execute = new $baseName($value);
            $execute->fillTable();
        }
    }
}
