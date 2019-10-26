<?php


namespace app\login\controller;

use app\common\model\ResponseModel;
use app\login\model\User;
use think\Db;
use think\Loader;

class Register extends \UserLoginController
{

    protected function checkHeaders($headers)
    {
        return isset($headers[PHONE_NUMBER]) && isset($headers[NICKNAME]) && isset($headers[PASSWORD]);
    }


    protected function action($headers)
    {
        // 注册
        $data =[
          PHONE_NUMBER => $headers[PHONE_NUMBER],
          NICKNAME => $headers[NICKNAME],
          PASSWORD => $headers[PASSWORD]
        ];
        $userRule = validate('User');
        if ($userRule->check($data)){
            // 检查是否已经注册
            $user = User::get([PHONE_NUMBER => $data[PHONE_NUMBER]]);
            if (is_null($user)){
                //写入数据库
                User::create($data);
                $this->result->setErrCode(ResponseModel::$ERRCODE_OK);
            }
            else{
                //已经注册
                $this->result->setErr(ResponseModel::$ERRCODE_ERR,TIP_PHONE_NUMBER_EXIST);
            }
        }
        else{
            $this->result->setErr(ResponseModel::$ERRCODE_ERR,$userRule->getError());
        }
        return $this->result->getBodyJson();
    }
}