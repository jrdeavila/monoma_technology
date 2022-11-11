<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Infrastructure;

use App\Exceptions\PasswordIncorrectException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use Src\BoundedContext\User\Application\UpdateUserUseCase;
use Src\BoundedContext\User\Infrastructure\Repository\MongoUserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

final class LoginUserController
{
    private MongoUserRepository $repository;

    public function __construct(MongoUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LoginRequest $request): string
    {
        if ($token = JWTAuth::attempt($request->all())) {
            $user = JWTAuth::user();
            $uc = new UpdateUserUseCase($this->repository);
            $uc->__invoke(
                $user->_id,
                $user->username,
                $user->password,
                $user->role,
                $user->is_active,
                new \DateTime('now')
            );
            return $token;
        }
        throw new PasswordIncorrectException($request->get('username'));
    }
}
