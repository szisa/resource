<?php

require 'libs/Smarty.class.php';
require_once('config.php');
require_once('data/class_data_res.php');

use data\isa_res_info as isa_res_info;
$smarty = new Smarty;
$res = new isa_res_info;

$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;

$search = "";
$tag = "";
$type = "";

$query = array();
if(isset($_GET["s"]))
{
    $query["search"] = trim($_GET["s"]);
    $search = $_GET["s"];
} 

if(isset($_GET["k"]))
{
    $query["tags"] = $_GET["k"];
    $tag = $_GET["k"];
}

if(isset($_GET["t"]))
{
    $query["subject"] = $_GET["t"];
    $type = $_GET["t"];
}

$resList = $res->select($query);

$smarty->assign("tag", $tag);
$smarty->assign("search", $search);
$smarty->assign("type", $type);
$smarty->assign("desc", "a resource site", true);
$smarty->assign("typelist", array("type1", "type2", "type3"));
$smarty->assign("res", $resList);
$smarty->display('index.html');
