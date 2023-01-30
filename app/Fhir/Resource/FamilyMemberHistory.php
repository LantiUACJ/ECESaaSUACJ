<?php
namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Range;
use App\Fhir\Element\Reference;
use App\Fhir\Element\Quantity;

class FamilyMemberHistory extends DomainResource{

    public function __construct($json = null){
        $this->resourceType = "Encounter";
        parent::__construct($json);
        
        $this->identifier = [];
        $this->instantiatesCanonical = [];
        $this->instantiatesUri = [];
        $this->reasonCode = [];
        $this->reasonReference = [];
        $this->note = [];
        if($json) $this->loadData($json);
    }

    private function loadData($json){
        if (isset($json->identifier) && $json->identifier)
            foreach ($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if (isset($json->instantiatesCanonical) && $json->instantiatesCanonical)
            foreach ($json->instantiatesCanonical as $instantiatesCanonical)
                $this->instantiatesCanonical[] = $instantiatesCanonical;
        if (isset($json->instantiatesUri) && $json->instantiatesUri)
            foreach ($json->instantiatesUri as $instantiatesUri)
                $this->instantiatesUri[] = $instantiatesUri;
        if (isset($json->status))/* partial | completed | entered-in-error | health-unknown */
            $this->status = $json->status;
        if (isset($json->dataAbsentReason))
            $this->dataAbsentReason = CodeableConcept::Load($json->dataAbsentReason);
        if (isset($json->patient))
            $this->patient = Reference::Load($json->patient);
        if (isset($json->date))
            $this->date = $json->date;
        if (isset($json->name))
            $this->name = $json->name;
        if (isset($json->relationship))
            $this->relationship = CodeableConcept::Load($json->relationship);
        if (isset($json->sex))
            $this->sex = CodeableConcept::Load($json->sex);
        if (isset($json->bornPeriod))
            $this->bornPeriod = Period::Load($json->bornPeriod);
        if (isset($json->bornDate))
            $this->bornDate = $json->bornDate;
        if (isset($json->bornString))
            $this->bornString = $json->bornString;
        if (isset($json->ageAge))
            $this->ageAge = Quantity::Load($json->ageAge);
        if (isset($json->ageRange))
            $this->ageRange = Range::Load($json->ageRange);
        if (isset($json->ageString))
            $this->ageString = $json->ageString;
        if (isset($json->estimatedAge))
            $this->estimatedAge = $json->estimatedAge;
        if (isset($json->deceasedBoolean))
            $this->deceasedBoolean = $json->deceasedBoolean;
        if (isset($json->deceasedAge))
            $this->deceasedAge = Quantity::Load($json->deceasedAge);
        if (isset($json->deceasedRange))
            $this->deceasedRange = Range::Load($json->deceasedRange);
        if (isset($json->deceasedDate))
            $this->deceasedDate = $json->deceasedDate;
        if (isset($json->deceasedString))
            $this->deceasedString = $json->deceasedString;
        if (isset($json->reasonCode) && $json->reasonCode)
            foreach ($json->reasonCode as $reasonCode)
                $this->reasonCode[] = CodeableConcept::Load($reasonCode);
        if (isset($json->reasonReference) && $json->reasonReference)
            foreach ($json->reasonReference as $reasonReference)
                $this->reasonReference[] = Reference::Load($reasonReference);
        if (isset($json->note) && $json->note)
            foreach ($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if (isset($json->condition) && $json->condition){
            $conditions = [];
            foreach ($json->condition as $condition){
                if (isset($condition->code))
                    $conditions["code"] = CodeableConcept::Load($condition->code);
                if (isset($condition->outcome))
                    $conditions["outcome"] = CodeableConcept::Load($condition->outcome);
                if (isset($condition->contributedToDeath))
                    $conditions["contributedToDeath"] = $condition->contributedToDeath;
                if (isset($condition->onsetAge))
                    $conditions["onsetAge"] = Quantity::Load($condition->onsetAge);
                if (isset($condition->onsetRange))
                    $conditions["onsetRange"] = Range::Load($condition->onsetRange);
                if (isset($condition->onsetPeriod))
                    $conditions["onsetPeriod"] = Period::Load($condition->onsetPeriod);
                if (isset($condition->onsetString))
                    $conditions["onsetString"] = $condition->onsetString;
                if (isset($condition->note)){
                    $conditions["note"] = [];
                    foreach ($condition->note as $note)
                        $conditions["note"][] = Annotation::Load($note);
                }
                if($conditions) $this->condition[] = $conditions;
            }
        }
    }

    function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    function addInstantiatesCanonical($instantiatesCanonical){
        $this->instantiatesCanonical[] = $instantiatesCanonical;
    }
    function addInstantiatesUri($instantiatesUri){
        $this->instantiatesUri[] = $instantiatesUri;
    }
    function setStatus($status){
        /* partial | completed | entered-in-error | health-unknown */
        $this->status = $status;
    }
    function setDataAbsentReason(CodeableConcept $dataAbsentReason){
        $this->dataAbsentReason = $dataAbsentReason;
    }
    function setPatient(Patient $patient){
        $this->patient = $patient->toReference();
    }
    function setDate($date){
        $this->date = $date;
    }
    function setName($name){
        $this->name = $name;
    }
    function setRelationship(CodeableConcept $relationship){
        $this->relationship = $relationship;
    }
    function setSex(CodeableConcept $sex){
        $this->sex = $sex;
    }
    function setBornPeriod(Period $bornPeriod){
        $this->bornPeriod = $bornPeriod;
    }
    function setBornDate($bornDate){
        $this->bornDate = $bornDate;
    }
    function setBornString($bornString){
        $this->bornString = $bornString;
    }
    function setAgeAge(Quantity $ageAge){
        $this->ageAge = $ageAge;
    }
    function setAgeRange(Range $ageRange){
        $this->ageRange = $ageRange;
    }
    function setAgeString($ageString){
        $this->ageString = $ageString;
    }
    function setEstimatedAge($estimatedAge){
        $this->estimatedAge = $estimatedAge;
    }
    function setDeceasedBoolean($deceasedBoolean){
        $this->deceasedBoolean = $deceasedBoolean;
    }
    function setDeceasedAge(Quantity $deceasedAge){
        $this->deceasedAge = $deceasedAge;
    }
    function setDeceasedRange(Range $deceasedRange){
        $this->deceasedRange = $deceasedRange;
    }
    function setDeceasedDate($deceasedDate){
        $this->deceasedDate = $deceasedDate;
    }
    function setDeceasedString($deceasedString){
        $this->deceasedString = $deceasedString;
    }
    function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    function addReasonReference(Reference $reasonReference){
        $this->reasonReference[] = $reasonReference;
    }
    function addNote(Annotation $note){
        $this->note[] = $note;
    }
    function addCondition(CodeableConcept $code, CodeableConcept $outcome, $contributedToDeath, Quantity $onsetAge, Range $onsetRange, Period $onsetPeriod, $onsetString, $note){
        $conditions = [];
        if (isset($code))
            $conditions["code"] = $code;
        if (isset($outcome))
            $conditions["outcome"] = $outcome;
        if (isset($contributedToDeath))
            $conditions["contributedToDeath"] = $contributedToDeath;
        if (isset($onsetAge))
            $conditions["onsetAge"] = $onsetAge;
        if (isset($onsetRange))
            $conditions["onsetRange"] = $onsetRange;
        if (isset($onsetPeriod))
            $conditions["onsetPeriod"] = $onsetPeriod;
        if (isset($onsetString))
            $conditions["onsetString"] = $onsetString;
        if (isset($note)){
            $conditions["note"] = [];
            foreach ($note as $item){
                $conditions["note"][] = $item;
            }
        }
        if($conditions) 
            $this->condition[] = $conditions;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if (isset($this->identifier) && $this->identifier)
            foreach ($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        if (isset($this->instantiatesCanonical) && $this->instantiatesCanonical)
            foreach ($this->instantiatesCanonical as $instantiatesCanonical)
                $arrayData["instantiatesCanonical"][] = $instantiatesCanonical;
        if (isset($this->instantiatesUri) && $this->instantiatesUri)
            foreach ($this->instantiatesUri as $instantiatesUri)
                $instantiatesUri[] = $instantiatesUri;
        if (isset($this->status))/* partial | completed | entered-in-error | health-unknown */
            $arrayData["status"] = $this->status;
        if (isset($this->dataAbsentReason))
            $arrayData["dataAbsentReason"] = $this->dataAbsentReason->toArray();
        if (isset($this->patient))
            $arrayData["patient"] = $this->patient->toArray();
        if (isset($this->date))
            $arrayData["date"] = $this->date;
        if (isset($this->name))
            $arrayData["name"] = $this->name;
        if (isset($this->relationship))
            $arrayData["relationship"] = $this->relationship->toArray();
        if (isset($this->sex))
            $arrayData["sex"] = $this->sex->toArray();
        if (isset($this->bornPeriod))
            $arrayData["bornPeriod"] = $this->bornPeriod->toArray();
        if (isset($this->bornDate))
            $arrayData["bornDate"] = $this->bornDate;
        if (isset($this->bornString))
            $arrayData["bornString"] = $this->bornString;
        if (isset($this->ageAge))
            $arrayData["ageAge"] = $this->ageAge->toArray();
        if (isset($this->ageRange))
            $arrayData["ageRange"] = $this->ageRange->toArray();
        if (isset($this->ageString))
            $arrayData["ageString"] = $this->ageString;
        if (isset($this->estimatedAge))
            $arrayData["estimatedAge"] = $this->estimatedAge;
        if (isset($this->deceasedBoolean))
            $arrayData["deceasedBoolean"] = $this->deceasedBoolean;
        if (isset($this->deceasedAge))
            $arrayData["deceasedAge"] = $this->deceasedAge->toArray();
        if (isset($this->deceasedRange))
            $arrayData["deceasedRange"] = $this->deceasedRange->toArray();
        if (isset($this->deceasedDate))
            $arrayData["deceasedDate"] = $this->deceasedDate;
        if (isset($this->deceasedString))
            $arrayData["deceasedString"] = $this->deceasedString;
        if (isset($this->reasonCode) && $this->reasonCode)
            foreach ($this->reasonCode as $reasonCode)
                $arrayData["reasonCode"][] = $reasonCode->toArray();
        if (isset($this->reasonReference) && $this->reasonReference)
            foreach ($this->reasonReference as $reasonReference)
                $arrayData["reasonReference"][] = $reasonReference->toArray();
        if (isset($this->note) && $this->note)
            foreach ($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        if (isset($this->condition) && $this->condition){
            $conditions = [];
            foreach ($this->condition as $condition){
                if (isset($condition["code"]))
                    $conditions["code"] = $condition["code"]->toArray();
                if (isset($condition["outcome"]))
                    $conditions["outcome"] = $condition["outcome"]->toArray();
                if (isset($condition["contributedToDeath"]))
                    $conditions["contributedToDeath"] = $condition["contributedToDeath"];
                if (isset($condition["onsetAge"]))
                    $conditions["onsetAge"] = $condition["onsetAge"]->toArray();
                if (isset($condition["onsetRange"]))
                    $conditions["onsetRange"] = $condition["onsetRange"]->toArray();
                if (isset($condition["onsetPeriod"]))
                    $conditions["onsetPeriod"] = $condition["onsetPeriod"]->toArray();
                if (isset($condition["onsetString"]))
                    $conditions["onsetString"] = $condition["onsetString"];
                if (isset($condition["note"])){
                    $conditions["note"] = [];
                    foreach ($condition["note"] as $note)
                        $conditions["note"][] = $note->toArray();
                }
            }
            if($conditions) $arrayData["condition"] = $conditions;
        }
    }
}