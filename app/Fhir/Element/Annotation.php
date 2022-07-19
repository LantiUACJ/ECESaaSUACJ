<?php

namespace App\Fhir\Element;

use App\Fhir\Resource\Resource;

class Annotation extends Element{
    public function __construct(){
        parent::__construct();
    }

    private function loadData($json){
        if(isset($json->authorReference))
            $this->authorReference = Reference::Load($json->authorReference);
        if(isset($json->authorString))
            $this->authorString = $json->authorString;
        if(isset($json->time))
            $this->time = $json->time;
        if(isset($json->text))
            $this->text = $json->text;
    }
    public static function Load($json){
        $annotation = new Annotation();
        $annotation->loadData($json);
        return $annotation;
    }
    public function setAuthorReference(Resource $authorReference){
        $this->authorReference = $authorReference->toReference();
    }
    public function setAuthorString($authorString){
        $this->authorString = $authorString;
    }
    public function setTime($time){
        $this->time = $time;
    }
    public function setText($text){
        $this->text = $text;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->authorReference))
            $arrayData["authorReference"] = $this->authorReference->toArray();
        if(isset($this->authorString))
            $arrayData["authorString"] = $this->authorString;
        if(isset($this->time))
            $arrayData["time"] = $this->time;
        if(isset($this->text))
            $arrayData["text"] = $this->text;
        return $arrayData;
    }
}
