<?php
namespace App\Fhir\Element;

class CodeableConcept extends Element{

    public function __construct($text, Coding $coding = null){
        parent::__construct();
        $this->coding = [];
        $this->setText($text);
        if($coding) $this->addCoding($coding);
    }
    private function loadData($json){
        if(isset($json->text)) $this->setText($json->text);
        if(isset($json->coding)) 
            foreach($json->coding as $coding)
                $this->addCoding(Coding::Load($coding));
    }
    public static function Load($json){
        $codeableConcept = new CodeableConcept("");
        $codeableConcept->loadData($json);
        return $codeableConcept;
    }
    public function addCoding(Coding $coding){
        $this->coding[] = $coding;
    }
    public function setText($text){
        $this->text = $text;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->text) && $this->text)
            $arrayData["text"] = $this->text;
        if($this->coding){
            foreach($this->coding as $coding)
                $arrayData["coding"][] = $coding->toArray();
        }
        return $arrayData;
    }
}