<?php

class Task
{
    const FILE_PATH = __DIR__ . '/../db/tasks.json';

    protected array $tasks = [];
    protected array $last_inserted_task = [];

    public function connect(): bool
    {
        if (!file_exists(self::FILE_PATH)) return false;
        $this->tasks = json_decode(file_get_contents(self::FILE_PATH), true) ?? [];
        return true;
    }

    public function get(): array|null
    {
        foreach ($this->tasks as &$task) {
            $task['completed'] = $task['completed'] ? true : false;
        }
        return $this->tasks;
    }

    public function update(array $data): array
    {
        $errors = [];

        foreach ($this->tasks as &$task) {
            if ($task['id'] == $data['id']) {
                $task['completed'] = $data['completed'] ?? $task['completed'];
                $task['task'] = $data['task'] ?? $task['task'];
                $this->last_inserted_task = $task;
            }
        }
        self::writeOnFile();

        return $errors;
    }


    public function create(array $data): array
    {
        $errors = [];

        if (!$data['task']) $errors['no-task-name'] = 'No task name was given';

        if (empty($errors)) {

            $new_id = $this->generateNewId();
            $new_task = [
                'id' => $new_id,
                'task' => $data['task'],
                'completed' => $data['completed'] ?? 0
            ];

            $this->tasks[] = $new_task;
            $this->last_inserted_task = $new_task;
        }
        self::writeOnFile();

        return $errors;
    }


    public function delete(int $id): array
    {
        $errors = [];

        $filtered_tasks = array_filter($this->tasks, fn ($task) => $task['id'] != $id);

        if (count($this->tasks) === count($filtered_tasks)) $errors['no-item-deleted'] = 'No items deleted';

        $this->tasks = $filtered_tasks;

        self::writeOnFile();

        return $errors;
    }


    protected function writeOnFile()
    {
        file_put_contents(self::FILE_PATH, json_encode($this->tasks));
    }


    public function getLastInsertedTask(): array
    {
        return $this->last_inserted_task;
    }


    protected function generateNewId(): int
    {
        return array_reduce($this->tasks, fn ($highest, $task) => $highest < $task['id'] ? $task['id'] : $highest, 0) + 1;
    }
}
