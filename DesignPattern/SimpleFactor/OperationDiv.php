<?php
include_once './Operation.php';

/**
 * 除法（继承和多态）
 */
class OperationDiv extends Operation
{
    /**
     * 获取结果类
     *
     * @return float
     */
    public function  getResult() :float
    {
        if ($this->getNumberB() == 0) {
            throw new Exception("除数不能为0");
        }

        return $this->getNumberA()/$this->getNumberB();
    }
}