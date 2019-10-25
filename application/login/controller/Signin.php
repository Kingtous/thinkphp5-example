<?php


namespace app\login\controller;

use app\common\model\ResponseModel;
use app\login\model\User;
use think\exception\DbException;

class Signin
{
    public function index(){
        $headers = em_getallheaders();
        if ($this->checkHeaders($headers)){
            return $this->login($headers["Phone"],"Passwd");
        }else{
            return (new ResponseModel(ResponseModel::$ERRCODE_ERR,TIP_ILLEGAL_REQUEST))->getBodyJson();
        }
    }

    private function checkHeaders($headers){
        return isset($headers['Phone']) && isset($headers['Passwd']);
    }

    private function login($phone,$passwd){
        $result = new ResponseModel();
        if ($phone == null || $passwd == null){
            $result->setErr(ResponseModel::$ERRCODE_ERR,TIP_NOT_ENOUGH_INFO);
        }
        else{
            try {
                $user = User::get(['phone' => $phone]);
                if ($user == null){
                    $result->setErr(ResponseModel::$ERRCODE_ERR,TIP_USER_NOT_EXIST);
                }
                else{
                    // 去除密码
                    unset($user['passwd']);
                    $result->setErrCode(ResponseModel::$ERRCODE_OK);
                    $result->setData($user);
                }
            } catch (DbException $e) {
                $result->setErr(ResponseModel::$ERRCODE_DATABASE_ERR,$e->getMessage());
            }
        }
        return $result->getBodyJson();
    }
}