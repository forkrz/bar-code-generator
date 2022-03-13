<?php
namespace App\Utils;

use Com\Tecnick\Barcode\Barcode;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class Barcodes{
    public function createBarcode(string $value,string $typeOfBarcode):Response{
        $response = new Response;
        $barcode = new Barcode;
        try{
            $barcodeObj = $barcode->getBarcodeObj(
                $typeOfBarcode,
                $value,
                1200,
                400,
                'black',                       
                )->setBackgroundColor('white');
                $file_webp = __DIR__ . '/Pictures/barcode.webp';
                file_put_contents($file_webp, $barcodeObj->getPngData());
                return  $response->setContent('Barcode generated');
        }catch(Exception $e){
            return  $response->setContent($e->getMessage());
        }
    }
}