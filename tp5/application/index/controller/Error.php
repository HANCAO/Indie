<?php
namespace app\index\controller;

use think\Controller;

//空控制器
class Error extends Controller{

    public function index(){
        $this->redirect('/Login');
    }

    //空操作
    public function _empty(){
        $this->redirect('/Login');
    }
}
?>