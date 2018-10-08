<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render(
            'category/index.html.twig',
            [
                'controller_name' => 'CategoryController',
            ]
        );
    }
}
