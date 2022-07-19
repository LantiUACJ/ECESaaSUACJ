<?php

namespace App\Fhir\Element;

use App\Fhir\Exception\TextNotDefinedException;

class Address extends Element{
    public function __construct(){
        parent::__construct();
        $this->line = [];
    }

    private function loadData($json){
        if(isset($json->use))
            $this->use = $json->use;
        if(isset($json->code))
            $this->code = $json->code;
        if(isset($json->type))
            $this->type = $json->type;
        if(isset($json->text))
            $this->text = $json->text;
        if(isset($json->line))
            foreach($json->line as $line)
                $this->line[] = $line;
        if(isset($json->city))
            $this->city = $json->city;
        if(isset($json->district))
            $this->district = $json->district;
        if(isset($json->state))
            $this->state = $json->state;
        if(isset($json->postalCode))
            $this->postalCode = $json->postalCode;
        if(isset($json->country))
            $this->country = $json->country;
        if(isset($json->period))
            $this->period = Period::Load($json->period);
    }
    public static function Load($json){
        $address = new Address();
        $address->loadData($json);
        return $address;
    }
    public function setUse($use){
        $this->use = "";
        $uses = ["home", "work", "temp", "old", "billing"];
        foreach($uses as $code){
            if($code == strtolower($use)){
                $this->use = $code;
            }
        }
        if(!$this->use){
			throw new TextNotDefinedException("USE", implode(", ",$uses));
        }
    }
    public function setType($type){
        $types = ["postal", "physical", "both"];
        $this->type = "";
        foreach($types as $code){
            if($code == strtolower($type)){
                $this->type = $type;
            }
        }
        if(!$this->type){
			throw new TextNotDefinedException("USE", implode(", ",$types));
        }
        
    }
    public function setText($text){
        $this->text = $text;
    }
    public function addLine($line){
        $this->line[] = $line;
    }
    public function setCity($city){
        $this->city = $city;
    }
    public function setDistrict($district){
        $this->district = $district;
    }
    public function setState($state){
        $this->state = $state;
    }
    public function setPostalCode($postalCode){
        $this->postalCode = $postalCode;
    }
    public function setCountry($country){
        $this->country = $country;
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function toArray(){
        $arrayData = parent::toArray();

        if(isset($this->use))
            $arrayData["use"] = $this->use;
        if(isset($this->code))
            $arrayData["code"] = $this->code;
        if(isset($this->type))
            $arrayData["type"] = $this->type;
        if(isset($this->text))
            $arrayData["text"] = $this->text;
        if(isset($this->line))
            foreach($this->line as $line)
                $arrayData["line"][] = $line;
        if(isset($this->city))
            $arrayData["city"] = $this->city;
        if(isset($this->district))
            $arrayData["district"] = $this->district;
        if(isset($this->state))
            $arrayData["state"] = $this->state;
        if(isset($this->postalCode))
            $arrayData["postalCode"] = $this->postalCode;
        if(isset($this->country))
            $arrayData["country"] = $this->country;
        if(isset($this->period))
            $arrayData["period"] = $this->period->toArray();
        return $arrayData;
    }
}
