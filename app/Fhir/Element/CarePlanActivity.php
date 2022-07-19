<?php

namespace App\Fhir\Element;

class CarePlanActivity extends Element{
    
    public function __construct(){
        parent::__construct();
        $this->outcomeCodeableConcept = [];
        $this->outcomeReference = [];
        $this->progress = [];
        $this->reference = [];
    }

    private function loadData($json){
        if(isset($json->outcomeCodeableConcept)){
            foreach($json->outcomeCodeableConcept as $outcomeCodeableConcept)
                $this->outcomeCodeableConcept[] = CodeableConcept::Load($outcomeCodeableConcept);
        }
        if(isset($json->outcomeReference)){
            foreach($json->outcomeReference as $outcomeReference)
                $this->outcomeReference[] = Reference::Load($outcomeReference);
        }
        if(isset($json->progress)){
            foreach($json->progress as $progress)
                $this->progress[] = Annotation::Load($progress);
        }
        if(isset($json->reference)){
            $this->reference[] = Reference::Load($json->reference);
        }
        if(isset($json->detail)){
            $detail = [];
            if(isset($json->detail->kind)){
                $detail["kind"] = $json->detail->kind;
            }
            if(isset($json->detail->instantiatesCanonical)){
                foreach($json->detail->instantiatesCanonical as $instantiatesCanonical)
                    $detail["instantiatesCanonical"][] = Reference::Load($instantiatesCanonical);
            }
            if(isset($json->detail->instantiatesUri)){
                foreach($json->detail->instantiatesUri as $instantiatesUri)
                    $detail["instantiatesUri"][] = $instantiatesUri;
            }
            if(isset($json->detail->code)){
                $detail["code"] = CodeableConcept::Load($json->detail->code);
            }
            if(isset($json->detail->reasonCode)){
                foreach($json->detail->reasonCode as $reasonCode)
                    $detail["reasonCode"][] = CodeableConcept::Load($reasonCode);
            }
            if(isset($json->detail->reasonReference)){
                foreach($json->detail->reasonReference as $reasonReference)
                    $detail["reasonReference"][] = Reference::Load($reasonReference);
            }
            if(isset($json->detail->goal)){
                foreach($json->detail->goal as $goal)
                    $detail["goal"][] = Reference::Load($goal);
            }
            if(isset($json->detail->status)){
                $detail["status"] = $json->detail->status;
            }
            if(isset($json->detail->statusReason)){
                $detail["statusReason"] = CodeableConcept::Load($json->detail->statusReason);
            }
            if(isset($json->detail->doNotPerform)) {
                $detail["doNotPerform"] = $json->detail->doNotPerform;
            }
            if(isset($json->detail->scheduledTiming)){
                $detail["scheduledTiming"] = Timing::Load($json->detail->scheduledTiming);
            }
            if(isset($json->detail->scheduledPeriod)){
                $detail["scheduledPeriod"] = Period::Load($json->detail->scheduledPeriod);
            }
            if(isset($json->detail->scheduledString)){
                $detail["scheduledString"] = $json->detail->scheduledString;
            }
            if(isset($json->detail->location)){
                $detail["location"] = Reference::Load($json->detail->location);
            }
            if(isset($json->detail->performer)){
                foreach($json->detail->performer as $performer)
                    $detail["performer"][] = Reference::Load($performer);
            }
            if(isset($json->detail->productCodeableConcept)){
                $detail["productCodeableConcept"] = CodeableConcept::Load($json->detail->productCodeableConcept);
            }
            if(isset($json->detail->productReference)){
                $detail["productReference"] = Reference::Load($json->detail->productReference);
            }
            if(isset($json->detail->dailyAmount)){
                $detail["dailyAmount"] = Quantity::Load($json->detail->dailyAmount);
            }
            if(isset($json->detail->quantity)){
                $detail["quantity"] = Quantity::Load($json->detail->quantity);
            }
            if(isset($json->detail->description)){
                $detail["description"] = $json->detail->description;
            }
            $this->detail = $detail;
        }
    }

    public function addOutcomeCodeableConcept(CodeableConcept $outcomeCodeableConcept){
        $this->outcomeCodeableConcept[] = CodeableConcept::Load($outcomeCodeableConcept);
    }
    public function addOutcomeReference(Reference $outcomeReference){
        $this->outcomeReference[] = Reference::Load($outcomeReference);
    }
    public function addProgress(Annotation $progress){
        $this->progress[] = Annotation::Load($progress);
    }
    public function setReference(Reference $reference){
        $this->reference[] = Reference::Load($reference);
    }
    public function setKind($kind){
        $detail["kind"] = $kind;
    }
    public function setInstantiatesCanonical(Reference $instantiatesCanonical){
        $detail["instantiatesCanonical"][] = Reference::Load($instantiatesCanonical);
    }
    public function setInstantiatesUri($instantiatesUri){
        $detail["instantiatesUri"][] = $instantiatesUri;
    }
    public function setCode(CodeableConcept $code){
        $detail["code"] = CodeableConcept::Load($code);
    }
    public function setReasonCode(CodeableConcept $reasonCode){
        $detail["reasonCode"][] = CodeableConcept::Load($reasonCode);
    }
    public function setReasonReference(Reference $reasonReference){
        $detail["reasonReference"][] = Reference::Load($reasonReference);
    }
    public function setGoal(Reference $goal){
        $detail["goal"][] = Reference::Load($goal);
    }
    public function setStatus($status){
        $detail["status"] = $status;
    }
    public function setStatusReason(CodeableConcept $statusReason){
        $detail["statusReason"] = CodeableConcept::Load($statusReason);
    }
    public function setDoNotPerform($doNotPerform) {
        $detail["doNotPerform"] = $doNotPerform;
    }
    public function setScheduledTiming(Timing $scheduledTiming){
        $detail["scheduledTiming"] = Timing::Load($scheduledTiming);
    }
    public function setScheduledPeriod(Period $scheduledPeriod){
        $detail["scheduledPeriod"] = Period::Load($scheduledPeriod);
    }
    public function setScheduledString($scheduledString){
        $detail["scheduledString"] = $scheduledString;
    }
    public function setLocation(Reference $location){
        $detail["location"] = Reference::Load($location);
    }
    public function setPerformer(Reference $performer){
        $detail["performer"][] = Reference::Load($performer);
    }
    public function setProductCodeableConcept($productCodeableConcept){
        $detail["productCodeableConcept"] = CodeableConcept::Load($productCodeableConcept);
    }
    public function setProductReference(Reference $productReference){
        $detail["productReference"] = Reference::Load($productReference);
    }
    public function setDailyAmount($dailyAmount){
        $detail["dailyAmount"] = Quantity::Load($dailyAmount);
    }
    public function setQuantity(Quantity $quantity){
        $detail["quantity"] = Quantity::Load($quantity);
    }
    public function setDescription($description){
        $detail["description"] = $description;
    }

    public static function Load($json){
        $careplanactivity = new CarePlanActivity();
        $careplanactivity->loadData($json);
        return $careplanactivity;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->outcomeCodeableConcept)){
            foreach($this->outcomeCodeableConcept as $outcomeCodeableConcept)
                $arrayData["outcomeCodeableConcept"][] = CodeableConcept::Load($outcomeCodeableConcept);
        }
        if(isset($this->outcomeReference)){
            foreach($this->outcomeReference as $outcomeReference)
                $arrayData["outcomeReference"][] = Reference::Load($outcomeReference);
        }
        if(isset($this->progress)){
            foreach($this->progress as $progress)
                $arrayData["progress"][] = Annotation::Load($progress);
        }
        if(isset($this->reference)){
            $arrayData["reference"][] = Reference::Load($this->reference);
        }
        if(isset($this->detail)){
            $detail = [];
            if(isset($this->detail["kind"])){
                $detail["kind"] = $this->detail["kind"];
            }
            if(isset($this->detail["instantiatesCanonical"])){
                foreach($this->detail["instantiatesCanonical"] as $instantiatesCanonical)
                    $detail["instantiatesCanonical"][] = Reference::Load($instantiatesCanonical);
            }
            if(isset($this->detail["instantiatesUri"])){
                foreach($this->detail["instantiatesUri"] as $instantiatesUri)
                    $detail["instantiatesUri"][] = $instantiatesUri;
            }
            if(isset($this->detail["code"])){
                $detail["code"] = CodeableConcept::Load($this->detail["code"]);
            }
            if(isset($this->detail["reasonCode"])){
                foreach($this->detail["reasonCode"] as $reasonCode)
                    $detail["reasonCode"][] = CodeableConcept::Load($reasonCode);
            }
            if(isset($this->detail["reasonReference"])){
                foreach($this->detail["reasonReference"] as $reasonReference)
                    $detail["reasonReference"][] = Reference::Load($reasonReference);
            }
            if(isset($this->detail["goal"])){
                foreach($this->detail["goal"] as $goal)
                    $detail["goal"][] = Reference::Load($goal);
            }
            if(isset($this->detail["status"])){
                $detail["status"] = $this->detail["status"];
            }
            if(isset($this->detail["statusReason"])){
                $detail["statusReason"] = CodeableConcept::Load($this->detail["statusReason"]);
            }
            if(isset($this->detail["doNotPerform"])) {
                $detail["doNotPerform"] = $this->detail["doNotPerform"];
            }
            if(isset($this->detail["scheduledTiming"])){
                $detail["scheduledTiming"] = Timing::Load($this->detail["scheduledTiming"]);
            }
            if(isset($this->detail["scheduledPeriod"])){
                $detail["scheduledPeriod"] = Period::Load($this->detail["scheduledPeriod"]);
            }
            if(isset($this->detail["scheduledString"])){
                $detail["scheduledString"] = $this->detail["scheduledString"];
            }
            if(isset($this->detail["location"])){
                $detail["location"] = Reference::Load($this->detail["location"]);
            }
            if(isset($this->detail["performer"])){
                foreach($this->detail["performer"] as $performer)
                    $detail["performer"][] = Reference::Load($performer);
            }
            if(isset($this->detail["productCodeableConcept"])){
                $detail["productCodeableConcept"] = CodeableConcept::Load($this->detail["productCodeableConcept"]);
            }
            if(isset($this->detail["productReference"])){
                $detail["productReference"] = Reference::Load($this->detail["productReference"]);
            }
            if(isset($this->detail["dailyAmount"])){
                $detail["dailyAmount"] = Quantity::Load($this->detail["dailyAmount"]);
            }
            if(isset($this->detail["quantity"])){
                $detail["quantity"] = Quantity::Load($this->detail["quantity"]);
            }
            if(isset($this->detail["description"])){
                $detail["description"] = $this->detail["description"];
            }
            $arrayData["detail"] = $detail;
        }
        return $arrayData;
    }

}