<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Com\Tecnick\Barcode\Barcode;

#[Route("/api")]

class ApiController extends AbstractController
{

    #[Route('/ean8', name: 'EAN-8', methods:"GET|POST")]
    public function index()
    {
        $barcode = new Barcode();
        $bobj = $barcode->getBarcodeObj(
            'C128',                     // barcode type and additional comma-separated parameters
            'Bonus',          // data string to encode
            1200,                             // bar width (use absolute or negative value as multiplication factor)
            400,                             // bar height (use absolute or negative value as multiplication factor)
            'black',                        // foreground color
            array(-2, -2, -2, -2)           // padding (use absolute or negative values as multiplication factors)
            )->setBackgroundColor('white');
            $file_png = __DIR__ . '/Pictures/barcode.png';
            file_put_contents($file_png, $bobj->getPngData());

    }
}
