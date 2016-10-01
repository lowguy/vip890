<?php
/**
 * Created by PhpStorm.
 * User: legendFox
 * Date: 2016/10/1 0001
 * Time: 下午 9:38
 */
const VIP_DIR = __DIR__;
const APP_PATH = "\App\\";
require_once VIP_DIR."/Core/Vip.php";
$vip = \Core\Vip::getInstance();
try{
    $vip->run();
}catch (Exception $e){
    echo $e->getCode();
}
