<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/20
 * Time: 下午3:41
 */
namespace app\user\model;

use think\Model;

class Role extends Model
{
    public function getRoleList($options = array(),$limit = 20,$order = array('key'=>'role_id','value'=>'desc')){
        $res = $this
            ->where($options)
            ->limit($limit)
            ->order($order['key'].' '.$order['value'])
            ->select();
        if($res){
            return ['data'=>$res,'code'=>200,'message'=>'操作完成'];
        }else{
            return ['data'=>'','code'=>100,'message'=>'操作完成'];
        }

    }
}