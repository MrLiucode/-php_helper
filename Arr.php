<?php
/**
 * Arr.php
 *
 * Part of Allinpay.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    Fackeronline <1077341744@qq.com>
 * @link      https://github.com/Fakeronline
 */

/**
 * 从数组中获取某个值，可深度获取
 * @param $array
 * @param $key
 * @param null $default
 * @return null
 */
function array_get($array, $key, $default = null)
{
    if (is_null($key)) {
        return $array;
    }

    if (isset($array[$key])) {
        return $array[$key];
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($array) || !array_key_exists($segment, $array)) {
            return $default;
        }
        $array = $array[$segment];
    }

    return $array;
}

/**
 * 将多维数组变成一维数组
 * @param $array
 * @param string $prepend
 * @return array
 */
function array_dot($array, $prepend = '')
{
    $results = [];

    foreach ($array as $key => $value)
    {
        if (is_array($value))
        {
            $results = array_merge($results, dot($value, $prepend.$key.'.'));
        }
        else
        {
            $results[$prepend.$key] = $value;
        }
    }

    return $results;
}

/**
 * 从一个数组里匹配值
 * @param string $pattern  正则
 * @param array $subject_array  匹配数组
 * @param bool $preg_match_all  是否贪婪匹配
 * @return array
 */
function array_preg_match($pattern, $subject_array ,$preg_match_all = false ){

    $result = array();

    foreach($subject_array as $value){

        $temp = array();

        if($preg_match_all){

            preg_match_all($pattern, $value, $temp);

        }else{

            preg_match($pattern, $value, $temp);

        }

        $result = array_merge($result, $temp);

    }

    return $result;

}

/**
 * 将数组里的某一个键值作为数组的索引并返回
 * @param array $array
 * @param $key
 * @return array
 */
function array_key_advance(array $array ,$key){

    $result = array();

    foreach($array as $item){

        $field = array_get($item, $key);

        if(is_null($field)){

            $result[] = $item;

        }else{

            $result[$field] = $item;

        }

    }

    return $result;

}

/**
 * 根据指定的键数组值获取值
 * @param array $key_array  键
 * @param array $value_array    所有值数组
 * @return array
 */
function array_get_all(array $key_array, array $value_array){

    $result = array();

    foreach($key_array as $key){

        $result[$key] = array_get($value_array,$key);

    }

    return $result;

}

/**
 * 获取数组中某个键的值，以一位数组的方式返回
 * @param array $array
 * @param $key
 * @return array
 */
function array_get_value(array $array, $key){
    $result = [];
    if($array && $key){
        foreach($array as $item){
            if($res = array_get($item, $key)){
                $result[] = $res;
            }
        }
    }
    return $result;
}

/**
 * 提取二维数组里的2个键作为一位数组返回
 * @param array $data
 * @param $keyName
 * @param $valueName
 * @return array
 */
function array_melting(array $data, $keyName, $valueName){
    $result = [];
    foreach($data as $item){
        $value = array_get($item, $valueName);
        if($key = array_get($item, $keyName)){
            $result[$key] = $value;
            continue;
        }
        $result[] = $value;
    }
    return $result;
}
