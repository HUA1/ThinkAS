<?php
/**
 * Created by PhpStorm.
 * User: leiqiu
 * Date: 17/2/26
 * Time: 下午3:41
 */
namespace app\user\controller;

use app\common\controller\AsController;
use app\user\model\Group;

class GroupController extends AsController {
    public function createGroup(){
        $groupInfo = request()->param();
        $group = new Group();
        $res = $group->createGroup($groupInfo);
        return json($res);
    }
}