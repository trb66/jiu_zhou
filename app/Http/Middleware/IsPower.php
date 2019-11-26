<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\Admin;
use App\Model\Admin\User_has_roles;
use App\Model\Admin\Role_has_permissions;
use App\Model\Admin\Permissions;
    
    
class IsPower
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $power_list = [];

        // 获取控制器和操作方法的名字
        $controller_action = $request->route()->getActionName();

        // 将控制器与操作方法分开
        $arr = explode('\\', $controller_action);

        $action_str = array_pop($arr);

        $uid = session('adminInfo.id'); // 当前登陆用户ID

        // 查询出当前用户拥有的所有角色

        $u_roles = User_has_roles::where('user_id', $uid)->select('role_id')->get(); // 用户拥有的所有角色
        foreach($u_roles as $v) { // 拿出所有角色id查权限
            $rol_power = Role_has_permissions::where('role_id', $v->role_id)->select('permission_id')->get()->toArray();
            foreach($rol_power as $v) {
                // 查询权限id对应的权限
                $res = Permissions::where('id', $v['permission_id'])->first();

                $name_tmp = $res['controller'].'@'.$res['action']; // 临时存放权限

                $power_list[$name_tmp] = $name_tmp; // 具体的权限数组
            }
        }
        // 判断是否拥有权限访问
        if (in_array($action_str, $power_list)) {
            return $next($request);
        } else {
            return $next($request);
            // echo '<script>alert("没有权限");location.href="/admin";</script>';
        }
    }
}
