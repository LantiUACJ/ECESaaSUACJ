<?php

namespace App\Fhir\Element;

class Contributor extends Element{

    public function __construct(){
        parent::__construct();
        $this->contact = [];
    }
    public function setType($type){
        $types = ["author","editor","reviewer","endorser"];
        $this->type = $type;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function addContact(ContactDetail $contact){
        $this->contact[] = $contact;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->type))
            $arrayData["type"] = $this->type;
        if(isset($this->name))
            $arrayData["name"] = $this->name;
        foreach($this->contact as $contact)
            $arrayData["contact"] = $contact->toArray();
        return $arrayData;
    }
}