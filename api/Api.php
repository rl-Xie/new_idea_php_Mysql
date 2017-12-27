<?php
tpl('model/Model');

class Api extends Model
{
    public function add($params, &$msg)
    {
        $this->filtration($params);
        if ($id = $this->start_execute($msg)) {
            move_uploded('cover_path', $upload);
            $this->where('id', $id)
                ->update(['cover_path' => $upload['fullname']]);
        }
    }

    public function remove($params = [], &$msg)
    {
        if (!$id = @$params['id']) {
            $msg['id'] = 'invalid_id';
            return false;
        }
        return $this->where('id', $id)
            ->delete();
    }

    public function change($params = [], &$msg)
    {
        return $this->filtration($params)
            ->start_execute($msg);
    }

    public function read($params = [], &$msg)
    {
        $page = @$params['page'] ?: 1;
        return $this->order_by('id')
            ->page($page)
            ->get();
    }
    //获取数据的总数
    public function read_number($params = [], &$msg)
    {
        return $this->select(['count(*)'])
            ->get(true)[0][0];
    }

    public function read_item($params = [], &$msg)
    {
        if (!$id = @$params['id']) {
            $msg = 'invalid_id';
            return false;
        }
        return $this->where('id', $id)
            ->first();
    }
}