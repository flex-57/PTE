<?php

namespace App\DataFixtures;

use App\Entity\Domaine;
use App\Entity\Metier;
use App\Entity\Atelier;
use App\Entity\Critere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Critères globaux
        $criteres = [];
        $critNames = [
            'Communication','Esprit d’équipe','Rigueur','Autonomie','Créativité','Gestion du stress','Technique','Analyse',
            'Organisation','Ponctualité','Sens du service','Adaptabilité','Leadership','Curiosité','Fiabilité',
            'Sens des responsabilités','Capacité à apprendre','Gestion du temps','Polyvalence','Sens de l’initiative',
            'Travail sous pression','Respect des consignes','Capacité d’écoute','Esprit critique','Motivation',
            'Gestion des conflits','Prise de décision','Sens de l’observation','Capacité à travailler en équipe',
            'Sens commercial','Gestion des priorités','Capacité d’adaptation','Esprit d’analyse','Compétences techniques',
            'Création de solutions','Gestion de projet','Compétences informatiques','Compétences linguistiques',
            'Compétences en vente','Compétences en marketing','Compétences en finance',
        ];
        foreach ($critNames as $name) {
            $c = new Critere();
            $c->setNom($name);
            $c->setDescription($faker->sentence(6));
            $manager->persist($c);
            $criteres[$name] = $c;
        }

        // Domaines + métiers + atelier
        $domainesData = [
            'Informatique' => ['Développeur web','Technicien inf','Technicien réseau informatique',],
            'Bâtiment' => ['Lecture de plans','Électricité','Dessins en bâtiment et mesures','Vision spaciale',],
            'Mécanique' => ['Assemblage petites pièces','Atelier cycle','Lecture de plans',],
            'Transport' => ['Chauffeur de bus',],
            'Services aux collectivités' => ['Gardien d’immeuble', 'Agent de sécurité',],
            'Entrepreneuriat' => ['Connaissance de l’entreprise',],
            'Vente' => ['Affranchissement / Vente au guichet', 'Tenir la caisse',],
            'Artisanat' => ['Atelier bois', 'Atelier travaux manuels', 'Couture', 'Horlogerie', 'Peinture de précision',],
            'Tertiaire' => ['Cas pratiques vie courante', 'Comptabilité', 'Gestion / Comptabilité', 'EAA', 'M.I.S Agent d’accueil', 'Numérisation documents', 'Planification', 'Positionnement bureautique', 'Reprgraphie', 'Secrétariat', 'Ressources humaines',],
            'Santé' => ['Quizz santé', 'Secrétariat médical',],
            'Éducation' => ['Animation',],
            'Capacité de travail' => ['Atelier porte-fusible', 'Ensachage de pièces'],
            'Capacité de travail' => ['Inventaire', 'Préparation de commandes', 'Réception de produits',],
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
                $keys = array_rand($criteres, mt_rand(2,6));
                foreach ((array)$keys as $k) {
                    $metier->addCritere($criteres[$k]);
                }
            }

            // Création d’ateliers
            for ($i=0; $i<2; $i++) {
                $atelier = new Atelier();
                $atelier->setNom($faker->words(3, true));
                $atelier->setDescription($faker->sentence(8));
                $atelier->setDomaine($domaine);
                $manager->persist($atelier);

                // Assigner aléatoirement 3 à 5 critères ateliers
                $keys = array_rand($criteres, mt_rand(3,5));
                foreach ((array)$keys as $k) {
                    $atelier->addCritere($criteres[$k]);
                }
            }
        }

        $manager->flush();
    }
}
