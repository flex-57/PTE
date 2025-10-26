<?php

namespace App\DataFixtures;

use App\Entity\Domaine;
use App\Entity\Metier;
use App\Entity\CritereMetier;
use App\Entity\Evaluation;
use App\Entity\CritereEvaluation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Critères globaux
        $criteresMetier = [];
        $critNamesMetier = ['Communication','Esprit d’équipe','Rigueur','Autonomie','Créativité','Gestion du stress','Technique','Analyse'];
        foreach ($critNamesMetier as $name) {
            $c = new CritereMetier();
            $c->setNom($name);
            $c->setDescription($faker->sentence(6));
            $manager->persist($c);
            $criteresMetier[$name] = $c;
        }

        $criteresEval = [];
        $critNamesEval = ['Pertinence','Exactitude','Clarté','Innovation','Respect des délais','Qualité présentation','Cohérence'];
        foreach ($critNamesEval as $name) {
            $c = new CritereEvaluation();
            $c->setNom($name);
            $c->setDescription($faker->sentence(5));
            $manager->persist($c);
            $criteresEval[$name] = $c;
        }

        // Domaines + métiers + évaluations
        $domainesData = [
            'Informatique' => ['Développeur Web','Administrateur Système','Data Analyst'],
            'Marketing' => ['Responsable Marketing','Community Manager','Chef de produit'],
            'Finances' => ['Comptable','Analyste financier','Contrôleur de gestion']
        ];

        foreach ($domainesData as $domaineName => $metiersList) {
            $domaine = new Domaine();
            $domaine->setNom($domaineName);
            $domaine->setDescription($faker->paragraph(2));
            $manager->persist($domaine);

            foreach ($metiersList as $metierName) {
                $metier = new Metier();
                $metier->setNom($metierName);
                $metier->setDescription($faker->sentence(10));
                $metier->setDomaine($domaine);
                $manager->persist($metier);

                // Assigner aléatoirement 2 à 4 critères métiers
                $keys = array_rand($criteresMetier, mt_rand(2,4));
                foreach ((array)$keys as $k) {
                    $metier->addCritere($criteresMetier[$k]);
                }
            }

            // Création d’évaluations
            for ($i=0; $i<2; $i++) {
                $eval = new Evaluation();
                $eval->setNom($faker->words(3, true));
                $eval->setDescription($faker->sentence(8));
                $eval->setDomaine($domaine);
                $manager->persist($eval);

                // Assigner aléatoirement 3 à 5 critères évaluations
                $keys = array_rand($criteresEval, mt_rand(3,5));
                foreach ((array)$keys as $k) {
                    $eval->addCritere($criteresEval[$k]);
                }
            }
        }

        $manager->flush();
    }
}
