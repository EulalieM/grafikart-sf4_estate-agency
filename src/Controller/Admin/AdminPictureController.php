<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/picture")
 */
class AdminPictureController extends AbstractController
{

    /**
     * @Route("/{id}", name="ADMIN_PICTURE_DELETE", methods={"POST"})
     */
    public function delete(Request $request, Picture $picture, ManagerRegistry $doctrine): Response
    {
        $data = json_decode($request->getContent(), true);

        if ($this->isCsrfTokenValid('delete' . $picture->getId(), $data['_token'])) {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($picture);
            $entityManager->flush();
            return new JsonResponse(['success' => 1]);
        }

        return new JsonResponse(['error' => 'Token invalide'], 400);
    }

}
