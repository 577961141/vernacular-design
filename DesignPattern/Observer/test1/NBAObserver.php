<?php

class NBAObserver extends Observer
{
    public function update()
    {
        // TODO: Implement update() method.
        echo $this->sub->getSubjectState().' '.$this->name.'关闭DBA直播，继续工作';
    }
}