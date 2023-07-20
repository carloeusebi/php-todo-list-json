<?php

require_once __DIR__ . '/../controllers/TasksController.php';
require_once __DIR__ . '/../core/Request.php';
require_once __DIR__ . '/../core/Response.php';

$request = new Request();
$response = new Response();
$controller = new TasksController($request, $response);

$method = $request->getMethod();


if ($method === 'get') {
    $controller->get();
} elseif ($method === 'post') {
    $controller->save();
}
