<?php
namespace com;

// 数据库操作
class cSql
{
	private $db;

    // 连接数据库
	function con($localhost, $user, $password, $database)
	{
		$this->db = new \mysqli($localhost, $user, $password, $database);
		if ($this->db->connect_errno) {
			$error = "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
			throw new \Exception($error);
		}
		$this->query("set character set 'utf8';");
		$this->query("set names utf8;");
	}
	
    // 执行语句
	function query($query)
	{
		$result = $this->db->query($query);
		return $result;
	}

    // 插入$data 到表 $table
    function insert($table, $data)
    {
        $queryHead = "INSERT INTO " . $table . " (";
        $queryValue = " VALUES (";

        foreach ($data as $k => $v) {
            $queryHead .= "`" . $k . "`,";
            if(false === strpos($v, "now()"))
                $queryValue .= "'" . $v . "',";
            else
                $queryValue .= $v . ",";
        }
        if($this->query( trim($queryHead, ",") . ")" . trim($queryValue, ",") . ")" ) > 0)
            return $this->db->insert_id;
        return -1;
    }

    // 更新表 $table 符合条件 $where 的数据为 $data
    function update($table, $data, $where)
    {
        $query = "UPDATE " . $table . " SET ";

        foreach ($data as $k => $v) {
            $query .= "`" . $k . "` = ";
            if(false === strpos($v, "now()"))
                $query .= "'" . $v . "',";
            else
                $query .= $v . ",";
        }

        $query = trim($query, ",") . " WHERE 1=1 ";

        foreach ($where as $k => $v) {
            $query .= "AND `" . $k . "` = ";
            if(false === strpos($v, "now()"))
                $query .= "'" . $v . "'";
            else
                $query .= $v . "";
        }
        return $this->query($query);
    }

    static function where($query)
    {
        $where = "1=1 ";
        foreach ($query as $k => $v) {
            $where .= "AND `" . $k . "` like ";
            $where .= "'" . cSql::Format($v) . "'";
        }
        return $where;
    }

    static function Format($value)
    {
        $value = htmlspecialchars($value, ENT_QUOTES);
        $value = addslashes($value);
        return $value;
    }

    // 关闭数据库连接
    function close()
	{
		$this->db->close();
	}

    // 获取数据影响笔数	
	function getAffect()
	{
		return $this->db->affected_rows;
	}

}
?>