<?php

use app\common\model\ResponseModel;

// 表名
define("PHONE_NUMBER",'Phone');
define("NICKNAME",'Nickname');
define("PASSWORD",'Passwd');
define("IsVIP","IsVIP");
// 提示信息
define("TIP_NOT_ENOUGH_INFO","信息填写不完整");
define("TIP_USER_NOT_EXIST","用户不存在");
define("TIP_ILLEGAL_REQUEST","非法请求");
define("TIP_PHONE_NUMBER_EXIST","该手机号已经被注册");
define("TIP_LOGIN_ERROR","登陆失败");

abstract class UserLoginController extends \app\common\controller\AcceptController {

    public function index(){
         if ($this->checkHeaders($this->headers)){
             return $this->action($this->headers);
         }
         else{
             return (new ResponseModel(ResponseModel::$ERRCODE_ERR,TIP_ILLEGAL_REQUEST))->getBodyJson();
         }
     }

     // 返回 true 或者 false，检查Headers是否具有合法性
     abstract protected function checkHeaders($headers);

    // Headers 验证合法后如何操作，返回你要返回的内容
     abstract protected function action($headers);
}
