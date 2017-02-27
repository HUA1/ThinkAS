<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/17
 * Time: 下午1:37
 */
namespace app\user\controller;

use app\common\controller\AsController;
use app\common\controller\EncryptController;
use app\user\model;

class UserController extends AsController
{
    /**
     * 用户登录
     * @author   雷丘<188869727@qq.com>
     * @version  1.0
     * @access   public
     * @return   json
     */
    public function login()
    {
        $userDetail = request()->param();
        $user = new model\User();
        $res = $user->login($userDetail);
        return json($res);
    }
    /**
     * 用户注册
     * @author   雷丘<188869727#qq.com>
     * @access public
     * @version  1.0
     * @return   json
     */
    public function register(){
        $userDetail = request()->param();
        $user = new model\User();
        $res = $user->register($userDetail);
        return json($res);
    }
    /**
     * 获取用户信息
     * @author   雷丘<188869727#qq.com>
     * @access public
     * @version  1.0
     * @param integer $uid 用户uid
     * @return   json
     */
    public function getUser($uid)
    {
        $user = new model\User();
        $userDetail = $user->getUser($uid);
        return json($userDetail);
    }
    public function sendCode(){
        $code = getRandChar(4,"number");
    }
    public function getTempApiKey(){
        $apiKey = $this->getApiKey();
        $data['apiKey'] = $this->rsaPrivateKeyEncrypt($apiKey);
        return json($data,200);
    }
}
