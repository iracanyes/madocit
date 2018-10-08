<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends Controller
{
    /**
     * @Route("/video", name="video")
     */
    public function index()
    {
        return $this->render('video/index.html.twig', [
            'controller_name' => 'VideoController',
        ]);
    }
}
