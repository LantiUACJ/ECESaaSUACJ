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
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if(isset($json->status))
            $this->status = $json->status;
        if(isset($json->issued))
            $this->issued = $json->issued;
        if(isset($json->basedOn))
            foreach($json->basedOn as $basedOn)
                $this->basedOn[] = Reference::Load($basedOn);
        if(isset($json->partOf))
            foreach($json->partOf as $partOf)
                $this->partOf[] = $partOf->toArray();
        if(isset($json->category))
            foreach($json->category as $category)
                $this->category[] = CodeableConcept::Load($category);
        if(isset($json->code))
            $this->code = CodeableConcept::Load($json->code);
        if(isset($json->subject))
            $this->subject = Reference::Load($json->subject);
        if(isset($json->focus))
            foreach($json->focus as $focus)
                $this->focus[] = Reference::Load($focus);
        if(isset($json->encounter))
            $this->encounter = Reference::Load($json->encounter);
        if(isset($json->effectiveDateTime))
            $this->effectiveDateTime = $json->effectiveDateTime;
        if(isset($json->effectivePeriod))
            $this->effectivePeriod = Period::Load($json->effectivePeriod);
        if(isset($json->effectiveTiming))
            $this->effectiveTiming = Timing::Load($json->effectiveTiming);
        if(isset($json->effectiveInstant))
            $this->effectiveInstant = $json->effectiveInstant;
        if(isset($json->performer))
            foreach($json->performer as $performer)
                $this->performer[] = Reference::Load($performer);
        if(isset($json->valueQuantity))
            $this->valueQuantity = Quantity::Load($json->valueQuantity);
        if(isset($json->valueCodeableConcept))
            $this->valueCodeableConcept = CodeableConcept::Load($json->valueCodeableConcept);
        if(isset($json->valueString))
            $this->valueString = $json->valueString;
        if(isset($json->valueBoolean))
            $this->valueBoolean = $json->valueBoolean;
        if(isset($json->valueInteger))
            $this->valueInteger = $json->valueInteger;
        if(isset($json->valueRange))
            $this->valueRange = Range::Load($json->valueRange);
        if(isset($json->valueRatio))
            $this->valueRatio = Ratio::Load($json->valueRatio);
        if(isset($json->valueSampledData))
            $this->valueSampledData = SampleData::Load($json->valueSampledData);
        if(isset($json->valueTime))
            $this->valueTime = $json->valueTime;
        if(isset($json->valueDateTime))
            $this->valueDateTime = $json->valueDateTime;
        if(isset($json->valuePeriod))
            $this->valuePeriod = Period::Load($json->valuePeriod);
        if(isset($json->dataAbsentReason))
            $this->dataAbsentReason = CodeableConcept::Load($json->dataAbsentReason);
        if(isset($json->interpretation))
            foreach($json->interpretation as $interpretation)
                $this->interpretation[] = CodeableConcept::Load($interpretation);
        if(isset($json->note))
            foreach($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if(isset($json->bodySite))
            $this->bodySite = Reference::Load($json->bodySite);
        if(isset($json->method))
            $this->method = CodeableConcept::Load($json->method);
        if(isset($json->specimen))
            $this->specimen = $json->specimen;
        if(isset($json->device))
            $this->device = $json->device;
        if(isset($json->referenceRange)){
            foreach($json->referenceRange as $referenceRange){
                $data = [];
                if(isset($referenceRange->low))
                    $data["low"] = Quantity::Load($referenceRange->low);
                if(isset($referenceRange->high))
                    $data["high"] = Quantity::Load($referenceRange->high);
                if(isset($referenceRange->type))
                    $data["type"] = CodeableConcept::Load($referenceRange->type);
                if(isset($referenceRange->appliesTo))
                    $data["appliesTo"] = CodeableConcept::Load($referenceRange->appliesTo);
                if(isset($referenceRange->age))
                    $data["age"] = Range::Load($referenceRange->age);
                if(isset($referenceRange->text))
                    $data["text"] = $referenceRange->text;
                $this->referenceRange[] = $data;
            }
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
    /* obligatorio solo: "registered", "preliminary", "final", "amended" */
    public function setStatus($status){
        $only = ["registered", "preliminary", "final", "amended"];
        $this->status = $status;
    }
    public function setIssued($issued){
        $this->issued = $issued;
    }
    public function addtBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function addPartOf(Resource $partOf){
        $this->partOf[] = $partOf->toReference();
    }
    /* obligatorio 
        \Fhir\Element\CodeableConcept
            "coding": \Fhir\Element\Coding (array 1..*)
                "code": 
                "display":
                "system": 
            "text":
    */
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    /* obligatorio 
        \Fhir\Element\CodeableConcept
            "coding": \Fhir\Element\Coding (array 1..*)
                "code": 
                "display":
                "system": 
            "text":
    */
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    /* obligatorio */
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function addFocus(Resource $focus){
        $this->focus[] = $focus->toReference();
    }
    /* obligatorio */
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    /* 
                                      v es una letra T (constante)
        obligatorio formato YYYY-MM-DDTHH:II:SS.000Z
        ejemplo: 2022-05-25T09:40:00.000Z
    */
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
    public function addPerformer(Resource $performer){
        $this->performer[] = $performer->toReference();
    }
    /* Obligatorio (almenos un value, puede ser valueQuantity, valuestring, etc) 
        \Fhir\Element\Quantity:
        "value": 
        "unit": 
        "code": 
        "system":
    */
    public function setValueQuantity(Quantity $valueQuantity){
        $this->valueQuantity = $valueQuantity;
    }
    /* Obligatorio (almenos un value, puede ser valueQuantity, valuestring, etc) 
        \Fhir\Element\CodeableConcept
            "coding": \Fhir\Element\Coding (array 1..*)
                "code": 
                "display":
                "system": 
            "text":
    */
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
    public function setSpecimen(Resource $specimen){
        $this->specimen = $specimen->toReference();
    }
    public function setDevice(Resource $device){
        $this->device = $device->toReference();
    }
    public function setReferenceRange(Quantity $low, Quantity $high, CodeableConcept $type, CodeableConcept $appliesTo, Range $age, $text){
        $this->referenceRange->low = $low;
        $this->referenceRange->high = $high;
        $this->referenceRange->type = $type;
        $this->referenceRange->appliesTo = $appliesTo;
        $this->referenceRange->age = $age;
        $this->referenceRange->text = $text;
    }
    public function addHasMember(Resource $hasMember){
        $this->hasMember[] = $hasMember->toReference();
    }
    public function addDerivedFrom(Resource $derivedFrom){
        $this->derivedFrom[] = $derivedFrom->toReference();
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

    public function toString(){
        $display = "Observación: ";
        if(isset($this->code) && isset($this->code->text)){
            $display .= $this->code->text . " ";
        }
        if(isset($this->effectiveDateTime)){
            $display .= "(" . $this->effectiveDateTime . ")";
        }
        if(isset($this->effectivePeriod)){
            $display .= "(" . $this->effectivePeriod->toString() . ")";
        }
        if(isset($this->effectiveTiming)){
            $display .= "(" . $this->effectiveTiming->toString() . ")";
        }
        if(isset($this->effectiveInstant)){
            $display .= "(" . $this->effectiveInstant . ")";
        }
        /*
        if(isset($this->valueQuantity)){
            $display .= $this->valueQuantity->toString() . " ";
        }
        if(isset($this->valueCodeableConcept)){
            $display .= $this->valueCodeableConcept->toString() . " ";
        }
        if(isset($this->valueString)){
            $display .= $this->valueString . " ";
        }
        if(isset($this->valueBoolean)){
            $display .= $this->valueBoolean . " ";
        }
        if(isset($this->valueInteger)){
            $display .= $this->valueInteger . " ";
        }
        if(isset($this->valueRange)){
            $display .= $this->valueRange->toString() . " ";
        }
        if(isset($this->valueRatio)){
            $display .= $this->valueRatio->toString() . " ";
        }
        if(isset($this->valueSampledData)){
            $display .= $this->valueSampledData->toString() . " ";
        }
        if(isset($this->valueTime)){
            $display .= $this->valueTime . " ";
        }
        if(isset($this->valueDateTime)){
            $display .= $this->valueDateTime . " ";
        }
        if(isset($this->valuePeriod)){
            $display .= $this->valuePeriod->toString() . " ";
        }*/
        return trim($display);
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
        $value = 0;
        if(isset($this->valueQuantity) && $this->valueQuantity){
            $arrayData["valueQuantity"] = $this->valueQuantity->toArray();
            $value +=1;
        }
        if(isset($this->valueCodeableConcept) && $this->valueCodeableConcept){
            $arrayData["valueCodeableConcept"] = $this->valueCodeableConcept->toArray();
            $value +=1;
        }
        if(isset($this->valueString) && $this->valueString){
            $arrayData["valueString"] = $this->valueString;
            $value +=1;
        }
        if(isset($this->valueBoolean) && $this->valueBoolean){
            $arrayData["valueBoolean"] = $this->valueBoolean;
            $value +=1;
        }
        if(isset($this->valueInteger) && $this->valueInteger){
            $arrayData["valueInteger"] = $this->valueInteger;
            $value +=1;
        }
        if(isset($this->valueRange) && $this->valueRange){
            $arrayData["valueRange"] = $this->valueRange->toArray();
            $value +=1;
        }
        if(isset($this->valueRatio) && $this->valueRatio){
            $arrayData["valueRatio"] = $this->valueRatio->toArray();
            $value +=1;
        }
        if(isset($this->valueSampledData) && $this->valueSampledData){
            $arrayData["valueSampledData"] = $this->valueSampledData->toArray();
            $value +=1;
        }
        if(isset($this->valueTime) && $this->valueTime){
            $arrayData["valueTime"] = $this->valueTime;
            $value +=1;
        }
        if(isset($this->valueDateTime) && $this->valueDateTime){
            $arrayData["valueDateTime"] = $this->valueDateTime;
            $value +=1;
        }
        if(isset($this->valuePeriod) && $this->valuePeriod){
            $arrayData["valuePeriod"] = $this->valuePeriod->toArray();
            $value +=1;
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
            foreach($this->referenceRange as $reference){
                $data = [];
                if(isset($reference["low"]))
                    $data["low"] = $reference["low"]->toArray();
                if(isset($reference["high"]))
                    $data["high"] = $reference["high"]->toArray();
                if(isset($reference["type"]))
                    $data["type"] = $reference["type"]->toArray();
                if(isset($reference["appliesTo"]))
                    $data["appliesTo"] = $reference["appliesTo"]->toArray();
                if(isset($reference["age"]))
                    $data["age"] = $reference["age"]->toArray();
                if(isset($reference["text"]))
                    $data["text"] = $reference["text"];
                $arrayData["referenceRange"][] = $data;
            }
        }
        foreach($this->hasMember as $hasMember){
            $arrayData["hasMember"][] = $hasMember->toArray();
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
