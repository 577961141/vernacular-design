<?php

/**
 * 傍晚的工作状态
 */
class EveningState extends State
{
    public function WriteProgram(Work $work)
    {
        if ($work->isTaskFinished()) {
            $work->setState(new ResetState());
            $work->WriteProgram();
        } else {
            if ($work->getHour() < 21) {
                echo "当前时间：".$work->getHour().'点，加班哦，疲累至极'.'\n';
            } else {
                $work->setState(new SleepingState());
                $work->WriteProgram();
            }
        }


    }
}