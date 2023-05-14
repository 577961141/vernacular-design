<?php

/**
 * 下午工作状态
 */
class AfterNoonState extends State
{

    public function WriteProgram(Work $work)
    {
        if ($work->getHour() < 17) {
            echo "当前时间：".$work->getHour().'点，下午工作状态还不错，继续努力'.'\n';
        } else {
            $work->setState(new EveningState());
            $work->WriteProgram();
        }
    }
}