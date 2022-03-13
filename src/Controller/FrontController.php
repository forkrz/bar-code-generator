<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Com\Tecnick\Barcode\Barcode;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index()
    {
        return $this->render('front/index.html.twig');
    }
}
