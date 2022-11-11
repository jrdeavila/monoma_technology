<?php


namespace App\Exceptions;

use Illuminate\Http\Response;

class LeadOwnerException extends ApplicationException
{

    public function status(): int
    {
        return Response::HTTP_FORBIDDEN;
    }

    public function error(): string| array
    {
        return [
            'User is not owner of this lead'
        ];
    }
}
