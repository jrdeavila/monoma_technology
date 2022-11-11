<?php

namespace Src\BoundedContext\User\Application;

use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserIsActive;
use Src\BoundedContext\User\Domain\ValueObjects\UserLastLogin;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\BoundedContext\User\Domain\ValueObjects\UserPassword;
use Src\BoundedContext\User\Domain\ValueObjects\UserRole;

class CreateUserUseCase
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $username, string $password, string $role)
    {
        $user = User::create(
            new UserName($username),
            new UserPassword($password),
            new UserRole($role),
            new UserIsActive(true),
            new UserLastLogin(null),
        );
        $this->repository->save($user);
    }
}
