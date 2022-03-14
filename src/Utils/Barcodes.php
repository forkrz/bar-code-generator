<?php

namespace App\Utils;

use Com\Tecnick\Barcode\Barcode;
class Barcodes
{
    public function createBarcode(string $value, string $typeOfBarcode)
    {
        $barcode = new Barcode;
        $barcodeObj = $barcode->getBarcodeObj(
            $typeOfBarcode,
            $value,
            1200,
            400,
            'black',
        )->setBackgroundColor('white');
        $file_webp = $_SERVER['DOCUMENT_ROOT'] . '../../public/Pictures/barcode.webp';
        file_put_contents($file_webp, $barcodeObj->getPngData());
    }
}
