<?php
namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 

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
            'valid'    => '',
        );
        $this->_table = "isa_res_link";
        $this->set($data);
    }

    function __destruct()
    {
    }
    
    function insert()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->insert($this->_table, $this->getInsert());
        return $result;
    }

    function update($data = null)
    {
        if(null != $data) $this->set($data);
        $data = $this->getUpdate($data);
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->update($this->_table, $data, array("id" => $this->_data["id"], "valid" => "1"));
        return $result;
    }

    function select($query)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sql = $this->getData($query);
        $result = $db->query($sql);
        return $this->toData($result);
    }

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

    function get()
    {
        return $this->_data;
    }

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

    protected function getData($query)
    {
        $where = $this->getWhere($query);
        $sql = "select * from `$this->_table` where $where order by `id` desc";
        return $sql;
    }

    protected function getUpdate($data = null)
    {
        if(null == $data) $data = $this->_data;
        $data = new cArray($data);
        $data->del("id");
        return $data->sqlsafe();
    }

    protected function getInsert($data = null)
    {
        if(null == $data) $data = $this->_data;
        $data = new cArray($this->_data);
        $data->del("id");
        return $data->sqlsafe();
    }
}