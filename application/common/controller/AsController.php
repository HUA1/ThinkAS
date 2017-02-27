<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/18
 * Time: 上午11:53
 */
namespace app\common\controller;

use think\Config;
use think\Controller;
use think\Cookie;
use think\Session;

class AsController extends Controller{
    public $pi_key;
    public $pu_key;
    public $uid;
    public $userGroup;
    public $userGroupRole;
    public $thisUserToken;
    /**
     * 架构函数
     * @access public
     * @param array|object $data 数据
     */
    public function __construct($data = [])
    {
        parent::__construct();
        $private_key = Config::get('rsa_private_key');
        $public_key = Config::get('rsa_public_key');

        $this->pi_key = openssl_pkey_get_private($private_key);//这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        $this->pu_key = openssl_pkey_get_public($public_key);//这个函数可用来判断公钥是否是可用的

        if($this->pi_key == false || $this->pu_key == false){
            $this->error('RSA秘钥未设置或设置错误');
        }
        if(Cookie::get('apiKey')){
            $apiKey = Cookie::get('apiKey');
            $this->uid = Session::get($apiKey);
        }else if($this->thisUserToken = request()->header('token')){
            //$this->error('合法请求');
        }else{
            //非法请求
            //$this->error('非法请求');
        }
    }

}