<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ModeratorController extends Controller
{
    /**
     * @Route("/moderator", name="moderator")
     */
    public function index()
    {
        return $this->render('moderator/index.html.twig', [
            'controller_name' => 'ModeratorController',
        ]);
    }
}
