<?php

namespace App\DataFixtures;

use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for($i=0; $i < 1000;$i++){
            $recette = new Recette();
            $recette->setNom($faker->name);
            $recette->setEstFavori($faker->boolean());
            $recette->setImage($faker->image());
            $recette->setIngredient1($faker->name);
            $recette->setIngredient2($faker->name);
            $recette->setIngredient3($faker->name);
            $recette->setQuantite1($faker->randomDigit);
            $recette->setQuantite2($faker->randomDigit);
            $recette->setQuantite3($faker->randomDigit);
        }
        $manager->flush();
    }
}
