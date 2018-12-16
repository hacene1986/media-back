<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoaningController extends AbstractController
{
    /**
     * @Route("/loaning", name="loaning")
     */
    public function index()
    {
        return $this->render('loaning/index.html.twig', [
            'controller_name' => 'LoaningController',
        ]);
    }
}
