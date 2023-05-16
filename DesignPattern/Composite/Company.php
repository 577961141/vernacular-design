<?php

/**
 * 公司类
 */
abstract class Company
{
    /**
     * @var string
     */
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public abstract function Add(Company c);//增加

    public abstract function Remove(Company c);//移除

    public abstract function Display(int depth);//

    public abstract function LineofDuty();//履行职责
}