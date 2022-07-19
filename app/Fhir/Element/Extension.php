<?php
namespace App\Fhir\Element;
class Extension extends Element{
    public function __construct(){
        parent::__construct();
    }

    public function setUrl($url){
        $this->url = $url;
    }
    public function setValueBase64Binary($valueBase64Binary){
        $this->valueBase64Binary = $valueBase64Binary;
    }
    public function setValueBoolean($valueBoolean){
        $this->valueBoolean = $valueBoolean;
    }
    public function setValueCanonical($valueCanonical){
        $this->valueCanonical = $valueCanonical;
    }
    public function setValueCode($valueCode){
        $this->valueCode = $valueCode;
    }
    public function setValueDate($valueDate){
        $this->valueDate = $valueDate;
    }
    public function setValueDateTime($valueDateTime){
        $this->valueDateTime = $valueDateTime;
    }
    public function setValueDecimal($valueDecimal){
        $this->valueDecimal = $valueDecimal;
    }
    public function setValueId($valueId){
        $this->valueId = $valueId;
    }
    public function setValueInstant($valueInstant){
        $this->valueInstant = $valueInstant;
    }
    public function setValueInteger($valueInteger){
        $this->valueInteger = $valueInteger;
    }
    public function setValueMarkdown($valueMarkdown){
        $this->valueMarkdown = $valueMarkdown;
    }
    public function setValueOid($valueOid){
        $this->valueOid = $valueOid;
    }
    public function setValuePositiveInt($valuePositiveInt){
        $this->valuePositiveInt = $valuePositiveInt;
    }
    public function setValueString($valueString){
        $this->valueString = $valueString;
    }
    public function setValueTime($valueTime){
        $this->valueTime = $valueTime;
    }
    public function setValueUnsignedInt($valueUnsignedInt){
        $this->valueUnsignedInt = $valueUnsignedInt;
    }
    public function setValueUri($valueUri){
        $this->valueUri = $valueUri;
    }
    public function setValueUrl($valueUrl){
        $this->valueUrl = $valueUrl;
    }
    public function setValueUuid($valueUuid){
        $this->valueUuid = $valueUuid;
    }
    public function setValueAddress(Address $valueAddress){
        $this->valueAddress = $valueAddress;
    }
    public function setValueAge(Age $valueAge){
        $this->valueAge = $valueAge;
    }
    public function setValueAnnotation(Annotation $valueAnnotation){
        $this->valueAnnotation = $valueAnnotation;
    }
    public function setValueAttachment(Attachment $valueAttachment){
        $this->valueAttachment = $valueAttachment;
    }
    public function setValueCodeableConcept(CodeableConcept $valueCodeableConcept){
        $this->valueCodeableConcept = $valueCodeableConcept;
    }
    public function setValueCoding(Coding $valueCoding){
        $this->valueCoding = $valueCoding;
    }
    public function setValueContactPoint(ContactPoint $valueContactPoint){
        $this->valueContactPoint = $valueContactPoint;
    }
    public function setValueCount(Count $valueCount){
        $this->valueCount = $valueCount;
    }
    public function setValueDistance(Distance $valueDistance){
        $this->valueDistance = $valueDistance;
    }
    public function setValueDuration(Duration $valueDuration){
        $this->valueDuration = $valueDuration;
    }
    public function setValueHumanName(HumanName $valueHumanName){
        $this->valueHumanName = $valueHumanName;
    }
    public function setValueIdentifier(Identifier $valueIdentifier){
        $this->valueIdentifier = $valueIdentifier;
    }
    public function setValueMoney(Money $valueMoney){
        $this->valueMoney = $valueMoney;
    }
    public function setValuePeriod(Period $valuePeriod){
        $this->valuePeriod = $valuePeriod;
    }
    public function setValueQuantity(Quantity $valueQuantity){
        $this->valueQuantity = $valueQuantity;
    }
    public function setValueRange(Range $valueRange){
        $this->valueRange = $valueRange;
    }
    public function setValueRatio(Ratio $valueRatio){
        $this->valueRatio = $valueRatio;
    }
    public function setValueReference(Reference $valueReference){
        $this->valueReference = $valueReference;
    }
    public function setValueSampledData(SampledData $valueSampledData){
        $this->valueSampledData = $valueSampledData;
    }
    public function setValueSignature(Signature $valueSignature){
        $this->valueSignature = $valueSignature;
    }
    public function setValueTiming(Timing $valueTiming){
        $this->valueTiming = $valueTiming;
    }
    public function setValueContactDetail(ContactDetail $valueContactDetail){
        $this->valueContactDetail = $valueContactDetail;
    }
    public function setValueContributor(Contributor $valueContributor){
        $this->valueContributor = $valueContributor;
    }
    public function setValueDataRequirement(DataRequirement $valueDataRequirement){
        $this->valueDataRequiremen = $valueDataRequirement;
    }
    public function setValueExpression(Expression $valueExpression){
        $this->valueExpression = $valueExpression;
    }
    public function setValueParameterDefinition(ParameterDefinition $valueParameterDefinition){
        $this->valueParameterDefin = $valueParameterDefinition;
    }
    public function setValueRelatedArtifact(RelatedArtifact $valueRelatedArtifact){
        $this->valueRelatedArtifac = $valueRelatedArtifact;
    }
    public function setValueTriggerDefinition(TriggerDefinition $valueTriggerDefinition){
        $this->valueTriggerDefinit = $valueTriggerDefinition;
    }
    public function setValueUsageContext(UsageContext $valueUsageContext){
        $this->valueUsageContext = $valueUsageContext;
    }
    public function setValueDosage(Dosage $valueDosage){
        $this->valueDosage = $valueDosage;
    }
    public function setValueMeta(Meta $valueMeta){
        $this->valueMeta = $valueMeta;
    }

    public function toArray(){
        $arrayData = parent::toArray();
        if(isset($this->url)){
            $arrayData["url"] = $this->url;
        }
        if(isset($this->valueBase64Binary)){
            $arrayData["valueBase64Binary"] = $this->valueBase64Binary;
        }
        if(isset($this->valueBoolean)){
            $arrayData["valueBoolean"] = $this->valueBoolean;
        }
        if(isset($this->valueCanonical)){
            $arrayData["valueCanonical"] = $this->valueCanonical;
        }
        if(isset($this->valueCode)){
            $arrayData["valueCode"] = $this->valueCode;
        }
        if(isset($this->valueDate)){
            $arrayData["valueDate"] = $this->valueDate;
        }
        if(isset($this->valueDateTime)){
            $arrayData["valueDateTime"] = $this->valueDateTime;
        }
        if(isset($this->valueDecimal)){
            $arrayData["valueDecimal"] = $this->valueDecimal;
        }
        if(isset($this->valueId)){
            $arrayData["valueId"] = $this->valueId;
        }
        if(isset($this->valueInstant)){
            $arrayData["valueInstant"] = $this->valueInstant;
        }
        if(isset($this->valueInteger)){
            $arrayData["valueInteger"] = $this->valueInteger;
        }
        if(isset($this->valueMarkdown)){
            $arrayData["valueMarkdown"] = $this->valueMarkdown;
        }
        if(isset($this->valueOid)){
            $arrayData["valueOid"] = $this->valueOid;
        }
        if(isset($this->valuePositiveInt)){
            $arrayData["valuePositiveInt"] = $this->valuePositiveInt;
        }
        if(isset($this->valueString)){
            $arrayData["valueString"] = $this->valueString;
        }
        if(isset($this->valueTime)){
            $arrayData["valueTime"] = $this->valueTime;
        }
        if(isset($this->valueUnsignedInt)){
            $arrayData["valueUnsignedInt"] = $this->valueUnsignedInt;
        }
        if(isset($this->valueUri)){
            $arrayData["valueUri"] = $this->valueUri;
        }
        if(isset($this->valueUrl)){
            $arrayData["valueUrl"] = $this->valueUrl;
        }
        if(isset($this->valueUuid)){
            $arrayData["valueUuid"] = $this->valueUuid;
        }
        if(isset($this->valueAddress)){
            $arrayData["valueAddress"] = $this->valueAddress->toArray();
        }
        if(isset($this->valueAge)){
            $arrayData["valueAge"] = $this->valueAge->toArray();
        }
        if(isset($this->valueAnnotation)){
            $arrayData["valueAnnotation"] = $this->valueAnnotation->toArray();
        }
        if(isset($this->valueAttachment)){
            $arrayData["valueAttachment"] = $this->valueAttachment->toArray();
        }
        if(isset($this->valueCodeableConcept)){
            $arrayData["valueCodeableConcept"] = $this->valueCodeableConcept->toArray();
        }
        if(isset($this->valueCoding)){
            $arrayData["valueCoding"] = $this->valueCoding->toArray();
        }
        if(isset($this->valueContactPoint)){
            $arrayData["valueContactPoint"] = $this->valueContactPoint->toArray();
        }
        if(isset($this->valueCount)){
            $arrayData["valueCount"] = $this->valueCount->toArray();
        }
        if(isset($this->valueDistance)){
            $arrayData["valueDistance"] = $this->valueDistance->toArray();
        }
        if(isset($this->valueDuration)){
            $arrayData["valueDuration"] = $this->valueDuration->toArray();
        }
        if(isset($this->valueHumanName)){
            $arrayData["valueHumanName"] = $this->valueHumanName->toArray();
        }
        if(isset($this->valueIdentifier)){
            $arrayData["valueIdentifier"] = $this->valueIdentifier->toArray();
        }
        if(isset($this->valueMoney)){
            $arrayData["valueMoney"] = $this->valueMoney->toArray();
        }
        if(isset($this->valuePeriod)){
            $arrayData["valuePeriod"] = $this->valuePeriod->toArray();
        }
        if(isset($this->valueQuantity)){
            $arrayData["valueQuantity"] = $this->valueQuantity->toArray();
        }
        if(isset($this->valueRange)){
            $arrayData["valueRange"] = $this->valueRange->toArray();
        }
        if(isset($this->valueRatio)){
            $arrayData["valueRatio"] = $this->valueRatio->toArray();
        }
        if(isset($this->valueReference)){
            $arrayData["valueReference"] = $this->valueReference->toArray();
        }
        if(isset($this->valueSampledData)){
            $arrayData["valueSampledData"] = $this->valueSampledData->toArray();
        }
        if(isset($this->valueSignature)){
            $arrayData["valueSignature"] = $this->valueSignature->toArray();
        }
        if(isset($this->valueTiming)){
            $arrayData["valueTiming"] = $this->valueTiming->toArray();
        }
        if(isset($this->valueContactDetail)){
            $arrayData["valueContactDetail"] = $this->valueContactDetail->toArray();
        }
        if(isset($this->valueContributor)){
            $arrayData["valueContributor"] = $this->valueContributor->toArray();
        }
        if(isset($this->valueDataRequirement)){
            $arrayData["valueDataRequiremen"] = $this->valueDataRequirement->toArray();
        }
        if(isset($this->valueExpression)){
            $arrayData["valueExpression"] = $this->valueExpression->toArray();
        }
        if(isset($this->valueParameterDefinition)){
            $arrayData["valueParameterDefin"] = $this->valueParameterDefinition->toArray();
        }
        if(isset($this->valueRelatedArtifact)){
            $arrayData["valueRelatedArtifac"] = $this->valueRelatedArtifact->toArray();
        }
        if(isset($this->valueTriggerDefinition)){
            $arrayData["valueTriggerDefinit"] = $this->valueTriggerDefinition->toArray();
        }
        if(isset($this->valueUsageContext)){
            $arrayData["valueUsageContext"] = $this->valueUsageContext->toArray();
        }
        if(isset($this->valueDosage)){
            $arrayData["valueDosage"] = $this->valueDosage->toArray();
        }
        if(isset($this->valueMeta)){
            $arrayData["valueMeta"] = $this->valueMeta->toArray();
        }
        return $arrayData;
    }
}