<?php

class Proxy implements IGiveGift
{

    /**
     * @var Pursuit
     */
    public $gg;

    public function __construct(SchoolGirl $mm)
    {
        $this->gg = new Pursuit($mm);
    }


    public function GiveDolls()
    {
        $this->gg->GiveDolls();
    }

    public function GiveFlowers()
    {
        $this->gg->GiveFlowers();
    }

    public function GiveChocolate()
    {
        $this->gg->GiveChocolate();
    }
}