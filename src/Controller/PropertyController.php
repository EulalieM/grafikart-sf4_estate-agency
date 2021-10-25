<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $propertyRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(PropertyRepository $propertyRepository, EntityManagerInterface $em)
    {
        $this->propertyRepository = $propertyRepository;
        $this->em = $em;
    }

    /**
     * @Route("/acheter", name="BUY")
     * @return Response
     */
    public function buy(): Response
    {
        return $this->render('default/buy.html.twig', [
        ]);
    }
}
