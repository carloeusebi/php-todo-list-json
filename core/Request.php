<?php

class Request
{
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getBody(): array|null
    {
        $data = [];

        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $data[$key] = $value;
            }
        } elseif ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}
