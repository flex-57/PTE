<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-admin',
    description: 'Creation d\'un administrateur.',
)]
class CreateAdminCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        // --- EMAIL ---
        do {
            $emailQuestion = new Question('Entrez l\'email de l\'admin : ');
            $email = $helper->ask($input, $output, $emailQuestion);

            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $output->writeln('<error>Email invalide, réessayez !</error>');
                $email = null;
            }
        } while (!$email);

        // --- PASSWORD ---
        do {
            $passwordQuestion = new Question('Entrez le mot de passe de l\'admin : ');
            $passwordQuestion->setHidden(true);
            $passwordQuestion->setHiddenFallback(false);
            $password = $helper->ask($input, $output, $passwordQuestion);

            // Vérification du mot de passe
            $pattern = '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/';
            if (!$password || !preg_match($pattern, $password)) {
                $output->writeln('<error>Mot de passe invalide : doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.</error>');
                $password = null;
            }
        } while (!$password);

        // Supprimer l'ancien admin si existe
        $existingAdmin = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($existingAdmin) {
            $this->entityManager->remove($existingAdmin);
            $this->entityManager->flush();
        }

        // Création du nouvel admin
        $user = new User();
        $user->setEmail($email);
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('<info>Le nouvel administrateur a été créé avec succès !</info>');
        $output->writeln("Email: $email");
        $output->writeln("Mot de passe défini.");

        return Command::SUCCESS;
    }
}
