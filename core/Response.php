<?php

class Response
{
    public static function response(int $http_code, array $content = [])
    {
        http_response_code($http_code);
        if ($content) {
            header('Content-Type: application/json');
            echo json_encode($content);
        }
        die();
    }
}
