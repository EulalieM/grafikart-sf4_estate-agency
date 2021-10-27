<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertySearchType;
use App\Model\PropertySearch;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function properties(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        $properties = $paginator->paginate(
            $this->propertyRepository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('default/properties.html.twig', [
            'properties' => $properties,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/acheter/{slug}-{id}", name="PROPERTY", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function property($slug, $id): Response
    {
        $property = $this->propertyRepository->find($id);

        if ($slug !== $property->getSlug()) {
            return $this->redirectToRoute('PROPERTY', [
                'slug' => $property->getSlug(),
                'id'   => $id
            ]);
        }

        return $this->render('default/property.html.twig', [
            'property' => $property
        ]);
    }
}
