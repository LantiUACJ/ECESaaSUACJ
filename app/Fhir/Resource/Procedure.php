<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Range;
use App\Fhir\Element\Reference;

class Procedure extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Procedure";
        parent::__construct($json);
        $this->identifier = [];
        $this->instantiatesCanonical = [];
        $this->instantiatesUri = [];
        $this->basedOn = [];
        $this->partOf = [];
        $this->performer = [];
        $this->reasonCode = [];
        $this->reasonReference = [];
        $this->bodySite = [];
        $this->report = [];
        $this->complication = [];
        $this->complicationDetail = [];
        $this->followUp = [];
        $this->note = [];
        $this->focalDevice = [];
        $this->usedReference = [];
        $this->usedCode = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if(isset($json->instantiatesCanonical))
            foreach($json->instantiatesCanonical as $instantiatesCanonical)
                $this->instantiatesCanonical[] = $instantiatesCanonical;
        if(isset($json->instantiatesUri))
            foreach($json->instantiatesUri as $instantiatesUri)
                $this->instantiatesUri[] = $instantiatesUri;
        if(isset($json->basedOn))
            foreach($json->basedOn as $basedOn)
                $this->basedOn[] = Reference::Load($basedOn);
        if(isset($json->partOf))
            foreach($json->partOf as $partOf)
                $this->partOf[] = Reference::Load($partOf);
        if(isset($json->status))
            $this->status = $json->status;
        if(isset($json->statusReason))
            $this->statusReason = CodeableConcept::Load($json->statusReason);
        if(isset($json->category))
            $this->category = CodeableConcept::Load($json->category);
        if(isset($json->code))
            $this->code = CodeableConcept::Load($json->code);
        if(isset($json->subject))
            $this->subject = Reference::Load($json->subject);
        if(isset($json->encounter))
            $this->encounter = Reference::Load($json->encounter);
        if(isset($json->performedDateTime))
            $this->performedDateTime = $json->performedDateTime;
        if(isset($json->performedPeriod))
            $this->performedPeriod = Period::Load($json->performedPeriod);
        if(isset($json->performedString))
            $this->performedString = $json->performedString;
        if(isset($json->performedAge))
            $this->performedAge = Quantity::Load($json->performedAge);
        if(isset($json->performedRange))
            $this->performedRange = Range::Load($json->performedRange);
        if(isset($json->recorder))
            $this->recorder = Reference::Load($json->recorder);
        if(isset($json->asserter))
            $this->asserter = Reference::Load($json->asserter);
        if(isset($json->performer))
            foreach($json->performer as $performer){
                $data = [];
                if(isset($performer->function))
                    $data["function"] = CodeableConcept::Load($performer->function);
                if(isset($performer->actor))
                    $data["actor"] = Reference::Load($performer->actor);
                if(isset($performer->onBehalfOf))
                    $data["onBehalfOf"] = Reference::Load($performer->onBehalfOf);
                $this->performer[] = $data;
            }
        if(isset($json->location))
            $this->location = Reference::Load($json->location);
        if(isset($json->reasonCode))
            foreach($json->reasonCode as $reasonCode)
                $this->reasonCode[] = CodeableConcept::Load($reasonCode);
        if(isset($json->reasonReference))
            foreach($json->reasonReference as $reasonReference)
                $this->reasonReference[] = Reference::Load($reasonReference);
        if(isset($json->bodySite))
            foreach($json->bodySite as $bodySite)
                $this->bodySite[] = CodeableConcept::Load($bodySite);
        if(isset($json->outcome))
            $this->outcome = CodeableConcept::Load($json->outcome);
        if(isset($json->report))
            foreach($json->report as $report)
                $this->report[] = Reference::Load($report);
        if(isset($json->complication))
            foreach($json->complication as $complication)
                $this->complication[] = CodeableConcept::Load($complication);
        if(isset($json->complicationDetail))
            foreach($json->complicationDetail as $complicationDetail)
                $this->complicationDetail[] = Reference::Load($complicationDetail);
        if(isset($json->followUp))
            foreach($json->followUp as $followUp)
                $this->followUp[] = CodeableConcept::Load($followUp);
        if(isset($json->note))
            foreach($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if(isset($json->focalDevice))
            foreach($json->focalDevice as $focalDevice){
                $data = [];
                if(isset($focalDevice->action))
                    $data["action"] = CodeableConcept::Load($focalDevice->focalDevice);
                if(isset($focalDevice->manipulated))
                    $data["manipulated"] = Reference::Load($focalDevice->manipulated);
                $this->focalDevice[] = $data;
            }
        if(isset($json->usedReference))
            foreach($json->usedReference as $usedReference)
                $this->usedReference[] = Reference::Load($usedReference);
        if(isset($json->usedCode))
            foreach($json->usedCode as $usedCode)
                $this->usedCode[] = CodeableConcept::Load($usedCode);
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function addInstantiatesCanonical($instantiatesCanonical){
        $this->instantiatesCanonical[] = $instantiatesCanonical;
    }
    public function addInstantiatesUri($instantiatesUri){
        $this->instantiatesUri[] = $instantiatesUri;
    }
    public function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function addPartOf(Resource $partOf){
        $this->partOf[] = $partOf->toReference();
    }
    public function setStatus($status){
        $data = ["preparation", "in-progress", "not-done", "on-hold", "stopped", "completed", "entered-in-error","unknown"];
        $this->status = $status;
    }
    public function setStatusReason(CodeableConcept $statusReason){
        $this->statusReason = $statusReason;
    }
    public function setCategory(CodeableConcept $category){
        $this->category = $category;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setPerformedDateTime(Resource $performedDateTime){
        $this->performedDateTime = $performedDateTime;
    }
    public function setPerformedPeriod(Period $performedPeriod){
        $this->performedPeriod = $performedPeriod;
    }
    public function setPerformedString(Period $performedString){
        $this->performedString = $performedString;
    }
    public function setPerformedAge($performedAge){
        $this->performedAge = $performedAge;
    }
    public function setPerformedRange(Range $performedRange){
        $this->performedRange = $performedRange;
    }
    public function setRecorder(Resource $recorder){
        $this->recorder = $recorder->toReference();
    }
    public function setAsserter(Resource $asserter){
        $this->asserter = $asserter->toReference();
    }
    public function addPerformer(CodeableConcept $performer, Resource $actor, Resource $onBehalfOf){
        $this->performer[] = [
            "function"=>$performer, 
            "actor"=>$actor->toReference(),
            "onBehalfOf"=>$onBehalfOf->toReference(),
        ];
    }
    public function setLocation(Resource $location){
        $this->location = $location->toReference();
    }
    public function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    public function addReasonReference(Resource $reasonReference){
        $this->reasonReference[] = $reasonReference->toReference();
    }
    public function addBodySite(CodeableConcept $bodySite){
        $this->bodySite[] = $bodySite;
    }
    public function addOutcome(CodeableConcept $outcome){
        $this->outcome = $outcome;
    }
    public function addReport(Resource $report){
        $this->report[] = $report->toReference();
    }
    public function addComplication(CodeableConcept $complication){
        $this->complication[] = $complication;
    }
    public function addComplicationDetail(Resource $complicationDetail){
        $this->complicationDetail[] = $complicationDetail->toReference();
    }
    public function addFollowUp(CodeableConcept $followUp){
        $this->followUp[] = $followUp;
    }
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    public function addFocalDevice(codeableConcept $action, Resource $manipulated){
        $this->focalDevice[] = [
            "action"=>$action,
            "manipulated"=>$manipulated->toReference(),
        ];
    }
    public function addUsedReference(Resource $usedReference){
        $this->usedReference[] = $usedReference->toReference();
    }
    public function addUsedCode(CodeableConcept $usedCode){
        $this->usedCode[] = $usedCode;
    }


    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->identifier))
            foreach($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        if(isset($this->instantiatesCanonical))
            foreach($this->instantiatesCanonical as $instantiatesCanonical)
                $arrayData["instantiatesCanonical"][] = $instantiatesCanonical;
        if(isset($this->instantiatesUri))
            foreach($this->instantiatesUri as $instantiatesUri)
                $arrayData["instantiatesUri"][] = $instantiatesUri;
        if(isset($this->basedOn))
            foreach($this->basedOn as $basedOn)
                $arrayData["basedOn"][] = $basedOn->toArray();
        if(isset($this->partOf))
            foreach($this->partOf as $partOf)
                $arrayData["partOf"][] = $partOf->toArray();
        if(isset($this->status))
            $arrayData["status"] = $this->status;
        if(isset($this->statusReason))
            $arrayData["statusReason"] = $this->statusReason->toArray();
        if(isset($this->category))
            $arrayData["category"] = $this->category->toArray();
        if(isset($this->code))
            $arrayData["code"] = $this->code->toArray();
        if(isset($this->subject))
            $arrayData["subject"] = $this->subject->toArray();
        if(isset($this->encounter))
            $arrayData["encounter"] = $this->encounter->toArray();
        if(isset($this->performedDateTime))
            $arrayData["performedDateTime"] = $this->performedDateTime;
        if(isset($this->performedPeriod))
            $arrayData["performedPeriod"] = $this->performedPeriod->toArray();
        if(isset($this->performedString))
            $arrayData["performedString"] = $this->performedString;
        if(isset($this->performedAge))
            $arrayData["performedAge"] = $this->performedAge->toArray();
        if(isset($this->performedRange))
            $arrayData["performedRange"] = $this->performedRange->toArray();
        if(isset($this->recorder))
            $arrayData["recorder"] = $this->recorder->toArray();
        if(isset($this->asserter))
            $arrayData["asserter"] = $this->asserter->toArray();
        if(isset($this->performer))
            foreach($this->performer as $performer){
                $data = [];
                if(isset($performer["function"]))
                    $data["function"] = $performer["function"]->toArray();
                if(isset($performer["actor"]))
                    $data["actor"] = $performer["actor"]->toArray();
                if(isset($performer["onBehalfOf"]))
                    $data["onBehalfOf"] = $performer["onBehalfOf"]->toArray();
                $arrayData["performer"][] = $data;
            }
        if(isset($this->location))
            $arrayData["location"] = $this->location->toArray();
        if(isset($this->reasonCode))
            foreach($this->reasonCode as $reasonCode)
                $arrayData["reasonCode"][] = $reasonCode->toArray();
        if(isset($this->reasonReference))
            foreach($this->reasonReference as $reasonReference)
                $arrayData["reasonReference"][] = $reasonReference->toArray();
        if(isset($this->bodySite))
            foreach($this->bodySite as $bodySite)
                $arrayData["bodySite"][] = $bodySite->toArray();
        if(isset($this->outcome))
            $arrayData["outcome"] = $this->outcome->toArray();
        if(isset($this->report))
            foreach($this->report as $report)
                $arrayData["report"][] = $report->toArray();
        if(isset($this->complication))
            foreach($this->complication as $complication)
                $arrayData["complication"][] = $complication->toArray();
        if(isset($this->complicationDetail))
            foreach($this->complicationDetail as $complicationDetail)
                $arrayData["complicationDetail"][] = $complicationDetail->toArray();
        if(isset($this->followUp))
            foreach($this->followUp as $followUp)
                $arrayData["followUp"][] = $followUp->toArray();
        if(isset($this->note))
            foreach($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        if(isset($this->focalDevice))
            foreach($this->focalDevice as $focalDevice){
                $data = [];
                if(isset($focalDevice->action))
                    $data["action"] = $focalDevice->focalDevice->toArray();
                if(isset($focalDevice->manipulated))
                    $data["manipulated"] = $focalDevice->manipulated->toArray();
                $arrayData["focalDevice"][] = $data;
            }
        if(isset($this->usedReference))
            foreach($this->usedReference as $usedReference)
                $arrayData["usedReference"][] = $usedReference->toArray();
        if(isset($this->usedCode))
            foreach($this->usedCode as $usedCode)
                $arrayData["usedCode"][] = $usedCode->toArray();
        return $arrayData;
    }
}