<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(EntityManagerInterface $em): Response
    {
        $productRepo = $em->getRepository(Product::class);
        $products = $productRepo->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function product(Request $request, $id, EntityManagerInterface $em): Response
    {
        $product = $em->getRepository(Product::class)->find($id);

        // Render the product details view
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
