<?php


namespace DataBaseUtils;


use Exceptions\NotFoundException;
use SplFileObject;

/**
 * Class CsvToSQLConverter
 * @package DataBaseUtils
 */
class CsvToSQLConverter extends DataBaseControl
{
    /**
     * @var SplFileObject
     */
    protected $file;

    /**
     * @throws NotFoundException
     */
    public function __construct(string $fileName)
    {
        parent::__construct();
        $this->file = new SplFileObject($_SERVER['DOCUMENT_ROOT'] . "/1806383-task-force-1/data/" . $fileName . ".csv");
        if($this->file->current()==""){
            throw new NotFoundException("File not found!");
        }
    }

    /**
     * @return SplFileObject
     */
    public function getFile(): SplFileObject
    {
        return $this->file;
    }

    /**
     *
     */
    public function getLines(): void
    {
        while (!$this->file->eof()) {
            echo $this->file->current()."</br>";
            $this->file->next();
        }
    }

    protected function fillTable(): void
    {


        while (!$this->file->eof()) {
            if ($this->checkRegular()) {
                $rows = explode(",", $this->file->current());
                $this->PDOQuery($this->query, $rows);
                $this->file->next();

            }
        }
    }

    /**
     * @return bool
     */
    protected function checkRegular(): bool
    {
        while (!preg_match($this->regular, $this->file->current())) {
            if ($this->file->eof()) {
                return false;
            } else {
                $this->file->next();
            }
        }
        return true;
    }


}
