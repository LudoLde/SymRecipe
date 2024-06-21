<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class AppFixtures extends Fixture
{
    
    public function load(ObjectManager $manager): void
    {
        $faker = $faker = Faker\Factory::create();

        for($i=0;$i<10;$i++){
            $user = new User();
        $user->setUsername($faker->word());
        $user->setEmail($faker->email());
        $user->setRoles(['ROLE_USER']);
        $user->setPlainPassword('password');
        $manager->persist($user);

        $manager->flush();
        }
        
    }
}
