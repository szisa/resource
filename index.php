<?php

require 'libs/Smarty.class.php';
require_once('config.php');
require_once('data/class_data_res.php');
require_once('include/class_com_fn.php');

use data\isa_res_info as isa_res_info;
use com\cfun as cfun;
$smarty = new Smarty;
$res = new isa_res_info;

$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;

$search = "";
$tag = "";
$type = "";
$isAdmin = cfun::verifysess();

$query = array();
if(isset($_GET["s"]) && $_GET["s"] != "")
{
    $query["search"] = trim($_GET["s"]);
    $search = $_GET["s"];
} 

if(isset($_GET["k"]) && $_GET["k"] != "")
{
    $query["tags"] = $_GET["k"];
    $tag = $_GET["k"];
}

if(isset($_GET["t"]) && $_GET["t"] != "")
{
    $query["subject"] = $TYPELIST[$_GET["t"]];
    $type = $_GET["t"];
}

$resList = $res->select($query);

$smarty->assign("title", "创软资源下载站", true);
$smarty->assign("desc", "我们不存储资源，我们只是资源的搬运工。", true);
$smarty->assign("tag", $tag);
$smarty->assign("search", $search);
$smarty->assign("type", $type);
$smarty->assign("typelist", $TYPELIST);
$smarty->assign("res", $resList);
$smarty->assign("isAdmin", $isAdmin);
$smarty->display('index.html');
