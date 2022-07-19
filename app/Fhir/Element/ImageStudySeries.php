<?php 

namespace App\Fhir\Element;

use App\Fhir\Element\Reference;
use App\Fhir\Resource\Resource;

class ImageStudySeries extends Element{
    public function __construct(){
        $this->endpoint = [];
        $this->specimen = [];
        $this->performer = [];
        $this->instance = [];
    }
    private function loadData($json){
        if(isset($json->uid))
            $arrayData["uid"] = $json->uid;
        if(isset($json->number))
            $arrayData["number"] = $json->number;
        if(isset($json->modality))
            $arrayData["modality"] = Coding::Load($json->modality);
        if(isset($json->description))
            $arrayData["description"] = $json->description;
        if(isset($json->numberOfInstances))
            $arrayData["numberOfInstances"] = CodeableConcept::Load($json->numberOfInstances);
        if(isset($json->endpoint)){
            foreach($json->endpoint as $endpoint)
                $arrayData["endpoint"][] = Reference::Load($endpoint);
        }
        if(isset($json->bodySite))
            $arrayData["bodySite"] = Coding::Load($json->bodySite);
        if(isset($json->laterality))
            $arrayData["laterality"] = Coding::Load($json->laterality);
        if(isset($json->specimen)){
            foreach($json->specimen as $specimen)
                $arrayData["specimen"][] = Reference::Load($specimen);
        }
        if(isset($json->started))
            $arrayData["started"] = $json->started;
        if(isset($json->performer))
            foreach($json->performer as $performer){
                $data = [];
                if(isset($performer->actor))
                    $data["actor"] = Reference::Load($performer->actor);
                if(isset($json->function))
                    $data["function"] = Reference::Load($performer->function);
                $arrayData["performer"][] = $data;
            }
        if(isset($json->instance)){
            foreach($json->instance as $instance){
                $data = [];
                if(isset($instance->uid))
                    $data["uid"] = $instance->uid;
                if(isset($instance->number))
                    $data["number"] = $instance->number;
                if(isset($instance->title))
                    $data["title"] = $instance->title;
                if(isset($instance->sopClass))
                    $data["sopClass"] = $instance->sopClass;
                $arrayData["instance"][] = $data;
            }
        }
    }
    public static function Load($json){
        $series = new ImageStudySeries();
        $series->loadData($json);
        return $series;
    }
    public function setUid($uid){
        $this->uid = $uid;
    }
    public function setNumber($number){
        $this->number = $number;
    }
    public function setModality(Coding $modality){
        $this->modality = $modality;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setNumberOfInstances(CodeableConcept $numberOfInstances){
        $this->numberOfInstances = $numberOfInstances;
    }
    public function addEndpoint(Reference $endpoint){
        $this->endpoint[] = $endpoint;
    }
    public function setBodySite(Coding $bodySite){
        $this->bodySite = $bodySite;
    }
    public function setLaterality(Coding $laterality){
        $this->laterality = $laterality;
    }
    public function addSpecimen(Reference $specimen){
        $this->specimen[] = $specimen;
    }
    public function setStarted($started){
        $this->started = $started;
    }
    public function addPerformer(CodeableConcept $function, Resource $actor){
        $performer = [
            "function"=>$function,
            "actor"=>$actor->toReference(),
        ];
        $this->performer[] = $performer;
    }
    public function addInstance($uid, $number, $title, Coding $sopClass){
        $instance = [
            "uid"=>$uid,
            "number"=>$number,
            "title"=>$title,
            "sopClass"=>$sopClass,
        ];
        $this->instance[] = $instance;
    }
    public function toArray(){
        $arrayData = [];
        if(isset($this->uid))
            $arrayData["uid"] = $this->uid;
        if(isset($this->number))
            $arrayData["number"] = $this->number;
        if(isset($this->modality))
            $arrayData["modality"] = $this->modality->toArray();
        if(isset($this->description))
            $arrayData["description"] = $this->description;
        if(isset($this->numberOfInstances))
            $arrayData["numberOfInstances"] = $this->numberOfInstances->toArray();
        foreach($this->endpoint as $endpoint)
            $arrayData["endpoint"][] = $endpoint->toArray();
        if(isset($this->bodySite))
            $arrayData["bodySite"] = $this->bodySite->toArray();
        if(isset($this->laterality))
            $arrayData["laterality"] = $this->laterality->toArray();
        foreach($this->specimen as $specimen)
            $arrayData["specimen"] = $specimen->toArray();
        if(isset($this->started))
            $arrayData["started"] = $this->started;
        if(isset($this->performer)){
            foreach($this->performer as $performer){
                $data = [];
                if(isset($performer->actor))
                    $data["actor"] = $performer->actor;
                if(isset($performer->function))
                    $data["function"] = $performer->function;
                $arrayData["performer"][] = $data;
            }
        }
        if(isset($this->instance)){
            foreach($this->instance as $instance){
                $data = [];
                if(isset($instance->uid))
                    $data["uid"] = $instance->uid;
                if(isset($instance->number))
                    $data["number"] = $instance->number;
                if(isset($instance->title))
                    $data["title"] = $instance->title;
                if(isset($instance->sopClass))
                    $data["sopClass"] = $instance->sopClass->toArray();
                $arrayData["instance"][] = $data;
            }
        }
        return $arrayData;
    }
}