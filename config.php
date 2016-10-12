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
define('DB_PASSWORD', '`1qw23');
/** MySQL 主机 */
define('DB_HOST', 'sxisa.org');
define('SITENAME', '创软资源下载站');
define('SITEDESC', '我们不存储资源，我们只是资源的搬运工。');
define('LOCALHOST', 'http://127.0.0.1/isa/res');
define('TONGJI','');
/** 目录的绝对路径。 */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

$TYPELIST = array(
    "设计工具" => 1, 
    "开发环境" => 2,
    "系统镜像" => 3, 
    "系统工具" => 4,
    "办公软件" => 5,
    "电子书"  => 6,
);
  