<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/17
 * Time: 下午1:37
 */
namespace app\user\model;

use app\common\controller\EncryptController;
use think\Model;

class User extends Model
{
    protected $fields = array();
    public function group()
    {
        return $this->hasOne('Group','group_id','group_id');
    }
    public function getUser($uid)
    {
        $user = $this
            ->alias('u')
            ->join('user_profile p','u.uid = p.uid')
            ->join('data_area a','p.country = a.area_id')
            ->join('data_area a1','p.province = a1.area_id')
            ->join('data_area a2','p.city = a2.area_id')
            ->join('data_area a3','p.town = a3.area_id')
            ->where('u.uid = '.$uid)
            ->field('u.uid,u.nickname,u.phone,u.phone,u.avatar,u.register_time,u.last_login_time,
                    p.*,
                    a.title as country,
                    a1.title as province,
                    a2.title as city,
                    a3.title as town')
            ->find();
        if($user){
            return ['data'=>$user,'code'=>200,'message'=>'查询成功'];
        }else{
            return ['data'=>'','code'=>200,'message'=>'该用户不存在'];;
        }
    }
    public function getUserList($option = array(),$limit = 20,$order = array('key'=>'uid','value'=>'desc')){
        $userList = $this->join('as_group','as_user.group_id=as_group.group_id')->where($option)->limit($limit)->select();
        return ['data'=>$userList,'code'=>200,'message'=>'操作完成'];
    }
    public function login($loginInfo,$encrypted = true){
        $returnData = '';
        $user = new User();
        $encrypt = new EncryptController();
        //查询用户密码
        $whereData['phone'] = $loginInfo['phone'];
        $userDetail = $user->where($whereData)->find();
        if($userDetail){
            if($userDetail['password'] == $encrypt->passwordEncrypt($encrypted?$encrypt->rsaPrivateKeyDecrypt($loginInfo['password']):$loginInfo['password'],$userDetail['salt'])) {
                //登录成功
                $returnData = ['data'=>$userDetail,'code'=>200,'message'=>'操作完成'];
            }else {
                //密码错误
                $returnData = ['data'=>'','code'=>1002,'message'=>'您输入的密码错误'];
            }
        }
        else {
            $returnData = ['data'=>'','code'=>1001,'message'=>'账户不存在'];
        }
        return $returnData;
    }
    public function register($userInfo){
        $user = new User();
        $encrypt = new EncryptController();
        $user->phone = $userInfo['phone'];
        $user->nickname = 'Wuli任性没有填';
        $user->register_time = time();
        $user->last_login_time = time();
        $user->salt = getRandChar(8,"number");
        $user->password = $encrypt->passwordEncrypt($encrypt->rsaPrivateKeyDecrypt($userInfo['password']),$user->salt);
        $user->group_id = 2;//0 默认用户组
        $res = $user->save();
        return  ['data'=>'','code'=>200,'message'=>'注册成功'];
    }
}