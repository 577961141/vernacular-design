<?php
require 'Resume.php';


$a = new Resume("东方静绪");
$a->setPersonalInfo('男', 29);
$a->setWorkExperience('1998-2000', 'xx公司');

$b = $a->cloneObject();
$b->setPersonalInfo('嫌疑人x', 29);
$b->setWorkExperience('1998-2000', 'yy企业');

$c = $a->cloneObject();
$c->setPersonalInfo('嫌疑人y', 29);
$c->setWorkExperience('1998-2006','zz企业');

$a->display();
$b->display();
$c->display();