<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:user:promote-admin',
    description: 'Promote a user to admin or create an admin user.'
)]
class PromoteAdminCommand extends Command
{
    private EntityManagerInterface $em;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        parent::__construct();
        $this->em = $em;
        $this->hasher = $hasher;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password (if creating)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $repo = $this->em->getRepository(User::class);
        $user = $repo->findOneBy(['email' => $email]);
        if (!$user) {
            if (!$password) {
                $output->writeln('<error>Password required to create a new admin user.</error>');
                return Command::FAILURE;
            }
            $user = new User();
            $user->setEmail($email);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->hasher->hashPassword($user, $password));
            $this->em->persist($user);
            $output->writeln('<info>Admin user created.</info>');
        } else {
            $user->setRoles(array_unique(array_merge($user->getRoles(), ['ROLE_ADMIN'])));
            $output->writeln('<info>User promoted to admin.</info>');
        }
        $this->em->flush();
        return Command::SUCCESS;
    }
}
