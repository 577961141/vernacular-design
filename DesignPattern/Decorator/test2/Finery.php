<?php

class Finery extends Person
{
    /**
     * @var Person
     */
    private $component;

    public function Decorate(Person $component)
    {
        $this->component = $component;
    }

    public function show()
    {
        if ($this->component != null) {
            $this->component->show();
        }
    }

}