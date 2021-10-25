<?php
/**
 * Created by PhpStorm.
 * User: DIFF
 * Date: 2021/10/9
 * Time: 16:53
 */

namespace app\admin\validate;


use think\Validate;

class LoginValidate extends Validate{

    protected $rule = [
        'username' => 'require|length:3,30',
        'password' => 'require|length:3,30',
        'captcha' => 'captcha',
        '__token__' => 'require|token',
    ];

    protected $message = [
        'username.require' => '用户名必须',
        'username.length' => '用户名长度必须在3-30字符之间',
        'password.require' => '密码必须',
        'password.length' => '密码长度必须在3-30字符之间',
        'captcha.captcha' => '验证码不正确',
        '__token__.require' => '令牌必须',
    ];

}

