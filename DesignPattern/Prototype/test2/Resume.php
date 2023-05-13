<?php
require 'WorkExperience.php';

class Resume
{
    /**
     * @var string
     */
    private  $name;

    /**
     * @var string
     */
    private  $sex;

    /**
     * @var string
     */
    private  $age;

    /**
     * @var WorkExperience
     */
    private $work;

    public function __construct(string $name, WorkExperience $work = null)
    {
        $this->name = $name;
        if ($work == null) {
            $this->work = new WorkExperience();
        } else {
            $this->work = $work->cloneObject();
        }

    }

    public function setPersonalInfo(string $sex, string $age)
    {
        $this->sex = $sex;
        $this->age = $age;
    }

    public function setWorkExperience(string $workData, string $company)
    {
        $this->work->setWorkData($workData);
        $this->work->setCompany($company);
    }

    public function display()
    {
        echo $this->name.' '.$this->sex.' '.$this->age."<br/>";
        echo '工作经历:'.$this->work->getWorkData().' '.$this->work->getCompany()."<br/>";
    }

    public function cloneObject()
    {
        $obj = new Resume($this->name, $this->work);
        $obj->sex = $this->sex;
        $obj->age = $this->age;
        return $obj;
    }
}