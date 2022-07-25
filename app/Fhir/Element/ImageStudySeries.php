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
            $this->uid = $json->uid;
        if(isset($json->number))
            $this->number = $json->number;
        if(isset($json->modality))
            $this->modality = Coding::Load($json->modality);
        if(isset($json->description))
            $this->description = $json->description;
        if(isset($json->numberOfInstances))
            $this->numberOfInstances = $json->numberOfInstances;
        if(isset($json->endpoint)){
            foreach($json->endpoint as $endpoint)
                $this->endpoint[] = Reference::Load($endpoint);
        }
        if(isset($json->bodySite))
            $this->bodySite = Coding::Load($json->bodySite);
        if(isset($json->laterality))
            $this->laterality = Coding::Load($json->laterality);
        if(isset($json->specimen)){
            foreach($json->specimen as $specimen)
                $this->specimen[] = Reference::Load($specimen);
        }
        if(isset($json->started))
            $this->started = $json->started;
        if(isset($json->performer))
            foreach($json->performer as $performer){
                $data = [];
                if(isset($performer->actor))
                    $data["actor"] = Reference::Load($performer->actor);
                if(isset($performer->function))
                    $data["function"] = CodeableConcept::Load($performer->function);
                $this->performer[] = $data;
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
                    $data["sopClass"] = Coding::Load($instance->sopClass);
                $this->instance[] = $data;
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
    public function addEndpoint(Resource $endpoint){
        $this->endpoint[] = $endpoint->toReference();
    }
    public function setBodySite(Coding $bodySite){
        $this->bodySite = $bodySite;
    }
    public function setLaterality(Coding $laterality){
        $this->laterality = $laterality;
    }
    public function addSpecimen(Resource $specimen){
        $this->specimen[] = $specimen->toReference();
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
        if(isset($this->numberOfInstances) && $this->numberOfInstances)
            $arrayData["numberOfInstances"] = $this->numberOfInstances;
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
                if(isset($performer["actor"]))
                    $data["actor"] = $performer["actor"]->toArray();
                if(isset($performer["function"]))
                    $data["function"] = $performer["function"]->toArray();
                $arrayData["performer"][] = $data;
            }
        }
        if(isset($this->instance)){
            foreach($this->instance as $instance){
                $data = [];
                if(isset($instance["uid"]))
                    $data["uid"] = $instance["uid"];
                if(isset($instance["number"]))
                    $data["number"] = $instance["number"];
                if(isset($instance["title"]))
                    $data["title"] = $instance["title"];
                if(isset($instance["sopClass"]))
                    $data["sopClass"] = $instance["sopClass"]->toArray();
                $arrayData["instance"][] = $data;
            }
        }
        return $arrayData;
    }
}