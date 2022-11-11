<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class TokenNotFoundException extends ApplicationException
{


    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }

    public function error(): string| array
    {
        return [
            'Token Not Found'
        ];
    }
}
