<?php

class ConcreteDecoratorA extends Decorator
{
    /**
     * @var string
     */
    private $addedState;

    public function Operation()
    {
        parent::Operation();
        $this->addedState = "New state";
        echo "具体装饰对象A的操作" . PHP_EOL;
    }
}