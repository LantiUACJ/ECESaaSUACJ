<?php
namespace App\Fhir\Element;

class Extension extends Element{
    public function __construct(){
        parent::__construct();
    }

    public function loadData($json){
        if(isset($json->url)){
            $this->url = $json->url;
        }
        if(isset($json->valueBase64Binary)){
            $this->valueBase64Binary = $json->valueBase64Binary;
        }
        if(isset($json->valueBoolean)){
            $this->valueBoolean = $json->valueBoolean;
        }
        if(isset($json->valueCanonical)){
            $this->valueCanonical = $json->valueCanonical;
        }
        if(isset($json->valueCode)){
            $this->valueCode = $json->valueCode;
        }
        if(isset($json->valueDate)){
            $this->valueDate = $json->valueDate;
        }
        if(isset($json->valueDateTime)){
            $this->valueDateTime = $json->valueDateTime;
        }
        if(isset($json->valueDecimal)){
            $this->valueDecimal = $json->valueDecimal;
        }
        if(isset($json->valueId)){
            $this->valueId = $json->valueId;
        }
        if(isset($json->valueInstant)){
            $this->valueInstant = $json->valueInstant;
        }
        if(isset($json->valueInteger)){
            $this->valueInteger = $json->valueInteger;
        }
        if(isset($json->valueMarkdown)){
            $this->valueMarkdown = $json->valueMarkdown;
        }
        if(isset($json->valueOid)){
            $this->valueOid = $json->valueOid;
        }
        if(isset($json->valuePositiveInt)){
            $this->valuePositiveInt = $json->valuePositiveInt;
        }
        if(isset($json->valueString)){
            $this->valueString = $json->valueString;
        }
        if(isset($json->valueTime)){
            $this->valueTime = $json->valueTime;
        }
        if(isset($json->valueUnsignedInt)){
            $this->valueUnsignedInt = $json->valueUnsignedInt;
        }
        if(isset($json->valueUri)){
            $this->valueUri = $json->valueUri;
        }
        if(isset($json->valueUrl)){
            $this->valueUrl = $json->valueUrl;
        }
        if(isset($json->valueUuid)){
            $this->valueUuid = $json->valueUuid;
        }
        if(isset($json->valueAddress)){
            $this->valueAddress = Address::Load($json->valueAddress);
        }
        if(isset($json->valueAge)){
            $this->valueAge = Quantity::Load($json->valueAge);
        }
        if(isset($json->valueAnnotation)){
            $this->valueAnnotation = Annotation::Load($json->valueAnnotation);
        }
        if(isset($json->valueAttachment)){
            $this->valueAttachment = Attachment::Load($json->valueAttachment);
        }
        if(isset($json->valueCodeableConcept)){
            $this->valueCodeableConcept = CodeableConcept::Load($json->valueCodeableConcept);
        }
        if(isset($json->valueCoding)){
            $this->valueCoding = Coding::Load($json->valueCoding);
        }
        if(isset($json->valueContactPoint)){
            $this->valueContactPoint = ContactPoint::Load($json->valueContactPoint);
        }
        if(isset($json->valueCount)){
            $this->valueCount = Quantity::Load($json->valueCount);
        }
        if(isset($json->valueDistance)){
            $this->valueDistance = Quantity::Load($json->valueDistance);
        }
        if(isset($json->valueDuration)){
            $this->valueDuration = Quantity::Load($json->valueDuration);
        }
        if(isset($json->valueHumanName)){
            $this->valueHumanName = HumanName::Load($json->valueHumanName);
        }
        if(isset($json->valueIdentifier)){
            $this->valueIdentifier = Identifier::Load($json->valueIdentifier);
        }
        if(isset($json->valueMoney)){
            $this->valueMoney = Quantity::Load($json->valueMoney);
        }
        if(isset($json->valuePeriod)){
            $this->valuePeriod = Period::Load($json->valuePeriod);
        }
        if(isset($json->valueQuantity)){
            $this->valueQuantity = Quantity::Load( $json->valueQuantity);
        }
        if(isset($json->valueRange)){
            $this->valueRange = Range::Load($json->valueRange);
        }
        if(isset($json->valueRatio)){
            $this->valueRatio = Ratio::Load($json->valueRatio);
        }
        if(isset($json->valueReference)){
            $this->valueReference = Reference::Load($json->valueReference);
        }
        if(isset($json->valueSampledData)){
            $this->valueSampledData = SampleData::Load($json->valueSampledData);
        }
        if(isset($json->valueSignature)){
            //$this->valueSignature = $json->valueSignature
        }
        if(isset($json->valueTiming)){
            $this->valueTiming = Timing::Load($json->valueTiming);
        }
        if(isset($json->valueContactDetail)){
            $this->valueContactDetail = ContactDetail::Load($json->valueContactDetail);
        }
        if(isset($json->valueContributor)){
            $this->valueContributor = Contributor::Load($json->valueContributor);
        }
        if(isset($json->valueDataRequirement)){
            //$this->valueDataRequiremen = $json->valueDataRequirement->toArray();
        }
        if(isset($json->valueExpression)){
            $this->valueExpression = Expression::Load($json->valueExpression);
    }
        if(isset($json->valueParameterDefinition)){
            //$this->valueParameterDefin = $json->valueParameterDefinition->toArray();
        }
        if(isset($json->valueRelatedArtifact)){
            //$this->valueRelatedArtifac = $json->valueRelatedArtifact->toArray();
        }
        if(isset($json->valueTriggerDefinition)){
            //$this->valueTriggerDefinit = $json->valueTriggerDefinition->toArray();
        }
        if(isset($json->valueUsageContext)){
            //$this->valueUsageContext = $json->valueUsageContext->toArray();
        }
        if(isset($json->valueDosage)){
            $this->valueDosage = Dosage::Load($json->valueDosage);
        }
        if(isset($json->valueMeta)){
            $this->valueMeta = Meta::Load($json->valueMeta);
        }
    }

    public static function Load($json){
        $extension = new Extension();
        $extension->loadData($json);
        return $extension;
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
    public function setValueAge(Quantity $valueAge){
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
    public function setValueCount(Quantity $valueCount){
        $this->valueCount = $valueCount;
    }
    public function setValueDistance(Quantity $valueDistance){
        $this->valueDistance = $valueDistance;
    }
    public function setValueDuration(Quantity $valueDuration){
        $this->valueDuration = $valueDuration;
    }
    public function setValueHumanName(HumanName $valueHumanName){
        $this->valueHumanName = $valueHumanName;
    }
    public function setValueIdentifier(Identifier $valueIdentifier){
        $this->valueIdentifier = $valueIdentifier;
    }
    public function setValueMoney(Quantity $valueMoney){
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
    /*
    public function setValueSampledData(SampledData $valueSampledData){
        $this->valueSampledData = $valueSampledData;
    }
    public function setValueSignature(Signature $valueSignature){
        $this->valueSignature = $valueSignature;
    }*/
    public function setValueTiming(Timing $valueTiming){
        $this->valueTiming = $valueTiming;
    }
    public function setValueContactDetail(ContactDetail $valueContactDetail){
        $this->valueContactDetail = $valueContactDetail;
    }
    public function setValueContributor(Contributor $valueContributor){
        $this->valueContributor = $valueContributor;
    }/*
    public function setValueDataRequirement(DataRequirement $valueDataRequirement){
        $this->valueDataRequiremen = $valueDataRequirement;
    }*/
    public function setValueExpression(Expression $valueExpression){
        $this->valueExpression = $valueExpression;
    }/*
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
    }*/
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