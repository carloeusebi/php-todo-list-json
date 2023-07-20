<?php

class Task
{
    const FILE_PATH = __DIR__ . '/../db/tasks.json';

    protected int $id;
    protected string $task;
    protected bool $completed;

    public function connect(): bool
    {
        return file_exists(self::FILE_PATH);
    }

    public function get(): array
    {
        return json_decode(file_get_contents(self::FILE_PATH));
    }
}
