<?php
require_once "./Element.php";
require_once "./DataElement.php";

class LabelElement extends Element
{
    /**
     * Texto de la etiqueta
     *
     * @var string
     */
    private $text;
    
    /**
     * Elemento del form al que va asociado la etiqueta
     *
     * @var Element
     */
    private $for;
    
    /**
     * Si es verdadero, renderizamos el elemento asociado en $for
     * @link https://developer.mozilla.org/es/docs/Web/HTML/Elemento/label
     * 
     * @var bool
     */
    private $renderElement;

    public function __construct(string $text, DataElement $for, bool $renderElement = false, string $id = '', string $cssClass  = '', string $style = '')
    {
        $this->text = $text;
        $this->for = $for;
        $this->renderElement = $renderElement;
        parent::__construct('label', $id, $cssClass, $style);
    }
    /**
     * Además de renderizar el label, también renderiza el elemento asociado si $renderElement es true
     *
     * @return string
     */
    public function render(): string
    {
      return 
            "<label " . 
            (!empty($this->for) ? " for='{$this->for->getId()}' " : '') .
            $this->renderAttributes() .
            ">{$this->text}" . ($this->renderElement ? $this->for->render() : '')  . "</label>";
    
    }
}