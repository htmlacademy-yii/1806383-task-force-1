<?php


namespace Service;


class AbortAction extends Actions
{
    const INNER_NAME = "Abort";
    const READABLE_NAME  = "Отменить";

    /**
     * @param int $clientId
     * @param int $workerId
     * @param int $userId
     * @return bool
     */
    public function rightsCheck(int $clientId, int $workerId, int $userId):bool
    {
        return $clientId == $userId;
    }

    /**
     * @return string
     */
    public function getInnerName() :string
    {
        return self::INNER_NAME;
    }

    /**
     * @return string
     */
    public function getReadableName():string
    {
        return self::READABLE_NAME;
    }
}
