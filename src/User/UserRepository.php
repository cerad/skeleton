<?php declare(strict_types=1);

namespace App\User;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

// Keep it simple until need something different
final class UserRepository extends EntityRepository implements UserLoaderInterface
{
    public function findOneByUsername(string $username) : User
    {
        /** @var User $user */
        $user = $this->findOneBy(['username' => $username]);
        return $user;
    }
    public function loadUserByUsername(string $slug) : ?User
    {
        $qb = $this->createQueryBuilder('user');
        $qb->andWhere('user.username = :slug');
        $qb->setParameter('slug',$slug);

        // Strange that the IDE does not complain about this
        return $qb->getQuery()->getOneOrNullResult();
    }
}