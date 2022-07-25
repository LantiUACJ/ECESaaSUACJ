<?php

namespace App\Fhir\Element;

class SampleData extends Element{
    public function __construct(){
        parent::__construct();
    }

    private function loadData($json){
        if(isset($json->origin))
            $this->origin = $json->origin;
        if(isset($json->period))
            $this->period = $json->period;
        if(isset($json->factor))
            $this->factor = $json->factor;
        if(isset($json->lowerLimit))
            $this->lowerLimit = $json->lowerLimit;
        if(isset($json->upperLimit))
            $this->upperLimit = $json->upperLimit;
        if(isset($json->dimensions))
            $this->dimensions = $json->dimensions;
        if(isset($json->data))
            $this->data = $json->data;
    }
    
    public static function Load($json){
        $sampleData = new SampleData();
        $sampleData->loadData($json);
        return $sampleData;
    }


    public function setOrigin($origin){
        $this->origin = $origin;
    }
    public function setPeriod($period){
        $this->period = $period;
    }
    public function setFactor($factor){
        $this->factor = $factor;
    }
    public function setLowerLimit($lowerLimit){
        $this->lowerLimit = $lowerLimit;
    }
    public function setUpperLimit($upperLimit){
        $this->upperLimit = $upperLimit;
    }
    public function setDimensions($dimensions){
        $this->dimensions = $dimensions;
    }
    public function setData($data){
        $this->data = $data;
    }


    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->origin))
            $arrayData["origin"] = $this->origin;
        if(isset($this->period))
            $arrayData["period"] = $this->period;
        if(isset($this->factor))
            $arrayData["factor"] = $this->factor;
        if(isset($this->lowerLimit))
            $arrayData["lowerLimit"] = $this->lowerLimit;
        if(isset($this->upperLimit))
            $arrayData["upperLimit"] = $this->upperLimit;
        if(isset($this->dimensions))
            $arrayData["dimensions"] = $this->dimensions;
        if(isset($this->data))
            $arrayData["data"] = $this->data;
        return $arrayData;
    }
}
