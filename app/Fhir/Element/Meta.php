<?php

namespace App\Fhir\Element;

class Meta extends Element{
    public function __construct(){
        parent::__construct();
        $this->profile=[];
        $this->security=[];
        $this->tag=[];
    }
    private function loadData($json){
        if(isset($json->versionId)) $this->setVersionId($json->versionId);
        if(isset($json->lastUpdated)) $this->setLastUpdated($json->lastUpdated);
        if(isset($json->source)) $this->setSource($json->source);
        if(isset($json->profile))
            foreach($json->profile as $profile)
                $this->addProfile($profile);
        if(isset($json->security))
            foreach($json->security as $security)
                $this->addSecurity(Coding::Load($security));
        if(isset($json->tag))
            foreach($json->tag as $tag)
                $this->addTag(Coding::Load($tag));
    }
    public static function Load($json){
        $meta = new Meta();
        $meta->loadData($json);
        return $meta;
    }
    public function setVersionId($versionId){
        $this->versionId = $versionId;
    }
    public function setLastUpdated($lastUpdated){
        $this->lastUpdated = $lastUpdated;
    }
    public function setSource($source){
        $this->source = $source;
    }
    public function addProfile($profile){
        $this->profile[] = $profile;
    }
    public function addSecurity(Coding $security){
        $this->security[] = $security;
    }
    public function addTag(Coding $tag){
        $this->tag[] = $tag;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->versionId)) $arrayData["versionId"] = $this->versionId;
        if(isset($this->lastUpdated)) $arrayData["lastUpdated"] = $this->lastUpdated;
        if(isset($this->source)) $arrayData["source"] = $this->source;
        if(isset($this->profile))
            foreach($this->profile as $profile) 
                $arrayData["profile"] = $profile;
        if(isset($this->security))
            foreach($this->security as $security)
                $arrayData["security"] = $security->toArray();
        if(isset($this->tag))
            foreach($this->tag as $tag)
                $arrayData["tag"] = $tag->toArray();
        return $arrayData;
    }
}

