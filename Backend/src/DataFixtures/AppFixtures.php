<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\Statut;
use App\Entity\User;
use App\Entity\Voyage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        //Créer des entités utilisateur
        $userPrenom = [
            'John', 'Jane', 'Bob', 'Alice', 'David', 'Emily', 'Michael', 'Sarah', 'William',
            'Emma', 'Daniel', 'Olivia', 'Ethan', 'Sophia', 'Matthew', 'Ava', 'James'
        ];
        $userNom = ['Doe', 'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia'];
        $roles = ['ROLE_ADMIN', 'ROLE_EDITOR'];
        $userEntities = [];
        $roleIndex = 0; //Commence par le premier rôle
        $hashedPassword = password_hash('dev', PASSWORD_DEFAULT);

        foreach ($userPrenom as $name) {
            $user = new User();
            $user->setPrenom($name);
            $user->setNom($userNom[array_rand($userNom)]);
            $user->setPassword($hashedPassword);

            //Définir le rôle en fonction de l'index actuel
            $user->setRoles([$roles[$roleIndex]]);
            $user->setEmail($name . '@Matka.com');

            //Incrémentez l'index de rôle pour la prochaine itération
            $roleIndex = ($roleIndex + 1) % count($roles); // Cycle through roles

            $manager->persist($user);
            $userEntities[] = $user;
        }



        //Créer des entités de statut
        $statutData = [
            ['id' => 1, 'nom' => 'Non lue'],
            ['id' => 2, 'nom' => 'En cours'],
            ['id' => 3, 'nom' => 'Annulée'],
            ['id' => 4, 'nom' => 'Acceptée'],
        ];

        foreach ($statutData as $data) {
            $statut = new Statut();
            $statut->setId($data['id']);
            $statut->setNom($data['nom']);

            $manager->persist($statut);
            $statutEntities[] = $statut;
        }



        //Créer des entités Pays
        $paysNames = ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'];

        $paysEntities = [];
        foreach ($paysNames as $name) {
            $pays = new Pays();
            $pays->setNom($name);

            $manager->persist($pays);
            $paysEntities[$name] = $pays;
        }
        //Créer des entités de catégorie
        $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];

        foreach ($categorieNames as $name) {
            $categorie = new Categorie();
            $categorie->setNom($name);

            $manager->persist($categorie);
            $categorieEntities[] = $categorie;
        }
        //Créer des entités de voyage

        for ($i = 0; $i < 50; $i++) {
            $voyage = new Voyage();

            //Sélectionner au hasard une entité de catégorie
            $randomIndexCat = array_rand($categorieEntities);
            $randomCategorie = $categorieEntities[$randomIndexCat];
            $voyage->addGetCat($randomCategorie);

            //Générer un nom pour le voyage en fonction de la catégorie sélectionnée
            $randomCategorieName = $randomCategorie->getNom();
            $randomPaysName = $this->randomPaysNameForCategory($randomCategorieName);
            $voyage->setNom($randomCategorieName . ' en ' . $randomPaysName);

            $voyage->setDateDebut($this->randomDate());
            $voyage->setDateFin($this->randomDateFin($voyage->getDateDebut()));
            $voyage->updateDuree();
            $voyage->setDescription('Description of Voyage ' . $i);
            $voyage->setPrix($this->randomPrice($voyage->getDuree()) . '€');
            $voyage->setImage($voyage->getNom() . '.jpg');
            $voyage->setVoyageUser($userEntities[array_rand($userEntities)]);
            //Récupère l'entité Pays correspondant au nom du pays sélectionné
            $pays = $paysEntities[$randomPaysName];
            //créer la relation pays/voyage
            $voyage->addPay($pays);

            $manager->persist($voyage);

            $manager->flush();
        }
    }

    private function randomPaysNameForCategory(string $categoryName): string
    {
        //map les catégories vers les pays appropriés
        $categoryToCountryMap = [
            'Détente Citadine' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
            'Excursion' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
            'Voyage Insolite' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
            'Nuit Polaire' => ['Norvège', 'Finlande', 'Suède'],
        ];

        //Obtenez les pays appropriés pour la catégorie donnée
        $suitableCountries = $categoryToCountryMap[$categoryName] ?? [];

        //Sélectionne un pays au hasard dans la liste des pays appropriés
        $randomIndex = array_rand($suitableCountries);
        return $suitableCountries[$randomIndex];
    }
    public function createCategorie(ObjectManager $manager)
    {
        //Créer des entités de catégorie
        $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];
        foreach ($categorieNames as $name) {
            $categorie = new Categorie();
            $categorie->setNom($name);

            $manager->persist($categorie);
            $categorieEntities[] = $categorie;
        }
        $manager->flush();
    }

    public function createPays(ObjectManager $manager)
    {
        //Créer des entités Pays
        $paysNames = ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'];

        $paysEntities = [];
        foreach ($paysNames as $name) {
            $pays = new Pays();
            $pays->setNom($name);

            $manager->persist($pays);
            $paysEntities[] = $pays;
        }
        $manager->flush();
    }
    public function createStatut(ObjectManager $manager)
    {
        //Créer des entités de statut
        $statutNames = ['Non lue', 'En cours', 'Annulée', 'Acceptée'];
        $statutEntities = [];
        foreach ($statutNames as $name) {
            $statut = new Statut();
            $statut->setNom($name);

            $manager->persist($statut);
            $statutEntities[] = $statut;
        }
        $manager->flush();
    }

    public static function randomPrice(\DateInterval $duration): int
    {
        //Calculer le nombre total de jours dans la durée
        $totalDays = $duration->days;

        //Ajuster le prix en fonction de la durée
        if ($totalDays <= 7) {
            //Courte durée, gamme de prix inférieure
            return rand(600, 1500);
        } elseif ($totalDays <= 14) {
            //Durée moyenne, gamme de prix moyenne
            return rand(1501, 3000);
        } else {
            //Longue durée, gamme de prix plus élevée
            return rand(3001, 5000);
        }
    }

    public static function randomDuration(): int
    {
        return rand(7, 40);
    }
    public static function randomDate(): \DateTime
    {
        $date = new \DateTime();
        $date->modify('-' . rand(1, 365) . ' days');
        return $date;
    }
    public function randomDateFin(\DateTime $dateDebut): \DateTime
    {
        $date = clone $dateDebut;
        $date->modify('+' . rand(7, 40) . ' days');
        return $date;
    }
    public static function randomCatName()
    {
        $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];
        $randomCategorieNameIndex = array_rand($categorieNames);
        $randomCategorieName = $categorieNames[$randomCategorieNameIndex];
        return $randomCategorieName;
    }
    public static function randomPaysName()
    {
        $paysNames = ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'];
        $randomPaysNameIndex = array_rand($paysNames);
        $randomPaysName = $paysNames[$randomPaysNameIndex];
        return $randomPaysName;
    }
}
