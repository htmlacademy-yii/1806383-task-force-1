<?php


namespace DataBaseUtils;


use PDO;

class DataBaseControl
{
    const HOST = "localhost";
    const TYPE = "mysql";
    const DATA_BASE = "keksBase";
    const PASSWORD = "root";
    const LOGIN = "root";
    const CHAR = "utf8";
    const OPTIONS = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(self::TYPE . ":host=" . self::HOST . ";dbname=" . self::DATA_BASE . ";charset=" . self::CHAR, self::LOGIN, self::PASSWORD, self::OPTIONS);
    }

    protected function isTableExist(string $tableName): bool
    {   //сли есть таблица-вернет true
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE ?");
        $stmt->execute(array($tableName));
        $result=$stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    protected function PDOQuery(string $query,array $execute=[]):void
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($execute);
    }

    protected function createTable():void
    {
        $this->PDOQuery($this->query);
    }
}
