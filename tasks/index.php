<?php

require_once __DIR__ . '/../controllers/TasksController.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Response.php';

$controller = new TasksController();

if (Request::isGet()) {
    $controller->get();
} elseif (Request::isPost()) {
    $controller->save();
} elseif (Request::isDelete()) {
    $controller->delete();
} else {
    Response::response(405);
}
