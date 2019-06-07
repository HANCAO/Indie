<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

use think\Db;  //引用系统数据类

class Songs extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //way②
        //$data_song=Db::query("select * from song");
        $data_song=Db::table('song')->paginate(3);

        //分配数据给页面
        $this->assign('data_song',$data_song);

        //$data_style=Db::query("select * from style");
        $data_style=Db::table('style')->paginate(3);

        $this->assign('data_style',$data_style);

        //var_dump($data);
        return view();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //添加歌曲
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

        $code=Db::execute("insert into song values(seq_songId.NEXTVAL,:SNAME,:SRELEASE,:SRECORD,
        :SLYRICS,:SCOMPOSITION,:SINGER,:SLENGTH,:STYLENO)",$data);

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
        $data=Db::query("select * from song where SNO=?",[$id]);

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
        $code=Db::execute("update song set SNAME=:SNAME,SRELEASE=:SRELEASE,SRECORD=:SRECORD,SLYRICS=:SLYRICS,
        SCOMPOSITION=:SCOMPOSITION,SINGER=:SINGER,SLENGTH=:SLENGTH,STYLENO=:STYLENO where SNO=:id",$data);

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
        //删除歌曲表中的数据
        $code =Db::execute("delete from song where SNO=$id");

        if($code){
            $this->success("数据删除成功");
        }else{
            $this->error("数据删除失败");
        }
        
    }
}
