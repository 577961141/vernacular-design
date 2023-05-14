<?php

/**
 * 下班休息状态状态
 */
class ResetState extends State
{

    public function WriteProgram(Work $work)
    {
        echo "当前时间：".$work->getHour().'点，下班回家了'.'\n';
    }
}