<?php /** @noinspection PhpMissingFieldTypeInspection */
declare(strict_types=1);

namespace App\User\Init;

use App\User\User;
use App\User\UserProvider;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserInitCommand extends Command
{
    protected static $defaultName = 'user:init';

    private EntityManagerInterface $em;
    private UserProvider $userProvider;
    private EncoderFactoryInterface $encoderFactory;

    public function __construct(
        EntityManagerInterface $em,
        UserProvider $userProvider,
        EncoderFactoryInterface $encoderFactory)
    {
        parent::__construct();

        $this->em = $em;
        $this->userProvider = $userProvider;
        $this->encoderFactory = $encoderFactory;
    }
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //$this->addUser();

        $userRepo = $this->em->getRepository(User::class);
        echo get_class($userRepo) . "\n";

        $user = $userRepo->loadUserByUsername('ahundiak');
        dump($user);

        return Command::SUCCESS;
    }
    private function addUser()
    {
        $passwordEncoder = $this->encoderFactory->getEncoder(User::class);
        $hashedPassword = $passwordEncoder->encodePassword('password',null);

        $user = new User('ahundiak',$hashedPassword);
        $this->em->persist($user);
        $this->em->flush();
    }
}