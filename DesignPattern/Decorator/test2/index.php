<?php
$xc = new Person("小菜");
echo "第一种装扮".PHP_EOL;


$pqx = new Sneakers();
$kk = new BigTrouser();
$dtx = new TShirts();

$pqx->Decorate($xc);
$kk->Decorate($pqx);
$dtx->Decorate($kk);
$dtx->Show();

// 输出

//第一种装扮：
//大T
//垮裤
//运动鞋
//装扮的小菜
