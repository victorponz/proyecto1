<?php
require_once "./DataElement.php";
require_once "./SelectElement.php";

class OptionElement extends DataElement
{
    /**
     * Campo Select del que depende
     * @var SelectElement
     */
    private $parent;

    /**
     * Texto de la opción
     * @var string
     */
    private $text;

    public function __construct(SelectElement $parent, string $text, string $id = '', string $cssClass  = '', string $style = '')
    {
        $this->parent = $parent;
        $this->text = $text;
        parent::__construct('', 'option', $id, $cssClass, $style);
    }

    private function isSelected(): bool
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            //Puede ser un array si es multiple
            if ($this->parent->isMultiple()) {
                if (!empty($this->parent->getValue())) {
                    foreach ($this->parent->getValue() as $chkval) {	
                        if ($chkval == $this->defaultValue) {
                            return true;
                        }
                    }
                }
            } else {
                return ($this->parent->getValue() == $this->defaultValue);   
            }
        } else {
            if ($this->parent->isMultiple()) {
                if (is_array($this->parent->getDefaultValue())) {
                    return in_array($this->defaultValue, $this->parent->getDefaultValue());
                }
            } else {
                return $this->parent->getDefaultValue() == $this->defaultValue;
            }
        }
        return false;
    }
    
    
    public function render(): string
    {
        $html = '<option ' ;
        $html .= " value='{$this->defaultValue}'";
        $html .= $this->renderAttributes(); 
        $html .= ($this->isSelected() ? " selected" : "");  
        $html .= ">" . $this->text;
        $html .= "</option>";
        return $html;
    }
}