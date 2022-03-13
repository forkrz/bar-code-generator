<?php
namespace App\Controller;

use App\Utils\DataCheck;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Com\Tecnick\Barcode\Barcode;
use Exception;

#[Route("/api")]

class ApiController extends AbstractController
{

    #[Route('/ean8', name: 'EAN8', methods:"GET|POST")]
    public function index(Request $request,DataCheck $dataCheck):Response
    {
        $response = new Response;

        $value = $request->get('value');
        $typeOfBarcode = $request->get('type');

        if(!$dataCheck->checkIfInputIsNotEmpty($value,$typeOfBarcode)){
            return  $response->setContent('Both values cannot be empty');
        }
        $barcode = new Barcode();
        try{
            $bobj = $barcode->getBarcodeObj(
                $typeOfBarcode,
                $value,
                1200,
                400,
                'black',                       
                )->setBackgroundColor('white');
                $file_webp = __DIR__ . '../Utils/Pictures/barcode.webp';
                file_put_contents($file_webp, $bobj->getPngData());
        }catch(Exception $e){
            return  $response->setContent($e->getMessage());
        }
            return  $response->setContent('Barcode generated');

    }
}
