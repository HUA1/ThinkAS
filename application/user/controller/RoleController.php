<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/26
 * Time: 下午4:00
 */
namespace app\user\controller;

use app\common\controller\AsController;
use app\user\model\Role;

class RoleController extends AsController {
    public function getRoleList(){
        $role = new Role();
        $res = $role->getRoleList();
        return json($res);
    }
}