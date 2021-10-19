<?php

use Service\AbortAction;
use Service\CompleteAction;
use Service\FailAction;
use Service\ResponseAction;
use Service\Task;
use Exceptions\WrongStatusException;
use Exceptions\NotFoundException;

require_once("vendor/autoload.php");

// настройка assert
assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_CALLBACK, 'assertMessage');

$clientId = 1;
$workerId = 2;

$task = new Task($clientId, $workerId);
try {
    $task->addAction(new CompleteAction());
    $task->addAction(new FailAction());
    $task->addAction(new AbortAction());
    $task->addAction(new ResponseAction());
} catch (NotFoundException $e) {
    error_log("Class not found " . $e->getMessage());
}

$currentUserId = 2;
try {
    $task->setStatus(Task::STATUS_NEW);
    $actions = $task->actions($currentUserId);
} catch (WrongStatusException $e) {
    error_log("Unawailable status! " . $e->getMessage());
}
$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof ResponseAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$currentUserId = 1;

try {
    $actions = $task->actions($currentUserId);
} catch (NotFoundException $e) {
    error_log("Unknown user! " . $e->getMessage());
}

$count = count($actions);

assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof AbortAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

try {
    $task->setStatus(Task::STATUS_IN_WORK);
} catch (WrongStatusException $e) {
    error_log("Unawailable status! " . $e->getMessage());
}

$currentUserId = 2;
try {
    $actions = $task->actions($currentUserId);
} catch (NotFoundException $e) {
    error_log("Unknown user! " . $e->getMessage());
}

$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof FailAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

$currentUserId = 1;

try {
    $actions = $task->actions($currentUserId);
} catch (NotFoundException $e) {
    error_log("Unknown user! " . $e->getMessage());
}

$count = count($actions);

assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof CompleteAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

try {
    $task->setStatus(Task::STATUS_FAILED);
} catch (WrongStatusException $e) {
    error_log("Unawailable status! " . $e->getMessage());
}

$currentUserId = 2;
try {
    $actions = $task->actions($currentUserId);
} catch (NotFoundException $e) {
    error_log("Unknown user! " . $e->getMessage());
}
$count = count($actions);
assert($count == 1, 'Wrong task actions number. Expected 1, got "' . count($actions) . '"');

$action = array_shift($actions);
assert($action instanceof ResponseAction, 'Wrong task actions type. Expected `AbortAction`, got "' . get_class($action) . '"');

//$task->setStatus(Task::STATUS_COMPLETED);
//assert($task->getStatus()!=Task::STATUS_COMPLETED,'Status "completed" not allowed to failed tasks');

try {
    $task->setStatus(Task::STATUS_COMPLETED);
} catch (WrongStatusException $e) {
    error_log("Unawailable status! " . $e->getMessage());
}

$currentUserId = 2;
try {
    $actions = $task->actions($currentUserId);
} catch (NotFoundException $e) {
    error_log("Unknown user! " . $e->getMessage());
}
assert(empty($actions), 'Wrong task actions number. Expected 0, got more');

try {
    $tablesCreate = new \DataBaseUtils\createTables\FinalTableCreate();
    $fillTables = new \DataBaseUtils\fillTables\FinalFill();
    $tablesCreate->createTables();
    $fillTables->fillTables();
} catch (NotFoundException $e) {
    error_log("file not found!" . $e->getMessage());
}

