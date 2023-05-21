<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;


class OrderController extends AbstractController
{
    #[Route('/api/cart/{productId<\d+>}', name: "addToCart", methods: ['POST'])]
    public function addProductToCart(int $productId, SerializerInterface $serializer, EntityManagerInterface $em, ProductRepository $productRepository, OrderRepository $OrderRepository): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }
        $product = $productRepository->find($productId);
        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }
        $cart = $OrderRepository->findOneBy(['user_id' => $user->getId(), 'status' => 0]);

        if (!$cart) {
            $cart = new Order();
            $cart->setUserId($user);
            $cart->setTotalPrice(0);
            $cart->setCreationDate(new DateTime());
            $cart->setStatus(0);
            $em->persist($cart);
            $em->flush();
        }

        try {
            $cart->addProduct($product);
            $em->flush();

            return new JsonResponse('Product added to cart', Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Failed to add product'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    #[Route('/api/cart/{productId<\d+>}', name: "deleteProductFromCart", methods: ['DELETE'])]
    public function deleteProductFromCart(int $productId, SerializerInterface $serializer, EntityManagerInterface $em, ProductRepository $productRepository, OrderRepository $OrderRepository): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $product = $productRepository->find($productId);

        if (!$product) {
            return new JsonResponse(['error' => 'Product not found'], Response::HTTP_NOT_FOUND);
        }

        $cart = $OrderRepository->findOneBy(['user_id' => $user->getId(), 'status' => 0]);

        if (!$cart) {
            return new JsonResponse(['error' => 'User cart not found'], Response::HTTP_NOT_FOUND);
        }

        $products = $cart->getProducts();

        foreach ($products as $s) {
            if (($s->getId() == $productId)) {
                $cart->removeProduct($product);
                $em->flush();

                return new JsonResponse('Product removed from cart', Response::HTTP_OK);
            }
        }

        return new JsonResponse(['error' => 'Product ' . $productId . ' is not in the cart'], Response::HTTP_OK);
    }

    #[Route('/api/cart', name: 'getCartState', methods: ['GET'])]
    public function getCartState(ProductRepository $productRepository, OrderRepository $OrderRepository, SerializerInterface $serializer): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $cart = $OrderRepository->findOneBy(['user_id' => $user->getId()]);

        if (!$cart) {
            return new JsonResponse(['error' => 'Cart not found'], Response::HTTP_NOT_FOUND);
        }

        $productIds = $cart->getProducts();

        $jsonProductsList = $serializer->serialize($productIds, 'json');
        return new JsonResponse($jsonProductsList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/cart/validate', name: 'validate_cart', methods: ['POST'])]
    public function validateCart(EntityManagerInterface $em, OrderRepository $OrderRepository): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        $cart = $OrderRepository->findOneBy(['user_id' => $user, 'status' => 0]);

        if (!$cart) {
            return new JsonResponse(['error' => 'User cart not found'], Response::HTTP_NOT_FOUND);
        }

        // Calculate the total price of the products in the cart
        $totalPrice = 0;

        foreach ($cart->getProducts() as $product) {
            $totalPrice += $product->getPrice();
        }

        $cart->setTotalPrice($totalPrice);
        $cart->setStatus(1);

        try {
            $em->persist($cart);
            $em->flush();

            return new JsonResponse('Cart validated and converted to an order', Response::HTTP_OK);

        } catch (\Exception $e) {
            return new JsonResponse(['error' => 'Order not created'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    #[Route('/api/orders/{id}', name: 'get_order', methods: ['GET'])]
    public function getOrder(Order $order): JsonResponse
    {
        $data = [
            'id' => $order->getId(),
            'totalPrice' => $order->getTotalPrice(),
            'creationDate' => $order->getCreationDate(),
            'products' => [],
        ];

        foreach ($order->getProducts() as $product) {
            $data['products'][] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'photo' => $product->getPhoto(),
                'price' => $product->getPrice(),
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/orders', name: 'get_user_orders', methods: ['GET'])]
    public function getUserOrders(OrderRepository $ordersRepository, SerializerInterface $serializer): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse('User not authenticated', Response::HTTP_UNAUTHORIZED);
        }

        $orders = $ordersRepository->findBy(['user_id' => $user, 'status'=> 1]);

        if (!$orders) {
            return new JsonResponse('Any order has been found', Response::HTTP_NOT_FOUND);
        }

        $user_orders = [];
        foreach ($orders as $order) {
            $user_orders[] = [
                'id' => $order->getId(),
                'totalPrice' => $order->getTotalPrice(),
                'creationDate' => $order->getCreationDate(),
                'products' => $order->getProducts(),
            ];
        }

        $jsonProductsList = $serializer->serialize($user_orders, 'json');
        return new JsonResponse($jsonProductsList, Response::HTTP_OK, [], true);
    }
}