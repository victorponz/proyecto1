<?php
namespace ProyectoWeb\exceptions;

class QueryException extends \Exception{
    public function __construct(string $message){
        parent::__construct($message);
    }
}