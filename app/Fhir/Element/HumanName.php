<?php 
namespace App\Fhir\Element;
class HumanName extends Element{

    public function __construct($name) {
        parent::__construct();
        $this->setText($name);
    }

    public function loadData($json){
        if(isset($json->text)){
            $this->text = $json->text;
        }
        if(isset($json->use)){
            $this->use = $json->use;
        }
        if(isset($json->period)){
            $this->period = $json->period;
        }
        if(isset($json->prefix)){
            $this->prefix = $json->prefix;
        }
        if(isset($json->given)){
            $this->given = $json->given;
        }
        if(isset($json->family)){
            $this->family = $json->family;
        }
        if(isset($json->suffix)){
            $this->suffix = $json->suffix;
        }
    }

    public static function Load($json){
        $humanname = new HumanName("");
        $humanname->loadData($json);
        return $humanname;
    }

    public function setText($text){
        $this->text = $text;
    }
    public function setUse($use){
        $data = ["usual","official","temp","nickname","anonymous","old","maiden"];
        $this->use = $use;
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function addPrefix($prefix){
        $this->prefix [] = $prefix;
    }
    public function addGiven($given){
        $this->given[] = $given;
    }
    public function setFamily($family){
        $this->family = $family;
    }
    public function addSuffix($suffix){
        $this->suffix[] = $suffix;
    }

    public function toString(){
        $name = "";
        if($this->text){
            $name .= $this->text . " ";
        }
        if(isset($this->given) && !$this->text){
            foreach($this->given as $given)
                $name .= $given . " ";
        }
        if(isset($this->family) && !$this->text){
            $name .= $this->family . " ";
        }
        return $name;
    }

    public function toArray(){
        $arrayData = parent::toArray();

        if(isset($this->text) && $this->text){
            $arrayData["text"] = $this->text;
        }
        if(isset($this->use)){
            $arrayData["use"] = $this->use;
        }
        if(isset($this->period)){
            $arrayData["period"] = $this->period->toArray();
        }
        if(isset($this->prefix)){
            $arrayData["prefix"] = $this->prefix;
        }
        if(isset($this->given)){
            $arrayData["given"] = $this->given;
        }
        if(isset($this->family)){
            $arrayData["family"] = $this->family;
        }
        if(isset($this->suffix)){
            $arrayData["suffix"] = $this->suffix;
        }
        return $arrayData;
    }
}
