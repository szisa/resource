<?php
namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 

// 资源连接类
class isa_res_link
{
    private $_data;
    private $_table;

    function __construct($data = array())
    {
        $this->_data = array(
            'id'       => '',
            'resId'    => '',
            'source'   => '',
            'resLink'  => '',
            'extCode'  => '',
            'valid'    => '1',
        );
        $this->_table = "isa_res_link";
        $this->set($data);
    }

    function __destruct()
    {
    }
    
    // 插入此条资源连接
    function insert()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->insert($this->_table, $this->getInsert());
        return $result;
    }

    // 更新链接指定栏位资讯，注意要传入id
    function update($data = null)
    {
        if(null != $data) $this->set($data);
        $data = $this->getUpdate($data);
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->update($this->_table, $data, array("id" => $this->_data["id"], "valid" => "1"));
        return $result;
    }

    // 根据条件查询链接列表
    function select($query)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sql = $this->getData($query);
        $result = $db->query($sql);
        return $this->toData($result);
    }

    // 设置连接信息
    function set($data)
    {
        foreach ($this->_data as $k => $v) 
        {
            if(isset($data[$k])) 
            {
                $this->_data[$k] = $data[$k];
            }    
        }

        return $this->_data;
    }

    // 获取链接信息
    function get()
    {
        return $this->_data;
    }

    // 将数据库查询值转为链接列表
    protected function toData($result)
    {
        $datas = array();
        for($i = 0; $i < $result->num_rows; $i++)
        {
            $row = $result->fetch_assoc();
            $datas[$i] = $row;
        }
        return $datas;
    }
    
    // 获取查询条件
    protected function getWhere($query)
    {
        $where = '`valid` = 1 ';

        if(isset($query["id"]))
        {
            $where .= "AND `id` = '{$query["id"]}'";
        }

        if(isset($query["res"]))
        {
            $where .= "AND `resId` = '{$query["res"]}'";
        }
        return $where;
    }

    // 根据查询条件获取链接列表
    protected function getData($query)
    {
        $where = $this->getWhere($query);
        $sql = "select * from `$this->_table` where $where order by `id` desc";
        return $sql;
    }

    // 获取更新信息数组
    protected function getUpdate($data = null)
    {
        if(null == $data) $data = $this->_data;
        $data = new cArray($data);
        $data->del("id");
        return $data->sqlsafe();
    }

    // 获取插入信息数组
    protected function getInsert($data = null)
    {
        if(null == $data) $data = $this->_data;
        $data = new cArray($this->_data);
        $data->del("id");
        return $data->sqlsafe();
    }
}