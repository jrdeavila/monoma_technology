<?php

namespace App\Exceptions;

use Exception;

abstract class ApplicationException extends Exception
{
    abstract public function status(): int;
    abstract public function error(): string|array;

    public function render()
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => $this->error()
            ]
        ], $this->status());
    }
}
