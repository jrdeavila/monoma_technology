<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class AgentUnauthorizedException extends ApplicationException
{


    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }

    public function error(): string| array
    {
        return [
            'You cannot create or update leads'
        ];
    }
}
