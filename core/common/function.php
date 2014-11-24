<?php
/**
 * Author: pmsun
 */
/**
 * 加载配置文件
 */
if (!function_exists('load_config')) {
    function &load_config() {
        static $_config;

        if (isset($_config)) {
            return $_config[0];
        }

        //检测配置文件是否存在
        if (!file_exists(ROOT_PATH . '/conf/config.php')) {
            exit('缺少配置文件');
        }

        $config = require(ROOT_PATH . '/conf/config.php');
        //检测配置文件内的数据格式
        if (!isset($config) || !is_array($config)) {
            exit('配置文件数据格式不正确');
        }
        //由于将$config的引用赋值给$_config，第二次调用时，$_config并没有保留之前的值，所以用$_config[0]来记录
        return $_config[0] = &$config;
    }
}

/**
 * 获取某个配置项的数据
 */
if (!function_exists('get_config_item')) {
    function get_config_item($item) {
        static $_config_item = array();

        if (isset($_config_item[$item])) {
            return $_config_item[$item];
        }

        $config = &load_config();

        if (isset($config[$item])) {
            $_config_item[$item] = $config[$item];
            return $_config_item[$item];
        }
        return false;
    }
}

/**
 * 加载文件的方法
 */
if (!function_exists('import')) {
    function import($class = '', $directory = 'library', $ext = EXT) {
        static $_class = array();

        if ($class) {
            //如果已经加载，不重复加载
            if (isset($_class[strtolower($class)])) {
                return $_class[strtolower($class)];
            }

            if (!file_exists(ROOT_PATH . "/core/" . $directory . "/" . $class . $ext)) {
                exit($class . $ext . "文件不存在");
            }
            require(ROOT_PATH . "/core/" . $directory . "/" . $class . $ext);
            $_class[strtolower($class)] = $class;
            return $_class[strtolower($class)];
        }
        return $_class;
    }
}

/**
 * 自动加载配置中的类
 */
if (!function_exists('autoload')) {
    function autoload() {
        //读取autoload配置的文件
        $autoload = require __DIR__ . "/../../conf/autoload.php";
        foreach ($autoload as $path => $file_arr) {
            foreach ($file_arr as $file) {
                import($file, $path);
            }
        }
    }
}