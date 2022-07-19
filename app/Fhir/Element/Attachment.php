<?php

namespace App\Fhir\Element;

class Attachment extends Element{

    public function __construct(){
        parent::__construct();
    }

    public function loadData($json){
        if(isset($json->contentType))
            $this->contentType=$json->contentType;
        if(isset($json->language))
            $this->language=$json->language;
        if(isset($json->data))
            $this->data=$json->data;
        if(isset($json->url))
            $this->url=$json->url;
        if(isset($json->size))
            $this->size=$json->size;
        if(isset($json->hash))
            $this->hash=$json->hash;
        if(isset($json->title))
            $this->title=$json->title;
        if(isset($json->creation))
            $this->creation=$json->creation;
    }
    public static function Load($json){
        $attachment = new Attachment();
        $attachment->loadData($json);
        return $attachment;
    }
    public function setContentType($contentType){
        $this->contentType = $contentType;
    }
    public function setLanguage($language){
        $this->language = $language;
    }
    public function setData($data){
        $this->data = base64_encode($data);
    }
    public function setUrl($url){
        $this->url = $url;
    }
    public function setSize($size){
        $this->size = $size;
    }
    public function setHash($hash){
        $this->hash = $hash;
    }
    public function setTitle($title){
        $this->title = $title;        
    }
    public function setCreation($creation){
        $this->creation = $creation;
    }
    
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->contentType))
            $arrayData["contentType"]=$this->contentType;
        if(isset($this->language))
            $arrayData["language"]=$this->language;
        if(isset($this->data))
            $arrayData["data"]=$this->data;
        if(isset($this->url))
            $arrayData["url"]=$this->url;
        if(isset($this->size))
            $arrayData["size"]=$this->size;
        if(isset($this->hash))
            $arrayData["hash"]=$this->hash;
        if(isset($this->title))
            $arrayData["title"]=$this->title;
        if(isset($this->creation))
            $arrayData["creation"]=$this->creation;
        return $arrayData;
    }
}
