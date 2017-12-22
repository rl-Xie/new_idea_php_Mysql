;(function () {
    'use strict';
    var cat = new Ui('cat', '#list', '#show_data tbody');
    cat.table_tpl_maker = function (item) {
        return `
            <td>${item.id}</td>
            <td>${item.title}</td>
             <td>
              <button class="btn btn-danger" id="del_button_${item.id}"><i class="fa fa-trash"></i></button>
              <button class="btn btn-success" id="up_button_${item.id}"><i class="fa fa-edit"></i></button>
            </td>
              `;
    };
    cat.read();
    cat.monitor_event();
})();