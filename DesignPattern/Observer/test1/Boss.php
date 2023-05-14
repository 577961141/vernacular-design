<?php

class Boss implements Subject
{
    /**
     * @var array 同事列表
     */
    private $observers = [];

    /**
     * @var string
     */
    private $action;

    public function Attach(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    public function Detach(Observer $observer)
    {
        // 自己些去除方法
        $index = array_search($observer,  $this->observers[]);
        unset($this->observers[$index]);
    }

    public function Notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    public function SetSubjectState(string $action)
    {
        $this->action = $action;
    }

    public function getSubjectState(): string
    {
        return $this->action;
    }
}