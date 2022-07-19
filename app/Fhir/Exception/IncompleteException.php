<?php

namespace App\Fhir\Exception;

class IncompleteException extends \Exception{

    public function __construct() {
        parent::__construct("No se han satisfecho los parámetros mínimos.", "ERR 002", null);
    }
}