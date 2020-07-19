<?php declare(strict_types=1);

namespace App\User;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

final class User implements UserInterface
{
    const ROLE_USER  = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    protected string $id; // uuid

    protected string $username;
    protected string $password;
    protected array  $roles = [];

    public function __construct(string $username, string $password, array $roles = [])
    {
        $this->username = $username;
        $this->password = $password;
        $this->roles    = $roles;
        $this->id = Uuid::v4()->toRfc4122(); // 36 char
    }
    public function getUsername() : string
    {
        return $this->username;
    }
    public function getPassword() : string
    {
        return $this->password;
    }
    public function getRoles() : array
    {
        $roles = $this->roles;

        $roles[] = self::ROLE_USER;

        return array_unique($roles);
    }

    public function getSalt()
    {
        return;
    }
    public function eraseCredentials()
    {
        return;
    }
}