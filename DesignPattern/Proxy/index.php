<?php
$jiaojiao = new SchoolGirl();
$jiaojiao->setName("李娇娇");

$daili = new Proxy($jiaojiao);

$daili->GiveDolls();
$daili->GiveFlowers();
$daili->GiveChocolate();