<?php
namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
use com\cfun as cfun;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 
require_once(ABSPATH.'/include/class_com_fn.php'); 

class isa_res_info
{
    private $_data;
    private $_table;
    private $_count;

    function __construct($data = array())
    {
        $this->_data = array(
            'id' => '',
            'name' => '',
            'subject' => '',
            'tags' => '',
            'desc' => '',
            'creator' => 'admin',
            'createdate' => 'now()',
            'valid' => '1',
        );
        $this->_table = "isa_res_info";
        $this->_count = 10;
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

    function select($query, $p = null)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sql = $this->getData($query, $p);
        $result = $db->query($sql);
        return $this->toData($result);
    }

    function page($query)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $sql = $this->getCount($query);
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $page = $row["counts"] / $this->_count;
        return $page;
    }

    function set($data)
    {
        foreach ($this->_data as $k => $v) 
        {
            if(isset($data[$k])) 
            {
                $this->_data[$k] = $data[$k];
                if("tags" == $k)
                {
                    $tagList = $this->getTags($this->_data["tags"]);
                    foreach($tagList as $item)
                    {
                        $item = trim($item);
                    }
                    $this->_data["tags"] = join(",", $tagList);
                }
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
            $datas[$i]["tags"] = $this->getTags($datas[$i]["tags"]);
        }
        return $datas;
    }
    
    protected function getTags($tags)
    {
        return explode(",", cfun::replacezh($tags));
    }
    
    protected function getWhere($query)
    {
        $where = 'binary `valid` = 1 ';
        if(isset($query["search"]))
        {
            $where .= "AND (`name` like '%{$query["search"]}%' or `desc` like '%{$query["search"]}%' ";
            $where .= " or `tags` like '%{$query["search"]}%'";
            $where .= ")";
        }

        if(isset($query["tags"]))
        {
            $where .= "AND CONCAT(CONCAT(',',`tags`),',') like '%,{$query["tags"]},%'";
        }

        if(isset($query["subject"]))
        {
            $where .= "AND `subject` = '{$query["subject"]}'";
        }

        if(isset($query["id"]))
        {
            $where .= "AND `id` = '{$query["id"]}'";
        }

        return $where;
    }

    protected function getData($query, $p = null)
    {
        $where = $this->getWhere($query);
        $sql = "select * from `$this->_table` where $where order by `createdate` desc,`id` desc";
        if(null != $p)
        {
            $count = $this->_count;
            $begin = (($p - 1) * $count) + 1;
            if($p > 1) $sql .= " limit ".$begin.",".$count;
            else $sql .= " limit ".$count;
        }
       return $sql;
    }

    protected function getCount($query)
    {
        $where = $this->getWhere($query);
        $sql = "select count(*) counts from `$this->_table` where $where";
       return $sql;
    }

    protected function getUpdate($data = null)
    {
        if(null == $data) $data = $this->_data;
        $data = new cArray($data);
        $data->del("id");
        $data->del("createdate");
        return $data->sqlsafe();
    }

    protected function getInsert()
    {
        $data = new cArray($this->_data);
        $data->del("id");
        $data->set("createdate", "now()");
        $data->set("tags", trim($this->_data["tags"], " ,"));
        return $data->sqlsafe();
    }
}
