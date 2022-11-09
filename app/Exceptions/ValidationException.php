<?php

namespace App\Exceptions;

use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class ValidationException extends ApplicationException
{
    private Validator $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function status(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function error(): string| array
    {
        return (array)json_decode($this->validator->errors());
    }
}
