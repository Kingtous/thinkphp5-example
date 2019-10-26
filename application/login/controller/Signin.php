<?php


namespace app\login\controller;

use app\common\model\ResponseModel;
use app\login\model\User;
use app\login\model\Token;

use think\exception\DbException;

class Signin extends \UserLoginController
{

    protected function checkHeaders($headers)
    {
        return isset($headers[PHONE_NUMBER]) && isset($headers[PASSWORD]);
    }

    protected function action($headers)
    {
        $phone = $headers[PHONE_NUMBER];
        $passwd = $headers[PASSWORD];
        $result = new ResponseModel();
        if ($phone == null || $passwd == null){
            $result->setErr(ResponseModel::$ERRCODE_ERR,TIP_NOT_ENOUGH_INFO);
        }
        else{
            try {
                $user = User::get([PHONE_NUMBER => $phone]);
                if ($user == null){
                    $result->setErr(ResponseModel::$ERRCODE_ERR,TIP_USER_NOT_EXIST);
                }
                else{
                    // 去除密码
                    unset($user[PASSWORD]);
                    // 返回一个token
                    // step 1.生成一个token，登录用户传入token，
                    $token = create_token($user[PHONE_NUMBER],OUT_TIME);
                    $store = [
                        ID => $user[ID],
                        TOKEN=>$token,
                        OUT_TIME=>date(TIME_FORMAT,VAL_OUT_TIME)
                    ];
                    if (is_null(Token::get([ID => $user[ID]]))){
                        // 如果没有则创建
                        if (Token::create($store)){
                            $result->setErrCode(ResponseModel::$ERRCODE_OK);
                            $user[\TOKEN]=$token;
                            $result->setData($user);
                        }
                        else{
                            $this->result->setErr(ResponseModel::$ERRCODE_DATABASE_ERR,TIP_ILLEGAL_REQUEST);
                        }
                    }
                    else{
                        //有则更新token
                        if (Token::update($store,[ID => $user[ID]])){
                            $result->setErrCode(ResponseModel::$ERRCODE_OK);
                            $user[\TOKEN]=$token;
                            $result->setData($user);
                        }
                        else{
                            $this->result->setErr(ResponseModel::$ERRCODE_DATABASE_ERR,TIP_ILLEGAL_REQUEST);
                        }
                    }
                }
            } catch (DbException $e) {
                $result->setErr(ResponseModel::$ERRCODE_DATABASE_ERR,$e->getMessage());
            }

        }
        return $result->getBodyJson();
    }
}