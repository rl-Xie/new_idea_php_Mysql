<?php

class Validator extends Db
{   //把规则便利城数组

    public function __construct($table)
    {
        parent::__construct($table);
    }

    //拆分规则
    public function rule_arr($rules)
    {
        $rules = explode('|', $rules);
        $arr = [];
        foreach ($rules as $rule) {
            $rule_arr = explode(':', $rule);
            if (count($rule_arr) == 1)
                $arr[ $rule_arr[0] ] = true;
            else
                $arr[ $rule_arr[0] ] = $rule_arr[1];
        }
        return $arr;
    }

    //入口 传用户输入 例如:username   找到对应的规则
    public function validate_rules($user_val, $rules, &$error = null)
    {
        if (is_string($rules))
            $rules = $this->rule_arr($rules);
        if (!$rules) return true;

        foreach ($rules as $type => $param) {
            $method = 'valid_' . $type;
            $r = $this->$method($user_val, $param);
            if (!$r) {
                $error = 'invalid_' . $type;
                return false;
            }
        }
        return true;
    }

    //判断最大长度
    public function valid_max_length($val, $max)
    {
        $val = (string)$val;
        return strlen($val) <= $max;
    }

    //判断最小长度
    public function valid_min_length($val, $min){
        $val = (string)$val;
        return strlen($val) >= $min;
    }

    //判断必须为正数
    public function valid_positive($val)
    {
        $val = (float)$val;
        return $val >= 0;
    }

    //判断为整数
    function valid_integer($val)
    {
        if (!is_numeric($val))
            return false;
        $val = (string)$val;
        $r = strpos($val, '.') === false;
        return $r;
    }

    //判断为数字
    public function valid_numeric($val)
    {
        return is_numeric($val);
    }

    //判断唯一性
    public function valid_unique($val, $col)
    {
        return !$this->valid_exist($val, $col);
    }

    //是否存在
    public function valid_exist($val, $col)
    {
        return $this->where($col, $val)->exist();
    }
}