<?php


namespace DataBaseUtils\fillTables;


class OpinionsFill extends \DataBaseUtils\CsvToSQLConverter
{
    use CompositeString;

    protected string $query = "INSERT INTO evaluations (date,rate,comment,isTaskComplete,failedTask,userId)
                VALUES (?,?,?,?,?,?)";
    protected string $regular = "#[0-9]+-#";

    public function fillTable(): void
    {

        while (!$this->file->eof()) {

            $parsedString = $this->stringParser($this->regular, $this->file);

            if ($parsedString) {

                $randomIsTaskComplete = rand(0, 1);
                $randomFailedTask = rand(0, 10);
                $rid = rand(1, 20);

                $execute = array_merge($this->compositeStringToArray($parsedString), array($randomIsTaskComplete, $randomFailedTask, $rid));
                $this->PDOQuery($this->query, $execute);
            }
        }
    }
}
