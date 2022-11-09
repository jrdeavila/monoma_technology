<?php

namespace Src\BoundedContext\User\Infrastructure\Repository;

use Src\BoundedContext\User\Domain\Contract\UserRepositoryContract;
use App\Models\User as MongoUser;
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
        return new User(
            new UserId($model->ref),
            new UserName($model->username),
            new UserPassword($model->password),
            new UserRole($model->role),
            new UserLastLogin($model->last_login),
            new UserIsActive($model->is_active)
        );
    }

    public function findById(UserId $id): ?User

    {
        $model = $this->model->where('ref', '=', $id->value())->firstOrFail();
        return $this->mapToUser($model);
    }


    public function findByCredentials(UserName $username): ?User
    {
        $model = $this->model->where("username", "=", $username->value())->firstOrFail();
        return $this->mapToUser($model);
    }
    public function save(User $user): void
    {
        $this->model->save($user->toArray());
    }

    public function update(UserId $id, User $user): void
    {
        $data = [
            'username' => $user->getUsername()->value(),
            'role' => $user->getRole()->value(),
            'is_active' => $user->getIs_Active()->value(),
        ];
        $this->model->findOrFail($id->value())->update($data);
    }

    public function delete(UserId $id): void
    {
        $this->model->findOrFail($id->value())->delete();
    }
}
