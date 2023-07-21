<?php

class Request
{
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function isGet(): bool
    {
        return self::getMethod() === 'get';
    }

    public static function isPost(): bool
    {
        return self::getMethod() === 'post';
    }

    public static function isDelete(): bool
    {
        return self::getMethod() === 'delete';
    }

    public static function getBody(): array|null
    {
        $data = [];

        if (self::isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = $value;
            }
        } elseif (self::isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }

        if (!$data) {
            $data = (array) json_decode(file_get_contents("php://input"));
        }

        return $data;
    }
}
