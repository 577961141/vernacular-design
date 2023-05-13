<?php
include_once './Operation.php';
include_once './OperationAdd.php';;
include_once './OperationDiv.php';
include_once './OperationSub.php';
include_once './OperationMul.php';

/**
 * 简单工厂
 */
class OperationFactory
{
    public static function createOperate(string $operate) : Operation
    {
        $oper = null;

        switch ($operate) {
            case '+':
                $oper = new OperationAdd();
                break;
            case '-':
                $oper = new OperationSub();
                break;
            case '*':
                $oper = new OperationMul();
                break;
            case '/':
                $oper = new OperationDiv();
                break;
        }

        return $oper;
    }
}