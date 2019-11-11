<?php
require_once "./DataElement.php";

class ButtonElement extends DataElement
{
    /**
     * Texto del botón
     *
     * @var string
     */
    private $text;
    
    public function __construct(string $text, string $name, string $id = '', string $cssClass  = '', string $style = '')
	{
        $this->text = $text;
        parent::__construct($name, 'button', $id, $cssClass, $style);
    }

    public function render(): string
    {
       return 
            "<button type='submit'" . 
            (!empty($this->name) ? " name='$this->name' " : '') .
            (!empty($this->id) ? " id='$this->id' " : '') .
            (!empty($this->cssClass) ? " class='$this->cssClass' " : '') .
            (!empty($this->style) ? " style='$this->style' " : '') .
            ">{$this->text}</button>";  
    }
}