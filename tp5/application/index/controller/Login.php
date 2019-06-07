<?php
namespace app\index\controller;

use think\Controller;  //引入系统控制器

use think\Db;  //引入系统数据库类

class Login extends Controller{
    //显示登录页面
    public function index(){
        return view();
    }

    //处理登录的提交页面
    public function check(){
        //dump($_POST);
        //接受数据
        $username=$_POST['Username'];
        $password=$_POST['Password'];
        

        //从用户表中读取数据
        $data=Db::table('users')->select();
        
        //遍历用户表中的数据
        for($i=0;$i<count($data);++$i){
            if($data[$i]['UNAME']==$username && $data[$i]['UPASSWORD']==$password){  //如果填入的用户名和密码与数据库用户表中的相对应，则成功登录
                //成功登录
                if($data[$i]['UYPE']=='admin'){  //如果登录用户类型为管理员，则跳转到管理员界面(增删改查)
                    $this->success('跳转成功',url('/songs'));
                }else if($data[$i]['UYPE']=='visitor'){  //如果登录用户类型为游客，则跳转到游客界面(查)
                    $this->success('跳转成功',url('/normal'));
                }
            }
        }
        for($j=0;$j<count($data);++$j){  //如果填入的用户名和密码与数据库用户表中的不对应，则登录失败
            if($data[$j]['UNAME']!=$username || $data[$j]['UPASSWORD']!=$password){
                //登录失败
                $this->error('跳转失败');
            } 
        }
    }

    //重定向(注意方法名不能为 redirect )
    public function rredirect(){
        $this->redirect('/');
    }

    //空操作(把所有错误页面重定向到登录页面)
    public function _empty(){
        $this->redirect('/Login');
    }
}
?>