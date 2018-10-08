<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class GrainController extends Controller
{
    /**
     * @Route("/grain", name="grain")
     */
    public function index()
    {
        return $this->render('grain/index.html.twig', [
            'controller_name' => 'GrainController',
        ]);
    }
}
