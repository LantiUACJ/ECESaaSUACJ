<?php

namespace App\Fhir\Element;

use App\Fhir\Resource\Resource;

use App\Fhir\Exception\TextNotDefinedException;

class Identifier extends Element{
	private $usecode = ["usual","official","temp","secondary","old"];

	public function __construct($use, $value, CodeableConcept $type = null){
        parent::__construct();
		$this->use = "";
		$this->setUse($use);
		$this->setValue($value);
		if($type) $this->setType($type);
	}

	private function loadData($json){
		if(isset($json->use) && $json->use) $this->setUse($json->use);
		if(isset($json->system)) $this->setSystem($json->system);
		if(isset($json->period)) $this->setPeriod(Period::Load($json->period));
		if(isset($json->assigner)) $this->assigner = Reference::Load($json->assigner);
		if(isset($json->type)) $this->setType( CodeableConcept::Load($json->type));
		if(isset($json->value)) $this->setValue( $json->value);
	}
	public static function Load($json, $check = false){
		$identifier = new Identifier("official","");
		$identifier->use = "";
		$identifier->loadData($json);
		if($check)
			dd($json);
		return $identifier;
	}
	public function setUse($use){
		foreach($this->usecode as $code){
			if(strtolower($use) == $code){
				$this->use = strtolower($use);
			}
		}
		if(!$this->use)
			throw new TextNotDefinedException("USE", implode(", ",$this->usecode));
	}
	public function setSystem($system){
		$this->system = $system;
	}
	public function setPeriod(Period $period){
		$this->period = $period;
	}
	public function setAssigner(Resource $assigner){
		$this->assigner = $assigner->toReference();
	}
	public function setType(CodeableConcept $type){
		$this->type = $type;
	}
	public function setValue($value){
		$this->value = $value;
	}
	public function toArray(){
        $arrayData = parent::toArray();
		
		if(isset($this->use) && $this->use) $arrayData["use"] = $this->use;
		if(isset($this->system)) $arrayData["system"] = $this->system;
		if(isset($this->period)) $arrayData["period"] = $this->period->toArray();
		if(isset($this->assigner)) $arrayData["assigner"] = $this->assigner->toArray();
		if(isset($this->type)) $arrayData["type"] = $this->type->toArray();
		if(isset($this->value)) $arrayData["value"] = $this->value;

		return $arrayData;
	}
}
?>
