<?php
require_once('config.php');
session_start();
unset($_SESSION["sess_user"]);

header ("Location:".LOCALHOST."/index.php") ;
