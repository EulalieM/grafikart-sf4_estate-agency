<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @Route("/acheter", name="BUY")
     */
    public function buy(): Response
    {
        return $this->render('default/buy.html.twig', [
        ]);
    }
}
