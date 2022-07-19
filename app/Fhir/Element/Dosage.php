<?php

namespace App\Fhir\Element;

class Dosage extends Element{

    public function __construct(){
        parent::__construct();
        $this->additionalInstruction = [];
        $this->doseAndRate = [];
    }

    public function sequence($sequence){
        $this->sequence = $sequence;
    }
    public function text($text){
        $this->text = $text;
    }
    public function additionalInstruction(CodeableConcept $additionalInstruction){
        $this->additionalInstruction[] = $additionalInstruction;
    }
    public function patientInstruction($patientInstruction){
        $this->patientInstruction = $patientInstruction;
    }
    public function timing(Timing $timing){
        $this->timing = $timing;
    }
    public function asNeededBoolean($asNeededBoolean){
        $this->asNeededBoolean = $asNeededBoolean;
    }
    public function asNeededCodeableConcept(CodeableConcept $asNeededCodeableConcept){
        $this->asNeededCodeableConcept = $asNeededCodeableConcept;
    }
    public function site(CodeableConcept $site){
        $this->site = $site;
    }
    public function route(CodeableConcept $route){
        $this->route = $route;
    }
    public function method(CodeableConcept $method){
        $this->method = $method;
    }
    public function doseAndRate(CodeableConcept $type, $dose, $rate){
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
    public function maxDosePerPeriod(Ratio $maxDosePerPeriod){
        $this->maxDosePerPeriod = $maxDosePerPeriod;
    }
    public function maxDosePerAdministration(Quantity $maxDosePerAdministration){
        $this->maxDosePerAdministration = $maxDosePerAdministration;
    }
    public function maxDosePerLifetime(Quantity $maxDosePerLifetime){
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