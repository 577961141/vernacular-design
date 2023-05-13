<?php

class Person
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name = '')
    {
        $this->name = $name;
    }

    public function show()
    {
        echo "装扮的".$this->name.PHP_EOL;
    }

}