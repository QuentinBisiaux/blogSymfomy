<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Repository\TagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="tag")
     * @param TagsRepository $repo
     * @return Response
     */
    public function index(TagsRepository $repo)
    {
        return $this->render('tag/index.html.twig', [
            'tags' => $repo->findAll()
        ]);
    }

    /**
     * @Route("tag/{id}", name="tag_show")
     * @param Tags $tag
     * @return Response
     */
    public function show(Tags $tag)
    {
        return $this->render('tag/show.html.twig', ['tag' => $tag]);
    }
}
