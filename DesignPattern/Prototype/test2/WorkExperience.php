<?php

class WorkExperience
{
    /**
     * @var string
     */
    private $workData;

    /**
     * @var string
     */
    private $company;

    /**
     * @return string
     */
    public function getWorkData(): string
    {
        return $this->workData;
    }

    /**
     * @param string $workData
     */
    public function setWorkData(string $workData)
    {
        $this->workData = $workData;
    }

    /**
     * @return string
     */
    public function getCompany(): string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company)
    {
        $this->company = $company;
    }

    public function cloneObject()
    {
        return clone $this;
    }
}