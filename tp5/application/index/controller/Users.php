<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

use think\Db;

class Users extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //查询users表的数据
        $data=Db::query("select * from users");

        //给页面分配数据
        $this->assign("data",$data);

        //dump($data);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //添加用户
        return view();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //处理增加的数据
        //接受传过来的数据
        $data=input("post.");

        //dump($data);
        //把数据插入到数据库中
        //注意Oracle插入是 values Mysql为value
        $code=Db::execute("insert into users values(seq_userId.NEXTVAL,:UYPE,:UNAME,:UPASSWORD)",$data);
        
        if($code){
            $this->success("添加成功",'/Login');
        }else{
            $this->error("添加失败");
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //从数据库中查询被修改的数据
        $data=Db::query("select * from users where UNO = ?",[$id]);

        //dump($data);
        //echo $id;
        //把数据分配给页面
        $this->assign("data",$data[0]);

        return view();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //接受数据
        $data=Request::instance()->except('_method');

        //执行数据库更新操作
        $code =Db::execute("update users set UYPE=:UYPE,UNAME=:UNAME,UPASSWORD=:UPASSWORD where UNO=:id",$data);

        //echo Db::getLastSql();
        //dump(input());
        //判断是否成功
        if($code){
            $this->success("数据更新成功",'/users');
        }else{
            $this->error("数据更新失败");
        }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //删除数据表中的数据
        $code=Db::execute("delete from users where UNO=$id");

        if($code){
            $this->success("数据删除成功");
        }else{
            $this->error("数据删除失败");
        }
        //echo $id;
    }
}
