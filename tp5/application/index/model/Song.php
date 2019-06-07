<?php
namespace app\index\model;

//导入系统的数据模型
use think\Model;

class Song extends Model
{
    //使用数组配置连接数据库
    protected $connection=[
        // 数据库类型
    'type'            => '\think\oracle\Connection',
    // 服务器地址
    'hostname'        => '127.0.0.1',
    // 数据库名
    'database'        => 'music',
    // 用户名
    'username'        => 'scott',
    // 密码
    'password'        => 'tiger',
    // 端口
    'hostport'        => '1521',
    ];
}

?>