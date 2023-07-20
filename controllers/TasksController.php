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
        $errors = [];
        $data = $this->request->getBody();

        if (empty($data)) {
            $this->response->response(400, ['error' => 'No body sent']);
        }

        if (isset($data['id'])) $errors = $this->task->update($data);
        else $errors = $this->task->create($data);


        if (empty($errors)) {
            $new_task = $this->task->getLastInsertedTask();
            $this->response->response(201, $new_task);
        }

        $this->response->response(400, $errors);
    }

    public function delete()
    {
        $errors = [];
        $data = $this->request->getBody();

        $id = $data['id'] ?? null;

        if (!$id) {
            $this->response->response(400, ['error' => 'No ID provided']);
        }

        $errors = $this->task->delete($id);

        if ($errors) {
            $this->response->response(404, $errors);
        }

        $this->response->response(203);
    }
}
