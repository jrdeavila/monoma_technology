<?php

namespace Src\BoundedContext\User\Domain\Contract;

use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;

interface UserRepositoryContract
{
    public function findById(UserId $id): ?User;
    public function findByCredentials(UserName $username): ?User;
    public function save(User $manager): void;
    public function update(UserId $id, User $manager): void;
    public function delete(UserId $id): void;
}
