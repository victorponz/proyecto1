<?php
require_once "./CompoundElement.php";

class SelectElement extends CompoundElement
{
    /**
     * Es un select múltiple?
     * @var bool
     */
    private $multiple;
    
    public function __construct(string $name, bool $multiple = false, string $id = '', string $cssClass  = '', string $style = '')
	{
       $this->multiple = $multiple;
       parent::__construct($name, 'select', $id, $cssClass, $style);
    }
    /**
     *
     * @return boolean
     */
    public function isMultiple(): bool
    {
        return ($this->multiple === true);
    }
     /**
     * Protección ante hackeos
     *
     * @return mixed
     */
    public function sanitizeInput() {
       
        if ($this->isMultiple()) {
            //En este caso es un array
            if (!empty($_POST[$this->name])){
                foreach ($_POST[$this->name] as $key => $data){
                    $_POST[$this->name][$key] = htmlspecialchars(stripslashes(trim($data)));
                }
                return $_POST[$this->name];
            }
        }else{
            return parent::sanitizeInput();
        }
        return "";
    }
    
    /**
     * Devuelve los options seleccionados
    *
    * @return array
    */
    public function getSelected(): array{
    $values = [];
    foreach ($this->getChildren() as $child) {
        if ($child->isSelected()) {
            $values[] = $child->getDefaultValue();
        }

    }  
    return $values;
    }

    public function render(): string
    {
        $this->setPostValue();
        //Si es múltiple, hemos de añadir [] para que el valor del POST sea un array
        $html = "<select name='{$this->name}" . ($this->multiple ? '[]' : '') . "'" ;
            $html .= $this->renderAttributes(); 
            $html .= ($this->multiple ? " multiple " : '');
            $html .= ">";
            $html .= $this->renderChildren();
        $html .= '</select>';  
        return $html;
    }
}