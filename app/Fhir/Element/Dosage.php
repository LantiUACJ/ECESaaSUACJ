<?php

namespace App\Fhir\Element;

class Dosage extends Element{

    public function __construct(){
        parent::__construct();
        $this->additionalInstruction = [];
        $this->doseAndRate = [];
    }

    private function loadData($json){
        if(isset($json->sequence))
            $this->sequence = $json->sequence;
        if(isset($json->text))
            $this->text = $json->text;
        if(isset($json->additionalInstruction))
            foreach($json->additionalInstruction as $additionalInstruction)
                $this->additionalInstruction[] = CodeableConcept::Load($additionalInstruction);
        if(isset($json->patientInstruction))
            $this->patientInstruction = $json->patientInstruction;
        if(isset($json->timing))
            $this->timing = Timing::Load($json->timing);
        if(isset($json->asNeededBoolean))
            $this->asNeededBoolean = $json->asNeededBoolean;
        if(isset($json->asNeededCodeableConcept))
            $this->asNeededCodeableConcept = CodeableConcept::Load($json->asNeededCodeableConcept);
        if(isset($json->site))
            $this->site = CodeableConcept::Load($json->site);
        if(isset($json->route))
            $this->route = CodeableConcept::Load($json->route);
        if(isset($json->method))
            $this->method = CodeableConcept::Load($json->method);
        if(isset($json->doseAndRate))
            foreach($json->doseAndRate as $doseAndRate){
                $element = [];
                if(isset($doseAndRate->type)){
                    $element["type"] = CodeableConcept::Load($doseAndRate->type);
                }
                if(isset($doseAndRate->doseRange)){
                    $element["doseRange"] = Range::Load($doseAndRate->doseRange);
                }
                if(isset($doseAndRate->doseQuantity)){
                    $element["doseQuantity"] = Quantity::Load($doseAndRate->doseQuantity);
                }
                if(isset($doseAndRate->rateRatio)){
                    $element["rateRatio"] = Ratio::Load($doseAndRate->rateRatio);
                }
                if(isset($doseAndRate->rateRange)){
                    $element["rateRange"] = Range::Load($doseAndRate->rateRange);
                }
                if(isset($doseAndRate->rateQuantity)){
                    $element["rateQuantity"] = Quantity::Load($doseAndRate->rateQuantity);
                }
                $this->doseAndRate[] = $element;
            }
        if(isset($json->maxDosePerPeriod))
            $this->maxDosePerPeriod = Ratio::Load($json->maxDosePerPeriod);
        if(isset($json->maxDosePerAdministration))
            $this->maxDosePerAdministration = Quantity::Load($json->maxDosePerAdministration);
        if(isset($json->maxDosePerLifetime))
            $this->maxDosePerLifetime = Quantity::Load($json->maxDosePerLifetime);
    }

    public static function Load($json){
        $contactdetail = new Dosage("");
        $contactdetail->loadData($json);
        return $contactdetail;
    }

    public function setSequence($sequence){
        $this->sequence = $sequence;
    }
    public function setText($text){
        $this->text = $text;
    }
    public function addAdditionalInstruction(CodeableConcept $additionalInstruction){
        $this->additionalInstruction[] = $additionalInstruction;
    }
    public function setPatientInstruction($patientInstruction){
        $this->patientInstruction = $patientInstruction;
    }
    public function setTiming(Timing $timing){
        $this->timing = $timing;
    }
    public function setAsNeededBoolean($asNeededBoolean){
        $this->asNeededBoolean = $asNeededBoolean;
    }
    public function setAsNeededCodeableConcept(CodeableConcept $asNeededCodeableConcept){
        $this->asNeededCodeableConcept = $asNeededCodeableConcept;
    }
    public function setSite(CodeableConcept $site){
        $this->site = $site;
    }
    public function setRoute(CodeableConcept $route){
        $this->route = $route;
    }
    public function setMethod(CodeableConcept $method){
        $this->method = $method;
    }
    public function addDoseAndRate(CodeableConcept $type, $dose, $rate){
        $doseAndRate = [];
        $doseAndRate["type"] = $type;
        if($dose instanceof Range || $dose instanceof Quantity){
            if($dose instanceof Range){
                $doseAndRate["doseRange"] = $dose;
            }
            if($dose instanceof Quantity){
                $doseAndRate["doseQuantity"] = $dose;
            }
        }
        if($rate instanceof Ratio || $rate instanceof Range || $rate instanceof Quantity){
            if($rate instanceof Ratio){
                $doseAndRate["rateRatio"] = $rate;
            }
            if($rate instanceof Range){
                $doseAndRate["rateRange"] = $rate;
            }
            if($rate instanceof Quantity){
                $doseAndRate["rateQuantity"] = $rate;
            }
        }
        $this->doseAndRate[] = $doseAndRate;
    }
    public function setMaxDosePerPeriod(Ratio $maxDosePerPeriod){
        $this->maxDosePerPeriod = $maxDosePerPeriod;
    }
    public function setMaxDosePerAdministration(Quantity $maxDosePerAdministration){
        $this->maxDosePerAdministration = $maxDosePerAdministration;
    }
    public function setMaxDosePerLifetime(Quantity $maxDosePerLifetime){
        $this->maxDosePerLifetime = $maxDosePerLifetime;
    }

    public function toArray(){
        $arrayData = parent::toArray();

        if(isset($this->sequence))
            $arrayData["sequence"] = $this->sequence;
        if(isset($this->text))
            $arrayData["text"] = $this->text;
        foreach($this->additionalInstruction as $additionalInstruction)
            $arrayData["additionalInstruction"][] = $additionalInstruction->toArray();
        if(isset($this->patientInstruction))
            $arrayData["patientInstruction"] = $this->patientInstruction;
        if(isset($this->timing))
            $arrayData["timing"] = $this->timing->toArray();
        if(isset($this->asNeededBoolean))
            $arrayData["asNeededBoolean"] = $this->asNeededBoolean;
        if(isset($this->asNeededCodeableConcept))
            $arrayData["asNeededCodeableConcept"] = $this->asNeededCodeableConcept->toArray();
        if(isset($this->site))
            $arrayData["site"] = $this->site->toArray();
        if(isset($this->route))
            $arrayData["route"] = $this->route->toArray();
        if(isset($this->method))
            $arrayData["method"] = $this->method->toArray();
        foreach($this->doseAndRate as $doseAndRate){
            $element = [];
            $element["type"] = $doseAndRate["type"]->toArray();
            if(isset($doseAndRate["doseRange"])){
                $element["doseRange"] = $doseAndRate["doseRange"]->toArray();
            }
            if(isset($doseAndRate["doseQuantity"])){
                $element["doseQuantity"] = $doseAndRate["doseQuantity"]->toArray();
            }
            if(isset($doseAndRate["rateRatio"])){
                $element["rateRatio"] = $doseAndRate["rateRatio"]->toArray();
            }
            if(isset($doseAndRate["rateRange"])){
                $element["rateRange"] = $doseAndRate["rateRange"]->toArray();
            }
            if(isset($doseAndRate["rateQuantity"])){
                $element["rateQuantity"] = $doseAndRate["rateQuantity"]->toArray();
            }
            $arrayData["doseAndRate"][] = $element;
        }
        if(isset($this->maxDosePerPeriod))
            $arrayData["maxDosePerPeriod"] = $this->maxDosePerPeriod->toArray();
        if(isset($this->maxDosePerAdministration))
            $arrayData["maxDosePerAdministration"] = $this->maxDosePerAdministration->toArray();
        if(isset($this->maxDosePerLifetime))
            $arrayData["maxDosePerLifetime"] = $this->maxDosePerLifetime->toArray();
        return $arrayData;
    }
}