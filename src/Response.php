<?php

declare(strict_types=1);

namespace App;


class Response
{
    public const HTTP_OK = 200;

    public const HTTP_BAD_REQUEST = 404;

    public function send(array $content, int $status = self::HTTP_OK): void
    {
        http_response_code($status);
        echo json_encode($content);
    }
}
