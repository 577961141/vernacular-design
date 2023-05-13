<?php

/**
 * 打折收费子类
 */
class CashRebate extends CashSuper
{
    private $moneyRebate = 1;

    public function __construct(float $moneyRebate) {
        $this->moneyRebate = $moneyRebate;
    }

    public function acceptCash(float $money): float
    {
        return $money * $this->moneyRebate;
    }
}