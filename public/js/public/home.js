;(function () {
    'use strict';

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
            el_product_list.appendChild(el);
        })
    }

})();