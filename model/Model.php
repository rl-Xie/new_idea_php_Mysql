<?php
tpl('db/Db');
tpl('validator/Validator');

class Model extends Db
{   //有效传参数组
    public $filled = [];
    public $validator;

    public function __construct()
    {
        parent::__construct($this->table);
        $this->validator = new Validator($this->table);
    }

    //[一]过滤传参
    public function filtration($rows)
    {
        //过滤后的传参集合
        $safety_send = [];
        $name_list = $this->all_column_name();
        foreach ($rows as $key => $val) {
            if (in_array($key, $name_list) == false)
                continue;
            $safety_send[ $key ] = $val;
        }
        $this->filled = $safety_send;
        return $this;
    }

    //验证
    public function test(&$msg)
    {
        foreach ($this->filled as $col => $val) {
            $is_valid = $this->validator->validate_rules($val, @$this->rule[ $col ], $validate_msg);
            if (!$is_valid) {
                $msg[ $col ] = $validate_msg;
                return false;
            }
        }
        return true;
    }

    //[二]执行
    public function start_execute(&$msg = [])
    {
        $filled = &$this->filled;
        //--验证--规则--
        $data = $this->test($msg);
        if (!$data) {
            return false;
        }
        //--判断是不是更新--
        $is_update = (bool)$id = @$filled['id'];
        //判断类中是否存在一个方法
        if (method_exists($this, 'before_encryption')) {
            $this->before_encryption();
        }
        if ($is_update) {
            $this->where('id', $id);
            //--判断这条是否存在--
            if (!$this->get()) {
                $msg['id'] = "no_exist";
                return false;
            }
            if (!$filled['update_time']) {
                $filled['update_time'] = $this->set_time();
            }
            $this->where('id', $filled['id']);
            $r = $this->update($filled);
        } else {
            unset($filled['id']);
            if (!@$filled['create_time']) {
                $filled['create_time'] = $this->set_time();
            }
            if (!@$filled['update_time']) {
                $filled['update_time'] = $this->set_time();
            }
            if ($this->insert($filled)) {
                //添加成功返回最后一次的ID
                $r = $this->last_id();
            } else {
                return false;
            }
        }
//        if (method_exists($this, 'after_save'))
//            $this->after_save();
        return $r;
    }

    //生成时间
    public function set_time()
    {
        date_default_timezone_set("PRC");
        return date('Y-m-d H:i:s', time());
    }

    public function page($page, $limit = 10)
    {
        $this->limit($limit, ($page - 1) * $limit);
        return $this;
    }
}