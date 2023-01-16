<?php

namespace App\Fhir\Element;

class Reference extends Element{

    public function __construct($resourceType, $id, $display = null){
        parent::__construct();
        $this->setType($resourceType);
        $this->setDisplay($display);
        $this->setReference($resourceType .'/'. $id);
    }
    /* Load json */
    private function loadData($json){
        if(isset($json->reference)) $this->setReference($json->reference);
        if(isset($json->type)) $this->setType($json->type);
        if(isset($json->identifier)) $this->setIdentifier(Identifier::Load($json->identifier));
        if(isset($json->display)) $this->setDisplay($json->display);
    }
    public static function Load($json){
        $reference = new Reference("","","");
        $reference->reference = "";
        $reference->loadData($json);
        return $reference;
    }
    /* setters */
    public function setReference($reference){
        $this->reference = $reference;
    }
    public function setType($type){
        $this->type = $type;
    }
    public function setIdentifier(Identifier $identifier){
        $this->identifier = $identifier;
    }
    public function setDisplay($display){
        $this->display = $display;
    }

    public function getReferenceId(){
        if(isset($this->reference)){
            if(strpos($this->reference, "urn:uuid:") !== false)
                return str_replace("urn:uuid:", "", $this->reference);
            if(strpos($this->reference,"/")!== false){
                $data = explode("/", $this->reference);
                return $data[sizeof($data)-1];
            }
        }
        return false;
    }

    /* funciones */
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->reference) && $this->reference){
            $arrayData["reference"] = $this->reference;
        }
        if(isset($this->type) && $this->type){
            $arrayData["type"] = $this->type;
        }
        if(isset($this->identifier) && $this->identifier){
            $arrayData["identifier"] = $this->identifier->toArray();
        }
        if(isset($this->display) && $this->display){
            $arrayData["display"] = $this->display;
        }
        return $arrayData;
    }
}