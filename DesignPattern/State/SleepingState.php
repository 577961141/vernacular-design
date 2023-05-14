<?php

/**
 * 睡眠状态
 */
class SleepingState extends State
{

    public function WriteProgram(Work $work)
    {
        echo "当前时间：".$work->getHour().'点，不行了，睡着了'.'\n';
    }
}