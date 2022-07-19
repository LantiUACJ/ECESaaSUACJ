<?php

namespace App\Fhir\Exception;

class TextNotDefinedException extends \Exception{

    public function __construct($var, $textos) {
        parent::__construct("El texto introducido para $var no ha se encuentrado en la lista de textos aceptados. Utilice: $textos", 1, null);
    }
}