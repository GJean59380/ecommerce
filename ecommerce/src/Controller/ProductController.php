<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class ProductController extends AbstractController
{
    #[Route('api/products', name: 'app_products')]
    public function index(EntityManagerInterface $em): Response
    {
        $productRepo = $em->getRepository(Product::class);
        $products = $productRepo->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products
        ]);
    }


    #[Route('api/products/{id}', name: 'app_product_id')]
    public function product(Request $request, $id, EntityManagerInterface $em): Response
    {
        $product = $em->getRepository(Product::class)->find($id);

        // Render the product details view
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
