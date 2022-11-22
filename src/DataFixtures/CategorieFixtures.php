<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Categorie;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CategorieFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $toLoad = array(0 => "Bague", 1 => "Boucle d'oreille", 2 => "Collier");
        for($i=0; $i < count($toLoad); $i++){
            $categorie = new Categorie();
            $categorie->setNom($toLoad[$i]);
            $this->addReference('categorie'.$i, $categorie);
            $manager->persist($categorie);
        }
        $manager->flush();
    }
}