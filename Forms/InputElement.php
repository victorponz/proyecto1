<?php
require_once "./DataElement.php";

class InputElement extends DataElement
{
    
    public function __construct(string $name, string $type, string $id = '', string $cssClass  = '', string $style = '')
    {
        parent::__construct($name, $type, $id, $cssClass, $style);
    }

    /**
     * Genera el HTML del elemento
     *
     * @return string
     */
    public function render(): string
    {
        $html = "<input type='{$this->type}' name='{$this->name}'" ; 
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $html .= " value='" . $this->sanitizeInput() . "'";
        }
      	$html .= (!empty($this->id) ? " id='$this->id'" : '');
        $html .= (!empty($this->cssClass) ? " class='$this->cssClass'" : '');
        $html .= (!empty($this->style) ? " style='$this->style'" : '');
        $html .= '>';
        return $html;
    }

}