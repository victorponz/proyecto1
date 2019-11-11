<?php
require_once "./CompoundElement.php";

class FormElement extends CompoundElement
{
    /**
     * @var string
     *      
    **/
    private $action;
    
    /**
     * @var string
     *      
    **/
    private $enctype;
    
    public function __construct(string $action = '', string $enctype = '', string $name = '', string $id = '', string $cssClass  = '', string $style = '')
	{
        $this->action = $action;
        $this->enctype = $enctype;
        parent::__construct($name, 'form', $id, $cssClass, $style);
    }

    public function render(): string
    {
        $html = 
            "<form action='{$this->action}' method='POST'" .
            (!empty($this->enctype) ? " enctype='$this->enctype' " : '') .  
            (!empty($this->id) ? " id='$this->id' " : '') .
            (!empty($this->cssClass) ? " class='$this->cssClass' " : '') .
            (!empty($this->style) ? " style='$this->style' " : '') .
            ">";
            $html .= $this->renderChildren();
            
        $html .= '</form>'; 
        return $html;
    }
}