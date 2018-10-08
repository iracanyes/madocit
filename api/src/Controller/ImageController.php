<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends Controller
{
    /**
     * @Route("/image", name="image")
     */
    public function index()
    {
        return $this->render('image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }
}
