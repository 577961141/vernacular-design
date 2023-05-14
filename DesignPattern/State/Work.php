<?php

class Work
{
    /**
     * @var int
     */
    private $hour;

    /**
     * @var State
     */
    private $state;

    /**
     * @var bool
     */
    private $taskFinished;

    public function __construct()
    {
        $this->state = new ForenoonState();
    }

    /**
     * @return int
     */
    public function getHour(): int
    {
        return $this->hour;
    }

    /**
     * @param int $hour
     */
    public function setHour(int $hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return State
     */
    public function getState(): State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): void
    {
        $this->state = $state;
    }

    /**
     * @return bool
     */
    public function isTaskFinished(): bool
    {
        return $this->taskFinished;
    }

    /**
     * @param bool $taskFinished
     */
    public function setTaskFinished(bool $taskFinished): void
    {
        $this->taskFinished = $taskFinished;
    }

    public function WriteProgram()
    {
        $this->state->WriteProgram($this);
    }
}