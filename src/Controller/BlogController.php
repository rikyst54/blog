<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
    * @Route("/blog", name="blog")
    */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    public function add()
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        return $this->render('blog/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
