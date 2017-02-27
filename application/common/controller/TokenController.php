<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/21
 * Time: 上午11:42
 */
namespace app\common\controller;

class TokenController extends AsController{
    //验证token方法
    public function getApiKey(){
        $apiKey = getRandChar(128,"all");
        return $apiKey;
    }
    //token加密方法
    public function getToken ($uid,$apiKey){
        $nowTime = strtotime(date('Y-m-d H:i'));
        $token = substr(sha1($apiKey.$nowTime),32,32);
        return $token;
    }
}