<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     * @return Response
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Quentin',
            ]);
    }

    /**
     * @param $slug
     * @Route("/blog/show/{slug<[a-z\d\-]+>}", name="blog_show")
     * @return Response
     */
    public function show($slug = null)
    {
        if ($slug === null){
            $title = 'Article Sans Titre';
        }
        $title = ucwords(str_replace("-", " ", $slug));

        return $this->render('blog/show.html.twig', [
            'slug' => $title,
        ]);
    }
}