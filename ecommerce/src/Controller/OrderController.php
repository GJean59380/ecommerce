<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use DateTime;
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
        $order = $orderRepo->findOneBy(['user_id' => $user->getId(), 'status' => 0]);

        return $this->render('order/cart.html.twig', [
            'order' => $order
        ]);
    }

    #[Route('/api/carts/{id<\d+>}', name: 'app_add_remove_from_cart')]
    public function removeFromCart(Request $request, $id, Security $security, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $orderRepo = $em->getRepository(Order::class);
        $productRepo = $em->getRepository(Product::class);
        $order = $orderRepo->findOneBy(['user_id' => $user->getId(), 'status' => 0]);
        $product = $productRepo->findOneBy(['id' => $id]);

        if ($request->isMethod('POST')) {
            if ($request->request->get('_method') == 'PUT') {
                $order->removeProduct($product);
            } else {
                $order->addProduct($product);
            }
        }


        $em->persist($order);
        $em->flush();

        return $this->render('order/cart.html.twig', [
            'order' => $order
        ]);
    }


    #[Route('/api/carts/validate', name: 'app_cart_validate')]
    public function validateCart(Security $security, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $orderRepo = $em->getRepository(Order::class);
        $order = $orderRepo->findOneBy(['user_id' => $user->getId(), 'status' => 0]);
        $order->setStatus(1);
        $em->persist($order);
        $em->flush();
        $order = new Order();
        $order->setTotalPrice(0);
        $date = new DateTime();
        $order->setCreationDate($date);
        $order->setUserId($user);
        $order->setStatus(0);
        $em->persist($order);
        $em->flush();
        return $this->render('base.html.twig', [
            'order' => $order
        ]);
    }

    #[Route('/api/orders', name: 'app_user_orders')]
    public function order(Security $security, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $orderRepo = $em->getRepository(Order::class);
        $orders = $orderRepo->findBy(['user_id' => $user->getId(), 'status' => 1]);

        return $this->render('order/order.html.twig', [
            'orders' => $orders
        ]);
    }

    #[Route('/api/orders/{id}', name: 'app_user_orders_id')]
    public function order_id($id, Security $security, EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        $orderRepo = $em->getRepository(Order::class);
        $order = $orderRepo->findOneBy(['user_id' => $user->getId(), 'status' => 1, 'id' => $id]);

        return $this->render('order/order_id.html.twig', [
            'order' => $order
        ]);
    }
}