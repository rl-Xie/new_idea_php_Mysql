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

    //获取数据 并渲染到页面
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
                    $.post('/api/cart/add_or_update', {product_id: item.id, count: count})
                        .then(function (r) {
                            if (r.success) {
                                inited();
                            }
                        })
                }, 500);
            });
            el_product_list.appendChild(el);
        })
    };
    //获取联合数据
    //获取两个表相同的字符 合起来的数据
    inited();
    function inited() {
        $.post('/api/cart/get_data_s', {table: 'product', cond: ['product_id', 'id']})
            .then(function (res) {
                render_shopping_cart(res.data);
            });
    }

    //渲染到购物车
    function render_shopping_cart(data) {
        shopping_div.innerHTML = "";
        data.forEach(function (item) {
            var el = document.createElement('div');
            el.classList.add('item-data');
            el.innerHTML = `
                    <div class="item-data-left" >
                       <div class="item-img">
                           <img src="/upload/${item.cover_path}">
                       </div>
                    </div>
                    <div class="item-data-right">           
                        <div class="title">菜名:${item.title}</div>
                        <div class="price">单价:${item.price}</div>
                        <div class="price">
                        <button class="reduce_number" type="button">-</button> 
                        ${item.count} 
                        <button class="add_number" type="button">+</button></div>
                    </div>
       `;
            var reduce_b = el.querySelector('.reduce_number');
            reduce_n_event(reduce_b, item);
            var add_b = el.querySelector('.add_number');
            add_n_event(add_b, item);
            shopping_div.appendChild(el);
        })
    }

    //购物车中 数量的增减
    function add_n_event(a, data) {
        a.addEventListener('click', function (e) {
            e.preventDefault();
            ++data.count;
            $.post('/api/cart/add_or_update', {product_id: data.id, count: data.count})
                .then(function (r) {
                    if (r.success) {
                        inited();
                    }
                })
        })
    }
    function reduce_n_event(b, data) {
        b.addEventListener('click', function (e) {
            e.preventDefault();
            if (data.count == 1) {
                return;
            } else {
                --data.count;
                $.post('/api/cart/add_or_update', {product_id: data.id, count: data.count})
                    .then(function (r) {
                        if (r.success) {
                            inited();
                        }
                    })
            }
        })
    }

    //清空购物车  也就是后端写一个删除功能  如果穿id  则删除一条  否组全部删除


    //结算 提交订单
    // $.post('/api/order/checkout', {
    //     list: [
    //         {id: 19, count: 2},
    //         {id: 20, count: 1}
    //     ]
    // })
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