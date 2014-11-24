<?php
/**
 * Author: pmsun
 */
return array(
    /**
     * 路由模型配置
     * 1 - 普通模式，http://www.xxx.com?c=controller&a=action&id=1
     * 2 - PATHINFO模式，http://www.xxx.com/c/a/id/1
     */
    'url_mode'           => 2,

    /**
     * 默认的控制器和方法
     */
    'default_controller' => 'index',
    'default_method'     => 'index'
);