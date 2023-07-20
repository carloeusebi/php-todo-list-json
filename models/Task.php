<?php

class Task
{
    const FILE_PATH = __DIR__ . '/../db/tasks.json';

    protected array $tasks = [];

    public function connect(): bool
    {
        if (!file_exists(self::FILE_PATH)) return false;
        $this->tasks = json_decode(file_get_contents(self::FILE_PATH)) ?? [];
        return true;
    }

    public function get(): array|null
    {
        return $this->tasks;
    }

    public function update(array $data): array|null
    {
        $task_to_update = array_search($data['id'], array_column($this->tasks, 'id'));

        var_dump($task_to_update);
        die();
    }
}
