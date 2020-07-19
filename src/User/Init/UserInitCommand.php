<?php /** @noinspection PhpMissingFieldTypeInspection */
declare(strict_types=1);

namespace App\User\Init;

use App\User\User;
use App\User\UserProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class UserInitCommand extends Command
{
    protected static $defaultName = 'user:init';

    private EntityManagerInterface $em;
    private UserProvider $userProvider;

    public function __construct(EntityManagerInterface $em, UserProvider $userProvider)
    {
        parent::__construct();

        $this->em = $em;
        $this->userProvider = $userProvider;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $userRepo = $this->em->getRepository(User::class);
        echo get_class($userRepo) . "\n";

        $user = $this->userProvider->loadUserByUsername('ahundiak');
        dump($user);

        return Command::SUCCESS;
    }
    private function addUser()
    {
        $user = new User('ahundiak','password');
        $this->em->persist($user);
        $this->em->flush();
    }
}