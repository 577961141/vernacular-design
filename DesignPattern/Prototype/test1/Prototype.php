<?php

/**
 * 原型抽象类
 */
abstract class Prototype
{
    /**
     * @var string
     */
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public  abstract function cloneObject();
}