<?php


namespace DataBaseUtils\fillTables;


class ProfilesFill extends \DataBaseUtils\CsvToSQLConverter
{
    use CompositeString;
    protected string $query = "UPDATE user SET about=?,age=?,adress=?,phone=?,skype=? WHERE id=?";
    protected string $regular = "#[0-9]+ [a-zA-Z]+#";

    protected function fillTable(): void
    {
        $id=1;

        while (!$this->file->eof()) {

            $parsedString = $this->stringParser($this->regular, $this->file);

            if ($parsedString) {
                $execute=array_merge($this->compositeStringToArray($parsedString),array($id));
                $this->PDOQuery($this->query, $execute);
                $id++;
            }
        }
    }

}
