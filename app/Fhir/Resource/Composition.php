<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Coding;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\CompositionSection;
use App\Fhir\Element\Reference;

/* Recurso utilizado en: 
    Historia clínica
    Nota de evolución
*/
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
    /* campo opcional */
    private function addAttesterJson($json){
        $attester = [];
        if(isset($json->mode)) $attester["mode"] = $json->mode;
        if(isset($json->time)) $attester["time"] = $json->time;
        if(isset($json->party)) $attester["party"] = Reference::Load($json->party);
        $this->attester[] = $attester;
    }
    /* campo opcional */
    private function addRelatesToJson($json){
        $relatesTo = [];
        if(isset($json->code)) $relatesTo["code"] = $json->code;
        if(isset($json->targetIdentifier)) $relatesTo["targetIdentifier"] = $json->targetIdentifier;
        if(isset($json->targetReference)) $relatesTo["targetReference"] = Reference::Load($json->targetReference);
        $this->relatesTo[] = $relatesTo;
    }
    /* campo opcional */
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
    /* campo obligatorio (estandar) 
        \Fhir\Element\Identifier:
            "value": "D2",
            "system": "urn:NOM-004-SSA3-2012"
    */
    public function setIdentifier(Identifier $identifier){
        $this->identifier = $identifier;
    }
    /* campo obligatorio (estandar) 
        acepta solo:
            "preliminary","final","amended","entered-in-error"
    */
    public function setStatus($status){
        $this->status = $this->only(["preliminary","final","amended","entered-in-error"], $status);
    }
    /* campo obligatorio (estandar) 
        \Fhir\Element\CodeableConcept:
            \Fhir\Element\Coding (Array de codings 1..*)
            ** en caso de historia clinica **:
                "system": "urn:NOM-004-SSA3-2012",
                "code": "D2",
                "display": "HISTORIA CLINICA"
            ** en caso de nota evolución **:
                "system": "urn:NOM-004-SSA3-2012",
                "code": "D3",
                "display": "Nota de evolución"
            text: 
                "Historia clinica" ** en caso de historia clinica **
                "Nota de evolución" ** en caso de nota evolución **
    */
    public function setType(CodeableConcept $type){
        $this->type = $type;
    }
    /* campo obligatorio (estandar) */
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    /* campo obligatorio (estandar) */
    public function setEncounter(Resource $encounter){
        $this->encounter = $encounter->toReference();
    }
    /* campo obligatorio (estandar) */
    public function setDate($date){
        $this->date = $date;
    }
    /* campo obligatorio (estandar)
            "Historia clinica" ** en caso de historia clinica **
            "Nota de evolución" ** en caso de nota evolución **
    */
    public function setTitle($title){
        $this->title = $title;
    }
    /* campo obligatorio (estandar): 
            solo permite:
                "L", "M", "N", "R", "U", "V"
    */
    public function setConfidentiality($confidentiality){
        $this->confidentiality = $confidentiality;
    }
    /* campo opcional */
    public function setCustodian(Resource $custodian){
        $this->custodian = $custodian;
    }
    /* campo opcional */
    public function addCategory(CodeableConcept $category){
        $this->category[] = $category;
    }
    /* campo obligatorio (estandar) (array 1..*) */
    public function addAuthor(Resource $author){
        $this->author[] = $author->toReference();
    }
    /* campo opcional */
    public function addAttester($mode, $time, Resource $party){
        $attester = [];
        $attester["mode"] = $mode;
        $attester["time"] = $time;
        $attester["party"] = $party->toReference();
        $this->attester[] = $attester;
    }
    /* campo opcional */
    public function addRelatesTo($code, $targetIdentifier, Resource $targetReference){
        $relatesTo = [];
        $relatesTo["code"] = $code;
        $relatesTo["targetIdentifier"] = $targetIdentifier;
        $relatesTo["targetReference"] = $targetReference->toReference();
        $this->relatesTo[] = $relatesTo;
    }
    /* campo opcional */
    public function addEvent(CodeableConcept $code, Period $period, Resource $detail){
        $event = [];
        $event["code"] = $code;
        $event["period"] = $period;
        $event["detail"] = $detail->toReference();
        $this->event[] = $event;
    }
    /* campo obligatorio
        ** En caso de historia clínica **
        \Fhir\Element\CompositionSection: (array 10..*) (No oficial):
        1:
            "title": "Antecedentes heredofamiliares"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.2",
                    "display": "Antecedentes heredo familiares",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Antecedentes heredo familiares"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        2:
            "title": "Antecedentes personales no patológicos"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.3",
                    "display": "Antecedentes personales no patológicos",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Antecedentes personales no patológicos"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        3:
            "title": "Antecedentes personales patológicos"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.4",
                    "display": "Antecedentes personales patológicos",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Antecedentes personales patológicos"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        4:
            "title": "Padecimiento actual"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.5",
                    "display": "Padecimiento actual",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Padecimiento actual"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        5:
            "title": "Interrogatorio por aparatos y sistemas"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.6",
                    "display": "Interrogatorio por aparatos y sistemas",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Interrogatorio por aparatos y sistemas"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        6:
            "title": "Exploración física"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.7",
                    "display": "Exploración física",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Exploración física"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        7:
            "title": "Resultados previos y actuales de estudios de laboratorio, gabinete y otros"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.8",
                    "display": "Resultados previos y actuales de estudios de laboratorio, gabinete y otros",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Resultados previos y actuales de estudios de laboratorio, gabinete y otros"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        8:
            "title": "Diagnósticos"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.10",
                    "display": "Diagnósticos",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Diagnósticos"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        9:
            "title": "Pronóstico"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D3.10",
                    "display": "Pronóstico",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Pronóstico"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
        10:
            "title": "Indicacción terapeútica"
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "D2.9",
                    "display": "Indicacción terapeútica",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Indicacción terapeútica"
            },
            entry: (array 0..*)
                \Fhir\Element\Reference
            
        ** En caso de nota de evolución **
        \Fhir\Element\CompositionSection: (array 6..*) (No oficial):
        1:
            "title": "Evolución y actualización del cuadro clínico",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2",
                    "display": "Evolución y actualización del cuadro clínico",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Evolución y actualización del cuadro clínico"
            entry: (array 0..*)
                \Fhir\Element\Reference
        2:
            "title": "Signos vitales",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2.2",
                    "display": "Signos vitales",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Signos vitales"
            entry: (array 0..*)
                \Fhir\Element\Reference
        3:
            "title": "Resultados relevantes de los estudios de los servicios auxiliares de diagnóstico y tratamiento que hayan sido solicitados previamente",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2.3",
                    "display": "Resultados relevantes de los estudios de los servicios auxiliares de diagnóstico y tratamiento que hayan sido solicitados previamente",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Resultados relevantes de los estudios de los servicios auxiliares de diagnóstico y tratamiento que hayan sido solicitados previamente"
            entry: (array 0..*)
                \Fhir\Element\Reference
        4:
            "title": "Diagnósticos",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2.4",
                    "display": "Diagnósticos o problemas clínicos",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Diagnósticos o problemas clínicos"
            entry: (array 0..*)
                \Fhir\Element\Reference
        5:
            "title": "Pronóstico",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2.5",
                    "display": "Pronóstico",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Pronóstico"
            entry: (array 0..*)
                \Fhir\Element\Reference
        6:
            "title": "Tratamiento e indicaciones médicas",
            "code": \Fhir\Element\CodeableConcept
                "coding": \Fhir\Element\Code (array 1..*)
                    "code": "6.2.6",
                    "display": "Tratamiento e indicaciones médicas",
                    "system": "urn:NOM-004-SSA3-2012"
                "text": "Tratamiento e indicaciones médicas"
            entry: (array 0..*)
                \Fhir\Element\Reference
    */
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


    /*
        Funciones adicionales ignorar
    */
    public function esNotaEvolucion(){
        if(isset($this->type) && isset($this->type->coding) && isset($this->type->coding[0]->code)){
            return $this->type->coding[0]->code == "D3";
        }
        return false;
    }
    public function esHistoriaClinica(){
        if(isset($this->type) && isset($this->type->coding) && isset($this->type->coding[0]->code)){
            return $this->type->coding[0]->code == "D2";
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
    public function toString(){
        if($this->esNotaEvolucion()){
            return "Nota de evolución";
        }
        if($this->esHistoriaClinica()){
            return "Historia clínica";
        }
        return "Composición";
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
