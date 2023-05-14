<?php

class StockObserver extends Observer
{
    public function update()
    {
        // TODO: Implement update() method.
        echo $this->sub->getSubjectState().' '.$this->name.'关闭股票行情，继续工作';
    }
}