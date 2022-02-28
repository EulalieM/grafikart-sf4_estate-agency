<?php

namespace App\Controller\Admin;

use App\Entity\Specification;
use App\Form\SpecificationType;
use App\Repository\SpecificationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/specification")
 */
class AdminSpecificationController extends AbstractController
{
    /**
     * @Route("/", name="ADMIN_SPECIFICATION_INDEX", methods={"GET"})
     */
    public function index(SpecificationRepository $specificationRepository): Response
    {
        return $this->render('admin/specification/index.html.twig', [
            'specifications' => $specificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ADMIN_SPECIFICATION_NEW", methods={"GET","POST"})
     */
    public function new(Request $request, ManagerRegistry $doctrine): Response
    {
        $specification = new Specification();
        $form = $this->createForm(SpecificationType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($specification);
            $entityManager->flush();

            $this->addFlash('success', 'La caractéristique a bien été créée');

            return $this->redirectToRoute('ADMIN_SPECIFICATION_INDEX', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/specification/new.html.twig', [
            'specification' => $specification,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ADMIN_SPECIFICATION_EDIT", methods={"GET","POST"})
     */
    public function edit(Request $request, Specification $specification, ManagerRegistry $doctrine): Response
    {
        $form = $this->createForm(SpecificationType::class, $specification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $doctrine->getManager()->flush();

            $this->addFlash('success', 'La caractéristique a bien été modifiée');

            return $this->redirectToRoute('ADMIN_SPECIFICATION_INDEX', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/specification/edit.html.twig', [
            'specification' => $specification,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ADMIN_SPECIFICATION_DELETE", methods={"POST"})
     */
    public function delete(Request $request, Specification $specification, ManagerRegistry $doctrine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$specification->getId(), $request->request->get('_token'))) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($specification);
            $entityManager->flush();
        }

        $this->addFlash('success', 'La caractéristique a bien été supprimée');

        return $this->redirectToRoute('ADMIN_SPECIFICATION_INDEX', [], Response::HTTP_SEE_OTHER);
    }
}
