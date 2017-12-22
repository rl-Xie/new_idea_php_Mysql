<?php
tpl('model/Model');

class Api extends Model
{

    public function add($params, &$msg)
    {
        return $this->filtration($params)
            ->start_execute($msg);
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