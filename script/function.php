<?php

    /** 
     * 浏览器友好的变量输出 
     * @param mixed $var 变量 
     * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串 
     * @param string $label 标签 默认为空 
     * @param boolean $strict 是否严谨 默认为true 
     * @return void|string 
     */  
    function dump($var, $echo=true, $label=null, $strict=true) {  
        $label = ($label === null) ? '' : rtrim($label) . ' ';  
        if (!$strict) {  
            if (ini_get('html_errors')) {  
                $output = print_r($var, true);  
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';  
            } else {  
                $output = $label . print_r($var, true);  
            }  
        } else {  
            ob_start();  
            var_dump($var);  
            $output = ob_get_clean();  
            if (!extension_loaded('xdebug')) {  
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);  
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';  
            }  
        }  
        if ($echo) {  
            echo($output);  
            return null;  
        }else  
            return $output;  
    }  

    /**
 * Unicode字符转换成utf8字符
 * @param [type] $unicode_str Unicode字符
 * @return [type]       Utf-8字符
 */
function unicode_decode($name){
 
  $json = '{"str":"'.$name.'"}';
  $arr = json_decode($json,true);
  if(empty($arr)) return '';
  return $arr['str'];
}


/**
 * 数组 转 对象
 *
 * @param array $arr 数组
 * @return object
 */
function array_to_object($arr) {
    if (gettype($arr) != 'array') {
        return;
    }
    foreach ($arr as $k => $v) {
        if (gettype($v) == 'array' || getType($v) == 'object') {
            $arr[$k] = (object)array_to_object($v);
        }
    }
 
    return (object)$arr;
}
 
/**
 * 对象 转 数组
 *
 * @param object $obj 对象
 * @return array
 */
function object_to_array($obj) {
    $obj = (array)$obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array)object_to_array($v);
        }
    }
 
    return $obj;
}