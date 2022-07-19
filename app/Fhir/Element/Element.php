<?php

namespace App\Fhir\Element;

class Element{
    public function __construct(){
        $this->extension = [];
    }

    public function setId($id){
        $this->id = $id;
    }
    public function addExtension(Extension $extension){
        $this->extension[] = $extension;
    }

    public function toArray(){
        $arrayData = [];
        if($this->extension){
            foreach($this->extension as $extension){
                $arrayData["extension"][] = $extension->toArray();
            }
        }
        if(isset($this->id)){
            $arrayData["id"] = $this->id;
        }
        return $arrayData;
    }

}