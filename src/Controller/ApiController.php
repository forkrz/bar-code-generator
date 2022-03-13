<?php
namespace App\Controller;

use App\Utils\Barcodes;
use App\Utils\DataCheck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route("/api")]

class ApiController extends AbstractController
{

    #[Route('/ean8', name: 'EAN8', methods:"GET|POST")]
    public function index(Request $request,DataCheck $dataCheck,Barcodes $barcodes):Response
    {
        $response = new Response;

        $value = $request->get('value');
        $typeOfBarcode = $request->get('type');

        if(!$dataCheck->checkIfInputIsNotEmpty($value,$typeOfBarcode)){
            return  $response->setContent('Both values cannot be empty');
        }else{
            return $barcodes->createBarcode($value,$typeOfBarcode);
        }
        
        
    }
}
