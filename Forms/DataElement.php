<?php
require_once "./Element.php";

abstract class DataElement extends Element
{
    /**
     * Nombre del campo en el formulario
     *
     * @var string
     */
    private $name;

    /**
     * Valor del campo
     *
     * @var string
     */
    private $value;
    
    /**
     * Valor por defecto
     *
     */ 
    private $defaultValue;

    /**
     * Bandera para indicar que ya se han fijados los datos del POST
     *
     * @var bool
     */
    private $donePostValue;

    public function __construct(string $name, string $type, string $id = '', string $cssClass  = '', string $style = '') {
        $this->name = $name;
        $this->donePostValue = false;
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
     * Get nombre del campo en el formulario
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get valor del campo
     *
     * @return  string
     */ 
    public function getValue()
    {
        //En algunos casos el navegador no envía el campo del form si éste está vacío
        return ($_POST[$this->getName()] ?? "");
    }
    
    /**
     * Set valor del campo después del post
     *
     * @param  string  $value  Valor del campo después del post
     *
     * @return  self
     */ 
    public function setValue(string $value)
    {
        $this->value = $value;

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


    /**
     * Get the value of defaultValue
     */ 
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Set the value of defaultValue
     *
     * @return  self
     */ 
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * Set valor del campo en el POST
     *
     * @param  string  $value  Valor del campo en el POST
     *
     * @return  self
     */ 
    public function setPostValue()
    {
        //Sólo se debe hacer una vez!
        if (!$this->donePostValue) {
            if ('POST' === $_SERVER['REQUEST_METHOD']) { 
                $this->value = $this->sanitizeInput();
                $this->donePostValue = true;
            }
        }
    
        return $this;
    }

    /**
     * Genera el HTML para los atributos comunes
     *
     * @return string
     */
    protected function renderAttributes(): string
    {
        $html = (!empty($this->name) ? " name='$this->name' " : '');
        $html .= parent::renderAttributes();
        return $html;
    }
}