<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Attachment;
use App\Fhir\Element\Reference;
/* 
    Actualmente en desuso por la nueva versión del estandar 
*/
class DiagnosticReport extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "DiagnosticReport";
        parent::__construct($json);
        $this->identifier = [];
        $this->basedOn = [];
        $this->category = [];
        $this->performer = [];
        $this->specimen = [];
        $this->result = [];
        $this->imagingStudy = [];
        $this->media = [];
        $this->conclusionCode = [];
        $this->presentedForm = [];
        $this->resultsInterpreter = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->status)) $this->setStatus($json->status);
        if(isset($json->code)) $this->setCode(CodeableConcept::Load($json->code));
        if(isset($json->subject)) $this->subject = Reference::Load($json->subject);
        if(isset($json->encounter)) $this->encounter = Reference::Load($json->encounter);
        if(isset($json->effectiveDateTime)) $this->setEffectiveDateTime($json->effectiveDateTime);
        if(isset($json->effectivePeriod)) $this->setEffectivePeriod(Period::Load($json->effectivePeriod));
        if(isset($json->issued)) $this->setIssued($json->issued);
        if(isset($json->conclusion)) $this->setConclusion($json->conclusion);
        if(isset($json->conclusionCode)) $this->addConclusionCode(CodeableConcept::Load($json->conclusionCode));
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->addIdentifier(Identifier::Load($identifier));
        if(isset($json->basedOn))
            foreach($json->basedOn as $basedOn)
                $this->basedOn[] = Reference::Load($basedOn);
        if(isset($json->category))
            foreach($json->category as $category)
                $this->addCategory(CodeableConcept::Load($category));
        if(isset($json->presentedForm))
            foreach($json->presentedForm as $presentedForm)
                $this->addPresentedForm(Attachment::Load($presentedForm));
        if(isset($json->performer))
            foreach($json->performer as $performer)
                $this->performer[] = Reference::Load($performer);
        if(isset($json->resultsInterpreter))
            foreach($json->resultsInterpreter as $resultsInterpreter)
                $this->resultsInterpreter[] = Reference::Load($resultsInterpreter);
        if(isset($json->specimen))
            foreach($json->specimen as $specimen)
                $this->specimen[] = Reference::Load($specimen);
        if(isset($json->result))
            foreach($json->result as $result)
                $this->result[] = Reference::Load($result);
        if(isset($json->imagingStudy))
            foreach($json->imagingStudy as $imagingStudy)
                $this->imagingStudy[] = Reference::Load($imagingStudy);
        if(isset($json->media))
            foreach($json->media as $media){
                $medias = [];
                if(isset($media["media"])){
                    $medias["media"] = $media["media"];
                }
                if(isset($media["link"])){
                    $medias["link"] = Reference::Load($media["link"]);
                }
                $this->media[] = $medias;
            }
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function setStatus($status){
        $array = ["registered", "partial","preliminary","final"];
        $this->status = $status;
    }
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    public function setCode(CodeableConcept $code){
        $this->code = $code;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    public function setEffectiveDateTime($effectiveDateTime){
        $this->effectiveDateTime = $effectiveDateTime;
    }
    public function setEffectivePeriod(Period $effectivePeriod){
        $this->effectivePeriod = $effectivePeriod;
    }
    public function setIssued($issued){
        $this->issued = $issued;
    }
    public function addPerformer(Resource $performer){
        $this->performer[] = $performer->toReference();
    }
    public function addResultsInterpreter(Resource $resultsInterpreter){
        $this->resultsInterpreter[] = $resultsInterpreter->toReference();
    }
    public function addSpecimen(Resource $specimen){
        $this->specimen[] = $specimen->toReference();
    }
    public function addResult(Resource $result){
        $this->result[] = $result->toReference();
    }
    public function addImagingStudy(Resource $imagingStudy){
        $this->imagingStudy[] = $imagingStudy->toReference();
    }
    public function addMedia($media, Resource $link){
        $this->media[] = [
            "media"=>$media,
            "link"=>$link->toReference()
        ];
    }
    public function setConclusion($conclusion){
        $this->conclusion = $conclusion;
    }
    public function addConclusionCode(CodeableConcept $conclusionCode){
        $this->conclusionCode[] = $conclusionCode;
    }
    public function addPresentedForm(Attachment $presentedForm){
        $this->presentedForm[] = $presentedForm;
    }
    public function toArray(){
        $dataArray = parent::toArray();
        foreach($this->identifier as $identifier)
            $dataArray["identifier"][] = $identifier->toArray();
        foreach($this->basedOn as $basedOn)
            $dataArray["basedOn"][] = $basedOn->toArray();
        if(isset($this->status)){
            $dataArray["status"] = $this->status;
        }
        foreach($this->category as $category)
            $dataArray["category"][] = $category->toArray();
        if(isset($this->code)){
            $dataArray["code"] = $this->code->toArray();
        }
        if(isset($this->subject)){
            $dataArray["subject"] = $this->subject->toArray();
        }
        if(isset($this->encounter)){
            $dataArray["encounter"] = $this->encounter->toArray();
        }
        if(isset($this->effectiveDateTime)){
            $dataArray["effectiveDateTime"] = $this->effectiveDateTime;
        }
        if(isset($this->effectivePeriod)){
            $dataArray["effectivePeriod"] = $this->effectivePeriod->toArray();
        }
        if(isset($this->issued)){
            $dataArray["issued"] = $this->issued;
        }
        foreach($this->performer as $performer){
            $dataArray["performer"][] = $performer->toArray();
        }
        foreach($this->resultsInterpreter as $resultsInterpreter){
            $dataArray["resultsInterpreter"] = $resultsInterpreter->toArray();
        }
        foreach($this->specimen as $specimen){
            $dataArray["specimen"][] = $specimen->toArray();
        }
        foreach($this->result as $result){
            $dataArray["result"][] = $result->toArray();
        }
        foreach($this->imagingStudy as $imagingStudy){
            $dataArray["imagingStudy"][] = $imagingStudy->toArray();
        }
        foreach($this->media as $media){
            $dataArray["media"] = [
                "media"=>$media["media"],
                "link"=>$media["link"]->toArray(),
            ];
        }
        if(isset($this->conclusion)){
            $dataArray["conclusion"] = $this->conclusion;
        }
        foreach($this->conclusionCode as $conclusionCode){
            $dataArray["conclusionCode"][] = $conclusionCode->toArray();
        }
        foreach($this->presentedForm as $presentedForm){
            $dataArray["presentedForm"] = $presentedForm->toArray();
        }

        return $dataArray;
    }
}
