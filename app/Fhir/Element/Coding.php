<?php
namespace App\Fhir\Element;
class Coding extends Element{
    public function __construct($display, $code, $system = ""){
        parent::__construct();
        $this->setDisplay($display);
        $this->setCode($code);
        $this->setSystem($system);
    }
    public function loadData($json){
        if(isset($json->display)) $this->setDisplay($json->display);
        if(isset($json->system)) $this->setSystem($json->system);
        if(isset($json->version)) $this->setVersion($json->version);
        if(isset($json->code)) $this->setCode($json->code);
        if(isset($json->userSelected)) $this->setUserSelected($json->userSelected);
    }
    public static function Load($json){
        $coding = new Coding("", "");
        $coding->loadData($json);
        return $coding;
    }
    function setDisplay($display){
        $this->display = $display;
    }
    function setSystem($system){
        $this->system = $system;
    }
    function setVersion($version){
        $this->version = $version;
    }
    function setCode($code){
        $this->code = $code;
    }
    function setUserSelected($userSelected){
        $this->userSelected = $userSelected;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->display) && $this->display) 
            $arrayData["display"] = $this->display;
        if(isset($this->code) && $this->code) 
            $arrayData["code"] = $this->code;
        if(isset($this->system)) $arrayData["system"] = $this->system;
        if(isset($this->version)) $arrayData["version"] = $this->version;
        if(isset($this->userSelected)) $arrayData["userSelected"] = $this->userSelected;
        return $arrayData;
    }
}
