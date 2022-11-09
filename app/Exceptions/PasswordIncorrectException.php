<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class PasswordIncorrectException extends ApplicationException
{

    private $username;
    public function __construct(string $username)
    {
        $this->username = $username;
    }
    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }

    public function error(): string| array
    {
        return [
            "Password incorrect for: $this->username",
        ];
    }
}
