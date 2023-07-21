<?php

require_once __DIR__ . '/../models/Task.php';

class TasksController
{
    protected Task $task;

    public function __construct()
    {
        $this->task = new Task();
        $result = $this->task->connect();
        if (!$result) {
            Response::response(500, ['error' => 'Cannot connect to database']);
        }
    }

    public function get()
    {
        $tasks = $this->task->get();
        if (!$tasks) {
            Response::response(404, ['error' => 'No Tasks found']);
        }
        Response::response(200, $tasks);
    }

    public function save()
    {
        $errors = [];
        $data = Request::getBody();

        if (empty($data)) {
            Response::response(400, ['error' => 'No body sent']);
        }

        if (isset($data['id'])) $errors = $this->task->update($data);
        else $errors = $this->task->create($data);


        if (empty($errors)) {
            $new_task = $this->task->getLastInsertedTask();
            Response::response(201, $new_task);
        }

        Response::response(400, $errors);
    }

    public function delete()
    {
        $errors = [];
        $data = Request::getBody();

        $id = $data['id'] ?? null;

        if (!$id) {
            Response::response(400, ['error' => 'No ID provided']);
        }

        $errors = $this->task->delete($id);

        if ($errors) {
            Response::response(404, $errors);
        }

        Response::response(203);
    }
}
