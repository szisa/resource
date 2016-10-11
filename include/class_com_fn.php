<?php
namespace com;

// 公用方法
class cfun
{
    // 将字符串转换为数据库安全的字符串
    static function sqlsafe($value)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);
        $value = addslashes($value);
        return $value;
    }

    // 检查session是否有指定的key
    static function verifysess($key = 'sess_user')
    {
        session_start();
        return isset ($_SESSION[$key]);
    }

    // 替换一些容易写错的中文符号为英文的
    static function replacezh($str)
    {
        $str = str_replace("，", ",", $str);
        $str = str_replace("）", ")", $str);
        $str = str_replace("（", "(", $str);
        return $str;
    }
}