<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     * @param $repo
     * @return Response
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            ]);
    }
    /**
     * @param $category
     * @Route("/show/cat/{name}", name="show_category")
     * @return Response
     */
    public function showByCategory(Category $category)
    {
        $articles = $category->getArticles();

        return $this->render('blog/category.html.twig',
            [
                'articles' => $articles,
                'category' => $category
            ]
        );
    }

    /**
     * @Route("/{slug}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /*
    /**
     * @Route("/category/{categoryName}", name="show_category")
     * @param string $categoryName
     * @return Response
     *//*
    public function showByCategory(string $categoryName) : Response
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => mb_strtolower($categoryName)]);

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                [ 'category' => $category],
                ['id' => 'DESC' ],
                3
            );

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article with '.$categoryName.' category, found in article\'s table.'
            );
        }

        return $this->render('blog/category.html.twig',
            [
                'articles' => $articles
            ]
        );
    }*/


}