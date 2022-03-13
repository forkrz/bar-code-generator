<?php
namespace App\Utils;

class DataCheck{
    public function checkIfInputIsNotEmpty($value,$type):bool{
        if(!empty($value) or !empty($type)){
            return true;
        }else{
            return false;
        }
    }
}