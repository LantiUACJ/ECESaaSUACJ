<?php

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Dosage;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Reference;

class MedicationRequest extends DomainResource{

    public function __construct($json = null){
        $this->resourceType = "MedicationRequest";
        parent::__construct($json);

        $this->identifier = [];
        $this->category = [];
        $this->reasonCode = [];
        $this->reasonReference = [];
        $this->instantiatesCanonica = [];
        $this->instantiatesUr = [];
        $this->basedOn = [];
        $this->insurance = [];
        $this->note = [];
        $this->detectedIssue = [];
        $this->eventHistory = [];

        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if (isset($json->status))
            $this->status = $json->status;
        if (isset($json->statusReason))
            $this->statusReason = $json->statusReason;
        if (isset($json->intent))
            $this->intent = $json->intent;
        if (isset($json->category) && $json->category)
            foreach ($json->category as $category)
                $this->category[] = CodeableConcept::Load($category);
        if (isset($json->priority))
            $this->priority = $json->priority;
        if (isset($json->doNotPerform))
            $this->doNotPerform = $json->doNotPerform;
        if (isset($json->reportedBoolean))
            $this->reportedBoolean = $json->reportedBoolean;
        if (isset($json->reportedReference))
            $this->reportedReference = Reference::Load($json->reportedReference);
        if (isset($json->medicationCodeableConcept))
            $this->medicationCodeableConcept = CodeableConcept::Load($json->medicationCodeableConcept);
        if (isset($json->medicationReference))
            $this->medicationReference = Reference::Load($json->medicationReference);
        if (isset($json->subject))
            $this->subject = Reference::Load($json->subject);
        if (isset($json->encounter))
            $this->encounter = Reference::Load($json->encounter);
        if (isset($json->supportingInformation))
            $this->supportingInformation = Reference::Load($json->supportingInformation);
        if (isset($json->authoredOn))
            $this->authoredO = $json->authoredOn;
        if (isset($json->requester))
            $this->requester = Reference::Load($json->requester);
        if (isset($json->performer))
            $this->performer = Reference::Load($json->performer);
        if (isset($json->performerType))
            $this->performerType = CodeableConcept::Load($json->performerType);
        if (isset($json->recorder))
            $this->recorder = Reference::Load($json->recorder);
        if (isset($json->reasonCode) && $json->reasonCode)
            foreach ($json->reasonCode as $reasonCode)
                $this->reasonCode[] = CodeableConcept::Load($reasonCode);
        if (isset($json->reasonReference) && $json->reasonReference)
            foreach ($json->reasonReference as $reasonReference)
                $this->reasonReference[] = Reference::Load($reasonReference);
        if (isset($json->instantiatesCanonical) && $json->instantiatesCanonical)
            foreach ($json->instantiatesCanonical as $instantiatesCanonical)
                $this->instantiatesCanonica[] = $instantiatesCanonical;
        if (isset($json->instantiatesUri) && $json->instantiatesUri)
            foreach ($json->instantiatesUri as $instantiatesUri)
                $this->instantiatesUr[] = $instantiatesUri;
        if (isset($json->basedOn) && $json->basedOn)
            foreach ($json->basedOn as $basedOn)
                $this->basedOn[] = Reference::Load($basedOn);
        if (isset($json->groupIdentifier))
            $this->groupIdentifier = Identifier::Load($json->groupIdentifier);
        if (isset($json->courseOfTherapyType))
            $this->courseOfTherapyType = CodeableConcept::Load($json->courseOfTherapyType);
        if (isset($json->insurance) && $json->insurance)
            foreach ($json->insurance as $insurance)
                $this->insurance[] = Reference::Load($insurance);
        if (isset($json->note) && $json->note)
            foreach ($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if (isset($json->dosageInstruction) && $json->dosageInstruction)
            foreach ($json->dosageInstruction as $dosageInstruction)
                $this->dosageInstruction[] = Dosage::Load($dosageInstruction);
        if (isset($json->dispenseRequest) && $json->dispenseRequest){
            $this->dispenseRequest = [];
            if (isset($json->dispenseRequest->initialFill) && $json->dispenseRequest->initialFill){
                $initialFill = [];
                if (isset($json->dispenseRequest->initialFill->quantity))
                    $initialFill["quantity"] = Quantity::Load($json->dispenseRequest->initialFill->quantity);
                if (isset($json->dispenseRequest->initialFill->duration))
                    $initialFill["duration"] = Quantity::Load($json->dispenseRequest->initialFill->duration);
                if($initialFill)
                    $this->dispenseRequest["initialFill"] = $initialFill;
            }
            if(isset($json->substitution)){
                $this->dispenseRequest["substitution"] = [];
                if (isset($json->substitution->dispenseInterval))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($json->substitution->dispenseInterval);
                if (isset($json->substitution->validityPeriod))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = Period::Load($json->substitution->validityPeriod);
                if (isset($json->substitution->numberOfRepeatsAllowed))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = $json->substitution->numberOfRepeatsAllowed;
                if (isset($json->substitution->quantity))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($json->substitution->quantity);
                if (isset($json->substitution->expectedSupplyDuration))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($json->substitution->expectedSupplyDuration);
                if (isset($json->dispenseRequest->performer))
                    $this->dispenseRequest["substitution"]["dispenseInterval"] = Reference::Load($json->dispenseRequest->performer);
            }
        }
        if (isset($json->substitution)){
            $this->substitution = [];
            if (isset($json->substitution->allowedBoolean))
                $this->substitution["allowedBoolean"] = $json->substitution->allowedBoolean;
            if (isset($json->substitution->allowedCodeableConcept))
                $this->substitution["allowedCodeableConcept"] = CodeableConcept::Load($json->substitution->allowedCodeableConcept);
            if (isset($json->substitution->reason))
                $this->substitution["reason"] = CodeableConcept::Load($json->substitution->reason);
        }
        if (isset($json->priorPrescription))
            $this->priorPrescription = Reference::Load($json->priorPrescription);
        if (isset($json->detectedIssue) && $json->detectedIssue)
            foreach ($json->detectedIssue as $detectedIssue)
                $this->detectedIssue[] = Reference::Load($detectedIssue);
        if (isset($json->eventHistory) && $json->eventHistory)
            foreach ($json->eventHistory as $eventHistory)
                $this->eventHistory[] = Reference::Load($eventHistory);
    }

    /* Obligatorio */
    function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    /* obligatorio */
    function setStatus($status){
        $this->status = $status;
    }
    /* obligatorio */
    function setStatusReason($statusReason){
        $this->statusReason = $statusReason;
    }
    /* obligatorio */
    function setIntent($intent){
        $this->intent = $intent;
    }
    function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    function setPriority($priority){
        $this->priority = $priority;
    }
    function setDoNotPerform($doNotPerform){
        $this->doNotPerform = $doNotPerform;
    }
    function setReportedBoolean($reportedBoolean){
        $this->reportedBoolean = $reportedBoolean;
    }
    function setReportedReference(Resource $reportedReference){
        $this->reportedReference = $reportedReference->toReference();
    }
    function setMedicationCodeableConcept(CodeableConcept $medicationCodeableConcept){
        $this->medicationCodeableConcept = $medicationCodeableConcept;
    }
    /* obligatorio */
    function setMedicationReference(Resource $medicationReference){
        $this->medicationReference = $medicationReference->toReference();
    }
    /* obligatorio */
    function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    function setSupportingInformation(Resource $supportingInformation){
        $this->supportingInformation = $supportingInformation;
    }
    function setAuthoredOn($authoredOn){
        $this->authoredO = $authoredOn;
    }
    function setRequester(Resource $requester){
        $this->requester = $requester->toReference();
    }
    function setPerformer(Resource $performer){
        $this->performer = $performer->toReference();
    }
    function setPerformerType(CodeableConcept $performerType){
        $this->performerType = $performerType;
    }
    function setRecorder(Resource $recorder){
        $this->recorder = $recorder->toReference();
    }
    function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    function addReasonReference(Resource $reasonReference){
        $this->reasonReference[] = $reasonReference->toReference();
    }
    function addInstantiatesCanonical($instantiatesCanonical){
        $this->instantiatesCanonica[] = $instantiatesCanonical;
    }
    function addInstantiatesUri($instantiatesUri){
        $this->instantiatesUr[] = $instantiatesUri;
    }
    function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    function setGroupIdentifier(Identifier $groupIdentifier){
        $this->groupIdentifier = $groupIdentifier;
    }
    function setCourseOfTherapyType(CodeableConcept $courseOfTherapyType){
        $this->courseOfTherapyType = $courseOfTherapyType;
    }
    function addInsurance(Resource $insurance){
        $this->insurance[] = $insurance->toReference();
    }
    function addNote(Annotation $note){
        $this->note[] = $note;
    }
    /* obligatorio
        \Fhir\Element\Dosage:
            "text": 
            "route": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Coding (array 1..*)
                    "code": 
                    "display": 
                    "system": "http://snomed.info/sct"
                "text":
            "method": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Coding (array 1..*)
                    "code": 
                    "display":
                    "system": "http://snomed.info/sct"
                "text":
            "doseAndRate": Array(1..*)
                "doseQuantity": 
                    "value":
                    "unit":
                    "system":
                    "code":
    */
    function addDosageInstruction(Dosage $dosageInstruction){
        $this->dosageInstruction[] = $dosageInstruction;
    }
    function setDispenseRequest(Quantity $quantity, Quantity $duration, Quantity $dispenseInterval, Period $validityPeriod, $numberOfRepeatsAllowed, Quantity $sustQuantity, Quantity $expectedSupplyDuration, Resource $performer){
        $this->dispenseRequest = [];
        if ($quantity || $duration){
            $initialFill = [];
            if ($quantity)
                $initialFill["quantity"] = $quantity;
            if ($duration)
                $initialFill["duration"] = $duration;
            if($initialFill)
                $this->dispenseRequest["initialFill"] = $initialFill;
        }
        if($dispenseInterval || $validityPeriod || $numberOfRepeatsAllowed || $quantity || $expectedSupplyDuration || $performer){
            $this->dispenseRequest["substitution"] = [];
            if (isset($dispenseInterval))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($dispenseInterval);
            if (isset($validityPeriod))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = Period::Load($validityPeriod);
            if (isset($numberOfRepeatsAllowed))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = $numberOfRepeatsAllowed;
            if (isset($quantity))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($sustQuantity);
            if (isset($expectedSupplyDuration))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = Quantity::Load($expectedSupplyDuration);
            if (isset($performer))
                $this->dispenseRequest["substitution"]["dispenseInterval"] = $performer->toReference();
        }
    }
    function setSubstitution($allowedBoolean, CodeableConcept $allowedCodeableConcept, CodeableConcept $reason){
        $this->substitution = [];
        if ($allowedBoolean)
            $this->substitution["allowedBoolean"] = $allowedBoolean;
        if ($allowedCodeableConcept)
            $this->substitution["allowedCodeableConcept"] = CodeableConcept::Load($allowedCodeableConcept);
        if ($reason)
            $this->substitution["reason"] = CodeableConcept::Load($reason);
    }
    function setPriorPrescription(Resource $priorPrescription){
        $this->priorPrescription = $priorPrescription->toReference();
    }
    function addDetectedIssue(Resource $detectedIssue){
        $this->detectedIssue[] = $detectedIssue->toReference();
    }
    function addEventHistory(Resource $eventHistory){
        $this->eventHistory[] = $eventHistory->toReference();
    }

    function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->identifier)){
            $arrayData["identifier"] = [];
            foreach($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        }
        if (isset($this->status))
            $arrayData["status"] = $this->status;
        if (isset($this->statusReason))
            $arrayData["statusReason"] = $this->statusReason;
        if (isset($this->intent))
            $arrayData["intent"] = $this->intent;
        if (isset($this->category) && $this->category){
            $arrayData["category"] = [];
            foreach ($this->category as $category)
                $arrayData["category"][] = $category->toArray();
        }
        if (isset($this->priority))
            $arrayData["priority"] = $this->priority;
        if (isset($this->doNotPerform))
            $arrayData["doNotPerform"] = $this->doNotPerform;
        if (isset($this->reportedBoolean))
            $arrayData["reportedBoolean"] = $this->reportedBoolean;
        if (isset($this->reportedReference))
            $arrayData["reportedReference"] = $this->reportedReference->toArray();
        if (isset($this->medicationCodeableConcept))
            $arrayData["medicationCodeableConcept"] = $this->medicationCodeableConcept->toArray();
        if (isset($this->medicationReference))
            $arrayData["medicationReference"] = $this->medicationReference->toArray();
        if (isset($this->subject))
            $arrayData["subject"] = $this->subject->toArray();
        if (isset($this->encounter))
            $arrayData["encounter"] = $this->encounter->toArray();
        if (isset($this->supportingInformation))
            $arrayData["supportingInformation"] = $this->supportingInformation->toArray();
        if (isset($this->authoredOn))
            $arrayData["authoredO"] = $this->authoredOn;
        if (isset($this->requester))
            $arrayData["requester"] = $this->requester->toArray();
        if (isset($this->performer))
            $arrayData["performer"] = $this->performer->toArray();
        if (isset($this->performerType))
            $arrayData["performerType"] = $this->performerType->toArray();
        if (isset($this->recorder))
            $arrayData["recorder"] = $this->recorder->toArray();
        if (isset($this->reasonCode) && $this->reasonCode){
            $arrayData["reasonCode"] = [];
            foreach ($this->reasonCode as $reasonCode)
                $arrayData["reasonCode"][] = $reasonCode->toArray();
        }
        if (isset($this->reasonReference) && $this->reasonReference){
            $arrayData["reasonReference"] = [];
            foreach ($this->reasonReference as $reasonReference)
                $arrayData["reasonReference"][] = $reasonReference->toArray();
        }
        if (isset($this->instantiatesCanonical) && $this->instantiatesCanonical){
            $arrayData["instantiatesCanonical"] = [];
            foreach ($this->instantiatesCanonical as $instantiatesCanonical)
                $this->instantiatesCanonica[] = $instantiatesCanonical;
        }
        if (isset($this->instantiatesUri) && $this->instantiatesUri){
            $arrayData["instantiatesUri"] = [];
            foreach ($this->instantiatesUri as $instantiatesUri)
                $this->instantiatesUr[] = $instantiatesUri;
        }
        if (isset($this->basedOn) && $this->basedOn){
            $arrayData["basedOn"] = [];
            foreach ($this->basedOn as $basedOn)
                $this->basedOn[] = $basedOn->toArray();
        }
        if (isset($this->groupIdentifier))
            $this->groupIdentifier = $this->groupIdentifier->toArray();
        if (isset($this->courseOfTherapyType))
            $this->courseOfTherapyType = $this->courseOfTherapyType->toArray();
        if (isset($this->insurance) && $this->insurance){
            $arrayData["insurance"] = [];
            foreach ($this->insurance as $insurance)
                $arrayData["insurance"][] = $insurance->toArray();
        }
        if (isset($this->note) && $this->note){
            $arrayData["note"] = [];
            foreach ($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        }
        if (isset($this->dosageInstruction) && $this->dosageInstruction){
            $arrayData["dosageInstruction"] = [];
            foreach ($this->dosageInstruction as $dosageInstruction)
                $arrayData["dosageInstruction"][] = $dosageInstruction->toArray();
        }
        if (isset($this->dispenseRequest) && $this->dispenseRequest){
            $dispenseRequest = [];
            if (isset($this->dispenseRequest["initialFill"]) && $this->dispenseRequest["initialFill"]){
                $initialFill = [];
                if (isset($this->dispenseRequest["initialFill"]["quantity"]))
                    $initialFill["quantity"] = $this->dispenseRequest["initialFill"]["quantity"];
                if (isset($this->dispenseRequest["initialFill"]["duration"]))
                    $initialFill["duration"] = $this->dispenseRequest["initialFill"]["duration"];
                if($initialFill)
                    $dispenseRequest["initialFill"] = $initialFill;
            }
            if(isset($this->substitution)){
                $substitution = [];
                if (isset($this->dispenseRequest["substitution"]["dispenseInterval"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["dispenseInterval"]->toArray();
                if (isset($this->dispenseRequest["substitution"]["validityPeriod"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["validityPeriod"]->toArray();
                if (isset($this->dispenseRequest["substitution"]["numberOfRepeatsAllowed"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["numberOfRepeatsAllowed"];
                if (isset($this->dispenseRequest["substitution"]["quantity"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["quantity"]->toArray();
                if (isset($this->dispenseRequest["substitution"]["expectedSupplyDuration"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["expectedSupplyDuration"]->toArray();
                if (isset($this->dispenseRequest["substitution"]["performer"]))
                    $substitution["dispenseInterval"] = $this->dispenseRequest["substitution"]["performer"]->toArray();
                if($substitution)
                    $dispenseRequest["substitution"] = $substitution;
            }
        }
        if (isset($this->substitution)){
            $substitution = [];
            if (isset($this->substitution["allowedBoolean"]))
                $substitution["allowedBoolean"] = $this->substitution["allowedBoolean"];
            if (isset($this->substitution["allowedCodeableConcept"]))
                $substitution["allowedCodeableConcept"] = $this->substitution["allowedCodeableConcept"]->toArray();
            if (isset($this->substitution["reason"]))
                $substitution["reason"] = $this->substitution["reason"]->toArray();
            $arrayData["substitution"] = $substitution;
        }
        if (isset($this->priorPrescription))
            $arrayData["priorPrescription"] = $this->priorPrescription->toArray();
        if (isset($this->detectedIssue) && $this->detectedIssue){
            $arrayData["detectedIssue"] = [];
            foreach ($this->detectedIssue as $detectedIssue)
                $arrayData["detectedIssue"][] = $detectedIssue->toArray();
        }
        if (isset($this->eventHistory) && $this->eventHistory){
            $arrayData["eventHistory"] = [];
            foreach ($this->eventHistory as $eventHistory)
                $arrayData["eventHistory"][] = $eventHistory->toArray();
        }
        return $arrayData;
    }

}