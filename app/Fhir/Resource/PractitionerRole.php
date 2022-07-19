<?php 

namespace App\Fhir\Resource;

use App\Fhir\Element\Annotation;
use App\Fhir\Element\CodeableConcept;
use App\Fhir\Element\ContactPoint;
use App\Fhir\Element\Identifier;
use App\Fhir\Element\Period;
use App\Fhir\Element\Quantity;
use App\Fhir\Element\Range;
use App\Fhir\Element\Reference;

class PractitionerRole extends DomainResource{
    public function __construct($json = null){
        parent::__construct($json);
        $this->resourceType = "PractitionerRole";

        $this->identifier = [];
        $this->code = [];
        $this->specialty = [];
        $this->location = [];
        $this->$healthcareService = [];

        if($json) $this->loadData($json);
    }
    private function loadData($json){
        if (isset($obj->identifier))
            foreach ($obj->identifier as $identifier)
                $this->identifier[] = Identifier::Load($identifier);
        if (isset($obj->active))
            $obj->active;
        if (isset($obj->period))
            $this->period = Period::Load($obj->period);
        
        if (isset($obj->practitioner))
            $this->practitioner = Reference::Load($obj->practitioner);
        
        if (isset($obj->organization))
            $this->organization = reference::Load($obj->organization);
        if (isset($obj->code))
            foreach ($obj->code as $code)
                $this->code[] = CodeableConcept::Load($code);
        if (isset($obj->specialty))
            foreach ($obj->specialty as $specialty)
                $this->specialty[] = CodeableConcept::Load($specialty);
        if (isset($obj->location))
            foreach ($obj->location as $location)
                $this->location[] = Reference::Load($location);
        if (isset($obj->healthcareService))
            foreach ($obj->healthcareService as $healthcareService)
                $this->$healthcareService[] = Reference::Load($healthcareService);
        if (isset($obj->telecom))
            foreach ($obj->telecom as $telecom)
                $this->telecom = ContactPoint::Load($telecom);
        if (isset($obj->availableTime))
            foreach ($obj->availableTime as $availableTime)
                if (isset($availableTime->daysOfWeek))
                    foreach ($availableTime->daysOfWeek as $daysOfWeek)
                        $daysOfWeek; // <!-- mon | tue | wed | thu | fri | sat | sun -->
                
                if (isset($availableTime->allDay))
                    $availableTime->allDay;
                
                if (isset($availableTime->availableStartTime))
                    $availableTime->availableStartTime;
                
                if (isset($availableTime->availableEndTime))
                    $availableTime->availableEndTime;
            
        
        if (isset($obj->notAvailable))
            foreach ($obj->notAvailable as $notAvailable)
                if (isset($notAvailable->description))
                    $notAvailable->description;
                
                if (isset($notAvailable->during))
                    period$this->__algo__ = $notAvailable->during;
        
        if (isset($obj->availabilityExceptions))
            $obj->availabilityExceptions;
        
        if (isset($obj->endpoint))
            foreach ($obj->endpoint as $endpoint)
                reference$this->__algo__ = $endpoint;
            
        
    }
}