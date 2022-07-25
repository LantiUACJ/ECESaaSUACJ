<?php

namespace App\Fhir\Element;

class ContactDetail extends Element{

    public function __construct($name){
        parent::__construct();
        $this->telecom = [];
        $this->setName($name);
    }

    public function loadData($json){
        if(isset($json->name)){
            $this->name = $json->name;
        }
        if(isset($json->telecom)){
            $this->telecom[] = ContactPoint::Load($json->telecom);
        }
    }

    public static function Load($json){
        $contactdetail = new ContactDetail("");
        $contactdetail->loadData($json);
        return $contactdetail;
    }

    public function setName($name){
        $this->name = $name;
    }
    public function addTelecom(ContactPoint $telecom){
        $this->telecom[] = $telecom;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        $arrayData["name"] = $this->name;

        foreach($this->telecom as $telecom)
            $arrayData["telecom"][] = $telecom->toArray();
        return $arrayData;
    }
}