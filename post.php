<?php
require 'libs/Smarty.class.php';
require_once('config.php');
require_once('data/class_data_res.php');
require_once('data/class_data_link.php');
require_once('include/class_com_fn.php');

use data\isa_res_info as isa_res_info;
use data\isa_res_link as isa_res_link;
use com\cfun as cfun;

$smarty = new Smarty;
$res = new isa_res_info;
$dlink = new isa_res_link;
$id = -1;

$info = $res->get();
$linkList[0] = $dlink->get();

$smarty->assign("desc", "发布一个新资源", true);
$smarty->assign("title", "新增", true);

if(!cfun::verifysess())
{
    header ("Location:".LOCALHOST."/index.php") ;
}

// 删除资源
if(isset($_GET["del"]))
{
    $info = array(
        "id" => $_GET["del"],
        "valid" => 0,
    );
    $res->update($info);
    header ("Location:".LOCALHOST."/index.php");
    die();
}

// 删除资源链接
if(isset($_GET["delink"]))
{
    $link = array(
        "id" => $_GET["delink"],
        "valid" => 0,
    );
    $dlink->update($link);
    echo "<script>opener.location.reload();window.close();</script>";
    die();
}

// 加载资源信息
if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $query["res"] = $id;
    $linkList = $dlink->select($query);
    $query["id"] = $id;
    $infos = $res->select($query);

    if(count($infos) > 0)
    {
        $info = $infos[0];
        $info["tags"] = join(",", $info["tags"]);
        $smarty->assign("title", $info["name"], true);
        $smarty->assign("desc", "编辑资源信息", true);
   }
} 

// 修改资源信息
if(isset($_POST["id"]))
{
    $res->set($_POST);
    if($_POST["id"] > 0)
    {
        $res->update();
        $info = $res->get();
        // 解析资源链接，格式 链接名,链接(提取码描述:提取码)
        $linkPost = explode("\n", cfun::replacezh($_POST["links"]));
        $id = $_POST["id"];
        foreach($linkPost as $link)
        {
            $linkinfo = explode(",", $link);
            if(count($linkinfo) <= 1) continue;
            $linkext = explode("(", trim($linkinfo[1]));
            $extDesc = "";
            $link = trim($linkext[0]);
            if(count($linkext) > 1){
                $linkext = trim(trim($linkext[1], ")"));
                $exts = explode(":", $linkext);
                if (count($exts) > 1) $linkext = trim($exts[1]);
                else $linkext = trim($exts[0]);
                if (count($exts) > 1) $extDesc = trim($exts[0]);
                else $extDesc = '提取码';
            }
            else {
                $linkext = "";
            }
            $linkinfo = array(
                'resId'    => $id,
                'source'   => $linkinfo[0],
                'resLink'  => $link,
                'extDesc'  => $extDesc,
                'extCode'  => $linkext,
            );
            // 解析一条链接，存入资料库
            $dlink->set($linkinfo);
            $dlink->insert();
        }
        $query["res"] = $id;
        unset($query["id"]);
        $linkList = $dlink->select($query);
    }
    else
    {
        $id = $res->insert();
        header("Location:".LOCALHOST."/post.php?id=".$id);
    }
}

$smarty->assign("id", $id);
$smarty->assign("info", $info);
$smarty->assign("downloads", $linkList);
$smarty->assign("typelist", $TYPELIST);
$smarty->display('post.html');
