<?php

namespace App\Fhir\Element;

use App\Fhir\Resource\Resource;

class CarePlanActivity extends Element{
    
    public function __construct(){
        parent::__construct();
        $this->outcomeCodeableConcept = [];
        $this->outcomeReference = [];
        $this->progress = [];
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
            $this->reference = Reference::Load($json->reference);
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

    /* opcional (fhir) */
    public function addOutcomeCodeableConcept(CodeableConcept $outcomeCodeableConcept){
        $this->outcomeCodeableConcept[] = $outcomeCodeableConcept;
    }
    /* opcional (fhir) */
    public function addOutcomeReference(Resource $outcomeReference){
        $this->outcomeReference[] = $outcomeReference->toReference();
    }
    /* opcional (fhir) */
    public function addProgress(Annotation $progress){
        $this->progress[] = $progress;
    }
    /* 
        opcional (fhir)
        obligatorio (estandar)  1..*
    */
    public function addReference(Resource $reference){
        $this->reference[] = $reference->toReference();
    }
    /* opcional (fhir) */
    public function setKind($kind){
        $detail["kind"] = $kind;
    }
    /* opcional (fhir) */
    public function addInstantiatesCanonical(Resource $instantiatesCanonical){
        $detail["instantiatesCanonical"][] = $instantiatesCanonical->toReference();
    }
    /* opcional (fhir) */
    public function addInstantiatesUri($instantiatesUri){
        $detail["instantiatesUri"][] = $instantiatesUri;
    }
    /* opcional (fhir) */
    public function setCode(CodeableConcept $code){
        $detail["code"] = $code;
    }
    /* opcional (fhir) */
    public function addReasonCode(CodeableConcept $reasonCode){
        $detail["reasonCode"][] = $reasonCode;
    }
    /* opcional (fhir) */
    public function addReasonReference(Resource $reasonReference){
        $detail["reasonReference"][] = $reasonReference->toReference();
    }
    /* opcional (fhir) */
    public function addGoal(Resource $goal){
        $detail["goal"][] = $goal->toReference();
    }
    /* opcional (fhir) */
    public function setStatus($status){
        $detail["status"] = $status;
    }
    /* opcional (fhir) */
    public function setStatusReason(CodeableConcept $statusReason){
        $detail["statusReason"] = $statusReason;
    }
    /* opcional (fhir) */
    public function setDoNotPerform($doNotPerform) {
        $detail["doNotPerform"] = $doNotPerform;
    }
    /* opcional (fhir) */
    public function setScheduledTiming(Timing $scheduledTiming){
        $detail["scheduledTiming"] = $scheduledTiming;
    }
    /* opcional (fhir) */
    public function setScheduledPeriod(Period $scheduledPeriod){
        $detail["scheduledPeriod"] = $scheduledPeriod;
    }
    /* opcional (fhir) */
    public function setScheduledString($scheduledString){
        $detail["scheduledString"] = $scheduledString;
    }
    /* opcional (fhir) */
    public function setLocation(Resource $location){
        $detail["location"] = $location->toReference();
    }
    /* opcional (fhir) */
    public function addPerformer(Resource $performer){
        $detail["performer"][] = $performer->toReference();
    }
    /* opcional (fhir) */
    public function setProductCodeableConcept($productCodeableConcept){
        $detail["productCodeableConcept"] = $productCodeableConcept;
    }
    /* opcional (fhir) */
    public function setProductReference(Resource $productReference){
        $detail["productReference"] = $productReference->toReference();
    }
    /* opcional (fhir) */
    public function setDailyAmount($dailyAmount){
        $detail["dailyAmount"] = $dailyAmount;
    }
    /* opcional (fhir) */
    public function setQuantity(Quantity $quantity){
        $detail["quantity"] = $quantity;
    }
    /* opcional (fhir) */
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
                $arrayData["outcomeCodeableConcept"][] = $outcomeCodeableConcept->toArray();
        }
        if(isset($this->outcomeReference)){
            foreach($this->outcomeReference as $outcomeReference)
                $arrayData["outcomeReference"][] = $outcomeReference->toArray();
        }
        if(isset($this->progress)){
            foreach($this->progress as $progress)
                $arrayData["progress"][] = $progress->toArray();
        }
        if(isset($this->reference)){
            $arrayData["reference"][] = $this->reference->toArray();
        }
        if(isset($this->detail)){
            $detail = [];
            if(isset($this->detail["kind"])){
                $detail["kind"] = $this->detail["kind"];
            }
            if(isset($this->detail["instantiatesCanonical"])){
                foreach($this->detail["instantiatesCanonical"] as $instantiatesCanonical)
                    $detail["instantiatesCanonical"][] = $instantiatesCanonical->toArray();
            }
            if(isset($this->detail["instantiatesUri"])){
                foreach($this->detail["instantiatesUri"] as $instantiatesUri)
                    $detail["instantiatesUri"][] = $instantiatesUri;
            }
            if(isset($this->detail["code"])){
                $detail["code"] = $this->detail["code"]->toArray();
            }
            if(isset($this->detail["reasonCode"])){
                foreach($this->detail["reasonCode"] as $reasonCode)
                    $detail["reasonCode"][] = $reasonCode->toArray();
            }
            if(isset($this->detail["reasonReference"])){
                foreach($this->detail["reasonReference"] as $reasonReference)
                    $detail["reasonReference"][] = $reasonReference->toArray();
            }
            if(isset($this->detail["goal"])){
                foreach($this->detail["goal"] as $goal)
                    $detail["goal"][] = $goal->toArray();
            }
            if(isset($this->detail["status"])){
                $detail["status"] = $this->detail["status"];
            }
            if(isset($this->detail["statusReason"])){
                $detail["statusReason"] = $this->detail["statusReason"]->toArray();
            }
            if(isset($this->detail["doNotPerform"])) {
                $detail["doNotPerform"] = $this->detail["doNotPerform"];
            }
            if(isset($this->detail["scheduledTiming"])){
                $detail["scheduledTiming"] = $this->detail["scheduledTiming"]->toArray();
            }
            if(isset($this->detail["scheduledPeriod"])){
                $detail["scheduledPeriod"] = $this->detail["scheduledPeriod"]->toArray();
            }
            if(isset($this->detail["scheduledString"])){
                $detail["scheduledString"] = $this->detail["scheduledString"];
            }
            if(isset($this->detail["location"])){
                $detail["location"] = $this->detail["location"]->toArray();
            }
            if(isset($this->detail["performer"])){
                foreach($this->detail["performer"] as $performer)
                    $detail["performer"][] = $performer->toArray();
            }
            if(isset($this->detail["productCodeableConcept"])){
                $detail["productCodeableConcept"] = $this->detail["productCodeableConcept"]->toArray();
            }
            if(isset($this->detail["productReference"])){
                $detail["productReference"] = $this->detail["productReference"]->toArray();
            }
            if(isset($this->detail["dailyAmount"])){
                $detail["dailyAmount"] = $this->detail["dailyAmount"]->toArray();
            }
            if(isset($this->detail["quantity"])){
                $detail["quantity"] = $this->detail["quantity"]->toArray();
            }
            if(isset($this->detail["description"])){
                $detail["description"] = $this->detail["description"];
            }
            $arrayData["detail"] = $detail;
        }
        return $arrayData;
    }

}