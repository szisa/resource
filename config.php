<?php
/** 
 * 基础配置文件。
 *
 * 本文件包含以下配置选项: MySQL 设置等等。
 */
// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** 数据库的名称 */
define('DB_NAME', 'isa');
/** MySQL 数据库用户名 */
define('DB_USER', 'root');
/** MySQL 数据库密码 */
define('DB_PASSWORD', '12345678');
/** MySQL 主机 */
define('DB_HOST', 'localhost');
/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8');
/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');
define('LOCALHOST', 'http://127.0.0.1/isa/res');
$TYPELIST = array(
    "设计工具" => 1, 
    "开发环境" => 2, 
    "系统工具" => 4,
    "系统镜像" => 3,
);
/** 目录的绝对路径。 */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');
    
?>