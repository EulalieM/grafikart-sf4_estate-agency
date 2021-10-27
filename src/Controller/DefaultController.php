<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Model\Contact;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/", name="HOMEPAGE")
     * @param PropertyRepository $propertyRepository
     * @return Response
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findLatest();

        return $this->render('default/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/contact", name="CONTACT")
     */
    public function contact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre message a bien été envoyé');
            return $this->redirectToRoute('CONTACT');
        }

        return $this->render('default/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin", name="ADMIN", methods={"GET"})
     */
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig', [
        ]);
    }



}
