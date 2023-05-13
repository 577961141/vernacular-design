<?php

class ConcreteComponent implements Component
{
    public function Operation()
    {
        echo "具体对象的操作" . PHP_EOL;
    }
}