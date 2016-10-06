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

if(isset($_POST["id"]))
{
    $res->set($_POST);
    if($_POST["id"] > 0)
    {
        $res->update();
        $info = $res->get();
        $linkPost = explode("\n", $_POST["links"]);
        $id = $_POST["id"];
        foreach($linkPost as $link)
        {
            $linkinfo = explode(",", $link);
            if(count($linkinfo) <= 1) continue;
            $linkext = explode("(", trim($linkinfo[1]));
            $link = trim($linkext[0]);
            if(count($linkext) > 1) $linkext = trim(trim($linkext[1], ")"));
            else $linkext = "";
            $linkinfo = array(
                'resId'    => $id,
                'source'   => $linkinfo[0],
                'resLink'  => $link,
                'extCode'  => $linkext,
            );
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
