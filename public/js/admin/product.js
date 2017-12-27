;(function () {
    'use strict';
    var top_one = document.querySelector('.f-page .top-one a');
    var next_one = document.querySelector('.f-page .next-one a');

    var product = new Ui('product', '#list', '#show_data tbody');
    var cat = new Model('cat');
    var el = document.getElementById('cat_select_list');
    product.table_tpl_maker = function (item) {
        return `
            <td>${item.id}</td>
            <td>${item.title}</td>
            <td>${item.price}</td>
            <td>${item.cat_id}</td>
            <td>${item.sales}</td>
            <td><img src="/upload/${item.cover_path}"></td>
            <td>
              <button class="btn btn-danger" id="del_button_${item.id}"><i class="fa fa-trash"></i></button>
              <button class="btn btn-success" id="up_button_${item.id}"><i class="fa fa-edit"></i></button>
            </td>
              `;
    };
    cat.read();
    cat.after_read = function () {
        //获取数据  再把数据渲染到页面
        get_cat_select_render();
    };

    function get_cat_select_render() {
        cat.list_each(function (item) {
            var option = document.createElement('option');
            option.value = item.id;
            option.innerText = item.title;
            el.appendChild(option);
        })
    }


    init();
    function init() {
        top_one.addEventListener('click',function () {
            product.turn_top_page();
            product.read();
        });
        next_one.addEventListener('click',function () {
            product.turn_next_page();
            product.read();
        });
    }
    product.read_data_number();

    product.read();
    product.monitor_event();  //监听增加一条
})();