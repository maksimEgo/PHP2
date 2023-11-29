<?php

namespace src\Model\Users;

use DateTime;
use src\Model\AbstractModel;

class User extends AbstractModel
{
    protected string $username;
    protected string $password;
    protected string $email;
    protected UserRoleEnum $role;
    protected DateTime $created_at;
    protected DateTime $updated_at;

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
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRole(): UserRoleEnum
    {
        return $this->role;
    }

    public function setRole(UserRoleEnum $role): void
    {
        $this->role = $role;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $createTime): void
    {
        $this->created_at = $createTime;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(DateTime $updateTime): void
    {
        $this->updated_at = $updateTime;
    }
}