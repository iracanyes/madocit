<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/article", name="article")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("App:Article")
                    ->findAll();

        return $this->render(
            'article/index.html.twig',
            [
                'controller_name' => 'ArticleController',
                "articles" => $articles
            ]
        );
    }
}
