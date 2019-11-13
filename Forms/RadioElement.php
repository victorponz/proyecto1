<?php
require_once "./InputElement.php";

class RadioElement extends InputElement
{
    /**
     * Texto de la opción
     *
     * @var string
     */
    private $text;

    /**
     * Seleccionado por defecto?
     *
     * @var bool
     */
    private $checked;

    public function __construct(string $name, string $text, bool $checked = false, string $id = '', string $cssClass  = '', string $style = '')
	{
       $this->text = $text;
       $this->checked = $checked;
       parent::__construct($name, 'radio', $id, $cssClass, $style);
    }

    public function isChecked(){
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            return ($this->getValue() == $this->defaultValue);
        } else {
            return $this->checked;
        }
	}

    /**
     * Genera el HTML del elemento
     *
     * @return string
     */
    public function render(): string
    {
        $this->setPostValue();
        $html = "<input type='radio' name='{$this->name}' " ;
        $html .= " value='{$this->defaultValue}'";
        $html .= $this->renderAttributes(); 
        $html .= ($this->isChecked() ? ' checked' : '');
        $html .= '>' . $this->text;
        return $html;
    }


}