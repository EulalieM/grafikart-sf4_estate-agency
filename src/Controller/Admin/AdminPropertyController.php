<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/property")
 */
class AdminPropertyController extends AbstractController
{
    /**
     * @Route("/", name="ADMIN_PROPERTY_INDEX", methods={"GET"})
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        return $this->render('admin/property/index.html.twig', [
            'properties' => $propertyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ADMIN_PROPERTY_NEW", methods={"GET","POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($property);
            $entityManager->flush();

            $this->addFlash('success', 'La propriété a bien été créée');

            return $this->redirectToRoute('ADMIN_PROPERTY_INDEX', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ADMIN_PROPERTY_SHOW", methods={"GET"})
     */
    public function show(Property $property): Response
    {
        return $this->render('admin/property/show.html.twig', [
            'property' => $property,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ADMIN_PROPERTY_EDIT", methods={"GET","POST"})
     */
    public function edit(Request $request, Property $property, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();

            $this->addFlash('success', 'La propriété a bien été modifiée');

            return $this->redirectToRoute('ADMIN_PROPERTY_INDEX', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ADMIN_PROPERTY_DELETE", methods={"POST"})
     */
    public function delete(Request $request, Property $property, ManagerRegistry $doctrine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$property->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($property);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La propriété a bien été supprimée');

        return $this->redirectToRoute('ADMIN_PROPERTY_INDEX', [], Response::HTTP_SEE_OTHER);
    }
}
