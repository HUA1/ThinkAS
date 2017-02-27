<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/22
 * Time: 下午5:11
 */
namespace app\admin\model;

use think\Model;

class AdminMenu extends Model
{
    public function getMenu(){
        $adminMenu = $this->where('parent_id = 0')->order('sort asc')->select();
        //管理后台菜单只有两级
        foreach ($adminMenu as $key => $value){
            $value['menu'] = $this->where('parent_id = '.$value['menu_id'])->order('sort asc')->select();
        }
        return $adminMenu;
    }
}