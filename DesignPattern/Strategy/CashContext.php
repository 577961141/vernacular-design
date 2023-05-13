<?php

/**
 * 现金策略类
 */
class CashContext
{
    private $cs = null;

    public function __construct(string $type)
    {
        switch ($type) {
            case "正常收费":
                $this->cs = new CashNormal();
                break;
            case "满300返200":
                $this->cs = new CashReturn("300", "100");
                break;
            case "打8折":
                $this->cs = new CashRebate(0.8);
                break;
        }
    }

    public function acceptCash(float $money): float
    {
        return $money;
    }
}