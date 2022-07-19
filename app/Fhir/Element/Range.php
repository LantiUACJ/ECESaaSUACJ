<?php

namespace App\Fhir\Element;

class Range extends Element{

    public function __construct(){
        parent::__construct();
    }

    public function loadData($json){
        if(isset($json->low)){
            $this->low = $json->low;
        }
        if(isset($json->high)){
            $this->high = $json->high;
        }
    }
    public static function Load($json){
        $range = new Range();
        $range->loadData($json);
        return $range;
    }
    public function setlow(Quantity $low){
        $this->low = $low;
    }
    public function sethigh(Quantity $high){
        $this->high = $high;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->low)){
            $arrayData["low"] = $this->low;
        }
        if(isset($this->high)){
            $arrayData["high"] = $this->high;
        }
        return $arrayData;
    }
}