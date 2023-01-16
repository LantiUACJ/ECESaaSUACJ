<?php

namespace App\Fhir\Element;

class Timing extends Element{

    public function  __construct(){
        parent::__construct();
        $this->repeat = [];
        $this->event = [];
    }

    private function loadData($json){
        if(isset($json->event))
            foreach($json->event as $event)
                $this->event = $event;
        if(isset($json->repeat)){
            if(isset($json->repeat->boundsDuration)){
                $this->repeat["boundsDuration"] = $json->repeat->boundsDuration;
            }
            if(isset($json->repeat->boundsRange)){
                $this->repeat["boundsRange"] = $json->repeat->boundsRange;
            }
            if(isset($json->repeat->boundsPeriod)){
                $this->repeat["boundsPeriod"] = $json->repeat->boundsPeriod;
            }
            if(isset($json->repeat->count)){
                $this->repeat["count"] = $json->repeat->count;
            }
            if(isset($json->repeat->countMax)){
                $this->repeat["countMax"] = $json->repeat->countMax;
            }
            if(isset($json->repeat->duration)){
                $this->repeat["duration"] = $json->repeat->duration;
            }
            if(isset($json->repeat->durationMax)){
                $this->repeat["durationMax"] = $json->repeat->durationMax;
            }
            if(isset($json->repeat->durationUnit)){
                $this->repeat["durationUnit"] = $json->repeat->durationUnit;
            }
            if(isset($json->repeat->frequency)){
                $this->repeat["frequency"] = $json->repeat->frequency;
            }
            if(isset($json->repeat->frequencyMax)){
                $this->repeat["frequencyMax"] = $json->repeat->frequencyMax;
            }
            if(isset($json->repeat->period)){
                $this->repeat["period"] = $json->repeat->period;
            }
            if(isset($json->repeat->periodMax)){
                $this->repeat["periodMax"] = $json->repeat->periodMax;
            }
            if(isset($json->repeat->periodUnit)){
                $this->repeat["periodUnit"] = $json->repeat->periodUnit;
            }
            if(isset($json->repeat->dayOfWeek))
                foreach($json->dayOfWeek as $dayOfWeek){
                    $this->repeat["dayOfWeek"][] = $dayOfWeek;
                }
            if(isset($json->repeat->timeOfDay))
                foreach($json->timeOfDay as $timeOfDay){
                    $this->repeat["timeOfDay"][] = $timeOfDay;
                }
            if(isset($json->repeat->when))
                foreach($json->when as $when){
                    $this->repeat["when"][] = $when;
                }
            if(isset($json->repeat->offset)){
                $this->repeat["offset"] = $json->repeat->offset;
            }
        }
        if(isset($json->code)){
            $this->code = $json->code;
        }
    }

    public static function Load($json){
        $timing = new Timing();
        $timing->loadData($json);
        return $timing;
    }

    public function setEvent($event){
        $this->event = $event;
    }
    public function setBoundsDuration(Quantity $boundsDuration){
        $this->repeat["boundsDuration"] =  $boundsDuration;
    }
    public function setBoundsRange(Range $boundsRange){
        $this->repeat["boundsRange"] = $boundsRange;
    }
    public function setBoundsPeriod(Period $boundsPeriod){
        $this->repeat["boundsPeriod"] = $boundsPeriod;
    }
    public function setCount($count){
        $this->repeat["count"] = $count;
    }
    public function setCountMax($countMax){
        $this->repeat["countMax"] = $countMax;
    }
    public function setDuration($duration){
        $this->repeat["duration"] = $duration;
    }
    public function setDurationMax($durationMax){
        $this->repeat["durationMax"] = $durationMax;
    }
    public function setDurationUnit($durationUnit){
        $codes = "s | min | h | d | wk | mo | a";
        $this->repeat["durationUnit"] = $durationUnit;
    }
    public function setFrequency($frequency){
        $this->repeat["frequency"] = $frequency;
    }
    public function setFrequencyMax($frequencyMax){
        $this->repeat["frequencyMax"] = $frequencyMax;
    }
    public function setPeriod($period){
        $this->repeat["period"] = $period;
    }
    public function setPeriodMax($periodMax){
        $this->repeat["periodMax"] = $periodMax;
    }
    public function setPeriodUnit($periodUnit){
        $codes = "s | min | h | d | wk | mo | a";
        $this->repeat["periodUnit"] = $periodUnit;
    }
    public function addDayOfWeek($dayOfWeek){
        $codes = 'mon | tue | wed | thu | fri | sat | sun';
        $this->repeat["dayOfWeek"][] = $dayOfWeek;
    }
    public function addTimeOfDay($timeOfDay){
        $this->repeat["timeOfDay"][] = $timeOfDay;
    }
    public function addWhen($when){
        $this->repeat["when"][] = $when;
    }
    public function setOffset($offset){
        $this->repeat["offset"] = $offset;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->event) && $this->event){
            foreach($this->event as $event)
                $arrayData["event"] = $event;
        }
        if(isset($this->repeat["boundsDuration"]) && $this->repeat["boundsDuration"]){
            $arrayData["repeat"]["boundsDuration"] =  $this->repeat["boundsDuration"];
        }
        if(isset($this->repeat["boundsRange"]) && $this->repeat["boundsRange"]){
            $arrayData["repeat"]["boundsRange"] = $this->repeat["boundsRange"];
        }
        if(isset($this->repeat["boundsPeriod"]) && $this->repeat["boundsPeriod"]){
            $arrayData["repeat"]["boundsPeriod"] = $this->repeat["boundsPeriod"];
        }
        if(isset($this->repeat["count"]) && $this->repeat["count"]){
            $arrayData["repeat"]["count"] = $this->repeat["count"];
        }
        if(isset($this->repeat["countMax"]) && $this->repeat["countMax"]){
            $arrayData["repeat"]["countMax"] = $this->repeat["countMax"];
        }
        if(isset($this->repeat["duration"]) && $this->repeat["duration"]){
            $arrayData["repeat"]["duration"] = $this->repeat["duration"];
        }
        if(isset($this->repeat["durationMax"]) && $this->repeat["durationMax"]){
            $arrayData["repeat"]["durationMax"] = $this->repeat["durationMax"];
        }
        if(isset($this->repeat["durationUnit"]) && $this->repeat["durationUnit"]){
            $arrayData["repeat"]["durationUnit"] = $this->repeat["durationUnit"];
        }
        if(isset($this->repeat["frequency"]) && $this->repeat["frequency"]){
            $arrayData["repeat"]["frequency"] = $this->repeat["frequency"];
        }
        if(isset($this->repeat["frequencyMax"]) && $this->repeat["frequencyMax"]){
            $arrayData["repeat"]["frequencyMax"] = $this->repeat["frequencyMax"];
        }
        if(isset($this->repeat["period"]) && $this->repeat["period"]){
            $arrayData["repeat"]["period"] = $this->repeat["period"];
        }
        if(isset($this->repeat["periodMax"]) && $this->repeat["periodMax"]){
            $arrayData["repeat"]["periodMax"] = $this->repeat["periodMax"];
        }
        if(isset($this->repeat["periodUnit"]) && $this->repeat["periodUnit"]){
            $arrayData["repeat"]["periodUnit"] = $this->repeat["periodUnit"];
        }
        if(isset($this->repeat["dayOfWeek"]) && $this->repeat["dayOfWeek"]){
            foreach($this->repeat["dayOfWeek"] as $dayOfWeek)
                $arrayData["repeat"]["dayOfWeek"][] = $dayOfWeek;
        }
        if(isset($this->repeat["timeOfDay"]) && $this->repeat["timeOfDay"]){
            foreach($this->repeat["timeOfDay"] as $timeOfDay)
                $arrayData["repeat"]["timeOfDay"][] = $timeOfDay;
        }
        if(isset($this->repeat["when"]) && $this->repeat["when"]){
            foreach($this->repeat["when"] as $when)
                $arrayData["repeat"]["when"][] = $when;
        }
        if(isset($this->repeat["offset"]) && $this->repeat["offset"]){
            $arrayData["repeat"]["offset"] = $this->repeat["offset"];
        }
        if(isset($this->code) && $this->code){
            $arrayData["code"] = $this->code;
        }

        return $arrayData;
    }
    
}
    