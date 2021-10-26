<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Service\PropertyHeatHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 100; $i++) {
            $property = new Property();
            $property
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->realText(200))
                ->setSurface($faker->numberBetween(20, 250))
                ->setRooms($faker->numberBetween(2, 10))
                ->setBedrooms($faker->numberBetween(1, 6))
                ->setFloor($faker->numberBetween(0, 5))
                ->setPrice($faker->numberBetween(30000, 450000))
                ->setHeat($faker->randomElement(['gaz', 'electrique', 'bois']))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSold(false)
            ;
            $manager->persist($property);
        }

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
