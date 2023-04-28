<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order')]
    public function index(EntityManagerInterface $em): Response
    {
        $orderRepository = $em->getRepository(Order::class);
        $orders = $orderRepository->findAll();
        return $this->render('order/index.html.twig', [
            'controller_name' => 'OrderController',
            'orders' => $orders
        ]);
    }

    #[Route('/api/carts', name: 'app_user_cart')]
    public function cart(Request $request,Security $security, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $orderRepo = $em->getRepository(Order::class);
        $orders = $orderRepo->findBy(array('user_id_id' => $user->getId()));
        $order = '';
        foreach ($orders as $val){
            if ($val->isStatus()){
                $order = $val;
            }
        }
        return $this->render('order/cart.html.twig', [
            'order' => $order
        ]);
    }

}