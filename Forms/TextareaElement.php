<?php
include_once "./DataElement.php";

class TextareaElement extends DataElement
{
    public function __construct(string $name, string $id = '', string $cssClass  = '', string $style = '')
	{
       parent::__construct($name, 'textarea', $id, $cssClass, $style);
    }

    public function render(): string
    {
        $html = "<textarea name='{$this->name}'";
        $html .= $this->renderAttributes();
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            $html .= '>' . $this->sanitizeInput();
        } else {
            $html .= ">{$this->defaultValue}";
        }
        $html .= '</textarea>';

       return $html;
    
    }
}