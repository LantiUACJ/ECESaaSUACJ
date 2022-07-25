<?php 
namespace App\Fhir\Resource;

class ResourceBuilder{
    public static function make($resource){
        switch($resource->resourceType){
            case "AllergyIntolerance":
                return new AllergyIntolerance($resource);
            break;
            case "CarePlan":
                return new CarePlan($resource);
            break;
            case "Bundle":
                return new Bundle($resource);
            break;
            case "Composition":
                return new Composition($resource);
            break;
            case "Condition":
                return new Condition($resource);
            break;
            case "DiagnosticReport":
                return new DiagnosticReport($resource);
            break;
            case "Encounter":
                return new Encounter($resource);
            break;
            case "ImagingStudy":
                return new ImagingStudy($resource);
            break;
            case "Location":
                return new Location($resource);
            break;
            case "Medication":
                return new Medication($resource);
            break;
            case "MedicationAdministration":
                return new MedicationAdministration($resource);
            break;
            case "Observation":
                return new Observation($resource);
            break;
            case "Organization":
                return new Organization($resource);
            break;
            case "Patient":
                return new Patient($resource);
            break;
            case "Practitioner":
                return new Practitioner($resource);
            break;
            case "PractitionerRole":
                return new PractitionerRole($resource);
            break;
            case "Procedure":
                return new Procedure($resource);
            break;
            default:
                return new Resource($resource);
            break;
        }
    }
}