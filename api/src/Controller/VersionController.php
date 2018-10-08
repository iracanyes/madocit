<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VersionController extends Controller
{
    /**
     * @Route("/version", name="version")
     */
    public function index()
    {
        return $this->render('version/index.html.twig', [
            'controller_name' => 'VersionController',
        ]);
    }
}
