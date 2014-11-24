<?php
/**
 * Author: pmsun
 * Desc: 路由类
 */
class Router {

    //路由模式
    protected $_url_mode;

    //当前URL
    protected $_url;

    //默认控制器和方法
    protected $_default_controller;
    protected $_default_method;

    public function __construct() {
        $this->_default_controller = get_config_item('default_controller');
        $this->_default_method = get_config_item('default_method');
        if (!$this->_default_controller || !$this->_default_method) {
            exit('请设置默认的控制器或方法');
        }
        $this->_url_mode = get_config_item('url_mode') ? : 2;
        $this->_url = $_SERVER['REQUEST_URI'];
    }

    //获取url的分段
    public function getUrlSegments() {
        switch ($this->_url_mode) {
            case 1:
                return $this->_filterUrlOne();
                break;
            case 2:
                return $this->_filterUrlTwo();
                break;
        }
    }

    //url_model = 1
    private function _filterUrlOne() {
        $controller = isset($_GET['c']) ? $_GET['c'] : $this->_default_controller;
        $method = isset($_GET['m']) ? $_GET['m'] : $this->_default_method;

        return array(
            'controller' => $controller,
            'method'     => $method,
        );
    }

    //url_model = 2
    private function _filterUrlTwo() {
        $url_arr = array_values(array_filter(explode('/', $this->_url)));
        $controller = $url_arr[0];
        $method = $url_arr[1];

        return array(
            'controller' => $controller,
            'method'     => $method,
        );
    }
}