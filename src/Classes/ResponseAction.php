<?php


namespace Service;


class ResponseAction extends Actions
{
    const INNER_NAME = "Response";
    const READABLE_NAME = "Откликнуться";

    /**
     * @param int $clientId
     * @param int $workerId
     * @param int $userId
     * @return bool
     */
    public function rightsCheck(int $clientId, int $workerId, int $userId):bool
    {
        return $clientId!=$userId;
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
        return self::READABLE_NAME;
    }
}
