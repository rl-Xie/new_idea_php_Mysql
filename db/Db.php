<?php

class Db
{
    public $table;
    public $pdo;
    //--------------------------------
    public $sql;
    public $sql_where;
    public $sql_limit;
    public $sql_order_by;
    public $page;
    public $where_relation = ' and ';
    public $where_count;
    public $sql_select;
    public $pdo_sta = 0;
    public $sql_column;
    public $sql_value;
    public $sql_update;

    //--------------------------------
    public function __construct($table)
    {
        $this->table = $table;
        $this->connect();
    }

    //链接数据路
    public function connect()
    {
        $options = [
            /* 常用设置 */
            PDO::ATTR_CASE              => PDO::CASE_NATURAL, /*PDO::CASE_NATURAL | PDO::CASE_LOWER 小写，PDO::CASE_UPPER 大写， */
            PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION, /*是否报错，PDO::ERRMODE_SILENT 只设置错误码，PDO::ERRMODE_WARNING 警告级，如果出错提示警告并继续执行| PDO::ERRMODE_EXCEPTION 异常级，如果出错提示异常并停止执行*/
            PDO::ATTR_ORACLE_NULLS      => PDO::NULL_NATURAL, /* 空值的转换策略 */
            PDO::ATTR_STRINGIFY_FETCHES => false, /* 将数字转换为字符串 */
            PDO::ATTR_EMULATE_PREPARES  => false, /* 模拟语句准备 */
        ];
        $host = config('db_host');
        $this->pdo = new PDO("mysql:dbname=" . config('db_database') . ";" . "host=$host", config('db_username'), config('db_password'), $options);
    }

    //增
    public function insert($rows)
    {
        foreach ($rows as $col => $val) {
            $this->sql_column .= " $col,";
            $this->sql_value .= " '$val' ,";
        }
        $this->sql_column = trim($this->sql_column, ',');
        $this->sql_value = trim($this->sql_value, ',');
        $this->sql = "insert into $this->table ( $this->sql_column ) VALUES ( $this->sql_value)";
//        var_dump($this->sql);
//        die();
        $r = $this->execute();
        $this->sql_init();
        return $r;
    }

    //删
    public function delete()
    {
        $this->sql = "delete from $this->table $this->sql_where";
        $r = $this->execute();
        $this->sql_init();
        return $r;
    }

    //改
    public function update($rows)
    {
        //更新 把id删除  一位id 是自己管理的 不能随便改写
        unset($rows['id']);
        foreach ($rows as $key => $val) {
            $this->sql_update .= " $key = '$val' ,";
        }
        $this->sql_update = trim($this->sql_update, ',');
        $this->sql = "update $this->table set $this->sql_update $this->sql_where";
        $r = $this->execute();
        $this->sql_init();
        return $r;
    }

    //查
    public function get($type = null)
    {
        if (!$this->sql_select)
            $this->select();
        $this->sql = "select $this->sql_select from $this->table $this->sql_order_by $this->sql_where $this->sql_limit";
        $this->execute();
        $this->sql_init();
        return $this->get_data($type);
    }

    //执行
    public function execute()
    {
        $this->prepare();
        return $this->pdo_sta->execute();
    }

    //准备
    public function prepare()
    {
        $this->pdo_sta = $this->pdo->prepare($this->sql);
    }

    //获取数据
    public function get_data($type=null)
    {
        return $this->pdo_sta->fetchAll($type ? PDO::FETCH_NUM : PDO::FETCH_ASSOC);
    }

    public function select($col = null)
    {
        if (!$col) {
            $this->sql_select = ' * ';
            return;
        }

        foreach ($col as $key) {
            $this->sql_select .= " $key,";
        }
        $this->sql_select = trim($this->sql_select, ',');
        return $this;
    }

    public function limit($limit = 10, $offset = 0)
    {
        $this->sql_limit = " limit $offset, $limit ";
        return $this;
    }

    public function order_by($col = 'id', $des = 'desc')
    {
        $this->sql_order_by = " order by $col $des ";
        return $this;
    }

    public function where()
    {
        $this->where_relation = ' and ';
        return call_user_func_array([$this, 'make_where'], func_get_args());
    }

    public function or_where()
    {
        $this->where_relation = ' or ';
        return call_user_func_array([$this, 'make_where'], func_get_args());
    }

    public function make_where()
    {
        if (!$this->sql_where) {
            $this->sql_where = " where ";
        }
        $args = func_get_args();
        if (count($args) == 2) {
            $this->make_where_condition($args[0], '=', $args[1]);
        } elseif (count($args) == 3) {
            $this->make_where_condition($args[0], $args[1], $args[2]);
        } else {
            if (in_array($args[0])) {
                foreach ($args[0] as $col => $val) {
                    $this->make_where_condition($col, '=', $val);
                }
            }
        }
        return $this;
    }

    public function make_where_condition($col, $operation, $val)
    {
        if ($this->where_count)
            $this->sql_where .= $this->where_relation;
        $this->sql_where .= " $col $operation '$val' ";
        $this->where_count++;
    }

    //重置
    public function sql_init()
    {
        $this->sql =
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

    //获取当前表所以字段名称
    public function all_column_name()
    {
        $name_list = [];
        $data = $this->all_column();
        foreach ($data as $col) {
            $name_list[] = $col['Field'];
        }
        return $name_list;
    }

    public function all_column()
    {
        $this->sql = "desc $this->table";
        $this->execute();
        $r = $this->get_data();
        $this->sql_init();
        return $r;
    }

    //返回最后一次操作ID的值
    public function last_id()
    {
        return $this->pdo->lastInsertId();
    }

    //判断数据是否已经存在
    public function exist()
    {
        $this->limit(1);
        return (bool)$this->get();
    }

    //获取一条数据
    public function first()
    {
        $this->limit(1);
        return @$this->get()[0];
    }
}