<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Range;
use App\Fhir\Element\Ratio;
use App\Fhir\Element\Reference;
use App\Fhir\Element\SampleData;
use App\Fhir\Element\Timing;

class Observation extends DomainResource{

    public function __construct($json = null){
        $this->resourceType = "Observation";
        parent::__construct($json);
        $this->identifier = [];
        $this->basedOn = [];
        $this->partOf = [];
        $this->category = [];
        $this->focus = [];
        $this->performer = [];
        $this->interpretation = [];
        $this->note = [];
        $this->hasMember = [];
        $this->derivedFrom = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        $arrayData = [];
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        if(isset($json->status))
            $arrayData["status"] = $json->status;
        if(isset($json->issued))
            $arrayData["issued"] = $json->issued;
        if(isset($json->basedOn))
            foreach($json->basedOn as $basedOn)
                $arrayData['basedOn'][] = Reference::Load($basedOn);
        if(isset($json->partOf))
            foreach($json->partOf as $partOf)
                $arrayData["partOf"][] = $partOf->toArray();
        if(isset($json->partOf))
            foreach($json->category as $category)
                $arrayData["category"][] = $category->toArray();
        if(isset($json->code))
            $arrayData["code"] = CodeableConcept::Load($json->code);
        if(isset($json->subject))
            $arrayData["subject"] = Reference::Load($json->subject);
        if(isset($json->focus))
            foreach($json->focus as $focus)
                $arrayData["focus"][] = Reference::Load($focus);
        if(isset($json->encounter))
            $arrayData["encounter"] = Reference::Load($json->encounter);
        if(isset($json->effectiveDateTime))
            $arrayData["effectiveDateTime"] = $json->effectiveDateTime;
        if(isset($json->effectivePeriod))
            $arrayData["effectivePeriod"] = $json->effectivePeriod->toArray();
        if(isset($json->effectiveTiming))
            $arrayData["effectiveTiming"] = $json->effectiveTiming->toArray();
        if(isset($json->effectiveInstant))
            $arrayData["effectiveInstant"] = $json->effectiveInstant;
        if(isset($json->performer))
            foreach($json->performer as $performer)
                $arrayData["performer"][] = Reference::Load($performer);
        if(isset($json->valueQuantity))
            $arrayData["valueQuantity"] = Quantity::Load($json->valueQuantity);
        if(isset($json->valueCodeableConcept))
            $arrayData["valueCodeableConcept"] = CodeableConcept::Load($json->valueCodeableConcept);
        if(isset($json->valueString))
            $arrayData["valueString"] = $json->valueString;
        if(isset($json->valueBoolean))
            $arrayData["valueBoolean"] = $json->valueBoolean;
        if(isset($json->valueInteger))
            $arrayData["valueInteger"] = $json->valueInteger;
        if(isset($json->valueRange))
            $arrayData["valueRange"] = Range::Load($json->valueRange);
        if(isset($json->valueRatio))
            $arrayData["valueRatio"] = Ratio::Load($json->valueRatio);
        if(isset($json->valueSampledData))
            $json->valueSampledData = SampleData::Load($json->valueSampledData);
        if(isset($json->valueTime))
            $json->valueTime = $json->valueTime;
        if(isset($json->valueDateTime))
            $json->valueDateTime = $json->valueDateTime;
        if(isset($json->valuePeriod))
            $json->valuePeriod = Period::Load($json->valuePeriod);
        if(isset($json->dataAbsentReason))
            $json->dataAbsentReason = CodeableConcept::Load($json->dataAbsentReason);
        if(isset($json->interpretation))
            foreach($json->interpretation as $interpretation)
                $json->interpretation = CodeableConcept::Load($interpretation);
        if(isset($json->note))
            foreach($json->note as $note)
                $json->note = Annotation::Load($note);
        if(isset($json->bodySite))
            $json->bodySite = Reference::Load($json->bodySite);
        if(isset($json->method))
            $json->method = CodeableConcept::Load($json->method);
        if(isset($json->specimen))
            $json->specimen = $json->specimen;
        if(isset($json->device))
            $json->device = $json->device;
        if(isset($json->referenceRange)){
            $data = [];
            if(isset($json->referenceRange->low))
                $data["low"] = $json->referenceRange->low->toArray();
            if(isset($json->referenceRange->high))
                $data["high"] = $json->referenceRange->high->toArray();
            if(isset($json->referenceRange->type))
                $data["type"] = $json->referenceRange->type->toArray();
            if(isset($json->referenceRange->appliesTo))
                $data["appliesTo"] = $json->referenceRange->appliesTo->toArray();
            if(isset($json->referenceRange->age))
                $data["age"] = $json->referenceRange->age->toArray();
            if(isset($json->referenceRange->text))
                $data["text"] = $json->referenceRange->text;
            $arrayData["referenceRange"][] = $data;
        }
        if(isset($json->hasMember))
            foreach($json->hasMember as $hasMember)
                $this->hasMember[] = Reference::Load($hasMember);
        if(isset($json->derivedFrom))
            foreach($json->derivedFrom as $derivedFrom)
                $this->derivedFrom = $derivedFrom;
        if(isset($json->component)){
            $this->component = [];
            if(isset($json->component->code))
                $this->component["code"] = CodeableConcept::Load($json->component->code);
            if(isset($json->component->valueQuantity))
                $this->component["valueQuantity"] = Quantity::Load($json->component->valueQuantity);
            if(isset($json->component->valueCodeableConcept))
                $this->component["valueCodeableConcept"] = CodeableConcept::Load($json->component->valueCodeableConcept);
            if(isset($json->component->valueString))
                $this->component["valueString"] = $json->component->valueString;
            if(isset($json->component->valueBoolean))
                $this->component["valueBoolean"] = $json->component->valueBoolean;
            if(isset($json->component->valueInteger))
                $this->component["valueInteger"] = $json->component->valueInteger;
            if(isset($json->component->valueRange))
                $this->component["valueRange"] = Range::Load($json->component->valueRange);
            if(isset($json->component->valueRatio))
                $this->component["valueRatio"] = Ratio::Load($json->component->valueRatio);
            if(isset($json->component->valueSampledData))
                $this->component["valueSampledData"] = SampleData::Load($json->component->valueSampledData);
            if(isset($json->component->valueTime))
                $this->component["valueTime"] = $json->component->valueTime;
            if(isset($json->component->valueDateTime))
                $this->component["valueDateTime"] = $json->component->valueDateTime;
            if(isset($json->component->period))
                $this->component["period"] = Period::Load($json->component->period);
            if(isset($json->component->dataAbsentReason))
                $this->component["dataAbsentReason"] = CodeableConcept::Load($json->component->dataAbsentReason);
            if(isset($json->component->interpretation)){
                $inters = [];
                foreach($json->component->interpretation as $inter){
                    $inters[] = CodeableConcept::Load($inter);
                }
                $this->component["interpretation"] = $inters;
            }
            if(isset($json->component->referenceRange)){
                $range = [];
                foreach($json->component->referenceRange as $referenceRange){
                    $range[] = CodeableConcept::Load($referenceRange);
                }
                $this->component["referenceRange"] = $range;
            }
        }
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setStatus($status){
        $only = ["registered", "preliminary", "final", "amended"];
        $this->status = $status;
    }
    public function setIssued($issued){
        $this->issued = $issued;
    }
    public function addtBasedOn(Reference $basedOn){
        $this->basedOn[] = $basedOn;
    }
    public function addPartOf(Reference $partOf){
        $this->partOf[] = $partOf;
    }
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    public function setSubject(Reference $subject){
        $this->subject = $subject;
    }
    public function addFocus(Reference $focus){
        $this->focus[] = $focus;
    }
    public function setEncounter(Reference $encounter){
        $this->encounter = $encounter;
    }
    public function setEffectiveDateTime($effectiveDateTime){
        $this->effectiveDateTime = $effectiveDateTime;
    }
    public function setEffectivePeriod(Period $effectivePeriod){
        $this->effectivePeriod = $effectivePeriod;
    }
    public function setEffectiveTiming(Timing $effectiveTiming){
        $this->effectiveTiming = $effectiveTiming;
    }
    public function setEffectiveInstant($effectiveInstant){
        $this->effectiveInstant = $effectiveInstant;
    }
    public function addPerformer(Reference $performer){
        $this->performer[] = $performer;
    }
    public function setValueQuantity(Quantity $valueQuantity){
        $this->valueQuantity = $valueQuantity;
    }
    public function setValueCodeableConcept(CodeableConcept $valueCodeableConcept){
        $this->valueCodeableConcept = $valueCodeableConcept;
    }
    public function setValueString($valueString){
        $this->valueString = $valueString;
    }
    public function setValueBoolean($valueBoolean){
        $this->valueBoolean = $valueBoolean;
    }
    public function setValueInteger($valueInteger){
        $this->valueInteger = $valueInteger;
    }
    public function setValueRange(Range $valueRange){
        $this->valueRange = $valueRange;
    }
    public function setValueRatio(Ratio $valueRatio){
        $this->valueRatio = $valueRatio;
    }
    public function setValueSampledData(SampleData $valueSampledData){
        $this->valueSampledData = $valueSampledData;
    }
    public function setValueTime($valueTime){
        $this->valueTime = $valueTime;
    }
    public function setValueDateTime($valueDateTime){
        $this->valueDateTime = $valueDateTime;
    }
    public function setValuePeriod(Ratio $valuePeriod){
        $this->valuePeriod = $valuePeriod;
    }
    public function setDataAbsentReason(CodeableConcept $dataAbsentReason){
        $this->dataAbsentReason = $dataAbsentReason;
    }
    public function addInterpretation(CodeableConcept $interpretation){
        $this->interpretation[] = $interpretation; 
    }
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    public function setBodySite(CodeableConcept $bodySite){
        $this->bodySite = $bodySite;
    }
    public function setMethod(CodeableConcept $method){
        $this->method = $method;
    }
    public function setSpecimen(Reference $specimen){
        $this->specimen = $specimen;
    }
    public function setDevice(Reference $device){
        $this->device = $device;
    }
    public function setReferenceRange(Quantity $low, Quantity $high, CodeableConcept $type, CodeableConcept $appliesTo, Range $age, $text){
        $this->referenceRange->low = $low;
        $this->referenceRange->high = $high;
        $this->referenceRange->type = $type;
        $this->referenceRange->appliesTo = $appliesTo;
        $this->referenceRange->age = $age;
        $this->referenceRange->text = $text;
    }
    public function addHasMember(Reference $hasMember){
        $this->hasMember[] = $hasMember;
    }
    public function addDerivedFrom(Reference $derivedFrom){
        $this->derivedFrom[] = $derivedFrom;
    }
    public function setComponent(CodeableConcept $code, Quantity $valueQuantity, CodeableConcept $valueCodeableConcept, $valueString, 
        $valueBoolean, $valueInteger, Range $valueRange, Ratio $valueRatio, SampleData $valueSampledData, $valueTime, $valueDateTime,
        Period $period, CodeableConcept $dataAbsentReason, $interpretation, $referenceRange){
        $this->component->code = $code;
        $this->component->valueQuantity = $valueQuantity;
        $this->component->valueCodeableConcept = $valueCodeableConcept;
        $this->component->valueString = $valueString;
        $this->component->valueBoolean = $valueBoolean;
        $this->component->valueInteger = $valueInteger;
        $this->component->valueRange = $valueRange;
        $this->component->valueRatio = $valueRatio;
        $this->component->valueSampledData = $valueSampledData;
        $this->component->valueTime = $valueTime;
        $this->component->valueDateTime = $valueDateTime;
        $this->component->period = $period;
        $this->component->dataAbsentReason = $dataAbsentReason;
        $inters = [];
        foreach($interpretation as $inter){
            if($inter instanceof CodeableConcept)
                $inters[] = $inter;
        }
        $this->component->interpretation = $inters;
        $refences = [];
        foreach($referenceRange as $refes){
            if($refes instanceof CodeableConcept)
                $refences[] = $refes;
        }
        $this->component->referenceRange = $refences;
    }

    public function toArray(){
        $arrayData = parent::toArray();

        foreach($this->identifier as $identifier){
            $arrayData["identifier"][] = $identifier->toArray();
        }
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        if(isset($this->issued)){
            $arrayData["issued"] = $this->issued;
        }
        foreach($this->basedOn as $basedOn){
            $arrayData['basedOn'][] = $basedOn->toArray();
        }
        foreach($this->partOf as $partOf){
            $arrayData["partOf"][] = $partOf->toArray();
        }
        foreach($this->category as $category){
            $arrayData["category"][] = $category->toArray();
        }
        if(isset($this->code)){
            $arrayData["code"] = $this->code->toArray();
        }
        if(isset($this->subject)){
            $arrayData["subject"] = $this->subject->toArray();
        }
        foreach($this->focus as $focus){
            $arrayData["focus"][] = $focus->toArray();
        }
        if(isset($this->encounter)){
            $arrayData["encounter"] = $this->encounter->toArray();
        }
        if(isset($this->effectiveDateTime)){
            $arrayData["effectiveDateTime"] = $this->effectiveDateTime;
        }
        if(isset($this->effectivePeriod)){
            $arrayData["effectivePeriod"] = $this->effectivePeriod->toArray();
        }
        if(isset($this->effectiveTiming)){
            $arrayData["effectiveTiming"] = $this->effectiveTiming->toArray();
        }
        if(isset($this->effectiveInstant)){
            $arrayData["effectiveInstant"] = $this->effectiveInstant;
        }
        foreach($this->performer as $performer){
            $arrayData["performer"][] = $performer->toArray();
        }
        if(isset($this->valueQuantity)){
            $arrayData["valueQuantity"] = $this->valueQuantity->toArray();
        }
        if(isset($this->valueCodeableConcept)){
            $arrayData["valueCodeableConcept"] = $this->valueCodeableConcept->toArray();
        }
        if(isset($this->valueString)){
            $arrayData["valueString"] = $this->valueString;
        }
        if(isset($this->valueBoolean)){
            $arrayData["valueBoolean"] = $this->valueBoolean;
        }
        if(isset($this->valueInteger)){
            $arrayData["valueInteger"] = $this->valueInteger;
        }
        if(isset($this->valueRange)){
            $arrayData["valueRange"] = $this->valueRange->toArray();
        }
        if(isset($this->valueRatio)){
            $arrayData["valueRatio"] = $this->valueRatio->toArray();
        }
        if(isset($this->valueSampledData)){
            $arrayData["valueSampledData"] = $this->valueSampledData->toArray();
        }
        if(isset($this->valueTime)){
            $arrayData["valueTime"] = $this->valueTime;
        }
        if(isset($this->valueDateTime)){
            $arrayData["valueDateTime"] = $this->valueDateTime;
        }
        if(isset($this->valuePeriod)){
            $arrayData["valuePeriod"] = $this->valuePeriod->toArray();
        }
        if(isset($this->dataAbsentReason)){
            $arrayData["dataAbsentReason"] = $this->dataAbsentReason->toArray();
        }
        foreach($this->interpretation as $interpretation){
            $arrayData["interpretation"] = $interpretation->toArray();
        }
        foreach($this->note as $note){
            $arrayData["note"] = $note->toArray();
        }
        if(isset($this->bodySite)){
            $arrayData["bodySite"] = $this->bodySite->toArray();
        }
        if(isset($this->method)){
            $arrayData["method"] = $this->method->toArray();
        }
        if(isset($this->specimen)){
            $arrayData["specimen"] = $this->specimen;
        }
        if(isset($this->device)){
            $arrayData["device"] = $this->device;
        }
        if(isset($this->referenceRange)){
            $arrayData["referenceRange"]["low"] = $this->referenceRange["low"]->toArray();
            $arrayData["referenceRange"]["high"] = $this->referenceRange["high"]->toArray();
            $arrayData["referenceRange"]["type"] = $this->referenceRange["type"]->toArray();
            $arrayData["referenceRange"]["appliesTo"] = $this->referenceRange["appliesTo"]->toArray();
            $arrayData["referenceRange"]["age"] = $this->referenceRange["age"]->toArray();
            $arrayData["referenceRange"]["text"] = $this->referenceRange["text"];
        }
        foreach($this->hasMember as $hasMember){
            $arrayData["hasMember"] = $hasMember->toArray();
        }
        foreach($this->derivedFrom as $derivedFrom){
            $arrayData["derivedFrom"] = $derivedFrom;
        }
        if(isset($this->component)){
            $arrayData["component"] = [];
            if(isset($this->component["code"]))
                $arrayData["component"]["code"] = $this->component["code"]->toArray();
            if(isset($this->component["valueQuantity"]))
                $arrayData["component"]["valueQuantity"] = $this->component["valueQuantity"]->toArray();
            if(isset($this->component["valueCodeableConcept"]))
                $arrayData["component"]["valueCodeableConcept"] = $this->component["valueCodeableConcept"]->toArray();
            if(isset($this->component["valueString"]))
                $arrayData["component"]["valueString"] = $this->component["valueString"];
            if(isset($this->component["valueBoolean"]))
                $arrayData["component"]["valueBoolean"] = $this->component["valueBoolean"];
            if(isset($this->component["valueInteger"]))
                $arrayData["component"]["valueInteger"] = $this->component["valueInteger"];
            if(isset($this->component["valueRange"]))
                $arrayData["component"]["valueRange"] = $this->component["valueRange"]->toArray();
            if(isset($this->component["valueRatio"]))
                $arrayData["component"]["valueRatio"] = $this->component["valueRatio"]->toArray();
            if(isset($this->component["valueSampledData"]))
                $arrayData["component"]["valueSampledData"] = $this->component["valueSampledData"]->toArray();
            if(isset($this->component["valueTime"]))
                $arrayData["component"]["valueTime"] = $this->component["valueTime"];
            if(isset($this->component["valueDateTime"]))
                $arrayData["component"]["valueDateTime"] = $this->component["valueDateTime"];
            if(isset($this->component["period"]))
                $arrayData["component"]["period"] = $this->component["period"]->toArray();
            if(isset($this->component["dataAbsentReason"]))
                $arrayData["component"]["dataAbsentReason"] = $this->component["dataAbsentReason"]->toArray();
            if(isset($this->component["interpretation"])){
                $arrayData["componet"]["interpretation"] = [];
                foreach($this->component->interpretation as $inter){
                    $arrayData["componet"]["interpretation"][] = $inter->toArray();
                }
            }
            if(isset($this->component["referenceRange"])){
                $arrayData["componet"]["referenceRange"] = [];
                foreach($this->component->referenceRange as $referenceRange){
                    $arrayData["componet"]["referenceRange"][] = $referenceRange->toArray();
                }
            }
        }
        return $arrayData;
    }
}
