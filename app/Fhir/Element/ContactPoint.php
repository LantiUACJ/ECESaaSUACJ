<?php

namespace App\Fhir\Element;

class ContactPoint extends Element{

    public function __construct(){
        parent::__construct();
    }
    public function loadData($json){        
        if(isset($json->system))
            $this->system = $json->system;
        if(isset($json->value))
            $this->value = $json->value;
        if(isset($json->use))
            $this->use = $json->use;
        if(isset($json->rank))
            $this->rank = $json->rank;
        if(isset($json->period))
            $this->period = $json->period;
    }
    public static function Load($json){
        $contactPoint = new ContactPoint();
        $contactPoint->loadData($json);
        return $contactPoint;
    }
    public function setSystem($system){
        $systems = ["phone","fax","email","pager","url","sms","other"];
        $this->system = $system;
    }
    public function setValue($value){
        $this->value = $value;
    }
    public function setUse($use){
        $uses = ["home","work","temp","old","mobile"];
        $this->use = $use;
    }
    public function setRank($rank){
        $this->rank = $rank;
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->system))
            $arrayData["system"] = $this->system;
        if(isset($this->value))
            $arrayData["value"] = $this->value;
        if(isset($this->use))
            $arrayData["use"] = $this->use;
        if(isset($this->rank))
            $arrayData["rank"] = $this->rank;
        if(isset($this->period))
            $arrayData["period"] = $this->period;
        return $arrayData;
    }
}
