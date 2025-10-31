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
            $emailQuestion = new Question("Entrez l'email de l'admin : ");
            $email = $helper->ask($input, $output, $emailQuestion);

            if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $output->writeln('<error>Email invalide, veuillez réessayez !</error>');
                $email = null;
            }
        } while (!$email);

        // --- PASSWORD ---
        do {
            $passwordQuestion = new Question(
                "Entrez le mot de passe de l'admin" 
                . "\n" . 
                "<comment>- Doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.</comment> :"
            );
            $passwordQuestion->setHidden(true);
            $passwordQuestion->setHiddenFallback(false);
            $password = $helper->ask($input, $output, $passwordQuestion);

            $confirmPasswordQuestion = new Question("Répétez le mot de passe : ");
            $confirmPasswordQuestion->setHidden(true);
            $confirmPasswordQuestion->setHiddenFallback(false);
            $confirmPassword = $helper->ask($input, $output, $confirmPasswordQuestion);

            // Vérification du mot de passe
            $pattern = '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/';
            if (!$password || !preg_match($pattern, $password)) {
                $output->writeln('<error>Mot de passe invalide : doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.</error>');
                $password = null;
            } elseif ($password !== $confirmPassword) {
                $output->writeln('<error>Les mots de passe ne correspondent pas, veuillez réessayez.</error>');
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

        $output->writeln('<info>Le nouvel administrateur a été crée avec succès !</info>');
        $output->writeln("Email: $email");
        $output->writeln("Allez maintenant sur la page de connexion <comment>http://127.0.0.1:8000/login</comment> et connectez-vous.");

        return Command::SUCCESS;
    }
}
