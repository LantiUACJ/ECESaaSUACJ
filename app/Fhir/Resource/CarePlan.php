<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Reference;
use App\Fhir\Element\CarePlanActivity;

class CarePlan extends DomainResource{

    public function __construct($json = null){
        parent::__construct($json);
        $this->resourceType = "CarePlan";
        $this->identifier = [];
        $this->instantiatesCanonical = [];
        $this->instantiatesUri = [];
        $this->basedOn = [];
        $this->replaces = [];
        $this->partOf = [];
        $this->category = [];
        $this->contributor = [];
        $this->careTeam = [];
        $this->addresses = [];
        $this->supportingInfo = [];
        $this->goal = [];
        $this->activity = [];
        $this->note = [];

        if($json) $this->loadData($json);
    }

    private function loadData($json){
        if(isset($json->identifier)){
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        }
        if(isset($json->instantiatesCanonical)){
            foreach($json->instantiatesCanonical as $instantiatesCanonical)
                $this->instantiatesCanonical[] = Reference::Load($instantiatesCanonical);
        }
        if(isset($json->instantiatesUri)){
            foreach($json->instantiatesUri as $instantiatesUri)
                $this->instantiatesUri[] = $instantiatesUri;
        }
        if(isset($json->basedOn)){
            foreach($json->basedOn as $basedOn)
                $this->basedOn[] = Reference::Load($basedOn);
        }
        if(isset($json->replaces)){
            foreach($json->replaces as $replaces)
                $this->replaces[] = Reference::Load($replaces);
        }
        if(isset($json->partOf)){
            foreach($json->partOf as $partOf)
                $this->partOf[] = Reference::Load($partOf);
        }
        if(isset($json->status)){
            $this->status = $json->status;
        }
        if(isset($json->intent)){
            $this->intent = $json->intent;
        }
        if(isset($json->category)){
            foreach($json->category as $category)
                $this->category[] = CodeableConcept::Load($category);
        }
        if(isset($json->title)){
            $this->title = $json->title;
        }
        if(isset($json->description)){
            $this->description = $json->description;
        }
        if(isset($json->subject)){
            $this->subject = Reference::Load($json->subject);
        }
        if(isset($json->encounter)){
            $this->encounter = Reference::Load($json->encounter);
        }
        if(isset($json->period)){
            $this->period = Period::Load($json->period);
        }
        if(isset($json->created)){
            $this->created = $json->created;
        }
        if(isset($json->author)){
            $this->author = Reference::Load($json->author);
        }
        if(isset($json->contributor)){
            foreach($json->contributor as $contributor)
                $this->contributor[] = Reference::Load($contributor);
        }
        if(isset($json->careTeam)){
            foreach($json->careTeam as $careTeam)
                $this->careTeam[] = Reference::Load($careTeam);
        }
        if(isset($json->addresses)){
            foreach($json->addresses as $addresses)
                $this->addresses[] = Reference::Load($addresses);
        }
        if(isset($json->supportingInfo)){
            foreach($json->supportingInfo as $supportingInfo)
                $this->supportingInfo[] = Reference::Load($supportingInfo);
        }
        if(isset($json->goal)){
            foreach($json->goal as $goal)
                $this->goal[] = Reference::Load($goal);
        }
        if(isset($json->activity)){
            foreach($json->activity as $activity){
                $this->activity[] = CarePlanActivity::Load($activity);
            }
        }
        if(isset($json->note)){
            foreach($json->note as $note)
                $this->note[] = Annotation::Load($note);
        }
    }

    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function addInstantiatesCanonical(Resource $instantiatesCanonical){
        $this->instantiatesCanonical[] = $instantiatesCanonical->toReference();
    }
    public function addInstantiatesUri($instantiatesUri){
        $this->instantiatesUri[] = $instantiatesUri;
    }
    public function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function addReplaces(Resource $replaces){
        $this->replaces[] = $replaces->toReference();
    }
    public function addPartOf(Resource $partOf){
        $this->partOf[] = $partOf->toReference();
    }
    public function setStatus($status){
        $this->status = $status;
    }
    public function setIntent($intent){
        $this->intent = $intent;
    }
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    public function setTitle($title){
        $this->title = $title;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function setCreated($created){
        $this->created = $created;
    }
    public function setAuthor(Resource $author){
        $this->author = $author;
    }
    public function addContributor(Resource $contributor){
        $this->contributor[] = $contributor;
    }
    public function addCareTeam(Resource $careTeam){
        $this->careTeam[] = $careTeam;
    }
    public function addAddresses(Resource $addresses){
        $this->addresses[] = $addresses;
    }
    public function addSupportingInfo(Resource $supportingInfo){
        $this->supportingInfo[] = $supportingInfo;
    }
    public function addGoal(Resource $goal){
        $this->goal[] = $goal;
    }
    public function addActivity(CarePlanActivity $activity){
        $this->activity[] = $activity;
    }
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }

    public function toString(){
        $string = "Plan de cuidado";
        if(isset($this->created))
            $string .= " del día " . $this->created;
        return $string;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->identifier)){
            foreach($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        }
        if(isset($this->instantiatesCanonical)){
            foreach($this->instantiatesCanonical as $instantiatesCanonical)
                $arrayData["instantiatesCanonical"][] = $instantiatesCanonical->toArray();
        }
        if(isset($this->instantiatesUri)){
            foreach($this->instantiatesUri as $instantiatesUri)
                $arrayData["instantiatesUri"][] = $instantiatesUri;
        }
        if(isset($this->basedOn)){
            foreach($this->basedOn as $basedOn)
                $arrayData["basedOn"][] = $basedOn->toArray();
        }
        if(isset($this->replaces)){
            foreach($this->replaces as $replaces)
                $arrayData["replaces"][] = $replaces->toArray();
        }
        if(isset($this->partOf)){
            foreach($this->partOf as $partOf)
                $arrayData["partOf"][] = $partOf->toArray();
        }
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        if(isset($this->intent)){
            $arrayData["intent"] = $this->intent;
        }
        if(isset($this->category)){
            foreach($this->category as $category)
                $arrayData["category"][] = $category->toArray();
        }
        if(isset($this->title)){
            $arrayData["title"] = $this->title;
        }
        if(isset($this->description)){
            $arrayData["description"] = $this->description;
        }
        if(isset($this->subject)){
            $arrayData["subject"] = $this->subject->toArray();
        }
        if(isset($this->encounter)){
            $arrayData["encounter"] = $this->encounter->toArray();
        }
        if(isset($this->period)){
            $arrayData["period"] = $this->period->toArray();
        }
        if(isset($this->created)){
            $arrayData["created"] = $this->created;
        }
        if(isset($this->author)){
            $arrayData["author"] = $this->author->toArray();
        }
        if(isset($this->contributor)){
            foreach($this->contributor as $contributor)
                $arrayData["contributor"][] = $contributor->toArray();
        }
        if(isset($this->careTeam)){
            foreach($this->careTeam as $careTeam)
                $arrayData["careTeam"][] = $careTeam->toArray();
        }
        if(isset($this->addresses)){
            foreach($this->addresses as $addresses)
                $arrayData["addresses"][] = $addresses->toArray();
        }
        if(isset($this->supportingInfo)){
            foreach($this->supportingInfo as $supportingInfo)
                $arrayData["supportingInfo"][] = $supportingInfo->toArray();
        }
        if(isset($this->goal)){
            foreach($this->goal as $goal)
                $arrayData["goal"][] = $goal->toArray();
        }
        if(isset($this->activity)){
            foreach($this->activity as $activity){
                $arrayData["activity"][] = $activity->toArray();
            }
        }
        if(isset($this->note)){
            foreach($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        }
        return $arrayData;
    }
}