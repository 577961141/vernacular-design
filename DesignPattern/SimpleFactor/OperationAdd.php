<?php
include_once './Operation.php';

/**
 * 加法（继承和多态）
 */
class OperationAdd extends Operation
{
    /**
     * 获取结果类
     *
     * @return float
     */
    public function  getResult() :float
    {
        return $this->getNumberA()+$this->getNumberB();
    }
}