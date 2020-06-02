<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Bien;
use App\Entity\Client;
use App\Entity\Image;
use App\Entity\Vendeur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class BienFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr');
        $type = ["appartement","maison"];
        for($i = 0; $i < 100; $i++) {
            $client = new Client();
            $vendeur = new Vendeur();
            $bien = new Bien();
            $annonce = new Annonce();
            $client
                ->setNom($faker->name)
                ->setPrenom($faker->firstName)
                ->setEmail($faker->email)
                ->setTelephone($faker->e164PhoneNumber)
                ->setPassword(hash('sha256', $faker->password));
            $manager->persist($client);
            $vendeur
                ->setCarteIdentite($faker->image())
                ->setIdClient($client);

            $manager->persist($vendeur);

            $bien
                ->setSuperficie($faker->randomFloat(2, 9, 1000))
                ->setNbPieces($faker->randomNumber(1))
                ->setType($type[$faker->numberBetween(0, 1)])
                ->setDescription($faker->text)
                ->setJardin($faker->numberBetween(0, 1))
                ->setCave($faker->numberBetween(0, 1))
                ->setCeillier($faker->numberBetween(0, 1))
                ->setGarage($faker->numberBetween(0, 1))
                ->setLoggia($faker->numberBetween(0, 1))
                ->setTerrasse($faker->numberBetween(0, 1))
                ->setVerranda($faker->numberBetween(0, 1))
                ->setPrixMin($faker->randomFloat(2, 70000, 6000000))
                ->setAddress($faker->address)
                ->setVendeur($vendeur);
            $manager->persist($bien);
            $annonce
                ->setCreatedAt($faker->dateTimeThisMonth)
                ->setTitre($faker->text(35))
                ->setVendu(0)
                ->setBien($bien);
            $manager->persist($annonce);
            $image = new Image;
            $image->setImage($faker->image())
                ->setIdBien($bien);
            $manager->persist($image);

        }
        $manager->flush();
    }
}
