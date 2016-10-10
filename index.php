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
$isMore = false;
$isAdmin = cfun::verifysess();
$p = 1;
$title = "| " . SITENAME;

$query = array();
if(isset($_GET["s"]) && $_GET["s"] != "")
{
    $query["search"] = trim($_GET["s"]);
    $search = $_GET["s"];
    $title = ",关键字: " . $search . " " . $title;
} 

if(isset($_GET["k"]) && $_GET["k"] != "")
{
    $query["tags"] = $_GET["k"];
    $tag = $_GET["k"];
    $title = ",标签: " . $tag . " " . $title;
}

if(isset($_GET["t"]) && $_GET["t"] != "")
{
    $query["subject"] = $TYPELIST[$_GET["t"]];
    $type = $_GET["t"];
    $title = ",分类: " . $type . " " . $title;
}

if(isset($_GET["p"]) && $_GET["p"] != "")
{
    $p = $_GET["p"];
}

$PageCount = $res->page($query);
$resList = $res->select($query, $p);
$pageBegin = $p - 2 < 1 ? 1 : $p - 2;
$pageEnd = $p + 5 < $PageCount ? $p + 5 : $PageCount;
$title = trim($title, ",| ");

$smarty->assign("title", $title, true);
$smarty->assign("desc", SITEDESC, true);
$smarty->assign("tag", urlencode($tag));
$smarty->assign("search", urlencode($search));
$smarty->assign("type", $type);
$smarty->assign("p", $p);
$smarty->assign("pageBegin", $pageBegin);
$smarty->assign("pageEnd", $pageEnd);
$smarty->assign("pagecount", $PageCount);
$smarty->assign("typelist", $TYPELIST);
$smarty->assign("res", $resList);
$smarty->assign("isAdmin", $isAdmin);
$smarty->display('index.html');
