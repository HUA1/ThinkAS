<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/20
 * Time: 上午11:20
 */
namespace app\admin\controller;

use app\admin\model\AdminMenu;
use app\common\controller\AsController;
use app\common\controller\TokenController;
use app\user\model\User;
use think\Cookie;
use think\Session;

class IndexController extends AsController{
    public function index(){
        //读取cookie
        $apiKey = Cookie::get('apiKey');
        $uid = Session::get($apiKey);
        $adminMenu = new AdminMenu();
        $leftMenu = $adminMenu->getMenu();
        $this->assign('leftMenu',json_encode($leftMenu));
        return view();
    }
    public function login(){
        return view();
    }
    public function doLogin(){
        $userDetail = request()->param();
        $user = new User();
        $res = $user->login($userDetail,false);
        if($res['code'] == 200){
            //获取apikey
            $tokenManager = new TokenController();
            $apiKey = $tokenManager->getApiKey();
            //设置cookie
            Cookie::set('apiKey',$apiKey);
            //设置session
            Session::set($apiKey,$res['data']['uid']);
            $this->success('登录成功', url('admin/Index/index'));
        }else{
            //登录失败
            $this->error('登录失败');
        }
    }
}