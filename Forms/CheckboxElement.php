<?php
require_once "./DataElement.php";

class CheckboxElement extends DataElement
{
    /**
     * Texto de la opción
     *
     * @var string
     */
    private $text;
    
    /**
     * Marcado por defecto?
     *
     * @var bool
     */
    private $checked;


    public function __construct(string $text, bool $checked = false, string $id = '', string $cssClass  = '', string $style = '')
    {
        $this->text = $text;
        $this->checked = $checked;
        parent::__construct('', 'checkbox', $id, $cssClass, $style);
    }

    /**
     * Devuelve true si el campo es un array
     *
     * @return boolean
     */
    private function isInputArray(): bool
    {
        return (substr($this->name, strlen($this->name) - strlen('[]') ) === '[]');
    }

    /**
     * Devuelve el mombre real del campo (sin [])
     *
     * @return string
     */
    private function getRealName(): string
    {
        if ($this->isInputArray())
            return substr($this->name, 0, strlen($this->name) - 2);
        else
            return $this->name;
    }

    /**
     * Si es un array, sanitiza todas las opciones del checkbox
     *
     * @return void
     */
    protected function sanitizeInput() {
        if ($this->isInputArray()) {
            $realName = $this->getRealName();
            if (!empty($_POST[$realName])){
                foreach ($_POST[$realName] as $key => $data){
                    $_POST[$realName][$key] = $this->sanitize($data);
                }
                return $_POST[$realName];
            }
        } else {
            return parent::sanitizeInput();
        }
        return "";
    }
    
    /**
     * Comprueba si un checkbox ha sido seleccionado por el usuario.
     * En el caso de que sea un array, comprueba si alguna opción lo está.
     *
     * @return boolean
     */
    public function isChecked(): bool
    {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if ($this->isInputArray()) {
                $realName =  $this->getRealName();
                if (!empty($_POST[$realName])) {
                    foreach ($_POST[$realName] as $chkval) {	
                        if ($chkval == $this->defaultValue) {
                            return true;
                        }
                    }
                }
            } else if (isset($_POST[$this->name])) {
                return ($_POST[$this->name] == $this->defaultValue);
            }
        } else {
            return $this->checked;
        }
        return false;
    }

    /**
     * Genera el HTML del elemento
     *
     * @return string
     */
    public function render(): string
    {
        $this->setPostValue();
        $html = "<input type='checkbox' name='{$this->name}' " ;
        $html .= " value='{$this->defaultValue}'";
        $html .= $this->renderAttributes();
        $html .= ($this->isChecked() ? ' checked' : '');
        $html .= '>' . $this->text;
        return $html;
    }

}