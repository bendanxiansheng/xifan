<?php
include '../framework/class/account.class.php';
// load()->class('weixin.account');
// $accObj= new WeixinAccount();
// $access_token = $accObj->fetch_available_token();
// echo $access_token;
load()->classs('weixin.account');
$accObj= WeixinAccount::create($acid);
$access_token = $accObj->fetch_token();
echo $access_token;