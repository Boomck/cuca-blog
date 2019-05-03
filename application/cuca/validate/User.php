<?php
/**
 * Created by PhpStorm.
 * User: Boom
 * Date: 2018/12/29
 * Time: 17:47
 */
namespace app\cuca\validate;
use think\Validate;

class User extends Validate
{
    protected $rule = [
        'username' => 'require',
        'password' => 'require|confirm:repassword',
        'phone' => 'length:11',
        'email' => 'email'
    ];
    protected $message = [
        'username.require' => '用户名不能为空',
        'password.require' => '密码不能为空',
        'password.confirm' => '两次密码不一致',
        'phone.length' => '不符合手机号规则',
        'email' => '不符合邮箱规则'
    ];
}