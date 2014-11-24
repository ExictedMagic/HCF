<?php
/**
 * Author: pmsun
 */
require __DIR__ . "/common/function.php";
//注册自动加载函数
spl_autoload_register('autoload');

require __DIR__ . "/hcf/Hcf.php";

global $hcf;
$hcf = Hcf::getInstance();

//加载路由类
import('Router', 'hcf');
$hcf->router = new Router();