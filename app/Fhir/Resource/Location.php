<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Address;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\Coding;
use App\Fhir\Element\ContactPoint;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Reference;

class Location extends DomainResource{
    public function __construct($json = null){
        $this->resourceType = "Location";
        parent::__construct($json);
        $this->identifier = [];
        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if (isset($json->identifier))
            foreach ($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if (isset($json->status)){
            $array = ["active", "suspended","inactive"];
            $this->status = $json->status;
        }
        if (isset($json->operationalStatus)){
            $this->operationStatus = Coding::Load($json->operationalStatus);
        }
        if (isset($json->name))
            $this->name = $json->name;
        if (isset($json->alias)){
            $aliases = [];
            foreach ($json->alias as $alias)
                $aliases[] = $alias;
            $this->alias = $aliases;
        }
        if (isset($json->description))
            $this->description = $json->description;
        if (isset($json->mode)){
            $array = ["instance", "kind"];
            $this->mode = $json->mode;
        }
        if (isset($json->type)){
            $types = [];
            foreach ($json->type as $type)
                $types[] = CodeableConcept::Load($type);
            $this->type = $types;
        }
        if (isset($json->telecom)){
            $contactpoints = [];
            foreach ($json->telecom as $telecom)
                $contactpoints[] = ContactPoint::Load($telecom);
            $this->telecom = $contactpoints;
        }
        if (isset($json->address))
            $this->address = Address::Load($json->address);
        if (isset($json->physicalType))
            $this->physicalType = CodeableConcept::Load($json->physicalType);
        if (isset($json->position)){
            $this->position = [];
            if (isset($json->position->longitude))
                $this->position["longitude"] = $json->position->longitude;
            if (isset($json->position->latitude))
                $this->position["latitude"] = $json->position->latitude;
            if (isset($json->position->altitude))
                $this->position["altitude"] = $json->position->altitude;
        }
        if (isset($json->managingOrganization))
            $this->managingOrganization = Reference::Load($json->managingOrganization);
        if (isset($json->partOf))
            $this->partOf = Reference::Load($json->partOf);
        if (isset($json->hoursOfOperation)){
            $hours = [];
            foreach ($json->hoursOfOperation as $hoursOfOperation){
                $hours = [];
                if (isset($hoursOfOperation->daysOfWeek)){
                    $days = [];
                    foreach ($hoursOfOperation->daysOfWeek as $daysOfWeek){
                        $array = ["mon","tue","wed","thu","fri","sat","sun"];
                        $days[] = $daysOfWeek;
                    }
                    $hours["hoursOfOperation"] = $days;
                }
                if (isset($hoursOfOperation->allDay))
                    $hours["allDay"] = $hoursOfOperation->allDay;
                if (isset($hoursOfOperation->openingTime))
                    $hours["openingTime"] = $hoursOfOperation->openingTime;
                if (isset($hoursOfOperation->closingTime))
                    $hours["closingTime"] = $hoursOfOperation->closingTime;
            }
        }
        if (isset($json->availabilityExceptions))
            $this->availabilityExceptions = $json->availabilityExceptions;
        if (isset($json->endpoint))
            foreach ($json->endpoint as $endpoint)
                $this->endpoint[] = Reference::Load($endpoint);
    }

    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = $identifier;
    }
    public function setStatus($status){
        $array = ["active", "suspended","inactive"];
        $this->status = $status;
    }
    public function setOperationalStatus(Coding $operationalStatus){
        $this->operationStatus = $operationalStatus;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function addAlias($alias){
        $this->alias[] = $alias;
    }
    public function setDescription($description){
        $this->description = $description;
    }
    public function setMode($mode){
        $array = ["instance", "kind"];
        $this->mode = $mode;
    }
    public function addType(CodeableConcept $type){
        $this->type[] = $type;
    }
    public function addTelecom(ContactPoint $telecom){
        $this->telecom[] = $telecom;
    }
    public function setAddress(Address $address){
        $this->address = $address;
    }
    public function setPhysicalType(CodeableConcept $physicalType){
        $this->physicalType = $physicalType;
    }
    public function setPosition($longitude, $latitude, $altitude){
        $this->position = [];
        if (isset($longitude))
            $this->position["longitude"] = $longitude;
        if (isset($latitude))
            $this->position["latitude"] = $latitude;
        if (isset($altitude))
            $this->position["altitude"] = $altitude;
    }
    public function setManagingOrganization(Resource $managingOrganization){
        $this->managingOrganization = $managingOrganization->toReference();
    }
    public function setPartOf(Resource $partOf){
        $this->partOf = $partOf->toReference();
    }
    public function addHoursOfOperation($daysOfWeek, $allDay, $openingTime, $closingTime){
        $hours = [];
        $hours = [];
        if (isset($daysOfWeek)){
            $days = [];
            foreach ($daysOfWeek as $daysdata){
                $array = ["mon","tue","wed","thu","fri","sat","sun"];
                $days[] = $daysdata;
            }
            $hours["daysOfWeek"] =$days;
        }
        if (isset($allDay))
            $hours["allDay"] = $allDay;
        if (isset($openingTime))
            $hours["openingTime"] = $openingTime;
        if (isset($closingTime))
            $hours["closingTime"] = $closingTime;
    }
    public function setAvailabilityExceptions($availabilityExceptions){
        $this->availabilityExceptions = $availabilityExceptions;
    }
    public function addEndpoint(Resource $endpoint){
        $this->endpoint[] = $endpoint->toReference();
    }
    public function toArray(){
        $arrayData = parent::toArray();
        if (isset($this->identifier))
            foreach ($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        if (isset($this->status)){
            $array = ["active", "suspended","inactive"];
            $arrayData["status"] = $this->status;
        }
        if (isset($this->operationalStatus)){
            $arrayData["operationStatus"] = $this->operationalStatus->toArray();
        }
        if (isset($this->name))
            $arrayData["name"] = $this->name;
        if (isset($this->alias)){
            $aliases = [];
            foreach ($this->alias as $alias)
                $aliases[] = $alias;
            $arrayData["alias"] = $aliases;
        }
        if (isset($this->description))
            $arrayData["description"] = $this->description;
        if (isset($this->mode)){
            $array = ["instance", "kind"];
            $arrayData["mode"] = $this->mode;
        }
        if (isset($this->type)){
            $types = [];
            foreach ($this->type as $type)
                $types[] = $type->toArray();
            $arrayData["type"][] = $types;
        }
        if (isset($this->telecom)){
            $contactpoints = [];
            foreach ($this->telecom as $telecom)
                $contactpoints[] = $telecom->toArray();
            $arrayData["telecom"] = $contactpoints;
        }
        if (isset($this->address))
            $arrayData["address"] = $this->address->toArray();
        if (isset($this->physicalType))
            $arrayData["physicalType"] = $this->physicalType->toArray();
        if (isset($this->position)){
            $arrayData["position"] = [];
            if (isset($this->position["longitude"]))
                $arrayData["position"]["longitude"] = $this->position["longitude"];
            if (isset($this->position["latitude"]))
                $arrayData["position"]["latitude"] = $this->position["latitude"];
            if (isset($this->position["altitude"]))
                $arrayData["position"]["altitude"] = $this->position["altitude"];
        }
        if (isset($this->managingOrganization))
            $arrayData["managingOrganization"] = $this->managingOrganization->toArray();
        if (isset($this->partOf))
            $arrayData["partOf"] = $this->partOf->toArray();
        if (isset($this->hoursOfOperation)){
            $hours = [];
            foreach ($this->hoursOfOperation as $hoursOfOperation){
                $hours = [];
                if (isset($hoursOfOperation->daysOfWeek)){
                    $days = [];
                    foreach ($hoursOfOperation->daysOfWeek as $daysOfWeek){
                        $array = ["mon","tue","wed","thu","fri","sat","sun"];
                        $days[] = $daysOfWeek;
                    }
                    $hours["hoursOfOperation"] = $days;
                }
                if (isset($hoursOfOperation->allDay))
                    $hours["allDay"] = $hoursOfOperation->allDay;
                if (isset($hoursOfOperation->openingTime))
                    $hours["openingTime"] = $hoursOfOperation->openingTime;
                if (isset($hoursOfOperation->closingTime))
                    $hours["closingTime"] = $hoursOfOperation->closingTime;
            }
        }
        if (isset($this->availabilityExceptions))
            $arrayData["availabilityExceptions"] = $this->availabilityExceptions;
        if (isset($this->endpoint))
            foreach ($this->endpoint as $endpoint)
                $arrayData["endpoint"] = $endpoint->toArray();
        return $arrayData;
    }
}