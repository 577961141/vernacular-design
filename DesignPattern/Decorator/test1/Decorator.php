<?php

class Decorator implements Component
{
    /**
     * @var Component
     */
    protected $component;

    public function SetComponent(Component $component)
    {
        $this->component = $component;
    }

    public function Operation()
    {
        if ($this->component != null) {
            $this->component->Operation();
        }
    }
}