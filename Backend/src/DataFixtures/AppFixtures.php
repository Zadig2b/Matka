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
// Create User entities
$userPrenom = ['John', 'Jane', 'Bob', 'Alice', 'David', 'Emily', 'Michael', 'Sarah', 'William', 
'Emma', 'Daniel', 'Olivia', 'Ethan', 'Sophia', 'Matthew', 'Ava', 'James'];
$userNom = ['Doe', 'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Miller', 'Davis', 'Garcia'];
$roles = ['ROLE_ADMIN', 'ROLE_EDITOR'];
$userEntities = [];
$roleIndex = 0; // Start with the first role
$hashedPassword = password_hash('dev', PASSWORD_DEFAULT);

foreach ($userPrenom as $name) {
    $user = new User();
    $user->setPrenom($name);
    $user->setNom($userNom[array_rand($userNom)]);
    $user->setPassword($hashedPassword);
    
    // Set the role based on the current index
    $user->setRoles([$roles[$roleIndex]]);
    $user->setEmail($name . '@Matka.com');

    // Increment the role index for the next iteration
    $roleIndex = ($roleIndex + 1) % count($roles); // Cycle through roles
    
    $manager->persist($user);
    $userEntities[] = $user;
}



        // Create Statut entities
$statutData = [
    ['id' => 1, 'nom' => 'Non lue'],
    ['id' => 2, 'nom' => 'En cours'],
    ['id' => 3, 'nom' => 'Annulée'],
    ['id' => 4, 'nom' => 'Acceptée'],
];

foreach ($statutData as $data) {
    $statut = new Statut();
    $statut->setId($data['id']); // Set the ID
    $statut->setNom($data['nom']);

    $manager->persist($statut);
    $statutEntities[] = $statut;

}



        // Create Pays entities
        $paysNames = ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'];

        $paysEntities = [];
        foreach ($paysNames as $name) {
            $pays = new Pays();
            $pays->setNom($name);

            $manager->persist($pays);
            $paysEntities[$name] = $pays; // Store pays entities by name for easy retrieval
        }
        // Create Categorie entities
        $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];

        foreach ($categorieNames as $name) {
            $categorie = new Categorie();
            $categorie->setNom($name);

            $manager->persist($categorie);
            $categorieEntities[] = $categorie;
            
        }
        // Create Voyage entities

        for ($i = 0; $i < 50; $i++) {
            $voyage = new Voyage();
        
            // Randomly select a Category entity
            $randomIndexCat = array_rand($categorieEntities);
            $randomCategorie = $categorieEntities[$randomIndexCat];
            $voyage->addGetCat($randomCategorie);
        
            // Generate a name for the voyage based on the selected category
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
            // Get the Pays entity corresponding to the selected country name
            $pays = $paysEntities[$randomPaysName];
            // Add the pays to the voyage
            $voyage->addPay($pays);
        
            // Add other fields as needed
            $manager->persist($voyage);

        $manager->flush();
    }
}

private function randomPaysNameForCategory(string $categoryName): string {
    // Map categories to suitable countries
    $categoryToCountryMap = [
        'Détente Citadine' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
        'Excursion' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
        'Voyage Insolite' => ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'],
        'Nuit Polaire' => ['Norvège', 'Finlande', 'Suède'],
        // Add more mappings as needed
    ];

    // Get suitable countries for the given category
    $suitableCountries = $categoryToCountryMap[$categoryName] ?? [];

    // Select a random country from the suitable countries list
    $randomIndex = array_rand($suitableCountries);
    return $suitableCountries[$randomIndex];
}
    public function createCategorie(ObjectManager $manager){
                // Create Categorie entities
                $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];
                foreach ($categorieNames as $name) {
                    $categorie = new Categorie();
                    $categorie->setNom($name);
        
                    $manager->persist($categorie);
                    $categorieEntities[] = $categorie;
                    
                }
                $manager->flush();
    }

    public function createPays(ObjectManager $manager){
        // Create Pays entities
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
    public function createStatut(ObjectManager $manager){
        // Create Statut entities
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
        
    public static function randomPrice(\DateInterval $duration): int {
        // Calculate the total number of days in the duration
        $totalDays = $duration->days;
    
        // Adjust the price based on the duration
        if ($totalDays <= 7) {
            // Short duration, lower price range
            return rand(600, 1500);
        } elseif ($totalDays <= 14) {
            // Medium duration, medium price range
            return rand(1501, 3000);
        } else {
            // Long duration, higher price range
            return rand(3001, 5000);
        }
    }
    
    public static function randomDuration(): int{
        return rand(7, 40);
    }
    public static function randomDate(): \DateTime{
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
    public static function randomCatName(){
        $categorieNames = ['Détente Citadine', 'Excursion', 'Voyage Insolite', 'Nuit Polaire'];
        $randomCategorieNameIndex = array_rand($categorieNames);
        $randomCategorieName = $categorieNames[$randomCategorieNameIndex];
        return $randomCategorieName;
    }
    public static function randomPaysName(){
        $paysNames = ['Finlande', 'Suède', 'Islande', 'Norvège', 'Estonie', 'Lettonie', 'Lituanie'];
        $randomPaysNameIndex = array_rand($paysNames);
        $randomPaysName = $paysNames[$randomPaysNameIndex];
        return $randomPaysName;
    }
}
