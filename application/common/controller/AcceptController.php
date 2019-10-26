<?php


namespace app\common\controller;


use app\common\model\ResponseModel;

abstract class AcceptController
{
    protected $headers;
    protected $result;

    public function __construct()
    {
        $this->headers = em_getallheaders();
        $this->result = new ResponseModel();
    }
}