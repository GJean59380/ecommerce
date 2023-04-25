<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Void_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/insert', name: 'app_insert')]
    public function insert(EntityManagerInterface $em):Response {
        $dict = array([
            array(
                'name' => 'MSI GeForce RTX 3060 VENTUS 2X 12G OC LHR',
                'id' => 'AR202102010037',
                'price' => '419.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 4080 GAMING OC 16G',
                'id' => 'AR202211040036',
                'price' => '1299.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS TUF GeForce RTX 3060 Ti O8G GAMING GDDR6X (LHR)',
                'id' => 'AR202211070026',
                'price' => '559.96',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS DUAL GeForce RTX 3060 O12G (LHR)',
                'id' => 'AR202106080105',
                'price' => '429.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'KFA2 GeForce RTX 3050 EX (1-Click OC) LHR',
                'id' => 'AR202201030047',
                'price' => '299.95',
                'brand' => 'KFA2',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ZOTAC GeForce RTX 3070 Ti',
                'id' => 'AR202302280031',
                'price' => '679.96',
                'brand' => 'ZOTAC',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gainward GeForce RTX 4070 Ti Phoenix',
                'id' => 'AR202302130069',
                'price' => '999.95',
                'brand' => 'Gainward',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'KFA2 GeForce RTX 3060 (1-Click OC) LHR',
                'id' => 'AR202102240079',
                'price' => '399.95',
                'brand' => 'KFA2',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 3060 GAMING X 12G LHR',
                'id' => 'AR202102010036',
                'price' => '439.96',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS DUAL GeForce RTX 3060 O8G (LHR)',
                'id' => 'AR202211070024',
                'price' => '379.96',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4080 SUPRIM X 16G',
                'id' => 'AR202210280078',
                'price' => '1499.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 3060 WINDFORCE OC 12G (LHR)',
                'id' => 'AR202209070050',
                'price' => '419.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 3060 Ti GAMING X TRIO 8GD6X',
                'id' => 'AR202301100013',
                'price' => '599.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4070 Ti VENTUS 3X 12G OC',
                'id' => 'AR202212060048',
                'price' => '1029.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 4070 Ti GAMING OC 12G',
                'id' => 'AR202212120115',
                'price' => '1079.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 3060 GAMING OC 12G (rev 2.0) (LHR)',
                'id' => 'AR202106230074',
                'price' => '459.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gainward GeForce RTX 4080 Phantom',
                'id' => 'AR202210130048',
                'price' => '1289.95',
                'brand' => 'Gainward',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ZOTAC GeForce RTX 3060 Ti Twin Edge',
                'id' => 'AR202302280033',
                'price' => '479.95',
                'brand' => 'ZOTAC',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'KFA2 GeForce RTX 3060 Ti Plus (1-Click OC) V2 LHR',
                'id' => 'AR202210280008',
                'price' => '519.95',
                'brand' => 'KFA2',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4090 SUPRIM X 24G',
                'id' => 'AR202209260168',
                'price' => '2229.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS GeForce RTX 3060 Ti Dual OC Edition 8GB GDDR6X (LHR)',
                'id' => 'AR202301110042',
                'price' => '529.94',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS TUF Gaming GeForce RTX 4070 Ti OC Edition 12GB ',
                'id' => 'AR202212020018',
                'price' => '1099.94',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4070 Ti GAMING X TRIO 12G',
                'id' => 'AR202212060058',
                'price' => '1079.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 4070 Ti EAGLE 12G',
                'id' => 'AR202301100047',
                'price' => '1029.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'EVGA GeForce RTX 2060 SC',
                'id' => 'AR202103220021',
                'price' => '369.95',
                'brand' => 'EVGA',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 3060 EAGLE OC 12G (rev. 2.0) (LHR)',
                'id' => 'AR202106230071',
                'price' => '449.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 4070 Ti EAGLE OC 12G',
                'id' => 'AR202212120114',
                'price' => '1049.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS DUAL GeForce RTX 3050 O8G (LHR)',
                'id' => 'AR202201200062',
                'price' => '369.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'PNY GeForce RTX 4080 16GB VERTO Triple Fan',
                'id' => 'AR202210280011',
                'price' => '1289.95',
                'brand' => 'PNY',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte GeForce RTX 3060 VISION OC 12G (rev. 2.0) (LHR)',
                'id' => 'AR202106230075',
                'price' => '479.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS TUF Gaming GeForce RTX 4090 OC Edition 24GB',
                'id' => 'AR202209290103',
                'price' => '2299.94',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gainward GeForce RTX 4090 Phantom',
                'id' => 'AR202209220004',
                'price' => '1949.95',
                'brand' => 'Gainward',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4080 GAMING X TRIO 16G',
                'id' => 'AR202210280079',
                'price' => '1499.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS TUF Gaming GeForce RTX 4070 Ti 12GB',
                'id' => 'AR202212020019',
                'price' => '1099.94',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'PNY GeForce RTX 4080 16GB XLR8 Gaming Verto EPIC-X RGB Triple Fan OC',
                'id' => 'AR202210280013',
                'price' => '1299.95',
                'brand' => 'PNY',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS ROG Strix GeForce RTX 4080 16GB GDDR6X Noctua OC Edition ',
                'id' => 'AR202303210022',
                'price' => '1899.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 4090 GAMING X TRIO 24G',
                'id' => 'AR202209260171',
                'price' => '2179.94',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 3060 Ti VENTUS 2X 8G OCV1 LHR',
                'id' => 'AR202107070038',
                'price' => '569.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS Phoenix GeForce RTX 3060 V2 (LHR)',
                'id' => 'AR202108310013',
                'price' => '399.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'KFA2 GeForce RTX 3060 Ti (1-Click OC) LHR',
                'id' => 'AR202108020026',
                'price' => '499.96',
                'brand' => 'KFA2',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS TUF Gaming GeForce RTX 4080 OC Edition 16GB',
                'id' => 'AR202211030047',
                'price' => '1599.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'PNY GeForce RTX 4090 24GB XLR8 Gaming VERTO EPIC-X RGB',
                'id' => 'AR202209220082',
                'price' => '1929.95',
                'brand' => 'PNY',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'PNY GeForce RTX 4070 Ti 12GB XLR8 Gaming Verto OC',
                'id' => 'AR202212120111',
                'price' => '1149.95',
                'brand' => 'PNY',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'MSI GeForce RTX 3050 VENTUS 2X 8G OC LHR',
                'id' => 'AR202201110071',
                'price' => '389.95',
                'brand' => 'MSI',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS ROG Strix GeForce RTX 4090 OC Edition 24GB',
                'id' => 'AR202211030044',
                'price' => '2449.96',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'ASUS ROG Strix GeForce RTX 4070 Ti 12GB',
                'id' => 'AR202212020016',
                'price' => '1199.95',
                'brand' => 'ASUS',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gigabyte AORUS GeForce RTX 4070 Ti MASTER 12G ',
                'id' => 'AR202301100046',
                'price' => '1179.95',
                'brand' => 'Gigabyte',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
            ,
            array(
                'name' => 'Gainward GeForce RTX 3060 Ghost (LHR)',
                'id' => 'AR202102170083',
                'price' => '434.95',
                'brand' => 'Gainward',
                'description' => 'Carte graphique',
                'photo' => 'https://logowik.com/content/uploads/images/nvidia3433.jpg',
            )
        ]);
        foreach ($dict as $innerArray) {
            foreach ($innerArray as $value) {
                $product = new Product();
                $product->setName($value['name']);
                $product->setDescription($value['description']);
                $product->setPhoto($value['photo']);
                $product->setPrice($value['price']);
                $em->persist($product);
                $em->flush();
            }
        }
        $response = new Response('Hello, world!');
        return $response;
    }

}
