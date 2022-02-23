<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Model\Contact;
use App\Repository\PropertyRepository;
use App\Service\ContactEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
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
     * @throws TransportExceptionInterface
     */
    public function contact(Request $request, ContactEmailService $email): RedirectResponse|Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email->send_email($contact);
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