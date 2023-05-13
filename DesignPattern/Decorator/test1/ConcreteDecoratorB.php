<?php

class ConcreteDecoratorB extends Decorator
{

    public function Operation()
    {
        parent::Operation();
        $this->AddedBehavior();
        echo "具体装饰对象B的操作" . PHP_EOL;
    }

    private function AddedBehavior() {

    }
}