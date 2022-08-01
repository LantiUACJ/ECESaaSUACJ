<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Range;
use App\Fhir\Element\Reference;

class AllergyIntolerance extends DomainResource{

    public function __construct($json = null){
        parent::__construct($json);
        $this->resourceType  = "AllergyIntolerance";
        $this->identifier = [];
        $this->category = [];
        $this->note = [];
        $this->reaction = [];
        if($json) $this->loadData($json);
    }

    private function loadData($json){
        if (isset($json->clinicalStatus)){
            $this->clinicalStatus = CodeableConcept::Load($json->clinicalStatus);
        }
        if (isset($json->verificationStatus)){
            $this->verificationStatus = CodeableConcept::Load($json->verificationStatus);
        }
        if (isset($json->type)){
            $array = ["allergy","intolerance"];
            $this->type = $json->type;
        }
        if (isset($json->category)){
            $array = ["food","medication","environment","biologic"];
            foreach ($json->category as $category){
                $this->category[] = $category;
            }
        }
        if (isset($json->criticality)){
            $array = ["low","high", "unable-to-assess"];
            $this->criticality = $json->criticality;
        }
        if (isset($json->code)){
            $this->code = CodeableConcept::Load($json->code);
        }
        if (isset($json->patient)){
            $this->patient = Reference::Load($json->patient);
        }
        if (isset($json->encounter)){
            $this->encounter = Reference::Load($json->encounter);
        }
        if (isset($json->onsetDateTime)){
            $this->onsetDateTime = $json->onsetDateTime;
        }
        if (isset($json->onsetAge)){
            $this->onsetAge = Quantity::Load($json->onsetAge);
        }
        if (isset($json->onsetPeriod)){
            $this->onsetPeriod = Period::Load($json->onsetPeriod);
        }
        if (isset($json->onsetRange)){
            $this->onsetRange = Range::Load($json->onsetRange);
        }
        if (isset($json->onsetString)){
            $this->onsetString = $json->onsetString;
        }
        if (isset($json->recordedDate)){
            $this->recoredDate = $json->recordedDate;
        }
        if (isset($json->recorder)){
            $this->recorder = Reference::Load($json->recorder);
        }
        if (isset($json->asserter)){
            $this->asserter = Reference::Load($json->asserter);
        }
        if (isset($json->lastOccurrence)){
            $this->lastOccurrence = $json->lastOccurrence;
        }
        if (isset($json->note)){
            foreach ($json->note as $note)
                $this->note[] = Annotation::Load($note);
        }
        if (isset($json->reaction)){
            $datas = [];
            foreach ($json->reaction as $reaction){
                $data = [];
                if (isset($reaction->substance))
                    $data["substance"] = CodeableConcept::Load($reaction->substance);
                if (isset($reaction->manifestation)){
                    $manifestations = [];
                    foreach ($reaction->manifestation as $manifestation){
                        $manifestations[] = CodeableConcept::Load($manifestation);
                    }
                    $data["manifestation"] = $manifestations;
                }
                if (isset($reaction->description)){
                    $data["description"] = $reaction->description;
                }
                if (isset($reaction->onset)){
                    $data["onset"] = $reaction->onset;
                }
                if (isset($reaction->severity)){
                    $array = ["mild", "moderate", "severe"];
                    $data["severity"] = $reaction->severity;
                }
                
                if (isset($reaction->exposureRoute)){
                    $data["exposureRoute"] = CodeableConcept::Load($reaction->exposureRoute);
                }
                
                if (isset($reaction->note)){
                    $notes = [];
                    foreach ($reaction->note as $note)
                        $notes[] = Annotation::Load($note);
                    $data["note"] = $notes;
                }
                $datas[] = $data;
            }
            $this->reaction = $datas;
        }
        if (isset($json->identifier)){
            $identifiers = [];
            foreach ($json->identifier as $identifier)
                $identifiers[] = identifier::Load($identifier);
            $this->identifier = $identifiers;
        }
    }

    public function setClinicalStatus(CodeableConcept $clinicalStatus){
        $this->clinicalStatus = $clinicalStatus;
    }
    public function setVerificationStatus(CodeableConcept $verificationStatus){
        $this->verificationStatus = $verificationStatus;
    }
    public function setType($type){
        $this->type = $type;
    }
    /* category */
    public function addCategory($category){
        $this->category[] = $category;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    public function setPatient(Resource $patient){
        $this->patient = $patient->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setOnsetDateTime($onsetDateTime){
        $this->onsetDateTime = $onsetDateTime;
    }
    public function setOnsetAge(Quantity $onsetAge){
        $this->onsetAge = $onsetAge;
    }
    public function setOnsetPeriod(Period $onsetPeriod){
        $this->onsetPeriod = $onsetPeriod;
    }
    public function setOnsetRange(Range $onsetRange){
        $this->onsetRange = $onsetRange;
    }
    public function setOnsetString($onsetString){
        $this->onsetString = $onsetString;
    }
    public function setRecoredDate($recoredDate){
        $this->recoredDate = $recoredDate;
    }
    public function setRecoreder(Resource $recoreder){
        $this->recoreder = $recoreder->toReference();
    }
    public function setAsserter(Resource $asserter){
        $this->asserter = $asserter->toReference();
    }
    public function setLastOcurrence($lastOcurrence){
        $this->lastOcurrence = $lastOcurrence;
    }

    /* array */
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    /* array */
    public function addReaction(CodeableConcept $substance, $manifestation, $description, $onset, $severity, CodeableConcept $exposureRoute, $notes){
        $data = [];
        if (isset($substance))
            $data["substance"] = $substance;
        if (isset($manifestation)){
            $manifestations = [];
            foreach ($manifestation as $manifestation){
                $manifestations[] = $manifestation;
            }
            $data["manifestation"] = $manifestations;
        }
        if (isset($description)){
            $data["description"] = $description;
        }
        if (isset($onset)){
            $data["onset"] = $onset;
        }
        if (isset($severity)){
            $array = ["mild", "moderate", "severe"];
            $data["severity"] = $severity;
        }
        if (isset($exposureRoute)){
            $data["exposureRoute"] = $exposureRoute;
        }
        if (isset($note)){
            $notesAr = [];
            foreach ($notes as $note)
                $notesAr[] = $note;
            $data["note"] = $notesAr;
        }
        $this->reaction[] = $data;
    }
    /* array */
    public function addIdentifier($identifier){
        $this->identifier[] = $identifier;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if (isset($this->identifier) && $this->identifier){
            $identifiers = [];
            foreach ($this->identifier as $identifier)
                $identifiers[] = $identifier->toArray();
            $arrayData["identifier"] = $identifiers;
        }
        if (isset($this->clinicalStatus)){
            $arrayData["clinicalStatus"] = $this->clinicalStatus->toArray();
        }
        if (isset($this->verificationStatus)){
            $arrayData["verificationStatus"] = $this->verificationStatus->toArray();
        }
        if (isset($this->type)){
            $arrayData["type"] = $this->type;
        }
        if (isset($this->category)){
            foreach ($this->category as $category){
                $arrayData["category"][] = $category;
            }
        }
        if (isset($this->criticality)){
            $arrayData[] = $this->criticality;
        }
        if (isset($this->code)){
            $arrayData["code"] = $this->code->toArray();
        }
        if (isset($this->patient)){
            $arrayData["patient"] = $this->patient->toArray();
        }
        if (isset($this->encounter)){
            $arrayData["encounter"] = $this->encounter->toArray();
        }
        if (isset($this->onsetDateTime)){
            $arrayData["onsetDateTime"] = $this->onsetDateTime;
        }
        if (isset($this->onsetAge)){
            $arrayData["onsetAge"] = $this->onsetAge->toArray();
        }
        if (isset($this->onsetPeriod)){
            $arrayData["onsetPeriod"] = $this->onsetPeriod->toArray();
        }
        if (isset($this->onsetRange)){
            $arrayData["onsetRange"] = $this->onsetRange->toArray();
        }
        if (isset($this->onsetString)){
            $arrayData["onsetString"] = $this->onsetString;
        }
        if (isset($this->recordedDate)){
            $arrayData["recoredDate"] = $this->recordedDate;
        }
        if (isset($this->recorder)){
            $arrayData["recorder"] = $this->recorder->toArray();
        }
        if (isset($this->asserter)){
            $arrayData["asserter"] = $this->asserter->toArray();
        }
        if (isset($this->lastOccurrence)){
            $arrayData["lastOccurrence"] = $this->lastOccurrence;
        }
        if (isset($this->note)){
            foreach ($this->note as $note)
                $arrayData["note"][] = $note->toArray();
        }
        if (isset($this->reaction) && $this->reaction){
            $all = [];
            foreach ($this->reaction as $reaction){
                $data = [];
                if (isset($reaction["substance"]))
                    $data["substance"] = $reaction["substance"]->toArray();
                if (isset($reaction["manifestation"])){
                    $manifestations = [];
                    foreach ($reaction["manifestation"] as $manifestation){
                        $manifestations[] = $manifestation->toArray();
                    }
                    $data["manifestation"] = $manifestations;
                }
                if (isset($reaction["description"])){
                    $data["description"] = $reaction["description"];
                }
                if (isset($reaction["onset"])){
                    $data["onset"] = $reaction["onset"];
                }
                if (isset($reaction["severity"])){
                    $data["severity"] = $reaction["severity"];
                }
                if (isset($reaction["exposureRoute"])){
                    $data["exposureRoute"] = $reaction["exposureRoute"]->toArray();
                }
                if (isset($reaction["note"])){
                    $notes = [];
                    foreach ($reaction["note"] as $note)
                        $notes[] = $note->toArray();
                    $data["note"] = $notes;
                }
                $all[] = $data;
            }
            $arrayData["reaction"] = $all;
        }
        return $arrayData;
    }

    public function toString(){
        $display = "";
        if(isset($this->type) && $this->type == "allergy") $display .= "Alergia";
        elseif(isset($this->type) && $this->type == "intolerance") $display .= "Intolerancia";
        if(isset($this->code) && isset($this->code->display)) $display .= $this->code->display;
        return $display;
    }
}