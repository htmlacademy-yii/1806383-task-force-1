<?php


namespace DataBaseUtils\fillTables;


class RepliesFill extends OpinionsFill
{
    use CompositeString;

    protected string $query = "INSERT INTO comment (time,rate,comment,userId,taskId)
                VALUES (?,?,?,?,?)";

    protected string $regular = "#[0-9]+-#";

    public function fillTable(): void
    {

        while (!$this->file->eof()) {

            $parsedString = $this->stringParser($this->regular, $this->file);

            if ($parsedString) {

                $uid=rand(1,20);
                $tid=rand(1,9);

                $execute = array_merge($this->compositeStringToArray($parsedString), array($uid, $tid));
                $this->PDOQuery($this->query, $execute);
            }
        }
    }

}
