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
     * @Route("/acheter", name="PROPERTIES")
     * @return Response
     */
    public function buy(): Response
    {
        $properties = $this->propertyRepository->findAllVisible();

        return $this->render('default/properties.html.twig', [
            'properties' => $properties,
        ]);
    }

    /**
     * @Route("/acheter/{slug}-{id}", name="PROPERTY_SHOW", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show($slug, $id): Response
    {
        $property = $this->propertyRepository->find($id);

        if ($slug !== $property->getSlug()) {
            return $this->redirectToRoute('PROPERTY_SHOW', [
                'slug' => $property->getSlug(),
                'id'   => $id
            ]);
        }

        return $this->render('default/property_show.html.twig', [
            'property' => $property
        ]);
    }
}
