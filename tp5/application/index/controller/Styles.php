<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

use think\Db;

class Styles extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        $data_style=Db::query("select * from style");
        $this->assign('data_style',$data_style);

        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
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
        //处理增加过来的数据插入到数据库
        $data=input("post.");
        //dump($data);

        $code=Db::execute("insert into style values(seq_songId.NEXTVAL,:STYLETYPE,:STYLECOUNTRY,to_date(:STYLEBORN,'yyyy-MM-dd'))",$data);

        if($code){
            $this->success("添加成功",'/songs');
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
        //从song表中查询需要修改的数据
        $data=Db::query("select * from style where STYLENO=?",[$id]);

        //分配数据给页面
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
        $code=Db::execute("update style set STYLETYPE=:STYLETYPE,STYLECOUNTRY=:STYLECOUNTRY,STYLEBORN=to_date(:STYLEBORN,'yyyy-MM-dd') where STYLENO=:id",$data);

        if($code){
            $this->success("数据更新成功",'/songs');
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
        //删除曲风表中的数据
        $code =Db::execute("delete from style where STYLENO=$id");

        if($code){
            $this->success("数据删除成功");
        }else{
            $this->error("数据删除失败");
        }
    }
}

