<?php declare(strict_types=1);

namespace App\User;

use Doctrine\ORM\EntityRepository;

// Keep it simple until need something different
final class UserRepository extends EntityRepository
{
    public function findOneByUsername(string $username) : User
    {
        /** @var User $user */
        $user = $this->findOneBy(['username' => $username]);
        return $user;
    }
}