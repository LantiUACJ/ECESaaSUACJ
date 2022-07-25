<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\ContactPoint;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Reference;

class PractitionerRole extends DomainResource{
    public function __construct($json = null){
        parent::__construct($json);
        $this->resourceType = "PractitionerRole";

        $this->identifier = [];
        $this->code = [];
        $this->specialty = [];
        $this->location = [];
        $this->healthcareService = [];
        $this->telecom = [];
        $this->notAvailable = [];
        $this->availableTime = [];
        $this->endpoint = [];

        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if (isset($json->identifier))
            foreach ($json->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if (isset($json->active))
            $this->active = $json->active;
        if (isset($json->period))
            $this->period = Period::Load($json->period);
        if (isset($json->practitioner))
            $this->practitioner = Reference::Load($json->practitioner);
        if (isset($json->organization))
            $this->organization = reference::Load($json->organization);
        if (isset($json->code))
            foreach ($json->code as $code)
                $this->code[] = CodeableConcept::Load($code);
        if (isset($json->specialty))
            foreach ($json->specialty as $specialty)
                $this->specialty[] = CodeableConcept::Load($specialty);
        if (isset($json->location))
            foreach ($json->location as $location)
                $this->location[] = Reference::Load($location);
        if (isset($json->healthcareService))
            foreach ($json->healthcareService as $healthcareService)
                $this->healthcareService[] = Reference::Load($healthcareService);
        if (isset($json->telecom))
            foreach ($json->telecom as $telecom)
                $this->telecom[] = ContactPoint::Load($telecom);
        if (isset($json->availableTime)){
            foreach ($json->availableTime as $availableTime){
                $availableTimes = [];
                if (isset($availableTime->daysOfWeek)){
                    $days = [];
                    foreach ($availableTime->daysOfWeek as $daysOfWeek){
                        $array = ["mon","tue","wed","thu","fri","sat","sun"];
                        $days[] = $daysOfWeek;
                    }
                    $availableTimes["daysOfWeek"] = $days;
                }
                if (isset($availableTime->allDay))
                    $availableTimes["allDay"] = $availableTime->allDay;
                
                if (isset($availableTime->availableStartTime))
                    $availableTimes["availableStartTime"] = $availableTime->availableStartTime;
                
                if (isset($availableTime->availableEndTime))
                    $availableTimes["availableEndTime"]=$availableTime->availableEndTime;
                $this->availableTime[] = $availableTimes;
            }
        }
        if (isset($json->notAvailable))
            foreach ($json->notAvailable as $notAvailable){
                $notAvailables = [];
                if (isset($notAvailable->description)){
                    $notAvailables["description"] = $notAvailable->description;
                }
                if (isset($notAvailable->during))
                    $notAvailables["during"] = Period::Load($notAvailable->during);
                $this->notAvailable[] = $notAvailables;
            }
        if (isset($json->availabilityExceptions))
            $this->availabilityExceptions = $json->availabilityExceptions;
        if (isset($json->endpoint))
            foreach ($json->endpoint as $endpoint)
                $this->endpoint[] = Reference::Load($endpoint);
    }
    public function addIdentifier(Identifier $identifier){
        $this->identifier[] = Identifier::Load($identifier);
    }
    public function setActive($active){
        $this->active = $active;
    }
    public function setPeriod(Period $period){
        $this->period = $period;
    }
    public function setPractitioner(Resource $practitioner){
        $this->practitioner = $practitioner;
    }
    public function setOrganization(Resource $organization){
        $this->organization = $organization;
    }
    public function addCode(CodeableConcept $code){
        $this->code[] = $code;
    }
    public function addSpecialty(CodeableConcept $specialty){
        $this->specialty[] = $specialty;
    }
    public function addLocation(Resource $location){
        $this->location[] = $location->toReference();
    }
    public function addHealthcareService(Resource $healthcareService){
        $this->$healthcareService[] = $healthcareService->toReference();
    }
    public function addTelecom(ContactPoint $telecom){
        $this->telecom[] = $telecom;
    }
    public function addAvailableTime($daysOfWeek = null, $allDay = null, $availableStartTime = null, $availableEndTime = null){
        $availableTimes = [];
        if (isset($daysOfWeek)){
            $days = [];
            foreach ($daysOfWeek as $day){
                $array = ["mon","tue","wed","thu","fri","sat","sun"];
                $days[] = $day;
            }
            $availableTimes["daysOfWeek"] = $days;
        }
        if (isset($allDay))
            $availableTimes["allDay"] = $allDay;
        
        if (isset($availableStartTime))
            $availableTimes["availableStartTime"] = $availableStartTime;
        
        if (isset($availableEndTime))
            $availableTimes["availableEndTime"]=$availableEndTime;
        $this->availableTime[] = $availableTimes;
    }
    public function addNotAvailable($description, Period $during){
        $notAvailables = [];
        if (isset($description)){
            $notAvailables["description"] = $description;
        }
        if (isset($during))
            $notAvailables["during"] = $during;
        $this->notAvailable[] = $notAvailables;
    }
    public function setAvailabilityExceptions($availabilityExceptions){
        $this->availabilityExceptions = $availabilityExceptions;
    }
    
    public function addEndPoint(Resource $endpoint){
        $this->endpoint[] = $endpoint->toReference();
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if (isset($this->identifier))
            foreach ($this->identifier as $identifier)
                $arrayData["identifier"][] = $identifier->toArray();
        if (isset($this->active))
            $arrayData["active"] = $this->active;
        if (isset($this->period))
            $arrayData["period"] = $this->period->toArray();
        if (isset($this->practitioner))
            $arrayData["practitioner"] = $this->practitioner->toArray();
        if (isset($this->organization))
            $arrayData["organization"] = $this->organization->toArray();
        if (isset($this->code))
            foreach ($this->code as $code)
                $arrayData["code"][] = $code->toArray();
        if (isset($this->specialty))
            foreach ($this->specialty as $specialty)
                $arrayData["specialty"][] = $specialty->toArray();
        if (isset($this->location))
            foreach ($this->location as $location)
                $arrayData["location"][] = $location->toArray();
        if (isset($this->healthcareService))
            foreach ($this->healthcareService as $healthcareService)
                $arrayData["healthcareService"][] = $healthcareService->toArray();
        if (isset($this->telecom))
            foreach ($this->telecom as $telecom)
                $arrayData["telecom"][] = $telecom->toArray();
        if (isset($this->availableTime)){
            foreach ($this->availableTime as $availableTime){
                $availableTimes = [];
                if (isset($availableTime["daysOfWeek"])){
                    $days = [];
                    foreach ($availableTime["daysOfWeek"] as $daysOfWeek){
                        $days[] = $daysOfWeek;
                    }
                    $availableTimes["daysOfWeek"] = $days;
                }
                if (isset($availableTime["allDay"]))
                    $availableTimes["allDay"] = $availableTime["allDay"];
                
                if (isset($availableTime["availableStartTime"]))
                    $availableTimes["availableStartTime"] = $availableTime["availableStartTime"];
                
                if (isset($availableTime["availableEndTime"]))
                    $availableTimes["availableEndTime"]=$availableTime["availableEndTime"];
                $arrayData["availableTime"][] = $availableTimes;
            }
        }
        if (isset($this->notAvailable))
            foreach ($this->notAvailable as $notAvailable){
                $notAvailables = [];
                if (isset($notAvailable["description"])){
                    $notAvailables["description"] = $notAvailable["description"];
                }
                if (isset($notAvailable["during"]))
                    $notAvailables["during"] = $notAvailable["during"]->toArray();
                $arrayData["notAvailable"][] = $notAvailables;
            }
        if (isset($this->availabilityExceptions))
            $arrayData["availabilityExceptions"] = $this->availabilityExceptions;
        
        if (isset($this->endpoint))
            foreach ($this->endpoint as $endpoint)
                $arrayData["endpoint"][] = $endpoint->toArray();
        return $arrayData;
    }
}