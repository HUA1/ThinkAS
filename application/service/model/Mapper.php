<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/22
 * Time: 下午11:18
 */
namespace app\service\model;

use think\Model;

class Mapper extends Model
{
    public function getMapper($mapperData){
        if(array_key_exists('model',$mapperData)){
            $mapperJson = $this->where('model = "'.$mapperData['model'].'"')->find();
            if($mapperJson){
                return ['data'=>json_decode($mapperJson['json']),'code'=>200,'message'=>'操作完成'];
            }else{
                return ['data'=>'' ,'code'=>200,'message'=>'未找到Mapper映射Json'];
            }
        }else{
            return ['data'=>'' ,'code'=>200,'message'=>'请求参数错误'];
        }

    }
}