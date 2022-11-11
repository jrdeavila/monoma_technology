<?php

namespace Src\BoundedContext\User\Infrastructure\Repository;


use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use Src\Shared\Models\MongoUser;
use Src\BoundedContext\User\Domain\User;
use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserIsActive;
use Src\BoundedContext\User\Domain\ValueObjects\UserLastLogin;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\BoundedContext\User\Domain\ValueObjects\UserPassword;
use Src\BoundedContext\User\Domain\ValueObjects\UserRole;

class MongoUserRepository implements UserRepositoryContract
{
    private MongoUser $model;

    public function __construct()
    {
        $this->model = new MongoUser;
    }

    private function mapToUser(MongoUser $model): User
    {
        $user = new User(
            new UserName($model->username),
            new UserPassword($model->password),
            new UserRole($model->role),
            new UserLastLogin($model->last_login ? new \DateTime($model->last_login) : null),
            new UserIsActive($model->is_active)
        );
        $user->setId(new UserId($model->_id));
        return $user;
    }

    private function toModel(User $user): MongoUser
    {
        $model = MongoUser::createByDomainModel($user);
        return $model;
    }

    public function findById(UserId $id): ?User
    {
        $model = $this->model->findOrFail($id->value());
        return $this->mapToUser($model);
    }


    public function findByCredentials(UserName $username): ?User
    {
        $model = $this->model->where("username", "=", $username->value())->firstOrFail();
        return $this->mapToUser($model);
    }
    public function save(User $user): void
    {
        $model = $this->toModel($user);
        $model->save();
    }

    public function update(UserId $id, User $user): void
    {
        ($this->model->findOrFail($id->value()))->update($user->toArray());
    }

    public function delete(UserId $id): void
    {
        $this->model->findOrFail($id->value())->delete();
    }
}
