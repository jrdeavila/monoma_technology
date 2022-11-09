<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Infrastructure;

use App\Exceptions\PasswordIncorrectException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User as MongoUser;
use Illuminate\Support\Facades\Hash;

final class LoginUserController
{

    public function __invoke(LoginRequest $request)
    {
        $user = MongoUser::where("username", $request->username)->firstOrFail();
        if (Hash::check($request->password, $user->password)) {
            return new LoginResource($user);
        }
        throw new PasswordIncorrectException($user->username);
    }
}
