<?php

$c = new ConcreteComponent();
$d1 = new ConcreteDecoratorA();
$d2 = new ConcreteDecoratorB();

$d1->SetComponent($c);
$d2->SetComponent($d1);
$d2->Operation();