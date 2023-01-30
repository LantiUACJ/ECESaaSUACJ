<?php

namespace App\Fhir\Element;

class Quantity extends Element{
    public function __construct($value, $unit){
        parent::__construct();
        $this->setValue($value);
        $this->setUnit($unit);
    }
    private function loadData($json){
        if(isset($json->value)) $this->setValue($json->value);
        if(isset($json->comparator)) $this->setComparator($json->comparator);
        if(isset($json->unit)) $this->setUnit($json->unit);
        if(isset($json->system)) $this->setSystem($json->system);
        if(isset($json->code)) $this->setCode($json->code);
    }
    public static function Load($json){
        $quantity = new Quantity("","");
        $quantity->loadData($json);
        return $quantity;
    }
    public function setValue($value){
        $this->value = $value;
    }
    public function setComparator($comparator){
        $this->comparator = $comparator;
    }
    public function setUnit($unit){
        $this->unit = $unit;
    }
    public function setSystem($system){
        $this->system = $system;
    }
    public function setCode($code){
        $this->code = $code;
    }

    public function toString(){
        $text = "";
        if(isset($this->value)){
            $text .= $this->value . " ";
        }
        if(isset($this->comparator)){
            $text .= $this->comparator . " ";
        }
        if(isset($this->unit)){
            $text .= $this->unit . " ";
        }
        if(isset($this->system)){
            $text .= $this->system . " ";
        }
        if(isset($this->code)){
            $text .= $this->code . " ";
        }
        return $text;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->value)){
            $arrayData["value"] = (float) number_format($this->value,2);
        }
        if(isset($this->comparator)){
            $arrayData["comparator"] = $this->comparator;
        }
        if(isset($this->unit)){
            $arrayData["unit"] = $this->unit;
        }
        if(isset($this->system)){
            $arrayData["system"] = $this->system;
        }
        if(isset($this->code)){
            $arrayData["code"] = $this->code;
        }
        return $arrayData;
    }
}
