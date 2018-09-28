<?php
namespace com;

require_once("class_com_fn.php");

// 数组操作
class cArray
{
    private $arr;
    
    // 构造
    function __construct($a = array())
    {
        $this->arr = $a;
    }

    // 添加元素
    function add($key, $value)
    {
        if(!is_string($key)) return 1;
        if(isset($this->arr[$key])) return 1;
        $this->arr[$key] = $value;
        return 0;
    }
    
    // 设置某个元素
    function set($key, $value)
    {
        if(!is_string($key)) return 1;
        if(!isset($this->arr[$key])) return 1;
        $this->arr[$key] = $value;
        return 0;
    }
    
    // 删除某个元素
    function del($key)
    {
        if(!is_string($key)) return 1;
        if(!isset($this->arr[$key])) return 1;
        unset($this->arr[$key]);
        return 0;
    }
    
    // 清空数组
    function clear()
    {
        $count = 0;
        foreach ($this->arr as $i => $value) {
            unset($this->arr[$i]);
            $count ++;
        }
        return count;
    }
        
    // 连接数组
    function cat($src)
    {
        if(!is_array($src)) return 1;
        $this->arr = array_merge($this->arr, $src);
        return $this->arr;
    }
    
    // 返回数组
    function get()
    {
        return $this->arr;
    }
    
    // 返回数组key列表
    function keys()
    {
        $keys = "";
        foreach ($this->arr as $i => $value) {
            $keys[]=$i;
        }
        return $keys;
    }

    // 将数组值全部转为数据库安全并返回
    function sqlsafe()
    {
        $count = 0;
        foreach ($this->arr as $i => $value) {
            $this->arr[$i] = cfun::sqlsafe($this->arr[$i]);
        }
        return $this->arr;
    }

    // 转义 HTML
    function format($value)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);
        $value = addslashes($value);
        return $value;
    }
}
?>