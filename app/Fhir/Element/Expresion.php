<?php 

namespace App\Fhir\Element;

class Expresion extends Element{

    public function __construct($language){
        parent::__construct();
        $this->setLanguage($language);
    }

    public function description($description){
        $this->description = $description;
    }
    public function name($name){
        $this->name = $name;
    }
    public function language($language){
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