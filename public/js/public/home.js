;(function () {
    'use strict';
    //-------------------------
    var go_shopping = document.querySelector('.shopping');
    var show_div = document.querySelector('.shopping-page');
    var shopping_div = document.querySelector('.shopping-r-t');
    //-------------------------
    var cat = new Model('cat');
    var product = new Model('product');
    var el_cat_list = document.querySelector('.cat-list');
    var el_product_list = document.querySelector('.product-list');
    cat.read();
    cat.after_read = function () {
        cat.list_each(function (item) {
            var el = document.createElement('div');
            el.classList.add('cat-item');
            el.innerText = item.title;
            el_cat_list.appendChild(el);
        })
    };

    product.read();
    product.after_read = function () {
        product.list_each(function (item) {
            var el = document.createElement('div');
            el.classList.add('product-item', 'clearfix');
            el.innerHTML = `
                 <div class="col-xs-5">
                        <img src="/upload/${item.cover_path}">
                    </div>
                    <div class="col-xs-7 detail">
                        <div class="title">${item.title}</div>
                        <div class="other">月销：${item.sales}</div>
                        <div class="price">￥ ${item.price}</div>
                        <button class="add" type="button">+</button>
                    </div>
             `;
            var timer;
            var count = 0;
            var button_event = el.querySelector('.add');
            button_event.addEventListener('click', function () {
                clearTimeout(timer);
                count++;
                console.log(count);
                timer = setTimeout(function () {
                    $.post('/api/cart/add_or_update', {product_id:item.product_id,count:item.count})
                        .then(function (r) {
                            if (r.success) {
                                render_shopping();
                            }
                        })
                }, 500);
            });
            el_product_list.appendChild(el);
        })
    };


    function render_shopping(data, count) {
        var el = document.createElement('div');
        el.classList.add('item-data');
        el.innerHTML = `
                    <div class="item-data-left" >
                       <div class="item-img">
                           <img src="/upload/${data.cover_path}">
                       </div>
                    </div>
                    <div class="item-data-right">           
                        <div class="title">菜名:${data.title}</div>
                        <div class="price">单价:${data.price}</div>
                        <div class="price">
                        <button class="add" type="button">-</button> 
                        ${count} 
                        <button class="add" type="button">+</button></div>
                        
                    </div>
       `;
        shopping_div.appendChild(el);
    }

    //结算 提交订单
    // $.post('/api/order/checkout', {
    //     list: [
    //         {id: 19, count: 2},
    //         {id: 20, count: 1}
    //     ]
    // })

    //获取两个表相同的字符 合起来的数据
    $.post('/api/cart/get_data_s', {table:'product',cond:['product_id','id']})
        .then(function(res){
            console.log(res);
        });

    //  明天做 需要把数据拿到 已经拿到了  需要遍历数据  把数据渲染到购物车

    //----------------------------------------------购物车显隐
    var a = true;
    go_shopping.addEventListener('click', function (e) {
        e.preventDefault();
        if (a) {
            show_div.classList.add('show');
            a = false;
        } else {
            show_div.classList.remove('show');
            a = true;
        }

    })
})();