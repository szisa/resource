<?php
namespace data;

use com\cSql as cSql;
use com\cArray as cArray;
require_once(ABSPATH.'/include/class_com_sql.php'); // a mysql class.
require_once(ABSPATH.'/include/class_com_array.php'); 

class isa_res_info
{
    private $_data;
    private $_table;

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
        $this->set($data);
    }

    function __destruct()
    {
    }
    
    function insert()
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->insert($this->_table, $this->get());
        return $result;
    }

    function update($data)
    {
        $db = new cSql();
        $db->con(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $result = $db->update($this->_table, $this->getUpdate(), array("id" => $this->_data["id"], "valid" => "1"));
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
                $this->_data[$k] = $v;
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
        return $data;
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
        return explode(",", $tags);
    }
    
    protected function getWhere($query)
    {
        $where = '1 = 1 ';
        if(isset($query["search"]))
        {
            $where .= "AND (`name` like '%{$query["search"]}%' or `desc` like '%{$query["search"]}%' ";
            if(!isset($query["tags"])) $where .= " or `tags` like '%{$query["search"]}%'";
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

    protected function getData($query)
    {
        $where = $this->getWhere($query);
        $sql = "select * from `$this->_table` where $where order by `createdate` desc,`id` desc";
        return $sql;
    }

    protected function getUpdate()
    {
        $data = cArray($this->_data);
        $data->del("id");
        $data->del("createdate");
        return $data.sqlsafe();
    }

    protected function getInsert()
    {
        $data = cArray($this->_data);
        $data->del("id");
        $data->set("createdate", "now()");
        $data->set("tags", ",".trim($this->_data["tags"], " ,").",");
        return $data.sqlsafe();
    }
}
