<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ResourceNotFoundException extends ApplicationException
{
    public function status(): int
    {
        return Response::HTTP_NOT_FOUND;
    }

    public function error(): string| array
    {
        return [
            'Resource not found'
        ];
    }
}
