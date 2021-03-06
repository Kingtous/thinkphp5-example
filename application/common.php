<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 *
 *接收头信息
 **/
function em_getallheaders()
{
    foreach ($_SERVER as $name => $value)
    {
        if (substr($name, 0, 5) == 'HTTP_')
        {
            $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        }
    }
    return $headers;
}

// token模块
define("ID",'ID');
define("TOKEN",'Token');
define("OUT_TIME","Out_time");
define("VAL_OUT_TIME",strtotime('+ 7 days'));
define("TIME_FORMAT","Y-m-d h:i:s");
/**
 * @param $id
 * @param $out_time
 * @return false|string
 */

function create_token($id,$out_time){
    return substr(md5($id.$out_time),5,26);
}
