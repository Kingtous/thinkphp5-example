<?php


namespace app\common\model;


class ResponseModel
{
    public static $ERRCODE_OK = 0;
    public static $ERRCODE_ERR = -1;
    public static $ERRCODE_DATABASE_ERR = -2;

    private $body;

    public function __construct0()
    {
        $this->body = Array(
            'errcode' => -1,
            'errmsg'  => null,
        );
    }

    function __construct()
    {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

    public function __construct2($errcode,$errmsg)
    {
        $this->body = Array(
            'errcode' => $errcode,
            'errmsg'  => $errmsg
        );
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return array
     */
    public function getBodyJson()
    {
        //去除为null的值（不包含data中的）
        foreach ($this->body as $item => $value) {
            if (is_null($value)){ //使用 $value == null 貌似会误伤errcode=0
                unset($this->body[$item]);
            }
        }
        return Json($this->body);
    }

    /**
     * @param array $body
     */
    public function setBodyAttr($key,$value)
    {
        if ($value != null)
            $this->body[$key]=$value;
        else
            unset($this->body[$key]);
    }

    public function setErrCode($value){
        $this->body['errcode'] = $value;
    }

    public function setErrMsg($value){
        $this->body['errmsg'] = $value;
    }

    public function setErr($code,$value){
        $this->body['errcode'] = $code;
        $this->body['errmsg'] = $value;
    }

    public function setData($value){
        $this->body['data'] = $value;
    }



}