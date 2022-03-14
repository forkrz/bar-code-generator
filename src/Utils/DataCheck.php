<?php

namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use App\Utils\Barcodes;
use Exception;

class DataCheck
{
    public function __construct()
    {

        $this->response = new Response;
        $this->barcodes = new Barcodes;
    }
    private function checkIfInputIsEmpty($value, $type)
    {

        if ($value == null or $type == null) {
            return true;
        }
    }

    private function checkIfCodeIsNotSupported($type)
    {

        $codes = array("EAN2", "IMBPRE", "PHARMA", "PHARMA2T", "RAW", "RAW2", "QRCODE");
        if (in_array($type, $codes)) {
            return true;
        };
    }
    private function checkIfStringContainsLetters($value, $type)
    {

        $codes = array("EAN5", "EAN8", "EAN13", "UPCE", "IMB","MSI","S25","I25","C128A","C128C","POSTNET","PLANET","CODABAR","CODE11");

        if (in_array($type, $codes)) {
            if (!ctype_digit($value)) {
                return true;
            };
        }
    }

    public function checkValueGenerationRules($value, $type)
    {

        if ($this->checkIfInputIsEmpty($value, $type)) {
            $this->response->setStatusCode(400, 'input is empty');
            return $this->response->setContent(json_encode(['msg' => 'Both values cannot be empty']));
        };

        if ($this->checkIfCodeIsNotSupported($type)) {
            $this->response->setStatusCode(400, 'code is not supported');
            return $this->response->setContent(json_encode(['msg' => 'Unsupported barcode type']));
        }

        if ($this->checkIfStringContainsLetters($value, $type)) {
            $this->response->setStatusCode(400, 'wrong characters');
            return $this->response->setContent(json_encode(['msg' => 'This barcode only can be generated  with numbers']));
        };

        try {
            $this->barcodes->createBarcode($value, $type);
            return $this->response->setContent(json_encode(['msg' => "Barcode generated"]));
        } catch (Exception $e) {
            $this->response->setStatusCode(400, 'error');
            return  $this->response->setContent(json_encode(['msg' => $e->getMessage()]));
        }
    }
}
