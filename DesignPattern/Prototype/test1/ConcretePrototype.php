<?php

/**
 * 具体原型类
 */
class ConcretePrototype extends Prototype
{


    public function cloneObject(): Prototype
    {
        return clone $this;
    }
}