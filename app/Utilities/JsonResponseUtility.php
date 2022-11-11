<?php

namespace App\Utilities;

abstract class JsonResponseUtility
{

    public static function response(array $data)
    {
        return [
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data' => $data,
        ];
    }
}
