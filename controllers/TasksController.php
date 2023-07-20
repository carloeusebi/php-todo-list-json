<?php

require_once __DIR__ . '/../models/Task.php';

class TasksController
{
    protected Request $request;
    protected Response $response;
    protected Task $task;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->task = new Task();
    }

    public function get()
    {
        $tasks = $this->task->get();
        if ($tasks) {
            $this->response->response(200, $tasks);
        }

        $this->response->response(404);
    }
}
