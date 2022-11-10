<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Infrastructure;

use App\Exceptions\PasswordIncorrectException;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResource;
use App\Models\User as MongoUser;
use Illuminate\Support\Facades\Hash;
use Src\BoundedContext\User\Application\GetUserByCredentialUseCase;
use Src\BoundedContext\User\Infrastructure\Jobs\UpdateUser;
use Src\BoundedContext\User\Infrastructure\Repository\MongoUserRepository;

final class LoginUserController
{
    private MongoUserRepository $repository;

    public function __construct(MongoUserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(LoginRequest $request)
    {
        $getUser = new GetUserByCredentialUseCase($this->repository);
        $user = $getUser->__invoke($request->username);
        if (Hash::check($request->password, $user->getPassword()->value())) {
            UpdateUser::dispatch($user, $this->repository);
            $model = MongoUser::createByDomainModel($user);
            return new LoginResource($model);
        }
        throw new PasswordIncorrectException($user->getUserName()->value());
    }
}
