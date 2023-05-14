<?php

interface Subject
{
    public function Attach(Observer $observer);

    public function Detach(Observer $observer);

    public function Notify();

    public function SetSubjectState(string $action);

    public function getSubjectState() : string;
}