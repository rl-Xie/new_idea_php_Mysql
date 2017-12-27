;(function () {
    'use strict';
    //---------------------------选中上下翻页
    var top_one = document.querySelector('.f-page .top-one a');
    var next_one = document.querySelector('.f-page .next-one a');

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
    //----------------------------------------------------翻页
    init();
    function init() {
        top_one.addEventListener('click',function () {
            cat.turn_top_page();
            cat.read();
        });
        next_one.addEventListener('click',function () {
            cat.turn_next_page();
            cat.read();
        });
    }
    cat.read_data_number();

    cat.read();
    cat.monitor_event();

})();