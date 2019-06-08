<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\MyPaginator;

use \app\index\model\Song;

class Normals extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {

        //查询歌曲表
        $data_song=Db::table('song')->paginate(3);


        //查询曲风表
        $data_style=Db::table('style')->paginate(3);

        //录入次数最多的曲风 & 最新录入该曲风的歌曲
        $song=new Song();

        $data_bang=$song->query("select * from(
            select st.styletype,count(so.styleno) count from song so,style st where so.styleno=st.styleno group by st.styletype order by count(so.styleno) desc
            ) where rownum<=3");

        

        //分配数据给页面
        $this->assign('data_song',$data_song);
        $this->assign('data_style',$data_style);
        $this->assign('data_bang',$data_bang);

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
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
