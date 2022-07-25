<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Address;
use App\Fhir\Element\Attachment;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\ContactPoint;
use App\Fhir\Element\HumanName;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Reference;

class Practitioner extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Practitioner";
        parent::__construct($json);
        $this->identifier = [];
        $this->name = [];
        $this->telecom = [];
        $this->address = [];
        $this->qualification = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->identifier))
            foreach($json->identifier as $identifier){
                $this->identifier[] = Identifier::Load($identifier);
            }
        if(isset($json->active)){
            $this->active = $json->active;
        }
        if(isset($json->name))
            foreach($json->name as $name){
                $this->name[] = HumanName::Load($name);
            }
        if(isset($json->telecom))
            foreach($json->telecom as $telecom){
                $this->telecom[] = ContactPoint::Load($telecom);
            }
        if(isset($json->address))
            foreach($json->address as $address){
                $this->address[] = Address::Load($address);
            }
        if(isset($json->gender)){
            $this->gender = $json->gender;
        }
        if(isset($json->birthDate)){
            $this->birthDate = $json->birthDate;
        }
        if(isset($json->photo)){
            $this->photo = $json->photo;
        }
        if(isset($json->qualification))
            foreach($json->qualification as $qualification){
                $data = [];
                if(isset($qualification->identifier))
                    foreach($qualification->identifier as $identifier)
                        $data["identifier"][] = Identifier::Load($identifier);
                if(isset($qualification->code))
                    $data["code"] = CodeableConcept::Load($qualification->code);
                if(isset($qualification->period))
                    $data["period"] = Period::Load($qualification->period);
                if(isset($qualification->issuer))
                    $data["issuer"] = Reference::Load($qualification->issuer);
                $this->qualification[] = $data;
            }
        if(isset($json->communication)){
            foreach($json->communication as $communication)
                $this->communication[] = CodeableConcept::Load($communication);
        }
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setActive($active){
        $this->active = $active;
    }
    public function addName(HumanName $name){
        $this->name[] = $name;
    }
    public function addTelecom(ContactPoint $telecom){
        $this->telecom[] = $telecom;
    }
    public function addAddress(Address $address){
        $this->address[] = $address;
    }
    public function setGender($gender){
        $only = ["male", "female", "unknown", "other"];
        $this->gender = $gender;
    }
    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }
    public function setPhoto(Attachment $photo){
        $this->photo = $photo;
    }
    public function addQualification(Identifier $identifier, CodeableConcept $code, Period $period, Resource $issuer){
        $this->qualification[] = [
            "identifier" => $identifier,
            "code" => $code,
            "period" => $period,
            "issuer" => $issuer->toReference()
        ];
    }
    public function setCommunication(CodeableConcept $communication){
        $this->communication = $communication;
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->identifier))
            foreach($this->identifier as $identifier){
                $arrayData["identifier"][] = $identifier->toArray();
            }
        if(isset($this->active)){
            $arrayData["active"] = $this->active;
        }
        if(isset($this->name))
            foreach($this->name as $name){
                $arrayData["name"][] = $name->toArray();
            }
        if(isset($this->telecom))
            foreach($this->telecom as $telecom){
                $arrayData["telecom"][] = $telecom->toArray();
            }
        if(isset($this->address))
            foreach($this->address as $address){
                $arrayData["address"][] = $address->toArray();
            }
        if(isset($this->gender)){
            $arrayData["gender"] = $this->gender;
        }
        if(isset($this->birthDate)){
            $arrayData["birthDate"] = $this->birthDate;
        }
        if(isset($this->photo)){
            $arrayData["photo"] = $this->photo;
        }
        if(isset($this->qualification))
            foreach($this->qualification as $qualification){
                $data = [];
                if(isset($qualification["identifier"]))
                    foreach($qualification["identifier"] as $identifier)
                        $data["identifier"][] = $identifier->toArray();
                if(isset($qualification["code"]))
                    $data["code"] = $qualification["code"]->toArray();
                if(isset($qualification["period"]))
                    $data["period"] = $qualification["period"]->toArray();
                if(isset($qualification["issuer"]))
                    $data["issuer"] = $qualification["issuer"]->toArray();
                $arrayData["qualification"][] = $data;
            }
        if(isset($this->communication)){
            foreach($this->communication as $communication)
                $arrayData["communication"][] = $communication->toArray();
        }
        return $arrayData;
    }
}
