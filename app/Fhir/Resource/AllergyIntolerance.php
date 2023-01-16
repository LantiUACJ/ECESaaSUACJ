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

    /* Ignorar constructor */
    public function __construct($json = null){
        $this->resourceType  = "AllergyIntolerance";
        parent::__construct($json);
        $this->identifier = [];
        $this->category = [];
        $this->note = [];
        $this->reaction = [];
        if($json) $this->loadData($json);
    }
    /* Ignorar loadData */
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

    /* Campo obligatorio (estandar):
        \Fhir\Element\CodeableConcepto:
            \Fhir\Element\Coding (Array de codings 1..*)
                system: http://terminology.hl7.org/CodeSystem/allergyintolerance-clinical
                code: active
                display: active
            text: Activa
    */
    public function setClinicalStatus(CodeableConcept $clinicalStatus){
        $this->clinicalStatus = $clinicalStatus;
    }
    /* Campo opcional */
    public function setVerificationStatus(CodeableConcept $verificationStatus){
        $this->verificationStatus = $verificationStatus;
    }
    /* Campo obligatorio (estandar) */
    public function setType($type){
        $this->type = $type;
    }
    /* Campo opcional */
    public function addCategory($category){
        $this->category[] = $category;
    }
    /* 
        Campo obligatorio (estandar) 
        \Fhir\Element\CodeableConcepto:
            "code": \Fhir\Element\Code (array 1..*)
                system: http://snomed.info/sct
                code: codigo snomed
                display: texto
            text: texto
    */
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    /* Campo obligatorio (estandar) */
    public function setCriticality($criticality){
        $this->criticality = $criticality;
    }
    /* Campo opcional */
    public function setPatient(Resource $patient){
        $this->patient = $patient->toReference();
    }
    /* Campo opcional */
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    /* Campo opcional */
    public function setOnsetDateTime($onsetDateTime){
        $this->onsetDateTime = $onsetDateTime;
    }
    /* Campo opcional */
    public function setOnsetAge(Quantity $onsetAge){
        $this->onsetAge = $onsetAge;
    }
    /* Campo opcional */
    public function setOnsetPeriod(Period $onsetPeriod){
        $this->onsetPeriod = $onsetPeriod;
    }
    /* Campo opcional */
    public function setOnsetRange(Range $onsetRange){
        $this->onsetRange = $onsetRange;
    }
    /* Campo opcional */
    public function setOnsetString($onsetString){
        $this->onsetString = $onsetString;
    }
    /* Campo obligatorio (estandar) */
    public function setRecoredDate($recoredDate){
        $this->recoredDate = $recoredDate;
    }
    /* Campo opcional */
    public function setRecoreder(Resource $recoreder){
        $this->recoreder = $recoreder->toReference();
    }
    /* Campo opcional */
    public function setAsserter(Resource $asserter){
        $this->asserter = $asserter->toReference();
    }
    /* Campo opcional */
    public function setLastOcurrence($lastOcurrence){
        $this->lastOcurrence = $lastOcurrence;
    }
    /* Campo opcional */
    public function addNote(Annotation $note){
        $this->note[] = $note;
    }
    /* Campo opcional */
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
    /* Campo opcional */
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
        else $display .= "Alergia/Intolerancia";
        if(isset($this->code) && isset($this->code->display)) $display .= $this->code->display; 
        return $display;
    }
}