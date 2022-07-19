<?php

namespace App\Fhir\Element;

class Narrative extends Element{
    public function __construct(){
        parent::__construct();
    }
    public function loadData($json){
        if(isset($json->status)) $this->setStatus($json->status);
        if(isset($json->div)) $this->setDiv($json->div);
    }
    public static function Load($json){
        $narrative = new Narrative();
        $narrative->loadData($json);
        return $narrative;
    }
    public function setStatus($status){
        $data = ["generated","extensions","additional","empty"];
        $this->status = $status;
    }
    public function setDiv($div){
        $this->div = $div;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        if(isset($this->div)){
            $arrayData["div"] = $this->div;
        }
        return $arrayData;
    }
}