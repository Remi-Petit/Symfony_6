<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LuckyController extends AbstractController {

    /** * @Route("/") */
    public function home(): Response {
        return $this->render('pages/home.html.twig');
    }

    /** * @Route("/lucky/number") */
    public function number(): Response {
        $number = random_int(0, 100);

        return $this->render('pages/number.html.twig', [
            'number' => $number,
        ]);
    }

    /** * @Route("/produit") */
    public function yolo(): Response {
        return $this->render('pages/produit.html.twig');
    }
}