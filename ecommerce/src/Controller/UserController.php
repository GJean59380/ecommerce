<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserUpdate;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'app_user_profile')]
    public function profile(Request $request, Security $security, EntityManagerInterface $em): Response
    {
        // Récupération de l'utilisateur courant
        /** @var User $user */
        $user = $security->getUser();

        // Vérifie si l'utilisateur est connecté
        if (!$user instanceof User) {
            throw $this->createAccessDeniedException('Vous devez être connecté pour effectuer cette action.');
        }

        $form = $this->createForm(UserUpdate::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setLogin($form->get('login')->getData());
            $user->setFirstname($form->get('firstname')->getData());
            $user->setLastname($form->get('lastname')->getData());
            $user->setEmail($form->get('email')->getData());

            $em->persist($user);
            $em->flush();
        }

        return $this->render('user/user.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }
}