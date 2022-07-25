<?php 

namespace App\Fhir\Element;

class Expression extends Element{

    public function __construct($language){
        parent::__construct();
        $this->setLanguage($language);
    }

    private function loadData($json){
        if(isset($json->description)){
            $this->description = $json->description;
        }
        if(isset($json->name)){
            $this->name = $json->name;
        }
        if(isset($json->language)){
            $this->language = $json->language;
        }
        if(isset($json->expression)){
            $this->expression = $json->expression;
        }
        if(isset($json->reference)){
            $this->reference = $json->reference;
        }
    }

    public static function Load($json){
        $contactdetail = new Expression("");
        $contactdetail->loadData($json);
        return $contactdetail;
    }

    public function description($description){
        $this->description = $description;
    }
    public function name($name){
        $this->name = $name;
    }
    public function setLanguage($language){
        $data = ["text/cql","text/fhirpath","application/x-fhir-query"];
        $this->language = $language;
    }
    public function expression($expression){
        $this->expression = $expression;
    }
    public function reference($reference){
        $this->reference = $reference;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->description)){
            $arrayData["description"] = $this->description;
        }
        if(isset($this->name)){
            $arrayData["name"] = $this->name;
        }
        if(isset($this->language)){
            $arrayData["language"] = $this->language;
        }
        if(isset($this->expression)){
            $arrayData["expression"] = $this->expression;
        }
        if(isset($this->reference)){
            $arrayData["reference"] = $this->reference;
        }
        return $arrayData;
    }
}