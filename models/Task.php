<?php

class Task
{
    const FILE_PATH = __DIR__ . '/../db/tasks.json';

    protected int $id;
    protected string $task;
    protected bool $completed;

    protected $file;

    public function get()
    {
        return json_decode(file_get_contents(self::FILE_PATH));
    }
}
