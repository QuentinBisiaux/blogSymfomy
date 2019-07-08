<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tags;
use App\Entity\Article;
use App\Entity\User;
use App\Service\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $slugify;

    private $passwordEncoder;

    public function __construct(Slugify $slugify, UserPasswordEncoderInterface $encoder)
    {
        $this->slugify = $slugify;
        $this->passwordEncoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Création d’un utilisateur de type “auteur”
        $author = new User();
        $author->setEmail('author@monsite.com');
        $author->setRoles(['ROLE_AUTHOR']);
        $author->setPassword($this->passwordEncoder->encodePassword(
            $author,
            'author')
        );

        $manager->persist($author);


        for ($i = 1; $i <= 1000; $i++) {
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);

            $tag = new Tags();
            $tag->setName("tag " . $i);
            $manager->persist($tag);

            $article = new Article();
            $article->setTitle("article " . $i);
            $article->setSlug($this->slugify->generate($article->getTitle()));
            $article->setContent("article " . $i . " content");
            $article->setCategory($category);
            $article->addTag($tag);
            $article->setAuthor($author);
            $manager->persist($article);
        }

        $manager->flush();
    }

}
