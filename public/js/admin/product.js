;(function () {
    'use strict';
    var product = new Ui('product', '#list', '#show_data tbody');
    product.table_tpl_maker = function (item) {
        return `
            <td>${item.id}</td>
            <td>${item.title}</td>
            <td>${item.price}</td>
            <td>
              <button class="btn btn-danger" id="del_button_${item.id}"><i class="fa fa-trash"></i></button>
              <button class="btn btn-success" id="up_button_${item.id}"><i class="fa fa-edit"></i></button>
            </td>
              `;
    };
    product.read();
    product.monitor_event();  //监听增加一条
})();