<?php

require 'libs/Smarty.class.php';
require_once('config.php');
require_once('data/class_data_res.php');
require_once('data/class_data_link.php');

use data\isa_res_info as isa_res_info;
use data\isa_res_link as isa_res_link;
$smarty = new Smarty;
$res = new isa_res_info;
$link = new isa_res_link;

$smarty->force_compile = true;
$smarty->debugging = false;
$smarty->caching = false;

$id = "";

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $query["res"] = $id;
    $linkList = $link->select($query);
    $query["id"] = $id;
    $info = $res->select($query);

    if(count($info) > 0)
    {
        $smarty->assign("desc", "Download links", true);
        $smarty->assign("title", $info[0]["name"], true);
        $smarty->assign("downloads", $linkList);
        $smarty->display('download.html');
   }
} 
