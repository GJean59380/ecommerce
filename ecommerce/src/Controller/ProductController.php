<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\UpdateProductForms;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class ProductController extends AbstractController
{
    #[Route('/api/products', name: 'app_products')]
    public function index(Request $request, Security $security,EntityManagerInterface $em): Response
    {
        /** @var User $user */
        $user = $security->getUser();
        if ($user) {
            $product = new Product();
            $form = $this->createForm(UpdateProductForms::class, $product);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $product->setName($form->get('name')->getData());
                $product->setDescription($form->get('description')->getData());
                $product->setPhoto($form->get('photo')->getData());
                $product->setPrice($form->get('price')->getData());

                $em->persist($product);
                $em->flush();

            }
        }
        $productRepo = $em->getRepository(Product::class);
        $products = $productRepo->findAll();
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'products' => $products
        ]);
    }

    #[Route('/insert', name: 'app_insert')]
    public function insert(EntityManagerInterface $em): Response
    {
        $dict = array([
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 32 Go (2x 16 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201905130003',
                'price' => '112.96',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 16 Go (2x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201905130004',
                'price' => '66.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 16 Go (2 x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201909300069',
                'price' => '55.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Value 8 Go DDR4 2400 MHz CL17',
                'id' => 'AR201707070024',
                'price' => '23.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 32 Go (2 x 16 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201909300072',
                'price' => '103.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 8 Go DDR3/DDR3L 1600 MHz CL11',
                'id' => 'AR201311110015',
                'price' => '26.26',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill NT Series 8 Go DDR3 1600 MHz CL11',
                'id' => 'AR201210220107',
                'price' => '24.25',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 32 Go (2 x 16 Go) DDR4 3600 MHz CL18',
                'id' => 'AR201910280023',
                'price' => '123.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Kingston FURY Beast 32 Go (2 x 16 Go) DDR5 5600 MHz CL40',
                'id' => 'AR202112140061',
                'price' => '199.94',
                'brand' => 'Kingston',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance RGB RS 16 Go (2 x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR202108180055',
                'price' => '83.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis Series 16 Go (2 x 8 Go) DDR3 1600 MHz CL11',
                'id' => 'AR201311110007',
                'price' => '49.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Kingston FURY Beast 16 Go (2 x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR202106280117',
                'price' => '70.94',
                'brand' => 'Kingston',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance RGB RS 32 Go (2 x 16 Go) DDR4 3200 MHz CL16',
                'id' => 'AR202108180056',
                'price' => '126.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 16 Go (2 x 8 Go) DDR4 3000 MHz CL16',
                'id' => 'AR201606210018',
                'price' => '51.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 4 Go DDR3/DDR3L 1600 MHz CL11',
                'id' => 'AR201311110013',
                'price' => '14.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 8 Go 2400 MHz CL16',
                'id' => 'AR201711270052',
                'price' => '32.75',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 8 Go DDR4 2133 MHz CL15',
                'id' => 'AR201512240177',
                'price' => '27.65',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Textorm 16 Go (2x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR202011230065',
                'price' => '65.95',
                'brand' => 'Textorm',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill SO-DIMM 8 Go DDR3 1600 MHz CL11',
                'id' => 'AR201307170058',
                'price' => '25.75',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance DDR5 32 Go (2 x 16 Go) 4800 MHz CL40 - Noir',
                'id' => 'AR202112010034',
                'price' => '188.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 32 Go (2 x 16 Go) DDR4 3600 MHz CL16',
                'id' => 'AR202108040029',
                'price' => '142.94',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 16 Go 3200 MHz CL22',
                'id' => 'AR202204040030',
                'price' => '61.94',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair ValueSelect 16 Go DDR4 2133 MHz CL15 ',
                'id' => 'AR201512240158',
                'price' => '53.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 16 Go (2 x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR202105110033',
                'price' => '67.94',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws 5 Series Noir 16 Go (2x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201509130022',
                'price' => '62.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance RGB PRO Series 32 Go (2x 16 Go) DDR4 3600 MHz CL18',
                'id' => 'AR201912020106',
                'price' => '141.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 16 Go (2x 8 Go) 3200 MHz CL22',
                'id' => 'AR202008110024',
                'price' => '66.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance LPX Series Low Profile 16 Go (2x 8 Go) DDR4 2666 MHz CL16',
                'id' => 'AR201507200030',
                'price' => '65.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 8 Go (1 x 8 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201909300068',
                'price' => '28.5',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 64 Go (2 x 32 Go) DDR4 3200 MHz CL22',
                'id' => 'AR202008120086',
                'price' => '179.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 32 Go (2 x 16 Go) 3200 MHz CL22',
                'id' => 'AR202010120007',
                'price' => '121.94',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 32 Go (2 x 16 Go) DDR4 3200 MHz CL22',
                'id' => 'AR202008120084',
                'price' => '103.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill NS Series 4 Go DDR3 1333 MHz CL9',
                'id' => 'AR201211120049',
                'price' => '15.25',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws 5 Series Noir 32 Go (2x 16 Go) DDR4 3200 MHz CL16',
                'id' => 'AR201512280082',
                'price' => '109.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Textorm 16 Go DDR4 3200 MHz CL16',
                'id' => 'AR202009180072',
                'price' => '61.96',
                'brand' => 'Textorm',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws SO-DIMM 16 Go (2 x 8 Go) DDR3/DDR3L 1600 MHz CL9',
                'id' => 'AR201308190024',
                'price' => '51.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 8 Go DDR4 3200 MHz CL22',
                'id' => 'AR202008120080',
                'price' => '27.74',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws SO-DIMM 8 Go DDR3/DDR3L 1600 MHz CL9',
                'id' => 'AR201308190022',
                'price' => '26.5',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill NS Series 4 Go DDR3 1600 MHz CL11',
                'id' => 'AR201211120051',
                'price' => '15.25',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 32 Go DDR4 3200 MHz CL22',
                'id' => 'AR202008120085',
                'price' => '91.94',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill NT Series 16 Go (2 x 8 Go) DDR3 1600 MHz CL11',
                'id' => 'AR201210220108',
                'price' => '48.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill RipJaws Series SO-DIMM 16 Go (2 x 8 Go) DDR3/DDR3L 1600 MHz CL11',
                'id' => 'AR201311110009',
                'price' => '50.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 16 Go (2 x 8 Go) DDR4 2133 MHz CL15',
                'id' => 'AR201601110107',
                'price' => '48.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Crucial SO-DIMM DDR4 4 Go 2666 MHz CL19 SR X8',
                'id' => 'AR201809030044',
                'price' => '33.76',
                'brand' => 'Crucial',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Kingston FURY Beast 16 Go (2 x 8 Go) DDR4 3600 MHz CL17',
                'id' => 'AR202106280129',
                'price' => '78.95',
                'brand' => 'Kingston',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'G.Skill Aegis 16 Go (1 x 16 Go) DDR4 2666 MHz CL19',
                'id' => 'AR201810080050',
                'price' => '45.95',
                'brand' => 'G.Skill',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 16 Go 2666 MHz CL18',
                'id' => 'AR201803080246',
                'price' => '59.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
            )
            ,
            array(
                'name' => 'Corsair Vengeance SO-DIMM DDR4 8 Go 3200 MHz CL22',
                'id' => 'AR202108310074',
                'price' => '33.95',
                'brand' => 'Corsair',
                'description' => 'Mémoire PC',
                'photo' => 'https://previews.123rf.com/images/alekseyvanin/alekseyvanin1704/alekseyvanin170404715/77014870-ram-ic%C3%B4ne-de-ligne-de-m%C3%A9moire-d-acc%C3%A8s-al%C3%A9atoire-signe-de-vecteur-de-contour-rempli-pictogramme.jpg',
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

    #[Route('/api/products/{id}', name: 'app_product_id')]
    public function product(Request $request, $id, Security $security, EntityManagerInterface $em): Response
    {
        $product = $em->getRepository(Product::class)->find($id);

        /** @var User $user */
        $user = $security->getUser();
        if ($user){
            $form = $this->createForm(UpdateProductForms::class, $product);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $product->setName($form->get('name')->getData());
                $product->setDescription($form->get('description')->getData());
                $product->setPhoto($form->get('photo')->getData());
                $product->setPrice($form->get('price')->getData());

                $em->persist($product);
                $em->flush();

            }
            // Render the product details view
            return $this->render('product/show.html.twig', [
                'product' => $product,
                'form' => $form->createView()
            ]);
        }


        // Render the product details view
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => []
        ]);
    }
}
