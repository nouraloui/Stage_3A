<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/login', name: 'app_classe')]
    public function index(): Response
    {
        return $this->render('base.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
    #[Route('/dash', name: 'app_dash')]
    public function dash(): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }
}