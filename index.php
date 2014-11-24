<?php
/**
 * Author: pmsun
 */
//监测php版本
if (version_compare(PHP_VERSION, '5.3.0', '<')) exit('请升级PHP到5.3以上版本');
define('DEBUG', 'on');
define('EXT', '.php');
//定义框架的根目录
define('ROOT_PATH', __DIR__);
require ROOT_PATH . '/core/Bootstrap.php';

$hcf->run();