<?php


namespace DataBaseUtils\fillTables;


class TaskFill extends \DataBaseUtils\CsvToSQLConverter
{
    use CompositeString;

    protected string $query = "INSERT INTO task (clientId,workerId,createdAt,categoryId,description,term,title,adress,price,latitude,longitude)
                VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    protected string $regular = "#[0-9]+-[0-9]+-[0-9]+,[0-9]+,\"#";

    public function fillTable(): void
    {

        while ($this->file->valid()) {

            $parsedString = $this->stringParser($this->regular, $this->file);
            if ($parsedString) {
                $randClientId=rand(1,20);
                $randWorkerId=rand(1,20);
                $execute=array_merge(array($randClientId,$randWorkerId),$this->compositeStringToArray($parsedString));
                $this->PDOQuery($this->query,$execute );
            }

        }
    }
}
