<?php

namespace App\Fhir\Exception;

class IncompatibleTypeException extends \Exception{

    public function __construct() {
        parent::__construct("El tipo que se utiliza es incompatible", "ERR 001", null);
    }
}