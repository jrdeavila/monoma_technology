<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Src\BoundedContext\User\Infrastructure\LoginUserController;

class AuthController extends Controller
{

    public function __invoke(LoginRequest $request, LoginUserController $controller)
    {
        $token = $controller->__invoke($request);
        return new LoginResource($token);
    }
}
