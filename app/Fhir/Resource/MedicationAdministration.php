<?php

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Ratio;
use App\Fhir\Element\Reference;

class MedicationAdministration extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "MedicationAdministration";
        parent::__construct($json);
        $this->identifier = [];
        $this->instantiates = [];
        $this->partOf = [];
        $this->statusReason = [];
        $this->performer = [];
        $this->reasonCode = [];
        $this->reasonReference = [];
        $this->device = [];
        $this->note = [];
        $this->eventHistory = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if(isset($json->instantiates))
            foreach($json->instantiates as $instantiates)
                $this->instantiates[] = $instantiates;
        if(isset($json->partOf))
            foreach($json->partOf as $partOf)
                $this->partOf[] = Reference::Load($partOf);
        if(isset($json->status))
            $this->status = $json->status;
        if(isset($json->statusReason))
            foreach($json->statusReason as $statusReason)
                $this->statusReason[] = CodeableConcept::Load($statusReason);
        if(isset($json->category))
            $this->category = CodeableConcept::Load($json->category);
        if(isset($json->medicationCodeableConcept))
            $this->medicationCodeableConcept = $json->medicationCodeableConcept;
        if(isset($json->medicationReference))
            $this->medicationReference = CodeableConcept::Load($json->medicationReference);
        if(isset($json->subject))
            $this->subject = Reference::Load($json->subject);
        if(isset($json->context))
            $this->context = Reference::Load($json->context);
        if(isset($json->supportingInformation))
            $this->supportingInformation = Reference::Load($json->supportingInformation);
        if(isset($json->effectiveDateTime))
            $this->effectiveDateTime = $json->effectiveDateTime;
        if(isset($json->effectivePeriod))
            $this->effectivePeriod = Period::Load($json->effectivePeriod);
        if(isset($json->performer))
            foreach($json->performer as $performer){
                $data = [];
                if(isset($performer->performer))
                    $data["performer"] = $performer->performer;
                if(isset($performer->actor))
                    $data["actor"] = $performer->actor;
                $this->performer[] = $data;
            }
        if(isset($json->reasonCode))
            foreach($json->reasonCode as $reasonCode)
                $this->reasonCode[] = Reference::Load($reasonCode);
        if(isset($json->reasonReference))
            foreach($json->reasonReference as $reasonReference)
                $this->reasonReference[] = Reference::Load($reasonReference);
        if(isset($json->request))
            $this->request = Reference::Load($json->request);
        if(isset($json->device))
            foreach($json->device as $device)
                $this->device[] = Reference::Load($device);
        if(isset($json->note))
            foreach($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if(isset($json->dosage)){
            if(isset($json->dosage->text))
                $this->dosage["text"] = $json->dosage->text;
            if(isset($json->dosage->site))
                $this->dosage["site"] = CodeableConcept::Load($json->dosage->site);
            if(isset($json->dosage->route))
                $this->dosage["route"] = CodeableConcept::Load($json->dosage->route);
            if(isset($json->dosage->method))
                $this->dosage["method"] = CodeableConcept::Load($json->dosage->method);
            if(isset($json->dosage->dose))
                $this->dosage["dose"] = Quantity::Load($json->dosage->dose);
            if(isset($json->dosage->rateRatio))
                $this->dosage["rateRatio"] = Ratio::Load($json->dosage->rateRatio);
            if(isset($json->dosage->rateQuantity))
                $this->dosage["rateQuantity"] = Quantity::Load($json->dosage->rateQuantity);
        }
        if(isset($json->eventHistory))
            foreach($json->eventHistory as $eventHistory)
                $this->eventHistory[] = Reference::Load($eventHistory);
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function addInstantiates($instantiates){
        $this->instantiates[] = $instantiates;
    }
    public function addPartOf(Resource $partOf){
        $this->partOf[] = $partOf->toReference();
    }
    public function setStatus($status){
        $only = ["in-progress", "not-done", "on-hold", "completed", "entered-in-error", "stopped", "unknown"];
        $this->status = $status;
    }
    public function addStatusReason(CodeableConcept $statusReason){
        $this->statusReason[] = $statusReason;
    }
    public function setCategory(CodeableConcept $category){
        $this->category = $category;
    }
    public function setMedicationCodeableConcept(CodeableConcept $medicationCodeableConcept){
        $this->medicationCodeableConcept = $medicationCodeableConcept;
    }
    public function setMedicationReference(Resource $medicationReference){
        $this->medicationReference = $medicationReference->toReference();
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setContext(Resource $context){
        $this->context = $context->toReference();
    }
    public function setSupportingInformation(Resource $supportingInformation){
        $this->supportingInformation = $supportingInformation->toReference();
    }
    public function setEffectiveDateTime($effectiveDateTime){
        $this->effectiveDateTime = $effectiveDateTime;
    }
    public function setEffectivePeriod(Period $effectivePeriod){
        $this->effectivePeriod = $effectivePeriod;
    }
    public function addPerformer(CodeableConcept $performer, Resource $actor){
        $this->performer[] = [
            "performer"=> $performer,
            "actor"=>$actor->toReference()
        ];
    }
    public function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    public function addReasonReference(Resource $reasonReference){
        $this->reasonReference[] = $reasonReference->toReference();
    }
    public function setRequest(Resource $request){
        $this->request = $request->toReference();
    }
    public function addDevice(Resource $device){
        $this->device[] = $device->toReference();
    }
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    public function setDosage($text, CodeableConcept $site, CodeableConcept $route, CodeableConcept $method, Quantity $dose, Ratio $rateRatio, Quantity $rateQuantity){
        $this->dosage["text"] = $text;
        $this->dosage["site"] = $site;
        $this->dosage["route"] = $route;
        $this->dosage["method"] = $method;
        $this->dosage["dose"] = $dose;
        $this->dosage["rateRatio"] = $rateRatio;
        $this->dosage["rateQuantity"] = $rateQuantity;
    }
    public function addEventHistory(Resource $eventHistory){
        $this->eventHistory[] = $eventHistory->toReference();
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->identifier) && $this->identifier)
            foreach($this->identifier as $identifier)
                $arrayData["identifier"] = $identifier->toArray();
        if(isset($this->instantiates))
            foreach($this->instantiates as $instantiates)
                $arrayData["instantiates"][] = $instantiates;
        if(isset($this->partOf))
            foreach($this->partOf as $partOf)
                $arrayData["partOf"][] = $partOf->toArray();
        if(isset($this->status))
            $arrayData["status"] = $this->status;
        if(isset($this->statusReason))
            foreach($this->statusReason as $statusReason)
                $arrayData["statusReason"][] = $statusReason->toArray();
        if(isset($this->category))
            $arrayData["category"] = $this->category->toArray();
        if(isset($this->medicationCodeableConcept))
            $arrayData["medicationCodeableConcept"] = $this->medicationCodeableConcept;
        if(isset($this->medicationReference))
            $arrayData["medicationReference"] = $this->medicationReference->toArray();
        if(isset($this->subject))
            $arrayData["subject"] = $this->subject->toArray();
        if(isset($this->context))
            $arrayData["context"] = $this->context->toArray();
        if(isset($this->supportingInformation))
            $arrayData["supportingInformation"] = $this->supportingInformation->toArray();
        if(isset($this->effectiveDateTime))
            $arrayData["effectiveDateTime"] = $this->effectiveDateTime;
        if(isset($this->effectivePeriod))
            $arrayData["effectivePeriod"] = $this->effectivePeriod->toArray();
        if(isset($this->performer)){
            $arrayData["performer"] = [];
            foreach($this->performer as $performer){
                $data = [];
                if(isset($performer->performer))
                    $data["performer"] = $performer["performer"]->toArray();
                if(isset($performer->actor))
                    $data["actor"] = $performer["actor"]->toArray();
                $arrayData["performer"][] = $data;
            }
        }
        if(isset($this->reasonCode))
            foreach($this->reasonCode as $reasonCode)
                $arrayData["reasonCode"][] = $reasonCode->toArray();
        if(isset($this->reasonReference))
            foreach($this->reasonReference as $reasonReference)
                $arrayData["reasonReference"][] = $reasonReference->toArray();
        if(isset($this->request))
            $arrayData["request"] = $this->request->toArray();
        if(isset($this->device))
            foreach($this->device as $device)
                $arrayData["device"][] = $device->toArray();
        if(isset($this->note))
            foreach($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        if(isset($this->dosage)){
            $arrayData["dosage"] = [];
            if(isset($this->dosage["text"])){
                $arrayData["dosage"]["text"] = $this->dosage["text"];
            }    
            if(isset($this->dosage["site"])){
                $arrayData["dosage"]["site"] = $this->dosage["site"]->toArray();
            }
            if(isset($this->dosage["route"])){
                $arrayData["dosage"]["route"] = $this->dosage["route"]->toArray();
            }
            if(isset($this->dosage["method"])){
                $arrayData["dosage"]["method"] = $this->dosage["method"]->toArray();
            }
            if(isset($this->dosage["dose"])){
                $arrayData["dosage"]["dose"] = $this->dosage["dose"]->toArray();
            }
            if(isset($this->dosage["rateRatio"])){
                $arrayData["dosage"]["rateRatio"] = $this->dosage["rateRatio"]->toArray();
            }
            if(isset($this->dosage["rateQuantity"])){
                $arrayData["dosage"]["rateQuantity"] = $this->dosage["rateQuantity"]->toArray();
            }
        }
        if(isset($this->eventHistory))
            foreach($this->eventHistory as $eventHistory)
                $arrayData["eventHistory"][] = $eventHistory->toArray();
        return $arrayData;
    }

}