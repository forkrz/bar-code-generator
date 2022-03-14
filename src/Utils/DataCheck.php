<?php
namespace App\Utils;

use Symfony\Component\HttpFoundation\Response;
use App\Utils\Barcodes;
use Exception;
class DataCheck{
    public function __construct()
    {
        $this->response = new Response;
        $this->barcodes = new Barcodes;
    }
    private function checkIfInputIsEmpty($value,$type){
        if(empty($value) or empty($type)){
            return true;
        }
    }

    private function checkIfCodeIsNotSupported($type){
        $codes = array("EAN2","IMBPRE","PHARMA","PHARMA2T","RAW","RAW2","QRCODE");
        if(in_array($type,$codes)){
            return true;
        };
    }
    private function doesStringContainsLetters($value, $type){
        $codes = array("EAN8","EAN13","UPCE","IMB");

        if(in_array($type,$codes)){        
            if(!ctype_digit($value)){
                return true;
            };
        }
    }

    public function totalCheck($value, $type){
        if($this->checkIfInputIsEmpty($value, $type)){
            $this->response->setStatusCode(400, 'input is empty');
            $this->response->setContent('Both values cannot be empty');
        };

        if($this->checkIfCodeIsNotSupported($type)){
            $this->response->setStatusCode(400, 'code is not supported');
            $this->response->setContent('Unsupported barcode type');
        }

        if($this->doesStringContainsLetters($value, $type)){
            $this->response->setStatusCode(400, 'wrong characters');
            return $this->response->setContent('This barcode can be generated only with numbers');
        };

        try{
            $this->barcodes->createBarcode($value, $type);
        }catch(Exception $e){
            $this->response->setStatusCode(400, 'error');
            return  $this->response->setContent($e->getMessage());
        }
        
        return $this->response->setContent('Barcode generated');
    }
}

