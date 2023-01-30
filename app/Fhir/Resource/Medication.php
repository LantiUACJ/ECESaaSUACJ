<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Identifier;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Reference;
use App\Fhir\Element\Ratio;

class Medication extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Medication";
        parent::__construct($json);
        $this->identifier = [];
        $this->ingredient = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier)){
            foreach($json->identifier as $identifier){
                $this->identifier[] = Identifier::Load($identifier);
            }
        }
        if(isset($json->code)){
            $this->code = CodeableConcept::Load($json->code);
        }
        if(isset($json->status)){
            $this->status = $json->status;
        }
        if(isset($json->manufacturer)){
            $this->manufacturer = Reference::Load($json->manufacturer);
        }
        if(isset($json->form)){
            $this->form = $json->form;
        }
        if(isset($json->amount)){
            $this->amount = Ratio::Load($json->amount);
        }
        if(isset($json->ingredient)){
            foreach($json->ingredient as $ingredient){
                $data = [];
                if(isset($ingredient->itemCodeableConcept))
                    $data["itemCodeableConcept"] = $ingredient->itemCodeableConcept;
                if(isset($ingredient->itemReference))
                    $data["itemReference"] = $ingredient->itemReference;
                if(isset($ingredient->isActive))
                    $data["isActive"] = $ingredient->isActive;
                if(isset($ingredient->strength))
                    $data["strength"] = $ingredient->strength;
                $this->ingredient[] = $data;
            }
        }
        if(isset($json->batch)){
            $data = [];
            if(isset($json->batch->lotNumber))
                $data["lotNumber"] = $json->batch->lotNumber;
            if(isset($json->batch->expirationDate))
                $data["expirationDate"] = $json->batch->expirationDate;
            $this->batch = $data;
        }
    }
    /* Campo obligatorio (estandar) */
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    /* campo obligatorio (estandar) (array 1..*):
        \Fhir\Element\CodeableConcept:    
            "coding": \Fhir\Element\Coding (array 1..*):
                "code"
                "system": "urn:MEDICAMENTOS_ENERO_2022",
                "display"
            "text"
    */
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    /* Campo opcional */
    public function setStatus($status){
        $only = ["registered", "inactive", "entered-in-error"];
        $this->status = $status;
    }
    /* Campo opcional */
    public function setManufacturer(Resource $manufacturer){
        $this->manufacturer = $manufacturer->toReference();
    }
    /* Campo opcional */
    public function setForm(CodeableConcept $form){
        $this->form = $form;
    }
    /* Campo opcional */
    public function setAmount(Ratio $amount){
        $this->amount = $amount;
    }
    /* Campo opcional */
    public function addIngredient(CodeableConcept $itemCodeableConcept, Resource $itemReference, $isActive, Ratio $strength){
        $ingredient = [
            "itemCodeableConcept"=>$itemCodeableConcept,
            "itemReference"=>$itemReference->toReference(),
            "isActive"=>$isActive,
            "strength"=>$strength,
        ];
        $this->ingredient[] = $ingredient;
    }
    /* Campo opcional */
    public function setBatch($lotNumber, $expirationDate){
        $this->batch = [
            "lotNumber"=>$lotNumber,
            "expirationDate"=>$expirationDate,
        ];
    }
    public function toArray(){
        $arrayData = parent::toArray();
        

        if(isset($this->identifier) && $this->identifier){
            foreach($this->identifier as $identifier){
                $arrayData["identifier"][] = $identifier->toArray();
            }
        }
        if(isset($this->code)){
            $arrayData["code"] = $this->code->toArray();
        }
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        if(isset($this->manufacturer)){
            $arrayData["manufacturer"] = $this->manufacturer->toArray();
        }
        if(isset($this->form)){
            $arrayData["form"] = $this->form;
        }
        if(isset($this->amount)){
            $arrayData["amount"] = $this->amount->toArray();
        }
        foreach($this->ingredient as $ingredient){
            $data = [];
            if(isset($ingredient["itemCodeableConcept"]))
                $data["itemCodeableConcept"] = $ingredient["itemCodeableConcept"];
            if(isset($ingredient["itemReference"]))
                $data["itemReference"] = $ingredient["itemReference"];
            if(isset($ingredient["isActive"]))
                $data["isActive"] = $ingredient["isActive"];
            if(isset($ingredient["strength"]))
                $data["strength"] = $ingredient["strength"];
            $arrayData["ingredient"] = $data;
        }
        if(isset($this->batch)){
            $data = [];
            if(isset($this->batch["lotNumber"]))
                $data["lotNumber"] = $this->batch["lotNumber"];
            if(isset($this->batch["expirationDate"]))
                $data["expirationDate"] = $this->batch["expirationDate"];
            $arrayData["batch"] = $data;
        }
        return $arrayData;
    }
}