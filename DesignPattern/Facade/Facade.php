<?php

class Facade
{
    /**
     * @var SubSystemOne
     */
    private $subSystemOne;

    /**
     * @var SubSystemTwo
     */
    private $subSystemTwo;
    /**
     * @var SubSystemThree
     */
    private $subSystemThree;
    /**
     * @var SubSystemFour
     */
    private $subSystemFour;

    public function __construct()
    {
        $this->subSystemOne = new SubSystemOne();
        $this->subSystemTwo = new SubSystemTwo();
        $this->subSystemThree = new SubSystemThree();
        $this->subSystemFour = new SubSystemFour();
    }

    public function MethodA()
    {
        echo '执行方法组A'.'\n';
        $this->subSystemOne->MethodOne();
        $this->subSystemTwo->MethodTwo();
        $this->subSystemThree->MethodThree();
    }

    public function MethodB()
    {
        echo '执行方法组B'.'\n';
        $this->subSystemTwo->MethodTwo();
        $this->subSystemFour->MethodFour();
    }
}