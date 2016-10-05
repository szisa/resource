<?php

namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 

class isa_book_base
{
    static private $_table = 'isa_res_base';

    static function Get($key)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Read(isa_book_base::Format($key)));
        if($result->num_rows > 0)
        {
            $data = $result->fetch_assoc();
            return $data["value"];
        }
        return "";
    }
    static function Set($key, $value)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->query(isa_book_base::Write(cfun::sqlsafe($key), cfun::sqlsafe($value)));
        return $result;
    }
    static protected function Read($key)
    {
        $sql = "SELECT * FROM `$_table`
                WHERE `valid` = 1 AND `key` = '$key' LIMIT 1 ;";
        return $sql;
    }
    static protected function Write($key, $value)
    {
        $sql = "CALL `SetBase`('$key', '$value');";
        return $sql;
    }
}
?>