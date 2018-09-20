<?php
/**
 * Created by PhpStorm.
 * User: widana
 * Date: 22/08/18
 * Time: 13:47
 */
 
function checked($current_value = "", $expectation_value = "") {
    return $current_value == $expectation_value;
}

function authorized($params) {
    $param = explode(',', $params);
    $role = \Session::get("HAS_SESSION")["role"];

    $result = array_intersect($param, [$role]);
    $data = !empty($result);

    return $data;


}