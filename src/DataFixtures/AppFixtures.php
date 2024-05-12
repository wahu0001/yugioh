<?php

namespace App\DataFixtures;

use App\Entity\Card;
use App\Entity\Extension;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $lede = new Extension();
        $lede->setName("Héritage de la destruction");
        $lede->setImage("LEDE.png");
        $lede->setShortcutName("LEDE");
        $date = "25/04/2024";
        $dateObj = \DateTime::createFromFormat('d/m/Y', $date);
        $lede->setReleaseDate($dateObj);

        {
            $fr00 = new Card();
            $fr00->setName("Magiciens des liens et de l'unité");
            $fr00->setShortcutName("FR000");
            $fr00->setDescription("Ni Invocable Normalement ni Posable Normalement. Uniquement Invocable Spécialement (depuis votre main) en ayant min. 25 cartes dans votre Cimetière. Tant que votre adversaire a min. 25 cartes dans son Cimetière, cette carte gagne 2500 ATK/DEF.");
            $fr00->setType("Monstre Effet");
            $fr00->setRarity("SQ");
            $fr00->setParticularity(
                [
                    "ATK"=>2500,
                    "DEF"=>2500,
                    "TYPE"=>[
                        "Magicien","Effet"
                    ],
                    "ATTRIBUT"=>"Lumière"
                ]
            );
            $fr00->setImage("LEDE-FR000-SQ.png");
            $fr00->setExtension($lede);
            $manager->persist($fr00);
        }

        $manager->persist($lede);

        $phni = new Extension();
        $phni->setName("Cauchemar Fantôme");
        $phni->setImage("PHNI.png");
        $phni->setShortcutName("PHNI");
        $date = "08/02/2024";
        $dateObj = \DateTime::createFromFormat('d/m/Y', $date);
        $phni->setReleaseDate($dateObj);

        $manager->persist($phni);

        $manager->flush();
    }
}
