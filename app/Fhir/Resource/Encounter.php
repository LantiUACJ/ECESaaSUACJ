<?php

namespace App\Fhir\Resource;

use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Coding;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Reference;
use App\Fhir\Exception\TextNotDefinedException;

class Encounter extends DomainResource{

    public function __construct($json = null){
        $this->resourceType = "Encounter";
        parent::__construct($json);
        $this->identifier = [];
        $this->classHistory = [];
        $this->type = [];
        $this->episodeOfCare = [];
        $this->basedOn = [];
        $this->statusHistory = [];
        $this->participant = [];
        $this->appointment = [];
        $this->reasonCode = [];
        $this->diagnosis = [];
        $this->account = [];
        $this->reasonReference = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier)){
            foreach($json->identifier as $identifier){
                $this->addIdentifier(Identifier::Load($identifier));
            }
        }
        if(isset($json->status)){
            $this->status = $json->status;
        }
        if(isset($json->statusHistory)){
            foreach($json->statusHistory as $statusHistory){
                $history = [];
                if(isset($statusHistory->status)){
                    $history["status"] = $statusHistory->status;
                }
                if(isset($statusHistory->period)){
                    $history["period"] = Period::Load($statusHistory->period);
                }
                $this->statusHistory[] = $history;
            }
        }
        if(isset($json->classHistory)){
            foreach($json->classHistory as $classHistory){
                $history = [];
                if(isset($classHistory->class)){
                    $history["class"] = Coding::Load($classHistory->class);
                }
                if(isset($classHistory->period)){
                    $history["period"] = Period::Load($classHistory->period);
                }
                $this->classHistory[] = $history;
            }
        }
        if(isset($json->class)){
            $this->setClass(Coding::Load($json->class));
        }
        if(isset($json->type)){
            foreach($json->type as $type){
                $this->addType(CodeableConcept::Load($type));
            }
        }
        if(isset($json->serviceType)){
            $this->setServiceType(CodeableConcept::Load($json->serviceType));
        }
        if(isset($json->priority)){
            $this->setPriority(CodeableConcept::Load($json->priority));
        }
        if(isset($json->subject)){
            $this->subject = Reference::Load($json->subject);
        }
        if(isset($json->episodeOfCare)){
            foreach($json->episodeOfCare as $episodeOfCare){
                $this->episodeOfCare[] = Reference::Load($episodeOfCare);
            }
        }
        if(isset($json->basedOn)){
            foreach($json->basedOn as $basedOn){
                $this->basedOn[] = Reference::Load($basedOn);
            }
        }
        if(isset($json->participant)){
            foreach ($json->participant as $participant) {
                $participants = [];
                if(isset($participant->type)){
                    $types = [];
                    foreach($participant->type as $type)
                        $types[] = CodeableConcept::Load($type);
                    $participants["types"] = $types;
                }
                if(isset($participant->period))
                    $participants["period"] = $participant->period;
                if(isset($participant->individual))
                    $participants["individual"] = $participant->individual;
                $this->participant[] = $participants;
            }
        }
        if(isset($json->appointment)){
            foreach($json->appointment as $appointment){
                $this->appointment[] = Reference::Load($appointment);
            }
        }
        if(isset($json->period)){
            $this->setPeriod(Period::Load($json->period));
        }
        if(isset($json->length)){
            $this->setLength(Quantity::Load($json->length));
        }
        if(isset($json->reasonCode)){
            foreach($json->reasonCode as $reasonCode){
                $this->reasonCode[] = CodeableConcept::Load($reasonCode);
            }
        }
        if(isset($json->reasonReference)){
            foreach($json->reasonReference as $reasonReference){
                $this->reasonReference[] = Reference::Load($reasonReference);
            }
        }
        if(isset($json->diagnosis)){
            foreach($json->diagnosis as $diagnosis){
                $diagnosises = [];
                if(isset($diagnosis->condition)) $diagnosises["condition"] = Reference::Load($diagnosis->condition);
                if(isset($diagnosis->use)) $diagnosises["use"] = CodeableConcept::Load($diagnosis->use);
                if(isset($diagnosis->rank)) $diagnosises["rank"] = $diagnosis->rank;
                $this->diagnosis[] = $diagnosises;
            }
        }
        if(isset($json->account)){
            foreach($json->account as $account){
                $this->account[] = Reference::Load($account);
            }
        }
        if(isset($json->hospitalization)){
            if(isset($json->hospitalization->preAdmissionIdentifier)){
                $this->hospitalization["preAdmissionIdentifier"] = Identifier::Load($json->hospitalization->preAdmissionIdentifier);
            }
            if(isset($json->hospitalization->origin)){
                $this->hospitalization["origin"] = Reference::Load($json->hospitalization->origin);
            }
            if(isset($json->hospitalization->admitSource)){
                $this->hospitalization["admitSource"] = CodeableConcept::Load($json->hospitalization->admitSource);
            }
            if(isset($json->hospitalization->reAdmission)){
                $this->hospitalization["reAdmission"] = CodeableConcept::Load($json->hospitalization->reAdmission);
            }
            if(isset($json->hospitalization->dietPreference)){
                foreach($json->hospitalization->dietPreference as $dietPreference)
                    $this->hospitalization["dietPreference"] = CodeableConcept::Load($dietPreference);
            }
            if(isset($json->hospitalization->specialCourtesy)){
                foreach($json->hospitalization->specialCourtesy as $specialCourtesy)
                    $this->hospitalization["specialCourtesy"] = CodeableConcept::Load($specialCourtesy);
            }
            if(isset($json->hospitalization->specialArrangement)){
                foreach($json->hospitalization->specialArrangement as $specialArrangement)
                    $this->hospitalization["specialArrangement"] = CodeableConcept::Load($specialArrangement);
            }
            if(isset($json->hospitalization->destination)){
                $this->hospitalization["destination"] = Reference::Load($json->hospitalization->destination);
            }
            if(isset($json->hospitalization->dischargeDisposition)){
                $this->hospitalization["dischargeDisposition"] = CodeableConcept::Load($json->hospitalization->dischargeDisposition);
            }
        }
        if(isset($json->location)){
            foreach($json->location as $location){
                $locations = [];
                if(isset($location->location))
                    $locations["location"] = Reference::Load($location->location);
                if(isset($location->status))
                    $locations["status"] = $location->status;
                if(isset($location->physicalType))
                    $locations["physicalType"] = CodeableConcept::Load($location->physicalType);
                if(isset($location->period))
                    $locations["period"] = Period::Load($location->period);
                $this->location[] = $locations;
            }
        }
        if(isset($json->serviceProvider)){
            $this->serviceProvider = Reference::Load($json->serviceProvider);
        }
        if(isset($json->partOf)){
            $this->partOf = Reference::Load($json->partOf);
        }
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setStatus($status){
        $this->status = null;
        $only = ["planned", "arrived", "triaged", "in-progress", "onleave", "finished", "cancelled"];
        foreach($only as $word){
            if($word == strtolower($status)){
                $this->status = $status;
            }
        }
        if(!$this->status){
			throw new TextNotDefinedException("Status", implode(", ",$only));
        }
    }
    public function addStatusHistory($status, Period $period){
        $status_acepted = $this->only(["planned", "arrived", "triaged", "in-progress", "onleave", "finished", "cancelled"], $status);
        $statusHistory = [
            "status"=>$status_acepted,
            "period"=>$period
        ];
        $this->statusHistory[] = $statusHistory;
    }
    public function addClassHistory(Coding $coding, Period $period){
        $classHistory = [
            "class"=>$coding,
            "period"=>$period
        ];
        $this->classHistory[] = $classHistory;
    }
    public function setClass(Coding $class){
        $this->class = $class;
    }
    public function addType(CodeableConcept $type){
        $this->type[] = $type;
    }
    public function setServiceType(CodeableConcept $serviceType){
        $this->serviceType = $serviceType;
    }
    public function setPriority(CodeableConcept $priority){
        $this->priority = $priority;
    }
    public function setSubject(Resource $subject){
        $this->subject = $subject->toReference();
    }
    public function addEpisodeOfCare(Resource $episodeOfCare){
        $this->episodeOfCare[] = $episodeOfCare->toReference();
    }
    public function addBasedOn(Resource $basedOn){
        $this->basedOn[] = $basedOn->toReference();
    }
    public function addParticipant($types, $period, $individual){
        $participant = [];
        $participant["type"] = [];
        foreach($types as $type){
            if($type instanceOf CodeableConcept){
                $participant["type"][] = $type;
            }
        }
        $participant["period"] = $period;
        $participant["individual"] = $individual;
        $this->participant[] = $participant;
    }
    public function addAppointment(Resource $appointment){
        $this->appointment[] = $appointment->toReference();
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function setLength(Quantity $length){
        $this->length = $length;
    }
    public function addReasonCode(CodeableConcept $reasonCode){
        $this->reasonCode[] = $reasonCode;
    }
    public function addReasonReference(Resource $reasonReference){
        $this->reasonReference[] = $reasonReference->toReference();
    }
    public function addDiagnosis(Resource $condition, CodeableConcept $use, $rank){
        $data = [
            "condition"=>$condition->toReference(),
            "use"=>$use,
            "rank"=>$rank,
        ];
        $this->diagnosis[] = $data;
    }
    public function addAccount(Resource $account){
        $this->account[] = $account->toReference();
    }
    public function setHospitalization(Identifier $preAdmissionIdentifier = null, Resource $origin = null, CodeableConcept $admitSource = null, CodeableConcept $reAdmission = null, 
                                        CodeableConcept $dietPreference = null, CodeableConcept $specialCourtesy = null, CodeableConcept $specialArrangement = null,
                                        Resource $destination = null, CodeableConcept $dischargeDisposition = null
                                    ){
        if(isset($preAdmissionIdentifier)){
            $this->hospitalization["preAdmissionIdentifier"] = $preAdmissionIdentifier;
        }
        if(isset($origin)){
            $this->hospitalization["origin"] = $origin->toReference();
        }
        if(isset($admitSource)){
            $this->hospitalization["admitSource"] = $admitSource;
        }
        if(isset($reAdmission)){
            $this->hospitalization["reAdmission"] = $reAdmission;
        }
        if(isset($dietPreference)){
            $this->hospitalization["dietPreference"] = $dietPreference;
        }
        if(isset($specialCourtesy)){
            $this->hospitalization["specialCourtesy"] = $specialCourtesy;
        }
        if(isset($specialArrangement)){
            $this->hospitalization["specialArrangement"] = $specialArrangement;
        }
        if(isset($destination)){
            $this->hospitalization["destination"] = $destination->toReference();
        }
        if(isset($dischargeDisposition)){
            $this->hospitalization["dischargeDisposition"] = $dischargeDisposition;
        }
    }
    public function addLocation(Resource $location, $status, CodeableConcept $physicalType, Period $period){
        $data = [];
        $data["location"] = $location->toReference();
        $data["status"] = $this->only(["planned", "active", "reserved", "completed"], $status);
        $data["physicalType"] = $physicalType;
        $data["period"] = $period;
        $this->location[] = $data;
    }
    public function setServiceProvider(Resource $serviceProvider){
        $this->serviceProvider = $serviceProvider->toReference();
    }
    public function setPartOf(Resource $partOf){
        $this->partOf = $partOf->toReference();
    }

    public function toString(){
        $texto = "Visita";
        if(isset($this->period)){
            $texto .= " ". $this->period->toString();
        }
        return $texto;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        foreach($this->identifier as $identifier){
            $arrayData["identifier"][] = $identifier->toArray();
        }
        if(isset($this->status)){
            $arrayData["status"] = $this->status;
        }
        foreach($this->statusHistory as $statusHistory){
            $arrayData["statusHistory"][] = [
                "status"=>$statusHistory["status"],
                "period"=>$statusHistory["period"]->toArray()
            ];
        }
        foreach($this->classHistory as $classHistory){
            $data = [];
            if(isset($classHistory["class"])){
                $data["class"] = $classHistory["class"]->toArray();
            }
            if(isset($classHistory["period"])){
                $data["period"] = $classHistory["period"]->toArray();
            }
            $arrayData["classHistory"][] = $data;
        }
        if(isset($this->class)){
            $arrayData["class"] = $this->class->toArray();
        }
        foreach($this->type as $type){
            $arrayData["type"][] = $type->toArray();
        }
        if(isset($this->serviceType)){
            $arrayData["serviceType"] = $this->serviceType->toArray();
        }
        if(isset($this->priority)){
            $arrayData["priority"] = $this->priority->toArray();
        }
        if(isset($this->subject)){
            $arrayData["subject"] = $this->subject->toArray();
        }
        foreach($this->episodeOfCare as $episodeOfCare){
            $arrayData["episodeOfCare"][] = $episodeOfCare->toArray();
        }
        foreach($this->basedOn as $basedOn){
            $arrayData["basedOn"][] = $basedOn->toArray();
        }
        foreach ($this->participant as $participant) {
            $data = [];
            if(isset($participant["type"])){
                $types = [];
                foreach($participant["type"] as $type)
                    $types[] = $type->toArray();
                $data["type"] = $types;
            }
            if(isset($participant["participant"]))
                $data["participant"] = $participant["participant"]->toArray();
            if(isset($participant["individual"]))
                $data["individual"] = $participant["individual"];
            $arrayData["participant"][] = $data;
        }
        foreach($this->appointment as $appointment){
            $arrayData["appointment"] = $appointment->toArray();
        }
        if(isset($this->period)){
            $arrayData["period"] = $this->period->toArray();
        }
        if(isset($this->length)){
            $arrayData["length"] = $this->length->toArray();
        }
        foreach($this->reasonCode as $reasonCode){
            $arrayData["reasonCode"][] = $reasonCode->toArray();
        }
        foreach($this->reasonReference as $reasonReference){
            $arrayData["reasonReference"][] = $reasonReference->toArray();
        }
        foreach($this->diagnosis as $diagnosis){
            $data = [];
            if(isset($diagnosis["condition"]))
                $data["condition"] = $diagnosis["condition"]->toArray();
            if(isset($diagnosis["use"]))
                $data["use"] = $diagnosis["use"]->toArray();
            if(isset($diagnosis["rank"]))
                $data["rank"] = $diagnosis["rank"];
            $arrayData["diagnosis"][] = $data;
        }
        foreach($this->account as $account){
            $arrayData["account"] = $account->toArray();
        }
        if(isset($this->hospitalization)){
            if(isset($this->hospitalization["preAdmissionIdentifier"])){
                $arrayData["hospitalization"]["preAdmissionIdentifier"] = $this->hospitalization["preAdmissionIdentifier"]->toArray();
            }
            if(isset($this->hospitalization["origin"])){
                $arrayData["hospitalization"]["origin"] = $this->hospitalization["origin"]->toArray();
            }
            if(isset($this->hospitalization["admitSource"])){
                $arrayData["hospitalization"]["admitSource"] = $this->hospitalization["admitSource"]->toArray();
            }
            if(isset($this->hospitalization["reAdmission"])){
                $arrayData["hospitalization"]["reAdmission"] = $this->hospitalization["reAdmission"]->toArray();
            }
            if(isset($this->hospitalization["dietPreference"])){
                $arrayData["hospitalization"]["dietPreference"] = $this->hospitalization["dietPreference"]->toArray();
            }
            if(isset($this->hospitalization["specialCourtesy"])){
                $arrayData["hospitalization"]["specialCourtesy"] = $this->hospitalization["specialCourtesy"]->toArray();
            }
            if(isset($this->hospitalization["specialArrangement"])){
                $arrayData["hospitalization"]["specialArrangement"] = $this->hospitalization["specialArrangement"]->toArray();
            }
            if(isset($this->hospitalization["destination"])){
                $arrayData["hospitalization"]["destination"] = $this->hospitalization["destination"]->toArray();
            }
            if(isset($this->hospitalization["dischargeDisposition"])){
                $arrayData["hospitalization"]["dischargeDisposition"] = $this->hospitalization["dischargeDisposition"]->toArray();
            }
        }
        if(isset($this->location)){
            foreach($this->location as $location){
                $data = [];
                if(isset($location["location"]))
                    $data["location"] = $location["location"]->toArray();
                if(isset($location["status"]))
                    $data["status"] = $location["status"];
                if(isset($location["physicalType"]))
                    $data["physicalType"] = $location["physicalType"]->toArray();
                if(isset($location["period"]))
                    $data["period"] = $location["period"]->toArray();
                $arrayData["location"][] = $data;
            }
        }
        if(isset($this->serviceProvider)){
            $arrayData["serviceProvider"] = $this->serviceProvider->toArray();
        }
        if(isset($this->partOf)){
            $arrayData["partOf"] = $this->partOf->toArray();
        }
        return $arrayData;
    }
}