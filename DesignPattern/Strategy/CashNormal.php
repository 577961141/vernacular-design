<?php

/**
 * 正常收费子类
 */
class CashNormal extends CashSuper
{
    /**
     * 正常收费，原价返回
     *
     * @param float $money
     * @return float
     */
    public function acceptCash(float $money): float
    {
        return $money;
    }
}