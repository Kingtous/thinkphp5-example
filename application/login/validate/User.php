<?php


namespace app\login\validate;


use think\Validate;

class User extends Validate
{
    // 主要是注册
    protected $rule = [
        'Phone' => 'require|mobile',
        'Nickname' => 'require|chsAlphaNum'
    ];
}