<?php

/**
 * 上午的工作状态
 */
class ForenoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 12) {
            echo "当前时间：".$work->getHour().'点，上午工作，精神百倍'.'\n';
        } else {
            $work->setState(new NoonState());
            $work->WriteProgram();
        }
    }
}