<?php
require 'libs/Smarty.class.php';
require_once("config.php");
require_once('data/class_data_base.php');
require_once('include/class_com_fn.php');

use data\isa_res_base as isa_res_base;
use com\cfun as cfun;
$smarty = new Smarty;

if(cfun::verifysess())
{
    header ("Location:".LOCALHOST."/admin/index.php") ;
}

$error = "";
$user = isset($_POST['user']) ? $_POST['user'] : null;    //获取参数
$passwd = isset($_POST['passwd']) ? $_POST['passwd'] : null;
if(null != $user && null != $passwd)
{
    //验证管理员名称和密码是否正确,这里采用直接验证,没有连接数据库
    if ($user == isa_book_base::Get("adminUser") &&
        $passwd == isa_book_base::Get("adminPwd")){
        $_SESSION['sess_user'] = $user ;
        header ("Location:".LOCALHOST."/admin/index.php") ;    //登录成功重定向到管理页面
    }
    else
        $error = "账号或密码错误,或者不是管理员账号";
}

