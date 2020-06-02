<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Bien;
use App\Entity\Image;
use App\Entity\Vendeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;

class ClientFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        for ($i = 0; $i < 100; $i++) {
            $client = new Client();
            $client
                ->setNom($faker->name)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setTelephone($faker->e164PhoneNumber)
                ->setPassword(hash('sha256', $faker->password));
            $manager->persist($client);

            $manager->flush();
        }
    }
}
 