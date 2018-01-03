<?php
tpl('api/Api');

class Product extends Api
{

    public $table = 'product';
    public $rule = [
        'title' => 'max_length:24|min_length:2',
        'price' => 'numeric|positive',
        //        'stock' => 'integer|positive',
    ];
    //获取数据  以cat_id 为分类标准
    public function read_group(){
        $sta = $this->pdo->prepare("select cat_id, product.* from product");
        $sta->execute();
        return $sta->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);
    }
}