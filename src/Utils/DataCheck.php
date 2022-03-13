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

    private function doesStringContainsLetters($value, $type){
        $codes = ["EAN8","EAN13","UPCE","IMB"];

        if(in_array($value,$codes)){        
            if(!ctype_digit($value)){
                return true;
            };
        }
    }

    public function totalCheck($value, $type){
        if($this->checkIfInputIsEmpty($value, $type)){
            $this->response->setContent('Both values cannot be empty');
        };

        if($this->doesStringContainsLetters($value, $type)){
            return $this->response->setContent('This barcode can be generated only with numbers');
        };

        try{
            $this->barcodes->createBarcode($value, $type);
        }catch(Exception $e){
            return  $this->response->setContent($e->getMessage());
        }
        
        return $this->response->setContent('Barcode generated');
    }
}

