<?php


namespace DataBaseUtils\fillTables;


class UsersFill extends \DataBaseUtils\CsvToSQLConverter
{
    protected string $query = "INSERT INTO  user (email,fullName,password,createdAt,cityId,categoryId)
                VALUES (?,?,?,?,?,?)";
    protected string $regular = "#[a-zA-Z0-9]+@#";

    public function fillTable(): void
    {
        $this->PDOQuery("SET foreign_key_checks = 0");


        while (!$this->file->eof()) {

            if ($this->checkRegular()) {

                $rows = explode(",", $this->file->current());
                $rows=array_merge($rows,array(rand(1, 1000),rand(0, 4)));
                $this->PDOQuery($this->query, $rows);
                $this->file->next();

            }
        }
        $this->PDOQuery("SET foreign_key_checks = 1");
    }

}
