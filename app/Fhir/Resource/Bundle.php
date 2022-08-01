<?php 
namespace App\Fhir\Resource;

use App\Fhir\Element\Identifier;

class Bundle extends DomainResource{

    public function __construct($json = null){
        parent::__construct($json);
        $this->resourceType = "Bundle";
        $this->entry = [];
        if($json){
            $this->loadData($json);
        }
    }
    /* adquiere un json y lo transforma a Bundle */
    private function loadData($json){
        if(gettype($json) === "string"){
            $json = json_decode($json);
        }
        if(isset($json->entry)){
            foreach($json->entry as $entry){
                if(isset($entry->resource) && isset($entry->resource->resourceType)){
                    $this->addEntry(ResourceBuilder::make($entry->resource));
                }
            }
        }
        if(isset($json->identifier)){
            $this->setIdentifier(Identifier::Load($json->identifier));
        }
        if(isset($json->type)){
            $this->setType($json->type);
        }
        if(isset($json->tipestamp)){
            $this->setTimestamp($json->timestamp);
        }
        if(isset($json->total)){
            $this->setTotal($json->total);
        }
    }
    public function setIdentifier(Identifier $identifier){
        $this->identifier = $identifier;
    }
    public function setType(String $type){
        $only = ["document","message","transaction","transaction-response","batch","batch-response","history","searchset","collection"];
        $this->type = $this->only($only, $type);
    }
    public function setTimestamp(String $timestamp){
        $this->timestamp = $timestamp;
    }
    public function setTotal(String $total){
        $this->total = $total;
    }
    public function addEntry(Resource $resource){
        $this->entry[$resource->id] = $resource;
    }
    /**
     * @param string $id
     * @param integer $skip
     * @param integer $mark
     * @return \App\Fhir\Resource\Resource
    */
    public function findResource($id, $skip = -1, $mark=0){
        /*
        if(!isset($this->entry[$id])){
            dd([$id,$this->entry]);
        }
        $resource = $this->entry[$id];
        if($skip != $resource->mark && isset($resource->id) && $resource->id == $id){
            $resource->mark=$mark;
            return $resource;
        }*/
        foreach($this->entry as $key => $entry){
            $resource = $entry;
            if($skip != $entry->mark && isset($resource->id) && $resource->id == $id){
                $entry->mark=$mark;
                return $entry;
            }
        }
    }
    public function findCompositions($skip = -1, $mark = 0){
        $data = [];
        foreach($this->entry as $key => $entry){
            if($skip != $entry->mark && $entry->resourceType == "Composition"){
                $entry->mark = $mark;
                $data[] = $entry;
            }
        }
        return $data;
    }
    public function findPatient($skip = -1, $mark = 0){
        foreach($this->entry as $key => $entry){
            if($skip != $entry->mark && $entry->resourceType == "Patient"){
                $entry->mark = $mark;
                return $entry;
            }
        }
    }
    public function findAllergy($skip = -1, $mark = 0){
        $data = [];
        foreach($this->entry as $key => $entry){
            if($skip != $entry->mark && $entry->resourceType == "AllergyIntolerance"){
                $entry->mark = $mark;
                $data [] = $entry;
            }
        }
        return $data;
    }

    public function toArray(){
        $arrayData = parent::toArray();

        if(isset($this->identifier)){
            $arrayData["identifier"] = $this->identifier->toArray();
        }
        if(isset($this->type)){
            $arrayData["type"] = $this->type;
        }
        if(isset($this->timestamp)){
            $arrayData["timestamp"] = $this->timestamp;
        }
        if(isset($this->total)){
            $arrayData["total"] = $this->total;
        }

        $entryArray = [];
        foreach ($this->entry as $entry) {
            $current = [];
            $current["resource"]=$entry->toArray();
            $current["fullUrl"]=$entry->id;
            $entryArray[] = $current;
        }
        $arrayData["entry"] = $entryArray;

        return $arrayData;
    }
}