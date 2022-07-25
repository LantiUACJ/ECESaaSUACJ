<?php 
namespace App\Fhir\Resource;

use App\Fhir\Element\Identifier;
use App\Fhir\Element\Coding;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Annotation;
use App\Fhir\Element\Reference;
use App\Fhir\Element\ImageStudySeries;
use App\Fhir\Exception\TextNotDefinedException;

class ImagingStudy extends DomainResource{

    public function __construct($json = null){
        $this->resourceType = "ImagingStudy";
        parent::__construct($json);
        $this->identifier = [];
        $this->modality = [];
        $this->basedOn = [];
        $this->interpreter = [];
        $this->endpoint = [];
        $this->reasonCode = [];
        $this->reasonReference = [];
        $this->note = [];
        $this->series = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if(isset($json->status))
            $this->status = $json->status;
        if(isset($json->modality))
            foreach($json->modality as $modality)
                $this->modality[] = Coding::Load($modality);
        if(isset($json->subject))
            $this->subject = Reference::Load($json->subject);
        if(isset($json->encounter))
            $this->encounter = Reference::Load($json->encounter);
        if(isset($json->started))
            $this->started = $json->started;
        if(isset($json->basedOn))
            foreach($json->basedOn as $baseOn)
                $this->basedOn[] = Reference::Load($baseOn);
        if(isset($json->referrer))
            $this->referrer = Reference::Load($json->referrer);
        if(isset($json->interpreter))
            foreach($json->interpreter as $interpreter)
                $this->interpreter[] = Reference::Load($interpreter);
        if(isset($json->endpoint))
            foreach($json->endpoint as $endpoint)
                $this->endpoint[] = Reference::Load($endpoint);
        if(isset($json->numberOfSeries))
            $this->numberOfSeries = $json->numberOfSeries;
        if(isset($json->numberOfInstances))
            $this->numberOfInstances = $json->numberOfInstances;
        if(isset($json->procedureReference))
            $this->procedureReference = Reference::Load($json->procedureReference);
        if(isset($json->location))
            $this->location = Reference::Load($json->location);
        if(isset($json->reasonCode))
            foreach($json->reasonCode as $reasonCode)
                $this->reasonCode[] = CodeableConcept::Load($reasonCode);
        if(isset($json->reasonReference))
            foreach($json->reasonReference as $reasonReference)
                $this->reasonReference[] = Reference::Load($reasonReference);
        if(isset($json->note))
            foreach($json->note as $note)
                $this->note[] = Annotation::Load($note);
        if(isset($json->description))
            $this->description = $json->description;
        if(isset($json->series))
            foreach($json->series as $series)
                $this->series[] = ImageStudySeries::Load($series);
        if(isset($json->procedureCode))
            foreach($json->procedureCode as $procedureCode)
                $this->procedureCode[] = CodeableConcept::Load($procedureCode);
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setStatus($status){
        $this->status = null;
        $only = ["registered", "available","cancelled","entered-in-error","unknown"];
        foreach($only as $word){
            if($word == strtolower($status)){
                $this->status = $status;
            }
        }
        if(!$this->status){
			throw new TextNotDefinedException("Status", implode(", ",$only));
        }
    }
    public function addModality(Coding $modality){
        $this->modality[] = $modality;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setStarted($started){
        $this->started = $started;
    }
    public function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function setReferrer(Resource $referrer){
        $this->referrer = $referrer->toReference();
    }
    public function addInterpreter(Resource $interpreter){
        $this->interpreter[] = $interpreter->toReference();;
    }
    public function addEndpoint(Resource $endpoint){
        $this->endpoint[] = $endpoint->toReference();
    }
    public function setNumberOfSeries($numberOfSeries){
        $this->numberOfSeries = $numberOfSeries;
    }
    public function setNumberOfInstances($numberOfInstances){
        $this->numberOfInstances = $numberOfInstances;
    }
    public function setProcedureReference(Resource $procedureReference){
        $this->procedureReference = $procedureReference->toReference();
    }
    public function setLocation(Resource $location){
        $this->location = $location;
    }
    public function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    public function addReasonReference(Resource $reasonReference){
        $this->reasonReference[] = $reasonReference->toReference();
    }
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function addSeries(ImageStudySeries $series){
        $this->series[] = $series;
    }
    public function toArray(){
        $arrayData = parent::toArray();

        foreach($this->identifier as $identifier){
            $arrayData["identifier"][] = $identifier->toArray();
        }
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        foreach($this->modality as $modality){
            $arrayData["modality"][] = $modality->toArray();
        }
        if(isset($this->subject)){
            $arrayData["subject"] = $this->subject->toArray();
        }
        if(isset($this->encounter)){
            $arrayData["encounter"] = $this->encounter->toArray();
        }
        if(isset($this->started)){
            $arrayData["started"] = $this->started;
        }
        foreach($this->basedOn as $baseOn){
            $arrayData["basedOn"][] = $baseOn->toArray();
        }
        if(isset($this->referrer)){
            $arrayData["referrer"] = $this->referrer->toArray();
        }
        foreach($this->interpreter as $interpreter){
            $arrayData["interpreter"][] = $interpreter->toArray();
        }
        foreach($this->endpoint as $endpoint){
            $arrayData["endpoint"][] = $endpoint->toArray();
        }
        if(isset($this->numberOfSeries)){
            $arrayData["numberOfSeries"] = $this->numberOfSeries;
        }
        if(isset($this->numberOfInstances)){
            $arrayData["numberOfInstances"] = $this->numberOfInstances;
        }
        if(isset($this->procedureReference)){
            $arrayData["procedureReference"] = $this->procedureReference->toArray();
        }
        if(isset($this->location)){
            $arrayData["location"] = $this->location->toArray();
        }
        foreach($this->reasonCode as $reasonCode){
            $arrayData["reasonCode"][] = $reasonCode->toArray();
        }
        foreach($this->reasonReference as $reasonReference){
            $arrayData["reasonReference"][] = $reasonReference->toArray();
        }
        foreach($this->note as $note){
            $arrayData["note"][] = $note->toArray();
        }
        if(isset($this->description)){
            $arrayData["description"] = $this->description;
        }
        foreach($this->series as $series){
            $arrayData["series"][] = $series->toArray();
        }
        if(isset($this->procedureCode))
            foreach($this->procedureCode as $procedureCode)
                $arrayData["procedureCode"][] = $procedureCode->toArray();
        return $arrayData;
    }
}
