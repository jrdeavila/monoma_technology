<?php

namespace Src\BoundedContext\User\Application;

use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\BoundedContext\User\Domain\ValueObjects\UserPassword;
use Src\BoundedContext\User\Domain\ValueObjects\UserRole;

final class GetUserByCredentialUseCase
{

    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $username): ?User
    {
        $userName  = new UserName($username);
        $user = $this->repository->findByCredentials($userName);
        return $user;
    }
}
