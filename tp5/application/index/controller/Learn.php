<?php
namespace app\index\controller;

use think\Db;

class Learn
{
    public function index(){
        //table方法
        //查询所有数据
        $data=Db::table("song")->select();

        //查询一条数据
        $data=Db::table("song")->find();

        //-----------------------
        //name方法查询(自动添加配置文件中的表前缀)
        $data=Db::name("song")->select();

        $data=Db::name("song")->find();

        //-------------------------
        //助手函数
        $data=db("song")->select();
        $data=db("song")->find();

        //==============================
        //使用条件查询
        $data=Db::table("song")->where("SNO",">",3)->select();
        $data=Db::table("song")->where("SNO",">",3)->where("SNO","<",8)->select();

        //like模糊查询
        $data=Db::table("song")->where("SNAME","like","%My%")->select();

        //复合查询(等于号可以省略)
        $data=Db::table("song")->where("STYLENO",1)->where("SLENGTH",2.24)->select();

        //******************************
        //使用whereor或者查询
        $data=Db::table("song")->where("SNO","<",15)->whereor("SNAME","like","%Know%")->select();
        
        $data=Db::table("song")->where("SNAME","like","%Know%")->whereor("SNAME","like","%My%")->select();


        //--------------------------------
        //使用limit截取数据表显示条目
        $data=Db::table("song")->limit(3)->select(); //截取前三条
        $data=Db::table("song")->limit(3,3)->select(); //从第四个开始截取三条

        //+++++++++++++++++++++++++++++++++++++
        //使用order排序
        $data=Db::table("song")->order("SNO")->select();

        $data=Db::table("song")->order("SNO","desc")->select();

        //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        //field设置查询字段
        $data=Db::table("song")->field("SNO,SNAME")->select();
        $data=Db::table("song")->field(['SNO','SNAME'])->select();

        //设置不查询字段
        $data=Db::table("song")->field("SNO,SNAME",true)->select();

        //使用Oracle系统函数+起别名
        //$data=Db::table("song")->field("count(*) as 总数")->select();

        //page 实现分页效果
        $data=Db::table("song")->page("2,3")->select(); //一页显示三条数据，显示第二页

        //group 分组聚合
        //SELECT STYLENO,count(*) as 总数 FROM song GROUP BY STYLENO
        $data=Db::table("song")->field("STYLENO,count(*) as 总数")->group("STYLENO")->select();

        //having 过滤group by  
        $data=Db::table("song")->field("STYLENO,count(*) as 总数")->having("STYLENO > 2")->group("STYLENO")->select();
 

        //以上所有语句都可以通过 $data=Db::query("sql 语句");来实现；不过使用原生SQL语句没有了ThinkPHP的安全机制防止SQL注入

        //(((((((((((((((((((((((((((((((())))))))))))))))))))))))))))))))
        //视图查询 类似与 多表查询


        //查看最后一条执行语句
        echo Db::getLastSql();

        dump($data);
    }
}
?>