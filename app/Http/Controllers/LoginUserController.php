<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginUserController extends Controller
{
    private  $controller;

    public function __construct(\Src\BoundedContext\User\Infrastructure\LoginUserController $controller)
    {
        $this->controller = $controller;
    }


    public function __invoke(LoginRequest $request)
    {
        return $this->controller->__invoke($request);
    }
}
