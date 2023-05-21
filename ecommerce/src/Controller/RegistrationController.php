<?php

namespace App\Controller;

use Datetime;
use App\Entity\Order;
use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $decoded = json_decode($request->getContent());
        $email = $decoded->email;
        $firstname = $decoded->firstname;
        $lastname = $decoded->lastname;
        $login = $decoded->login;
        $password = $decoded->password;

        $user = new User();
        // encode the plain password
        $user->setPassword(
            $userPasswordHasher->hashPassword(
                $user,
                $password
            )
        );
        $user->setLogin($login);
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setEmail($email);

        $entityManager->persist($user);
        $entityManager->flush();

        $order = new Order();
        $order->setTotalPrice(0);
        $date = new DateTime();
        $order->setCreationDate($date);
        $order->setUserId($user);
        $order->setStatus(0);
        $entityManager->persist($order);
        $entityManager->flush();
        // do anything else you need here, like send an email

        return new JsonResponse('Registered Successfully', Response::HTTP_OK);

    }
}
