<?php

namespace src\Model\Users;

use DateTime;
use src\Model\AbstractModel;
use function DI\get;

class User extends AbstractModel
{
    protected string $username;
    protected string $password;
    protected string $email;
    protected string $role;
    protected string $created_at;
    protected string $updated_at;
    protected const TABLE = 'users';

    public function getUserName() :string
    {
        return $this->username;
    }

    public function setUserName(string $name): void
    {
        $this->username = $name;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(UserRoleEnum $role): void
    {
        $this->role = UserRoleEnum::getRole($role);
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $createTime): void
    {
        $this->created_at = $createTime->format('Y-m-d H:i:s');
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updateTime): void
    {
        $this->updated_at = $updateTime->format('Y-m-d H:i:s');
    }
}