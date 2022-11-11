<?php

namespace Src\BoundedContext\User\Domain;

use Src\BoundedContext\User\Domain\ValueObjects\UserId;
use Src\BoundedContext\User\Domain\ValueObjects\UserIsActive;
use Src\BoundedContext\User\Domain\ValueObjects\UserLastLogin;
use Src\BoundedContext\User\Domain\ValueObjects\UserName;
use Src\BoundedContext\User\Domain\ValueObjects\UserPassword;
use Src\BoundedContext\User\Domain\ValueObjects\UserRole;

final class User
{

    private UserId $id;
    private UserName $username;
    private UserPassword $password;
    private UserLastLogin $last_login;
    private UserIsActive $is_active;
    private UserRole $role;

    public function __construct(

        UserName $username,
        UserPassword $password,
        UserRole $role,
        UserLastLogin $last_login,
        UserIsActive $is_active
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->is_active = $is_active;
        $this->last_login = $last_login;
    }


    public function getId(): UserId
    {
        return $this->id;
    }


    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getUsername(): UserName
    {
        return $this->username;
    }


    public function setUsername($username): void
    {
        $this->username = $username;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getLast_login(): UserLastLogin
    {
        return $this->last_login;
    }


    public function setLast_login(UserLastLogin $last_login): void
    {
        $this->last_login = $last_login;
    }


    public function getIs_active(): UserIsActive
    {
        return $this->is_active;
    }


    public function setIs_active($is_active): void
    {
        $this->is_active = $is_active;
    }


    public function getRole(): UserRole
    {
        return $this->role;
    }


    public function setRole($role): void
    {
        $this->role = $role;
    }


    public static function create(
        UserName $username,
        UserPassword $password,
        UserRole $role,
        UserIsActive $isActive,
        UserLastLogin $lastLogin
    ): User {

        return new self(
            $username,
            $password,
            $role,
            $lastLogin,
            $isActive
        );
    }


    public function toArray(): array
    {
        return [
            'username' => $this->username->value(),
            'password' => $this->password->value(),
            'role' => $this->role->value(),
            'last_login' => $this->last_login->value()?->format('Y-m-d H:i:s'),
            'is_active' => $this->is_active->value(),
        ];
    }
}
