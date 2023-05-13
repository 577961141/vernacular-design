<?php

class Pursuit implements IGiveGift
{

    /**
     * @var SchoolGirl
     */
    public $mm;

    public function __construct(SchoolGirl $mm)
    {
        $this->mm = $mm;
    }


    public function GiveDolls()
    {
        echo $this->mm->getName()."送你洋娃娃".PHP_EOL;
    }

    public function GiveFlowers()
    {
        echo $this->mm->getName()."送你鲜花".PHP_EOL;
    }

    public function GiveChocolate()
    {
        echo $this->mm->getName()."送你巧克力".PHP_EOL;
    }
}