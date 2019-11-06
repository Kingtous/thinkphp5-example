<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->assign('headers',em_getallheaders());
        return $this->fetch();
    }
}
