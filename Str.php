<?php

/**
 * HTMLȥ���ո���
 * @param string $str
 * @return string
 */
function htmlTrim($str){
    str_replace(' ', '', $str);
    str_replace('\r', '', $str);
    str_replace('\n', '', $str);
    str_replace('\r\n', '', $str);
    return $str;
}

