<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/20
 * Time: 下午3:41
 */
namespace app\user\model;

use think\Model;

class Group extends Model
{
    public function getGroupList($option = array(),$limit = 20,$order = array('key'=>'power_id','value'=>'desc')){
        $groupList = $this
            ->alias('g')
            ->join('as_role r','g.role_id=r.role_id')
            ->where($option)
            ->limit($limit)
            ->select();
        return ['data'=>$groupList,'code'=>200,'message'=>'操作完成'];
    }
    public function createGroup($groupInfo){
        $this->group_name = $groupInfo['group_name'];
        $this->group_desc = $groupInfo['group_desc'];
        $this->role_id = $groupInfo['role_id'];
        $res = $this->save();
        if($res){
            return ['data'=>$res,'code'=>200,'message'=>'操作完成'];
        }else{
            return ['data'=>'','code'=>100,'message'=>'操作完成'];
        }
    }
}