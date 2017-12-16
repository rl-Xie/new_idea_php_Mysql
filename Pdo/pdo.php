<?php

class Db
{
    public $pdo;
    public $database = 'order_meal';
    public $table;
    public $sql_update;
    public $sql_column;
    public $sql_values;
    public $sql = '';
    public $sql_where = '';
    public $sql_order_by = '';
    public $sql_limit = '';
    public $sql_select = '';
    public $where_count = 0;
    public $where_relation = 'AND';
    public $pdo_sta;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function connect()
    {
        if ($this->pdo)
            return;
        $host = config('db_host');
        $this->pdo = new PDO("mysql:dbname=$this->database;host=$host",
            config('db_username'), config('db_password'),
            [
                /* 常用设置 */
                PDO::ATTR_CASE              => PDO::CASE_NATURAL, /*PDO::CASE_NATURAL | PDO::CASE_LOWER 小写，PDO::CASE_UPPER 大写， */
                PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION, /*是否报错，PDO::ERRMODE_SILENT 只设置错误码，PDO::ERRMODE_WARNING 警告级，如果出错提示警告并继续执行| PDO::ERRMODE_EXCEPTION 异常级，如果出错提示异常并停止执行*/
                PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL, /* 空值的转换策略 */
                PDO::ATTR_STRINGIFY_FETCHES => false, /* 将数字转换为字符串 */
                PDO::ATTR_EMULATE_PREPARES  => false, /* 模拟语句准备 */
            ]);
    }

    public function where()
    {
        $this->where_relation = 'and';
        return call_user_func_array([$this, 'make_where'], func_get_args());
    }

    public function or_where()
    {
        $this->where_relation = 'or';
        return call_user_func_array([$this, 'make_where'], func_get_args());
    }

    public function make_where()
    {
        //获取传参
        $args = func_get_args();
        //如果出参的数量为2
        if (!$this->sql_where) {
            $this->sql_where = " where ";
        }
        if (count($args) == 2) {
            $this->make_where_condition($args[0], '=', $args[1]);
        } elseif (count($args) == 3) {
            $this->make_where_condition($args[0], $args[1], $args[2]);
        } else {
            if (is_array($args[0])) {
                foreach ($args as $col => $val) {
                    $this->make_where_condition($col, '=', $val);
                }
            }
        }
        return $this;
    }

    public function make_where_condition($col, $operator, $val)
    {
        if ($this->where_count)
            $this->sql_where .= " $this->where_relation ";
        $this->sql_where .= "$col $operator '$val'";
        $this->where_count++;
    }

    //查找什么
    public function select($col = null)
    {
        if (!$col) {
            $this->sql_select = '*';
        } else {
            foreach ($col as $val) {
                $this->sql_select .= "$val ,";
            }
        }
        $this->sql_select = trim($this->sql_select, ',');
        return $this;
    }

    //排序
    public function order_by($col, $direction = 'desc')
    {
        $this->sql_order_by = "order by $col $direction";
        return $this;
    }

    //限制
    public function limit($limit = 15, $offset = 0)
    {
        $this->sql_limit = "limit $offset , $limit";
        return $this;
    }

    //增加
    public function insert($rows)
    {
        foreach ($rows as $key => $val) {
            $this->sql_column .= " $key ,";
            $this->sql_values .= " $val ,";
        }
        $this->sql_column = trim($this->sql_column, ',');
        $this->sql_values = trim($this->sql_values, ',');
        $this->sql = "insert into $this->table( $this->sql_column) VALUES ($this->sql_values)";
        $r = $this->execute();
        $this->init_sql();
        return $r;
    }

    public function delete()
    {
        $this->sql = "DELETE FROM $this->table $this->sql_where";
        $r = $this->execute();
        $this->init_sql();
        return $r;
    }

    public function update($rows)
    {
        foreach ($rows as $col => $val) {
           $this->sql_update .= " $col = '$val' ,";
        }
        $this->sql_update = trim($this->sql_update,',');
        $this->sql = "update $this->table set $this->sql_update $this->sql_where";
        $r = $this->execute();
        $this->init_sql();
        return $r;
    }

    //查
    public function get()
    {
        if (!$this->sql_select) {
            $this->select();
        }
        $this->sql = "select $this->sql_select from $this->table $this->sql_order_by  $this->sql_limit $this->sql_where";
        $this->execute();
        $this->init_sql();
        return $this->get_data();
    }

    public function execute()
    {
        if (!$this->pdo_sta) {
            $this->prepare();
        }
        return $this->pdo_sta->execute();
    }

    public function prepare()
    {
        $this->pdo_sta = $this->pdo->prepare($this->sql);
    }

    public function get_data()
    {
        return $this->pdo_sta->fetchAll(PDO::FETCH_ASSOC);
    }

    //执行结束后初始化
    public function init_sql()
    {
        $this->sql =
        $this->pdo_sta =
        $this->sql_select =
        $this->sql_where =
        $this->sql_order_by =
        $this->sql_limit =
        $this->sql_column =
        $this->sql_value =
        $this->sql_update = '';
        $this->where_count = 0;
        $this->where_relation = 'AND';
    }
}