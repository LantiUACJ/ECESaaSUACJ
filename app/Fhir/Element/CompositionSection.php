<?php 

namespace App\Fhir\Element;

use App\Fhir\Element\CodeableConcept;
use App\Fhir\Resource\Resource;

class CompositionSection extends Element{
    public function __construct(){
        parent::__construct();
        $this->author = [];
        $this->section = [];
        $this->entry = [];
    }
    public function loadData($json){
        if(isset($json->title)) $this->setTitle($json->title);
        if(isset($json->code)) $this->setCode(CodeableConcept::Load($json->code));
        if(isset($json->focus)) $this->focus = Reference::Load($json->focus);
        if(isset($json->text)) $this->setText(Narrative::Load($json->text));
        if(isset($json->mode)) $this->setMode($json->mode);
        if(isset($json->orderedBy)) $this->setOrderedBy(CodeableConcept::Load($json->orderedBy));
        if(isset($json->entry)) 
            foreach($json->entry as $entry)
            $this->entry[] = Reference::Load($entry);
        if(isset($json->emptyReason)) $this->setEmptyReason(CodeableConcept::Load($json->emptyReason));
        if(isset($json->section)) 
            foreach($json->section as $section)
                $this->addSection(CompositionSection::Load($section));
        if(isset($json->author)) 
            foreach($json->author as $author)
                $this->author[] = Reference::Load($author);
    }
    public static function Load($json){
        $compositionSection = new CompositionSection();
        $compositionSection->loadData($json);
        return $compositionSection;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    public function addAuthor(Resource $author){
        $this->author[] = $author->toReference();
    }
    public function setFocus(Resource $focus){
        $this->focus = $focus->toReference();
    }
    public function setText(Narrative $text){
        $this->text = $text;
    }
    public function setMode($mode){
        $this->mode = $mode;
    }
    public function setOrderedBy(CodeableConcept $orderedBy){
        $this->orderedBy = $orderedBy;
    }
    public function addEntry(Resource $entry){
        $this->entry[] = $entry->toReference();
    }
    public function setEmptyReason(CodeableConcept $emptyReason){
        $this->emptyReason = $emptyReason;
    }
    public function addSection(CompositionSection $section){
        $this->section[] = $section;
    }

    public function getReferences(){
        $data = [];
        if(isset($this->section)){
            foreach($this->section as $section){
                $data = array_merge($data, $section->getReferences());
            }
        }
        return array_merge($this->entry, $data);
    }

    public function toArray(){
        $array = parent::toArray();
        if(isset($this->title))
            $array["title"] = $this->title;
        if(isset($this->code))
            $array["code"] = $this->code->toArray();
        if(isset($this->author) && $this->author){
            $array["author"] = [];
            foreach($this->author as $author){
                $array["author"][] = $author->toArray();
            }
        }
        if(isset($this->focus))
            $array["focus"] = $this->focus->toArray();
        if(isset($this->text))
            $array["text"] = $this->text->toArray();
        if(isset($this->mode))
            $array["mode"] = $this->mode;
        if(isset($this->orderedBy))
            $array["orderedBy"] = $this->orderedBy->toArray();
        if(isset($this->entry) && $this->entry){
            $array["entry"] = [];
            foreach($this->entry as $entry){
                $array["entry"][] = $entry->toArray();
            }
        }
        if(isset($this->emptyReason))
            $array["emptyReason"] = $this->emptyReason->toArray();
        if(isset($this->section) && $this->section){
            $array["section"] = [];
            foreach($this->section as $section){
                $array["section"][] = $section->toArray();
            }
        }
        return $array;
    }
}
