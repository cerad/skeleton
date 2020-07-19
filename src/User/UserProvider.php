<?php declare(strict_types=1);

namespace App\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    private UserRepository $userRepo;

    public function __construct(EntityManagerInterface $em)
    {
        /** @noinspection PhpFieldAssignmentTypeMismatchInspection */
        $this->userRepo = $em->getRepository(User::class);
    }
    public function loadUserByUsername(string $username) : User
    {
        return $this->userRepo->findOneByUsername($username);
    }
    public function refreshUser(UserInterface $user) : User
    {
        return $this->loadUserByUsername($user->getUsername());
    }
    public function supportsClass(string $class)
    {
        return $class === User::class;
    }
}