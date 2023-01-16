<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Reference;
use App\Fhir\Element\Meta;
use App\Fhir\Exception\TextNotDefinedException;

class Resource{
    public function __construct($json = null){
        $this->mark = 0;
        $this->setId(hash("MD5", microtime(true) . " " . rand(0, 10000000)));
        $this->ConceptosSNOMED = [];

        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->id)) $this->setId($json->id);
        if(isset($json->meta)) $this->setMeta(Meta::Load($json->meta));
        if(isset($json->implicitRules)) $this->setImplicitRules($json->implicitRules);
        if(isset($json->language)) $this->setLanguage($json->language);
        if(isset($json->display)) $this->setDisplay($json->display);
        if(isset($json->resourceType)) $this->resourceType = $json->resourceType;
        if(isset($json->ConceptosSNOMED)){
            foreach($json->ConceptosSNOMED as $conceptos){
                $this->ConceptosSNOMED[] = $conceptos;
            }
        }
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setMeta(Meta $meta){
        $this->meta = $meta;
    }
    public function setImplicitRules($implicitRules){
        $this->implicitRules = $implicitRules;
    }
    public function setLanguage($language){
        $this->language = $language;
    }
    public function setDisplay($display){
        $this->referenceDisplay = $display;
    }
    public function toArray(){
        $dataArray = [];
        $dataArray["resourceType"]=$this->resourceType;
        if(isset($this->id))
            $dataArray["id"] = $this->id;
        if(isset($this->meta))
            $dataArray["meta"] = $this->meta->toArray();
        if(isset($this->implicitRules))
            $dataArray["implicitRules"] = $this->implicitRules;
        if(isset($this->language))
            $dataArray["language"] = $this->language;
        if(isset($this->display))
            $dataArray["display"] = $this->display;
        return $dataArray;
    }
    public function toJson(){
        return json_encode($this->toArray());
    }
    public function toString(){
        return $this->resourceType;
    }
    
    /* Funciones para clases heredadas */
    public function toReference(){
        $this->referenceDisplay = $this->toString();
        if(isset($this->referenceDisplay))
            return new Reference($this->resourceType, $this->id, $this->referenceDisplay);
        return new Reference($this->resourceType, $this->id);
    }
    public function only($array, $string){
        foreach($array as $item){
            if($item == $string)
                return $item;
        }
        throw new TextNotDefinedException($string, implode($array));
    }
}