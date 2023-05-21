<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'allProducts', methods: ['GET'])]
    public function getProducts(ProductRepository $productRepository, SerializerInterface $serializer): JsonResponse
    {
        $productsList = $productRepository->findAll();
        $jsonProductsList = $serializer->serialize($productsList, 'json');
        return new JsonResponse($jsonProductsList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/products/{id}', name: 'productDetails', methods: ['GET'])]
    public function getDetailProduct(int $id, SerializerInterface $serializer, ProductRepository $productRepository): JsonResponse
    {
        $product = $productRepository->find($id);
        if ($product) {
            $jsonProduct = $serializer->serialize($product, 'json');
            return new JsonResponse($jsonProduct, Response::HTTP_OK, [], true);
        }
        return new JsonResponse('Product not found', Response::HTTP_NOT_FOUND);
    }

    #[Route('/api/products/{id}', name: 'productDelete', methods: ['DELETE'])]
    public function deleteProduct(Product $product, EntityManagerInterface $em, TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker): JsonResponse
    {
        try {
            // Supprimer le produit
            $em->remove($product);
            $em->flush();

            return new JsonResponse('Product deleted successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return new JsonResponse('Failed to delete product', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    #[Route('/api/products', name: "ProductCreate", methods: ['POST'])]
    public function createProduct(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {

        $product = $serializer->deserialize($request->getContent(), Product::class, 'json');

        if ($product) {
            $em->persist($product);
            $em->flush();

            $jsonProduct = $serializer->serialize($product, 'json');

            return new JsonResponse($jsonProduct, Response::HTTP_CREATED, [], true);
        } else {
            return new JsonResponse('Can\'t create product', Response::HTTP_CREATED, [], true);
        }
    }

    #[Route('/api/products/{id}', name: "ProductUpdate", methods: ['PUT'])]
    public function updateProduct(Request $request, SerializerInterface $serializer, Product $currentProduct, EntityManagerInterface $em): JsonResponse
    {

        $updatedProduct = $serializer->deserialize($request->getContent(),
            Product::class,
            'json',
            [AbstractNormalizer::OBJECT_TO_POPULATE => $currentProduct]);

        $em->persist($updatedProduct);

        try {
            $em->flush();
            $jsonProduct = $serializer->serialize($updatedProduct, 'json');
            return new JsonResponse($jsonProduct, Response::HTTP_OK, [], true);
        } catch (\Exception $e) {
            return new JsonResponse('Failed to update product', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
