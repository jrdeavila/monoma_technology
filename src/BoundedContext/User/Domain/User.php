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

        UserId $id,
        UserName $username,
        UserPassword $password,
        UserRole $role,
        UserLastLogin $last_login,
        UserIsActive $is_active
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->is_active = $is_active;
        $this->last_login = $last_login;
    }


    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of last_login
     */
    public function getLast_login()
    {
        return $this->last_login;
    }

    /**
     * Set the value of last_login
     *
     * @return  self
     */
    public function setLast_login($last_login)
    {
        $this->last_login = $last_login;

        return $this;
    }

    /**
     * Get the value of is_active
     */
    public function getIs_active()
    {
        return $this->is_active;
    }

    /**
     * Set the value of is_active
     *
     * @return  self
     */
    public function setIs_active($is_active)
    {
        $this->is_active = $is_active;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }


    public static function create(
        UserId $id,
        UserName $username,
        UserPassword $password,
        UserRole $role
    ): User {

        return new self(
            $id,
            $username,
            $password,
            $role,
            new UserLastLogin(null),
            new UserIsActive(true),
        );
    }


    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'username' => $this->username->value(),
            'password' => $this->password->value(),
            'role' => $this->role->value(),
            'last_login' => $this->last_login->value(),
            'is_active' => $this->is_active->value(),
        ];
    }
}
