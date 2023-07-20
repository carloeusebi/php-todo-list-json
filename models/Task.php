<?php

class Task
{
    const FILE_PATH = __DIR__ . '/../db/tasks.json';

    protected array $tasks = [];

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
        $updated_task = [];

        foreach ($this->tasks as &$task) {
            if ($task['id'] == $data['id']) {
                $task['completed'] = $data['completed'] ?? $task['completed'];
                $task['task'] = $data['task'] ?? $task['task'];
                $updated_task = $task;
            }
        }

        file_put_contents(self::FILE_PATH, json_encode($this->tasks));

        return $updated_task;
    }
}
