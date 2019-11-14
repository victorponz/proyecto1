<?php
require_once __DIR__ . "/Validator.php";

interface IValidator
{
    public function getValidator();

    public function setValidator(Validator $validator);
  
    public function validate();

    public function hasError(): bool;
    
    public function getErrors(): array;
}