<?php
require_once "./Element.php";

abstract class DataElement extends Element
{
    /**
     * Nombre del campo en el formulario
     *
     * @var string
     */
    protected $name;


    public function __construct(string $name, string $type, string $id = '', string $cssClass  = '', string $style = '')
    {
        $this->name = $name;
        parent::__construct($type, $id, $cssClass, $style);
    }

    /**
     * Set the value of name
     *
     * @param string $name
     * @return self
     */
    public function setName(string $name): Element
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Protección ante hackeos del campo del POST
     *
     * @return mixed
     */
    protected function sanitizeInput() {
        if (isset($_POST[$this->name])){
            $_POST[$this->name] =  $this->sanitize($_POST[$this->name]);
            return $_POST[$this->name];
        }
        return "";
    }

    /**
     * Protección básica ante hackeos
     *
     * @return mixed
     */
    protected function sanitize($data) {
        if (isset($data)){
        return htmlspecialchars(stripslashes(trim($data)));
        }
        return "";
    }

}