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
        $result = $this->task->connect();
        if (!$result) {
            $this->response->response(500, ['error' => 'Cannot connect to database']);
        }
    }

    public function get()
    {
        $tasks = $this->task->get();
        if (!$tasks) {
            $this->response->response(404, ['error' => 'No Tasks found']);
        }
        $this->response->response(200, $tasks);
    }

    public function save()
    {
        $data = $this->request->getBody();
        $errors = [];

        var_dump($data);
        die();

        if ($data['id'])
            $errors = $this->task->update($data);
        // else $errors = $this->task->create($data);
    }
}
