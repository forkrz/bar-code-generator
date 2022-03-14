<?php

namespace App\Controller;

use App\Utils\DataCheck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api")]

class ApiController extends AbstractController
{

    #[Route('/barcodeGenerator', name: 'barcodeGenerator', methods: "POST")]
    public function index(Request $request, DataCheck $dataCheck): Response
    {

        $value = $request->get('value');
        $typeOfBarcode = $request->get('type');

        return $dataCheck->checkValueGenerationRules($value, $typeOfBarcode);
    }
}
