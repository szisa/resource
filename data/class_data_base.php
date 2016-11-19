<?php

namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
use com\cfun as cfun;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 
require_once(ABSPATH.'/include/class_com_fn.php'); 

// 网页基本信息
class isa_web_base
{
    static private $_table = 'isa_res_base';

    // 获取指定key值
    static function Get($key)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_web_base::Read(cfun::sqlsafe($key)));
        $db->close();
        if($result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
            return $data["value"];
        }
        return "";
    }

    // 设置指定key值
    static function Set($key, $value)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_web_base::Write(cfun::sqlsafe($key), cfun::sqlsafe($value)));
        $db->close();
        return $result;
    }

    // 生成读SQL
    static protected function Read($key)
    {
        $table = isa_web_base::$_table;
        $sql = "SELECT * FROM `{$table}` WHERE `valid` = 1 AND `key` = '{$key}' LIMIT 1 ;";
        return $sql;
    }

    // 生成写SQL
    static protected function Write($key, $value)
    {
        $sql = "CALL `SetBase`('$key', '$value');";
        return $sql;
    }
}
?>