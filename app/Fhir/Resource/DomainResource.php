<?php

namespace App\Fhir\Resource;

use App\Fhir\Element\Extension;

class DomainResource extends Resource{
    public function __construct($json = null){
        parent::__construct($json);
        $this->extension = [];
        $this->contained = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->text)) $this->setText($json->text);
        if(isset($json->contained))
            foreach($json->contained as $contained)
                $this->addContained(ResourceBuilder::make($contained));
        if(isset($json->modifierExtension)) $this->setModifierExtension(new Extension($json->modifierExtension));
        if(isset($json->extension))
            foreach($json->extension as $extension)
                $this->addExtension(Extension::Load($extension));
    }
    public function setText($text){
        $this->text = $text;
    }
    public function addContained(Resource $contained){
        $this->contained[] = $contained;
    }
    public function setModifierExtension(Extension $modifierExtension){
        $this->modifierExtension = $modifierExtension;
    }
    public function addExtension(Extension $extension){
        $this->extension[] = $extension;
    }
    public function toArray(){
        $dataArray=parent::toArray();
        if(isset($this->text))
            $dataArray["text"] = $this->text;
        foreach($this->extension as $extension)
            $dataArray["extension"][] = $extension->toArray();
        foreach($this->contained as $contained)
            $dataArray["contained"][] = $contained->toArray();
        return $dataArray;
    }
}
