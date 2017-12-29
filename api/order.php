<?php
tpl('api/Api');

class Order extends Api
{
    public $table = 'order';
//    public $rule = [
//        'title' => 'max_length:24|min_length:2|unique:title',
//    ];
    //因为需要判断是否可以在商品里表中 找到这个商品 所以需要实例化一个商品类


    public function checkout($p, &$msg = null)
    {
        //{list: [{id: 1, count: 3}, {id:3, count: 2, memo: "不加冰"}]}
        $list = $p['list'];
        $price = 0;
        //因为需要判断是否可以在商品里表中 找到这个商品 所以需要实例化一个商品类
        $product_ins = new Product();
        //快照  记录商品信息
        $snapshot = [
            'product' => [],
        ];
        $row = [];
        foreach ($list as $product_info) {
            $pid = @$product_info['id'];
            $count = @$product_info['count'];
            //判断是否存在商品的ID 和 数量  在判断能否找到这个商品
            if (!$pid || !$count || !($product = $product_ins->find($pid))) {
                $msg = 'invalid:id&&count';
                return false;
            }
            $price += (float)$product['price'] * (int)$count;
            $snapshot['product'][] = $product;
        }
        $row['user_id'] = his('id');
        $row['product'] = json_encode($list);
        $row['snapshot'] = json_encode($snapshot);
        $row['order_num'] = $this->generate_order_num();
        return $this->insert($row);
    }

    public function generate_order_num()
    {
        $max = $this
            ->order_by('id')
            ->limit(1)
            ->get();
        $last_id = (int)@$max[0]['id'];
        return rand(100, 999) . ($last_id + 1);
    }
}