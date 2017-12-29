<?php
tpl('api/Api');

class Cart extends Api
{
    public $table = 'cart';

    public $rule = [
        'memo' => 'max_length:1024',
    ];

    public function add_or_update($p, &$msg)
    {
        $product = new product();
        $product_id = $p['product_id'];
        $count = $p['count'];
        if (!$product_id || !$count || !$product->find($product_id)) {
            return false;
        }

        $exist = $this->where('product_id', $product_id)
            ->where('user_id', his('id'))
            ->first();

        if ($exist) {
            $p = array_merge($p, $exist);
        }

        $p['user_id'] = his('id');
        $this->filtration($p);
        return $this->start_execute($msg);

    }
}