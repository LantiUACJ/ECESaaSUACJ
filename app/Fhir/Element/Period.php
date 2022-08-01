<?php

namespace App\Fhir\Element;

class Period extends Element{

    public function __construct($start, $end){
        parent::__construct();
        $this->setStart($start);
        $this->setEnd($end);
    }

    private function loadData($json){
        if(isset($json->start)) $this->setStart($json->start);
        if(isset($json->end)) $this->setEnd($json->end);
    }

    public static function Load($json){
        $period = new Period("","");
        $period->loadData($json);
        return $period;
    }

    public function setStart($start){
        $this->start = $start;
    }
    public function setEnd($end){
        $this->end = $end;
    }
    public function toString(){
        $texto = "";
        if($this->start) $texto .= $this->start;
        if($this->start && $this->end) $texto .= " - ";
        if($this->end) $texto .= $this->end;
        return $texto;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if($this->start)
            $arrayData["start"] = $this->start; 
        if($this->end)
            $arrayData["end"] = $this->end; 
        
        return $arrayData;
    }

}
