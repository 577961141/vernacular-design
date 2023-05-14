<?php

/**
 * 中午的工作状态
 */
class NoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 13) {
            echo "当前时间：".$work->getHour().'点，午饭，午休'.'\n';
        } else {
            $work->setState(new AfterNoonState());
            $work->WriteProgram();
        }
    }
}