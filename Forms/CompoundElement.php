<?php
require_once "./DataElement.php";

abstract class CompoundElement extends DataElement
{
    /**
     * Hijos del elemento
     *
     * @var array
     */
    private $children;

    public function __construct(string $name, string $type, string $id = '', string $cssClass  = '', string $style = '')
	{
        $this->children = [];
        parent::__construct($name, $type, $id, $cssClass, $style);
    }

    /**
     * @param Element $child
     * @return void
     */
    public function appendChild(Element $child){
        $this->children[] = $child;
        return $this;
    }
    /**
     *
     * @return array
     */
    public function getChildren(): array{
        return $this->children;
    }

    /**
     * Recorre todos los hijos, generando su HTML
     *
     * @return El HTMl de todos los hijos
     */
    protected function renderChildren(): string{
        $html = '';
        foreach ($this->getChildren() as $child) {
            $html .= $child->render();
        }
        return $html;
    }

}