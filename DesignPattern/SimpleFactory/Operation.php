<?php


/**
 * Operation运算类(封装)
 */
class Operation
{
    private $_numberA = 0;
    private $_numberB = 0;

    public function getNumberA() :float
    {
        return $this->_numberA;
    }

    public function setNumberA(float $numberA)
    {
        $this->_numberA = $numberA;
    }

    public function getNumberB() :float
    {
        return $this->_numberB;
    }

    public function setNumberB(float $numberB)
    {
        $this->_numberB = $numberB;
    }

    /**
     * 获取结果
     *
     * @return float
     */
    public function  getResult() :float
    {
        return 0;
    }
}