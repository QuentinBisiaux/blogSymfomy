<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{

    /**
     * @Route("/categories", name="category_index")
     */
    public function index(CategoryRepository $repo)
    {
        return $this->render('category/index.html.twig', [
            'categories' => $repo->findAll()
        ]);
    }

    /**
     * @Route("/category", name="category")
     * @IsGranted("ROLE_ADMIN")
     * @param $request
     * @param $manager
     * @return Response
     */
    public function add(Request $request, ObjectManager $manager)
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();

        }

        return $this->render('category/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
