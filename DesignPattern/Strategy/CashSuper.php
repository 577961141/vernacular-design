<?php

/**
 * 现金收费抽象类
 */
abstract class CashSuper
{
    /**
     * 现金收取超类的抽象方法，收取现金，参数为原价，返回为当前价
     *
     * @param float $money
     * @return mixed
     */
    public abstract  function acceptCash(float $money);
}