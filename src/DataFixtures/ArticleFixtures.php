<?php

namespace App\DataFixtures;


use DateTime;
use DateTimeImmutable;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
         for($i=1;$i<10;$i++){
     
            $article = new Article() ;
            $article->setTitle(" titre numero $i")
                    ->setContent("contenu de l'article numero $i") 
                    ->setImage("https://img.freepik.com/photos-gratuite/aubergines-crues-pretes-etre-cuites_23-2150410411.jpg?size=626&ext=jpg&ga=GA1.1.749179356.1703366091")
                    ->setCreatedAt(new DateTimeImmutable()) ;
            $manager->persist($article);
         }
        $manager->flush();
    }
}
