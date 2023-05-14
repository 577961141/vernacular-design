<?php

abstract class Observer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var Subject
     */
    protected $sub;

    public function __construct(string $name, Subject $sub)
    {
        $this->name = $name;
        $this->sub = $sub;
    }

    public abstract function update();
}