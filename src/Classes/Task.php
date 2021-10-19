<?php

namespace Service;

use Exceptions\WrongStatusException;
use Exceptions\NotFoundException;


class Task
{
    /**
     * @var array
     */
    public $actions = [];

//Возможные статусы


    const STATUS_NEW = "New";


    const STATUS_ABORTED = "Aborted";


    const STATUS_IN_WORK = "In work";


    const STATUS_COMPLETED = "Completed";


    const STATUS_FAILED = "Failed";

//Возможные действия


    const ACTION_WRONG = "Wrong Action!";

//свойства-идентификаторы

    /**
     * @var int
     */
    /**
     * @var int
     */
    private $clientId, $workerId;

    /**
     * @var string
     */
    private $status = self::STATUS_NEW;

    /**
     * @var string[]
     */
    private $statusMap = [
        self::STATUS_NEW => "Новая",
        self::STATUS_ABORTED => "Отменена",
        self::STATUS_IN_WORK => "В работе",
        self::STATUS_COMPLETED => "Выполнено",
        self::STATUS_FAILED => "Не выполнено"
    ];

    /**
     * @var array
     */
    private $actionMap = [
        AbortAction::INNER_NAME => AbortAction::READABLE_NAME,
        ResponseAction::INNER_NAME => ResponseAction::READABLE_NAME,
        CompleteAction::INNER_NAME => CompleteAction::READABLE_NAME,
        FailAction::INNER_NAME => FailAction::READABLE_NAME
    ];

    /**
     * Task constructor.
     * @param int $clientId
     * @param int $workerId
     */
    public function __construct(int $clientId, int $workerId)
    {
        $this->clientId = $clientId;
        $this->workerId = $workerId;
    }


    /**
     * @param Actions $action
     */
    public function addAction(Actions $action): void
    {
        if($action->getInnerName()){
            $this->actions[$action->getInnerName()] = $action;
        }else{
            throw new NotFoundException("Class not found");
        }

    }

    /**
     * Get next task status if the passed action is applied
     *
     * @param Actions $action
     * @return string status identifier
     */

    public function nextStatus(Actions $action): ?string
    {
        $statusSwitch = [
            CompleteAction::INNER_NAME => self::STATUS_COMPLETED,
            FailAction::INNER_NAME => self::STATUS_FAILED,
            AbortAction::INNER_NAME => self::STATUS_ABORTED,
            ResponseAction::INNER_NAME => self::STATUS_IN_WORK
        ];
        return $statusSwitch[$action->getInnerName()] ?? null;
    }

    /**
     * @return array
     */
    public function getActionMap(): array
    {
        return $this->actionMap;

    }

    /**
     * @return string[]
     */
    public function getStatusMap(): array
    {
        return $this->statusMap;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $newStatus
     * @throws \Exception
     */
    public function setStatus(string $newStatus): void
    { //throw new WrongStatusException('Trying to set wrong status');

        if (!in_array($newStatus, array_keys($this->statusMap))) {
            throw new WrongStatusException('Trying to set wrong status');
        }
        $this->status = $newStatus;
    }

    /**
     * Get actions list for current task status
     *
     * @param int $userId current user id
     * @return array
     */

    public function actions(int $userId): ?array//метод который возвращает доступные действия
    {
        if(!($userId==$this->clientId)){
            throw new NotFoundException("User not found");
        }
        $result = [];
        switch ($this->status) {

            case self::STATUS_NEW:
                if ($this->actions[AbortAction::INNER_NAME]->rightsCheck($this->clientId, $this->workerId, $userId)) {
                    $result[] = $this->actions[AbortAction::INNER_NAME];
                }

                if ($this->actions[ResponseAction::INNER_NAME]->rightsCheck($this->clientId, $this->workerId, $userId)) {
                    $result[] = $this->actions[ResponseAction::INNER_NAME];
                }

                break;

            case self::STATUS_IN_WORK:
                if ($this->actions[FailAction::INNER_NAME]->rightsCheck($this->clientId, $this->workerId, $userId)) {
                    $result[] = $this->actions[FailAction::INNER_NAME];
                }

                if ($this->actions[CompleteAction::INNER_NAME]->rightsCheck($this->clientId, $this->workerId, $userId)) {
                    $result[] = $this->actions[CompleteAction::INNER_NAME];
                }

                break;

            case self::STATUS_FAILED:
                if ($this->actions[ResponseAction::INNER_NAME]->rightsCheck($this->clientId, $this->workerId, $userId)) {
                    $result[] = $this->actions[ResponseAction::INNER_NAME];
                    $this->workerId = null;
                }

                break;

            case self::STATUS_ABORTED || self::STATUS_COMPLETED:
                $result = null;

                break;

        }
        return $result;
    }
}
