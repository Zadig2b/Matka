<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\Voyage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Create Pays entities
        $paysNames = ['France', 'Spain', 'Italy', 'Germany', 'United Kingdom']; // Add more countries as needed

        $paysEntities = [];
        foreach ($paysNames as $name) {
            $pays = new Pays();
            $pays->setNom($name);

            $manager->persist($pays);
            $paysEntities[] = $pays;
        }

        for ($i = 0; $i < 20; $i++) {
            $voyage = new Voyage();
            $voyage->setNom('Voyage ' . $i);
            $voyage->setDateDebut(new \DateTime());
            $voyage->setDateFin((new \DateTime())->modify('+7 days'));
            $voyage->setDuree(new \DateInterval('P7D')); // 7 days duration
            $voyage->setDescription('Description of Voyage ' . $i);
            $voyage->setPrix('1000€');
            $voyage->setImage('image_' . $i . '.jpg');

            // Randomly select a Pays entity
            $randomIndex = array_rand($paysEntities);
            $randomPays = $paysEntities[$randomIndex];
            $voyage->addPay($randomPays);

            // Add other fields as needed
            $manager->persist($voyage);

            // Create and associate a Categorie for each Voyage
            $categorie = new Categorie();
            $categorie->setNom('Categorie ' . $i);
            // You may need to set additional properties for Categorie here
            $manager->persist($categorie);

            // Associate the Categorie with the Voyage
            $voyage->addGetCat($categorie);
        }

        $manager->flush();
    }
}
