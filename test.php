<?php

use Service\AbortAction;
use Service\CompleteAction;
use Service\FailAction;
use Service\ResponseAction;
use Service\Task;

require_once("vendor/autoload.php");

// настройка assert
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_CALLBACK, 'assertMessage');

$clientId = 1;
$workerId = 2;

$task = new Task($clientId, $workerId);
$task->addAction(new CompleteAction());
$task->addAction(new FailAction());
$task->addAction(new AbortAction());
$task->addAction(new ResponseAction());

$currentUserId = 2;
$task->setStatus(Task::STATUS_NEW);
$actions = $task->actions($currentUserId);

$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof ResponseAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$currentUserId = 1;

$actions = $task->actions($currentUserId);

$count = count($actions);

assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof AbortAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$task->setStatus(Task::STATUS_IN_WORK);

$currentUserId = 2;
$actions = $task->actions($currentUserId);

$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof FailAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$currentUserId = 1;

$actions = $task->actions($currentUserId);

$count = count($actions);

assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof CompleteAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$task->setStatus(Task::STATUS_FAILED);

$currentUserId = 2;
$actions = $task->actions($currentUserId);
$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof ResponseAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

//$task->setStatus(Task::STATUS_COMPLETED);
//assert($task->getStatus()!=Task::STATUS_COMPLETED,'Status "completed" not allowed to failed tasks');

$task->setStatus(Task::STATUS_COMPLETED);

$currentUserId = 2;
$actions = $task->actions($currentUserId);
echo $actions;
assert(is_null($actions), 'Wrong task actions number. Expected 0, got more');
