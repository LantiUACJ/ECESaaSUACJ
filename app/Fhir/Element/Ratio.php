<?php

namespace App\Fhir\Element;

class Ratio extends Element{

    public function __construct(){
        parent::__construct();
    }

    private function loadData($json){
        if(isset($json->numerator)){
            $this->numerator = $json->numerator;
        }
        if(isset($json->denominator)){
            $this->denominator = $json->denominator;
        }
    }
    public static function Load($json){
        $ratio = new Ratio();
        $ratio->loadData($json);
        return $ratio;
    }
    public function setNumerator(Quantity $numerator){
        $this->numerator = $numerator;
    }
    public function setDenominator(Quantity $denominator){
        $this->denominator = $denominator;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->numerator)){
            $arrayData["numerator"] = $this->numerator;
        }
        if(isset($this->denominator)){
            $arrayData["denominator"] = $this->denominator;
        }
        return $arrayData;
    }
}