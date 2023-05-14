<?php

// 老板胡汉三
$huhansan = new Boss();

// 看股票的同事
$tongshi1 = new StockObserver("围观查", $huhansan);
// 看dba的同事
$tongshi2 = new NBAObserver("易观查", $huhansan);

$huhansan->Attach($tongshi1);
$huhansan->Attach($tongshi2);

$huhansan->Detach($tongshi1);

// 看dba的同事
$huhansan->SetSubjectState("我胡汉三回来了");

//发出通知
$huhansan->Notify();