<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Coding;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\CompositionSection;
use App\Fhir\Element\Reference;

class Composition extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Composition";
        parent::__construct($json);
        $this->category = [];
        $this->author = [];
        $this->relatesTo = [];
        $this->attester = [];
        $this->section = [];
        $this->event = [];
        if($json) $this->loadData($json);
    }
    /* Load JSON */
    private function loadData($json){
        if(isset($json->identifier)) $this->setIdentifier(Identifier::Load($json->identifier));
        if(isset($json->status)) $this->setStatus($json->status);
        if(isset($json->type)) $this->setType(CodeableConcept::Load($json->type));
        if(isset($json->subject)) $this->subject = Reference::Load($json->subject);
        if(isset($json->encounter)) $this->encounter = Reference::Load($json->encounter);
        if(isset($json->date)) $this->setDate($json->date);
        if(isset($json->title)) $this->setTitle($json->title);
        if(isset($json->confidentiality)) $this->setConfidentiality($json->confidentiality);
        if(isset($json->custodian)) $this->custodian = Reference::Load($json->custodian);
        if(isset($json->category)) 
            foreach($json->category as $category)
                $this->addCategory(CodeableConcept::Load($category));
        if(isset($json->author)) 
            foreach($json->author as $author)
                $this->author[] = Reference::Load($author);
        if(isset($json->attester))
            foreach($json->attester as $attester)
                $this->addAttesterJson($attester);
        if(isset($json->relatesTo)) 
            foreach($json->relatesTo as $relatesTo)
                $this->addRelatesToJson($relatesTo);
        if(isset($json->event)) 
            foreach($json->event as $event)
                $this->addEventJson($event);
        if(isset($json->section)) 
            foreach($json->section as $section)
                $this->addSection(CompositionSection::Load($section));
    }
    private function addAttesterJson($json){
        $attester = [];
        if(isset($json->mode)) $attester["mode"] = $json->mode;
        if(isset($json->time)) $attester["time"] = $json->time;
        if(isset($json->party)) {
            $attester["party"] = Reference::Load($json->party);
        }
        
        $this->attester[] = $attester;
    }
    private function addRelatesToJson($json){
        $relatesTo = [];
        if(isset($json->code)) $relatesTo["code"] = $json->code;
        if(isset($json->targetIdentifier)) $relatesTo["targetIdentifier"] = $json->targetIdentifier;
        if(isset($json->targetReference)) $relatesTo["targetReference"] = Reference::Load($json->targetReference);
        $this->relatesTo[] = $relatesTo;
    }
    private function addEventJson($json){
        $event = [];
        if(isset($json->code)){ 
            $codes = [];
            foreach($json->code as $code)
                $codes[] = CodeableConcept::Load($code);
            $event["code"] = $codes;
        }
        if(isset($json->period)) $event["period"] = $json->period;
        if(isset($json->detail)) 
            $details = [];
            foreach($json->detail as $detail)
                $details[] = Reference::Load($detail);
            $event["detail"] = $details;
        $this->event[] = $event;
    }

    /* Setters */
    public function setIdentifier(Identifier $identifier){
        $this->identifier = $identifier;
    }
    public function setStatus($status){
        $this->status = $this->only(["preliminary","final","amended","entered-in-error"], $status);
    }
    public function setType(CodeableConcept $type){
        $this->type = $type;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setConfidentiality($confidentiality){
        $this->confidentiality = $confidentiality;
    }
    public function setCustodian(Resource $custodian){
        $this->custodian = $custodian;
    }
    /* Arrays */
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    public function addAuthor(Resource $author){
        $this->author[] = $author;
    }
    public function addAttester($mode, $time, Resource $party){
        $attester = [];
        $attester["mode"] = $mode;
        $attester["time"] = $time;
        $attester["party"] = $party->toReference();
        $this->attester[] = $attester;
    }
    public function addRelatesTo($code, $targetIdentifier, Resource $targetReference){
        $relatesTo = [];
        $relatesTo["code"] = $code;
        $relatesTo["targetIdentifier"] = $targetIdentifier;
        $relatesTo["targetReference"] = $targetReference->toReference();
        $this->relatesTo[] = $relatesTo;
    }
    public function addEvent(CodeableConcept $code, Period $period, Resource $detail){
        $event = [];
        $event["code"] = $code;
        $event["period"] = $period;
        $event["detail"] = $detail->toReference();
        $this->event[] = $event;
    }
    public function addSection(CompositionSection $section){
        $this->section[] = $section;
    }

    /* Utilizado para asignar el tipo de forma automática (shortcut para setType) */
    public function historiaClinica(){
        $this->setType(new CodeableConcept("Historia Clínica", new Coding("Hisotoria Clinica", "D2", "urn:NOM-004-SSA3-2012")));
    }
    /* Utilizado para asignar el tipo de forma automática (shortcut para setType) */
    public function notaEvolucion(){
        $this->setType(new CodeableConcept("Nota de evolución", new Coding("Nota de evolución", "D3", "urn:NOM-004-SSA3-2012")));
    }

    public function esNotaEvolucion(){
        if(isset($this->type) && isset($this->type->coding) && isset($this->type->coding[0]->code)){
            return $this->type->coding[0]->code == "D2";
        }
        return false;
    }
    public function esHistoriaClinica(){
        if(isset($this->type) && isset($this->type->coding) && isset($this->type->coding[0]->code)){
            return $this->type->coding[0]->code == "D3";
        }
        return false;
    }
    public function getReferences(){
        $data = [];
        foreach($this->section as $section){
            if(isset($section->section)){
                $data = array_merge($section->getReferences(), $data);
            }
            if(isset($section->entry)){
                $data = array_merge($section->entry, $data);
            }
        }
        return $data;
    }

    public function toArray(){
        $array = parent::toArray();
        if(isset($this->identifier)) $array["identifier"] = $this->identifier->toArray();
        if(isset($this->status)) $array["status"] = $this->status;
        if(isset($this->type)) $array["type"] = $this->type->toArray();
        if(isset($this->category)) 
            foreach($this->category as $category)
                $array["category"][] = $category->toArray();
        if(isset($this->subject)) $array["subject"] = $this->subject->toArray();
        if(isset($this->encounter)) $array["encounter"] = $this->encounter->toArray();
        if(isset($this->date)) $array["date"] = $this->date;
        if(isset($this->author) && $this->author){ 
            $authors = [];
            foreach($this->author as $author)
                $authors[] = $author->toArray();
            $array["author"] = $authors;
        }
        if(isset($this->custodian)) 
            $array["custodian"] = $this->custodian->toArray();
        if(isset($this->title)) $array["title"] = $this->title;
        if(isset($this->confidentiality)) 
            $array["confidentiality"] = $this->confidentiality;
        if(isset($this->attester) && $this->attester) {
            $array["attester"] = [];
            foreach($this->attester as $attester){
                $attesters = [];
                if(isset($attester["mode"]) && $attester["mode"])
                    $attesters["mode"] = $attester["mode"];
                if(isset($attester["time"]) && $attester["time"])
                    $attesters["time"] = $attester["time"];
                if(isset($attester["party"]) && $attester["party"])
                    $attesters["party"] = $attester["party"]->toArray();
                $array["attester"][] = $attesters;
            }
        }
        if(isset($this->relatesTo) && $this->relatesTo) {
            $array["relatesTo"] = [];
            foreach($this->relatesTo as $relatesTo){
                $relatesTos = [];
                if(isset($relatesTo["code"]) && $relatesTo["code"])
                    $relatesTos["code"] = $relatesTo["code"];
                if(isset($relatesTo["targetIdentifier"]) && $relatesTo["targetIdentifier"])
                    $relatesTos["targetIdentifier"] = $relatesTo["targetIdentifier"];
                if(isset($relatesTo["targetReference"]) && $relatesTo["targetReference"])
                    $relatesTos["targetReference"] = $relatesTo["targetReference"]->toArray();
                $array["relatesTo"][] = $relatesTos;
            }
        }
        if(isset($this->event) && $this->event) {
            $array["event"] = [];
            foreach($this->event as $event){
                if(isset($event["code"])){
                    $codes = [];
                    foreach($event["code"] as $code){
                        $codes[] = $code->toArray();
                    }
                    $events["code"] = $codes;
                }
                if(isset($event["period"])){
                    $events["period"] = $event["period"];
                }
                if(isset($event["detail"])){
                    $details = [];
                    foreach($event["detail"] as $detail){
                        $details[] = $detail->toArray();
                    }
                    $events["detail"] = $details;
                }
                $array["event"][] = $events;
            }
        }
        if(isset($this->section)) 
            foreach($this->section as $section)
                $array["section"][] = $section->toArray();
        return $array;
    }
}
