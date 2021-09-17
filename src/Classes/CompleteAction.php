<?php


namespace Service;


class CompleteAction extends Actions
{
    const INNER_NAME = "Complete";
    const READABLE_NAME  = "Завершить задание";

    /**
     * @param int $clientId
     * @param int $workerId
     * @param int $userId
     * @return bool
     */
    public function rightsCheck(int $clientId, int $workerId, int $userId):bool
    {
        return $workerId && $clientId == $userId;
    }

    /**
     * @return string
     */
    public function getInnerName():string
    {
        return self::INNER_NAME;
    }

    /**
     * @return string
     */
    public function getReadableName():string
    {
        return self::READABLE_NAME ;
    }
}
