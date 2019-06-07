<?php
namespace app\index\controller;

use think\Db;  //使用系统数据库类

use think\Controller;  //引入系统控制器类

use think\Loader;

use \app\index\model\Song;
use \app\index\model\Users;

use \app\index\controller\User;  //引入本模块指定路径控制器

use \app\admin\controller\Index as AdminIndex;  //引入其他模块指定路径控制器，如果控制器名与本模块中有相同名字的控制器，要起个别名

use think\Page;  //引入分页类

class Index extends Controller
{
    public function index()
    {
        //way②
        $data=Db::query("select * from song");

        //分配数据给页面
        $this->assign('data',$data);

        //实例化数据模型 model
        $song=new \app\index\model\Song;

        dump($song::get(1)->toArray());

        //var_dump($data);
        return view();
    }

    //使用模型连接数据库
    public function datatable(){
        $users=new \app\index\model\Users();

        dump($users::all());
    }

    //模型的实例化
    public function get(){
        //调用静态方法
        $res=Song::get(1);

        dump($res->toArray());

        //实例化数据模型
        $song=new Song();

        $res=$song::get(9);

        dump($res->toArray());

        //使用loder类
        $song=Loader::model("song");

        $res=$song::get(2);

        dump($res->toArray());

        //使用助手函数
        $song=model("song");

        $res=$song::get(2);

        dump($res->toArray());
    }

    //调用当前模块的控制器中的方法
    public function diaoyonng(){
        //调用Index的User控制器--way①
        $model=new \app\index\controller\User;

        echo $model->index();

        echo "<hr>";

        //way②
        $model=new User;

        echo $model->index();

        echo "<hr>";

        //way③--使用系统方法
        $model=controller('User');

        echo $model->index();
        
        echo "<hr>";
    }

    //数据模型查询--查询单条数据
    public function getOne(){
        //get方法(默认主键)
        $res=Song::get(1);

        //获取指定字段
        $res=Song::get(["SNAME"=>"Berlin wall / a song for myself"]);

        //使用闭包函数
        $res=Song::get(function($query){
            $query->where("STYLENO",1)->where("SNAME","Berlin wall / a song for myself");
        });

        //使用find方法
        $res=Song::where("SNO",9)->find();

        dump($res->toArray());
    }

    //数据模型查询--查询多条数据
    public function getAll(){
        //所有数据
        $res=Song::all();
        
        //字符串形式(默认主键)
        $res=Song::all("1,2,9");
        //数组形式
        $res=Song::all([1,2,15]);

        //查询其他字段
        $res=Song::all(['SINGER'=>'阿克江Akin/小老虎']);

        //闭包
        $res=Song::all(function($query){
            $query->where("SINGER","阿克江Akin/小老虎")->whereOr("SNAME","like","%To%")
            ->order("SNO","desc");
        });

        //分配数据给页面 
        $this->assign('data_song',$res);

        return view();
    }

    //调用admin(后台)模块的控制器中的方法
    public function diaoyongadmin(){
        //way①
        $model=new \app\admin\controller\Index;

        echo $model->index();
        echo "<hr>";

        //way②
        $model=new AdminIndex;

        echo $model->index();
        echo "<hr>";

        //way③
        $model=controller('admin/Index');
        echo $model->index();
        echo "<hr>";
    }

    public function test(){
        return "I am the index of the method of test";
    }

    //调用当前控制器的test方法
    public function fangfa(){
        //使用面向对象方法
        echo $this->test();
        echo "<hr>";

        echo self::test();
        echo "<hr>";

        echo Index::test();
        echo "<hr>";

        //使用系统调用方法
        echo action('test');
        echo "<hr>";
    }

    //调用其他控制器中test方法
    public function fangfaother(){
        //使用命名空间
        $model=new \app\index\controller\User;

        echo $model->index();
        echo "<hr>";

        //使用系统调用
        echo action('User/index');
        echo "<hr>";
    }

    //调用后台模块的控制器的方法
    public function fangfaanother(){
        //命名空间
        $model =new \app\admin\controller\Index;

        echo $model->index();
        echo "<hr>";

        //使用系统调用
        echo action('admin/Index/index');
        echo "<hr>";
    }

    //带一个参数的路由
    public function course(){
        echo input('id');
    }

    //带多个参数的路由
    public function time(){
        echo input('year').' '.input('month');
    }    

    //普通用户的内容显示界面
    public function normal(){
        //查询歌曲表
        $data_song=Db::table('song')->paginate(3);

        //查询曲风表
        $data_style=Db::table('style')->paginate(3);

        //分配数据给页面
        $this->assign('data_song',$data_song);
        $this->assign('data_style',$data_style);
        
        return view();
    }

    
    public function search_song(){

        //获取到的select和搜索框中的值
        $myselectone = $_POST['myselectone'];
        $keywordsone = $_POST['keywordsone'];

        $myselecttwo = $_POST['myselecttwo'];
        $keywordstwo = $_POST['keywordstwo'];

        $complex = $_POST['complex'];

        //条件匹配查询
        $whereone["{$myselectone}"]=array('like',"%{$keywordsone}%");
        $wheretwo["{$myselecttwo}"]=array('like',"%{$keywordstwo}%");

        if($complex=="and"){
            //显示查询到的数据-and
            $list = Db::table('song')->where($whereone)->where($wheretwo)->select();
        }else if($complex=="or"){
            //显示查询到的数据-or
            $list = Db::table('song')->where($whereone)->whereor($wheretwo)->select();
        }

        //将页面分配到显示页面
        $this->assign('result_search',$list);

        return view();
    }

    public function search_style(){
        $myselect =$_POST['myselectstyle'];
        $keywords =$_POST['keywordsstyle'];

        $where["{$myselect}"]=array('like',"%{$keywords}%");

        $list = Db::table('style')->where($where)->select();

        $this->assign('result_style',$list);

        return view();
    }
}
