<?php

namespace Src\BoundedContext\User\Application;

use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;

class UpdateUserUseCase
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(UserId $id, User $user)
    {
        $this->repository->update($id, $user);
    }
}
