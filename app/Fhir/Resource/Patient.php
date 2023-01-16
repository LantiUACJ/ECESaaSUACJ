<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\HumanName;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\ContactPoint;
use App\Fhir\Element\Address;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\attachment;
use App\Fhir\Element\Reference;
use App\Fhir\Element\Period;
use App\Fhir\Resource\Resource;

class Patient extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Patient";
        parent::__construct($json);
        $this->name = [];
        $this->identifier = [];
        $this->telecom = [];
        $this->address = [];
        $this->contact = [];
        $this->communication = [];
        $this->generalPractitioner = [];
        $this->link = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if(isset($json->name))
            foreach($json->name as $name)
                $this->name[] = HumanName::Load($name);
        if(isset($json->identifier))
            foreach($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if(isset($json->active))
            $this->active = $json->active;
        if(isset($json->gender))
            $this->gender = $json->gender;
        if(isset($json->birthDate))
            $this->birthDate = $json->birthDate;
        if(isset($json->deceasedBoolean))
            $this->deceasedBoolean = $json->deceasedBoolean;
        if(isset($json->deceasedDateTime))
            $this->deceasedDateTime = $json->deceasedDateTime;
        if(isset($json->multipleBirthBoolean))
            $this->multipleBirthBoolean = $json->multipleBirthBoolean;
        if(isset($json->multipleBirthInteger))
            $this->multipleBirthInteger = $json->multipleBirthInteger;
        if(isset($json->telecom))
            foreach($json->telecom as $telecom)
                $this->telecom[] = ContactPoint::Load($telecom);
        if(isset($json->address))
            foreach($json->address as $address)
                $this->address[] = Address::Load($address);
        if(isset($json->maritalStatus))
            $this->maritalStatus = CodeableConcept::Load($json->maritalStatus);
        if(isset($json->photo))
            $this->photo = Attachment::Load($json->photo);
        if(isset($json->contact)){
            $this->contact = [];
            foreach($json->contact as $contact){
                if($contact->relationship){
                    $this->contact["relations"] = [];
                    foreach($contact->relationship as $rel)
                        $this->contact["relations"][] = CodeableConcept::Load($rel);
                }
                if(isset($contact->name))
                    $this->contact["name"] = HumanName::Load($contact->name);
                if(isset($contact->telecom)){
                    $this->contact["telecom"] = [];
                    foreach($contact->telecom as $telecom)
                        $this->contact["telecom"][] = ContactPoint::Load($telecom);
                }
                if(isset($contact->address))
                    $this->contact["address"] = Address::Load($contact->address);
                if(isset($contact->gender))
                    $this->contact["gender"] = $contact->gender;
            }
        }
        if(isset($json->communication))
            foreach($json->communication as $communication){
                $data = [];
                if($communication->language)
                    $data["language"] = CodeableConcept::Load($communication->language);
                if($communication->preferred)
                    $data["preferred"] = $communication->preferred;
                $this->communication[] = $data;
            }
        if(isset($json->generalPractitioner))
            foreach($json->generalPractitioner as $generalPractitioner)
                $this->generalPractitioner[] = $generalPractitioner->toArray();
        if(isset($json->managingOrganization))
            $this->managingOrganization = Reference::Load($json->managingOrganization);
        if(isset($json->link))
            foreach($json->link as $link)
                $this->link[] = $link->toArray();
    }

    /* 
        obligatorio
        el paciente tiene varias extensiones:
        "extension": \App\Element\Extension (array 7..*)
            {
                "url": "urn:edoNacimiento",
                "valueCode": 
            },
            {
                "url": "urn:tipoBenificiario",
                "valueCode": 
            },
            {
                "url": "urn:cveDep",
                "valueCode": 
            },
            {
                "url": "urn:cveProg",
                "valueCode": 
            },
            {
                "url": "urn:nacOrigen",
                "valueCode": 
            },
            {
                "url": "urn:SEXO_2021",
                "valueCode": 
            },
            {
                "url": "urn:Etina",
                "valueCode": 
            }
    */

    /* obligatorio
        "name": \Fhir\Element\HumanName (array 1..*)
            "use": 
            "_family": // esto esta raro pero son cosas de jarero
                "extension": \Fhir\Element\Extension (array 2..*)
                    {
                        "url": "http://hl7.org/fhir/StructureDefinition/humanname-fathers-family",
                        "valueString": 
                    },
                    {
                        "url": "http://hl7.org/fhir/StructureDefinition/humanname-mothers-family",
                        "valueString":
                    }
            "family": 
            "given": array(1..*) strings
            "text": 
    */
    public function addName(HumanName $name){
        $this->name[] = $name;
    }
    /*  obligatorio
        "identifier": \Fhir\Element\Identifier (array 2..*)
        { //curp
            "use": "official",
            "system": "urn:oid:2.16.840.1.113883.4.629",
            "value": 
        },
        { // folio
            "use": "secondary",
            "system": "urn:folio",
            "value":
        }
    */
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setActive($active){
        $this->active = $active;
    }
    /* obligatorio solo ("male", "female", "unknown", "other") Nota: los catalagos de salud tienen más */
    public function setGender($gender){
        $only = ["male", "female", "unknown", "other"];
        $this->gender = $gender;
    }
    /* obligatorio formato: YYYY-MM-DD */
    public function setBirthDate($birthDate){
        $this->birthDate = $birthDate;
    }
    public function setDeceasedBoolean($deceasedBoolean){
        $this->deceasedBoolean = $deceasedBoolean;
    }
    public function setDeceasedDateTime($deceasedDateTime){
        $this->deceasedDateTime = $deceasedDateTime;
    }
    public function setMultipleBirthBoolean($multipleBirthBoolean){
        $this->multipleBirthBoolean = $multipleBirthBoolean;
    }
    public function setMultipleBirthInteger($multipleBirthInteger){
        $this->multipleBirthInteger = $multipleBirthInteger;
    }
    public function addTelecom(ContactPoint $telecom){
        $this->telecom[] = $telecom;
    }
    /* obligatorio
        address: \Fhir\Element\Address: (array 1..*)
            "extension": \Fhir\Element\Extension (array 1..*)
                "url": "http://terminology.hl7mx.org/address/colonia",
                "valueString":
            "type": 
            "state": 
            "district": 
            "city": 
            "postalCode": 
            "line": 
            "text": 
    */
    public function addAddress(Address $address){
        $this->address[] = $address;
    }
    public function setMaritalStatus(CodeableConcept $maritalStatus){
        $this->maritalStatus = $maritalStatus;
    }
    public function setPhoto(Attachment $photo){
        $this->photo = $photo;
    }
    public function addContact(CodeableConcept $relationship, HumanName $name, ContactPoint $telecom, Address $address, $gender, Resource $organization, Period $period){
        $relations = [];
        $relationship = [];
        $telecoms = [];
        $contact = [];
        foreach($relationship as $rel)
            if($rel instanceof CodeableConcept)
                $relations[] = $relationship;
        if(sizeof($relations) > 0){
            $contact["relationship"] = $relations;
        }
        $relationship["name"] = $name;
        foreach($telecom as $tel)
            if($rel instanceof CodeableConcept)
                $telecoms[] = $tel;
        if(sizeof($telecoms) > 0){
            $contact["telecom"] = $telecoms;
        }
        $contact["address"] = $address;
        $only = ["male", "female", "unknown", "other"];
        $contact["gender"] = $gender; 
        $contact["organization"] = $organization->toReference();
        $contact["period"] = $period;
        $this->contact[] = $contact;
    }
    public function addCommunication(CodeableConcept $language, $preferred){
        $this->communication[] = [
            "language"=>$language,
            "preferred"=>$preferred,
        ];
    }
    public function addGeneralPractitioner(Resource $generalPractitioner){
        $this->generalPractitioner[] = $generalPractitioner->toReference();
    }
    public function setManagingOrganization(Resource $managingOrganization){
        $this->managingOrganization = $managingOrganization->toReference();
    }
    public function addLink(Resource $link){
        $this->link[] = $link->toReference();
    }



    public function toString(){
        return "Datos del paciente: " . $this->name[0]->toString();
    }
    public function toArray(){
        $arrayData = parent::toArray();
        foreach($this->name as $name){
            $arrayData["name"][] = $name->toArray();
        }
        foreach($this->identifier as $identifier){
            $arrayData["identifier"][] = $identifier->toArray();
        }
        if(isset($this->active)){
            $arrayData["active"] = $this->active;
        }
        if(isset($this->gender)){
            $arrayData["gender"] = $this->gender;
        }
        if(isset($this->birthDate)){
            $arrayData["birthDate"] = $this->birthDate;
        }
        if(isset($this->deceasedBoolean)){
            $arrayData["deceasedBoolean"] = $this->deceasedBoolean;
        }
        if(isset($this->deceasedDateTime)){
            $arrayData["deceasedDateTime"] = $this->deceasedDateTime;
        }
        if(isset($this->multipleBirthBoolean)){
            $arrayData["multipleBirthBoolean"] = $this->multipleBirthBoolean;
        }
        if(isset($this->multipleBirthInteger)){
            $arrayData["multipleBirthInteger"] = $this->multipleBirthInteger;
        }
        foreach($this->telecom as $telecom){
            $arrayData["telecom"][] = $telecom->toArray();
        }
        foreach($this->address as $address){
            $arrayData["address"][] = $address->toArray();
        }
        if(isset($this->maritalStatus)){
            $arrayData["maritalStatus"] = $this->maritalStatus->toArray();
        }
        if(isset($this->photo)){
            $arrayData["photo"] = $this->photo->toArray();
        }
        foreach($this->contact as $contact){
            if($contact->relationship){
                $arrayData["contact"]["relations"] = [];
                foreach($contact->relationship as $rel)
                    $arrayData["contact"]["relations"][] = $rel->toArray();
            }
            if(isset($contact->name))
                $arrayData["contact"]["name"] = $contact->name->toArray();
            if(isset($contact->telecom)){
                $arrayData["contact"]["telecom"] = [];
                foreach($contact->telecom as $telecom)
                    $arrayData["contact"]["telecom"][] = $telecom->toArray();
            }
            if(isset($contact->address))
                $arrayData["contact"]["address"] = $contact->address->toArray();
            if(isset($contact->gender))
                $arrayData["contact"]["gender"] = $contact->gender;
        }
        foreach($this->communication as $communication){
            $data = [];
            if(isset($communication["language"]) && $communication["language"])
                $data["language"] = $communication["language"]->toArray();
            if(isset($communication["preferred"]) && $communication["preferred"])
                $data["preferred"] = $communication["preferred"];
            $arrayData["communication"][] = $data;
        }
        foreach($this->generalPractitioner as $generalPractitioner){
            $arrayData["generalPractitioner"][] = $generalPractitioner->toArray();
        }
        if(isset($this->managingOrganization)){
            $arrayData["managingOrganization"] = $this->managingOrganization->toArray();
        }
        foreach($this->link as $link){
            $arrayData["link"][] = $link->toArray();
        }
        return $arrayData;
    }
}
